<?php

declare(strict_types=1);

namespace DiContainerBenchmarks\Container\Nih;

use DiContainerBenchmarks\Container\ContainerAdapterInterface;
use DiContainerBenchmarks\Container\ContainerDefinitionInterface;

final class NihContainerDefinition implements ContainerDefinitionInterface
{
    public function getPackage(): string
    {
        return "nih/container";
    }

    public function getName(): string
    {
        return "nih";
    }

    public function getDisplayedName(): string
    {
        return "NIH Container";
    }

    public function isCompiled(): bool
    {
        return false;
    }

    public function isAutowiringSupported(): bool
    {
        return true;
    }

    public function getUrl(): string
    {
        return "https://github.com/nih-soft/container";
    }

    public function getAdapter(): ContainerAdapterInterface
    {
        return new NihContainerAdapter();
    }
}
