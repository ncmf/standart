<?php

namespace NCMF\DefaultBundle\EventListener;

use NCMF\DefaultBundle\Controller\TokenAuthenticatedController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Event\FilterControllerEvent;
use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\OptionsResolver\Exception\AccessException;
use Symfony\Bundle\TwigBundle\TwigEngine;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;


class TokenListener
{
    private $em;

    private $twigEngine;


    public function __construct(EntityManager $em, TwigEngine $twigEngine)
    {
        $this->em = $em;
	    $this->twigEngine = $twigEngine;

    }

    public function onKernelController(FilterControllerEvent $event)
    {
        $controller = $event->getController();
        if (!is_array($controller)) {
            return;
        }

		

        if (preg_match('/^(fos_user|_wdt|_profiler)/', $event->getRequest()->get('_route'), $matches)) {
            return;
        }

        $alias = $this->em->getRepository('NCMFDefaultBundle:SiteAlias')->findBy(array('name' => $event->getRequest()->getHost()));
        if (count($alias) == 1) {
            $closed = $alias[0]->getSite()->getClosed();
            if ($closed) {
                throw new AccessDeniedHttpException('Сайт закрыт на обсуживание');
            }
        } else {
	        //throw new NotFoundHttpException('Сайт закрыт на обсуживание');

			return false;
        }
    }
}