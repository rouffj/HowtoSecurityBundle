<?php

namespace Rouffj\Bundle\HowtoSecurityBundle\SimpleSecurity;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;

/**
 * Analyze each HTTP request of the application to check if an
 * AuthenticationListener can handle the current request.
 *
 * @author Joseph Rouff <rouffj@gmail.com>
 */
class Firewall implements EventSubscriberInterface
{
    private $firewalls;

    public function __construct()
    {
        $this->firewalls = array(
            '/howto-security/case1/admin/*' => array()
        );
    }

    public function onKernelRequest(GetResponseEvent $event)
    {
        // Here we can analyze every request made on application
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

