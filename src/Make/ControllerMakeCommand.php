<?php

namespace AwStudio\Snippets\Make;

use Illuminate\Routing\Console\ControllerMakeCommand as LaravelControllerMakeCommand;

class ControllerMakeCommand extends LaravelControllerMakeCommand
{
    use Concerns\IsAdminGeneratorCommand;
}
