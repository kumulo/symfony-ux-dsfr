<?php

declare(strict_types=1);

namespace SymfonyUxDsfr;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use SymfonyUxDsfr\DependencyInjection\DsfrExtension;

class SymfonyUxDsfrBundle extends Bundle
{
    public function getContainerExtension(): Extension
    {
        return new DsfrExtension();
    }

    public function build(ContainerBuilder $container): void
    {
        parent::build($container);
    }
}
