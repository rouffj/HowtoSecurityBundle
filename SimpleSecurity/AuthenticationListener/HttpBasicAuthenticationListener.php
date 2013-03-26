<?php

namespace Rouffj\Bundle\HowtoSecurityBundle\SimpleSecurity\AuthenticationListener;

use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\Security\Http\Firewall\ListenerInterface;
use Symfony\Component\HttpFoundation\Response;

class HttpBasicAuthenticationListener implements ListenerInterface
{
    public function handle(GetResponseEvent $event)
    {
        $request = $event->getRequest();

        // if current request is NOT an authentication request, display HTTP login box.
        if (null === $request->headers->get('PHP_AUTH_USER')) {
            $event->setResponse(new Response(null, 401, array('WWW-Authenticate' => 'Basic realm="insert realm"')));
        }
    }
}
