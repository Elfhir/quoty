<?php

namespace Quoty\QuoteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
	/**
	 * Render the default page : display all quotes on the page.
	 * Think about danstonchat.fr
	 * @return Response
	 */
	public function viewlistAction()
	{
		return $this->render('QuotyQuoteBundle:Default:viewlist.html.twig');
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
