<?php

namespace App\Cms\Block;

interface BlockInterface
{
    public function render(): string;

    public function getType(): string;
} 