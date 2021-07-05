@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card-header pb-3 d-flex justify-content-between">
                <span>{{ __('Car') }}</span>
                <a href="/car-management" class="btn btn-info btn-sm">Back</a>
            </div>
        </div>

        <div class="col-md-12 mt-4 d-flex justify-content-center">

            <div class="col-md-4">
                <div class="card" style="width: 18rem;">
                    <img class="card-img-top" src="/{{ $car->image_url }}" alt="Car Photo">
                    <div class="card-body">
                        <h5 class="card-title">Car name: {{ $car->name }}</h5>
                        <p class="card-text">
                            <p>Car Model: {{ $car->model }}</p>
                            <p>Car seat capacity: {{ $car->seat_capacity }}</p>
                            <p>Price with driver: {{ $car->price_with_driver }}</p>
                            <p>Price with out driver: {{ $car->price_with_out_driver }}</p>
                            <p>Plate Number: {{ $car->plate_number }}</p>
                            <p>Car status: {{ $car->activated == true ? 'Active':'Deactivated' }}
                            </p>
                        </p>
                        <a href="/car-management/{{ $car->id }}/edit" class="btn btn-primary w-100">Edit</a>

                        <form action="/car-management/{{ $car->id }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <input type="submit" value="Delete" class="btn btn-danger mt-1 w-100" />
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <p class="h3">Detail Note</p>
                <p>{!! $car->car_status !!}</p>
                <hr>
                <div class="col-md-12">
                    <form method="POST" action="/car-management/enable-disable">
                        @csrf
                        <input type="hidden" name="car_id" value="{{ $car->id }}">
                        <input type="hidden" name="status" value="{{ $car->activated }}">
                        @if ($car->activated)
                        <button type="submit" class="btn btn-danger">
                            {{ __('Disable Car') }}
                        </button>
                        @else
                        <button type="submit" class="btn btn-primary">
                            {{ __('Enable Car') }}
                        </button>
                        @endif
                    </form>
                </div>
            </div>



        </div>
    </div>
</div>
@endsection
