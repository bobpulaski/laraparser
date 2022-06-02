@extends('dashboard')

@php
    $title = 'Добавить новое правило';
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

    @if ($someMessage = Session::get('message'))
        <div class="content-header">
            <div class="container-fluid alert alert-success" role="alert">
                <strong>{{ $someMessage }}</strong>
            </div>
        </div>
    @endif

    <div class="container-fluid">
        <div class="row">
            <div class="col-6">
                <div class="card">
                    <div class="card-header">
                        <h3>Название</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('rule.store') }}" method="POST">
                            @csrf

                            <div class="mb-3">
                                <label for="header_name">Наименование заголовка в выходном файле</label>
                                <input type="text" class="form-control" name="header_name"/>
                                <div id="name" class="form-text mb-4">Не более 15 символов без пробелов</div>

                                <label for="rule_left">Левая часть строки условия</label>
                                <input type="text" class="form-control" name="rule_left"/>
                                <div id="name" class="form-text mb-4">Левая часть строки, до искомого значения.</div>


                            <label for="rule_right">Правая часть строки условия</label>
                            <input type="text" class="form-control" name="rule_right"/>
                            <div id="name" class="form-text">Правая часть строки, до искомого значения</div>

                            {{-- Добавление скрытых полей для передачи в него параметров из URL --}}
                            <input type="hidden" class="form-control" name="chapter_id"
                                   value="{{ Request::get('chapter') }}">

                            <input type="hidden" class="form-control" name="project_id"
                                   value="{{ Request::get('project') }}">
                    </div>

                    <button type="submit" class="btn btn-success">Добавить</button>
                    <a href="{{ url()->previous() }}" class="btn btn-secondary">Отмена</a>
                    </form>
                </div>

            </div>
        </div>
    </div>
    </div>

@endsection
