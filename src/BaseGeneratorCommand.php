<?php

namespace AwStudio\Snippets;

use Illuminate\Console\GeneratorCommand;

abstract class BaseGeneratorCommand extends GeneratorCommand
{
    /**
     * Gets the stub path.
     *
     * @param  string $name
     * @return string
     */
    protected function stubPath($name)
    {
        return __DIR__."/../stubs/{$name}.stub.php";
    }
}
