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