<?php

namespace App\Controller;

use App\Entity\Asignaturas;
use App\Form\AsignaturasType;
use App\Repository\AsignaturasRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/asignaturas')]
class AsignaturasController extends AbstractController
{
    #[Route('/', name: 'app_asignaturas_index', methods: ['GET'])]
    public function index(AsignaturasRepository $asignaturasRepository): Response
    {
        return $this->render('asignaturas/index.html.twig', [
            'asignaturas' => $asignaturasRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_asignaturas_new', methods: ['GET', 'POST'])]
    public function new(Request $request, AsignaturasRepository $asignaturasRepository): Response
    {
        $asignatura = new Asignaturas();
        $form = $this->createForm(AsignaturasType::class, $asignatura);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $asignaturasRepository->save($asignatura, true);

            return $this->redirectToRoute('app_asignaturas_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('asignaturas/new.html.twig', [
            'asignatura' => $asignatura,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_asignaturas_show', methods: ['GET'])]
    public function show(Asignaturas $asignatura): Response
    {
        return $this->render('asignaturas/show.html.twig', [
            'asignatura' => $asignatura,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_asignaturas_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Asignaturas $asignatura, AsignaturasRepository $asignaturasRepository): Response
    {
        $form = $this->createForm(AsignaturasType::class, $asignatura);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $asignaturasRepository->save($asignatura, true);

            return $this->redirectToRoute('app_asignaturas_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('asignaturas/edit.html.twig', [
            'asignatura' => $asignatura,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_asignaturas_delete', methods: ['POST'])]
    public function delete(Request $request, Asignaturas $asignatura, AsignaturasRepository $asignaturasRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$asignatura->getId(), $request->request->get('_token'))) {
            $asignaturasRepository->remove($asignatura, true);
        }

        return $this->redirectToRoute('app_asignaturas_index', [], Response::HTTP_SEE_OTHER);
    }
}
