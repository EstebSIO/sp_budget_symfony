<?php

namespace App\Controller\Admin;

use App\Entity\Admin;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use SebastianBergmann\CodeCoverage\Report\Text;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class AdminCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Admin::class;
    }

    public function deleteEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        if(!array_key_exists("ROLE_ADMIN",$entityInstance->getRoles())){
           //parent::deleteEntity($entityManager, $entityInstance);

        }
        else{
            return ;
        }
    }
    public function configureFields(string $pageName): iterable
    {
        return [
            AssociationField::new('role')->setLabel('Rôle'),
            TextField::new('username')->setLabel("Date Transaction"),
            TextField::new('password')->setFormType(PasswordType::class)
        ];
    }

}
