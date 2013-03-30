<?php

namespace Rouffj\Bundle\HowtoSecurityBundle\SimpleSecurity\AuthenticationListener;

use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\Security\Http\Firewall\ListenerInterface;
use Symfony\Component\Security\Core\SecurityContextInterface;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Rouffj\Bundle\HowtoSecurityBundle\SimpleSecurity\AccessDecisionManager;
use Symfony\Component\HttpFoundation\RequestMatcher;

class AccessListener implements ListenerInterface
{
    private $securityContext;
    private $accessMap;
    private $accessDecisionManager;

    public function __construct(array $accessMap, SecurityContextInterface $securityContext)
    {
        $this->securityContext = $securityContext;
        $this->accessMap = $accessMap;
        $this->accessDecisionManager = new AccessDecisionManager();
    }

    public function handle(GetResponseEvent $event)
    {
        // Check if current request match an url pattern of the access map,
        // if yes we check if current user have roles required to display current page.
    }
}
