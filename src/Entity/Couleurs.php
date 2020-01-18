<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CouleursRepository")
 */
class Couleurs
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $couleur;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Cars", mappedBy="couleurs", orphanRemoval=true)
     */
    private $Cars;

    public function __construct()
    {
        $this->Cars = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCouleur(): ?string
    {
        return $this->couleur;
    }

    public function setCouleur(string $couleur): self
    {
        $this->couleur = $couleur;

        return $this;
    }

    /**
     * @return Collection|Cars[]
     */
    public function getCars(): Collection
    {
        return $this->Cars;
    }

    public function addCar(Cars $car): self
    {
        if (!$this->Cars->contains($car)) {
            $this->Cars[] = $car;
            $car->setCouleurs($this);
        }

        return $this;
    }

    public function removeCar(Cars $car): self
    {
        if ($this->Cars->contains($car)) {
            $this->Cars->removeElement($car);
            // set the owning side to null (unless already changed)
            if ($car->getCouleurs() === $this) {
                $car->setCouleurs(null);
            }
        }

        return $this;
    }
}
