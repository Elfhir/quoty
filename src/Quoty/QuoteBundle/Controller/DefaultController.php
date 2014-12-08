<?php

namespace Quoty\QuoteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function viewlistAction()
    {
        return $this->render('QuotyQuoteBundle:Default:viewlist.html.twig');
    }
}
