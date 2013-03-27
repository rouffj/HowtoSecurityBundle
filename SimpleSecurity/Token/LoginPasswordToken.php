<?php

namespace Rouffj\Bundle\HowtoSecurityBundle\SimpleSecurity\Token;

use Symfony\Component\Security\Core\Authentication\Token\AbstractToken;

class LoginPasswordToken extends AbstractToken
{
    public function __construct($login, $password)
    {
        $this->setUser($login);
        $this->credentials = $password;
    }

    public function getCredentials()
    {
        return $this->credentials;
    }
}
