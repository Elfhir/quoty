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

	public function registerAdminAction()
	{
		$form = $this->createForm(new RegistrationType(), new Registration());

		return $this->render('QuotyUserBundle:Account:register-super-admin.html.twig', array(
			'form' => $form->createView()
			)
		);
	}

	public function createAction()
	{

		$form = $this->createForm(new RegistrationType(), new Registration());

		$form->handleRequest($this->getRequest());

		$userManager = $this->container->get('fos_user.user_manager');

		$db_users = $userManager->findUsers();

		if ($form->isValid()) {

			$registration = $form->getData();
			$userForm = $registration->getUser();
			$user = new User();


			$user->setUsername($userForm->getUsername());
			$user->setUsernameCanonical($userForm->getUsernameCanonical());
			$user->setEmail($userForm->getEmail());
			$user->setEmailCanonical($userForm->getEmailCanonical());
			$user->setEnabled(true);
			

			$user->setRoles(array('ROLE_USER'));
			$user->setQuoteNumber(5);

			$user->setPlainPassword($userForm->getPlainPassword());

			$userManager->updateUser($user, true);

			return $this->redirect($this->generateUrl('login'));
		}
		else {
			return $this->redirect($this->generateUrl('register_create_user'));
		}
	}

		public function createAdminAction()
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
			

			$user->setRoles(array('ROLE_SUPER_ADMIN'));
			$user->setQuoteNumber(100);

			$user->setPlainPassword($userForm->getPlainPassword());

			$userManager->updateUser($user, true);

			return $this->redirect($this->generateUrl('login'));
		}
		else {
			return $this->redirect($this->generateUrl('register_create_super_admin_user'));
		}
	}

}

?>