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

    #[ORM\OneToMany(mappedBy: 'cours', targetEntity: Images::class, cascade:["persist"], orphanRemoval: true)]
    private $images;

    public function __construct()
    {
        $this->cdas = new ArrayCollection();
        $this->images = new ArrayCollection();
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

    public function __toString()
    {
        return $this->nom_cours;
    }

    /**
     * @return Collection<int, Images>
     */
    public function getImages(): Collection
    {
        return $this->images;
    }

    public function addImage(Images $image): self
    {
        if (!$this->images->contains($image)) {
            $this->images[] = $image;
            $image->setCours($this);
        }

        return $this;
    }

    public function removeImage(Images $image): self
    {
        if ($this->images->removeElement($image)) {
            // set the owning side to null (unless already changed)
            if ($image->getCours() === $this) {
                $image->setCours(null);
            }
        }

        return $this;
    }
}
