<?php

namespace NCMF\DefaultBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Yavin\Symfony\Controller\InitControllerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;
use Symfony\Component\Cache\Adapter\ApcuAdapter;
use Symfony\Component\Cache\Adapter\ArrayAdapter;
use Symfony\Component\Cache\Adapter\DoctrineAdapter;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

class DefaultController extends Controller implements InitControllerInterface
{
    public function init(Request $request)
    {
        $this->setRequest($request);
        $alias = $this->getAlias();
        $site = $this->setSite();

        if (!$alias) {
            throw new NotFoundHttpException('Сайт не найден', null, 1);
        } else {
            $granted = $this->get('security.authorization_checker')->isGranted('ROLE_ADMIN');

            if ($site->getClosed() && !$granted) {
                throw new AccessDeniedException('Сайт закрыт на техническое обслуживание');
            }

        }
    }

    private $request;

    private function setRequest(Request $request){
        $this->request = $request;
    }

    private function getRequest(){
        return $this->request;
    }

    private $alias;

    private function getAlias(){
        if (empty($this->alias))
            $this->setAlias();
        return $this->alias;
    }

    private function setAlias(){


        $cache = new ApcuAdapter();
        $objectCache = $cache->getItem('alias_site');
        //if (!$objectCache->isHit()) {
        if (true) {
            //dump('not hit');
            $em = $this->getDoctrine()->getManager();
            $alias = $em->getRepository('NCMFDefaultBundle:SiteAlias')->findOneBy(array('name' => $this->getRequest()->getHost()));
            $this->alias = $alias;

            //$encoder = new JsonEncoder();
            //$normalizer = new ObjectNormalizer();
            //$normalizer->setIgnoredAttributes(array('site'));
            //$serializer = new Serializer(array($normalizer), array($encoder));
            //$jsonContent = $serializer->serialize($alias, 'json');
            //dump($jsonContent);

            $objectCache->set($alias);


            $cache->save($objectCache);
        }
        else {
            //dump('alias hit');
            $alias = $objectCache->get();
            //dump($alias);
        }
        $this->alias = $alias;
        return $alias;
    }

    private $site;

    private function getSite() {
        if (empty($this->site))
            $this->setSite();
        return $this->site;
    }

    private function setSite()
    {
        $cache = new ApcuAdapter();
        $objectCache = $cache->getItem('site_entity_1');
        if (true) {
        //if (!$objectCache->isHit()) {
            //dump('site not hit');
            $alias = $this->getAlias();
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('NCMFDefaultBundle:Site')->find($alias->getSite());
            $encoder = new JsonEncoder();
            $normalizer = new ObjectNormalizer();
            $normalizer->setIgnoredAttributes(array('aliases', 'sections'));
            $serializer = new Serializer(array($normalizer), array($encoder));
            $jsonContent = $serializer->serialize($entity, 'json');
            //dump($jsonContent);
            //dump($entity);
            $objectCache->set($jsonContent);
            $cache->save($objectCache);
        }
        else {
            //dump('site hit');
            $entity = $objectCache->get();
            //dump($entity);
        }

        $this->site = $entity;
        return $entity;
    }

    public function indexAction(Request $request, $slug)
    {
        //dump($this->getSite());
        $view = '@templates/' . $this->getSite()->getCode() . '/Site.html.twig';
        if ($this->get('templating')->exists($view) == false) {
            throw new NotFoundHttpException('Шаблон сайта '.$this->getSite()->getCode().' не найден', null, 2);
        }
        $cache = new ApcuAdapter();
        $sectionCache = $cache->getItem('section__'.$slug);
        if (!$sectionCache->isHit()) {
            $em = $this->getDoctrine()->getManager();
            $section = $em->getRepository('NCMFDefaultBundle:Section')->findOneBy(array('site' => $this->getSite(), 'slug' => $slug));
            $sectionCache->set($section);
            $cache->save($sectionCache);
        }
        else {
            $section = $sectionCache->get();
        }

        if (!$section) {
            throw new NotFoundHttpException("Раздел не найден", null, 3);
        }
        if ($section->getTemplate()) {
            $view = '@templates/' . $this->getSite()->getCode() . '/Pages/'.$section->getTemplate().'.html.twig';
            if ($this->get('templating')->exists($view) == false) {
                throw new NotFoundHttpException('Шаблон раздела '.$section->getTemplate().' не найден', null, 2);
            }
        }
        $response = $this->render($view, array(
            'section' => $section
        ));
        //$response->setSharedMaxAge(3600);

        // (optional) set a custom Cache-Control directive
        //$response->headers->addCacheControlDirective('must-revalidate', true);
        return $response;
    }
}
