<?php

namespace App\Entity;

use App\Repository\AdminRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: AdminRepository::class)]
class Admin implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 180, unique: true)]
    private $username;

    #[ORM\Column(type: 'json')]
    private $roles = [];

    #[ORM\Column(type: 'string')]
    private $password;

    #[ORM\OneToMany(mappedBy: 'admin_transaction_id', targetEntity: Transactions::class, orphanRemoval: true)]
    private $transactions_admin;

    #[ORM\ManyToOne(targetEntity: Roles::class, inversedBy: 'list_admin')]
    private $role;

    public function __construct()
    {
        $this->transactions_admin = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->username;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }
    public function __toString(): string
    {
       return $this->username;
    }

    /**
     * @return Collection<int, Transactions>
     */
    public function getTransactionsAdmin(): Collection
    {
        return $this->transactions_admin;
    }

    public function addTransactionsAdmin(Transactions $transactionsAdmin): self
    {
        if (!$this->transactions_admin->contains($transactionsAdmin)) {
            $this->transactions_admin[] = $transactionsAdmin;
            $transactionsAdmin->setAdminTransactionId($this);
        }

        return $this;
    }

    public function removeTransactionsAdmin(Transactions $transactionsAdmin): self
    {
        if ($this->transactions_admin->removeElement($transactionsAdmin)) {
            // set the owning side to null (unless already changed)
            if ($transactionsAdmin->getAdminTransactionId() === $this) {
                $transactionsAdmin->setAdminTransactionId(null);
            }
        }

        return $this;
    }

    public function getRole(): ?Roles
    {
        return $this->role;
    }

    public function setRole(?Roles $role): self
    {
        $this->role = $role;

        return $this;
    }
}
