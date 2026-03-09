<?php

declare(strict_types=1);

namespace DiContainerBenchmarks\Container\YiisoftDi;

use DiContainerBenchmarks\Container\ContainerAdapterInterface;
use DiContainerBenchmarks\Test\UnsupportedTestException;
use Yiisoft\Di\Container;
use Yiisoft\Di\ContainerConfig;

final class YiisoftDiContainerAdapter implements ContainerAdapterInterface
{
    public function build(): void
    {
    }

    public function bootstrapSingletonContainer()
    {
        return new Container(
            ContainerConfig::create()->withValidate(false)
        );
    }

    public function bootstrapPrototypeContainer()
    {
        throw new UnsupportedTestException("Yii DI doesn't support the prototype scope via the PSR-11 interface");
    }
}
