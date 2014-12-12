<?php

//src/Quoty/UserBundle/Form/UserType.php

namespace Quoty\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class UserType extends AbstractType
{
		/**
	 * @param FormBuilderInterface $builder
	 * @param array $options
	 */
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder
			->add('username')
			// ->add('usernameCanonical')
			->add('email')
			// ->add('emailCanonical')
			// ->add('enabled')
			->add('password')
			// ->add('lastLogin')
			// ->add('roles')
		;
	}
	
	/**
	 * @param OptionsResolverInterface $resolver
	 */
	public function setDefaultOptions(OptionsResolverInterface $resolver)
	{
		$resolver->setDefaults(array(
			'data_class' => 'Quoty\UserBundle\Entity\User'
		));
	}

	/**
	 * @return string
	 */
	public function getName()
	{
		return 'quoty_userbundle_user';
	}
}
