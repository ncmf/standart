<?php

namespace NCMF\DefaultBundle\Controller;

use NCMF\DefaultBundle\Entity\ObjectField;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Objectfield controller.
 *
 */
class ObjectFieldController extends Controller
{
    /**
     * Lists all objectField entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $objectFields = $em->getRepository('NCMFDefaultBundle:ObjectField')->findAll();

        return $this->render('objectfield/index.html.twig', array(
            'objectFields' => $objectFields,
        ));
    }

    /**
     * Creates a new objectField entity.
     *
     */
    public function newAction(Request $request)
    {
        $objectField = new Objectfield();
        $form = $this->createForm('NCMF\DefaultBundle\Form\ObjectFieldType', $objectField);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($objectField);
            $em->flush($objectField);

            return $this->redirectToRoute('admin_objectfield_show', array('id' => $objectField->getId()));
        }

        return $this->render('objectfield/new.html.twig', array(
            'objectField' => $objectField,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a objectField entity.
     *
     */
    public function showAction(ObjectField $objectField)
    {
        $deleteForm = $this->createDeleteForm($objectField);

        return $this->render('objectfield/show.html.twig', array(
            'objectField' => $objectField,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing objectField entity.
     *
     */
    public function editAction(Request $request, ObjectField $objectField)
    {
        $deleteForm = $this->createDeleteForm($objectField);
        $editForm = $this->createForm('NCMF\DefaultBundle\Form\ObjectFieldType', $objectField);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_objectfield_edit', array('id' => $objectField->getId()));
        }

        return $this->render('objectfield/edit.html.twig', array(
            'objectField' => $objectField,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a objectField entity.
     *
     */
    public function deleteAction(Request $request, ObjectField $objectField)
    {
        $form = $this->createDeleteForm($objectField);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($objectField);
            $em->flush($objectField);
        }

        return $this->redirectToRoute('admin_objectfield_index');
    }

    /**
     * Creates a form to delete a objectField entity.
     *
     * @param ObjectField $objectField The objectField entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(ObjectField $objectField)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_objectfield_delete', array('id' => $objectField->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
