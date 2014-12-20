<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PacienteController extends Controller
{
    public function dashboardPacienteAction($id)
    {
        return $this->render('AppBundle:Paciente:dashboardPaciente.html.twig', array(
                // ...
            ));    }

    public function busquedaPacienteAction()
    {
        return $this->render('AppBundle:Paciente:busquedaPaciente.html.twig', array(
                // ...
            ));    }

    public function crearPacienteAction()
    {
        return $this->render('AppBundle:Paciente:crearPaciente.html.twig', array(
                // ...
            ));    }

    public function consultarHistoriaComplementariaAction($idPaciente)
    {
        return $this->render('AppBundle:Paciente:consultarHistoriaComplementaria.html.twig', array(
                // ...
            ));    }

    public function crearHistoriaComplementariaAction()
    {
        return $this->render('AppBundle:Paciente:crearHistoriaComplementaria.html.twig', array(
                // ...
            ));    }

    public function editarHistoriaComplementariaAction()
    {
        return $this->render('AppBundle:Paciente:editarHistoriaComplementaria.html.twig', array(
                // ...
            ));    }

    public function eliminarHistoriaComplementariaAction()
    {
        return $this->render('AppBundle:Paciente:eliminarHistoriaComplementaria.html.twig', array(
                // ...
            ));    }

    public function consultarDiagnosticoAction($idPaciente)
    {
        return $this->render('AppBundle:Paciente:consultarDiagnostico.html.twig', array(
                // ...
            ));    }

    public function crearDiagnosticoAction()
    {
        return $this->render('AppBundle:Paciente:crearDiagnostico.html.twig', array(
                // ...
            ));    }

    public function editarDiagnosticoAction()
    {
        return $this->render('AppBundle:Paciente:editarDiagnostico.html.twig', array(
                // ...
            ));    }

}
