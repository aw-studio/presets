<?php

namespace AwStudio\Snippets\Make;

use AwStudio\Snippets\BaseGeneratorCommand;
use Illuminate\Support\Facades\File;

class IndexMakeCommand extends BaseGeneratorCommand
{
    use Concerns\IsAdminGeneratorCommand;

    /**
     * The name of the console command.
     *
     * @var string
     */
    protected $name = 'make:index';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create an index';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Index';

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return $this->stubPath('index');
    }

    /**
     * Get the default namespace for the class.
     *
     * @param  string $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace.'\Http\Indexes';
    }
}
