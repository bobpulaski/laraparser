@extends('dashboard')

@php
$title = 'Добавление парсера к проекту ';
@endphp

@section('title')
    {{ $title }}
@endsection

@section('content')

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <h1>{{ $title }} <i>{{ $project->name }}</i></h1>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-6">
                <div class="card">
                    <div class="card-header">
                        <h3>Название парсера</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('chapter.store') }}" method="POST">
                            @csrf

                            <div class="mb-3">
                                <input type="text" class="form-control" name="item_name" />
                                {{-- Добавлено скрытое поле, для передачи в него параметра из URL --}}
                                <input type="hidden" class="form-control" name="project_id"
                                    value="{{ Request::get('project') }}">
                                <div id="name" class="form-text">Не более 15 символов, учитывая пробелы</div>
                            </div>

                            <button type="submit" class="btn btn-success">Добавить</button>
                            <a href="{{ url()->previous() }}" class="btn btn-secondary">Назад</a>
                        </form>
                    </div>

                </div>
            </div>
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
