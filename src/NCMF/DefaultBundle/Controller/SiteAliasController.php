<?php

namespace NCMF\DefaultBundle\Controller;

use NCMF\DefaultBundle\Entity\SiteAlias;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Sitealias controller.
 *
 */
class SiteAliasController extends Controller
{
    /**
     * Lists all siteAlias entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $siteAliases = $em->getRepository('NCMFDefaultBundle:SiteAlias')->findAll();

        return $this->render('sitealias/index.html.twig', array(
            'siteAliases' => $siteAliases,
        ));
    }

    /**
     * Creates a new siteAlias entity.
     *
     */
    public function newAction(Request $request)
    {
        $siteAlias = new Sitealias();
        $form = $this->createForm('NCMF\DefaultBundle\Form\SiteAliasType', $siteAlias);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($siteAlias);
            $em->flush($siteAlias);

            return $this->redirectToRoute('admin_sitealias_show', array('id' => $siteAlias->getId()));
        }

        return $this->render('sitealias/new.html.twig', array(
            'siteAlias' => $siteAlias,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a siteAlias entity.
     *
     */
    public function showAction(SiteAlias $siteAlias)
    {
        $deleteForm = $this->createDeleteForm($siteAlias);

        return $this->render('sitealias/show.html.twig', array(
            'siteAlias' => $siteAlias,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing siteAlias entity.
     *
     */
    public function editAction(Request $request, SiteAlias $siteAlias)
    {
        $deleteForm = $this->createDeleteForm($siteAlias);
        $editForm = $this->createForm('NCMF\DefaultBundle\Form\SiteAliasType', $siteAlias);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_sitealias_edit', array('id' => $siteAlias->getId()));
        }

        return $this->render('sitealias/edit.html.twig', array(
            'siteAlias' => $siteAlias,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a siteAlias entity.
     *
     */
    public function deleteAction(Request $request, SiteAlias $siteAlias)
    {
        $form = $this->createDeleteForm($siteAlias);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($siteAlias);
            $em->flush($siteAlias);
        }

        return $this->redirectToRoute('admin_sitealias_index');
    }

    /**
     * Creates a form to delete a siteAlias entity.
     *
     * @param SiteAlias $siteAlias The siteAlias entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(SiteAlias $siteAlias)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_sitealias_delete', array('id' => $siteAlias->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
