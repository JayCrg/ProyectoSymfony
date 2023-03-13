<?php

namespace App\Entity;

use App\Repository\AlumAsigProfRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;


#[ORM\Entity(repositoryClass: AlumAsigProfRepository::class)]
class AlumAsigProf
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?float $nota = null;

    #[ORM\ManyToOne(inversedBy: 'alumAsigProfs')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Alumnos $alumnoId = null;

    #[ORM\ManyToOne(inversedBy: 'alumAsigProfs')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Profesores $profId = null;

    #[ORM\ManyToOne(inversedBy: 'alumAsigProfs')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Asignaturas $asigId = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNota(): ?float
    {
        return $this->nota;
    }

    public function setNota(float $nota): self
    {
        $this->nota = $nota;

        return $this;
    }

    public function getAlumnoId(): ?Alumnos
    {
        return $this->alumnoId;
    }

    public function setAlumnoId(?Alumnos $alumnoId): self
    {
        $this->alumnoId = $alumnoId;

        return $this;
    }

    public function getProfId(): ?Profesores
    {
        return $this->profId;
    }

    public function setProfId(?Profesores $profId): self
    {
        $this->profId = $profId;

        return $this;
    }

    public function getAsigId(): ?Asignaturas
    {
        return $this->asigId;
    }

    public function setAsigId(?Asignaturas $asigId): self
    {
        $this->asigId = $asigId;

        return $this;
    }
    
}
