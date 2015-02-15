<?php

namespace AppBundle\Controller;

use AppBundle\Entity\DatosPersonales;
use AppBundle\Entity\HistoriaComplementaria;
use AppBundle\Entity\Patologia;
use AppBundle\Entity\PatologiaPorDiagnostico;
use AppBundle\Entity\PatologiaPorDiagnosticoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use JMS\Serializer\SerializerBuilder as Serializer;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\Diagnostico;
use AppBundle\Entity\Paciente;
use AppBundle\Form\PacienteType;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Filesystem\Exception\IOExceptionInterface;



class PacienteController extends Controller
{
    public function dashboardPacienteAction($id)
    {
        $repoPaciente = $this->getDoctrine()->getRepository('AppBundle:Paciente');
        $paciente = $repoPaciente->find($id);
        return $this->render('Paciente/dashboardPaciente.html.twig', array(
                'paciente'=>$paciente
            ));
    }

    public function busquedaPacienteAction()
    {
        return $this->render('Paciente/busquedaPaciente.html.twig', array(
                // ...
            ));
    }

    public function crearPacienteAction(Request $request)
    {
        $nombre = $request->get("nombre");
        $apellidos = $request->get("apellidos");

        $em = $this->getDoctrine()->getManager();

        $maximo = $em->createQuery("SELECT MAX(p.Codigo) as Codigo FROM Paciente p ")->getSingleResult();

        $codigo = intval($maximo[0]["Codigo"])+1;

        if( $nombre!=null && $apellidos!=null && $codigo!=null){
            $paciente = new Paciente();
            $paciente->setNombre($nombre);
            $paciente->setApellidos($apellidos);
            $paciente->setCodigo($codigo);

            $em->persist($paciente);
            $em->flush();

            $mensaje ="TODO OK";
            $codigo_error = 0;
            // Creamos el log
            $mensaje = "Se ha creado el paciente".$paciente->getNombre();
            $em->getRepository('AppBundle:Log')->procesarLogPaciente("Diagnostico",$mensaje,null,$this->getUser());
        }else{
            $mensaje = "Se ha creado un paciente nuevo ";
            $codigo_error = 1;
        }

        $datosRespuesta = array("mensaje" =>$mensaje, "codigo_error" =>$codigo_error, 'nuevoid'=>$paciente->getIdPaciente(), 'nombre' => $paciente->getNombre()." ".$paciente->getApellidos()) ;
        return new JsonResponse($datosRespuesta);

    }

    public function nuevoPacienteAction(Request $request){

        $paciente = new Paciente();
        $nombre = $request->get("nombre");
        $apellidos = $request->get("apellidos");
        $codigo = $nombre[0].$this->generateRandomString().$apellidos[strlen($apellidos)-1];
        $mensaje = "Mostrando form";

        if( $nombre!=null && $apellidos!=null && $codigo!=null) {
            $paciente = new Paciente();
            $paciente->setNombre($nombre);
            $paciente->setApellidos($apellidos);
            $paciente->setCodigo($codigo);
            $em = $this->getDoctrine()->getManager();
            $em->persist($paciente);
            $em->flush();

            // Inicializamos sus datos personales
            $datosPersonales = new DatosPersonales();
            $datosPersonales->setPaciente($paciente);
            $em->persist($datosPersonales);
            $em->flush();

            // Creamos el log
            $mensaje = "Se ha creado el paciente".$paciente->getNombre();
            $em->getRepository('AppBundle:Log')->procesarLogPaciente("Diagnostico",$mensaje,null,$this->getUser());

            return $this->redirect($this->generateUrl('dashboard_paciente',array('id'=>$paciente->getIdPaciente())));

        }

        return $this->render('Paciente/crearPaciente.html.twig', array(

        ));

    }

