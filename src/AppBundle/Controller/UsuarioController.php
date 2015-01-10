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
        $usuario = $this->get('security.context')->getToken()->getUser();
        $formEditarDP = $this->createForm(new UsuarioType(), $usuario);

        return $this->render('Usuario/perfilUsuario.html.twig', array(
            'formEditarDP' => $formEditarDP->createView()
        ));
    }

    public function editarPerfilAction()
    {
        $em = $this->getDoctrine()->getManager();
        $usuario = $this->get('security.context')->getToken()->getUser();
//        $usuario = $this->getUser();
        $usuario = $em->getRepository('AppBundle:Usuario')->find($usuario->getId());

        $formEditar = $this->createForm(new UsuarioType(),$usuario);
        $request = $this->get('request');
        $mensaje = "TESTING";
        if ($request->isMethod('POST')) {
            $mensaje = "POST";

            $formEditar->handleRequest($request);
            if($formEditar->isValid() && $formEditar->isSubmitted())
            {
                $em->persist($usuario);
                $em->flush();

                $mensaje = "El usuario con id ".$usuario->getId()." ha actualizado su perfil correctamente";

                // Creamos el log
                $this->procesarLog("Usuario",$mensaje,null);

                return $this->redirect($this->generateUrl('perfil_usuario'));
            }

        }

        //Nunca se debería llegar aquí
        return $this->render('Usuario/editarPerfil.html.twig', array(
                // ...
            ));
    }

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

            $mensaje = "Todo ha ido correcto!";
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
