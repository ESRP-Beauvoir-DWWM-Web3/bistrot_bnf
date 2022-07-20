<?php

namespace App\Entity;

use App\Repository\CarousselRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CarousselRepository::class)]
class Caroussel
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column()]
    private ?int $id = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?Formule $photo = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPhoto(): ?Formule
    {
        return $this->photo;
    }

    public function setPhoto(?Formule $photo): self
    {
        $this->photo = $photo;

        return $this;
    }


}
