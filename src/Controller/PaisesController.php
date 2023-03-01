<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use App\Entity\Paises;

use App\Form\PaisType;

class PaisesController extends AbstractController
{
    public function index(): Response
    {

        $em = $this->getDoctrine()->getManager();

        $paises = $em->getRepository(Paises::class)->findAll();

        return $this->render('paises/index.html.twig', [
            'entities' => $paises 
        ]);
    }


    public function agregar(Request $request): Response
    {

        $em = $this->getDoctrine()->getManager();

        $pais = new Paises();

        $formPais = $this->createForm(PaisType::class, $pais);

        $formPais->handleRequest($request);


        if($formPais->isSubmitted() && $formPais->isValid()){

            $pais->setEstado( true );
            $pais->setFechaCreacion( new \DateTime() );

            $em->persist( $pais );
            $em->flush();

            return $this->redirectToRoute('paises_index');

        }

        return $this->render('paises/agregar.html.twig', [
            'formPais' => $formPais->createView() 
        ]);
    }

    public function modificar(Request $request, $pais): Response
    {

        $em = $this->getDoctrine()->getManager();

        $repoPais = $em->getRepository(Paises::class)->find($pais);


        $formPais = $this->createForm(PaisType::class, $repoPais);

        $formPais->handleRequest($request);


        if($formPais->isSubmitted() && $formPais->isValid()){

            $em->persist( $repoPais );
            $em->flush();

            return $this->redirectToRoute('paises_index');

        }

        return $this->render('paises/agregar.html.twig', [
            'formPais' => $formPais->createView() 
        ]);
    }
}
