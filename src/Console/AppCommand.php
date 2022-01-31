<?php

namespace AwStudio\Snippets\Console;

use Illuminate\Support\Facades\File;

class AppCommand extends BaseCommand
{
    /**
     * The name of the console command.
     *
     * @var string
     */
    protected $name = 'install:app';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Composer dependencies.
     *
     * @var array
     */
    public $composerPackages = [
        'inertiajs/inertia-laravel',
    ];

    /**
     * NPM dependencies.
     *
     * @var array
     */
    public $npmPackages = [
        'tailwindcss',
    ];

    /**
     * Preset dependecies.
     *
     * @var array
     */
    public $needs = [
        SetupCommand::class,
        InertiaCommand::class,
        TypescriptCommand::class,
    ];

    /**
     * Handle command.
     *
     * @return int
     */
    public function handle()
    {
        $this->needs($this->needs);

        $this->deleteWebpackIfExists();

        $this->moveFilesTo('app/root', base_path());
        $this->moveFilesTo('app/resources', resource_path());
        $this->moveFilesTo('app/views', resource_path('views'));

        $this->rememberInstallingComposerPackages($this->composerPackages);
        $this->rememberInstallingNpmPackages($this->npmPackages);

        return 0;
    }

    protected function deleteWebpackIfExists()
    {
        $webpack = base_path('webpack.mix.js');
        if (File::exists($webpack)) {
            File::delete($webpack);
        }
    }
}
