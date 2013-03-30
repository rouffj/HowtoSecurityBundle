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
        foreach ($this->providers as $provider) {
            if (!$provider->supports($token)) {
                continue;
            }

            if (null !== $authenticatedToken = $provider->authenticate($token)) {
                return $authenticatedToken;
            }
        }

        throw new AuthenticationException('You mistype your credentials or have no account');
    }
}
