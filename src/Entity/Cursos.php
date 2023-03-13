<?php

namespace App\Entity;

use App\Repository\CursosRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CursosRepository::class)]
class Cursos
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 20)]
    private ?string $nombre = null;

    #[ORM\Column(length: 5)]
    private ?string $numero = null;

    #[ORM\OneToMany(mappedBy: 'curso', targetEntity: Asignaturas::class)]
    private Collection $asignaturas;

    public function __construct()
    {
        $this->asignaturas = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getNumero(): ?string
    {
        return $this->numero;
    }

    public function setNumero(string $numero): self
    {
        $this->numero = $numero;

        return $this;
    }

    /**
     * @return Collection<int, Asignaturas>
     */
    public function getAsignaturas(): Collection
    {
        return $this->asignaturas;
    }

    public function addAsignatura(Asignaturas $asignatura): self
    {
        if (!$this->asignaturas->contains($asignatura)) {
            $this->asignaturas->add($asignatura);
            $asignatura->setCurso($this);
        }

        return $this;
    }

    public function removeAsignatura(Asignaturas $asignatura): self
    {
        if ($this->asignaturas->removeElement($asignatura)) {
            // set the owning side to null (unless already changed)
            if ($asignatura->getCurso() === $this) {
                $asignatura->setCurso(null);
            }
        }

        return $this;
    }

    public function __toString(): string
    {
        return $this->numero . ' ' . $this->nombre;
    }
}
