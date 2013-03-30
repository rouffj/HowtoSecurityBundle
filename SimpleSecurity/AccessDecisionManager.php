<?php

namespace Rouffj\Bundle\HowtoSecurityBundle\SimpleSecurity;

use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\AccessDecisionManagerInterface;

class AccessDecisionManager implements AccessDecisionManagerInterface
{
    public function decide(TokenInterface $token, array $requiredRoles, $object = null)
    {
        foreach ($token->getRoles() as $role) {
            if (in_array($role->getRole(), $requiredRoles)) {
                return true;
            }
        }
    }

    public function supportsAttribute($attribute)
    {
    }

    public function supportsClass($class)
    {
    }
}
