<?php

namespace App\Repository;

use App\Entity\MoyensPaiement;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<MoyensPaiement>
 *
 * @method MoyensPaiement|null find($id, $lockMode = null, $lockVersion = null)
 * @method MoyensPaiement|null findOneBy(array $criteria, array $orderBy = null)
 * @method MoyensPaiement[]    findAll()
 * @method MoyensPaiement[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MoyensPaiementRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MoyensPaiement::class);
    }

    public function add(MoyensPaiement $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(MoyensPaiement $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return MoyensPaiement[] Returns an array of MoyensPaiement objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('m.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?MoyensPaiement
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
