@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card-header pb-3 d-flex justify-content-between">
                <span>{{ __('Car') }}</span>
                <a href="/cars" class="btn btn-info btn-sm">Back</a>
            </div>
        </div>

        <div class="col-md-12 mt-4 d-flex justify-content-center">

            <div class="col-md-4">
                <div class="card" style="width: 18rem;">
                    <img class="card-img-top" src="/{{ $car->image_url }}" alt="car Photo">
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
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <p class="h3">Car Status Note</p>
                <p>{!! $car->car_status !!}</p>
                {{-- Reservation form --}}
                <hr>
                {{-- if this form is only seen by customers user_type --}}
                @auth

                @if (auth()->user()->is_customer)
                <div class="col-md-12">
                    <p class="font-weight-bold">Reserve a car</p>
                    <table class="table">
                        @php
                        $total_days = \Carbon\Carbon::parse($start_date)->diffinDays(\Carbon\Carbon::parse($end_date));
                        @endphp
                        <tbody>
                            <tr>
                                <td>Price with driver/day</td>
                                <td>{{ $car->price_with_driver }}</td>
                            </tr>
                            <tr>
                                <td>Price with out driver/day</td>
                                <td>{{ $car->price_with_out_driver }}</td>
                            </tr>
                            <tr>
                                <td>Your total days selected</td>
                                <td>{{ $total_days }} day</td>
                            </tr>
                            <tr class="bg-info">
                                <td>Total Payment With Driver</td>
                                <td>{{ $total_days * $car->price_with_driver }} ETB</td>
                            </tr>
                            <tr class="bg-info">
                                <td>Total Payment With Out Driver</td>
                                <td>{{ $total_days * $car->price_with_out_driver }} ETB</td>
                            </tr>
                        </tbody>
                    </table>
                    {{-- <p class="font-weight-bold h6 text-danger">Total Price with driver:
                        {{ ( \Carbon\Carbon::parse($start_date)->diffinDays(\Carbon\Carbon::parse($end_date)) ) * $car->price_with_driver}}
                    ETB</p>
                    <p class="font-weight-bold h6 text-danger">Total Price with out driver:
                        {{ ( \Carbon\Carbon::parse($start_date)->diffinDays(\Carbon\Carbon::parse($end_date)) ) * $car->price_with_out_driver}}
                        ETB</p> --}}
                    <form method="post" action="/cars" enctype="multipart/form-data">
                        @csrf
                        {{-- hidden values --}}
                        <input type="hidden" name="car_id" value="{{ $car->id }}">
                        <input type="hidden" name="start_date" value="{{ $start_date }}">
                        <input type="hidden" name="end_date" value="{{ $end_date }}">

                        <div class="form-group row">
                            <label for="bank_book" class="col-12 col-form-label">Select your driver preference</label>
                            <div class="col-12">
                                <select name="with_driver_or_not" id="with_driver_or_not"
                                    class="form-control  @error('with_driver_or_not') is-invalid @enderror">
                                    <option value="">*** Select ***</option>
                                    <option value="true">With driver</option>
                                    <option value="false">With out driver</option>
                                </select>
                                @error('with_driver_or_not')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="input-group row p-2">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Upload all required documents as .pdf format</span>
                            </div>
                            <div class="custom-file">
                                <input type="file" name="file" class="custom-file-input" id="inputGroupFile01">
                                <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                            </div>
                            @error('file')
                            <p>
                                <span class="pl-3 text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            </p>
                            @enderror
                        </div>

                        <div class="form-group row">
                            <div class="col-12">
                                @error('car_id')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-12">

                                @error('start_date')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-12">
                                @error('end_date')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-12">
                                <button name="submit" type="submit" class="btn btn-primary">Reserve a car</button>
                            </div>
                        </div>

                    </form>
                </div>
                @endif
                @else
                <p class="text-white bg-danger font-weight-bold p-5 text-center h4">
                    To reserve this car you must have
                    to login.
                    <br>
                    <a href="/login" target="_blank" class="btn btn-link btn-success text-white mt-2">Login</a>
                </p>
                @endauth
            </div>



        </div>
    </div>
</div>
@endsection
