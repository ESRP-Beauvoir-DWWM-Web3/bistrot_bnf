<?php

namespace App\Entity;

use App\Repository\TablesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TablesRepository::class)]
class Tables
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $couverts = null;

    #[ORM\ManyToMany(targetEntity: Reservations::class, inversedBy: 'liste_tables')]
    private Collection $liste_reservations;

    public function __construct()
    {
        $this->liste_reservations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCouverts(): ?int
    {
        return $this->couverts;
    }

    public function setCouverts(int $couverts): self
    {
        $this->couverts = $couverts;

        return $this;
    }

    /**
     * @return Collection<int, Reservations>
     */
    public function getListeReservations(): Collection
    {
        return $this->liste_reservations;
    }

    public function addListeReservation(Reservations $listeReservation): self
    {
        if (!$this->liste_reservations->contains($listeReservation)) {
            $this->liste_reservations->add($listeReservation);
        }

        return $this;
    }

    public function removeListeReservation(Reservations $listeReservation): self
    {
        $this->liste_reservations->removeElement($listeReservation);

        return $this;
    }

}
