<?php

// src/Quoty/UserBundle/Controller/UserController.php


namespace Quoty\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

use Quoty\UserBundle\Form\Type\RegistrationType;
use Quoty\UserBundle\Form\Model\Registration;

class AccountController extends Controller
{
	public function registerAction()
	{
		$form = $this->createForm(new RegistrationType(), new Registration());

		return $this->render('QuotyUserBundle:Account:register.html.twig', array('form' => $form->createView()));
	}

	public function createAction()
	{
		$em = $this->getDoctrine()->getEntityManager();

		$form = $this->createForm(new RegistrationType(), new Registration());

		$form->handleRequest($this->getRequest());

		if ($form->isValid()) {
			$registration = $form->getData();

			$em->persist($registration->getUser());
			$em->flush();

			return $this->redirect($this->generateUrl('quoty_quote_viewlist'));
		}

		return $this->render('QuoteUserBundle:Account:register.html.twig', array('form' => $form->createView()));
	}
}

?>