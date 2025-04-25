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
<form method="POST" action="{{ isset($task) ? Route('tasks.update', ['task'=> $task->id]) : Route('tasks.store') }}" class="max-w-2xl mx-auto bg-white p-6 rounded-lg shadow-md">
    @csrf
    @isset($task)
    @method('PUT')
    @endisset
    <div class="mb-4">
        <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
        <input type="text" name="title" id="title" value="{{ $task->title ?? old('title') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
        @error('title')
        <p class="error-message mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>
    <div class="mb-4">
        <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
        <input type="text" name="description" id="description" value="{{ $task->description ?? old('description') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
        @error('description')
        <p class="error-message mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>
    <div class="mb-4">
        <label for="long_description" class="block text-sm font-medium text-gray-700">Long Description</label>
        <textarea name="long_description" id="long_description" rows="10" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">{{ $task->long_description ?? old('long_description') }}</textarea>
        @error('long_description')
        <p class="error-message mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>
    <div class="mt-6">
        <button type="submit" class="w-full inline-flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
            {{ isset($task) ? 'Update Task' : 'Add Task' }}
        </button>
    </div>
</form>
@endsection