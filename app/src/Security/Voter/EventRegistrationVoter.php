<?php

namespace App\Security\Voter;

use App\Entity\EventRegistration;
use DateTime;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\User\UserInterface;

class EventRegistrationVoter extends Voter
{
    public const CREATE = 'EVENTREGISTRATION_CREATE';
    public const VOTE = 'EVENTREGISTRATION_VOTE';
    private Security $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    protected function supports(string $attribute, $subject): bool
    {
        // replace with your own logic
        // https://symfony.com/doc/current/security/voters.html
        return in_array($attribute, [self::CREATE, self::VOTE]);
    }

    protected function voteOnAttribute(string $attribute, $subject, TokenInterface $token): bool
    {
        $user = $token->getUser();

        // if the user is anonymous, do not grant access
        if (!$user instanceof UserInterface) {
            return false;
        }

        if ($this->security->isGranted('ROLE_ADMIN')) {
            return true;
        }
        // ... (check conditions and return true to grant permission) ...
        if ($attribute == self::CREATE) {
            $today = new DateTime();
            $deadline = new DateTime('2022-09-04 17:13:00');

            return $today < $deadline;
        }

        if ($attribute == self::VOTE) {
            $today = new DateTime();
            $deadline = new DateTime('2022-09-10');

            return $today < $deadline;
        }

        return false;
    }
}
