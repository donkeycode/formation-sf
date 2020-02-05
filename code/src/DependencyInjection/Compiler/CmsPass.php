<?php

namespace App\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;
use App\Cms\Manager;

class CmsPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        // always first check if the primary service is defined
        if (!$container->has(Manager::class)) {
            return;
        }

        $managerDefinition = $container->findDefinition(Manager::class);

        $taggedServices = $container->findTaggedServiceIds('cms.block');

        foreach ($taggedServices as $id => $tags) {
            $managerDefinition->addMethodCall('registerBlock', [new Reference($id)]);
        }
    }
}