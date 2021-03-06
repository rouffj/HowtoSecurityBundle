<?php

namespace Rouffj\Bundle\HowtoSecurityBundle\SimpleSecurity;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpFoundation\RequestMatcher;
use Rouffj\Bundle\HowtoSecurityBundle\SimpleSecurity\AuthenticationListener\HttpBasicAuthenticationListener;
use Rouffj\Bundle\HowtoSecurityBundle\SimpleSecurity\AuthenticationListener\UrlAuthenticationListener;
use Rouffj\Bundle\HowtoSecurityBundle\SimpleSecurity\AuthenticationListener\AccessListener;
use Rouffj\Bundle\HowtoSecurityBundle\SimpleSecurity\AuthenticationProvider\ArrayAuthenticationProvider;
use Rouffj\Bundle\HowtoSecurityBundle\SimpleSecurity\AuthenticationProvider\MemberAuthenticationProvider;

/**
 * Analyze each HTTP request of the application to check if an
 * AuthenticationListener can handle the current request.
 *
 * @author Joseph Rouff <rouffj@gmail.com>
 */
class Firewall implements EventSubscriberInterface
{
    private $firewalls;

    public function __construct(ContainerInterface $container)
    {
        $authenticationManager = new AuthenticationManager(array(
            new ArrayAuthenticationProvider(array('admin' => array('password' => 'adminpass', 'roles' => array('ROLE_ADMIN')))),
            new MemberAuthenticationProvider(array('member1', 'member2'))
        ));

        $this->firewalls = array(
            '/howto-security/case1/admin/*' => array(
                new UrlAuthenticationListener($authenticationManager, $container->get('simple_security.context')),
                new HttpBasicAuthenticationListener($authenticationManager, $container->get('simple_security.context')),
                new AccessListener(array('/howto-security/case1/admin/*' => array('ROLE_ADMIN')), $container->get('simple_security.context')),
            )
        );
    }

    public function onKernelRequest(GetResponseEvent $event)
    {
        foreach ($this->firewalls as $urlPattern => $authenticationListeners) {
            $requestMatcher = new RequestMatcher($urlPattern);
            if ($requestMatcher->matches($event->getRequest())) {
                foreach ($authenticationListeners as $listener) {
                    $listener->handle($event);

                    if ($event->hasResponse()) {
                        return;
                    }
                }
            }
        }
    }

    /**
     * With that method we are telling to symfony2 that we want to be notified of
     * every request made on the entire application. Symfony2 should fire the
     * `onKernelRequest` method of this class each time a request is made.
     */
    static public function getSubscribedEvents()
    {
        return array(
            'kernel.request' => array('onKernelRequest')
        );
    }
}

