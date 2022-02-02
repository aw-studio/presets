<?php

namespace AwStudio\Snippets;

use AwStudio\Snippets\Add\TableAddCommand;
use AwStudio\Snippets\Install\AdminCommand;
use AwStudio\Snippets\Install\AppCommand;
use AwStudio\Snippets\Install\InertiaCommand;
use AwStudio\Snippets\Install\PageBuilderCommand;
use AwStudio\Snippets\Install\SetupCommand;
use AwStudio\Snippets\Install\TypeScriptCommand;
use AwStudio\Snippets\Install\VueCommand;
use AwStudio\Snippets\Make\ControllerMakeCommand;
use AwStudio\Snippets\Make\IndexMakeCommand;
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
        $this->registerCommands();
    }

    /**
     * Register Deeplable command.
     *
     * @return void
     */
    public function registerCommands(): void
    {
        $this->commands([
            // Install
            AdminCommand::class,
            AppCommand::class,
            InertiaCommand::class,
            SetupCommand::class,
            TypeScriptCommand::class,
            VueCommand::class,
            PageBuilderCommand::class,
            TableAddCommand::class,

            // Make
            IndexMakeCommand::class,
        ]);

        $this->registerControllerMakeCommand();
    }

    /**
     * Register the command.
     *
     * @return void
     */
    protected function registerControllerMakeCommand()
    {
        $this->app->extend('command.controller.make', function ($cmd, $app) {
            return new ControllerMakeCommand($app['files']);
        });
    }
}
