<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
class MakeCrudCommand extends Command
{
    protected $signature = 'make:crud {model}';

    protected $description = 'generate crud model-view-controler isues';

    public function handle()
    {
        $model = $this->argument('model');

        $this->call('make:model', ['name' => $model]);

        $this->call('make:resource', ['name' => $model]);

        $this->call('make:migration', ['name' => 'create_' . $model . '_table']);

        $this->call('make:factory', ['name' => $model . 'Factory']);

        $this->call('make:seeder', ['name' => $model . 'Seeder']);

        $this->generateRoutes($model);

        $this->call('make:controller', ['name' => $model . 'Controller']);

        $this->call('make:request', ['name' => $model . 'Request']);
        
        $this->call('make:test', ['name' => $model . 'Test']);
    }
    protected function generateRoutes($model)
    {
        $controller = $model . 'Controller';
        $resource = Str::snake(Str::plural($model));

        $routeContent = "\nRoute::resource('$resource', $controller::class)->middleware('web');\n";

        $routesFile = base_path('routes/web.php');

        file_put_contents($routesFile, $routeContent, FILE_APPEND);

        $this->info("Routes for $model created successfully!");
    }
}