<?php

namespace Quoty\QuoteBundle\Controller;

use Quoty\QuoteBundle\Entity\Quote;
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
	 * Go to a form for adding a Quote.
	 * 
	 * @return Response
	 */
	public function addAction()
	{
		return $this->render('QuotyQuoteBundle:Default:add.html.twig');
	}
	
}
