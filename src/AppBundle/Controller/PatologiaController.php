<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Entity\Patologia;
use AppBundle\Form\PatologiaType;


class PatologiaController extends Controller
{


    public function adminPatologiasAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppBundle:Patologia')->findAll();

        return $this->render('Patologia/index.html.twig', array(
            'entities' => $entities,
        ));

    }

    public function createAction(Request $request)
    {
        $entity = new Patologia();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('consultar_patologia', array('id' => $entity->getIdPatologia())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }


    private function createCreateForm(Patologia $entity)
    {
        $form = $this->createForm(new PatologiaType(), $entity, array(
            'action' => $this->generateUrl('patologia_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }


    public function newAction()
    {
        $entity = new Patologia();
        $form   = $this->createCreateForm($entity);

        return $this->render('Patologia/new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }


    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Patologia')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Patologia entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('Patologia/show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));

    }


    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Patologia')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Patologia entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('Patologia/edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }


    private function createEditForm(Patologia $entity)
    {
        $form = $this->createForm(new PatologiaType(), $entity, array(
            'action' => $this->generateUrl('patologia_update', array('id' => $entity->getIdPatologia())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array(
            'label' => 'Confirmar',
            'attr' => array('class' => 'btn btn-success')
        ));

        return $form;
    }

    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Patologia')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Patologia entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('edit_patologia', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AppBundle:Patologia')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Patologia entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('admin_patologia'));
    }


    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('patologia_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array(
                'label' => 'Eliminar',
                'attr' => array('class' => 'btn btn-danger')
            ))
            ->getForm()
        ;
    }
}
