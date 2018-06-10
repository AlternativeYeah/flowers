<?php

namespace App\Repository;

use App\Entity\FlowerType;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method FlowerType|null find($id, $lockMode = null, $lockVersion = null)
 * @method FlowerType|null findOneBy(array $criteria, array $orderBy = null)
 * @method FlowerType[]    findAll()
 * @method FlowerType[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FlowerTypeRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, FlowerType::class);
    }

    public function findFlowers(){
        $qb = $this->createQueryBuilder('f');
        $qb->andWhere('f.id != :toys')
            ->setParameter('toys', 9);
        return $qb->getQuery()->getResult();
    }

    public function findToys(){
        $qb = $this->createQueryBuilder('f');
        $qb->andWhere('f.id = :toys')
            ->setParameter('toys', 10);
        return $qb->getQuery()->getResult();
    }

//    /**
//     * @return FlowerType[] Returns an array of FlowerType objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('f.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?FlowerType
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
