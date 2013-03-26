<?php

namespace Rouffj\Bundle\HowtoSecurityBundle\SimpleSecurity\AuthenticationListener;

use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\Security\Http\Firewall\ListenerInterface;
use Symfony\Component\HttpFoundation\Response;

class HttpBasicAuthenticationListener implements ListenerInterface
{
    public function handle(GetResponseEvent $event)
    {
        $event->setResponse(new Response('Error, you must be authenticated to display this page', 401));
    }
}
