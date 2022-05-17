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
                        <a class="btn btn-outline-secondary btn-sm" href="{{ route('project.create') }}">+</a>
                    </span>
                </div>
            </div>
        </li>


        <div class="accordion" id="accordionExample">


            @if (isset($names))
                @foreach ($names as $name)
                    <div class="card">
                        <div class="bob card-header" id="headingOne">
                            <h2 class="mb-0">
                                <div class="d-flex justify-content-between align-items-center">
                                    <button class="btn btn-link btn-block text-left" type="button"
                                            data-toggle="collapse" data-target="#collapseOne{{ $name->id }}"
                                            aria-controls="collapseOne">
                                        {{ $name->name }}
                                    </button>
                                    <div class="d-flex justify-content-between">


                                        <a href="{{ route('project.edit', $name->id) }}" id="editButton" type="button" class="btn btn-outline-secondary btn-sm"
                                           style="margin-left: 0.5rem;">...</a>



                                    </div>
                                </div>
                            </h2>
                        </div>


                        <div id="collapseOne{{ $name->id }}" class="accordion-collapse collapse show"
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


        </div>

    </ul>
</div>


<style>

    #editButton {
        visibility: hidden;
    }

    .bob:hover #editButton {
        visibility: visible;
    }
</style>

