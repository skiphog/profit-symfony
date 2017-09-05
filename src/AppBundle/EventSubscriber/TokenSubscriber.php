<?php

namespace AppBundle\EventSubscriber;

use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use Symfony\Component\HttpKernel\KernelEvents;
use AppBundle\Controller\TokenAuthenticatedController;
use Symfony\Component\HttpKernel\Event\FilterControllerEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class TokenSubscriber implements EventSubscriberInterface
{

    protected $auth;

    public function __construct($auth)
    {
        $this->auth = $auth;
    }

    public function onKernelController(FilterControllerEvent $event)
    {
        $controller = $event->getController();

        if (!is_array($controller) || !(array_shift($controller) instanceof TokenAuthenticatedController)) {
            return;
        }

        if (!$this->checkAuth($event)) {
            throw new UnauthorizedHttpException(null, 'Unauthorized');
        }
    }

    private function checkAuth(FilterControllerEvent $event)
    {
        $headers = $event->getRequest()->headers;

        return $headers->get('X-UserName') === $this->auth['name']
            &&
            $headers->get('X-Password') === hash('gost', $this->auth['pass']);
    }

    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::CONTROLLER => 'onKernelController',
        ];
    }
}