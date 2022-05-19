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

        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h3 class="card-title">Список ссылок</h3>
                <a class="btn btn-success" href="{{ route('url.create', ['chapter' => $chapter->id, 'project' => $chapter->project_id]) }}" role="button">Добавить</a>
            </div>
        </div>

        <div class="card-body">
            <table id="example" class="table table-bordered table-hover dataTable dtr-inline"
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
                                        class="btn btn-danger btn-xs"
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





