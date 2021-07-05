@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        {{-- <div class="col-md-12"> --}}
        <div class="card-header col-md-12 pb-3 d-flex justify-content-between">
            <span>{{ __('Cars') }}</span>
            <a href="/car-management/create" class="btn btn-primary btn-sm">Add new car</a>
        </div>
        {{-- </div> --}}
        <div class="row mt-3">

            @if ($cars->count() > 0)
            @foreach ($cars as $car)
            <div class="col-md-4">
                <div class="card">
                    <img class="card-img-top" src="{{ $car->image_url }}" alt="car Photo">
                    <div class="card-body">
                        <h5 class="card-title">Car name: {{ $car->name }}</h5>
                        <p class="card-text">
                            <p>Car Model: {{ $car->model }}</p>
                            <p>Car seat capacity: {{ $car->seat_capacity }}</p>
                            <p>Price with driver: {{ $car->price_with_driver }}</p>
                            <p>Price with out driver: {{ $car->price_with_out_driver }}</p>
                            <p>Plate Number: {{ $car->plate_number }}</p>
                            <p>Car status:
                                {!! $car->activated == true ? '<span class="text-success">Active</span>':'<span
                                    class="text-danger">Deactivated</span>'
                                !!}
                            </p>
                        </p>
                        <a href="/car-management/{{ $car->id }}" class="btn btn-primary">Show Detail</a>
                    </div>
                </div>
            </div>
            @endforeach

            @else
            <div class="col-md-12">
                <p class="p-4 bg-danger text-white font-weight-bold">There is no any cars added</p>
            </div>
            @endif

            {{ $cars->links() }}

        </div>
    </div>
</div>
@endsection
