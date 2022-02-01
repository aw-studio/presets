<?php

namespace AwStudio\Snippets\Console;

use Illuminate\Support\Facades\File;

class AdminCommand extends BaseCommand
{
    /**
     * The name of the console command.
     *
     * @var string
     */
    protected $name = 'install:admin';

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
        'macramejs/macrame-laravel',
    ];

    /**
     * NPM dependencies.
     *
     * @var array
     */
    public $npmPackages = [
        'tailwindcss',
        'lodash.merge',
        '@headlessui/vue',
        '@macramejs/admin-vue3',
        '@macramejs/admin-config',
        '@macramejs/admin-vue3',
        '@macramejs/macrame',
        '@macramejs/macrame-vue3',
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

        $this->addNamespace('Admin\\', 'admin/');

        $this->deleteWebpackIfExists();

        $this->moveFilesTo('admin/root', base_path());
        $this->moveFilesTo('admin/migrations', database_path('migrations'));
        $this->moveFilesTo('admin/routes', base_path('routes'));
        $this->moveFilesTo('admin/resources', resource_path());
        $this->moveFilesTo('admin/views', resource_path('views'));
        $this->moveFilesTo('admin/Requests', app_path('Http/Requests'));

        $this->inserts();

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

    protected function inserts()
    {
        // Routes
        $file = app_path('Providers/RouteServiceProvider.php');
        $insert = "
        Route::middleware('web')
            ->prefix('admin')
            ->as('admin.')
            ->namespace(\$this->namespace)
            ->group(base_path('routes/admin.php'));";

        $after = "->group(base_path('routes/web.php'));";

        $this->insertAfter($file, $insert, $after);

        // admin home
        $file = app_path('Providers/RouteServiceProvider.php');
        $insert = "
        /**
         * The path to the admin dashboard of your application.
         *
         * This is used by Laravel authentication to redirect users after login.
         *
         * @var string
         */
        public const ADMIN_HOME = '/admin';";
        $after = "public const HOME = '/home';";

        $this->insertAfter($file, $insert, $after);
    }
}
