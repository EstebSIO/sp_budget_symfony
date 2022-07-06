<?php

namespace App\Controller\Admin;

use App\Entity\MoyensPaiement;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class MoyensPaiementCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return MoyensPaiement::class;
    }

    public function deleteEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        return;

    }
    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('moyen_pai_nom'),
        ];
    }

}
