<?php

namespace Rouffj\Bundle\HowtoSecurityBundle\SimpleSecurity\AuthenticationListener;

use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\Security\Core\Authentication\Provider\AuthenticationProviderInterface;
use Symfony\Component\Security\Http\Firewall\ListenerInterface;
use Symfony\Component\HttpFoundation\Response;
use Rouffj\Bundle\HowtoSecurityBundle\SimpleSecurity\Token\LoginPasswordToken;
use Symfony\Component\Security\Core\SecurityContextInterface;

class HttpBasicAuthenticationListener implements ListenerInterface
{
    private $authenticationProvider;
    private $securityContext;

    public function __construct(AuthenticationProviderInterface $authenticationProvider, SecurityContextInterface $securityContext)
    {
        $this->authenticationProvider = $authenticationProvider;
        $this->securityContext = $securityContext;
    }

    public function handle(GetResponseEvent $event)
    {
        $request = $event->getRequest();

        // if current request is NOT an authentication request, display HTTP login box.
        if (null === $request->headers->get('PHP_AUTH_USER')) {
            $event->setResponse(new Response(null, 401, array('WWW-Authenticate' => 'Basic realm="insert realm"')));
        }

        // We retrieve info required to authenticate current user from request and encapsulate them into a Token.
        $token = new LoginPasswordToken($request->headers->get('PHP_AUTH_USER'), $request->headers->get('PHP_AUTH_PW'));

        if (!$this->authenticationProvider->supports($token)) {
            throw new \LogicException('No authentication provider supports given token');
        }

        $authenticatedToken = $this->authenticationProvider->authenticate($token);
        $this->securityContext->setToken($authenticatedToken);
    }
}
