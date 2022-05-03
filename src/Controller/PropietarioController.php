<?php

namespace App\Controller;

use App\Entity\Propietario;
use App\Form\PropietarioType;
use App\Repository\PropietarioRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/propietarios')]
class PropietarioController extends AbstractController
{
    #[Route('', name: 'propietario_index')]
    public function index(PropietarioRepository $propietarioRepository): Response
    {
        $propietarios = $propietarioRepository->findAll();

        return $this->render('propietario/index.html.twig', [
            'propietarios' => $propietarios
        ]);
    }

    #[Route('/agregar', name: 'propietario_agregar')]
    public function agregar(Request $request, EntityManagerInterface $em): Response
    {
        $propietario = new Propietario();

        $form = $this->createForm(PropietarioType::class, $propietario);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $propietario = $form->getData();

            $em->persist($propietario);
            $em->flush();

            return $this->redirectToRoute('propietario_index');
        }

        return $this->renderForm('propietario/agregar.html.twig', [
            'form' => $form
        ]);
    }
}
