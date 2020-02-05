<?php

namespace App\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\EventDispatcher\GenericEvent;

class UserRegistrationSubscriber implements EventSubscriberInterface
{
    public function onNewUser(GenericEvent $event)
    {
        dump('Hello user', $event->getSubject());
    }

    public static function getSubscribedEvents()
    {
        return [
            'new_user' => 'onNewUser',
        ];
    }
}