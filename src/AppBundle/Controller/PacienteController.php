<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

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
            ));    }

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
        return $this->render('Paciente/consultarDiagnostico.html.twig', array(
                // ...
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

}
