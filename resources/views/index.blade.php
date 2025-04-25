@extends('layouts.app')

@section('title', 'NUDGER LIST')

@section('content')

<div class="bg-white shadow-md rounded-lg p-6">

    <a href="{{ Route('tasks.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"> Add task </a>

    <ul>
        @forelse ($tasks as $task)
            <li class="border-b border-gray-200 flex items-center justify-between py-4">
                <label class="flex items-center">
                    <form action="{{ route('tasks.complete', ['task' => $task]) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="checkbox" onchange="this.form.submit()" {{ $task->completed ? 'checked' : '' }}
                        class="mr-2">
                    </form>
                    <span><a href="{{ route('tasks.show', ['task' => $task->id]) }}" 
                        @class(['line-through'=>$task->completed])>{{ $task->description }}</a>
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
        @empty
            <li>
                <td colspan="5">No tasks to show</td>
            </li>
        @endforelse

        @if ($tasks->hasPages())
        <ul class="mt-4">
            <li colspan="5">
                {{ $tasks->links() }}
            </li>
        </ul>
        @endif

    </ul>
</div>

@endsection