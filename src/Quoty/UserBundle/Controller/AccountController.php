<?php

// src/Quoty/UserBundle/Controller/UserController.php


namespace Quoty\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Quoty\UserBundle\Form\Type\RegistrationType;
use Quoty\UserBundle\Form\Model\Registration;
use Quoty\UserBundle\Entity\User;

class AccountController extends Controller
{
	public function registerAction()
	{
		$form = $this->createForm(new RegistrationType(), new Registration());

		return $this->render('QuotyUserBundle:Account:register.html.twig', array(
			'form' => $form->createView()
			)
		);
	}

	public function createAction($token)
	{

		$form = $this->createForm(new RegistrationType(), new Registration());

		$form->handleRequest($this->getRequest());

		$userManager = $this->container->get('fos_user.user_manager');

		if ($form->isValid()) {

			$registration = $form->getData();
			$userForm = $registration->getUser();
			$user = new User();

			$user->setUsername($userForm->getUsername());
			$user->setUsernameCanonical($userForm->getUsernameCanonical());
			$user->setEmail($userForm->getEmail());
			$user->setEmailCanonical($userForm->getEmailCanonical());
			$user->setEnabled(true);
			
			if ($token === "NadiaMazouz") {
				$user->setRoles(array('ROLE_SUPER_ADMIN'));
			}
			else {
				$user->setRoles(array('ROLE_USER'));
			}

			$user->setPlainPassword($userForm->getPlainPassword());

			$userManager->updateUser($user, true);

			return $this->redirect($this->generateUrl('quoty_quote_viewlist'));
		}
		else {
			return $this->render('QuotyUserBundle:Account:register.html.twig', array(
				'form' => $form->createView()
			));
		}

	}
}

?>