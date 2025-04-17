@extends('layouts.app')

@section('title', 'NUDGER LIST')

@section('content')
<div>
    <a href="{{ Route('tasks.create') }}">Add task</a>
</div>
<div>
    <table>
        <thead>
            <tr>
                <th>Title</th>
                <th>Description</th>
                <th>Long Description</th>
                <th>Status</th>
                <th>Created At</th>
                <th>Updated At</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($tasks as $task)
            <tr>
                <td>
                    <a href="{{ route('tasks.show', ['task' => $task->id]) }}">{{ $task->description }}</a>
                </td>
                <td>{{ $task->description }}</td>
                <td>{{ $task->long_description ?: 'no long description' }}</td>
                <td>{{ $task->completed ? 'Completed' : 'Not completed' }}</td>
                <td>{{ $task->created_at->format('H:i, d F Y') }}</td>
                <td>{{ $task->updated_at->format('H:i, d F Y') }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="5">No tasks to show</td>
            </tr>
            @endforelse
            
            @if ($tasks->hasPages())
                <tr>
                    <td colspan="5">
                        {{ $tasks->links() }}
                    </td>
                </tr>
            @endif
        </tbody>
    </table>
</div>
@endsection