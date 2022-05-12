@extends('dashboard')

@php
    $title = 'Изменить проект';
@endphp

@section('title')
    {{ $title }}
@endsection

@section('content')

    <h1>{{ $title }}</h1>



    <form style="width: 50%" action="{{ route('project.update', $currentRecord[0]->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <input type="text" class="form-control" name="name" value="{{ $currentRecord[0]->name }}"/>
            <div id="name" class="form-text">Не более 15 символов, учитывая пробелы</div>
        </div>

            <div class="wrap-1">
                <button type="submit" class="btn btn-success">Сохранить</button>
                {{--TODO Проверить при прямой подстановке--}}
                <a class="btn btn-secondary" href="{{ route('dashboard') }}" role="button">Отмена</a>
            </div>

    </form>




@endsection

