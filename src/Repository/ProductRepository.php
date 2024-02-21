<?php

namespace App\Repository;

use App\Entity\Product;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Product>
 *
 * @method Product|null find($id, $lockMode = null, $lockVersion = null)
 * @method Product|null findOneBy(array $criteria, array $orderBy = null)
 * @method Product[]    findAll()
 * @method Product[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Product::class);
    }

//    /**
//     * @return Product[] Returns an array of Product objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('p.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Product
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }

public function deleteAllData(): void
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = '
            DELETE  FROM product';

        $resultSet = $conn->executeQuery($sql);
    }

    public function findMinPrice(): array{
        $qb = $this->createQueryBuilder('p')
        ->select('min(p.price)');

        $query = $qb->getQuery();
        return $query->execute();
    }

    public function findMaxPrice(): array{
        $qb = $this->createQueryBuilder('p')
        ->select('max(p.price)');

        $query = $qb->getQuery();
        return $query->execute();
    }

    public function findAvgPrice(): array{
        $qb = $this->createQueryBuilder('p')
        ->select('avg(p.price)');

        $query = $qb->getQuery();
        return $query->execute();
    }

    public function findUniqueManufacturers(): array{
            $qb = $this->createQueryBuilder('p')
            ->select('DISTINCT(p.manufacturer)');
    
            $query = $qb->getQuery();
           return $query->getArrayResult();
         //   return $query->execute()
            ;
        }
}
