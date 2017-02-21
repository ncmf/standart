<?php

namespace NCMF\DefaultBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints;

class RegistrationType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$userCount = $this->em->getRepository('NCMFDefaultBundle:User')->createQueryBuilder('u')
			->select('count(u.id)')
			->getQuery()
			->getSingleScalarResult();
		if (!$userCount)
			$builder->add('security', PasswordType::class, array(
				'mapped' => false,
				'constraints' => new Constraints\EqualTo(array(
					'value' => $this->secret,
					'message' => 'Секретный ключ указан неверно'
				))
			));
	}

	public function getParent()
	{
		return 'FOS\UserBundle\Form\Type\RegistrationFormType';
	}

	public function getBlockPrefix()
	{
		return 'app_user_registration';
	}

	public function getName()
	{
		return $this->getBlockPrefix();
	}

	private $secret;
	private $em;

	public function __construct($secret, $em)
	{
		$this->secret = $secret;
		$this->em = $em;
	}
}