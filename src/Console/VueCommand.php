<?php

namespace AwStudio\Snippets\Console;

class VueCommand extends BaseCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $name = 'install:vue';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install Vue.js';

    /**
     * NPM dependencies.
     *
     * @var array
     */
    public $npmPackages = [
        'vue-loader',
        'vue@next',
        'vue-loader@next',
        '@vue/compiler-sfc',
    ];

    /**
     * Handle command.
     *
     * @return int
     */
    public function handle()
    {
        $this->rememberInstallingNpmPackages($this->npmPackages);

        return 0;
    }
}
