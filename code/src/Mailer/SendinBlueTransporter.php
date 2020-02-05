<?php

namespace App\Mailer;

class SendinBlueTransporter implements TransporterInterface
{
    public function send(string $to)
    {
        echo "Sent with SB ".$to;
    }
}