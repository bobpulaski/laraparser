@extends('dashboard')

@section('content')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <script>
        $(document).ready(function () {
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $(".postbutton").click(function () {
                $.ajax({
                    /* the route pointing to the post function */
                    url: "{{ route('parser.play', $chapter->id) }}",
                    type: 'POST',
                    /* send the csrf-token and the input to the controller */
                    data: {_token: CSRF_TOKEN, message: $(".getinfo").val()},
                    dataType: 'JSON',
                    /* remind that 'data' is the response of the AjaxController */
                    success: function (data) {
                        $(".writeinfo").html(data.msg);
                    }
                });
            });
        });
    </script>





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
                       aria-controls="urls-tab" aria-selected="">1. Ссылки</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="rules-tab" data-toggle="tab" href="#rules" role="tab"
                       aria-controls="rules-tab" aria-selected="">2. Правила</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="play-tab" data-toggle="tab" href="#play" role="tab"
                       aria-controls="play-tab" aria-selected="">3. Результат</a>
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

                <div class="tab-pane fade p-3" id="play" role="tabpanel" aria-labelledby="contact-tab">

                    {{--<button type="submit"
                            class="btn btn-primary postbutton"
                            data-toggle="tooltip" title='Запустить'>Сформировать
                        <i class="fa fa-play" aria-hidden="true"></i>
                    </button>
                    <div class="writeinfo"></div>--}}
                    <form method="POST" action="{{ route('parser.play', $chapter->id) }}">
                        {{ method_field('POST') }}
                        @csrf
                        <div class="tab-header pt-2 pb-3">

                            {{--@isset($results)
                                <button id='play' type="submit"
                                        class="btn btn-primary"
                                        data-toggle="tooltip" title='Запустить'>Сформировать
                                    <i class="fa fa-play ml-2" aria-hidden="true"></i>
                                </button>
                            @endisset--}}
                            @forelse($results as $result)
                                @if($result->qstatus === 'Выполнено' or $result->qstatus === 'Ошибка выполнения')
                                    <button id='play' type="submit"
                                            class="btn btn-primary"
                                            data-toggle="tooltip" title='Выполнить'>Выполнить
                                        <i class="fa fa-play ml-2" aria-hidden="true"></i>
                                    </button>
                                @endif
                            @empty
                                <button id='play' type="submit"
                                        class="btn btn-primary"
                                        data-toggle="tooltip" title='Выполнить'>Выполнить
                                    <i class="fa fa-play ml-2" aria-hidden="true"></i>
                                </button>
                            @endforelse


                        </div>
                    </form>

                    <h4>Статус выполнения</h4>
                    <table id="table_qprogress" class="table table-bordered table-hover dataTable dtr-inline"
                           aria-describedby="example3_info">
                        <thead>
                        <tr>
                            <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1"
                                aria-label="Browser: activate to sort column ascending">qstatus
                            </th>
                            <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1"
                                aria-label="Browser: activate to sort column ascending">created_at
                            </th>
                            <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1"
                                aria-label="Browser: activate to sort column ascending">updated_at
                            </th>
                            <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1"
                                aria-label="Browser: activate to sort column ascending">action
                            </th>

                        </tr>
                        </thead>
                        <tbody>

                        @php
                            $i = 0;
                        @endphp

                        @foreach($results as $result)

                            <tr class="odd">

                                @if ($result->qstatus === 'В очереди')
                                    <td style="background-color: yellow">{{ $result->qstatus }}</td>
                                @endif

                                @if ($result->qstatus === 'Выполнено')
                                    <td style="background-color: green; color:white">{{ $result->qstatus }}</td>
                                @endif

                                @if ($result->qstatus === 'Ошибка выполнения')
                                    <td style="background-color: red">{{ $result->qstatus }}</td>
                                @endif

                                <td>{{ $result->created_at }}</td>
                                <td>{{ $result->updated_at }}</td>
                                <td>
                                    {{--<form method="POST"
                                          action="{{ route('rule.destroy', $result->id) }}">
                                        {{ method_field('DELETE') }}
                                        @csrf
                                        <button type="submit"
                                                class="btn btn-danger btn-xs show-alert-delete-box-rule"
                                                data-toggle="tooltip" title='Удалить правило'>
                                            <i class="fa fa-trash" aria-hidden="true"></i>
                                        </button>
                                    </form>--}}

                                    <div class="d-flex flex-row">
                                        @if($result->qstatus === 'Выполнено')
                                            <form method="POST"
                                                  action="{{ route('file.create', ['project_id' => $result->project_id, 'chapter_id' => $result->chapter_id]) }}">
                                                {{ method_field('POST') }}
                                                @csrf
                                                <button type="submit"
                                                        class="btn btn-primary btn-xs"
                                                        data-toggle="tooltip" title='Сформировать файл'>
                                                    Сформировать файл
                                                </button>
                                            </form>
                                        @endif

                                        @if($result->full_filename != '')
                                                <form method="POST"
                                                      action="{{ route('file.get', ['project_id' => $result->project_id, 'chapter_id' => $result->chapter_id]) }}">
                                                    {{ method_field('POST') }}
                                                    @csrf
                                                    <button type="submit"
                                                            class="btn btn-success btn-xs ml-2"
                                                            data-toggle="tooltip" title='Скачать файл'>
                                                        Скачать "{{ $result->full_filename }}"
                                                    </button>
                                                </form>

                                        @endif
                                    </div>

                                </td>
                            </tr>
                        @endforeach


                        </tbody>
                    </table>

                    @if ($someMessage = Session::get('message'))
                        <div class="?_content-header">
                            <div class="container-fluid alert alert-success mt-3" role="alert">
                                <strong>{{ $someMessage }}</strong>
                            </div>
                        </div>
                    @endif

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

    <!-- load jQuery -->


@endsection





