<?php

namespace AppBundle\Controller;

use AppBundle\Form\UsuarioType;
use AppBundle\Entity\Usuario;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Entity\Log;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class AdminUsuarioController extends Controller
{
    public function administrarUsuariosAction()
    {

        $em = $this->getDoctrine()->getManager();
        $usuarios = $em->getRepository('AppBundle:Usuario')
            ->findAllButLD();

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

    public function crearUsuarioAction()
    {
        $mensaje = "Administrando usuarios";
        $usuario = new Usuario();
        $request = $this->get("request");
        $formCrear = $this->createForm(new UsuarioType(), $usuario);

        if ($request->isMethod('POST')) {
            $formCrear->handleRequest($request); // Maldito seas Puche!

            if ($formCrear->isSubmitted() && $formCrear->isValid()) {

                $usuario->setEstado("Activo");
                $usuario->setEnabled(true);

                $rol = $request->get("rol");
                $usuario->addRole($rol);

                $em = $this->getDoctrine()->getManager();
                $em->persist($usuario);
                $em->flush();
                $mensaje = "Se ha insertado el usuario ".$usuario->getNombre();
            }else{
                $mensaje = "Ha ocurrido un error al validar el formulario del usuario"." errores:".$formCrear->getErrorsAsString();
            }
            // Creamos el log
            $this->procesarLog("Usuario",$mensaje,null);

            return $this->redirect($this->generateUrl('administrar_usuarios'));
        }
        return $this->render('AdminUsuario/crearUsuario.html.twig', array(
            'formCrear' => $formCrear->createView(), 'mensaje' => $mensaje
            ));
    }

    public function editarUsuarioAction($idUsuario)
    {
        $em = $this->getDoctrine()->getManager();
        $usuario = $em->getRepository('AppBundle:Usuario')->find($idUsuario);

        $formEditar = $this->createForm(new UsuarioType(),$usuario);
        $request = $this->get('request');
        $mensaje = "TESTING";
        if ($request->isMethod('POST')) {
            $mensaje = "POST";

            $formEditar->handleRequest($request);
            if($formEditar->isValid() && $formEditar->isSubmitted())
            {
                $rol = $request->get("rol");
                $usuario->addRole($rol);
                $em->persist($usuario);
                $em->flush();

                $mensaje = "Se ha actualizado el perfil del usuario con id ".$idUsuario." correctamente";

                // Creamos el log
                $this->procesarLog("Usuario",$mensaje,null);

                return $this->redirect($this->generateUrl('administrar_usuarios'));
            }

        }

        return $this->render('AdminUsuario/editarUsuario.html.twig', array(
            'usuario' => $usuario,
            'formEditar' => $formEditar->createView(),
            'mensajeReturn' => $mensaje
        ));    }

    public function habilitarUsuarioAction(Request $request)
    {

        $idUsuario = $request->get('idusuario');
        $estado = $request->get('estado');

        if($estado=="Inactivo"){  $nuevoEstado = "Activo";  $mensajeaccion="habilitado"; $nuevoenabled=true;}
        else                  {  $nuevoEstado ="Inactivo"; $mensajeaccion="deshabilitado";  $nuevoenabled=false;}

        $em = $this->getDoctrine()->getEntityManager();
        $usuario = $em->getRepository('AppBundle:Usuario')->find($idUsuario);

        if (!$usuario) {
            throw $this->createNotFoundException('No user found for id '.$idUsuario);
        }


        $usuario->setEnabled($nuevoenabled);
        $usuario->setEstado($nuevoEstado);
        $em->flush();

        // Mensaje Log
        $mensaje = "Se ha $mensajeaccion el usuario $idUsuario correctamente";

        // Creamos el log
        $this->procesarLog("Usuario",$mensaje,null);

        $codigo_error = "0";
        $datosRespuesta = array("mensaje" =>$mensaje, "codigo_error" =>$codigo_error, "nuevoestado"=> $nuevoEstado);
        return new JsonResponse($datosRespuesta);

        //return $this->redirect($this->generateUrl('administrar_usuarios'));

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
