<?php

namespace App\Mailer;

class NullTransporter implements TransporterInterface
{
    public function send(string $to)
    {
        echo "Sent with Null ".$to;
    }
}