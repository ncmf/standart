<?php

namespace NCMF\DefaultBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
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
            throw new NotFoundHttpException('Сайт не найден', null, 1);
        } else {
            $granted = $this->get('security.authorization_checker')->isGranted('ROLE_ADMIN');

            if ($alias->getSite()->getClosed() && !$granted) {
                throw new AccessDeniedException('Сайт закрыт на техническое обслуживание');
            }

        }
    }

    private function getSite(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $alias = $em->getRepository('NCMFDefaultBundle:SiteAlias')->findOneBy(array('name' => $request->getHost()));
        return $alias->getSite();
        //$site = $em->getRepository('NCMFDefaultBundle:Site')->findOneBy(array('alias' => $alias));
    }

    public function indexAction(Request $request, $slug)
    {
        $site = $this->getSite($request);
        $view = '@templates/' . $site->getCode() . '/Site.html.twig';
        if ($this->get('templating')->exists($view) == false) {
            throw new NotFoundHttpException('Шаблон сайта '.$site->getCode().' не найден', null, 2);
        }
        $em = $this->getDoctrine()->getManager();
        $section = $em->getRepository('NCMFDefaultBundle:Section')->findOneBy(array('site' => $site, 'slug' => $slug));
        if (!$section) {
            throw new NotFoundHttpException("Раздел не найден", null, 3);
        }
        $instance = $em->getRepository('NCMFDefaultBundle:Instance')->findOneBy(array('section' => $section));
        if (!$instance) {
            throw new NotFoundHttpException("На странице ничего не найдено", null, 4);
        }
        return $this->render($view, array(
            'section' => $section,
            'instance' => $instance
        ));
    }
}
