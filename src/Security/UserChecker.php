<?php

namespace App\Security;

use Symfony\Component\Security\Core\Exception\CustomUserMessageAccountStatusException;
use Symfony\Component\Security\Core\User\UserCheckerInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class UserChecker implements UserCheckerInterface
{
    public function checkPreAuth(UserInterface $user)
    {
        if (method_exists($user, 'isBlocked') && $user->isBlocked()) {
            throw new CustomUserMessageAccountStatusException('Votre accès a été révoqué.');
        }
    }

    public function checkPostAuth(UserInterface $user)
    {
        // rien ici
    }
}
