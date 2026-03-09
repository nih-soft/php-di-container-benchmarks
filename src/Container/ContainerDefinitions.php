<?php

declare(strict_types=1);

namespace DiContainerBenchmarks\Container;

use DiContainerBenchmarks\Container\Aura\AuraContainerDefinition;
use DiContainerBenchmarks\Container\Chubbyphp\ChubbyphpContainerDefinition;
use DiContainerBenchmarks\Container\Dice\DiceContainerDefinition;
use DiContainerBenchmarks\Container\Joomla\JoomlaContainerDefinition;
use DiContainerBenchmarks\Container\LaminasServiceManager\LaminasServiceManagerContainerDefinition;
use DiContainerBenchmarks\Container\Laravel\LaravelContainerDefinition;
use DiContainerBenchmarks\Container\Nette\NetteContainerDefinition;
use DiContainerBenchmarks\Container\Nih\NihContainerDefinition;
use DiContainerBenchmarks\Container\Nih\NihManualContainerDefinition;
use DiContainerBenchmarks\Container\PhpDi\PhpDiContainerDefinition;
use DiContainerBenchmarks\Container\Symfony\SymfonyContainerDefinition;
use DiContainerBenchmarks\Container\YiisoftDi\YiisoftDiContainerDefinition;
use DiContainerBenchmarks\Container\Yii2\Yii2ContainerDefinition;
use DiContainerBenchmarks\Container\Zen\ZenContainerDefinition;

final class ContainerDefinitions
{
    /**
     * @return ContainerDefinitionInterface[]
     */
    public static function getAllContainerDefinitions(): array
    {
        return [
            new NihContainerDefinition(),
            new NihManualContainerDefinition(),
            new YiisoftDiContainerDefinition(),
            new Yii2ContainerDefinition(),
            new SymfonyContainerDefinition(),
            new ZenContainerDefinition(),
            new AuraContainerDefinition(),
            new ChubbyphpContainerDefinition(),
            new DiceContainerDefinition(),
            new JoomlaContainerDefinition(),
            new LaminasServiceManagerContainerDefinition(),
            new LaravelContainerDefinition(),
            new NetteContainerDefinition(),
            new PhpDiContainerDefinition(),
        ];
    }

    public static function getContainerDefinition(string $name): ?ContainerDefinitionInterface
    {
        foreach (self::getAllContainerDefinitions() as $definition) {
            if ($definition->getName() === $name) {
                return $definition;
            }
        }

        return null;
    }
}
