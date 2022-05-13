<?php

namespace App\Entity;

use App\Repository\CoursRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CoursRepository::class)]
class Cours
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $nom_cours;

    #[ORM\ManyToOne(targetEntity: Formations::class, inversedBy: 'Cours')]
    private $Formations;

    #[ORM\ManyToOne(targetEntity: Classe::class, inversedBy: 'Cours')]
    private $classe;

    #[ORM\OneToMany(mappedBy: 'cours', targetEntity: Cda::class)]
    private $cdas;

    public function __construct()
    {
        $this->cdas = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomCours(): ?string
    {
        return $this->nom_cours;
    }

    public function setNomCours(string $nom_cours): self
    {
        $this->nom_cours = $nom_cours;

        return $this;
    }

    public function getFormations(): ?Formations
    {
        return $this->Formations;
    }

    public function setFormations(?Formations $Formations): self
    {
        $this->Formations = $Formations;

        return $this;
    }

    public function getClasse(): ?Classe
    {
        return $this->classe;
    }

    public function setClasse(?Classe $classe): self
    {
        $this->classe = $classe;

        return $this;
    }

    /**
     * @return Collection<int, Cda>
     */
    public function getCdas(): Collection
    {
        return $this->cdas;
    }

    public function addCda(Cda $cda): self
    {
        if (!$this->cdas->contains($cda)) {
            $this->cdas[] = $cda;
            $cda->setCours($this);
        }

        return $this;
    }

    public function removeCda(Cda $cda): self
    {
        if ($this->cdas->removeElement($cda)) {
            // set the owning side to null (unless already changed)
            if ($cda->getCours() === $this) {
                $cda->setCours(null);
            }
        }

        return $this;
    }
}
