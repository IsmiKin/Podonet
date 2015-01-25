<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class HistoriaGeneralController extends Controller
{
    public function consultarHistoriaGeneralAction($idPaciente)
    {
        $repoPaciente = $this->getDoctrine()->getRepository('AppBundle:Paciente');
        $paciente = $repoPaciente->find($idPaciente);
        return $this->render('HistoriaGeneral/consultarHistoriaGeneral.html.twig', array(
                'paciente'=>$paciente
            ));
    }

    public function editarDatosSemipermanentesAction()
    {
        return $this->render('HistoriaGeneral/editarDatosSemipermanentes.html.twig', array(
                // ...
            ));    }

    public function crearDatosSemipermanentesAction()
    {
        return $this->render('HistoriaGeneral/crearDatosSemipermanentes.html.twig', array(
                // ...
            ));    }

    public function crearAnamnesisAction()
    {
        return $this->render('HistoriaGeneral/crearAnamnesis.html.twig', array(
                // ...
            ));    }

    public function editarAnamnesisAction()
    {
        return $this->render('HistoriaGeneral/editarAnamnesis.html.twig', array(
                // ...
            ));    }

    public function editarDatosPersonalesAction()
    {
        return $this->render('HistoriaGeneral/editarDatosPersonales.html.twig', array(
                // ...
            ));    }

    public function crearDatosPersonalesAction()
    {
        return $this->render('HistoriaGeneral/crearDatosPersonales.html.twig', array(
                // ...
            ));    }

}
