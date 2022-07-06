<?php

namespace App\Entity;

use App\Model\TimeStampInterface;
use App\Repository\TransactionsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TransactionsRepository::class)]
class Transactions implements TimeStampInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 30)]
    private $transaction_nom;

    #[ORM\Column(type: 'float')]
    private $transaction_montant;

    #[ORM\Column(type: 'boolean')]
    private $transaction_type;

    #[ORM\Column(type: 'datetime')]
    private $transaction_date_creation;

    #[ORM\Column(type: 'datetime')]
    private $transaction_date_modif;

    #[ORM\Column(type: 'datetime')]
    private $transaction_date;

    #[ORM\ManyToOne(targetEntity: MoyensPaiement::class)]
    #[ORM\JoinColumn(nullable: false)]
    private $moyen_paiement_id;

    #[ORM\ManyToOne(targetEntity: Categories::class, inversedBy: 'transactions_çategorie')]
    #[ORM\JoinColumn(nullable: false)]
    private $categorie_transaction_id;

    #[ORM\ManyToOne(targetEntity: Admin::class, inversedBy: 'transactions_admin')]
    #[ORM\JoinColumn(nullable: false)]
    private $admin_transaction_id;

    #[ORM\Column(type: 'boolean', nullable: true)]
    private $is_hidden;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTransactionNom(): ?string
    {
        return $this->transaction_nom;
    }

    public function setTransactionNom(string $transaction_nom): self
    {
        $this->transaction_nom = $transaction_nom;

        return $this;
    }

    public function getTransactionMontant(): ?float
    {
        return $this->transaction_montant;
    }

    public function setTransactionMontant(float $transaction_montant): self
    {
        $this->transaction_montant = $transaction_montant;

        return $this;
    }

    public function isTransactionType(): ?bool
    {
        return $this->transaction_type;
    }

    public function setTransactionType(bool $transaction_type): self
    {
        $this->transaction_type = $transaction_type;

        return $this;
    }

    public function getTransactionDateCreation(): ?\DateTimeInterface
    {
        return $this->transaction_date_creation;
    }

    public function setTransactionDateCreation(\DateTimeInterface $transaction_date_creation): self
    {
        $this->transaction_date_creation = $transaction_date_creation;

        return $this;
    }

    public function getTransactionDateModif(): ?\DateTimeInterface
    {
        return $this->transaction_date_modif;
    }

    public function setTransactionDateModif(\DateTimeInterface $transaction_date_modif): self
    {
        $this->transaction_date_modif = $transaction_date_modif;

        return $this;
    }

    public function getTransactionDate(): ?\DateTimeInterface
    {
        return $this->transaction_date;
    }

    public function setTransactionDate(\DateTimeInterface $transaction_date): self
    {
        $this->transaction_date = $transaction_date;

        return $this;
    }

    public function getMoyenPaiementId(): ?MoyensPaiement
    {
        return $this->moyen_paiement_id;
    }

    public function setMoyenPaiementId(?MoyensPaiement $moyen_paiement_id): self
    {
        $this->moyen_paiement_id = $moyen_paiement_id;

        return $this;
    }

    public function getCategorieTransactionId(): ?Categories
    {
        return $this->categorie_transaction_id;
    }

    public function setCategorieTransactionId(?Categories $categorie_transaction_id): self
    {
        $this->categorie_transaction_id = $categorie_transaction_id;

        return $this;
    }

    public function getAdminTransactionId(): ?Admin
    {
        return $this->admin_transaction_id;
    }

    public function setAdminTransactionId(?Admin $admin_transaction_id): self
    {
        $this->admin_transaction_id = $admin_transaction_id;

        return $this;
    }

    public function isIsHidden(): ?bool
    {
        return $this->is_hidden;
    }

    public function setIsHidden(?bool $is_hidden): self
    {
        $this->is_hidden = $is_hidden;

        return $this;
    }
}