    public function consultarHistoriaComplementariaAction($idPaciente, Request $request)
    {

        $repository = $this->getDoctrine()
            ->getRepository('AppBundle:HistoriaComplementaria');

        $document = new HistoriaComplementaria();

        $form = $this->createFormBuilder($document)
            ->add('Nombre','text',['label'=>'Nombre '])
            ->add('file','file', ['label'=>' '])
            ->add('Descripcion')
            ->getForm();

        $repoPaciente = $this->getDoctrine()->getRepository('AppBundle:Paciente');
        $paciente = $repoPaciente->find($idPaciente);
        $form->handleRequest($request);

        if($request->get("idpaciente")!=null){
            $codigo="hay paciente!";
            $document->setPaciente($paciente);
            $document->setUsuario($this->getUser());
        }

        if ($form->isValid() && $request->isMethod('POST')) {
            $document->upload();
            $em = $this->getDoctrine()->getManager();
            $em->persist($document);
            $em->flush();

            // Creamos el log
            $mensaje = "Se ha subido el fichero".$document->getNombre();
            $em->getRepository('AppBundle:Log')->procesarLogHistoriaComplementaria($mensaje,$paciente,$this->getUser());
        }else{
            $codigo = "ERROR EN EL FORM!";
        }

        $historiasc = $repository->findBy(array('paciente' => $idPaciente));

        return $this->render('Paciente/consultarHistoriaComplementaria.html.twig', array(
                'historiasc' => $historiasc, 'form'=> $form->createView(), 'paciente'=>$paciente
                ,'codigo'=>$codigo
            ));
    }

    public function crearHistoriaComplementariaAction(Request $request)
    {
        $repoPaciente = $this->getDoctrine()->getRepository('AppBundle:Paciente');

        $document = new HistoriaComplementaria();
        $form = $this->createFormBuilder($document)
            ->add('Nombre','text',['label'=>'Nombre '])
            ->add('file','file', ['label'=>' '])
            ->getForm();

        $form->handleRequest($request);
        $document->setUsuario($this->getUser());
        $idPaciente= $request->get("idPaciente");
        $paciente = $repoPaciente->find($idPaciente);
        $document->setPaciente($paciente);

        //if ($form->isValid() && $request->isMethod('POST')) {
        if ($form->isValid() ) {
            $document->upload();
            $em = $this->getDoctrine()->getManager();
            $em->persist($document);
            $em->flush();
            $codigo = "TODO OK";

            // Creamos el log
            $mensaje = "Se ha subido el fichero".$document->getNombre();
            $em->getRepository('AppBundle:Log')->procesarLogHistoriaComplementaria($mensaje,null,$this->getUser());
        }else{
            $codigo = "ERROR EN EL FORM!";
        }

        return $this->redirect($this->generateUrl('consultar_historia_complementaria',array('idPaciente'=>$idPaciente)));
    }

    public function editarHistoriaComplementariaAction()
    {
        return $this->render('Paciente/editarHistoriaComplementaria.html.twig', array(
                // ...
            ));    }

    public function eliminarHistoriaComplementariaAction(Request $request)
    {
        $repoHC = $this->getDoctrine()->getRepository('AppBundle:HistoriaComplementaria');
        $repoPaciente = $this->getDoctrine()->getRepository('AppBundle:Paciente');
        $em = $this->getDoctrine()->getManager();

        $idhc = $request->get("idhc");
        $idPaciente = $request->get("idpaciente");

        // Habria que hacerlo por id.. no por nombre
        $hc =$repoHC->find($idhc);

        if(!$hc){
            throw $this->createNotFoundException('No news found for id ' . $idhc);
        }

        $fs = new Filesystem();

        $rutarchivo= "../web".$hc->getDisplayPath();

        try {
            $fs->remove($rutarchivo);
            $em->remove($hc);
            $em->flush();
        } catch (IOExceptionInterface $e) {
            echo "An error occurred while deleting your directory at ".$e->getPath();
        }


        // Creamos el log
        $mensaje = "Se ha eliminado el fichero ".$rutarchivo;
        $em->getRepository('AppBundle:Log')->procesarLogHistoriaComplementaria($mensaje,$repoPaciente->find($idPaciente) ,$this->getUser());

        return $this->redirect($this->generateUrl('consultar_historia_complementaria',array('idPaciente'=>$idPaciente)));
    }

