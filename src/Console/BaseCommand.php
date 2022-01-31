<?php

namespace AwStudio\Snippets\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Symfony\Component\Console\Input\InputOption;

abstract class BaseCommand extends Command
{
    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['no-installation-reminder', null, InputOption::VALUE_NONE, 'Whether the developer should be reminded to install dependencies.'],
        ];
    }

    /**
     * Insert code in the given file.
     *
     * @param  string $path
     * @param  string $insert
     * @param  string $after
     * @return void
     */
    protected function insertAfter(string $path, string $insert, string $after)
    {
        $content = file_get_contents($path);

        if (str_contains($content, $insert)) {
            return;
        }
        $content = str_replace($after, $after.PHP_EOL.$insert, $content);

        file_put_contents($path, $content);

        $this->info("{$path} changed, please check it for correction and formatting.");
    }

    /**
     * Move files to destination.
     *
     * @param  string $group
     * @param  string $destination
     * @return void
     */
    protected function moveFilesTo(string $group, string $destination)
    {
        if (! File::exists($destination)) {
            File::makeDirectory($destination);
        }

        File::copyDirectory(__DIR__."/../../snippets/{$group}/.", $destination);
    }

    /**
     * Add namesapce to the composer json.
     *
     * @param  string $namespace
     * @param  string $path
     * @param  bool   $dev
     * @return void
     */
    protected function addNamespace(string $namespace, string $path, $dev = false)
    {
        if (! Str::endsWith($namespace, '\\')) {
            $namespace .= '\\';
        }

        $composer = json_decode(file_get_contents(base_path('composer.json')), true);
        $autoload = $dev ? 'autoload-dev' : 'autoload';

        if (array_key_exists($namespace, $composer[$autoload]['psr-4'])) {
            return;
        }

        $composer[$autoload]['psr-4'][$namespace] = $path;

        file_put_contents('composer.json', json_encode($composer, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT).PHP_EOL);

        $this->line("Added namespace {$namespace} for path {$path}. Please run");
        $this->info('composer dump-autoload.');
    }

    /**
     * Remind the developer to install the given dependencies.
     *
     * @param  array $packages
     * @return void
     */
    protected function rememberInstallingComposerPackages(array $packages)
    {
        if ($this->option('no-installation-reminder')) {
            return;
        }

        $composer = json_decode(file_get_contents(base_path('composer.json')), true);

        $missing = [];

        foreach ($packages as $package) {
            if (array_key_exists('require', $composer)) {
                if (array_key_exists($package, $composer['require'])) {
                    continue;
                }
            }
            if (array_key_exists('require-dev', $composer)) {
                if (array_key_exists($package, $composer['require-dev'])) {
                    continue;
                }
            }
            $missing[] = $package;
        }

        if (empty($missing)) {
            return;
        }

        $command = 'composer require '.implode(' ', $missing);

        $this->line('Some composer packages are missing, please run the following command to install them:');
        $this->info($command);
    }

    /**
     * Remind the developer to install the given dependencies.
     *
     * @param  array $packages
     * @return void
     */
    protected function rememberInstallingNpmPackages(array $packages)
    {
        if ($this->option('no-installation-reminder')) {
            return;
        }

        $packagejson = json_decode(file_get_contents(base_path('package.json')), true);

        $missing = [];

        foreach ($packages as $package) {
            if (array_key_exists('dependencies', $packagejson)) {
                if (array_key_exists($package, $packagejson['dependencies'])) {
                    continue;
                }
            }
            if (array_key_exists('devDependencies', $packagejson)) {
                if (array_key_exists($package, $packagejson['devDependencies'])) {
                    continue;
                }
            }
            $missing[] = $package;
        }

        if (empty($missing)) {
            return;
        }

        $command = 'npm i '.implode(' ', $missing);

        $this->line('Some npm dependencies are missing, please run the following command to install them:');
        $this->info($command);
    }

    public function needs(array $dependencies)
    {
        foreach ($dependencies as $class) {
            $instance = new $class;

            $this->call($instance->name, ['--no-installation-reminder' => true]);

            if (property_exists($this, 'npmPackages') && property_exists($instance, 'npmPackages')) {
                foreach ($instance->npmPackages as $npmPackage) {
                    $this->npmPackages[] = $npmPackage;
                }
            }
            if (property_exists($this, 'composerPackages') && property_exists($instance, 'composerPackages')) {
                foreach ($instance->composerPackages as $composerPackage) {
                    $this->composerPackages[] = $composerPackage;
                }
            }
        }
        $this->input->setOption('no-installation-reminder', false);
    }
}
