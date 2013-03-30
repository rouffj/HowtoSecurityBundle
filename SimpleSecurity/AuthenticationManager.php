<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Rouffj\Bundle\HowtoSecurityBundle\SimpleSecurity;

use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authentication\AuthenticationManagerInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;

class AuthenticationManager implements AuthenticationManagerInterface
{
    private $providers;

    public function __construct(array $providers)
    {
        $this->providers = $providers;
    }

    public function authenticate(TokenInterface $token)
    {
        // here should iterate over all providers until one supports it and return an authentication token
    }
}
