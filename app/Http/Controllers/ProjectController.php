<?php

namespace App\Http\Controllers;

use App\Task;
use App\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProjectController extends Controller
{

    public function index()
    {
        $projects = Project::where('is_completed', 0)
            ->orderBy('created_at', 'desc')
            ->withCount(['tasks' => function ($queryTask) {
                $queryTask->where('is_completed', 0);
            }])->get();

        return $projects->toJson();
    }

    public function store(Request $request)
    {
        // app('debugbar')->error('Project: ' . $request);

        $project = new Project();
        $project->name = $request->name;
        $project->description = $request->description;

        $task = new Task();
        $task->title =  $request->task_title;

        if ($project->save()) {
            $project->tasks()->save($task);
            return response()->json('Project created!');
        }

        return response()->json('Project not created!');
    }

    public function show(int $id)
    {
        //Inner join with orm
        $project = Project::with('tasks')->where('id', $id)->first();

        //Inner join with query builder
        // $project = DB::table('projects')
        // ->join('tasks', function ($join) {
        //     $join->on('projects.id', '=', 'tasks.project_id');
        // })
        // ->where('projects.id', '=', $id)
        // ->select('projects.name', 'projects.description', 'projects.created_at', 'tasks.title as title_task')
        // ->get();/

        //app('debugbar')->error('Project: ' . $project);

        return $project->toJson();
    }

    public function markAsCompleted(Project $project)
    {
        $project->is_completed = true;
        $project->update();

        return response()->json('Project updated');
    }
}
