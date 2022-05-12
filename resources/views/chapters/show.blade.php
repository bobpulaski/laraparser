@extends('dashboard')

@php
    $title = 'Раздел';
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

    <div class="container-fluid">
        <div class="row">


        </div>
    </div>

    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

@endsection

