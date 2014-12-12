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
			->add('username', 'text')
			->add('email', 'email')
			->add('plainPassword', 'repeated', array(
				    'type' => 'password',
				    'invalid_message' => 'Les mots de passe doivent correspondre',
				    'options' => array('required' => true),
				    'first_options'  => array('label' => 'Mot de passe'),
				    'second_options' => array('label' => 'Mot de passe (validation)'),
				    'first_name'  => 'first',
				    'second_name' => 'repeated',
				)
			)
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
