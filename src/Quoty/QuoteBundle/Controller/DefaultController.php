<?php

namespace Quoty\QuoteBundle\Controller;

use Quoty\QuoteBundle\Entity\Quote;
use Quoty\QuoteBundle\Form\QuoteType;
use Quoty\QuoteBundle\Form\QuoteEditType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

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
		
		$em = $this->getDoctrine()->getManager();
		$id = $request->get('id');
		$quote = new Quote;
		$quote = $em->getRepository('QuotyQuoteBundle:Quote')->find($id);

		if (null === $quote) {
			throw new NotFoundHttpException("La Quote d'id ".$id." n'existe pas.");
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
		
		$em = $this->getDoctrine()->getManager();
		$id = $request->get('id');
		$quote = new Quote;
		$quote = $em->getRepository('QuotyQuoteBundle:Quote')->find($id);

		$form = $this->get('form.factory')->create(new QuoteEditType, $quote);

		if (null === $quote) {
			throw new NotFoundHttpException("La Quote d'id ".$id." n'existe pas.");
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

		if (null === $quote) {
			throw new NotFoundHttpException("La Quote d'id ".$id." n'existe pas.");
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
}
