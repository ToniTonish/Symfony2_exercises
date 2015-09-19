<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Entity\Gruppo;
use AppBundle\Form\GruppoType;

/**
 * Gruppo controller.
 *
 * @Route("/gruppo")
 */
class GruppoController extends Controller
{

    /**
     * Lists all Gruppo entities.
     *
     * @Route("/", name="gruppo")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppBundle:Gruppo')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Gruppo entity.
     *
     * @Route("/", name="gruppo_create")
     * @Method("POST")
     * @Template("AppBundle:Gruppo:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Gruppo();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('gruppo_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Gruppo entity.
     *
     * @param Gruppo $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Gruppo $entity)
    {
        $form = $this->createForm(new GruppoType(), $entity, array(
            'action' => $this->generateUrl('gruppo_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Gruppo entity.
     *
     * @Route("/new", name="gruppo_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Gruppo();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Gruppo entity.
     *
     * @Route("/{id}", name="gruppo_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Gruppo')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Gruppo entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Gruppo entity.
     *
     * @Route("/{id}/edit", name="gruppo_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Gruppo')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Gruppo entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
    * Creates a form to edit a Gruppo entity.
    *
    * @param Gruppo $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Gruppo $entity)
    {
        $form = $this->createForm(new GruppoType(), $entity, array(
            'action' => $this->generateUrl('gruppo_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Gruppo entity.
     *
     * @Route("/{id}", name="gruppo_update")
     * @Method("PUT")
     * @Template("AppBundle:Gruppo:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Gruppo')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Gruppo entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('gruppo_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Gruppo entity.
     *
     * @Route("/{id}", name="gruppo_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AppBundle:Gruppo')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Gruppo entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('gruppo'));
    }

    /**
     * Creates a form to delete a Gruppo entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('gruppo_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
