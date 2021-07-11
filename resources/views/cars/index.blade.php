@extends('layouts.app')

@section('content')
<div class="container">

    <div class="h1 text-center text-dark">Available Cars</div>
    <div class="col-md-8 offset-md-2 pb-4">
        <form method="get" action="/cars">
            {{-- @csrf --}}
            <div class="form-row">
                <div class="col">
                    <input type="date" class="form-control" placeholder="Arrival Date" name="start_date" id="start_date"
                        value="{{ old('start_date') ?? $start_date }}">
                </div>
                <div class="col">
                    <input type="date" class="form-control" placeholder="Departure Date" name="end_date" id="end_date"
                        value="{{ old('end_date') ?? $end_date }}">
                </div>
                <div class="col">
                    <button type="submit" class="btn btn-md btn-success">Check Availability</button>
                </div>
            </div>
        </form>
    </div>

    <div class="row mb-5 pb-5">
        @if ($cars->count() > 0)
        {{-- available cheker --}}
        @php
        function checkDateIsAvailableForReservation($start_date, $end_date, $db_start_date, $db_end_date)
        {
        if ($start_date == $db_start_date) return false;
        if ($end_date == $db_end_date) return false;
        if ($start_date <= $db_end_date) return false; return true; } @endphp @foreach ($cars as $car) @php
            $skip_car=false; if($start_date !='' && $end_date !='' & !empty($start_date) && !empty($end_date)){ foreach
            ($car->booked_cars as $booked_car) {
            if (checkDateIsAvailableForReservation($start_date, $end_date, $booked_car->start_date,
            $booked_car->end_date)) {
            $skip_car = false;
            } else {
            // This car is reserved so we skip this car
            $skip_car = true;
            } // else
            } // foreach ($car->booked_cars as $booked_car) {
            } // end of if($start_date != '' && $end_date != '' & !empty($start_date) && !empty($end_date)){
            // if not available then skip the car
            // if ($skip_car) continue;
            @endphp

            @if ($skip_car)
            @continue
            @endif

            <div class="col-md-4">
                <div class="card mt-1">
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
                        <a href="/cars/{{ $car->id }}?start_date={{$start_date}}&end_date={{$end_date}}"
                            class="btn btn-primary">Show Detail</a>
                    </div>
                </div>
            </div>
            @endforeach

            @else
            <p class="p-4 bg-danger text-white font-weight-bold">There is no any cars added</p>
            @endif

            {{ $cars->links() }}
    </div>

























</div>
@endsection
