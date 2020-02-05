<?php

namespace App\Mailer;

use Psr\Log\LoggerInterface;

class Mailer
{
    private $transporter;

    private $logger;

    public function __construct(LoggerInterface $logger, TransporterInterface $transporter)
    {
        $this->transporter = $transporter;
        $this->logger = $logger;
    }

    public function send(string $to)
    {
        $this->transporter->send($to);
        $this->logger->info("Coucou du logger");
        //echo $to." email sent";
    }
}