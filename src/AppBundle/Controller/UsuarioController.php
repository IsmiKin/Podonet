<?php

namespace AppBundle\Controller;

use AppBundle\Entity\FotoPerfil;
use AppBundle\Form\UsuarioType;
use AppBundle\Entity\Usuario;
use AppBundle\Entity\Document;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\HttpFoundation\Request;
use JMS\Serializer\SerializerBuilder as Serializer;
use Symfony\Component\HttpFoundation\JsonResponse;
use Doctrine\Common\Util\Debug as Doct;


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

        $formEditar = $this->createForm(new UsuarioType(),$usuario);
        $request = $this->get('request');

        if ($request->isMethod('POST')) {

            $formEditar->handleRequest($request);
            if($formEditar->isValid() && $formEditar->isSubmitted())
            {
                $em->flush();

                $mensaje = "El usuario con id ".$usuario->getId()." ha actualizado su perfil correctamente";

                // Creamos el log
                $em->getRepository('AppBundle:Log')->procesarLogAdminUsuarios($mensaje,null,$usuario);

                return $this->redirect($this->generateUrl('perfil_usuario'));
            }else{
                $mensaje = "Ha ocurrido un error al validar el formulario del usuario"." errores:".$formEditar->getErrorsAsString();
            }

        }

        $datosRespuesta = array("mensaje" =>$mensaje);
        return new JsonResponse($datosRespuesta);
        //Nunca se debería llegar aquí
        /*return $this->render('Usuario/editarPerfil.html.twig', array(

            ));*/
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

    public function miFotoAction(Request $request ){

        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository('AppBundle:FotoPerfil');

        //$fotoPerfil = $repo->getFotoPerfil($this->getUser()->getId()); // No se poque
        $fotoPerfil = $repo->findOneBy(array('usuario'=>$this->getUser()));

        $persistir = false;
        if ($fotoPerfil==null) {
            $document = new FotoPerfil();
            $persistir = true;
        }else{
            $document = $fotoPerfil;
        }

        $form = $this->createFormBuilder($document)
            ->add('file','file', ['label'=>' '])
            ->getForm();

        $form->handleRequest($request);
        $document->setUsuario($this->getUser());

        if ($form->isValid() && $request->isMethod('POST')) {

            $document->upload();
            if($persistir)
                $em->persist($document);

            $em->flush();
            $codigo = "TODO OK";
        }else{
            $codigo = "ERROR EN EL FORM!";
        }

        $documentos = $repo->findAll();

        return $this->render('Usuario/miFoto.html.twig', array(
            'form' => $form->createView(), 'documentos' => $documentos, 'codigo'=>$codigo
        ));
    }

}
