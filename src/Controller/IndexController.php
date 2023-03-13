<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\AlumAsigProfRepository;
use App\Entity\AlumAsigProf;
use App\Entity\Asignaturas;
use App\Form\SelectAlumnType;
use App\Form\SelectClassType;
use App\Repository\CursosRepository;


class IndexController extends AbstractController
{
    #[Route('/index', name: 'app_index')]
    public function index(): Response
    {
        return $this->render('index/index.html.twig', [
            'controller_name' => 'IndexController',
        ]);
    }

    #[Route('/alumnos', name: 'alumnos')]
    public function alumnos(): Response
    {
        return $this->render('alumnos/index.html.twig', [
            'controller_name' => 'IndexController',
        ]);
    }

    #[Route('/cursos', name: 'cursos')]
    public function cursos(): Response
    {
        return $this->render('cursos/index.html.twig', [
            'controller_name' => 'IndexController',
        ]);
    }

    #[Route('/asignaturas', name: 'asignaturas')]
    public function asignaturas(): Response
    {
        return $this->render('asignaturas/index.html.twig', [
            'controller_name' => 'IndexController',
        ]);
    }

    #[Route('/profesores', name: 'profesores')]
    public function profesores(): Response
    {
        return $this->render('profesores/index.html.twig', [
            'controller_name' => 'IndexController',
        ]);
    }
    #[Route('/matricula', name: 'matricula')]
    public function matricula(): Response
    {
        return $this->render('alum_asig_prof/index.html.twig', [
            'controller_name' => 'IndexController',
        ]);
    }

    #[Route('/logout', name: 'app_logout', methods: ['GET'])]
    public function logout()
    {
        // controller can be blank: it will never be called!
        throw new \Exception('Don\'t forget to activate logout in security.yaml');
    }
    #[Route('/formularioBoletin', name: 'boletin')]
        public function boletin(Request $request, AlumAsigProfRepository $alumAsigProfRepository): Response
    {
            $alumAsigProf = new AlumAsigProf();
            $form = $this->createForm(SelectAlumnType::class, $alumAsigProf);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                // return $this->redirectToRoute('notasBoletin');
                $alumno = $alumAsigProfRepository->
                findBy(['alumnoId' => $alumAsigProf->getAlumnoId()]);
        
                return $this->render('index/tablaBoletin.html.twig', [
                    'notas' => $alumno,
                ]);
            }

            return $this->render('index/formularioBoletin.html.twig', [
                'form' => $form,
            ]);
    }
    #[Route('/formularioClase', name: 'clase')]
        public function clase(Request $request, CursosRepository $cursosRepository): Response
    {
            $asignaturas = new Asignaturas();
            $form = $this->createForm(SelectClassType::class, $asignaturas);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                //busca todos los alumnos matriculados en las aignaturas de un curso
                $alumnos = $cursosRepository->
                obtenerNotasPorCurso($asignaturas->getCurso());
                
                $asignaturas = $cursosRepository->
                obtenerAsignaturasPorCurso($asignaturas->getCurso());

                $auxiliar = array();
                foreach ($alumnos as $alumno) { 
                    $auxiliar[$alumno['nombre_alumno']] = array();
                }
                foreach  ($alumnos as $alumno) { 
                    array_push($auxiliar[$alumno['nombre_alumno']], ['asignatura'=>$alumno['nombre_asignatura'], 'nota'=> $alumno['nota']]);
                }
                $nombres = array_keys($auxiliar);

                //calcula la media de cada alumno
                $medias = array();
                for ($i=0; $i < count($auxiliar); $i++) {
                    $suma = 0;
                    $contador = 0;
                    foreach ($auxiliar[$nombres[$i]] as $asignatura) {
                        $suma += $asignatura['nota'];
                        $contador++;
                    }
                    $medias[$nombres[$i]] = $suma/$contador;
                }

                return $this->render('index/tablaClase.html.twig', [
                    'asignaturas' => $asignaturas,
                    'nombres' => $nombres,
                    'alumnos' => $alumnos,
                    'medias' => $medias,
                ]);
            }

            return $this->render('index/formularioClase.html.twig', [
                'form' => $form,
            ]);
    }

}
