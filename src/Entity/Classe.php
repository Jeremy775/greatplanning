<?php

namespace App\Entity;

use App\Repository\ClasseRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ClasseRepository::class)]
class Classe
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\ManyToOne(targetEntity: formations::class, inversedBy: 'classes')]
    private $formation;

    #[ORM\ManyToMany(targetEntity: users::class, inversedBy: 'classes')]
    private $membres;

    #[ORM\OneToMany(mappedBy: 'classe', targetEntity: Cours::class)]
    private $Cours;

    public function __construct()
    {
        $this->membres = new ArrayCollection();
        $this->Cours = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFormation(): ?formations
    {
        return $this->formation;
    }

    public function setFormation(?formations $formation): self
    {
        $this->formation = $formation;

        return $this;
    }

    /**
     * @return Collection<int, users>
     */
    public function getMembres(): Collection
    {
        return $this->membres;
    }

    public function addMembre(users $membre): self
    {
        if (!$this->membres->contains($membre)) {
            $this->membres[] = $membre;
        }

        return $this;
    }

    public function removeMembre(users $membre): self
    {
        $this->membres->removeElement($membre);

        return $this;
    }

    /**
     * @return Collection<int, Cours>
     */
    public function getCours(): Collection
    {
        return $this->Cours;
    }

    public function addCour(Cours $cour): self
    {
        if (!$this->Cours->contains($cour)) {
            $this->Cours[] = $cour;
            $cour->setClasse($this);
        }

        return $this;
    }

    public function removeCour(Cours $cour): self
    {
        if ($this->Cours->removeElement($cour)) {
            // set the owning side to null (unless already changed)
            if ($cour->getClasse() === $this) {
                $cour->setClasse(null);
            }
        }

        return $this;
    }
}
