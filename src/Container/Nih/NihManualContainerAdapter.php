<?php

declare(strict_types=1);

namespace DiContainerBenchmarks\Container\Nih;

use DiContainerBenchmarks\Container\ContainerAdapterInterface;
use NIH\Container\Arg;
use NIH\Container\Container;
use NIH\Container\ContainerConfig;

final class NihManualContainerAdapter implements ContainerAdapterInterface
{
    public function build(): void
    {
    }

    public function bootstrapSingletonContainer()
    {
        return new Container($this->createManualConfig(true));
    }

    public function bootstrapPrototypeContainer()
    {
        return new Container($this->createManualConfig(false));
    }

    private function createManualConfig(bool $shared): ContainerConfig
    {
        $config = new ContainerConfig(shared: $shared, maxDepth: 10);

        $config->manual("DiContainerBenchmarks\\Fixture\\A\\FixtureA1");
        for ($i = 2; $i <= 100; $i++) {
            $class = "DiContainerBenchmarks\\Fixture\\A\\FixtureA{$i}";
            $dependency = "DiContainerBenchmarks\\Fixture\\A\\FixtureA" . ($i - 1);
            $config->manual($class)->args([Arg::get($dependency)]);
        }

        for ($i = 1; $i <= 1000; $i++) {
            $config->manual("DiContainerBenchmarks\\Fixture\\B\\FixtureB{$i}");
        }

        $config->manual("DiContainerBenchmarks\\Fixture\\C\\FixtureC1");
        for ($i = 2; $i <= 1000; $i++) {
            $class = "DiContainerBenchmarks\\Fixture\\C\\FixtureC{$i}";
            $dependency = "DiContainerBenchmarks\\Fixture\\C\\FixtureC" . ($i - 1);
            $config->manual($class)->args([Arg::get($dependency)]);
        }

        return $config;
    }
}
