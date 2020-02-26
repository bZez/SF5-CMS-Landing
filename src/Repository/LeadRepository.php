<?php

namespace App\Repository;

use App\Entity\Lead;
use App\Entity\Page;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Lead|null find($id, $lockMode = null, $lockVersion = null)
 * @method Lead|null findOneBy(array $criteria, array $orderBy = null)
 * @method Lead[]    findAll()
 * @method Lead[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LeadRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Lead::class);
    }

    // /**
    //  * @return Lead[] Returns an array of Lead objects
    //  */
    /*

    */
    public function findNews()
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exported = 0')
            ->orderBy('l.id', 'ASC')
            ->getQuery()
            ->getResult();
    }


    public function getByDept($dateDebut, $dateFin, $page)
    {
        $query = $this->createQueryBuilder('p')
            ->leftJoin('p.isFrom', 'pa');
        if ($page != "") {
            $query = $query->andWhere('pa.id = :page')
                ->setParameter('page', $page);
        }
        if ($dateDebut == "" && $dateFin == "") {
            $query = $query->andWhere('p.exported = false');
        } else {
            $dateFin = new \DateTime($dateFin);
            $dateFin->modify("+1 day");
            $query = $query->andWhere('p.registerAt <= :dateFin')
                ->andWhere('p.registerAt >= :dateDebut')
                ->setParameter('dateFin', $dateFin)
                ->setParameter('dateDebut', $dateDebut);
        }
        $query = $query->select('pa.id AS sourceId, pa.title AS sourceNom, SUBSTRING(p.codePostal, 1, 2) AS DEP, count(p.id) as Nb')
            ->groupBy('sourceId, sourceNom, DEP');
        return $query->getQuery()
            ->getResult();
    }

    public function getNewsByDept()
    {
        $query = $this->createQueryBuilder('p')
            ->leftJoin('p.isFrom', 'pa')
            ->andWhere('p.exported = false');
        $query = $query->select('pa.id AS sourceId, pa.title AS sourceNom, SUBSTRING(p.codePostal, 1, 2) AS DEP, count(p.id) as Nb')
            ->groupBy('sourceId, sourceNom, DEP');
        return $query->getQuery()
            ->getResult();
    }

    public function getByPage($page)
    {
        $query = $this->createQueryBuilder('p')
            ->andWhere('p.isFrom = :page')
            ->setParameter('page', $page);
        $query = $query->select('SUBSTRING(p.codePostal, 1, 2) AS DEP, count(p.id) as Nb')
            ->groupBy('DEP');
        return $query->getQuery()
            ->getResult();
    }

    public function getDepList()
    {
        $query = $this->createQueryBuilder('p');
        $query = $query->select('DISTINCT SUBSTRING(p.codePostal, 1, 2) AS code');
        return $query->getQuery()
            ->getResult();
    }

    public function findThis($page, $dateDebut, $dateFin, $dep,$count)
    {
        $query = $this->createQueryBuilder('p')
            ->leftJoin('p.isFrom', 'pa');
        if ($page != "") {
            $query = $query->andWhere('pa.id = :page')
                ->setParameter('page', $page);
        }
        if ($dateDebut != "") {
            $query = $query->andWhere('p.registerAt >= :dateDebut')
                ->setParameter('dateDebut', $dateDebut);
        }
        if ($dateFin != "") {
            $dateFin = new \DateTime($dateFin);
            $query = $query->andWhere('p.registerAt <= :dateFin')
                ->setParameter('dateFin', $dateFin);
        }
        if ($dep != "") {
            $query = $query->andWhere('SUBSTRING(p.codePostal, 1, 2) = :dateDebut')
                ->setParameter('dateDebut', $dep);
        }
        if ($count != "") {
            $query = $query->setMaxResults($count);
        }
        return $query->getQuery()
            ->getResult();
    }
    /*
    public function findOneBySomeField($value): ?Lead
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
