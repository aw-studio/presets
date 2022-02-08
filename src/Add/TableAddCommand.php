<?php

namespace AwStudio\Snippets\Add;

use AwStudio\Snippets\BaseCommand;
use Illuminate\Contracts\Filesystem\FileExistsException;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class TableAddCommand extends BaseCommand
{
    use Concerns\HasAdminOption;

    /**
     * The name of the console command.
     *
     * @var string
     */
    protected $signature = 'add:table
                            {resource : The resource (path) for which the table should be created}
                            {name? : Specify the table name (resource name is used by default)}
                            ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add a new resource table';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Gets the stub path.
     *
     * @param  string $name
     * @return string
     */
    protected function getStub($name)
    {
        return __DIR__."/../../stubs/{$name}";
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        [$path, $name] = $this->parseInput();

        File::ensureDirectoryExists(resource_path($this->determineResourcePath($path)));

        $this->createVueFile('Table', $path, $name);
        $this->createVueFile('TableHead', $path, $name);
        $this->createVueFile('TableBody', $path, $name);

        $this->info("Created ${name}Table, ${name}TableHead and ${name}TableBody in " . $this->determineResourcePath($path));

        return 0;
    }

    /**
     * Parse the given input to determine name and path.
     *
     * @return array
     */
    public function parseInput()
    {
        $input = $this->argument('resource');

        if ($this->argument('name')) {
            $name = Str::ucfirst($this->argument('name'));
        } else {
            $name = Str::of($input)->afterLast('/')->singular()->ucfirst();
        }

        $path = Str::of($input)->before('/')->ucfirst();

        if (Str::contains($name, 'Table')) {
            $name = Str::before($name, 'Table');
        }

        return [
            $path,
            $name,
        ];
    }

    /**
     * Create a new vue file from a given Stub file name in a given path and name,.
     *
     * @param string $stub
     * @param string $path
     * @param string $name
     * @return void
     * @throws FileExistsException
     */
    public function createVueFile($stub, $path, $name)
    {
        $file = $this->getStub($stub.'.stub.vue');

        $content = $this->replaceFileContent(File::get($file), $name);

        $outputName =  $path.'/'.$name.''.$stub.'.vue';

        $outputPath = resource_path($this->determineResourcePath($outputName));

        if (File::exists($outputPath)) {
            throw new FileExistsException("$outputName already exists");
        }

        File::put($outputPath, $content);
    }

    /**
     * Replaces strings in the stub file with the corresponding term based on
     * the given resource name.
     *
     * @param string $content
     * @param string $resourceName
     * @return string
     */
    public function replaceFileContent($content, $resourceName)
    {
        return Str::of($content)
            ->replace('{{ Resource }}', Str::ucfirst($resourceName))
            ->replace('{{ resource }}', Str::lower($resourceName))
            ->replace(
                '{{ routeResource }}',
                Str::of($resourceName)->plural(100)->lower()
            );
    }
}