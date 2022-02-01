<?php

namespace AwStudio\Snippets\Make\Concerns;

use Illuminate\Support\Str;
use Symfony\Component\Console\Input\InputOption;

trait IsAdminGeneratorCommand
{
    /**
     * Get the root namespace for the class.
     *
     * @return string
     */
    protected function rootNamespace()
    {
        if ($this->option('admin')) {
            return 'Admin';
        }

        return parent::rootNamespace();
    }

    /**
     * Get the destination class path.
     *
     * @param  string $name
     * @return string
     */
    protected function getPath($name)
    {
        if ($this->option('admin')) {
            $name = Str::replaceFirst($this->rootNamespace(), '', $name);

            return base_path('admin/'.str_replace('\\', '/', $name).'.php');
        }

        parent::getPath($name);
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return array_merge([
            ['admin', null, InputOption::VALUE_NONE, 'Whether to add the index to the admin namespace.'],
        ], parent::getOptions());
    }
}
