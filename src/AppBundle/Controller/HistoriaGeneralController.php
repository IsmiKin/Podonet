<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class HistoriaGeneralController extends Controller
{
    public function consultarHistoriaGeneralAction($idPaciente)
    {
        return $this->render('AppBundle:HistoriaGeneral:consultarHistoriaGeneral.html.twig', array(
                // ...
            ));    }

    public function editarDatosSemipermanentesAction()
    {
        return $this->render('AppBundle:HistoriaGeneral:editarDatosSemipermanentes.html.twig', array(
                // ...
            ));    }

    public function crearDatosSemipermanentesAction()
    {
        return $this->render('AppBundle:HistoriaGeneral:crearDatosSemipermanentes.html.twig', array(
                // ...
            ));    }

    public function crearAnamnesisAction()
    {
        return $this->render('AppBundle:HistoriaGeneral:crearAnamnesis.html.twig', array(
                // ...
            ));    }

    public function editarAnamnesisAction()
    {
        return $this->render('AppBundle:HistoriaGeneral:editarAnamnesis.html.twig', array(
                // ...
            ));    }

    public function editarDatosPersonalesAction()
    {
        return $this->render('AppBundle:HistoriaGeneral:editarDatosPersonales.html.twig', array(
                // ...
            ));    }

    public function crearDatosPersonalesAction()
    {
        return $this->render('AppBundle:HistoriaGeneral:crearDatosPersonales.html.twig', array(
                // ...
            ));    }

}
