<?php

namespace Rouffj\Bundle\HowtoSecurityBundle\SimpleSecurity\AuthenticationProvider;

use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authentication\Provider\AuthenticationProviderInterface;
use Rouffj\Bundle\HowtoSecurityBundle\SimpleSecurity\Token\LoginPasswordToken;

/**
 * This authentication provider can authenticate ONLY a LoginPasswordToken
 */
class ArrayAuthenticationProvider implements AuthenticationProviderInterface
{
    public function authenticate(TokenInterface $token)
    {
        // Here the code which check if info in token matches authentication requirements
    }

    public function supports(TokenInterface $token)
    {
        return $token instanceof LoginPasswordToken;
    }
}
