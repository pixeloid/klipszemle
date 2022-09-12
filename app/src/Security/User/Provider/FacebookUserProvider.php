<?php

namespace App\Security\User\Provider;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\NonUniqueResultException;
use HWI\Bundle\OAuthBundle\OAuth\Response\UserResponseInterface;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\Exception\UserNotFoundException;
use Symfony\Component\Security\Core\User\UserInterface;

class FacebookUserProvider implements \HWI\Bundle\OAuthBundle\Security\Core\User\OAuthAwareUserProviderInterface
{
    private $em;

    /**
     * @param EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }


    /**
     * @inheritDoc
     * @throws NonUniqueResultException
     */
    public function loadUserByOAuthUserResponse(UserResponseInterface $response)
    {
        
        $email = $response->getEmail() ?? $response->getUserIdentifier();
        
        $user = $this->em->getRepository(User::class)->createQueryBuilder('u')
            ->where('u.facebook_id = :fbId OR u.email = :email')
            ->setParameters([
                'fbId' => $response->getUserIdentifier(),
                'email' => $response->getEmail(),
            ])
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult();


        if ($user === null) {
            $user = new User();
            $user->setFacebookId($response->getUserIdentifier());
            $user->setEmail($email);
            $user->setEmailCanonical($email);
            $user->setUsername($email);
            $user->setUsernameCanonical($email);
            $user->setFirstName($response->getFirstName());
            $user->setLastName($response->getLastName());

            $user->setPassword('---');

            $this->em->persist($user);
            $this->em->flush();

        }

        return $user;
    }
}
