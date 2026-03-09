<?php

declare(strict_types=1);

namespace DiContainerBenchmarks\Container\Dice;

use Dice\Dice;
use Psr\Container\ContainerInterface;

final class DecoratedDice extends Dice implements ContainerInterface
{
    public function has(string $id): bool
    {
        return true;
    }

    public function get(string $id): mixed
    {
        return $this->create($id);
    }
}
