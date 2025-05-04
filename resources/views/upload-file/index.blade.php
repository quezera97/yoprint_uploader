@extends('layouts.app')

@section('content')
    <div class="flex items-center justify-center w-4/5">
        @livewire('upload-file.upload')
    </div>
    <br>
    <div class="flex items-center justify-center w-4/5">
        @livewire('upload-file.table')
    </div>
@endsection
