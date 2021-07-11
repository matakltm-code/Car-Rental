@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Your Car Reservation History') }}</div>

                <div class="card-body">
                    <p>Your last 10 reserved cars</p>
                    {{-- </div> --}}
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Reservation Date</th>
                                <th scope="col">Payment Detail</th>
                                <th scope="col">Reserved on</th>
                                <th scope="col">Car Detail</th>
                                <th scope="col">Action</th>
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
                                    <strong>Preference:
                                        {{ ($booked_car->with_driver == true) ? "With Driver" : "With out Driver" }}</strong>
                                </td>
                                <td>
                                    Uploaded File: <a href="/{{$booked_car->payment_attached_file_path}}"
                                        target="_blank" rel="noopener noreferrer">See or Download</a> <br>
                                    Total Payment: {{ $booked_car->total_price }} <br>
                                    Status: {!! $booked_car->car_status_text($booked_car->status) !!}
                                </td>
                                <td>{{ $booked_car->created_at->diffForHumans() }}</td>
                                <td>
                                    <a href="/cars/{{ $booked_car->car->id }}" class="btn btn-link btn-sm">Show
                                        car detail</a> <br>
                                    Price with driver: {{ $booked_car->car->price_with_driver }} <br>
                                    Price with out driver: {{ $booked_car->car->price_with_out_driver }} <br>
                                </td>
                                <td>
                                    @if($booked_car->status == 'cancel')
                                    {{-- Check this reservation is cnceled by --}}
                                    <p>{!! $booked_car->car_status_canceled_by_text($booked_car->cancel_by) !!}</p>
                                    <p class="text-danger">Refund is done in 72 hours based on the document you attached
                                    </p>
                                    @endif
                                    {{-- approved --}}
                                    @if($booked_car->status == 'approved')
                                    {{-- Check this reservation is cnceled by --}}
                                    <p class="h6 text-success"><strong>We are waiting for you!</strong></p>
                                    @endif
                                    {{-- --}}
                                    @if ($booked_car->status != 'cancel')
                                    @if ($booked_car->status != 'approved')

                                    <form action="/car/c/reservation/{{$booked_car->id}}" method="post">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn btn-danger btn-sm">Cancel
                                            Reservation</button>
                                    </form>
                                    @endif
                                    @endif
                                </td>
                            </tr>
                            @endforeach

                            @else
                            <tr>
                                <th colspan="6">There is no any Booked Car yet!</th>
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
