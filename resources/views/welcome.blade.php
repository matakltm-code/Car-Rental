@extends('layouts.app')

@section('content')
<div class="container">


    {{-- Check availability --}}
    <div class="h1 text-center text-dark">Check Availability</div>
    <div class="col-md-8 offset-md-2 pb-4">
        {{-- <h1 class="text-center">Check Availability</h1> --}}
        <form method="get" action="/cars">
            {{-- @csrf --}}
            <div class="form-row">
                <div class="col">
                    <input type="date" class="form-control" placeholder="Arrival Date" name="start_date" id="start_date"
                        value="{{ old('start_date') }}">
                </div>
                <div class="col">
                    <input type="date" class="form-control" placeholder="Departure Date" name="end_date" id="end_date"
                        value="{{ old('end_date') }}">
                </div>
                <div class="col">
                    <button type="submit" class="btn btn-md btn-success">Check Availability</button>
                </div>
            </div>
        </form>
    </div>


    <p class="font-weight-bold h3">Featured cars</p>
    <div class="row mt-0 pt-0">
        @if ($cars->count() > 0)
        @foreach ($cars as $car)
        <div class="col-md-4 mt-1">
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
        <p class="p-4 bg-danger text-white font-weight-bold">There is no any cars added</p>
        @endif

        {{ $cars->links() }}

        {{-- </div> --}}
    </div>






    {{-- Footer --}}
    <footer class="text-center text-lg-start bg-dark text-muted border-top row mt-5 mb-0 pb-0">

        <!-- Section: Links  -->
        <section class="">
            <div class="container text-center text-md-start mt-5">
                <!-- Grid row -->
                <div class="row mt-3">
                    <!-- Grid column -->
                    <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
                        <!-- Content -->
                        <h6 class="text-uppercase fw-bold mb-4">
                            <i class="fas fa-gem me-3"></i>Company name
                        </h6>
                        <p>
                            Here you can use rows and columns to organize your footer content. Lorem ipsum
                            dolor sit amet, consectetur adipisicing elit.
                        </p>
                    </div>
                    <!-- Grid column -->

                    <!-- Grid column -->
                    <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
                        <!-- Links -->
                        <h6 class="text-uppercase fw-bold mb-4">
                            Products
                        </h6>
                        <p>
                            <a href="#!" class="text-reset">Angular</a>
                        </p>
                        <p>
                            <a href="#!" class="text-reset">React</a>
                        </p>
                        <p>
                            <a href="#!" class="text-reset">Vue</a>
                        </p>
                        <p>
                            <a href="#!" class="text-reset">Laravel</a>
                        </p>
                    </div>
                    <!-- Grid column -->

                    <!-- Grid column -->
                    <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
                        <!-- Links -->
                        <h6 class="text-uppercase fw-bold mb-4">
                            Useful links
                        </h6>
                        <p>
                            <a href="#!" class="text-reset">Pricing</a>
                        </p>
                        <p>
                            <a href="#!" class="text-reset">Settings</a>
                        </p>
                        <p>
                            <a href="#!" class="text-reset">Orders</a>
                        </p>
                        <p>
                            <a href="#!" class="text-reset">Help</a>
                        </p>
                    </div>
                    <!-- Grid column -->

                    <!-- Grid column -->
                    <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
                        <!-- Links -->
                        <h6 class="text-uppercase fw-bold mb-4">
                            Contact
                        </h6>
                        <p><i class="fas fa-home me-3"></i> New York, NY 10012, US</p>
                        <p>
                            <i class="fas fa-envelope me-3"></i>
                            info@example.com
                        </p>
                        <p><i class="fas fa-phone me-3"></i> + 01 234 567 88</p>
                        <p><i class="fas fa-print me-3"></i> + 01 234 567 89</p>
                    </div>
                    <!-- Grid column -->
                </div>
                <!-- Grid row -->
            </div>
        </section>
        <!-- Section: Links  -->

        <!-- Copyright -->
        <div class="text-center p-4" style="background-color: rgba(0, 0, 0, 0.05);">
            © 2021 Copyright:
            <a class="text-reset fw-bold" href="/">AG Hotel</a>
        </div>
        <!-- Copyright -->
    </footer>
    <!-- Footer -->




</div>
@endsection
