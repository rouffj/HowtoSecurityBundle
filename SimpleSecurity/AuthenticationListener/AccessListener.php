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
        // We suppose at this step that current user is authenticated
        foreach ($this->accessMap as $urlPattern => $rolesRequired) {
            $requestMatcher = new RequestMatcher($urlPattern);
            if ($requestMatcher->matches($event->getRequest())) {
                if (!$this->accessDecisionManager->decide($this->securityContext->getToken(), $rolesRequired, $event->getRequest())) {
                    throw new AccessDeniedException();
                }
            }
        }
    }
}