    public function consultarDiagnosticoAction($idPaciente)
    {
        $listaPatologias = array();

        $repositoryPaciente = $this->getDoctrine()->getRepository('AppBundle:Paciente');

        $paciente= $repositoryPaciente->find($idPaciente);

        $repositoryDiagnostico = $this->getDoctrine()->getRepository('AppBundle:Diagnostico');

        $diagnostico= $repositoryDiagnostico->findOneBy(
            array('paciente' => $idPaciente),
            array('fecha' => 'ASC')
        );

        if (!$diagnostico)
            return $this->redirect($this->generateUrl('nuevo_diagnostico',array(
                'idPaciente' => $idPaciente,
                'paciente' => $paciente,
                'idDiagnostico' => 0
            ))
        );

        $listaDiagnosticos = $repositoryDiagnostico->getDiagnosticoByPacienteArray($paciente);

        $patPorDiag = $this->getDoctrine()->getRepository('AppBundle:PatologiaPorDiagnostico')->findBy(array(
            'idDiagnostico' => $diagnostico->getIdDiagnostico()
        ));

        foreach($patPorDiag as $pXd)
        {
            //Sacamos la patologia desde la tabla MxM
            $patologia= $this->getDoctrine()->getRepository('AppBundle:Patologia')->find($pXd->getIdPatologia());

            array_push($listaPatologias, $patologia);
        }

        if($paciente==null)
        {
            //Deberia ir a un 404
            return $this->render('Paciente/editarDiagnostico.html.twig', array(
            ));
        }

        return $this->render('Paciente/consultarDiagnostico.html.twig', array(
            'paciente' => $paciente,
            'diagnostico' => $diagnostico,
            'patologias' => $listaPatologias,
            'listadiagnosticos' => json_encode($listaDiagnosticos)
            ));
    }

    public function nuevoDiagnosticoAction($idPaciente, $idDiagnostico){
        $repositoryPaciente = $this->getDoctrine()->getRepository('AppBundle:Paciente');

        $paciente= $repositoryPaciente->find($idPaciente);

        return $this->render('Paciente/crearDiagnostico.html.twig', array(
            'idPaciente' => $idPaciente,
            'paciente' => $paciente,
            'idDiagnostico' => $idDiagnostico
        ));
    }

    public function crearDiagnosticoAction()
    {
        $request = $this->get("request");
        $idPaciente = $request->get("idpaciente");

        $em = $this->getDoctrine()->getManager();
        $paciente = $em->getRepository('AppBundle:Paciente')->find($idPaciente);
        $diagnostico = new Diagnostico();
        if (!$paciente || !$diagnostico) {
            throw $this->createNotFoundException('No news found for id ' . $idPaciente);
        }
        $diagnostico->setTratamiento($request->get("tratamiento"));
        $diagnostico->setDiagnostico($request->get("diagnostico"));
        $diagnostico->setEvolucion($request->get("evolucion"));
        $diagnostico->setPaciente($paciente);
        $diagnostico->setFecha(new \DateTime('now'));
        $diagnostico->setUsuario($this->getUser());

        $em->persist($diagnostico);
        $em->flush();
        $patologias = $request->get("patologias");
        if ($patologias!="false")
        {
            foreach($patologias as $pat)
            {
                $patologia = $em->getRepository('AppBundle:Patologia')->findOneBy(array(
                    'nombre' => $pat['nombre']));
                $patPorDiag = new PatologiaPorDiagnostico();
                $patPorDiag->setIdPatologia($patologia->getIdPatologia());
                $patPorDiag->setIdDiagnostico(intval($diagnostico->getIdDiagnostico()));

                $em->persist($patPorDiag);
            }
        }

        $mensaje = "Se ha actualizado el diagnostico con id ".$diagnostico->getIdDiagnostico()." del paciente: ".$paciente->getIdPaciente().". correctamente";
        $codigo_error = 0;

        // Creamos el log
        $em->getRepository('AppBundle:Log')->procesarLogPaciente("Diagnostico",$mensaje,null,$this->getUser());

        $serializer = Serializer::create()->build();
        $data = $serializer ->serialize($diagnostico, 'json');

        $datosRespuesta = array("mensaje" =>$mensaje, "codigo_error" =>$codigo_error, "diagnostico"=>$data) ;
        return new JsonResponse($datosRespuesta);

    }

