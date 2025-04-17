@extends('layouts.app')

@section('title', 'NUDGER LIST')

@section('content')

<div class="bg-white shadow-md rounded-lg p-6">

    <div class="flex justify-end mb-4">
        <a href="{{ Route('tasks.index') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            ← Go back to the task list
        </a>
    </div>
    <li class="border-b border-gray-200 flex items-center justify-between py-4">
        <label class="flex items-center">
            <form action="{{ route('tasks.complete', ['task' => $task]) }}" method="POST">
                @csrf
                @method('PUT')
                <input type="checkbox" onchange="this.form.submit()" {{ $task->completed ? 'checked' : '' }}
                class="mr-2">
            </form>
            <span><a href="{{ route('tasks.show', ['task' => $task->id]) }}" 
                @class(['line-through'=>$task->completed])>{{ $task->title }}</a>
            </span>
        </label>
        <div class="flex items-center space-x-2">
            <form action="{{ route('tasks.destroy', ['task' => $task]) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="text-red-500 hover:text-red-700">🗑️</button>
            </form>
            <a href="{{ route('tasks.edit', ['task' => $task]) }}" class="text-gray-700 hover:text-blue-500">✏️</a>
        </div>
    </li>
    <div class="border rounded-lg p-4 mb-4 bg-gray-50 shadow-sm">
        <h4 class="text-lg font-semibold text-gray-800">{{ $task->description }}</h4>
        @if($task->long_description)
            <p class="text-sm text-gray-600 mt-2">{{ $task->long_description }}</p>
        @endif
        <div class="text-xs text-gray-500 mt-3">
            <p>Created: {{ $task->created_at->format('M d, Y h:i A') }}</p>
            <p>Last Updated: {{ $task->updated_at->format('M d, Y h:i A') }}</p>
        </div>
    </div>

    
</div>
@endsection