<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AdminUsuarioController extends Controller
{
    public function administrarUsuariosAction()
    {
        return $this->render('AdminUsuario/administrarUsuarios.html.twig', array(
                // ...
            ));    }

    public function consultarUsuarioAction($idUsuario)
    {
        return $this->render('AdminUsuario/consultarUsuario.html.twig', array(
                // ...
            ));    }

    public function crearUsuarioAction()
    {
        return $this->render('AdminUsuario/crearUsuario.html.twig', array(
                // ...
            ));    }

    public function editarUsuarioAction()
    {
        return $this->render('AdminUsuario/editarUsuario.html.twig', array(
                // ...
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

}
