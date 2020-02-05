<?php

namespace App\Cms\Block;

class Article implements BlockInterface
{
    public function render(): string
    {
        return __CLASS__;
    }

    public function getType(): string
    {
        return 'article';
    }
} 