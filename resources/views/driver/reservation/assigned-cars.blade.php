@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{ __('Car Assign Notification') }}</div>

                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Reservation Date</th>
                                <th scope="col">Total Days</th>
                                <th scope="col">Reserved on</th>
                                <th scope="col">Car Detail</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($booked_cars->count() > 0)
                            @foreach ($booked_cars as $booked_car)

                            <tr>
                                <th class="text-capitalize" scope="row">{{ $loop->iteration }}</th>
                                <td>
                                    From <strong>{{ $booked_car->start_date }}</strong> <br>
                                    To: <strong>{{ $booked_car->end_date }}</strong> <br>
                                </td>
                                <td>
                                    @php
                                    $total_days =
                                    \Carbon\Carbon::parse($booked_car->start_date)->diffinDays(\Carbon\Carbon::parse($booked_car->end_date));
                                    @endphp
                                    {{ $total_days }}
                                </td>
                                <td>{{ $booked_car->created_at->diffForHumans() }}</td>
                                <td>
                                    <a href="/cars/{{ $booked_car->car->id }}" class="btn btn-link btn-sm">Show
                                        car detail</a>

                                </td>

                            </tr>
                            @endforeach

                            @else
                            <tr>
                                <th colspan="5">Not assigned yet!</th>
                            </tr>
                            @endif


                        </tbody>
                    </table>
                    {{ $booked_cars->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
