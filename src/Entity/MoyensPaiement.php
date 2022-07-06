<?php

namespace App\Entity;

use App\Repository\MoyensPaiementRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MoyensPaiementRepository::class)]
class MoyensPaiement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 20)]
    private $moyen_pai_nom;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMoyenPaiNom(): ?string
    {
        return $this->moyen_pai_nom;
    }

    public function setMoyenPaiNom(string $moyen_pai_nom): self
    {
        $this->moyen_pai_nom = $moyen_pai_nom;

        return $this;
    }
    public function __toString(){
        return $this->moyen_pai_nom;
    }
}
