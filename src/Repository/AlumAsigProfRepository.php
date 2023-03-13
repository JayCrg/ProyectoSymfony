<?php

namespace App\Repository;

use App\Entity\AlumAsigProf;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Alumnos;


/**
 * @extends ServiceEntityRepository<AlumAsigProf>
 *
 * @method AlumAsigProf|null find($id, $lockMode = null, $lockVersion = null)
 * @method AlumAsigProf|null findOneBy(array $criteria, array $orderBy = null)
 * @method AlumAsigProf[]    findAll()
 * @method AlumAsigProf[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AlumAsigProfRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AlumAsigProf::class);
    }

    public function save(AlumAsigProf $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(AlumAsigProf $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return AlumAsigProf[] Returns an array of AlumAsigProf objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('a.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?AlumAsigProf
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
