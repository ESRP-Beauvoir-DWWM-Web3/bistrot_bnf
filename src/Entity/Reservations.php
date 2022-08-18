<?php

namespace App\Entity;

use App\Repository\ReservationsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ReservationsRepository::class)]
class Reservations
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'reservations')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $nom = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    #[ORM\ManyToMany(targetEntity: Tables::class, mappedBy: 'liste_reservations')]
    private Collection $liste_tables;


    public function __construct()
    {
        $this->tables = new ArrayCollection();
        $this->liste_tables = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?User
    {
        return $this->nom;
    }

    public function setNom(?User $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    /**
     * @return Collection<int, Tables>
     */
    public function getListeTables(): Collection
    {
        return $this->liste_tables;
    }

    public function addListeTable(Tables $listeTable): self
    {
        if (!$this->liste_tables->contains($listeTable)) {
            $this->liste_tables->add($listeTable);
            $listeTable->addListeReservation($this);
        }

        return $this;
    }

    public function removeListeTable(Tables $listeTable): self
    {
        if ($this->liste_tables->removeElement($listeTable)) {
            $listeTable->removeListeReservation($this);
        }

        return $this;
    }

}
