<?php

namespace App\Controller\Admin;

use App\Entity\MoyensPaiement;
use App\Entity\Transactions;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Query\FilterCollection;
use Doctrine\ORM\QueryBuilder;
use EasyCorp\Bundle\EasyAdminBundle\Collection\FieldCollection;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\KeyValueStore;
use EasyCorp\Bundle\EasyAdminBundle\Context\AdminContext;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Dto\EntityDto;
use EasyCorp\Bundle\EasyAdminBundle\Dto\SearchDto;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Orm\EntityRepository;
use Symfony\Bridge\Doctrine\ManagerRegistry;

class TransactionsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Transactions::class;
    }
    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            // the names of the Doctrine entity properties where the search is made on
            // (by default it looks for in all properties)
            ->setSearchFields(['transaction_nom', 'transaction_type'])
            // use dots (e.g. 'seller.email') to search in Doctrine associations
            // set it to null to disable and hide the search box
            // call this method to focus the search input automatically when loading the 'index' page
            ->setAutofocusSearch()

            // defines the initial sorting applied to the list of entities
            // (user can later change this sorting by clicking on the table columns)
            // you can sort by Doctrine associations up to two levels

            // the max number of entities to display per page
            ->setPaginatorPageSize(30)
            // the number of pages to display on each side of the current page
            // e.g. if num pages = 35, current page = 7 and you set ->setPaginatorRangeSize(4)
            // the paginator displays: [Previous]  1 ... 3  4  5  6  [7]  8  9  10  11 ... 35  [Next]
            // set this number to 0 to display a simple "< Previous | Next >" pager
            ->setPaginatorRangeSize(4)

            // these are advanced options related to Doctrine Pagination
            // (see https://www.doctrine-project.org/projects/doctrine-orm/en/2.7/tutorials/pagination.html)
            ;
    }
    public function createEntity(string $entityFqcn)
    {
        $Transactions = new Transactions();
        $Transactions->setAdminTransactionId($this->getUser());

        return $Transactions;
    }
    public function deleteEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        $entityInstance->setIsHidden(true);
        $entityManager->flush();

    }
        public function createIndexQueryBuilder(SearchDto $searchDto,EntityDto $entityDto,FieldCollection $fieldCollection, FilterCollection|\EasyCorp\Bundle\EasyAdminBundle\Collection\FilterCollection $filters):QueryBuilder{
    return parent::createIndexQueryBuilder($searchDto,$entityDto,$fieldCollection,$filters);
    }
    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('transaction_nom')->setLabel("Nom Transaction"),
            ChoiceField::new('transaction_type')->setChoices(['depense' =>0, 'revenus'=>1])->setRequired(true)->setLabel("Type Transaction"),
            AssociationField::new('moyen_paiement_id')->setLabel('Moyen de Paiement'),
            AssociationField::new('categorie_transaction_id')->setLabel('Catégorie'),
            NumberField::new('transaction_montant')->setLabel("Montant Transaction"),
            DateField::new('transaction_date')->setLabel("Date Transaction"),
            DateTimeField::new('transaction_date_creation')->hideOnForm(),
            DateTimeField::new('transaction_date_modif')->hideOnForm(),
            DateTimeField::new('admin_transaction_id_id')->hideOnForm(),
        ];
    }

}
