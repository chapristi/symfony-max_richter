<?php
// src/EventSubscriber/RequestLoggerSubscriber.php

namespace App\EventSubscriber;

use Psr\Log\LoggerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ControllerEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class RequestLoggerSubscriber implements EventSubscriberInterface
{
    private LoggerInterface $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function onController(ControllerEvent $event): void
    {
        $request = $event->getRequest();

        $controller = $event->getController();

        if (is_array($controller)) {
            $controllerName = sprintf('%s::%s', get_class($controller[0]), $controller[1]);
        } else {
            $controllerName = 'Inconnu';
        }

        $message = sprintf(
            'ROUTE_CALL: %s %s - Controller: %s',
            $request->getMethod(),
            $request->getPathInfo(),
            $controllerName
        );

        $this->logger->info($message, [
            'route' => $request->attributes->get('_route'),
            'ip' => $request->getClientIp()
        ]);
    }

    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::CONTROLLER => ['onController', 10],
        ];
    }
}
