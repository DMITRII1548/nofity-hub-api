<?php

namespace App\Shared\Infrastructure\EventSubscriber;

use App\Exception\ValidateException;
use App\Shared\Domain\Exception\InValidateException;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;

class InValidateExceptionSubscriber implements EventSubscriberInterface
{
    public function onExceptionEvent(ExceptionEvent $event): void
    {
        $e = $event->getThrowable();

        if ($e instanceof InValidateException) {
            $event->setResponse(new JsonResponse([
                'errors' => json_encode($e->errors)
            ], 422));
        }
    }

    public static function getSubscribedEvents(): array
    {
        return [
            ExceptionEvent::class => 'onExceptionEvent',
        ];
    }
}
