<?php

namespace AwStudio\Snippets\Add\Concerns;

use Symfony\Component\Console\Input\InputOption;

trait HasAdminOption
{
    /**
     * Add the '--admin' option
     *
     * @return void
     */
    protected function configure()
    {
        parent::configure();

        $this->getDefinition()->addOption(
            new InputOption(
                '--admin',
                null,
                InputOption::VALUE_NONE,
                'Run inside the admin namespace'
            )
        );
    }

    /**
     * Determine which resource path to use.
     *
     * @param string $path
     * @return string
     */
    public function determineResourcePath($path)
    {
        if ($this->option('admin')) {
            return 'admin/js/'.$path;
        }
        return '/app/js/'.$path;
    }
}