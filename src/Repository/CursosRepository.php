<?php

namespace App\Repository;

use App\Entity\Cursos;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Cursos>
 *
 * @method Cursos|null find($id, $lockMode = null, $lockVersion = null)
 * @method Cursos|null findOneBy(array $criteria, array $orderBy = null)
 * @method Cursos[]    findAll()
 * @method Cursos[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CursosRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Cursos::class);
    }

    public function save(Cursos $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Cursos $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function obtenerNotasPorCurso($cursoId)
    {
        $qb = $this->createQueryBuilder('cursos');
    $qb
    ->select('alumnos.nombre AS nombre_alumno, asignaturas.nombre AS nombre_asignatura, aap.nota')
    ->from('App\Entity\AlumAsigProf', 'aap')
    ->join('aap.asigId', 'asignaturas')
    ->join('aap.alumnoId', 'alumnos')
    ->where('asignaturas.curso = :cursoId')
    ->groupBy('alumnos.nombre, asignaturas.nombre, aap.nota')
    ->setParameter('cursoId', $cursoId);
        return $qb->getQuery()->getResult();
    }

    public function obtenerAsignaturasPorCurso($cursoId)
    {
        $qb = $this->createQueryBuilder('cursos');
    $qb
    ->select('asignaturas.nombre AS nombre_asignatura')
    ->from('App\Entity\Asignaturas', 'asignaturas')
    ->where('asignaturas.curso = :cursoId')
    ->groupBy('asignaturas.nombre')

    ->setParameter('cursoId', $cursoId);
        return $qb->getQuery()->getResult();
    }
//    /**
//     * @return Cursos[] Returns an array of Cursos objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('c.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Cursos
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
