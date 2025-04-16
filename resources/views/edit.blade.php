@extends('layouts.app')
@section('title','Edit Task')
@section('styles')
    <style>
        .error-message {
            color:red;
            font-size: 0.8rem
        }
    </style>
@endsection

@section('content')
<form method="POST" action="{{ Route('tasks.update', ['task'=> $task->id]) }}">
    @csrf
     @method('PUT')   {{--Add a data properties tha will be sent with the form--}} 
    <div>
        <label for="title">Title</label>
         <input type="text" name="title" id="title" value="{{ $task->title }}"> {{-- old function to let the data typed be still when a error submit apear, and works on POST methods forms --}}
        @error('title')
            <p class="error-message">{{ $message }}</p>
        @enderror
    </div>
    <div>
        <label for="description">Description</label>
        <input type="text" name="description" id="description" rows="5" value="{{ $task->description }}">
        @error('description')
            <p class="error-message">{{ $message }}</p>
        @enderror
    </div>
    <div>
        <label for="long_description">Long Decription</label>
        <textarea type="text" name="long_description" id="long_description" rows="10">{{ $task->long_description }}</textarea>
        @error('long_description')
            <p class="error-message">{{ $message }}</p>
        @enderror
    </div>
    <div>
        <button type="submit">Edit Task</button>
    </div>
</form>
@endsection