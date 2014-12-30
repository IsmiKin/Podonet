<?php

namespace AppBundle\Controller;

use AppBundle\Form\UsuarioType;
use Proxies\__CG__\AppBundle\Entity\Usuario;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Entity\Log;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Request;

class AdminUsuarioController extends Controller
{
    public function administrarUsuariosAction()
    {

        $usuario = new Usuario();


        $repository = $this->getDoctrine()
            ->getRepository('AppBundle:Usuario');

        $usuarios= $repository->findAll();


        return $this->render('AdminUsuario/administrarUsuarios.html.twig', array(
                'usuarios' => $usuarios
            ));    }

    public function consultarUsuarioAction($idUsuario)
    {
        $repository = $this->getDoctrine()
            ->getRepository('AppBundle:Usuario');

        $usuario = $repository->findOneBy(array(
            'id' => $idUsuario));

        return $this->render('AdminUsuario/consultarUsuario.html.twig', array(
                'usuario' => $usuario
            ));    }

    public function crearUsuarioAction(Request $request)
    {
        $usuario = new Usuario();
        $formCrear = $this->createForm(new UsuarioType());
        $formCrear->handleRequest($request);

        if ($request->isMethod('PUT')) {
            if ($formCrear->isSubmitted() && $formCrear->isValid()) {
                $usuario->setNombre($request->get("nombre"));
                $usuario->setApellidos($request->get("apellidos"));
                $usuario->setTelefono($request->get("telefono"));
                $usuario->setEstado($request->get("estado"));
                $em = $this->getDoctrine()->getManager();
                $em->persist($usuario);
                $em->flush();
                $mensaje = "Se ha insertado el usuario ".$usuario->getNombre();
            }else{
                $mensaje = "Ha ocurrido un error al validar el formulario del usuario";
            }
//            $formCrear->bind($request);

            return $this->administrarUsuariosAction();
        }
        return $this->render('AdminUsuario/crearUsuario.html.twig', array(
            'formCrear' => $formCrear->createView(),
            ));    }

    public function editarUsuarioAction($idUsuario, Request $request)
    {
        $request = $this->get("request");
        $mensaje = "";
        if (in_array($request->getMethod(), array('PUT'))) {
//            Id($request);
            $idUsuario = $this->get('idusuario'); //Guardo el id en data, en el form de edit no envio id en URL

            $em = $this->getDoctrine()->getManager();
            $usuario = $em->getRepository('AppBundle:Usuario')->find($idUsuario);
            if (!$idUsuario) {
                throw $this->createNotFoundException('No news found for id ' . $idUsuario);
            }
            // Recogemos datos
            $usuario->setNombre($request->get("nombre"));
            $usuario->setApellidos($request->get("apellidos"));
            $usuario->setTelefono($request->get("telefono"));
            $usuario->setEstado($request->get("estado"));

            $em->persist($usuario);
            $em->flush();

            $mensaje = "Se ha actualizado el perfil del usuario con id ".$idUsuario." correctamente";

            // Creamos el log
            $this->procesarLog("Usuario",$mensaje,null);
        }
        else{
            $em = $this->getDoctrine()->getManager();
            $usuario = $em->getRepository('AppBundle:Usuario')->find($idUsuario);
            $formEditar = $this->createForm(new UsuarioType(),$usuario);

            $repository = $this->getDoctrine()
                ->getRepository('AppBundle:Usuario');

            $usuario = $repository->findOneBy(array(
                'id' => $idUsuario));
        }



        return $this->render('AdminUsuario/editarUsuario.html.twig', array(
            'usuario' => $usuario,
            'formEditar' => $formEditar->createView(),
            'mensajeReturn' => $mensaje
        ));    }

    public function habilitarUsuarioAction()
    {
        $request = $this->get('request');

        $idUsuario = $request->get('idUsuario');
        $estado = $request->get('estado');

        if($estado=="Inactivo"){  $nuevoEstado = "Activo";  $mensajeaccion="habilitado";}
        else                  {  $nuevoEstado ="Inactivo"; $mensajeaccion="deshabilitado";}

        $em = $this->getDoctrine()->getEntityManager();
        $usuario = $em->getRepository('AppBundle:Usuario')->find($idUsuario);

        if (!$usuario) {
            throw $this->createNotFoundException('No product found for id '.$idUsuario);
        }

        $usuario->setEstado($nuevoEstado);
        $em->flush();

        // Mensaje Log
        $mensaje = "Se ha $mensajeaccion el usuario $idUsuario correctamente";

        // Creamos el log
        $this->procesarLog("Usuario",$mensaje,null);

        return $this->administrarUsuariosAction();

//        return $this->render('AdminUsuario/habilitarUsuario.html.twig', array(
//                // ...
//            ));
    }

    public function administrarLogsAction()
    {
        $request = $this->get("request");
        $fechaInicio = $request->get("fechaInicio");
        $fechaFin = $request->get("fechaFin");
        $repository = $this->getDoctrine()
            ->getRepository('AppBundle:Log');

        $query = $repository->createQueryBuilder('l')
            ->where('l.fecha >= :inicio AND l.fecha <= :fin')
            ->setParameter('inicio', $fechaInicio)
            ->setParameter('fin', $fechaFin)
            ->orderBy('l.fecha', 'ASC')
            ->getQuery();

        $logs= $query->getResult();

        return $this->render('AdminUsuario/administrarLogs.html.twig', array(
                'logs' => $logs
            ));
    }


    public function preAdministrarLogsAction(){
        return $this->render('AdminUsuario/preAdministracionLogs.html.twig', array(
            // ...
        ));
    }


    public function consultarLogAction($idLog){
        $em = $this->getDoctrine()->getManager();
        $log = $em->getRepository('AppBundle:Log')->find($idLog);

        return $this->render('AdminUsuario/consultarLog.html.twig', array(
            'log' => $log
        ));

    }

    private function procesarLog( $Subcategoria, $Descripcion, $Paciente){
        $log = new Log();

        $log->setCategoria("Administracion")
            ->setSubcategoria($Subcategoria)
            ->setDescripcion($Descripcion)
            ->setUsuario($this->getUser())
            ->setFecha(new \DateTime('now'));
        if($Paciente!=null){
            $log->setPaciente($Paciente);
        }

        $em = $this->getDoctrine()->getManager();
        $em->persist($log);
        $em->flush();

    }


}
