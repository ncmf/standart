<?php

namespace NCMF\DefaultBundle\Controller;

use NCMF\DefaultBundle\Entity\FieldValueText;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Fieldvaluetext controller.
 *
 */
class FieldValueTextController extends Controller
{
    /**
     * Lists all fieldValueText entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $fieldValueTexts = $em->getRepository('NCMFDefaultBundle:FieldValueText')->findAll();

        return $this->render('fieldvaluetext/index.html.twig', array(
            'fieldValueTexts' => $fieldValueTexts,
        ));
    }

    /**
     * Creates a new fieldValueText entity.
     *
     */
    public function newAction(Request $request)
    {
        $fieldValueText = new Fieldvaluetext();
        $form = $this->createForm('NCMF\DefaultBundle\Form\FieldValueTextType', $fieldValueText);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($fieldValueText);
            $em->flush($fieldValueText);

            return $this->redirectToRoute('admin_fieldvaluetext_show', array('id' => $fieldValueText->getId()));
        }

        return $this->render('fieldvaluetext/new.html.twig', array(
            'fieldValueText' => $fieldValueText,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a fieldValueText entity.
     *
     */
    public function showAction(FieldValueText $fieldValueText)
    {
        $deleteForm = $this->createDeleteForm($fieldValueText);

        return $this->render('fieldvaluetext/show.html.twig', array(
            'fieldValueText' => $fieldValueText,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing fieldValueText entity.
     *
     */
    public function editAction(Request $request, FieldValueText $fieldValueText)
    {
        $deleteForm = $this->createDeleteForm($fieldValueText);
        $editForm = $this->createForm('NCMF\DefaultBundle\Form\FieldValueTextType', $fieldValueText);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_fieldvaluetext_edit', array('id' => $fieldValueText->getId()));
        }

        return $this->render('fieldvaluetext/edit.html.twig', array(
            'fieldValueText' => $fieldValueText,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a fieldValueText entity.
     *
     */
    public function deleteAction(Request $request, FieldValueText $fieldValueText)
    {
        $form = $this->createDeleteForm($fieldValueText);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($fieldValueText);
            $em->flush($fieldValueText);
        }

        return $this->redirectToRoute('admin_fieldvaluetext_index');
    }

    /**
     * Creates a form to delete a fieldValueText entity.
     *
     * @param FieldValueText $fieldValueText The fieldValueText entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(FieldValueText $fieldValueText)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_fieldvaluetext_delete', array('id' => $fieldValueText->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
