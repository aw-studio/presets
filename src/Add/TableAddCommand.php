<?php

namespace AwStudio\Snippets\Add;

use AwStudio\Snippets\BaseCommand;
use Illuminate\Contracts\Filesystem\FileExistsException;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class TableAddCommand extends BaseCommand
{
    /**
     * The name of the console command.
     *
     * @var string
     */
    protected $signature = 'add:table
                            {name : Creates Vue Table files for a given Path/Name}
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


        File::ensureDirectoryExists(resource_path('admin/js/'.$path));

        $this->createVueFile('Table', $path, $name);
        $this->createVueFile('TableHead', $path, $name);
        $this->createVueFile('TableBody', $path, $name);

        $this->info("Created ${name}Table, ${name}TableHead and ${name}TableBody");

        return 0;
    }

    /**
     * Parse the given input to determine name and path.
     *
     * @return array
     */
    public function parseInput()
    {
        $input = $this->argument('name');

        $path = Str::before($input, '/');
        $name = Str::afterLast($input, '/');

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

        $outputPath = resource_path('admin/js/'.$path.'/'.$name.$stub.'.vue');

        if (File::exists($outputPath)) {
            throw new FileExistsException("/admin/js/$path/$name$stub.vue already exists.");
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