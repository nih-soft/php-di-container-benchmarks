<?php

declare(strict_types=1);

namespace DiContainerBenchmarks\Container\Nih;

use DiContainerBenchmarks\Container\ContainerAdapterInterface;
use DiContainerBenchmarks\Container\ContainerDefinitionInterface;

final class NihManualContainerDefinition implements ContainerDefinitionInterface
{
    public function getPackage(): string
    {
        return "nih/container";
    }

    public function getName(): string
    {
        return "nih-manual";
    }

    public function getDisplayedName(): string
    {
        return "NIH Container (Manual)";
    }

    public function isCompiled(): bool
    {
        return false;
    }

    public function isAutowiringSupported(): bool
    {
        return false;
    }

    public function getUrl(): string
    {
        return "https://github.com/nih-soft/container";
    }

    public function getAdapter(): ContainerAdapterInterface
    {
        return new NihManualContainerAdapter();
    }
}
