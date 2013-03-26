<?php

namespace Rouffj\Bundle\HowtoSecurityBundle\SimpleSecurity\AuthenticationListener;

use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\Security\Http\Firewall\ListenerInterface;

class HttpBasicAuthenticationListener implements ListenerInterface
{
    public function handle(GetResponseEvent $event)
    {
        // Here should be the code to retrieve the user info useful for authenticate him.
    }
}
