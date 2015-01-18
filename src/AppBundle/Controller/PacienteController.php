<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use JMS\Serializer\SerializerBuilder as Serializer;
use Symfony\Component\HttpFoundation\Response;

class PacienteController extends Controller
{
    public function dashboardPacienteAction($id)
    {
        return $this->render('Paciente/dashboardPaciente.html.twig', array(
                // ...
            ));    }

    public function busquedaPacienteAction()
    {
        return $this->render('Paciente/busquedaPaciente.html.twig', array(
                // ...
            ));
    }

    public function crearPacienteAction()
    {
        return $this->render('Paciente/crearPaciente.html.twig', array(
                // ...
            ));    }

    public function consultarHistoriaComplementariaAction($idPaciente)
    {
        return $this->render('Paciente/consultarHistoriaComplementaria.html.twig', array(
                // ...
            ));    }

    public function crearHistoriaComplementariaAction()
    {
        return $this->render('Paciente/crearHistoriaComplementaria.html.twig', array(
                // ...
            ));    }

    public function editarHistoriaComplementariaAction()
    {
        return $this->render('Paciente/editarHistoriaComplementaria.html.twig', array(
                // ...
            ));    }

    public function eliminarHistoriaComplementariaAction()
    {
        return $this->render('Paciente/eliminarHistoriaComplementaria.html.twig', array(
                // ...
            ));    }

    public function consultarDiagnosticoAction($idPaciente)
    {
        $repository = $this->getDoctrine()
            ->getRepository('AppBundle:Paciente');

        $paciente= $repository->find($idPaciente);

        $repository = $this->getDoctrine()
            ->getRepository('AppBundle:Diagnostico');

        $diagnostico= $repository->findOneBy(array('paciente' => $idPaciente));


        return $this->render('Paciente/consultarDiagnostico.html.twig', array(
            'paciente' => $paciente,
            'diagnostico' => $diagnostico
            ));    }

    public function crearDiagnosticoAction()
    {
        return $this->render('Paciente/crearDiagnostico.html.twig', array(
                // ...
            ));    }

    public function editarDiagnosticoAction()
    {
        return $this->render('Paciente/editarDiagnostico.html.twig', array(
                // ...
            ));    }

    public function todosPacientesAction(){
        $repository = $this->getDoctrine()
            ->getRepository('AppBundle:Paciente');

        $pacientes= $repository->findAll();

        $salida = array();
        $salida["query"] = "Unit";
        $salida["suggestions"] = array();
        foreach($pacientes as  $paciente){
            array_push($salida["suggestions"],array("value"=>$paciente->getNombre(), "data" => $paciente->getIdPaciente() ));
        }

        $serializer = Serializer::create()->build();
        $data = $serializer ->serialize($salida, 'json');

        $response = new Response($data);
        $response->headers->set('Content-Type:','application/json');
        return $response;
    }

    //Devuelve todas las patologías
    public function todasPatologiasAction(){
        $repository = $this->getDoctrine()
            ->getRepository('AppBundle:Patologia');

        $patologias= $repository->findAll();

        $salida = array();
        $salida["query"] = "Unit";
        $salida["suggestions"] = array();
        foreach($patologias as  $patologia){
            array_push($salida["suggestions"],array(
                "value"=>$patologia->getNombre(),
                "dataID" => $patologia->getIdPatologia(),
                "dataUsuario" => $patologia->getUsuario()));
        }

        $serializer = Serializer::create()->build();
        $data = $serializer ->serialize($salida, 'json');

        $response = new Response($data);
        $response->headers->set('Content-Type:','application/json');
        return $response;
    }

}
