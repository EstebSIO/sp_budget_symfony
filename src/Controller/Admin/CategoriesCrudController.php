<?php

namespace App\Controller\Admin;

use App\Entity\Categories;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class CategoriesCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Categories::class;
    }

    public function deleteEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        return;

    }
    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('categorie_nom')->setLabel('Nom Catégorie'),

        ];
    }

}
