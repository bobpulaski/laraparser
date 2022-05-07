@extends('dashboard')

@php
    $title = 'Добавление нового проекта';
@endphp

@section('title')
    {{ $title }}
@endsection

@section('content')

    <h1>{{ $title }}</h1>

    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif



    <form action="{{ route('project.store') }}" method="POST" class="w-25">
        @csrf

        <div class="mb-3">
            <label for="item_name" class="form-label">Название</label>
            <input type="text" class="form-control" name="item_name"/>
            <div id="name" class="form-text">Не более 15 символов, учитывая пробелы</div>
        </div>

        <button type="submit" class="btn btn-primary">Добавить</button>
        <a href="{{ url()->previous() }}">Назад</a>
    </form>

@endsection

