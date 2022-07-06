<?php

namespace App\Entity;

use App\Repository\CategoriesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategoriesRepository::class)]
class Categories
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 25)]
    private $categorie_nom;

    #[ORM\OneToMany(mappedBy: 'categorie_transaction_id', targetEntity: Transactions::class)]
    private $transactions_çategorie;

    public function __construct()
    {
        $this->transactions_çategorie = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCategorieNom(): ?string
    {
        return $this->categorie_nom;
    }

    public function setCategorieNom(string $categorie_nom): self
    {
        $this->categorie_nom = $categorie_nom;

        return $this;
    }

    /**
     * @return Collection<int, Transactions>
     */
    public function getTransactionsçategorie(): Collection
    {
        return $this->transactions_çategorie;
    }

    public function addTransactionsAtegorie(Transactions $transactionsAtegorie): self
    {
        if (!$this->transactions_çategorie->contains($transactionsAtegorie)) {
            $this->transactions_çategorie[] = $transactionsAtegorie;
            $transactionsAtegorie->setCategorieTransactionId($this);
        }

        return $this;
    }

    public function removeTransactionsAtegorie(Transactions $transactionsAtegorie): self
    {
        if ($this->transactions_çategorie->removeElement($transactionsAtegorie)) {
            // set the owning side to null (unless already changed)
            if ($transactionsAtegorie->getCategorieTransactionId() === $this) {
                $transactionsAtegorie->setCategorieTransactionId(null);
            }
        }

        return $this;
    }
    public function __toString(){
        return $this->categorie_nom;
    }
}
