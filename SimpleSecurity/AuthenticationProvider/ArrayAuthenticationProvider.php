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
    private $users;

    public function __construct(array $users)
    {
        $this->users = $users;
    }

    public function authenticate(TokenInterface $token)
    {
        foreach ($this->users as $username => $info) {
            if ($username === $token->getUser() && $info['password'] === $token->getCredentials()) {
                return new LoginPasswordToken($username, $info['password'], $info['roles']); // authenticated token
            }
        }
    }

    public function supports(TokenInterface $token)
    {
        return $token instanceof LoginPasswordToken;
    }
}
