<?php

namespace App\Security;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Http\Authenticator\AbstractAuthenticator;
use Symfony\Component\Security\Http\Authenticator\Passport\SelfValidatingPassport;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\UserBadge;

class AdminAuthenticator extends AbstractAuthenticator
{
    public function supports(Request $request): ?bool
    {
        // Cet authenticator n'est jamais utilisé pour authentifier réellement.
        // Il existe uniquement pour permettre loginUser() dans les tests.
        return false;
    }

    public function authenticate(Request $request): SelfValidatingPassport
    {
        // Jamais appelé, mais doit exister.
        return new SelfValidatingPassport(new UserBadge(''));
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token, string $firewallName): ?Response
    {
        // Aucun comportement particulier
        return null;
    }

    public function onAuthenticationFailure(Request $request, \Throwable $exception): ?Response
    {
        // Aucun comportement particulier
        return null;
    }
}
