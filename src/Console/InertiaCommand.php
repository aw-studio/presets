<?php

namespace AwStudio\Snippets\Console;

use Illuminate\Support\Facades\File;

class InertiaCommand extends BaseCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $name = 'install:inertia';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install Inertia.js';

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
        '@inertiajs/inertia',
        '@inertiajs/inertia-vue3',
        '@inertiajs/progress',
    ];

    /**
     * Preset dependecies.
     *
     * @var array
     */
    public $needs = [
        VueCommand::class,
    ];

    /**
     * Handle command.
     *
     * @return int
     */
    public function handle()
    {
        $this->needs($this->needs);

        $this->moveFilesTo('inertia/middleware', app_path('Http/Middleware'));

        $this->rememberInstallingComposerPackages($this->composerPackages);
        $this->rememberInstallingNpmPackages($this->npmPackages);

        $this->inserts();

        return 0;
    }

    protected function inserts()
    {
        // Routes
        $file = app_path('Http/Kernel.php');
        $insert = "            \App\Http\Middleware\HandleInertiaRequests::class,";
        $after = "\App\Http\Middleware\VerifyCsrfToken::class,".PHP_EOL."            \Illuminate\Routing\Middleware\SubstituteBindings::class,";
        $this->insertAfter($file, $insert, $after);

        if (! File::exists(app_path('Http/Middleware/HandleInertiaRequests.php'))) {
            $this->line('Please run the following command to install the middleware:');
            $this->info('php artisan inertia:middleware');
        }
    }
}
