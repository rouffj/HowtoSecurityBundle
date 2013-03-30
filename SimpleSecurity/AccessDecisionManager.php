<?php

namespace Rouffj\Bundle\HowtoSecurityBundle\SimpleSecurity;

use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\AccessDecisionManagerInterface;

class AccessDecisionManager implements AccessDecisionManagerInterface
{
    public function decide(TokenInterface $token, array $requiredRoles, $object = null)
    {
        // Check token roles against roles required to display current  web page
    }

    public function supportsAttribute($attribute)
    {
    }

    public function supportsClass($class)
    {
    }
}
