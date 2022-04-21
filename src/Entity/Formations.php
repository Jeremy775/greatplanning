<?php

namespace App\Entity;

use App\Repository\FormationsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FormationsRepository::class)]
class Formations
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $formation;

    #[ORM\OneToMany(mappedBy: 'formations', targetEntity: users::class)]
    private $users;

    #[ORM\OneToMany(mappedBy: 'formations', targetEntity: cours::class)]
    private $cours;

    public function __construct()
    {
        $this->users = new ArrayCollection();
        $this->cours = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFormation(): ?string
    {
        return $this->formation;
    }

    public function setFormation(string $formation): self
    {
        $this->formation = $formation;

        return $this;
    }

    /**
     * @return Collection<int, users>
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(users $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users[] = $user;
            $user->setFormations($this);
        }

        return $this;
    }

    public function removeUser(users $user): self
    {
        if ($this->users->removeElement($user)) {
            // set the owning side to null (unless already changed)
            if ($user->getFormations() === $this) {
                $user->setFormations(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, cours>
     */
    public function getCours(): Collection
    {
        return $this->cours;
    }

    public function addCour(cours $cour): self
    {
        if (!$this->cours->contains($cour)) {
            $this->cours[] = $cour;
            $cour->setFormations($this);
        }

        return $this;
    }

    public function removeCour(cours $cour): self
    {
        if ($this->cours->removeElement($cour)) {
            // set the owning side to null (unless already changed)
            if ($cour->getFormations() === $this) {
                $cour->setFormations(null);
            }
        }

        return $this;
    }
}
