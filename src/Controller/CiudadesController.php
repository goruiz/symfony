<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use App\Entity\Ciudades;

use App\Form\CiudadType;

class CiudadesController extends AbstractController
{

    public function index(): Response
    {

        $em = $this->getDoctrine()->getManager();

        $ciudades = $em->getRepository(Ciudades::class)->findAll();

        return $this->render('ciudades/index.html.twig', [
            'entities' => $ciudades 
        ]);
    }


    public function agregar(Request $request): Response
    {

        $em = $this->getDoctrine()->getManager();

        $ciudad = new Ciudades();

        $formCiudad = $this->createForm(CiudadType::class, $ciudad);

        $formCiudad->handleRequest($request);

        if($formCiudad->isSubmitted() && $formCiudad->isValid()){

            $ciudad->setEstado( true );
            
            $em->persist( $ciudad );
            $em->flush();

            return $this->redirectToRoute('ciudades_index');

        }

        return $this->render('ciudades/agregar.html.twig', [
            'formCiudad' => $formCiudad->createView() 
        ]);
    }

    public function modificar(Request $request, $ciudad): Response
    {

        $em = $this->getDoctrine()->getManager();

        $repoCiudad = $em->getRepository(Ciudades::class)->find($ciudad);

        $formCiudad = $this->createForm(CiudadType::class, $repoCiudad);

        $formCiudad->handleRequest($request);

        if($formCiudad->isSubmitted() && $formCiudad->isValid()){

            $em->persist( $repoCiudad );
            $em->flush();

            return $this->redirectToRoute('ciudades_index');

        }

        return $this->render('ciudades/agregar.html.twig', [
            'formCiudad' => $formCiudad->createView() 
        ]);
    }

}
