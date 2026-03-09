<?php

declare(strict_types=1);

namespace DiContainerBenchmarks\Container\Nette;

use Nette\DI\Container;
use Psr\Container\ContainerInterface;
use Psr\Container\NotFoundExceptionInterface;
use RuntimeException;

final class NettePsrContainer implements ContainerInterface
{
    private Container $container;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    public function has(string $id): bool
    {
        return [] !== $this->container->findByType($id);
    }

    public function get(string $id): mixed
    {
        $service = $this->container->getByType($id, false);

        if ($service === null) {
            throw new NetteContainerNotFoundException("Service of type \"$id\" not found");
        }

        return $service;
    }
}

final class NetteContainerNotFoundException extends RuntimeException implements NotFoundExceptionInterface
{
}
