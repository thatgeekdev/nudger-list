<?php

use App\Http\Requests\TaskRequest;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\RouteAction;
use Illuminate\Support\Facades\Route;
use Psy\TabCompletion\Matcher\FunctionsMatcher;


Route::get('/', function () {
    return redirect()->route('tasks.index');
});
Route::get('/tasks', function () {
    return view('index', ['tasks'=>Task::latest()->get()]);
})->name('tasks.index');

Route::view('/tasks/create','create')->name('tasks.create');

Route::post('/tasks', function(TaskRequest $request){
    $task = Task::create($request->validated()); ////alternative way to create data by sending straight the validated with create and validated functions

    return redirect()->route('tasks.show',['task' => $task->id])
        ->with('success', 'Task created succesfully');
        })->name('tasks.store');

Route::get('/tasks/{task}', function (Task $task){
    return view('show', ['task'=>$task]);
})->name('tasks.show');

Route::get('/tasks/{task}/edit', function (Task $task){
    return view('edit', [
        'task'=>$task
    ]);
})->name('tasks.edit');

Route::put('/tasks/{task}', function(Task $task, TaskRequest $request){
    $task->update($request->validated()); //alternative way to update data by sending straight the validated with update and validated functions. 
    return redirect()->route('tasks.show',['task' => $task->id])->with('success', 'Task updated succesfully');
})->name('tasks.update');

Route::delete('/tasks/{task}', function(Task $task){
    $task->delete();

    return redirect()->route('tasks.index')
        ->withe('success', 'Task deleted successfully');
})->name('tasks.destroy');

Route::fallback(Function () {
    return abort(Response::HTTP_NOT_FOUND);
});