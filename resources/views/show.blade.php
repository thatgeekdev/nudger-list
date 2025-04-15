@extends('layouts.app')

@section('title', 'NUDGER LIST')

@section('content')
<div>
    <h3>{{ $task->title }}</h3>
    <h4>{{ $task->description }}</h4>
    <p>{{ $task->long_description ?: '' }}</p>
    <p>{{ $task->completed ? 'Completed' : 'Not completed' }}</p>
    <p>{{ $task->created_at->format('H:i, d F Y') }}</p>
    <p>{{ $task->updated_at->format('H:i, d F Y') }}</p>

</div>
@endsection
