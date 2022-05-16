@extends('dashboard')

@php
    $title = 'Изменить проект';
@endphp

@section('title')
    {{ $title }}
@endsection

@section('content')


    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-6 d-flex justify-content-between align-items-center">
                <h1>{{ $title }}</h1>
                <form method="POST"
                      action="{{ route('project.destroy', $currentRecord[0]->id) }}">
                    {{ method_field('DELETE') }}
                    @csrf
                    <button type="submit"
                            class="btn btn-danger btn-xs"
                            data-toggle="tooltip" title='Удалить проект'>
                        <i class="fa fa-trash" aria-hidden="true"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>


    <div class="container-fluid">
        <div class="row">
            <div class="col-6">
                <div class="card">

                    <div class="card-body {{--d-flex align-items-end--}}">
                        <form action="{{ route('project.update', $currentRecord[0]->id) }}"
                              method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <input type="text" class="form-control" name="name"
                                       value="{{ $currentRecord[0]->name }}"/>
                                <div id="name" class="form-text">Не более 15 символов, учитывая пробелы</div>
                            </div>
                            <button type="submit" class="btn btn-success">Сохранить</button>
                            <a class="btn btn-secondary" href="{{ route('dashboard') }}" role="button">Отмена</a>
                        </form>


                    </div>


                </div>

            </div>

        </div>
    </div>
    </div>




    {{--<h1>{{ $title }}</h1>



    <form style="width: 50%" action="{{ route('project.update', $currentRecord[0]->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <input type="text" class="form-control" name="name" value="{{ $currentRecord[0]->name }}"/>
            <div id="name" class="form-text">Не более 15 символов, учитывая пробелы</div>
        </div>

            <div class="wrap-1">
                <button type="submit" class="btn btn-success">Сохранить</button>
                --}}{{--TODO Проверить при прямой подстановке--}}{{--
                <a class="btn btn-secondary" href="{{ route('dashboard') }}" role="button">Отмена</a>
            </div>

    </form>--}}


    <script type="text/javascript">
        $('.show-alert-delete-box').click(function (event) {
            var form = $(this).closest("form");
            var name = $(this).data("name");
            event.preventDefault();
            swal({
                title: "Вы уверены, что хотите удалить этот проект?",
                text: "Это действие нельзя отменить!",
                icon: "warning",
                type: "warning",
                buttons: ["Отмена", "Да, удалить этот проект!"],
                confirmButtonColor: '#f8d7da',
                cancelButtonColor: '#f8d7da',
                confirmButtonText: 'Yes, delete it!'
            }).then((willDelete) => {
                if (willDelete) {
                    form.submit();
                }
            });
        });
    </script>




@endsection

