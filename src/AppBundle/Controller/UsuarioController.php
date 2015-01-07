<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use JMS\Serializer\SerializerBuilder as Serializer;
use Symfony\Component\HttpFoundation\JsonResponse;

class UsuarioController extends Controller
{
    public function perfilUsuarioAction()
    {
        return $this->render('Usuario/perfilUsuario.html.twig');
    }

    public function editarPerfilAction()
    {
        return $this->render('Usuario/editarPerfil.html.twig', array(
                // ...
            ));    }

    public function contactoAdministradorAction(Request $request)
    {

        if($request->getMethod()=="POST"){




            $serializer = Serializer::create()->build();
            //$data = $serializer ->serialize($gabinete, 'json');
            $mensaje = "hola";
            $codigo_error ="0";

            $datosRespuesta = array("mensaje" =>$mensaje, "codigo_error" =>$codigo_error);
            return new JsonResponse($datosRespuesta);
        }else{
            return $this->render('Usuario/contactoAdministrador.html.twig', array(

            ));
        }

    }

    public function ayudaUsuarioAction()
    {
        return $this->render('Usuario/ayudaUsuario.html.twig', array(
                // ...
            ));    }

}
