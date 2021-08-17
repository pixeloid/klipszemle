<?php

namespace App\Repository;

use App\Entity\MovieCategory;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method MovieCategory|null find($id, $lockMode = null, $lockVersion = null)
 * @method MovieCategory|null findOneBy(array $criteria, array $orderBy = null)
 * @method MovieCategory[]    findAll()
 * @method MovieCategory[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MovieCategoryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MovieCategory::class);
    }


    public function getMoviesForUser(User $user, \DateTime $from): ?Array
    {
        return $this->createQueryBuilder('mc')
                ->select('mc, erc, er, juryvotes, user')
            ->leftJoin('mc.eventRegistrationCategories', 'erc')
            ->leftJoin('erc.eventregistration', 'er')
            ->leftJoin('er.juryvotes', 'juryvotes')
            ->leftJoin('juryvotes.user', 'user')
            // ->andWhere('user = :user OR user IS NULL')
            ->andWhere('er.created > :created')
            ->andWhere('er.shortlist = 1')
            ->setParameter('created', $from)
            // ->setParameter('user', $user)
            ->orderBy('mc.name, er.author')
            ->getQuery()
            ->getResult()
        ;
    }

    public function getCategoriesForRating(\DateTime $from): ?Array
    {
        return $this->createQueryBuilder('mc')
                ->select('mc')
            ->leftJoin('mc.eventRegistrationCategories', 'erc')
            ->leftJoin('erc.eventregistration', 'er')
            ->leftJoin('er.juryvotes', 'juryvotes')
            ->andWhere('er.created > :created')
            ->andWhere('er.shortlist = 1')
            ->setParameter('created', $from)
            ->orderBy('mc.name, er.author')
            ->getQuery()
            ->getResult()
        ;
    }


    // /**
    //  * @return MovieCategory[] Returns an array of MovieCategory objects
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
    public function findOneBySomeField($value): ?MovieCategory
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
