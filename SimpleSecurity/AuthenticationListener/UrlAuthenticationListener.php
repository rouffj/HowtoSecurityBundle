<?php

namespace Rouffj\Bundle\HowtoSecurityBundle\SimpleSecurity\AuthenticationListener;

use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\Security\Core\Authentication\Provider\AuthenticationProviderInterface;
use Symfony\Component\Security\Http\Firewall\ListenerInterface;
use Symfony\Component\HttpFoundation\Response;
use Rouffj\Bundle\HowtoSecurityBundle\SimpleSecurity\Token\LoginPasswordToken;
use Symfony\Component\Security\Core\SecurityContextInterface;
use Rouffj\Bundle\HowtoSecurityBundle\SimpleSecurity\AuthenticationEntryPoint\HttpBasicAuthenticationEntryPoint;
use Symfony\Component\Security\Core\Exception\AuthenticationException;

class UrlAuthenticationListener implements ListenerInterface
{
    private $authenticationProvider;
    private $securityContext;
    private $authenticationEntryPoint;

    public function __construct(AuthenticationProviderInterface $authenticationProvider, SecurityContextInterface $securityContext)
    {
        $this->authenticationProvider = $authenticationProvider;
        $this->securityContext = $securityContext;
        $this->authenticationEntryPoint = new HttpBasicAuthenticationEntryPoint();
    }

    public function handle(GetResponseEvent $event)
    {
        $request = $event->getRequest();

        // if current request is NOT an authentication request, display HTTP login box.
        if (null === $request->query->get('login') || null === $request->query->get('password')) {
            return;
        }

        // We retrieve info required to authenticate current user from request and encapsulate them into a Token.
        $token = new LoginPasswordToken($request->query->get('login'), $request->query->get('password'));

        try {
            $authenticatedToken = $this->authenticationProvider->authenticate($token);
            $this->securityContext->setToken($authenticatedToken);
        } catch (AuthenticationException $e) {
            $event->setResponse($this->authenticationEntryPoint->start($request, $e));
        }
    }
}
