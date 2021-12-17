<?php

namespace AwStudio\Presets\Console;

class PageBuilderCommand extends BaseCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $name = 'install:page-builder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install macrame pagebuilder';

    /**
     * Composer dependencies.
     *
     * @var array
     */
    public $composerPackages = [
        'aw-studio/laravel-page-builder',
    ];

    /**
     * NPM dependencies.
     *
     * @var array
     */
    public $npmPackages = [
        '@macramejs/page-builder-vue3',
    ];

    /**
     * Preset dependecies.
     *
     * @var array
     */
    public $needs = [
        AdminCommand::class,
    ];

    /**
     * Handle command.
     *
     * @return int
     */
    public function handle()
    {
        $this->needs($this->needs);

        $this->moveFilesTo('page-builder', base_path());

        $this->rememberInstallingComposerPackages($this->composerPackages);
        $this->rememberInstallingNpmPackages($this->npmPackages);

        $this->inserts();

        return 0;
    }

    protected function inserts()
    {
        // Routes
        $file = config_path('filesystems.php');
        $insert = "
      
        'files' => [
            'driver' => 'local',
            'root'   => storage_path('app/public/files'),
        ],";

        $after = "'root'   => storage_path('app'),".PHP_EOL.'        ],';
        $this->insertAfter($file, $insert, $after);

        // Sidebar
        $file = resource_path('admin/js/layout/Sidebar.vue');

        $insert = "
        <Link
            href=\"/admin/sites\"
            class=\"flex hover:text-green\"
            :class=\"{ 'text-green': page.includes('/admin/sites') }\"
        >
            <svg
                xmlns=\"http://www.w3.org/2000/svg\"
                viewBox=\"-2 -4 24 24\"
                width=\"24\"
                fill=\"currentColor\"
                class=\"w-5 h-5 mr-4\"
            >
                <path
                    d=\"M2,4 L2,14 L18,14 L18,4 L2,4 Z M3,3 C3.55228475,3 4,2.55228475 4,2 C4,1.44771525 3.55228475,1 3,1 C2.44771525,1 2,1.44771525 2,2 C2,2.55228475 2.44771525,3 3,3 Z M6,3 C6.55228475,3 7,2.55228475 7,2 C7,1.44771525 6.55228475,1 6,1 C5.44771525,1 5,1.44771525 5,2 C5,2.55228475 5.44771525,3 6,3 Z M2,0 L18,0 C19.1045695,0 20,0.8954305 20,2 L20,14 C20,15.1045695 19.1045695,16 18,16 L2,16 C0.8954305,16 0,15.1045695 0,14 L0,2 C0,0.8954305 0.8954305,0 2,0 Z\"
                ></path>
            </svg>
            Seiten
        </Link>";

        $after = '<nav class="space-y-6 tracking-widest">';
        $this->insertAfter($file, $insert, $after);

        // Routes
        $file = base_path('routes/admin.php');
        $insert = "
    Route::get('/sites', [SiteController::class, 'index'])->name('sites.index');
    Route::get('/sites/items', [SiteController::class, 'items'])->name('sites.items');
    Route::get('/sites/{site}', [SiteController::class, 'show'])->name('sites.show');
    Route::post('/sites/{site}', [SiteController::class, 'update'])->name('sites.update');
    Route::post('/sites/{site}/upload', [SiteController::class, 'upload'])->name('sites.upload');
        ";
        $after = "'middleware' => AuthenticateAdmin::class,".PHP_EOL.'], function () {';
        $this->insertAfter($file, $insert, $after);
    }
}
