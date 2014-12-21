<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class UsuarioController extends Controller
{
    public function perfilUsuarioAction()
    {
        return $this->render('AppBundle:Usuario/perfilUsuario.html.twig', array(
                // ...
            ));    }

    public function editarPerfilAction()
    {
        return $this->render('AppBundle:Usuario/editarPerfil.html.twig', array(
                // ...
            ));    }

    public function contactoAdministradorAction()
    {
        return $this->render('AppBundle:Usuario/contactoAdministrador.html.twig', array(
                // ...
            ));    }

    public function ayudaUsuarioAction()
    {
        return $this->render('AppBundle:Usuario/ayudaUsuario.html.twig', array(
                // ...
            ));    }

}
