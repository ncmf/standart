<?php

namespace NCMF\DefaultBundle\EventListener;

use FOS\UserBundle\Event\FormEvent;
use FOS\UserBundle\FOSUserEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;


class UserRegistrationListener implements EventSubscriberInterface
{

	public function __construct()
	{

	}



	/**
	 * {@inheritdoc}
	 */
	public static function getSubscribedEvents()
	{
		return array(
			FOSUserEvents::REGISTRATION_SUCCESS => 'onRegistrationSuccess',
		);
	}

	public function onRegistrationSuccess(FormEvent $event){
	    if ($event->getForm()->has('security') == false)
	        return;
		$security = $event->getForm()->get('security')->getData();
		if ($security) {
            $user = $event->getForm()->getData();
            $user->addRole('ROLE_ADMIN');
        }
	}
}
