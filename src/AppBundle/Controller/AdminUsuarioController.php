<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AdminUsuarioController extends Controller
{
    public function administrarUsuariosAction()
    {
        return $this->render('AppBundle:AdminUsuario:administrarUsuarios.html.twig', array(
                // ...
            ));    }

    public function consultarUsuarioAction($idUsuario)
    {
        return $this->render('AppBundle:AdminUsuario:consultarUsuario.html.twig', array(
                // ...
            ));    }

    public function crearUsuarioAction()
    {
        return $this->render('AppBundle:AdminUsuario:crearUsuario.html.twig', array(
                // ...
            ));    }

    public function editarUsuarioAction()
    {
        return $this->render('AppBundle:AdminUsuario:editarUsuario.html.twig', array(
                // ...
            ));    }

    public function habilitarUsuarioAction()
    {
        return $this->render('AppBundle:AdminUsuario:habilitarUsuario.html.twig', array(
                // ...
            ));    }

    public function administrarLogsAction()
    {
        return $this->render('AppBundle:AdminUsuario:administrarLogs.html.twig', array(
                // ...
            ));    }

}
