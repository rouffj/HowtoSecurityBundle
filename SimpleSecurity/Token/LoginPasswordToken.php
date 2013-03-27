<?php

namespace Rouffj\Bundle\HowtoSecurityBundle\SimpleSecurity\Token;

use Symfony\Component\Security\Core\Authentication\Token\AbstractToken;

class LoginPasswordToken extends AbstractToken
{
    public function __construct($login, $password, array $roles = array())
    {
        parent::roles($roles);
        parent::setAuthenticated(count($roles) > 0); // this avoid to mark a token authenticated in AuthenticationListener
        $this->setUser((string) $login);
        $this->credentials = $password;
    }

    public function getCredentials()
    {
        return $this->credentials;
    }
}
