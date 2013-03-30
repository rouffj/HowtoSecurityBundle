<?php

namespace Rouffj\Bundle\HowtoSecurityBundle\SimpleSecurity\AuthenticationProvider;

use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authentication\Provider\AuthenticationProviderInterface;
use Rouffj\Bundle\HowtoSecurityBundle\SimpleSecurity\Token\LoginPasswordToken;

class MemberAuthenticationProvider implements AuthenticationProviderInterface
{
    private $users;

    public function __construct(array $users)
    {
        $this->users = $users;
    }

    public function authenticate(TokenInterface $token)
    {
        foreach ($this->users as $username) {
            $expectedPassword = $username.'symfony';
            if ($username === $token->getUser() && $expectedPassword === $token->getCredentials()) {
                return new LoginPasswordToken($username, $expectedPassword, array('ROLE_MEMBER')); // authenticated token
            }
        }
    }

    public function supports(TokenInterface $token)
    {
        return $token instanceof LoginPasswordToken;
    }
}
