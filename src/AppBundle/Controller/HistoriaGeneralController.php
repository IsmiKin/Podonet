<?php

namespace AppBundle\Controller;

use AppBundle\Entity\DatosAfeccionesDermicas;
use AppBundle\Entity\DatosAnamnesis;
use AppBundle\Entity\DatosOnicopatis;
use AppBundle\Entity\DatosSemipermanentes;
use AppBundle\Entity\Paciente;
use AppBundle\Entity\DatosPersonales;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use JMS\Serializer\SerializerBuilder as Serializer;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

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
        $pacienteCompleto['DatosSemipermanentes'] = $repoDSP->findBy(array('paciente' => $paciente), array('fecha' => 'DESC'));

        $anamnesis =  $repoAnamnesis->findBy(array('paciente' => $paciente, 'estado' => 'Visible'), array('fecha' => 'DESC'));
        $pacienteCompleto['Anamnesis'] = $anamnesis;

        // Si tiene algun anamnesis, sacamos el resto de datos
        if($anamnesis){
            $datosAD = $repoDAD->getBySomeAnamnesis($anamnesis);
            $datosA = $repoDA->getBySomeAnamnesis($anamnesis);
            $datosO = $repoDO->getBySomeAnamnesis($anamnesis);
        }else{
            $datosAD = null;
            $datosA = null;
            $datosO = null;
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

    public function editarDatosSemipermanentesAction(Request $request)
    {
        if($request->isMethod("POST")){

            $params = array();
            $content = $this->get("request")->getContent();
            if (!empty($content))  $params = json_decode($content, true); // 2nd param to get as array

            $em = $this->getDoctrine()->getManager();

            $repoDSP = $this->getDoctrine()->getRepository('AppBundle:DatosSemipermanentes');
            $dsp = $repoDSP->find(intval($params['iddsp']));

            $this->handleRequestManualDSP($dsp,$params);
            $em->flush();

            $respuesta = array('mensaje' => 'Todo OK', 'codigo_error'=>0);
            return new JsonResponse($respuesta);
        }

    }

    public function crearDatosSemipermanentesAction(Request $request)
    {
        if($request->isMethod("POST")){

            $params = array();
            $content = $this->get("request")->getContent();
            if (!empty($content))  $params = json_decode($content, true); // 2nd param to get as array

            $em = $this->getDoctrine()->getManager();

            $idpaciente = $params["idpaciente"];
            $repoPaciente = $this->getDoctrine()->getRepository('AppBundle:Paciente');
            $paciente = $repoPaciente->find(intval($idpaciente));

            $nuevoDSP = new DatosSemipermanentes();

            $this->handleRequestManualDSP($nuevoDSP ,$params);

            $nuevoDSP->setUsuario($this->getUser());
            $nuevoDSP->setPaciente($paciente);

            $em->persist($nuevoDSP);
            $em->flush();

            $serializer = Serializer::create()->build();
            $dspJSON = $serializer ->serialize($nuevoDSP, 'json');

            $respuesta = array('mensaje' => 'Todo OK', 'codigo_error'=>0, 'nuevodsp' => $dspJSON );
            return new JsonResponse($respuesta);
        }
    }

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

    public function editarDatosPersonalesAction(Request $request)
    {
            if($request->isMethod("POST")){

                $params = array();
                $content = $this->get("request")->getContent();
                if (!empty($content))  $params = json_decode($content, true); // 2nd param to get as array

                $em = $this->getDoctrine()->getManager();

                $idpaciente = $params["idpaciente"];
                $repoDP = $this->getDoctrine()->getRepository('AppBundle:DatosPersonales');
                $repoPaciente = $this->getDoctrine()->getRepository('AppBundle:Paciente');

                $paciente = $repoPaciente->find(intval($idpaciente));
                $dp = $repoDP->findOneBy(array('paciente'=>$paciente));

                $nuevo = false;

                if($dp==null){
                    $nuevo =true;
                    $dp = new DatosPersonales();
                    $dp->setPaciente($paciente);
                }

                $this->handleRequestManualDP($dp,$paciente,$params);

                if($nuevo) $em->persist($dp);

                $em->flush();

                $respuesta = array('mensaje' => 'Todo OK', 'codigo_error'=>0);
                return new JsonResponse($respuesta);
            }

    }

    public function crearDatosPersonalesAction()
    {
        return $this->render('HistoriaGeneral/crearDatosPersonales.html.twig', array(
                // ...
            ));    }

    private function handleRequestManualDP(&$dp,$paciente, $params){
        $paciente->setNombre($params['nombre']);
        $paciente->setApellidos($params['apellidos']);
        $dp->setEmail($params["email"]);
        $dp->setTelefono($params["telefono"]);
        $dp->setNIF($params["nif"]);
        $dp->setDomicilio($params["domicilio"]);
        $dp->setCodigoPostal($params["codigopostal"]);
        $dp->setFechaNacimiento(new \DateTime($params["fxNacimiento"]));
        $dp->setLocalidad($params["localidad"]);
        $dp->setSexo($params["sexo"]);
        $dp->setPais($params["pais"]);
        $dp->setProvincia($params["provincia"]);
    }

    private function handleRequestManualDSP(&$dsp,$params){
        $dsp->setMedicacion($params['medicacion']);
        $dsp->setAlergias($params['alergias']);
        $dsp->setDescripcion($params['descripcion']);
        $dsp->setTalla(floatval($params['talla']));
        $dsp->setPeso(floatval($params['peso']));
        $dsp->setPieDominante($params['piedominante']);
        $dsp->setFumador($params['fumador']);
        $dsp->setBebedor($params['bebedor']);
        $dsp->setAnestesiadoAnteriormente($params['anestesiado_anteriormente']);
        $dsp->setIntervencionQuirurgica($params['intervencion_quirurgica']);
        $dsp->setHta($params['hta']);
        $dsp->setDiabetico($params['diabetico']);
    }

}
