<?php

namespace AppBundle\Controller;

use AppBundle\Entity\HistoriaComplementaria;
use AppBundle\Entity\Patologia;
use AppBundle\Entity\PatologiaPorDiagnostico;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use JMS\Serializer\SerializerBuilder as Serializer;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\Diagnostico;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Filesystem\Exception\IOExceptionInterface;


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

        $form->handleRequest($request);

        if($request->get("idpaciente")!=null){
            $codigo="hay paciente!";
            $repoPaciente = $this->getDoctrine()->getRepository('AppBundle:Paciente');
            $paciente = $repoPaciente->find($idPaciente);
            $document->setPaciente($paciente);
            $document->setUsuario($this->getUser());
        }

        if ($form->isValid() && $request->isMethod('POST')) {
            $document->upload();
            $em = $this->getDoctrine()->getManager();
            $em->persist($document);
            $em->flush();
            $codigo = "TODO OK";
        }else{
            $codigo = "ERROR EN EL FORM!";
        }

        $historiasc = $repository->findBy(array('paciente' => $idPaciente));

        return $this->render('Paciente/consultarHistoriaComplementaria.html.twig', array(
                'historiasc' => $historiasc, 'form'=> $form->createView(), 'paciente'=>$idPaciente
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
            ld($form);
            $document->upload();
            $em = $this->getDoctrine()->getManager();
            $em->persist($document);
            $em->flush();
            $codigo = "TODO OK";
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
            echo "An error occurred while creating your directory at ".$e->getPath();
        }

        return $this->redirect($this->generateUrl('consultar_historia_complementaria',array('idPaciente'=>$idPaciente)));
    }

    public function consultarDiagnosticoAction($idPaciente)
    {
        $repository = $this->getDoctrine()
            ->getRepository('AppBundle:Paciente');

        $paciente= $repository->find($idPaciente);

        $repository = $this->getDoctrine()
            ->getRepository('AppBundle:Diagnostico');

        $diagnostico= $repository->findOneBy(
            array('paciente' => $idPaciente),
            array('fecha' => 'DESC')
        );

        if($paciente==null)
        {
            //Deberia ir a un 404
            return $this->render('Paciente/editarDiagnostico.html.twig', array(
            ));
        }

        return $this->render('Paciente/consultarDiagnostico.html.twig', array(
            'paciente' => $paciente,
            'diagnostico' => $diagnostico
            ));    }

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
        $diagnostico->setUsuario($this->getUser());
        $em->persist($diagnostico);
        $em->flush();

        $mensaje = "Se ha actualizado el diagnostico con id ".$diagnostico->getIdDiagnostico()." del paciente: ".$paciente->getIdPaciente().". correctamente";
        $codigo_error = 0;

        // Creamos el log
        $em->getRepository('AppBundle:Log')->procesarLogAgenda("Diagnostico",$mensaje,null,$this->getUser());

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

        ld($patologiasEliminadas);
        if ($patologiasEliminadas!="false")
        {
            foreach($patologiasEliminadas as $pat)
            {
                $patologia = $em->getRepository('AppBundle:Patologia')->findOneBy(array(
                    'nombre' => $pat['nombre']));
                ld($patologia);
                $patPorDiag = $em->getRepository('AppBundle:PatologiaPorDiagnostico')->findOneBy(array(
                    'Diagnostico_idDiagnostico' => intval($idDiagnostico),
                    'Patologia_idPatologia' => $patologia->getIdPatologia()
                ));
                ld($patPorDiag);
                $em->remove($patPorDiag);
            }
        }
        if ($patologias!="false")
        {
            foreach($patologias as $pat)
            {
                $patologia = $em->getRepository('AppBundle:Patologia')->findOneBy(array(
                    'nombre' => $pat['nombre']));

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
        $em->getRepository('AppBundle:Log')->procesarLogAgenda("Diagnostico",$mensaje,null,$this->getUser());

        $serializer = Serializer::create()->build();
        $data = $serializer ->serialize($diagnostico, 'json');

        $datosRespuesta = array("mensaje" =>$mensaje, "codigo_error" =>$codigo_error, "diagnostico"=>$data) ;
        return new JsonResponse($datosRespuesta);

    }

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

}
