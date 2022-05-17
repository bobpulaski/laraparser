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
            <h3 class="card-title">Список ссылок</h3>
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
                        aria-label="Platform(s): activate to sort column ascending">Platform(s)
                    </th>
                </tr>
                </thead>
                <tbody>
                <tr class="odd">
                    <td class="dtr-control" tabindex="0">Webkit</td>
                    <td>Safari 3.0</td>
                    <td>OSX.4+</td>
                    <td class="sorting_1">522.1</td>
                    <td>A</td>
                </tr>
                <tr class="even">
                    <td class="dtr-control" tabindex="0">Webkit</td>
                    <td>iPod Touch / iPhone</td>
                    <td>iPod</td>
                    <td class="sorting_1">420.1</td>
                    <td>A</td>
                </tr>
                <tr class="odd">
                    <td class="dtr-control" tabindex="0">Webkit</td>
                    <td>OmniWeb 5.5</td>
                    <td>OSX.4+</td>
                    <td class="sorting_1">420</td>
                    <td>A</td>
                </tr>
                <tr class="even">
                    <td class="dtr-control" tabindex="0">Webkit</td>
                    <td>Safari 2.0</td>
                    <td>OSX.4+</td>
                    <td class="sorting_1">419.3</td>
                    <td>A</td>
                </tr>
                <tr class="odd">
                    <td class="dtr-control" tabindex="0">Webkit</td>
                    <td>S60</td>
                    <td>S60</td>
                    <td class="sorting_1">413</td>
                    <td>A</td>
                </tr>
                <tr class="even">
                    <td class="dtr-control" tabindex="0">Webkit</td>
                    <td>Safari 1.3</td>
                    <td>OSX.3</td>
                    <td class="sorting_1">312.8</td>
                    <td>A</td>
                </tr>
                <tr class="odd">
                    <td class="dtr-control" tabindex="0">Webkit</td>
                    <td>Safari 1.2</td>
                    <td>OSX.3</td>
                    <td class="sorting_1">125.5</td>
                    <td>A</td>
                </tr>
                <tr class="even">
                    <td class="dtr-control" tabindex="0">Presto</td>
                    <td>Nintendo DS browser</td>
                    <td>Nintendo DS</td>
                    <td class="sorting_1">8.5</td>
                    <td>C/A<sup>1</sup></td>
                </tr>
                <tr class="odd">
                    <td class="dtr-control" tabindex="0">Trident</td>
                    <td>Internet Explorer 7</td>
                    <td>Win XP SP2+</td>
                    <td class="sorting_1">7</td>
                    <td>A</td>
                </tr>
                <tr class="even">
                    <td class="dtr-control" tabindex="0">Trident</td>
                    <td>Internet
                        Explorer 6
                    </td>
                    <td>Win 98+</td>
                    <td class="sorting_1">6</td>
                    <td>A</td>
                </tr>
                </tbody>
                <tfoot>
                <tr>
                    <th rowspan="1" colspan="1">Rendering engine</th>
                    <th rowspan="1" colspan="1">Browser</th>
                    <th rowspan="1" colspan="1">Platform(s)</th>
                    <th rowspan="1" colspan="1">Engine version</th>
                    <th rowspan="1" colspan="1">CSS grade</th>
                </tr>
                </tfoot>
            </table>
        </div>

    </div>





    {{--<div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <h1>{{ $title }}</h1>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="d-flex flex-column bd-highlight mb-3">
                <h3>{{ $chapter->id }}</h3>
                <h2>{{ $chapter->name }}</h2>
                <h2>{{ $chapter->project_id }}</h2>
                <h4>Сессия: {{ Session::get('jagakey') }}</h4>
            </div>
        </div>
    </div>--}}

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





