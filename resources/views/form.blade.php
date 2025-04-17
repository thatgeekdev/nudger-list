@extends('layouts.app')
@section('title', isset($task) ? 'Edit Task' : 'Add Task')

@section('styles')
<style>
    .error-message {
        color: red;
        font-size: 0.8rem
    }
</style>
@endsection

@section('content')
<form method="POST" action="{{ isset($task) ? Route('tasks.update', ['task'=> $task->id]) : Route('tasks.store') }}">
    @csrf
    @isset($task)
    @method('PUT')
    @endisset
    <div>
        <label for="title">Title</label>
        <input type="text" name="title" id="title" value="{{ $task->title ?? old('title') }}">
        @error('title')
        <p class="error-message">{{ $message }}</p>
        @enderror
    </div>
    <div>
        <label for="description">Description</label>
        <input type="text" name="description" id="description" value="{{ $task->description ?? old('description') }}"
            rows="5">
        @error('description')
        <p class="error-message">{{ $message }}</p>
        @enderror
    </div>
    <div>
        <label for="long_description">Long Decription</label>
        <textarea type="text" name="long_description" id="long_description"
            value="{{ $task->long_description ?? old('long_description') }}" rows="10"></textarea>
        @error('long_description')
        <p class="error-message">{{ $message }}</p>
        @enderror
    </div>
    <div>
        <button type="submit"> {{ isset($task) ? 'Update Task' : 'Add Task' }}</button>
    </div>
</form>
@endsection