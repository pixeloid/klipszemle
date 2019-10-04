<?php

namespace Pixeloid\AppBundle\Repository;

use Pixeloid\AppBundle\Entity\JuryVote;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method JuryVote|null find($id, $lockMode = null, $lockVersion = null)
 * @method JuryVote|null findOneBy(array $criteria, array $orderBy = null)
 * @method JuryVote[]    findAll()
 * @method JuryVote[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class JuryVoteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, JuryVote::class);
    }

    // /**
    //  * @return JuryVote[] Returns an array of JuryVote objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('j')
            ->andWhere('j.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('j.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?JuryVote
    {
        return $this->createQueryBuilder('j')
            ->andWhere('j.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
