@extends('layouts.dashboard')

@section('title_menu', 'Led Control')

@section('content')
    <div class="card">
        <h5 class="card-header">LED Control</h5>
        <div class="card-body">
            <h5 class="card-title"><button type="button" class="btn btn-primary" data-toggle="modal"
                    data-target="#staticBackdrop">
                    <i class="ri-add-line"></i>
                    Tambah LED
                </button></h5>
            <p class="card-text">
            <div class="row my-4">
                @foreach ($leds as $led)
                    <div class="col-sm-6 col-md-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex w-100 justify-content-between">
                                    <div
                                        class="d-flex align-items-start
                                    @if ($led->status == '1') text-primary @endif
                                    ">
                                        <i class="ri-lightbulb-fill fa-fw fa-4x"></i>
                                        <div>
                                            <h6 class="p-0 m-0 fw-bold">{{ $led->name }}</h6>
                                            <p class="p-0 m-0 text-muted">Pin: {{ $led->pin }}</p>
                                            <div>
                                                <div class="custom-control custom-switch">
                                                    <input @checked($led->status == '1') type="checkbox"
                                                        class="custom-control-input" id="customSwitch{{ $led->id }}"
                                                        data-pin="{{ $led->pin }}">
                                                    <label class="custom-control-label"
                                                        for="customSwitch{{ $led->id }}"></label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="dropdown">
                                        <i class="ri-more-2-fill" type="button" data-toggle="dropdown"
                                            aria-expanded="false"></i>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="#">Edit</a>
                                            <a class="dropdown-item" href="#">Delete</a>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            </p>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ route('leds.store') }}" method="POST">
                <div class="modal-content">
                    @csrf

                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Add LED</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name">LED Name</label>
                            <input type="text" class="form-control"name="name" id="name" placeholder="Nama LED">
                        </div>

                        <div class="form-group">
                            <label for="name">LED Pin</label>
                            <input type="number" class="form-control" name="pin" id="pin" placeholder="Pin">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
