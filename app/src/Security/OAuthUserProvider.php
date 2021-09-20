<?php

namespace App\Security;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use HWI\Bundle\OAuthBundle\OAuth\Response\UserResponseInterface;
use HWI\Bundle\OAuthBundle\Security\Core\User\OAuthAwareUserProviderInterface;

class OAuthUserProvider implements OAuthAwareUserProviderInterface
{
    /**
     * @var EntityManagerInterface
     */
    private EntityManagerInterface $entityManager;

    /**
     * OAuthUserProvider constructor.
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }


    /**
     * {@inheritdoc}
     */
    public function loadUserByOAuthUserResponse(UserResponseInterface $response)
    {

        $token = $response->getAccessToken();
        $facebookId =  $response->getUsername(); // Facebook ID, e.g. 537091253102004
        $username = $response->getRealName();
        $email = $response->getEmail();



        $user = $this->entityManager->getRepository(User::class)->findOneBy(array('facebook_id' => $facebookId));


        //when the user is registrating
        if (!$user) {
            $service = $response->getResourceOwner()->getName();
            $setter = 'set'.ucfirst($service);
            $setter_id = $setter.'Id';
            $setter_token = $setter.'AccessToken';
            // create new user here
            $user = new User();
            $user->$setter_id($facebookId);
            $user->setRoles(['ROLE_USER']);

            // $user->$setter_token($response->getAccessToken());

            //I have set all requested data with the user's username
            //modify here with relevant data
            $user->setEmail($facebookId);
            $user->setPassword('password');
            $this->entityManager->persist($user);
            $this->entityManager->flush();

        }

        return $user;




    }
}
