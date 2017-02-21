<?php

namespace NCMF\DefaultBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Tests\Exception\NotFoundHttpExceptionTest;
use Yavin\Symfony\Controller\InitControllerInterface;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller implements InitControllerInterface
{
	public function init(Request $request)
	{
		$em = $this->getDoctrine()->getManager();
		$alias = $em->getRepository('NCMFDefaultBundle:SiteAlias')->findOneBy(array('name' => $request->getHost()));
		if (!$alias) {
			throw new NotFoundHttpException('Хост не найден', null, 1);
		}
		else {
            $granted = $this->get('security.authorization_checker')->isGranted('ROLE_ADMIN');

		    if ($alias->getSite()->getClosed() && !$granted) {
                throw new AccessDeniedHttpException('Сайт закрыт на техническое обслуживание');
            }

        }
	}

	public function indexAction()
	{
		//$response = $this->render('NovuscomCMFBundle:Status:Closed.html.twig');
		//$response->setStatusCode(403);
		//return $response;
		return $this->render('NCMFDefaultBundle:Default:index.html.twig');
	}
}
