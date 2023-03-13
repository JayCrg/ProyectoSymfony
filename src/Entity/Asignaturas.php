<?php

namespace App\Entity;

use App\Repository\AsignaturasRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AsignaturasRepository::class)]
class Asignaturas
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'asignaturas')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Cursos $curso = null;

    #[ORM\Column(length: 30)]
    private ?string $nombre = null;

    #[ORM\OneToMany(mappedBy: 'asigId', targetEntity: AlumAsigProf::class, orphanRemoval: true)]
    private Collection $alumAsigProfs;

    public function __construct()
    {
        $this->alumAsigProfs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCurso(): ?Cursos
    {
        return $this->curso;
    }

    public function setCurso(?Cursos $curso): self
    {
        $this->curso = $curso;

        return $this;
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
            $alumAsigProf->setAsigId($this);
        }

        return $this;
    }

    public function removeAlumAsigProf(AlumAsigProf $alumAsigProf): self
    {
        if ($this->alumAsigProfs->removeElement($alumAsigProf)) {
            // set the owning side to null (unless already changed)
            if ($alumAsigProf->getAsigId() === $this) {
                $alumAsigProf->setAsigId(null);
            }
        }

        return $this;
    }

    public function __toString(): string
    {
        return $this->nombre . ' '. $this->curso;
    }
}
