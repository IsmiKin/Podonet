<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Anamnesis;
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
use Symfony\Component\Validator\Constraints\DateTime;

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

            $mensaje = "Se han modificado los Datos Semipermanentes con el id: ".$dsp->getIdDatosSemipermanentes()." para el paciente ".$dsp->getPaciente()->getIdPaciente;
            // Creamos el log
            $em->getRepository('AppBundle:Log')->procesarLogPaciente("DatosSemipermanentes",$mensaje,$dsp->getPaciente(),$this->getUser());


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

            $mensaje = "Se han creado Datos Semipermanentes con el id: ".$nuevoDSP->getIdDatosSemipermanentes()." para el paciente ".$idpaciente;
            // Creamos el log
            $em->getRepository('AppBundle:Log')->procesarLogPaciente("DatosSemipermanentes",$mensaje,$paciente,$this->getUser());


            $serializer = Serializer::create()->build();
            $dspJSON = $serializer ->serialize($nuevoDSP, 'json');

            $respuesta = array('mensaje' => 'Todo OK', 'codigo_error'=>0, 'nuevodsp' => $dspJSON );
            return new JsonResponse($respuesta);
        }
    }

    public function editarDatosAnamnesisAction(Request $request){

        if($request->isMethod("POST")){

            $params = array();
            $content = $this->get("request")->getContent();
            if (!empty($content))  $params = json_decode($content, true); // 2nd param to get as array

            $em = $this->getDoctrine()->getManager();

            $repoDA = $this->getDoctrine()->getRepository('AppBundle:DatosAnamnesis');
            $da = $repoDA->find(intval($params['idda']));

            $this->handleRequestManualDA($da,$params);
            $em->flush();

            $mensaje = "Se han editado Datos Anamnesis con el id: ".$da->getIdDatosSemipermanentes()." para el paciente ".$da->getAnamnesis()->getPaciente()->getIdPaciente();
            // Creamos el log
            $em->getRepository('AppBundle:Log')->procesarLogPaciente("DatosAnamnesis",$mensaje,$da->getAnamnesis()->getPaciente(),$this->getUser());

            $respuesta = array('mensaje' => 'Todo OK', 'codigo_error'=>0);
            return new JsonResponse($respuesta);
        }

    }

    public function crearDatosAnamnesisAction(Request $request){

        if($request->isMethod("POST")){

            $params = array();
            $content = $this->get("request")->getContent();
            if (!empty($content))  $params = json_decode($content, true); // 2nd param to get as array

            $em = $this->getDoctrine()->getManager();

            $repoAnamnesis = $this->getDoctrine()->getRepository('AppBundle:Anamnesis');


            $anamnesis = $repoAnamnesis->findOneBy(array('fecha'=>new \DateTime('now')));

            $nuevoAnamnesis = false;
            if(!$anamnesis){

                $nuevoAnamnesis = true;
                $repoPaciente = $this->getDoctrine()->getRepository('AppBundle:Paciente');
                $paciente = $repoPaciente->find(intval($params["idpaciente"]));

                $anamnesis = new Anamnesis();
                $anamnesis->setEstado("Visible");
                $anamnesis->setUsuarioCreador($this->getUser());
                $anamnesis->setPaciente($paciente);
            }

            $anamnesis->setUsuarioModificacion($this->getUser());

            $em->persist($anamnesis);
            $em->flush();

            $nuevoDA = new DatosAnamnesis();

            $this->handleRequestManualDA($nuevoDA,$params);

            $nuevoDA->setUsuario($this->getUser());
            $nuevoDA->setAnamnesis($anamnesis);

            $em->persist($nuevoDA);
            $em->flush();

            $serializer = Serializer::create()->build();
            $daJSON = $serializer ->serialize($nuevoDA, 'json');
            $anamnesisJSON = $serializer ->serialize($anamnesis, 'json');

            $mensaje = "Se han creado Datos Anamnesis con el id: ".$nuevoDA->getIdAnamnesis().
                " para el paciente ".$nuevoDA->getAnamnesis()->getPaciente()->getIdPaciente();
            // Creamos el log
            $em->getRepository('AppBundle:Log')->procesarLogPaciente("DatosAnamnesis",$mensaje,$nuevoDA->getAnamnesis()->getPaciente(),$this->getUser());

            $respuesta = array('mensaje' => 'Todo OK', 'codigo_error'=>0, 'nuevoda' => $daJSON);
            if($nuevoAnamnesis) $respuesta['nuevoanamnesis'] = $anamnesisJSON;
            return new JsonResponse($respuesta);
        }
    }

    public function editarDatosOnicopatisAction(Request $request){

        if($request->isMethod("POST")){

            $params = array();
            $content = $this->get("request")->getContent();
            if (!empty($content))  $params = json_decode($content, true); // 2nd param to get as array

            $em = $this->getDoctrine()->getManager();

            $repoDO = $this->getDoctrine()->getRepository('AppBundle:DatosOnicopatis');
            $da = $repoDO->find(intval($params['iddo']));

            $this->handleRequestManualDO($da,$params);
            $em->flush();

            $respuesta = array('mensaje' => 'Todo OK', 'codigo_error'=>0);
            return new JsonResponse($respuesta);
        }

    }

    public function crearDatosOnicopatisAction(Request $request){

        if($request->isMethod("POST")){

            $params = array();
            $content = $this->get("request")->getContent();
            if (!empty($content))  $params = json_decode($content, true); // 2nd param to get as array

            $em = $this->getDoctrine()->getManager();

            $repoAnamnesis = $this->getDoctrine()->getRepository('AppBundle:Anamnesis');

            $anamnesis = $repoAnamnesis->findOneBy(array('fecha'=>new \DateTime('now')));

            $nuevoAnamnesis = false;
            if(!$anamnesis){

                $nuevoAnamnesis = true;
                $repoPaciente = $this->getDoctrine()->getRepository('AppBundle:Paciente');
                $paciente = $repoPaciente->find(intval($params["idpaciente"]));

                $anamnesis = new Anamnesis();
                $anamnesis->setEstado("Visible");
                $anamnesis->setUsuarioCreador($this->getUser());
                $anamnesis->setPaciente($paciente);
            }

            $anamnesis->setUsuarioModificacion($this->getUser());

            $em->persist($anamnesis);
            $em->flush();

            $nuevoDO = new DatosOnicopatis();

            $this->handleRequestManualDO($nuevoDO,$params);

            $nuevoDO->setUsuario($this->getUser());
            $nuevoDO->setAnamnesis($anamnesis);

            $em->persist($nuevoDO);
            $em->flush();

            $serializer = Serializer::create()->build();
            $doJSON = $serializer ->serialize($nuevoDO, 'json');
            $anamnesisJSON = $serializer ->serialize($anamnesis, 'json');

            $respuesta = array('mensaje' => 'Todo OK', 'codigo_error'=>0, 'nuevodo' => $doJSON);
            if($nuevoAnamnesis) $respuesta['nuevoanamnesis'] = $anamnesisJSON;
            return new JsonResponse($respuesta);
        }
    }

    public function editarDatosDermicasAction(Request $request){

        if($request->isMethod("POST")){

            $params = array();
            $content = $this->get("request")->getContent();
            if (!empty($content))  $params = json_decode($content, true); // 2nd param to get as array

            $em = $this->getDoctrine()->getManager();

            $repoDAD = $this->getDoctrine()->getRepository('AppBundle:DatosAfeccionesDermicas');
            $da = $repoDAD->find(intval($params['iddad']));

            $this->handleRequestManualDAD($da,$params);
            $em->flush();

            $respuesta = array('mensaje' => 'Todo OK', 'codigo_error'=>0);
            return new JsonResponse($respuesta);
        }

    }

    public function crearDatosDermicasAction(Request $request){

        if($request->isMethod("POST")){

            $params = array();
            $content = $this->get("request")->getContent();
            if (!empty($content))  $params = json_decode($content, true); // 2nd param to get as array

            $em = $this->getDoctrine()->getManager();

            $repoAnamnesis = $this->getDoctrine()->getRepository('AppBundle:Anamnesis');

            $anamnesis = $repoAnamnesis->findOneBy(array('fecha'=>new \DateTime('now')));

            $nuevoAnamnesis = false;
            if(!$anamnesis){

                $nuevoAnamnesis = true;
                $repoPaciente = $this->getDoctrine()->getRepository('AppBundle:Paciente');
                $paciente = $repoPaciente->find(intval($params["idpaciente"]));

                $anamnesis = new Anamnesis();
                $anamnesis->setEstado("Visible");
                $anamnesis->setUsuarioCreador($this->getUser());
                $anamnesis->setPaciente($paciente);
            }

            $anamnesis->setUsuarioModificacion($this->getUser());

            $em->persist($anamnesis);
            $em->flush();

            $nuevoDAD = new DatosAfeccionesDermicas();

            $this->handleRequestManualDAD($nuevoDAD,$params);

            $nuevoDAD->setUsuario($this->getUser());
            $nuevoDAD->setAnamnesis($anamnesis);

            $em->persist($nuevoDAD);
            $em->flush();

            $serializer = Serializer::create()->build();
            $dadJSON = $serializer ->serialize($nuevoDAD, 'json');
            $anamnesisJSON = $serializer ->serialize($anamnesis, 'json');

            $respuesta = array('mensaje' => 'Todo OK', 'codigo_error'=>0, 'nuevodad' => $dadJSON);
            if($nuevoAnamnesis) $respuesta['nuevoanamnesis'] = $anamnesisJSON;
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

                $mensaje = "Se han creado Datos Personales con el id: ".$dp->getIdDatosPersonales()." para el paciente ".$idpaciente;
                // Creamos el log
                $em->getRepository('AppBundle:Log')->procesarLogPaciente("Datos Personales",$mensaje,$dp->getPaciente(),$this->getUser());


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

    private function handleRequestManualDA(&$da,$params){
        $da->setEstado("Visible");
        $da->setImagenDolor($params['imagenDolor']);
        $da->setImagenDolor2($params['imagenDolor2']);
        $da->setIntensidad(intval($params['intensidad']));
        $da->setTipoDolor($params['tipodolor']);
        $da->setFormulaMetatarsal($params['formulaMetatarsal']);
        $da->setFormulaDigital($params['formulaDigital']);
    }

    private function handleRequestManualDO(&$do,$params){
        $do->setEstado("Visible");
        $do->setImagenOnicopatica($params['imagenOnicopatica']);
    }

    private function handleRequestManualDAD(&$dad,$params){
        $dad->setEstado("Visible");
        $dad->setImagenDermicas($params['imagenDermicas']);
        $dad->setAmpolla($params['ampolla']);
        $dad->setCicatriz($params['cicatriz']);
        $dad->setColoracionDerecho(intval($params['coloracionDerecho']));
        $dad->setColoracionIzquierdo(intval($params['coloracionIzquierdo']));
        $dad->setErosion($params['erosion']);
        $dad->setHeloma($params['heloma']);
        $dad->setHelomaVascular($params['helomaVascular']);
        $dad->setHiperqueratosis($params['hiperqueratosis']);
        $dad->setIPK($params['ipk']);
        $dad->setNevus($params['nevus']);
        $dad->setOtros($params['otros']);
        $dad->setPapiloma($params['papiloma']);
        $dad->setPsoriasis($params['psoriasis']);
        $dad->setPulsoMedioDerecho(intval($params['pulsoMedioDerecho']));
        $dad->setPulsoMedioIzquierdo(intval($params['pulsoMedioIzquierdo']));
        $dad->setTemperaturaPielDerecho(intval($params['temperaturaPielDerecho']));
        $dad->setTemperaturaPielIzquierdo(intval($params['temperaturaPielIzquierdo']));
        $dad->setTumoracion($params['tumoracion']);
        $dad->setUlcera($params['ulcera']);
        $dad->setVesicula($params['vesicula']);
    }

}
