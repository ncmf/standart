<?php

namespace NCMF\DefaultBundle\Controller;

use NCMF\DefaultBundle\Entity\Object;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Object controller.
 *
 */
class ObjectController extends Controller
{
    /**
     * Lists all object entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $objects = $em->getRepository('NCMFDefaultBundle:Object')->findAll();

        return $this->render('object/index.html.twig', array(
            'objects' => $objects,
        ));
    }

    /**
     * Creates a new object entity.
     *
     */
    public function newAction(Request $request)
    {
        $object = new Object();
        $form = $this->createForm('NCMF\DefaultBundle\Form\ObjectType', $object);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($object);
            $em->flush($object);

            return $this->redirectToRoute('admin_object_show', array('id' => $object->getId()));
        }

        return $this->render('object/new.html.twig', array(
            'object' => $object,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a object entity.
     *
     */
    public function showAction(Object $object)
    {
        $deleteForm = $this->createDeleteForm($object);

        return $this->render('object/show.html.twig', array(
            'object' => $object,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing object entity.
     *
     */
    public function editAction(Request $request, Object $object)
    {
        $deleteForm = $this->createDeleteForm($object);
        $editForm = $this->createForm('NCMF\DefaultBundle\Form\ObjectType', $object);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_object_edit', array('id' => $object->getId()));
        }

        return $this->render('object/edit.html.twig', array(
            'object' => $object,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a object entity.
     *
     */
    public function deleteAction(Request $request, Object $object)
    {
        $form = $this->createDeleteForm($object);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($object);
            $em->flush($object);
        }

        return $this->redirectToRoute('admin_object_index');
    }

    /**
     * Creates a form to delete a object entity.
     *
     * @param Object $object The object entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Object $object)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_object_delete', array('id' => $object->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
