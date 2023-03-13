<?php

namespace App\Entity;

use App\Repository\ProfesoresRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProfesoresRepository::class)]
class Profesores
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $nombre = null;

    #[ORM\Column(length: 50)]
    private ?string $apellidos = null;

    #[ORM\Column(length: 9, nullable: true)]
    private ?string $telefono = null;

    #[ORM\OneToMany(mappedBy: 'profId', targetEntity: AlumAsigProf::class, orphanRemoval: true)]
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

    public function getTelefono(): ?string
    {
        return $this->telefono;
    }

    public function setTelefono(?string $telefono): self
    {
        $this->telefono = $telefono;

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
            $alumAsigProf->setProfId($this);
        }

        return $this;
    }

    public function removeAlumAsigProf(AlumAsigProf $alumAsigProf): self
    {
        if ($this->alumAsigProfs->removeElement($alumAsigProf)) {
            // set the owning side to null (unless already changed)
            if ($alumAsigProf->getProfId() === $this) {
                $alumAsigProf->setProfId(null);
            }
        }

        return $this;
    }

    public function __toString(): string
    {
        return $this->nombre . ' ' . $this->apellidos;
    }
}
