<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class CreateRepository extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:repository {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new Repository';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Repository';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $filePath = app_path('Http/Repositories' . '/' . $this->argument('name') . '.php');
        $pathInfo = pathinfo($this->argument('name'));
        $dir = pathinfo($filePath);

        if (!File::exists($dir['dirname'])) {
            File::makeDirectory($dir['dirname']);
        }

        if (File::exists($filePath)) {
            $this->error($this->type . ' already exists');
            return false;
        }

        $repository = $this->replaceRepository(File::get($this->getStub()), $pathInfo);

        if (!File::put($filePath, $repository)) {
            $this->error('Unable to create ' . $this->argument('name'));
            return false;
        }
        $this->info($this->argument('name') . ' is created.');
        return true;
    }
    /**
     * Replace the class name for the given stub.
     *
     * @param  string  $stub
     * @param  string  $name
     * @return string
     */
    protected function replaceRepository($stub, $pathInfo)
    {
        $name = $pathInfo['filename'];
        $stub = $this->replaceNamespance($stub,  $pathInfo);
        return str_replace('{{repository}}', $name, $stub);
    }

    protected function replaceNamespance($stub, $pathInfo)
    {
        $namespace = $this->getNamespace($pathInfo['dirname']);
        return str_replace('{{namespace}}', $namespace, $stub);
    }

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return  app_path() . '/Console/Commands/Stubs/make-repository.stub';
    }

    /**
     * Get the default namespace for the repository.
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getNamespace($folderStructure)
    {
        $namespace = 'App\Http\Repositories';
        if ($folderStructure == '.') {
            return $namespace;
        }
        return $namespace . '\\' . str_replace('/','\\',$folderStructure);
    }
}
