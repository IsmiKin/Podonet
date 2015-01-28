<?php

namespace AppBundle\Controller;

use AppBundle\Form\GabineteType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use JMS\Serializer\SerializerBuilder as Serializer;
use AppBundle\Entity\Gabinete;
use AppBundle\Entity\Cita;
use AppBundle\Entity\Log;
use Symfony\Component\HttpFoundation\Request;

class AgendaController extends Controller
{
    public function agendaPrincipalAction()
    {
        $repository = $this->getDoctrine()->getRepository('AppBundle:Gabinete');

        $gabinetes= $repository->getGabinetesActivos();

        return $this->render('Agenda/nuevaCita.html.twig',array(
            'gabinetes'=> $gabinetes
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
        $repository = $this->getDoctrine()->getRepository('AppBundle:Gabinete');

        $gabinetes= $repository->getGabinetesActivos();

        return $this->render('Agenda/nuevaCita.html.twig',array(
            'gabinetes'=> $gabinetes
        ));
    }

    public function crearCitaAction(Request $request){

        $repoGabinete = $this->getDoctrine()->getRepository('AppBundle:Gabinete');
        $repoPaciente = $this->getDoctrine()->getRepository('AppBundle:Paciente');
        $gabinete = $repoGabinete->find($request->get("idgabineteForm"));
        $paciente = $repoPaciente->find($request->get("idpacienteForm"));

        $nuevaCita = new Cita();
        $nuevaCita->setEstado("Activo");
        $nuevaCita->setGabinete($gabinete);
        $nuevaCita->setPaciente($paciente);
        $nuevaCita->setUsuarioCreador($this->getUser());
        $nuevaCita->setFecha(new \DateTime($request->get("inicioForm")));
        $nuevaCita->setHoraInicio(new \DateTime($request->get("inicioForm")));
        $nuevaCita->setHoraFin(new \DateTime($request->get("finForm")));
        $nuevaCita->setMotivoConsulta($request->get("motivoconsulta"));

        $em = $this->getDoctrine()->getManager();

        try{
            $em->persist($nuevaCita);
            $em->flush();
            $mensaje="OK";
            $codigo_error=0;
        }catch(ORMException $e){
            $mensaje="NO-OK";
            $codigo_error=1;
        }

        $datosRespuesta = array("mensaje" =>$mensaje, "codigo_error" =>$codigo_error);
        return new JsonResponse($datosRespuesta);
    }

    public function editarCitaAction()
    {
        return $this->render('Agenda/editarCita.html.twig', array(
                // ...
            ));
    }

    public function eliminarCitaAction(Request $request)
    {
        $repoCita = $this->getDoctrine()->getRepository('AppBundle:Cita');
        $cita = $repoCita->find($request->get('idcita'));

        $em = $this->getDoctrine()->getManager();
        try{
            $em->remove($cita);
            $em->flush();
            $mensaje="OK";
            $codigo_error=0;
        }catch(ORMException $e){
            $mensaje="NO-OK";
            $codigo_error=1;
        }

        $datosRespuesta = array("mensaje" =>$mensaje, "codigo_error" =>$codigo_error);
        return new JsonResponse($datosRespuesta);
    }

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
        $em = $this->getDoctrine()->getManager();

        if ($form->isSubmitted() && $form->isValid()) {
            $gabinete->setUsuarioCreador($this->getUser());
            $gabinete->setFechaUltimaModificacion(new \DateTime('now'));

            $em->persist($gabinete);
            $em->flush();
            $mensaje = "Se ha insertado el gabinete ".$gabinete->getCodigo();
            $codigo_error = 0;
        }else{
            $mensaje = "Ha ocurrido un error al validar el formulario del gabinete";
            $codigo_error = 1;
        }

        // Creamos el log
        $em->getRepository('AppBundle:Log')->procesarLogAgenda("Gabinete",$mensaje,null,$this->getUser());

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
        $em->getRepository('AppBundle:Log')->procesarLogAgenda("Gabinete",$mensaje,null,$this->getUser());

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
        $em->getRepository('AppBundle:Log')->procesarLogAgenda("Gabinete",$mensaje,null,$this->getUser());

        $datosRespuesta = array("mensaje" =>$mensaje, "codigo_error" =>$codigo_error);
        return new JsonResponse($datosRespuesta);
    }


    public function getCitaByGabineteRangeAction(Request $request){

        $start = $request->query->get('start');
        $end = $request->query->get('end');
        $gabinete = $request->query->get('gabinete');
        $repository = $this->getDoctrine()->getRepository('AppBundle:Cita');
        $query = $repository->createQueryBuilder('c')
            ->where('c.fecha >= :inicio')
            ->andWhere('c.fecha <= :fin')
            ->andWhere('c.estado =:estado')
            ->andWhere('c.gabinete =:gabinete')
            ->setParameter('inicio', $start)
            ->setParameter('fin', $end)
            ->setParameter('estado','Activo')
            ->setParameter('gabinete',$gabinete)
            ->orderBy('c.fecha', 'DESC')
            ->getQuery();

        //$citas= $query->getResult();
        $citasItera = $query->iterate();

        $citas = array();
        foreach( $citasItera as $citita ) {
            array_push($citas,
                array('idCita'=>$citita[0]->getIdCita(), 'motivoconsulta'=>$citita[0]->getMotivoConsulta(),
                      'idGabinete'=>$citita[0]->getGabinete()->getIdGabinete(),
                       'start'=>$citita[0]->getHoraInicio(),'end'=>$citita[0]->getHoraFin(),
                       'Paciente'=>$citita[0]->getPaciente()
                )
            );
        }

        $serializer = Serializer::create()->build();
        $data = $serializer ->serialize($citas, 'json');

        $response = new Response($data);
        $response->headers->set('Content-Type:','application/json');
        return $response;

    }

    public function getCitaTodayAction(Request $request){

        $start = new \DateTime('yesterday');
        $end = new \DateTime('tomorrow');

        $repository = $this->getDoctrine()->getRepository('AppBundle:Cita');
        $query = $repository->createQueryBuilder('c')
            ->where('c.fecha >= :inicio')
            ->andWhere('c.fecha <= :fin')
            ->andWhere('c.estado =:estado')
            ->setParameter('inicio', $start)
            ->setParameter('fin', $end)
            ->setParameter('estado','Activo')
            ->orderBy('c.fecha', 'DESC')
            ->getQuery();

        //$citas= $query->getResult();
        $citasItera = $query->iterate();

        $citas = array();
        foreach( $citasItera as $citita ) {
            array_push($citas,
                array('idCita'=>$citita[0]->getIdCita(), 'motivoconsulta'=>$citita[0]->getMotivoConsulta(),
                    'start'=>$citita[0]->getHoraInicio(),'end'=>$citita[0]->getHoraFin(),
                    'Paciente'=>$citita[0]->getPaciente()
                )
            );
        }

        $serializer = Serializer::create()->build();
        $data = $serializer ->serialize($citas, 'json');

        $response = new Response($data);
        $response->headers->set('Content-Type:','application/json');
        return $response;

    }


}
