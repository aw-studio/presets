<?php

namespace AwStudio\Snippets;

use AwStudio\Snippets\Console\AdminCommand;
use AwStudio\Snippets\Console\AppCommand;
use AwStudio\Snippets\Console\InertiaCommand;
use AwStudio\Snippets\Console\PageBuilderCommand;
use AwStudio\Snippets\Console\SetupCommand;
use AwStudio\Snippets\Console\TypeScriptCommand;
use AwStudio\Snippets\Console\VueCommand;
use Illuminate\Support\ServiceProvider;

class SnippetsServiceProvider extends ServiceProvider
{
    /**
     * Register application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Boot application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerCommands();
    }

    /**
     * Register Deeplable command.
     *
     * @return void
     */
    public function registerCommands(): void
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                AdminCommand::class,
                AppCommand::class,
                InertiaCommand::class,
                SetupCommand::class,
                TypeScriptCommand::class,
                VueCommand::class,
                PageBuilderCommand::class,
            ]);
        }
    }
}
