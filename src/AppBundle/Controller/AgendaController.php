<?php

namespace AppBundle\Controller;

use AppBundle\Form\GabineteType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use JMS\Serializer\SerializerBuilder as Serializer;
use AppBundle\Entity\Gabinete;
use AppBundle\Entity\Log;
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
            $mensaje = "Se ha insertado el gabinete ".$gabinete->getCodigo();
            $codigo_error = 0;
        }else{
            $mensaje = "Ha ocurrido un error al validar el formulario del gabinete";
            $codigo_error = 1;
        }

        // Creamos el log
        $this->procesarLog("Gabinete",$mensaje,null);

        $serializer = Serializer::create()->build();
        $data = $serializer ->serialize($gabinete, 'json');

        $datosRespuesta = array("mensaje" =>$mensaje, "codigo_error" =>$codigo_error, "gabinete"=>$data);
        return new JsonResponse($datosRespuesta);

    }

    public function editarGabineteAction(Request $request)
    {
        $request = $this->get("request");
        $idGabinete = $request->get("idgabinete");

        $em = $this->getDoctrine()->getManager();
        $gabinete = $em->getRepository('AppBundle:Gabinete')->find($idGabinete);
        if (!$gabinete) {
            throw $this->createNotFoundException('No news found for id ' . $idGabinete);
        }

        // Recogemos los datos a mano.. (odio esto, me quema)
        // Habria que hacer una validacion...
        $gabinete->setTipo($request->get("tipo"));
        $gabinete->setCodigo($request->get("codigo"));
        $gabinete->setEstado($request->get("estado"));
        $gabinete->setLocalizacion($request->get("localizacion"));
        $gabinete->setFechaUltimaModificacion(new \DateTime('now'));
        $em->flush();

        $mensaje = "Se ha actualizado el gabinete con id ".$gabinete->getIdGabinete()." correctamente";
        $codigo_error = 0;

        // Creamos el log
        $this->procesarLog("Gabinete",$mensaje,null);


        $serializer = Serializer::create()->build();
        $data = $serializer ->serialize($gabinete, 'json');

        $datosRespuesta = array("mensaje" =>$mensaje, "codigo_error" =>$codigo_error, "gabinete"=>$data) ;
        return new JsonResponse($datosRespuesta);

    }

    public function habilitarGabineteAction()
    {

        $request = $this->get('request');

        $id = $request->get('idGabinete');
        $habilitar = $request->get('habilitar');

        if($habilitar=="true"){  $nuevoEstado = "Activo";  $mensajeaccion="habilitado";}
        else                  {  $nuevoEstado ="Inactivo"; $mensajeaccion="deshabilitado";}

        $em = $this->getDoctrine()->getEntityManager();
        $gabinete = $em->getRepository('AppBundle:Gabinete')->find($id);

        if (!$gabinete) {
            throw $this->createNotFoundException('No product found for id '.$id);
        }

        $gabinete->setEstado($nuevoEstado);
        $em->flush();

        // Habria que controlar errores..

        $mensaje = "Se ha $mensajeaccion el gabinete $id correctamente";
        $codigo_error = 0;

        // Creamos el log
        $this->procesarLog("Gabinete",$mensaje,null);

        $datosRespuesta = array("mensaje" =>$mensaje, "codigo_error" =>$codigo_error);
        return new JsonResponse($datosRespuesta);
    }

    private function procesarLog( $Subcategoria, $Descripcion, $Paciente){
        $log = new Log();

        $log->setCategoria("Agenda")
            ->setSubcategoria($Subcategoria)
            ->setDescripcion($Descripcion)
            ->setUsuario($this->getUser())
            ->setFecha(new \DateTime('now'));
        if($Paciente!=null){
            $log->setPaciente($Paciente);
        }

        $em = $this->getDoctrine()->getManager();
        $em->persist($log);
        $em->flush();

    }


}
