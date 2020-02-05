<?php

namespace App\Cms\Block;

class Pub implements BlockInterface
{
    public function render(): string
    {
        return __CLASS__;
    }

    public function getType() : string
    {
        return 'pub';
    }
} 