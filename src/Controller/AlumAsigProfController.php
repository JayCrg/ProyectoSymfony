<?php

namespace App\Controller;

use App\Entity\AlumAsigProf;
use App\Form\AlumAsigProfType;
use App\Repository\AlumAsigProfRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/matricula')]
class AlumAsigProfController extends AbstractController
{
    #[Route('/', name: 'app_alum_asig_prof_index', methods: ['GET'])]
    public function index(AlumAsigProfRepository $alumAsigProfRepository): Response
    {
        return $this->render('alum_asig_prof/index.html.twig', [
            'alum_asig_profs' => $alumAsigProfRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_alum_asig_prof_new', methods: ['GET', 'POST'])]
    public function new(Request $request, AlumAsigProfRepository $alumAsigProfRepository): Response
    {
        $alumAsigProf = new AlumAsigProf();
        $form = $this->createForm(AlumAsigProfType::class, $alumAsigProf);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $alumAsigProfRepository->save($alumAsigProf, true);

            return $this->redirectToRoute('app_alum_asig_prof_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('alum_asig_prof/new.html.twig', [
            'alum_asig_prof' => $alumAsigProf,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_alum_asig_prof_show', methods: ['GET'])]
    public function show(AlumAsigProf $alumAsigProf): Response
    {
        return $this->render('alum_asig_prof/show.html.twig', [
            'alum_asig_prof' => $alumAsigProf,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_alum_asig_prof_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, AlumAsigProf $alumAsigProf, AlumAsigProfRepository $alumAsigProfRepository): Response
    {
        $form = $this->createForm(AlumAsigProfType::class, $alumAsigProf);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $alumAsigProfRepository->save($alumAsigProf, true);

            return $this->redirectToRoute('app_alum_asig_prof_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('alum_asig_prof/edit.html.twig', [
            'alum_asig_prof' => $alumAsigProf,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_alum_asig_prof_delete', methods: ['POST'])]
    public function delete(Request $request, AlumAsigProf $alumAsigProf, AlumAsigProfRepository $alumAsigProfRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$alumAsigProf->getId(), $request->request->get('_token'))) {
            $alumAsigProfRepository->remove($alumAsigProf, true);
        }

        return $this->redirectToRoute('app_alum_asig_prof_index', [], Response::HTTP_SEE_OTHER);
    }
}
