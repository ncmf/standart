<?php

namespace NCMF\DefaultBundle\Controller;

use NCMF\DefaultBundle\Entity\FieldType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Fieldtype controller.
 *
 */
class FieldTypeController extends Controller
{
    /**
     * Lists all fieldType entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $fieldTypes = $em->getRepository('NCMFDefaultBundle:FieldType')->findAll();

        return $this->render('fieldtype/index.html.twig', array(
            'fieldTypes' => $fieldTypes,
        ));
    }

    /**
     * Creates a new fieldType entity.
     *
     */
    public function newAction(Request $request)
    {
        $fieldType = new Fieldtype();
        $form = $this->createForm('NCMF\DefaultBundle\Form\FieldTypeType', $fieldType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($fieldType);
            $em->flush();

            return $this->redirectToRoute('admin_fieldtype_show', array('id' => $fieldType->getId()));
        }

        return $this->render('fieldtype/new.html.twig', array(
            'fieldType' => $fieldType,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a fieldType entity.
     *
     */
    public function showAction(FieldType $fieldType)
    {
        $deleteForm = $this->createDeleteForm($fieldType);

        return $this->render('fieldtype/show.html.twig', array(
            'fieldType' => $fieldType,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing fieldType entity.
     *
     */
    public function editAction(Request $request, FieldType $fieldType)
    {
        $deleteForm = $this->createDeleteForm($fieldType);
        $editForm = $this->createForm('NCMF\DefaultBundle\Form\FieldTypeType', $fieldType);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_fieldtype_edit', array('id' => $fieldType->getId()));
        }

        return $this->render('fieldtype/edit.html.twig', array(
            'fieldType' => $fieldType,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a fieldType entity.
     *
     */
    public function deleteAction(Request $request, FieldType $fieldType)
    {
        $form = $this->createDeleteForm($fieldType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($fieldType);
            $em->flush();
        }

        return $this->redirectToRoute('admin_fieldtype_index');
    }

    /**
     * Creates a form to delete a fieldType entity.
     *
     * @param FieldType $fieldType The fieldType entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(FieldType $fieldType)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_fieldtype_delete', array('id' => $fieldType->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
