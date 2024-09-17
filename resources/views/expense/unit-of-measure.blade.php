@php
    use Illuminate\Support\Facades\Storage;
@endphp

@extends('layouts.expense-index')

@section('title', 'Unit of Measure')

@section('style')
    <style type="text/css">
        .uom_nav {
            color: rgb(255, 255, 255, 1.0);
        }
    </style>
@endsection

@section('body')

    @if($errors->any())
        {{ implode('', $errors->all('<div>:message</div>')) }}
    @endif

    <div class="container p-3">
        <div class="row mb-3">
            <div class="col-12">
                <div class="card">
                    <div class="card-header row">
                        <div class="col-sm-12 col-md-2 d-flex align-items-center">
                            <i class="fas fa-table me-1"></i>
                            <b>Measurements</b>
                        </div>
                        <div class="col-sm-12 col-md-8">
                            <form class="searchForm">
                                <div class="w-100 rounded-pill border d-flex align-items-start flex-direction-row gap-2 py-2 px-3" style="background-color: rgba(255, 255, 255, 0.4);
                                box-shadow: rgba(0, 0, 0, 0.1) 0px 1px 15px;
                                border: 1px solid rgba(255, 255, 255, 0.5);
                                border-right: 1px solid rgba(255, 255, 255, 0.2);
                                border-bottom: 1px solid rgba(255, 255, 255, 0.2);">
                                    <div>
                                        <button class="border-0 bg-transparent" style="border-radius: 50%;">
                                            <i class="fas fa-search text-secondary"></i>
                                        </button>
                                    </div>
                                    <div class="w-100 mx-1">
                                        <small>
                                            <input autocomplete="off" placeholder="Search ..." name="search" type="search" value="{{app('request')->input('search')}}" class="rounded-0 border-0 w-100 bg-transparent" id="searchInput">
                                        </small>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-sm-12 col-md-2 d-flex justify-content-end text-end">
                            <button type="button" class="btn btn-outline-primary rounded-0 px-3" data-bs-toggle="modal"
                                data-bs-target="#addEntityModal">Add Measurement
                            </button>
                        </div>
                    </div>
                    <div class="card-body overflow-x-auto">
                        <table class="table sortable">
                            <thead>
                            <tr>
                                <th>Measurement</th>
                                <th>Priority</th>
                                <th>ACTION</th>
                            </tr>
                            </thead>
                            <tbody id="requestData">
                            @forelse ($measurements as $measurement)
                                <tr>
                                    <td>{{ $measurement->name }}</td>
                                    <td>{{ $measurement->priority }}</td>
                                    <td>
                                        <div class="d-flex gap-2 align-items-center">

                                            <button type="button" class="btn btn-secondary" data-bs-toggle="modal"
                                                    data-bs-target="#editEntity{{$measurement->id}}">Edit
                                            </button>

                                            <form data-entity-name="{{$measurement->name }}" class="delete-form"
                                                  method="POST" action="/expense/unit-of-measure/{{$measurement->id}}">
                                                @csrf
                                                @method('DELETE')
                                                <button role="button" type="submit" class="btn btn-danger">Delete
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>

                                <div class="modal fade" id="editEntity{{$measurement->id}}" tabindex="-1"
                                     aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <form method="POST" action="/expense/unit-of-measure/{{$measurement->id}}">
                                            @csrf
                                            @method('PATCH')
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Edit Measurement</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label for="priority">Priority</label>
                                                        <input value="{{$measurement->priority}}" name="priority"
                                                               class="text-uppercase form-control text-uppercase"
                                                               id="priority" type="number" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="name">Measurement</label>
                                                        <input value="{{$measurement->name}}" name="name"
                                                               class="form-control" id="priority" type="text"
                                                               required>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Cancel
                                                    </button>
                                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            @empty
                                <tr>
                                    <td class="text-center" colspan='4'>
                                        <p class="text-secondary">
                                            EMPTY TABLE
                                        </p>
                                    </td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="container-fluid">
                        {{$measurements->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal  fade" id="addEntityModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form method="POST" action="/expense/unit-of-measure">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add Measurement</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="priority">Priority</label>
                            <input name="priority" class="form-control" id="priority" type="text"  required>
                        </div>
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input name="name" class="form-control text-uppercase" id="name" type="text" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('script')
    <script>
        const deleteForms = document.querySelectorAll('.delete-form');

        deleteForms.forEach(form => {
            form.addEventListener('submit', (e) => {

                e.preventDefault();

                let name = form.dataset.entityName;

                Swal.fire({
                    title: `Do you want to delete ${name}?`,
                    showCancelButton: true,
                    confirmButtonText: "Confirm",
                    icon: "warning",
                }).then(result => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                })
            })
        })
    </script>
    <script type="text/javascript" src="/js/sortable.js"></script>
@endsection

