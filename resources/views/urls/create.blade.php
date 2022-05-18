@extends('dashboard')

@php
    $title = 'Добавить новый URL';
@endphp

@section('title')
    {{ $title }}
@endsection

@section('content')

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <h1>{{ $title }}</h1>
            </div>
        </div>
    </div>

@endsection
