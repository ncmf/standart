<?php

namespace NCMF\DefaultBundle\Controller;

use NCMF\DefaultBundle\Entity\Section;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Cache\Adapter\ApcuAdapter;

/**
 * Section controller.
 *
 */
class SectionController extends Controller
{
    /**
     * Lists all section entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $sections = $em->getRepository('NCMFDefaultBundle:Section')->findAll();

        return $this->render('section/index.html.twig', array(
            'sections' => $sections,
        ));
    }

    /**
     * Creates a new section entity.
     *
     */
    public function newAction(Request $request)
    {
        $section = new Section();
        $form = $this->createForm('NCMF\DefaultBundle\Form\SectionType', $section);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($section);
            $em->flush($section);
            $cache = new ApcuAdapter();
            $cache->deleteItem('section__'.$section->getSlug());
            return $this->redirectToRoute('admin_section_show', array('id' => $section->getId()));
        }

        return $this->render('section/new.html.twig', array(
            'section' => $section,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a section entity.
     *
     */
    public function showAction(Section $section)
    {
        $deleteForm = $this->createDeleteForm($section);

        return $this->render('section/show.html.twig', array(
            'section' => $section,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing section entity.
     *
     */
    public function editAction(Request $request, Section $section)
    {
        $deleteForm = $this->createDeleteForm($section);
        $editForm = $this->createForm('NCMF\DefaultBundle\Form\SectionType', $section);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            $cache = new ApcuAdapter();
            $cache->deleteItem('section__'.$section->getSlug());
            return $this->redirectToRoute('admin_section_edit', array('id' => $section->getId()));
        }

        return $this->render('section/edit.html.twig', array(
            'section' => $section,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a section entity.
     *
     */
    public function deleteAction(Request $request, Section $section)
    {
        $form = $this->createDeleteForm($section);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($section);
            $em->flush($section);
        }

        return $this->redirectToRoute('admin_section_index');
    }

    /**
     * Creates a form to delete a section entity.
     *
     * @param Section $section The section entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Section $section)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_section_delete', array('id' => $section->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
