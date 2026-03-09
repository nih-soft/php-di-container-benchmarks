<?php

declare(strict_types=1);

namespace DiContainerBenchmarks\Container\Nih;

use DiContainerBenchmarks\Container\ContainerAdapterInterface;
use NIH\Container\Container;
use NIH\Container\ContainerConfig;

final class NihContainerAdapter implements ContainerAdapterInterface
{
    public function build(): void
    {
    }

    public function bootstrapSingletonContainer()
    {
        return new Container(new ContainerConfig(shared: true, maxDepth: 10));
    }

    public function bootstrapPrototypeContainer()
    {
        return new Container(new ContainerConfig(shared: false, maxDepth: 10));
    }
}
