<?php

namespace Rouffj\Bundle\HowtoSecurityBundle\SimpleSecurity\AuthenticationListener;

use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\Security\Core\Authentication\Provider\AuthenticationProviderInterface;
use Symfony\Component\Security\Http\Firewall\ListenerInterface;
use Symfony\Component\HttpFoundation\Response;
use Rouffj\Bundle\HowtoSecurityBundle\SimpleSecurity\Token\LoginPasswordToken;

class HttpBasicAuthenticationListener implements ListenerInterface
{
    private $authenticationProvider;

    public function __construct(AuthenticationProviderInterface $authenticationProvider)
    {
        $this->authenticationProvider = $authenticationProvider;
    }

    public function handle(GetResponseEvent $event)
    {
        $request = $event->getRequest();

        // if current request is NOT an authentication request, display HTTP login box.
        if (null === $request->headers->get('PHP_AUTH_USER')) {
            $event->setResponse(new Response(null, 401, array('WWW-Authenticate' => 'Basic realm="insert realm"')));
        }

        // We retrieve info required to authenticate current user from request and encapsulate them into a Token.
        $token = new LoginPasswordToken($request->headers->get('PHP_AUTH_USER'), $request->headers->get('PHP_AUTH_PWD'));
        $authenticatedToken = $this->authenticationProvider->authenticate($token);
    }
}
