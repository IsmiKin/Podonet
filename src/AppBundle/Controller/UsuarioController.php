<?php

namespace AppBundle\Controller;

use AppBundle\Form\UsuarioType;
use AppBundle\Entity\Usuario;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\HttpFoundation\Request;
use JMS\Serializer\SerializerBuilder as Serializer;
use Symfony\Component\HttpFoundation\JsonResponse;

use AppBundle\Entity\Log;

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

        if($request->isMethod("POST")){

            $codigo_error ="0";
            $usuario = $this->getUser();
            $message = \Swift_Message::newInstance()
                ->setSubject($request->get("asunto"))
                ->setFrom($usuario->getEmail())
                ->setTo('podonet.uma@gmail.com')
                ->setBody(
                    $this->renderView(
                        'General/Email/contactoadministrador.txt.twig',
                        array('fecha' =>new \DateTime('now'),
                            'solicitante' => $usuario->getNombre(),
                            'email_solicitante' => $usuario->getEmail(),
                            'cuerpo' => $request->get("cuerpo"))
                    )
                )
            ;
            $this->get('mailer')->send($message);
            
            $mensaje = "Todo ha ido correcto";
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
