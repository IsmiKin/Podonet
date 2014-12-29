<?php

namespace AppBundle\Controller;

use AppBundle\Form\UsuarioType;
use Proxies\__CG__\AppBundle\Entity\Usuario;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Entity\Log;
use Symfony\Component\Form\Form;

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

    public function crearUsuarioAction()
    {
        return $this->render('AdminUsuario/crearUsuario.html.twig', array(
                // ...
            ));    }

    public function editarUsuarioAction($idUsuario)
    {

        $em = $this->getDoctrine()->getManager();
        $usuario = $em->getRepository('AppBundle:Usuario')->find($idUsuario);
        $formEditar = $this->createForm(new UsuarioType(),$usuario);

        $repository = $this->getDoctrine()
            ->getRepository('AppBundle:Usuario');

        $usuario = $repository->findOneBy(array(
            'id' => $idUsuario));

        return $this->render('AdminUsuario/editarUsuario.html.twig', array(
            'usuario' => $usuario,
            'formEditar' => $formEditar->createView()
        ));    }

    public function habilitarUsuarioAction()
    {
        return $this->render('AdminUsuario/habilitarUsuario.html.twig', array(
                // ...
            ));    }

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
        return null;
    }


}
