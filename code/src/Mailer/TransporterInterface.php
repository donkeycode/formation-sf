<?php

namespace App\Mailer;

interface TransporterInterface
{
    public function send(string $to);
}