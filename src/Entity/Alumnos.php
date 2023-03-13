<?php

namespace App\Entity;

use App\Repository\AlumnosRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AlumnosRepository::class)]
class Alumnos
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $nombre = null;

    #[ORM\Column(length: 50)]
    private ?string $apellidos = null;

    #[ORM\Column(length: 1)]
    private ?string $sexo = null;

    #[ORM\OneToMany(mappedBy: 'alumnoId', targetEntity: AlumAsigProf::class, orphanRemoval: true)]
    private Collection $alumAsigProfs;

    public function __construct()
    {
        $this->alumAsigProfs = new ArrayCollection();
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

    public function getApellidos(): ?string
    {
        return $this->apellidos;
    }

    public function setApellidos(string $apellidos): self
    {
        $this->apellidos = $apellidos;

        return $this;
    }

    public function getSexo(): ?string
    {
        return $this->sexo;
    }

    public function setSexo(string $sexo): self
    {
        $this->sexo = $sexo;

        return $this;
    }

    /**
     * @return Collection<int, AlumAsigProf>
     */
    public function getAlumAsigProfs(): Collection
    {
        return $this->alumAsigProfs;
    }

    public function addAlumAsigProf(AlumAsigProf $alumAsigProf): self
    {
        if (!$this->alumAsigProfs->contains($alumAsigProf)) {
            $this->alumAsigProfs->add($alumAsigProf);
            $alumAsigProf->setAlumnoId($this);
        }

        return $this;
    }

    public function removeAlumAsigProf(AlumAsigProf $alumAsigProf): self
    {
        if ($this->alumAsigProfs->removeElement($alumAsigProf)) {
            // set the owning side to null (unless already changed)
            if ($alumAsigProf->getAlumnoId() === $this) {
                $alumAsigProf->setAlumnoId(null);
            }
        }

        return $this;
    }

    public function __toString(): string
    {
        return $this->nombre . ' ' . $this->apellidos;
    }
}
