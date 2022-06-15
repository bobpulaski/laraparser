@extends('dashboard')

@section('content')

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{ $chapter->name }}</h1>
                </div>
            </div>
        </div>
    </section>

    <div class="card">

        <div class="card-body">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="urls-tab" data-toggle="tab" href="#urls" role="tab"
                       aria-controls="urls-tab" aria-selected="">1. Список ссылок</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="rules-tab" data-toggle="tab" href="#rules" role="tab"
                       aria-controls="rules-tab" aria-selected="">2. Правила</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="play-tab" data-toggle="tab" href="#play" role="tab"
                       aria-controls="play-tab" aria-selected="">3. Настройки и запуск</a>
                </li>
            </ul>

            {{--TODO Запоминать активную вкладку--}}
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show p-3" id="urls" role="tabpanel" aria-labelledby="home-tab">
                    <div class="tab-header pt-2 pb-3">
                        <a class="btn btn-success"
                           href="{{ route('url.create', ['chapter' => $chapter->id, 'project' => $chapter->project_id]) }}"
                           role="button">Добавить URL</a>
                    </div>
                    <table id="table_urls" class="table table-bordered table-hover dataTable dtr-inline"
                           aria-describedby="example2_info">
                        <thead>
                        <tr>
                            <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1"
                                aria-label="Rendering engine: activate to sort column ascending">№
                            </th>
                            <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1"
                                aria-label="Browser: activate to sort column ascending">URL
                            </th>
                            <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1"
                                aria-label="Browser: activate to sort column ascending">id
                            </th>
                            <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1"
                                aria-label="Browser: activate to sort column ascending">chapter_id
                            </th>
                            <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1"
                                aria-label="Browser: activate to sort column ascending">project_id
                            </th>
                            <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1"
                                aria-label="Platform(s): activate to sort column ascending">Действия
                            </th>
                        </tr>
                        </thead>
                        <tbody>

                        @php
                            $i = 0;
                        @endphp

                        @foreach($urls as $url)

                            <tr class="odd">
                                <td class="dtr-control" tabindex="0">{{ ++$i }}</td>
                                <td>{{ $url->url }}</td>
                                <td>{{ $url->id }}</td>
                                <td>{{ $url->chapter_id }}</td>
                                <td>{{ $url->project_id }}</td>
                                <td>
                                    <form method="POST"
                                          action="{{ route('url.destroy', $url->id) }}">
                                        {{ method_field('DELETE') }}
                                        @csrf
                                        <button type="submit"
                                                class="btn btn-danger btn-xs show-alert-delete-box-url"
                                                data-toggle="tooltip" title='Удалить проект'>
                                            <i class="fa fa-trash" aria-hidden="true"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach


                        </tbody>
                    </table>
                </div>

                <div class="tab-pane fade p-3" id="rules" role="tabpanel" aria-labelledby="profile-tab">
                    <div class="tab-header pt-2 pb-3">
                        <a class="btn btn-success"
                           href="{{ route('rule.create', ['chapter' => $chapter->id, 'project' => $chapter->project_id]) }}"
                           role="button">Добавить правило</a>
                    </div>
                    <table id="table_rules" class="table table-bordered table-hover dataTable dtr-inline"
                           aria-describedby="example2_info">
                        <thead>
                        <tr>
                            <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1"
                                aria-label="Rendering engine: activate to sort column ascending">№
                            </th>
                            <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1"
                                aria-label="Browser: activate to sort column ascending">header_name
                            </th>
                            <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1"
                                aria-label="Browser: activate to sort column ascending">rule_left
                            </th>
                            <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1"
                                aria-label="Browser: activate to sort column ascending">rule_right
                            </th>
                            <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1"
                                aria-label="Platform(s): activate to sort column ascending">Действия
                            </th>
                        </tr>
                        </thead>
                        <tbody>

                        @php
                            $i = 0;
                        @endphp

                        @foreach($rules as $rule)

                            <tr class="odd">
                                <td class="dtr-control" tabindex="0">{{ ++$i }}</td>
                                <td>{{ $rule->header_name }}</td>
                                <td>{{ $rule->rule_left }}</td>
                                <td>{{ $rule->rule_right }}</td>
                                <td>
                                    <form method="POST"
                                          action="{{ route('rule.destroy', $rule->id) }}">
                                        {{ method_field('DELETE') }}
                                        @csrf
                                        <button type="submit"
                                                class="btn btn-danger btn-xs show-alert-delete-box-rule"
                                                data-toggle="tooltip" title='Удалить правило'>
                                            <i class="fa fa-trash" aria-hidden="true"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach


                        </tbody>
                    </table>
                </div>
                <div class="tab-pane fade" id="play" role="tabpanel" aria-labelledby="contact-tab">
                    <h3>Настройка и запуск</h3>
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





