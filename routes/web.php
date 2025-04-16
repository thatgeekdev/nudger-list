<?php

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

Route::post('/tasks', function(Request $request){
    $data = $request->validate([
        'title' => 'required|max:255',
        'description' => 'required',
        'long_description' => 'required',
    ]);

    $task = new Task;
    $task -> title = $data['title'];
    $task -> description = $data['description'];
    $task -> long_description = $data['long_description'];
    $task->save();

    return redirect()->route('tasks.show',['id' => $task->id])->with('success', 'Task created succesfully');
})->name('tasks.store');
Route::get('/tasks/{id}', function ($id){
    return view('show', ['task'=>Task::findOrFail($id)]);
})->name('tasks.show');

Route::get('/tasks/{id}/edit', function ($id){
    return view('edit', ['task'=>Task::findOrFail($id)]);
})->name('tasks.edit');

Route::put('/tasks/{id}', function($id, Request $request){
    $data = $request->validate([
        'title' => 'required|max:255',
        'description' => 'required',
        'long_description' => 'required',
    ]);

    $task = Task::findOrFail($id);
    $task -> title = $data['title'];
    $task -> description = $data['description'];
    $task -> long_description = $data['long_description'];
    $task->save();

    return redirect()->route('tasks.show',['id' => $task->id])->with('success', 'Task updated succesfully');
})->name('tasks.update');






Route::fallback(Function () {
    return abort(Response::HTTP_NOT_FOUND);
});