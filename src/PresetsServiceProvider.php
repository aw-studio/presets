<?php

namespace AwStudio\Presets;

use AwStudio\Presets\Console\AdminCommand;
use AwStudio\Presets\Console\AppCommand;
use AwStudio\Presets\Console\InertiaCommand;
use AwStudio\Presets\Console\SetupCommand;
use AwStudio\Presets\Console\TypeScriptCommand;
use AwStudio\Presets\Console\VueCommand;
use Illuminate\Support\ServiceProvider;

class PresetsServiceProvider extends ServiceProvider
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
            ]);
        }
    }
}
