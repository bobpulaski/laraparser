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

    <div class="container-fluid">
        <div class="row">
            <div class="col-6">
                <div class="card">
                    <div class="card-header">
                        <h3>Название</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('url.store') }}" method="POST">
                            @csrf

                            <div class="mb-3">
                                <input type="text" class="form-control" name="item_name"/>
                                {{-- Добавление скрытых полей для передачи в него параметров из URL --}}
                                <input type="hidden" class="form-control" name="chapter_id"
                                       value="{{ Request::get('chapter') }}">

                                <input type="hidden" class="form-control" name="project_id"
                                       value="{{ Request::get('project') }}">
                                <div id="name" class="form-text">URL</div>
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
