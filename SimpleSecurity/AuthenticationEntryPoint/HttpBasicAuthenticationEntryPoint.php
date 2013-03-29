<?php

namespace Rouffj\Bundle\HowtoSecurityBundle\SimpleSecurity\AuthenticationEntryPoint;

use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Http\EntryPoint\AuthenticationEntryPointInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

/**
 * Goal: If the current user is not identified "an HTTP login box should appear".
 */
class HttpBasicAuthenticationEntryPoint implements AuthenticationEntryPointInterface
{
    public function start(Request $request, AuthenticationException $authException = null)
    {
    }
}
