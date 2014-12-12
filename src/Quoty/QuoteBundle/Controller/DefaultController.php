<?php

namespace Quoty\QuoteBundle\Controller;

use Quoty\QuoteBundle\Entity\Quote;
use Quoty\QuoteBundle\Form\QuoteType;
use Quoty\QuoteBundle\Form\QuoteEditType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

class DefaultController extends Controller
{
	/**
	 * Render the default page : display all quotes on the page.
	 * Think about danstonchat.fr
	 * @return Response
	 */
	public function viewlistAction()
	{
		$em = $this->getDoctrine()->getManager();
		$quotes = $em->getRepository('QuotyQuoteBundle:Quote')->findAll();
		return $this->render('QuotyQuoteBundle:Default:viewlist.html.twig', array(
			'quotes' => $quotes
		));
	}

	/**
	 * Display the quote requested.
	 * 
	 * @return Response
	 */
	public function viewAction(Request $request)
	{
		$env = $this->get('kernel')->getEnvironment();
		$em = $this->getDoctrine()->getManager();
		$id = $request->get('id');
		$quote = new Quote;
		$quote = $em->getRepository('QuotyQuoteBundle:Quote')->find($id);

		// If in dev, exception, else simple redirect
		if (null === $quote) {
			if ($env === 'prod') {
				return $this->render('QuotyQuoteBundle:Default:tmpError.html.twig');
			}
			elseif (in_array($env, array('dev', 'text'))) {
				throw $this->createNotFoundException('La quote n\'existe pas.');
			}
		}

		return $this->render('QuotyQuoteBundle:Default:view.html.twig', array(
			'quote' => $quote
		));
	}


	/**
	 * Go to a form for adding a Quote.
	 *
	 * @return Response
	 */
	public function addAction(Request $request)
	{
		$quote = new Quote;
		$form = $this->get('form.factory')->create(new QuoteType, $quote);
		$em = $this->getDoctrine()->getManager();

		$form->handleRequest($this->getRequest());
		$userManager = $this->container->get('fos_user.user_manager');

		if ($form->isValid()) {
			$quote = $form->getData();

			// Get all the quotes
			$db_quotes = $em->getRepository('QuotyQuoteBundle:Quote')->findAll();

			// update in database
			$em->persist($quote);
			$em->flush();

			// get current logged user
			$user = $this->get('security.context')->getToken()->getUser();

			// while is number is >0, we can decreased it
			if ($user->getQuoteNumber() > 0) {
				$user->setQuoteNumber( $user->getQuoteNumber() - 1);
			}

			// If it equals 0, then we disabled the account and logout.
			if ($user->getQuoteNumber() === 0) {
				$user->setEnabled(false);
				$this->get('security.context')->setToken(null);
				$this->get('request')->getSession()->invalidate();
			}

			$userManager->updateUser($user, true);
			
			return $this->redirect($this->generateUrl('quoty_quote_view', array('id' => $quote->getId())));
		}

		return $this->render('QuotyQuoteBundle:Default:add.html.twig', array(
			'form' => $form->createView()
		));
	}

	/**
	 * Go to a form for editing a Quote.
	 *
	 * @return Response
	 */
	public function editAction(Request $request)
	{
		$env = $this->get('kernel')->getEnvironment();
		$em = $this->getDoctrine()->getManager();
		$id = $request->get('id');
		$quote = new Quote;
		$quote = $em->getRepository('QuotyQuoteBundle:Quote')->find($id);

		$form = $this->get('form.factory')->create(new QuoteEditType, $quote);

		// If in dev, exception, else simple redirect
		if (null === $quote) {
			if ($env === 'prod') {
				//return $this->redirect($this->generateUrl('quoty_quote_viewlist'));
				return $this->render('QuotyQuoteBundle:Default:tmpError.html.twig');
			}
			elseif (in_array($env, array('dev', 'text'))) {
				throw $this->createNotFoundException('La quote n\'existe pas.');
			}
		}

		return $this->render('QuotyQuoteBundle:Default:edit.html.twig', array(
			'form' => $form->createView()
		));
	}

	/**
	 * Go to a form for deleting a Quote.
	 *
	 * @return Response
	 */
	public function deleteAction(Request $request)
	{
		$em = $this->getDoctrine()->getManager();
		$id = $request->get('id');
		$quote = $em->getRepository('QuotyQuoteBundle:Quote')->find($id);

		// If in dev, exception, else simple redirect
		if (null === $quote) {
			if ($env === 'prod') {
				return $this->redirect($this->generateUrl('quoty_quote_viewlist'));
			}
			elseif (in_array($env, array('dev', 'text'))) {
				throw $this->createNotFoundException('La quote n\'existe pas.');
			}
		}

		$form = $this->createFormBuilder()->getForm();

		if ($form->handleRequest($request)->isValid()) {
			$em->remove($quote);
			$em->flush();

			$request->getSession()->getFlashBag()->add('info', "La quote a bien été supprimée. Snif.");

			return $this->redirect($this->generateUrl('quoty_quote_viewlist'));
		}

		return $this->render('QuotyQuoteBundle:Default:delete.html.twig', array(
			'quote' => $quote,
			'form'  => $form->createView()
		));
	}

	/**
	 * Display a tmpError page, with a meta refresh
	 * 
	 * @return Response
	 */
	public function tmpErrorAction(Request $request)
	{
		return $this->redirect($this->generateUrl('quoty_quote_tmp_error'));
	}

}
