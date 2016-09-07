<?php

namespace Pixeloid\AppBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * EventRegistrationRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class EventRegistrationRepository extends EntityRepository
{
	public function getAllForVoting()
	{	
		return $this->getEntityManager()
		    ->createQuery(
		        'SELECT e FROM PixeloidAppBundle:EventRegistration e WHERE e.voteable = TRUE'
		    )
		    ->getResult();
	}
	public function get()
	{	
		return $this->_em->createQuery('SELECT e FROM PixeloidAppBundle:EventRegistration e WHERE e.winner > 0 ORDER BY e.winner ASC')
		                 ->getResult();
	}


	public function hasAlreadyVoted(User $user, EventRegistration $video )
	{
		$result = $this->_em->createQuery('
			SELECT v
			FROM PixeloidAppBundle:Vote v 
			LEFT JOIN v.eventRegistration e
			LEFT JOIN v.user u
			WHERE 
					e = :e 
				AND u = :u ')

			->setParameters(array(
				'e' => $video,
				'u' => $user,
			))
		                 ->getArrayResult();
		     return count($result) > 0;
	}
}
