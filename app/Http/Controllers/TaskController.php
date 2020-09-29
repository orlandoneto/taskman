<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TaskController extends Controller
{
    public function store(Request $request)
    {        
        // Log::debug('Title: ' . $request['title']);
        // Log::debug('Project_id: ' . $request['project_id']);        
        // app('debugbar')->error('Project: ' . $request);
        
        $task = new Task();
        $task->title = $request->input('title');
        $task->project_id = $request->input('project_id');
        $task->save();

        return $task->toJson();
    }

    public function markAsCompleted(Task $task)
    {
        $task->is_completed = true;
        $task->update();
        return response()->json('Task updated');
    }
}
