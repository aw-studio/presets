<?php

namespace AwStudio\Snippets\Add;

use Illuminate\Support\Str;
use AwStudio\Snippets\BaseCommand;
use Illuminate\Support\Facades\File;
use Illuminate\Contracts\Filesystem\FileExistsException;

class PageAddCommand extends BaseCommand
{
    use Concerns\HasAdminOption;
    /**
     * The name of the console command.
     *
     * @var string
     */
    protected $signature = 'add:page
                            {name : Creates a Vue Page}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add a page to the resource';

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

        $outputName =  $path.'/'.$name.'.vue';

        if (File::exists($this->determineResourcePath($outputName))) {
            throw new FileExistsException("$outputName already exists");
        }

        File::ensureDirectoryExists($this->determineResourcePath($path));

        File::copy($this->determineStub(), $this->determineResourcePath($outputName));


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

        $path = Str::beforeLast($input, '/');
        $name = Str::afterLast($input, '/');

        return [
            $path,
            $name,
        ];
    }

    /**
     * Determine which resource path to
     *
     * @param string $path
     * @return string
     */
    public function determineResourcePath($path)
    {
        if ($this->option('admin')) {
            return resource_path('admin/js/'.$path);
        }
        return resource_path('/app/js/'.$path);
    }

    /**
     * Determine which stub to use.
     *
     * @return string
     */
    public function determineStub()
    {
        if ($this->option('admin')) {
            return $this->getStub('Pages/AdminPage.stub.vue');
        }
        return $this->getStub('Pages/DefaultPage.stub.vue');
    }
}