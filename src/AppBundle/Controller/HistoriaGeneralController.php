<?php

namespace AppBundle\Controller;

use AppBundle\Entity\DatosAfeccionesDermicas;
use AppBundle\Entity\DatosOnicopatis;
use Proxies\__CG__\AppBundle\Entity\DatosAnamnesis;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use JMS\Serializer\SerializerBuilder as Serializer;

class HistoriaGeneralController extends Controller
{
    public function consultarHistoriaGeneralAction($idPaciente)
    {
        $pacienteCompleto = array();

        $repoPaciente = $this->getDoctrine()->getRepository('AppBundle:Paciente');
        $repoDP = $this->getDoctrine()->getRepository('AppBundle:DatosPersonales');
        $repoDSP = $this->getDoctrine()->getRepository('AppBundle:DatosSemipermanentes');
        $repoAnamnesis = $this->getDoctrine()->getRepository('AppBundle:Anamnesis');
        $repoDA = $this->getDoctrine()->getRepository('AppBundle:DatosAnamnesis');
        $repoDAD = $this->getDoctrine()->getRepository('AppBundle:DatosAfeccionesDermicas');
        $repoDO = $this->getDoctrine()->getRepository('AppBundle:DatosOnicopatis');

        $paciente = $repoPaciente->find($idPaciente);

        $pacienteCompleto['Paciente'] = $paciente;
        $pacienteCompleto['DatosPersonales'] = $repoDP->findBy(array('paciente'=>$paciente)) ;
        $pacienteCompleto['DatosSemipermanentes'] = $repoDSP->findBy(array('paciente' => $paciente));

        $anamnesis =  $repoAnamnesis->findBy(array('paciente' => $paciente), array('fecha' => 'DESC'));
        $pacienteCompleto['Anamnesis'] = $anamnesis;

        // Si tiene algun anamnesis, sacamos el resto de datos
        if($anamnesis){
            $datosAD = $repoDAD->getBySomeAnamnesis($anamnesis);
            $datosA = $repoDA->getBySomeAnamnesis($anamnesis);
            $datosO = $repoDO->getBySomeAnamnesis($anamnesis);
        }

        // Revisar esta parte

        if(!$datosAD) $datosAD = new DatosAfeccionesDermicas();
        if(!$datosA) $datosA = new DatosAnamnesis();
        if(!$datosO) $datosO = new DatosOnicopatis();

        $pacienteCompleto['DatosAD'] = $datosAD;
        $pacienteCompleto['DatosA'] = $datosA;
        $pacienteCompleto['DatosO'] = $datosO;

        $serializer = Serializer::create()->build();
        $pacienteJSON = $serializer ->serialize($pacienteCompleto, 'json');

        return $this->render('HistoriaGeneral/consultarHistoriaGeneral.html.twig', array(
                'paciente'=>$paciente, 'pacienteJSON' => $pacienteJSON
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
