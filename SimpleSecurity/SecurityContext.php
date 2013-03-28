<?php

namespace Rouffj\Bundle\HowtoSecurityBundle\SimpleSecurity;

use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\SecurityContextInterface;

class SecurityContext implements SecurityContextInterface
{
    private $token;

    function getToken()
    {
        return $this->token;
    }

    function setToken(TokenInterface $token = null)
    {
        $this->token = $token;
    }

    function isGranted($attributes, $object = null)
    {
    }
}
