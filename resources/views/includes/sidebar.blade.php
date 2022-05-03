<div class="position-sticky pt-md-1">
    <ul class="nav flex-column">
        <li class="nav-item">
            <div class="nav-link" aria-current="page">

                <div class="d-flex justify-content-between align-items-center">
                    <span class="ml-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="feather feather-layers mr-2">
                            <polygon points="12 2 2 7 12 12 22 7 12 2"></polygon>
                            <polyline points="2 17 12 22 22 17"></polyline>
                            <polyline points="2 12 12 17 22 12"></polyline>
                        </svg>
                        Мои проекты

                    </span>

                    <span class="ml-2">
                        <a class="btn btn-outline-secondary btn-sm" href="{{ route('addNewProjectForm') }}">+</a>
                    </span>
                </div>
            </div>
        </li>


        <div class="accordion" id="accordionExample">
            <div class="accordion" id="accordionExample">

                @if (isset($names))
                    @foreach ($names as $name)
                        <div class="card">
                            <div class="card-header" id="headingOne">
                                <h2 class="mb-0">
                                    <div class="bob">
                                        <button id="jaga" class="btn btn-link btn-block text-left" type="button"
                                            data-toggle="collapse" data-target="#collapseOne{{ $name->id }}"
                                            aria-controls="collapseOne">
                                            {{ $name->name }}
                                        </button>

                                        <form id="deleteButton" method="POST" action="{{ route('destroyProject', $name->id) }}">
                                            {{ method_field('DELETE') }}
                                            @csrf
                                            <button type="submit"
                                                class="btn btn-xs btn-flat show-alert-delete-box btn-sm"
                                                data-toggle="tooltip" title='Delete'>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="feather feather-layers mr-2">
                                                    <polyline points="3 6 5 6 21 6" />
                                                    <path
                                                        d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2" />
                                                    <line x1="10" y1="11" x2="10" y2="17" />
                                                    <line x1="14" y1="11" x2="14" y2="17" />
                                                </svg>
                                            </button>
                                        </form>


                                        </a>
                                    </div>

                                </h2>
                            </div>


                            <div id="collapseOne{{ $name->id }}" class="accordion-collapse collapse hidden"
                                aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                <div class="card-body">
                                    Some placeholder content for the first accordion panel. This panel is shown by
                                    default,
                                    thanks
                                    to the <code>.show</code> class.
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif

                <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

                <script type="text/javascript">
                    $('.show-alert-delete-box').click(function(event) {
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



                <style>
                    .bob {
                        flex: 0%;
                    }

                    #deleteButton {
                        display: none;
                    }

                    #jaga:hover + #deleteButton {
                        display: block;
                    }
                </style>

            </div>
        </div>

    </ul>
</div>
