<?php

namespace App\Entity;

use App\Repository\RolesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RolesRepository::class)]
class Roles
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 20)]
    private $Nom_Role;

    #[ORM\OneToMany(mappedBy: 'role', targetEntity: Admin::class)]
    private $list_admin;

    public function __construct()
    {
        $this->list_admin = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomRole(): ?string
    {
        return $this->Nom_Role;
    }

    public function setNomRole(string $Nom_Role): self
    {
        $this->Nom_Role = $Nom_Role;

        return $this;
    }

    /**
     * @return Collection<int, Admin>
     */
    public function getListAdmin(): Collection
    {
        return $this->list_admin;
    }

    public function addListAdmin(Admin $listAdmin): self
    {
        if (!$this->list_admin->contains($listAdmin)) {
            $this->list_admin[] = $listAdmin;
            $listAdmin->setRole($this);
        }

        return $this;
    }

    public function removeListAdmin(Admin $listAdmin): self
    {
        if ($this->list_admin->removeElement($listAdmin)) {
            // set the owning side to null (unless already changed)
            if ($listAdmin->getRole() === $this) {
                $listAdmin->setRole(null);
            }
        }

        return $this;
    }
    public function __toString() {
        return $this->Nom_Role;
    }
}
