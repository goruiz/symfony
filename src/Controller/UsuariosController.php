<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use App\Entity\Usuarios;
use App\Form\UsuariosType;


class UsuariosController extends AbstractController
{
  
    public function index(): Response
    {
        $em = $this->getDoctrine()->getManager();

        $usuarios = $em->getRepository(Usuarios::class)->findAll();

        return $this->render('usuarios/index.html.twig', [
            'entities' => $usuarios 
        ]);
    }

    public function agregar(Request $request): Response
    {
        $em = $this->getDoctrine()->getManager();

        $usuario = new Usuarios();

        $formUsuario = $this->createForm(UsuariosType::class, $usuario);

        $formUsuario->handleRequest($request);

        if($formUsuario->isSubmitted() && $formUsuario->isValid()){

        
            $em->persist( $usuario );
            $em->flush();

            return $this->redirectToRoute('usuarios_index');

        }

        return $this->render('usuarios/agregar.html.twig', [
            'formUsuarios' => $formUsuario->createView() 
        ]);
    }

    public function modificar(Request $requests,$usuario): Response
    {
        $em = $this->getDoctrine()->getManager();

        $repoUsuario = $em->getRepository(Usuarios::class)->find($usuario);


        $formUsuario = $this->createForm(UsuariosType::class, $repoUsuario);

        $formUsuario->handleRequest($requests);


        if($formUsuario->isSubmitted() && $formUsuario->isValid()){

            $em->persist( $repoUsuario );
            $em->flush();

            return $this->redirectToRoute('usuarios_index');

        }

        return $this->render('usuarios/agregar.html.twig', [
            'formUsuarios' => $formUsuario->createView() 
        ]);
    }
}
