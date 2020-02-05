<?php

namespace App\Cms;

use App\Cms\Block\BlockInterface;

class Manager
{
    /**
     * [
     *  'name' => $instance
     *  'pub' => App\Cms\B
     * ]
     */
    private $blocks = [];

    public function render(string $blockType): string
    {
        return $this->blocks[$blockType]->render();
    }

    public function registerBlock(BlockInterface $block)
    {
        $this->blocks[$block->getType()] = $block;
    }
}