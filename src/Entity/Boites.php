<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BoitesRepository")
 */
class Boites
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
    private $boite;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Cars", mappedBy="boites", orphanRemoval=true)
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

    public function getBoite(): ?string
    {
        return $this->boite;
    }

    public function setBoite(string $boite): self
    {
        $this->boite = $boite;

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
            $car->setBoites($this);
        }

        return $this;
    }

    public function removeCar(Cars $car): self
    {
        if ($this->Cars->contains($car)) {
            $this->Cars->removeElement($car);
            // set the owning side to null (unless already changed)
            if ($car->getBoites() === $this) {
                $car->setBoites(null);
            }
        }

        return $this;
    }
}
