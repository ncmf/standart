<?php

namespace NCMF\DefaultBundle\Controller;

use NCMF\DefaultBundle\Entity\Instance;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Instance controller.
 *
 */
class InstanceController extends Controller
{
    /**
     * Lists all instance entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $instances = $em->getRepository('NCMFDefaultBundle:Instance')->findAll();

        return $this->render('instance/index.html.twig', array(
            'instances' => $instances,
        ));
    }

    /**
     * Creates a new instance entity.
     *
     */
    public function newAction(Request $request)
    {
        $instance = new Instance();
        $form = $this->createForm('NCMF\DefaultBundle\Form\InstanceType', $instance);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($instance);
            $em->flush($instance);

            return $this->redirectToRoute('admin_instance_show', array('id' => $instance->getId()));
        }

        return $this->render('instance/new.html.twig', array(
            'instance' => $instance,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a instance entity.
     *
     */
    public function showAction(Instance $instance)
    {
        $deleteForm = $this->createDeleteForm($instance);

        return $this->render('instance/show.html.twig', array(
            'instance' => $instance,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing instance entity.
     *
     */
    public function editAction(Request $request, Instance $instance)
    {
        $deleteForm = $this->createDeleteForm($instance);
        $editForm = $this->createForm('NCMF\DefaultBundle\Form\InstanceType', $instance);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_instance_edit', array('id' => $instance->getId()));
        }

        return $this->render('instance/edit.html.twig', array(
            'instance' => $instance,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a instance entity.
     *
     */
    public function deleteAction(Request $request, Instance $instance)
    {
        $form = $this->createDeleteForm($instance);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($instance);
            $em->flush($instance);
        }

        return $this->redirectToRoute('admin_instance_index');
    }

    /**
     * Creates a form to delete a instance entity.
     *
     * @param Instance $instance The instance entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Instance $instance)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_instance_delete', array('id' => $instance->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
