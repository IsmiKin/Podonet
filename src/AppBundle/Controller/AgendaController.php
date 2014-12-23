<?php

namespace AppBundle\Controller;

use AppBundle\Form\GabineteType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use JMS\Serializer\SerializerBuilder as Serializer;
use AppBundle\Entity\Gabinete;
use Symfony\Component\HttpFoundation\Request;

class AgendaController extends Controller
{
    public function agendaPrincipalAction()
    {

        return $this->render('Agenda/agendaPrincipal.html.twig', array(
                // ...
            ));
    }

    public function consultarCitaAction($id)
    {

        $repository = $this->getDoctrine()
            ->getRepository('AppBundle:Cita');

        $cita= $repository->findOneBy(array('idCita' =>$id) );
        $serializer = Serializer::create()->build();
        $data = $serializer ->serialize($cita, 'json');

        $response = new Response($data);
        $response->headers->set('Content-Type:','application/json');
        return $response;
    }

    public function nuevaCitaAction(){
        $repository = $this->getDoctrine()
            ->getRepository('AppBundle:Cita');

        $cita= $repository->findAll();
        $serializer = Serializer::create()->build();
        $data = $serializer ->serialize($cita, 'json');

        $response = new Response($data);
        $response->headers->set('Content-Type:','application/json');
        return $response;
    }

    public function editarCitaAction()
    {
        return $this->render('Agenda/editarCita.html.twig', array(
                // ...
            ));    }

    public function eliminarCitaAction()
    {
        return $this->render('Agenda/eliminarCita.html.twig', array(
                // ...
            ));    }

    public function ajustesAgendaAction(Request $request)
    {

        $gabinete = new Gabinete();
        $form = $this->createForm(new GabineteType(),$gabinete);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($gabinete);
            $em->flush();
        }

        if ($request->isMethod('POST')) {

        }

        $repository = $this->getDoctrine()
            ->getRepository('AppBundle:Gabinete');

        $gabinetes= $repository->findAll();

        return $this->render('Agenda/ajustesAgenda.html.twig', array(
                'gabinetes' => $gabinetes , 'form' => $form->createView()
            ));

    }

    public function crearGabineteAction()
    {
        return $this->render('Agenda/crearGabinete.html.twig', array(
                // ...
            ));    }

    public function editarGabineteAction()
    {
        return $this->render('Agenda/editarGabinete.html.twig', array(
                // ...
            ));    }

    public function habilitarGabineteAction()
    {
        return $this->render('Agenda/habilitarGabinete.html.twig', array(
                // ...
            ));    }

}
