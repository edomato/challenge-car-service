<?php

namespace App\Controller;

use App\Entity\Auto;
use App\Entity\Propietario;
use App\Form\AutoType;
use App\Repository\AutoRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/autos')]
class AutoController extends AbstractController
{
    #[Route('', name: 'auto_index')]
    public function index(AutoRepository $propietarioRepository): Response
    {
        $autos = $propietarioRepository->findAll();

        return $this->render('auto/index.html.twig', [
            'autos' => $autos
        ]);
    }

    #[Route('/agregar', name: 'auto_agregar')]
    public function agregar(Request $request, EntityManagerInterface $em): Response
    {
        $propietarios = $em->getRepository(Propietario::class)->findAll();
        if (empty($propietarios)) {
            $this->addFlash('error', 'No hay propietarios aún');

            return $this->redirectToRoute('auto_index');
        }

        $form = $this->createForm(AutoType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $auto = $form->getData();

            $em->persist($auto);
            $em->flush();

            return $this->redirectToRoute('auto_index');
        }

        return $this->renderForm('auto/agregar.html.twig', [
            'form' => $form
        ]);
    }

    #[Route('/{id}/editar', name: 'auto_editar')]
    public function editar(int $id, EntityManagerInterface $em, Request $request)
    {
        $auto = $em->getRepository(Auto::class)->find($id);
        if (!$auto) {
            $this->addFlash('error', "No existe el auto con el ID {$id}");

            return $this->redirectToRoute('auto_index');
        }

        $form = $this->createForm(AutoType::class, $auto);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($auto);
            $em->flush();

            return $this->redirectToRoute('auto_index');
        }

        return $this->renderForm('auto/editar.html.twig', [
            'form' => $form
        ]);
    }

    #[Route('/{id}/borrar', name: 'auto_borrar')]
    public function borrar(int $id, EntityManagerInterface $em)
    {
        $auto = $em->getRepository(Auto::class)->find($id);
        if (!$auto) {
            $this->addFlash('error', "No existe el auto con el ID {$id}");

            return $this->redirectToRoute('auto_index');
        }

        $em->remove($auto);
        $em->flush();

        return $this->redirectToRoute('auto_index');
    }
}