    public function editarDiagnosticoAction()
    {
        $request = $this->get("request");
        $idPaciente = $request->get("idpaciente");
        $idDiagnostico = $request->get("iddiagnostico");
        $patologias = $request->get("patologias");
        $patologiasEliminadas = $request->get("patologiasEliminadas");


        $em = $this->getDoctrine()->getManager();
        $paciente = $em->getRepository('AppBundle:Paciente')->find($idPaciente);
        $diagnostico = $em->getRepository('AppBundle:Diagnostico')->find($idDiagnostico);
        if (!$paciente || !$diagnostico) {
            throw $this->createNotFoundException('No news found for id ' . $idPaciente);
        }

        $patologiasOriginales = $em->getRepository('AppBundle:PatologiaPorDiagnostico')->findPatByIdDiag($idDiagnostico);

        if ($patologiasEliminadas!="false")
        {
            foreach($patologiasEliminadas as $pat)
            {
                $patologia = $em->getRepository('AppBundle:Patologia')->findOneBy(array(
                    'idPatologia' => $pat['id']));

                $patPorDiag = $em->getRepository('AppBundle:PatologiaPorDiagnostico')->findOneBy(array(
                    'idDiagnostico' => intval($idDiagnostico),
                    'idPatologia' => $patologia->getIdPatologia()
                ));
                $em->remove($patPorDiag);
            }
        }
        if ($patologias!="false")
        {
            foreach($patologias as $pat)
            {
                $patologia = $em->getRepository('AppBundle:Patologia')->findOneBy(array(
                    'nombre' => $pat['nombre']));
                if (in_array($patologia, $patologiasOriginales)) continue;
                $patPorDiag = new PatologiaPorDiagnostico();
                $patPorDiag->setIdPatologia($patologia->getIdPatologia());
                $patPorDiag->setIdDiagnostico(intval($idDiagnostico));

                $em->persist($patPorDiag);
            }
        }


        $diagnostico->setTratamiento($request->get("tratamiento"));
        $diagnostico->setDiagnostico($request->get("diagnostico"));
        $diagnostico->setEvolucion($request->get("evolucion"));
        $diagnostico->setFecha(new \DateTime('now'));
        //$em->persist($diagnostico);
        $em->flush();

        $mensaje = "Se ha actualizado el diagnostico con id ".$diagnostico->getIdDiagnostico()." del paciente: ".$paciente->getIdPaciente().". correctamente";
        $codigo_error = 0;

        // Creamos el log
        $em->getRepository('AppBundle:Log')->procesarLogPaciente("Diagnostico",$mensaje,null,$this->getUser());

        $datosRespuesta = array("mensaje" =>$mensaje, "codigo_error" =>$codigo_error, "diagnostico"=>$diagnostico) ;

        $serializer = Serializer::create()->build();
        $data = $serializer ->serialize($datosRespuesta, 'json');

        $response = new Response($data);
        $response->headers->set('Content-Type:','application/json');
        return $response;

    }

    public function todosPacientesAction(){
        $repository = $this->getDoctrine()
            ->getRepository('AppBundle:Paciente');

        $pacientes= $repository->findAll();

        $salida = array();
        $salida["query"] = "Unit";
        $salida["suggestions"] = array();
        foreach($pacientes as  $paciente){
            array_push($salida["suggestions"],array("value"=>$paciente->getNombre()." ".$paciente->getApellidos(), "data" => $paciente->getIdPaciente() ));
        }

        $serializer = Serializer::create()->build();
        $data = $serializer ->serialize($salida, 'json');

        $response = new Response($data);
        $response->headers->set('Content-Type:','application/json');
        return $response;
    }

    public function filtroPacientesAction(Request $request){
        $repository = $this->getDoctrine()->getRepository('AppBundle:Paciente');

        $filtro = $request->query->get("query");

        //$pacientes= $repository->findAll();
        $query = $repository->createQueryBuilder('p')
            ->where('p.nombre LIKE :nombre')
            ->orWhere('p.apellidos LIKE :apellidos')
            ->setParameter('nombre', '%'.$filtro.'%')
            ->setParameter('apellidos', '%'.$filtro.'%')
            ->getQuery();
        $pacientes = $query->getResult();

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
    public function todasPatologiasAction(Request $request){
        $repository = $this->getDoctrine()
            ->getRepository('AppBundle:Patologia');


        $filtro = $request->query->get("query");

        $query = $repository->createQueryBuilder('p')
            ->where('p.nombre LIKE :nombre')
            ->setParameter('nombre', '%'.$filtro.'%')
            ->getQuery();
        $patologias = $query->getResult();

        $salida = array();
        $salida["query"] = "Unit";
        $salida["suggestions"] = array();
        foreach($patologias as  $patologia){
            array_push($salida["suggestions"],array(
                "value"=>$patologia->getNombre(),
                "id" => $patologia->getIdPatologia()
            //, "dataUsuario" => $patologia->getUsuario()
            ));
        }

        $serializer = Serializer::create()->build();
        $data = $serializer ->serialize($salida, 'json');

        $response = new Response($data);
        $response->headers->set('Content-Type:','application/json');
        return $response;
    }

    // funcion auxiliar.. habria que ponerla en otro sitio
    public function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

}
