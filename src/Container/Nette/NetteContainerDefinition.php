<?php

declare(strict_types=1);

namespace DiContainerBenchmarks\Container\Nette;

use DiContainerBenchmarks\Container\ContainerAdapterInterface;
use DiContainerBenchmarks\Container\ContainerDefinitionInterface;

final class NetteContainerDefinition implements ContainerDefinitionInterface
{
    public function getPackage(): string
    {
        return "nette/di";
    }

    public function getName(): string
    {
        return "nette";
    }

    public function getDisplayedName(): string
    {
        return "Nette DI";
    }

    public function isCompiled(): bool
    {
        return true;
    }

    public function isAutowiringSupported(): bool
    {
        return true;
    }

    public function getUrl(): string
    {
        return "https://github.com/nette/di";
    }

    public function getAdapter(): ContainerAdapterInterface
    {
        return new NetteContainerAdapter();
    }
}
