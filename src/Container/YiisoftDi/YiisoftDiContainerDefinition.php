<?php

declare(strict_types=1);

namespace DiContainerBenchmarks\Container\YiisoftDi;

use DiContainerBenchmarks\Container\ContainerAdapterInterface;
use DiContainerBenchmarks\Container\ContainerDefinitionInterface;

final class YiisoftDiContainerDefinition implements ContainerDefinitionInterface
{
    public function getPackage(): string
    {
        return "yiisoft/di";
    }

    public function getName(): string
    {
        return "yiisoft-di";
    }

    public function getDisplayedName(): string
    {
        return "Yii DI";
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
        return "https://github.com/yiisoft/di";
    }

    public function getAdapter(): ContainerAdapterInterface
    {
        return new YiisoftDiContainerAdapter();
    }
}
