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

    public function ajustesAgendaAction()
    {

        $gabinete = new Gabinete();
        $form = $this->createForm(new GabineteType(),$gabinete);
        $formEditar = $this->createForm(new GabineteType(),$gabinete);

        $repository = $this->getDoctrine()
            ->getRepository('AppBundle:Gabinete');

        $gabinetes= $repository->findAll();

        return $this->render('Agenda/ajustesAgenda.html.twig', array(
                'gabinetes' => $gabinetes , 'form' => $form->createView(),
                'formEditar' => $formEditar->createView()
            ));

    }

    public function crearGabineteAction(Request $request)
    {
        $gabinete = new Gabinete();
        $form = $this->createForm(new GabineteType(),$gabinete);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            $gabinete->setUsuarioCreador($this->getUser());
            $gabinete->setFechaUltimaModificacion(new \DateTime('now'));
            $em = $this->getDoctrine()->getManager();
            $em->persist($gabinete);
            $em->flush();
            $mensaje = "Se ha insertado correctamente";
            $codigo_error = 0;
        }else{
            $mensaje = "Ha ocurrido un error al validar el formulario";
            $codigo_error = 1;
        }

        $serializer = Serializer::create()->build();
        $data = $serializer ->serialize($gabinete, 'json');

        $datosRespuesta = array("mensaje" =>$mensaje, "codigo_error" =>$codigo_error, "gabinete"=>$data);
        return new JsonResponse($datosRespuesta);

    }

    public function editarGabineteAction(Request $request)
    {

        $idGabinete = $request->get("idGabinete");
        $em = $this->getDoctrine()->getManager();
        $gabinete = $em->getRepository('AppBundle:Gabinete')->find($idGabinete);
        if (!$gabinete) {
            throw $this->createNotFoundException('No news found for id ' . $idGabinete);
        }

        // Recogemos los datos a mano.. (odio esto)

        $gabinete->setTipo($request->get("tipo"));
        $gabinete->setCodigo($request->get("appbundle_gabinete[codigo]"));
        $gabinete->setEstado($request->get("appbundle_gabinete[estado]"));
        $gabinete->setLocalizacion($request->get("appbundle_gabinete[localizacion]"));
        $gabinete->setFechaUltimaModificacion(new \DateTime('now'));
        
        $em->flush();

        $mensaje = "Se ha actualizado correctamente";
        $codigo_error = 0;

        $serializer = Serializer::create()->build();
        $data = $serializer ->serialize($gabinete, 'json');

        $datosRespuesta = array("mensaje" =>$mensaje, "codigo_error" =>$codigo_error, "gabinete"=>$data, "errors" => $form->getErrors() ) ;
        return new JsonResponse($datosRespuesta);

    }

    public function habilitarGabineteAction()
    {

        $request = $this->get('request');

        $id = $request->get('idGabinete');
        $habilitar = $request->get('habilitar');

        if($habilitar=="true")  $nuevoEstado = "Activo";
        else                    $nuevoEstado ="Inactivo";

        $em = $this->getDoctrine()->getEntityManager();
        $gabinete = $em->getRepository('AppBundle:Gabinete')->find($id);

        if (!$gabinete) {
            throw $this->createNotFoundException('No product found for id '.$id);
        }

        $gabinete->setEstado($nuevoEstado);
        $em->flush();

        $mensaje = "Se ha insertado correctamente";
        $codigo_error = 0;

        $datosRespuesta = array("mensaje" =>$mensaje, "codigo_error" =>$codigo_error);
        return new JsonResponse($datosRespuesta);
    }

}
