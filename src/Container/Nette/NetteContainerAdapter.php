<?php

declare(strict_types=1);

namespace DiContainerBenchmarks\Container\Nette;

use DiContainerBenchmarks\Container\ContainerAdapterInterface;
use DiContainerBenchmarks\Test\UnsupportedTestException;
use Nette\DI\Compiler;
use RuntimeException;

use function file_exists;
use function file_put_contents;
use function is_dir;
use function mkdir;
use function sprintf;
use function unlink;

final class NetteContainerAdapter implements ContainerAdapterInterface
{
    public function build(): void
    {
        $resourcePath = PROJECT_ROOT . "/src/Container/Nette/Resource";
        $compiledFile = $resourcePath . "/CompiledSingletonContainer.php";

        $result = @mkdir($resourcePath, 0777, true) || is_dir($resourcePath);
        if ($result === false) {
            throw new RuntimeException(sprintf("Unable to create directory: %s", $resourcePath));
        }

        if (file_exists($compiledFile)) {
            unlink($compiledFile);
        }

        $compiler = new Compiler();
        $compiler->setClassName("NetteCompiledSingletonContainer");
        $compiler->loadDefinitionsFromConfig($this->getDefinitionsConfig());

        $code = $compiler->compile();
        file_put_contents($compiledFile, "<?php\n" . $code);
    }

    public function bootstrapSingletonContainer()
    {
        require_once __DIR__ . "/Resource/CompiledSingletonContainer.php";

        return new NettePsrContainer(new \NetteCompiledSingletonContainer());
    }

    public function bootstrapPrototypeContainer()
    {
        throw new UnsupportedTestException("Nette DI doesn't support the prototype scope via the PSR-11 interface");
    }

    /**
     * @return array<int, string>
     */
    private function getDefinitionsConfig(): array
    {
        $definitions = [];

        for ($i = 1; $i <= 100; $i++) {
            $definitions[] = "DiContainerBenchmarks\\Fixture\\A\\FixtureA{$i}";
        }

        for ($i = 1; $i <= 1000; $i++) {
            $definitions[] = "DiContainerBenchmarks\\Fixture\\B\\FixtureB{$i}";
        }

        for ($i = 1; $i <= 1000; $i++) {
            $definitions[] = "DiContainerBenchmarks\\Fixture\\C\\FixtureC{$i}";
        }

        return $definitions;
    }
}
