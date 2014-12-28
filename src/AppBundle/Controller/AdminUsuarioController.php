<?php

namespace AppBundle\Controller;

use Proxies\__CG__\AppBundle\Entity\Usuario;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Entity\Log;

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
        $repository = $this->getDoctrine()
            ->getRepository('AppBundle:Usuario');

        $usuario = $repository->findOneBy(array(
            'id' => $idUsuario));

        return $this->render('AdminUsuario/editarUsuario.html.twig', array(
            'usuario' => $usuario
        ));    }

    public function habilitarUsuarioAction()
    {
        return $this->render('AdminUsuario/habilitarUsuario.html.twig', array(
                // ...
            ));    }

    public function administrarLogsAction()
    {
        return $this->render('AdminUsuario/administrarLogs.html.twig', array(
                // ...
            ));    }

    public function consultarLogAction($idLog){
        return null;
    }


}
