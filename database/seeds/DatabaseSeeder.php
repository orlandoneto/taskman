<?php

use App\Project;
use App\Task;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $project = Project::create([
            'name' => 'Orlando',
            'description' => 'Estudo de programação'
        ]);        

        $project->tasks()->create(['title' => 'Fazer sistema em laravel']);
    }
}
