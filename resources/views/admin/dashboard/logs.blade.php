@extends('admin.layouts.layout')
@section('title', 'Logs')
@section('content')
    <div class="container-fluid flex-grow-1 p-3">
        <div class="embed-responsive embed-responsive-16by9">
            <iframe class="embed-responsive-item" src="{{ route('log-viewer::logs.list') }}" allowfullscreen>
            </iframe>
        </div>
    </div>

@endsection
