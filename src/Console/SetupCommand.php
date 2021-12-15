<?php

namespace AwStudio\Presets\Console;

class SetupCommand extends BaseCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $name = 'install:setup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Handle command.
     *
     * @return int
     */
    public function handle()
    {
        $this->moveFilesTo('setup', base_path());

        return 0;
    }
}
