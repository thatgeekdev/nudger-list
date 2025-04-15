@extends('layouts.app')
@section('title','Add Task')


@section('content')
{{ $errors }}
<form method="POST" action="{{ Route('tasks.store') }}">
    @csrf  
    <div>
        <label for="title">Title</label>
        <input type="text" name="title" id="title">
    </div>
    <div>
        <label for="description">Description</label>
        <input type="text" name="description" id="description" rows="5">
    </div>
    <div>
        <label for="long_description">Long Decription</label>
        <input type="text" name="long_description" id="long_description" rows="10">
    </div>
    <div>
        <button type="submit">Add Task</button>
    </div>
</form>
@endsection