@extends('layouts.app')

@section('title', 'NUDGER LIST')

@section('content')

<div>
    <a href="{{ Route('tasks.index') }}">Back to list</a>
</div>

<div>
    <h3>{{ $task->title }}</h3>
    <h4>{{ $task->description }}</h4>
    <p>{{ $task->long_description ?: '' }}</p>
    <p>{{ $task->created_at->format('H:i, d F Y') }}</p>
    <p>{{ $task->updated_at->format('H:i, d F Y') }}</p>
    <p>{{ $task->completed ? 'Completed' : 'Not completed' }}</p>

</div>

<div>
    <a href="{{ route ('tasks.edit', ['task' => $task]) }}"> Edit</a>
</div>

<div>
    <form action="{{ route('tasks.complete', ['task' => $task]) }}" method="POST">
        @csrf
        @method('PUT')
        <button type="submit">Mark as {{ $task->completed ? 'not completed' : 'completed' }}</button>
    </form>
</div>

<div>
    <form action="{{ route('tasks.destroy', ['task' => $task]) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit">Delete</button>
    </form>
</div>
@endsection