<?php

namespace AwStudio\Presets\Console;

class TypeScriptCommand extends BaseCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $name = 'install:ts';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install Typescript';

    /**
     * NPM dependencies.
     *
     * @var array
     */
    public $npmPackages = [
        'ts-loader',
        'typescript',
    ];

    /**
     * Handle command.
     *
     * @return int
     */
    public function handle()
    {
        $this->moveFilesTo('ts', base_path());

        $this->rememberInstallingNpmPackages($this->npmPackages);

        return 0;
    }
}
