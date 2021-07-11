@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card" style="overflow-x: auto">
                <div class="card-header">{{ __('Reservation history') }}</div>

                <div class="card-body">
                    <p>Last 10 reserved cars</p>
                    {{-- </div> --}}
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Customer</th>
                                <th scope="col">Reservation Date</th>
                                <th scope="col">Payment Detail</th>
                                <th scope="col">Reserved on</th>
                                <th scope="col">Car Detail</th>
                                @if (auth()->user()->is_rentalofficer)
                                <th scope="col">Action</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @if ($booked_cars->count() > 0)
                            @foreach ($booked_cars as $booked_car)

                            <tr>
                                <td class="text-capitalize" scope="row">{{ $loop->iteration }}</td>
                                <td>
                                    Name: {{ $booked_car->user->name }} <br>
                                    Email: {{ $booked_car->user->email }} <br>
                                    Phone: {{ $booked_car->user->phone }} <br>
                                </td>
                                <td>
                                    From <strong>{{ $booked_car->start_date }}</strong> <br>
                                    To: <strong>{{ $booked_car->end_date }}</strong> <br>
                                    <strong>Preference is
                                        {{ ($booked_car->with_driver == true) ? "With Driver" : "With out Driver" }}</strong>
                                    @if ($booked_car->with_driver == true)
                                    @if ($booked_car->driver_id != null)
                                    <br>
                                    Assigned Driver: <strong>{{ $booked_car->driver->name }}</strong>
                                    @else
                                    <br>
                                    Assigned Driver: <strong class="text-danger">Not Yet</strong>
                                    @endif
                                    @endif
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
                                @if (auth()->user()->is_rentalofficer)
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
                                    <p class="h6 text-success">Reservation is approved</p>

                                    @if ($booked_car->with_driver == true)
                                    @if ($booked_car->driver_id == null)
                                    <p>
                                        <a class="btn btn-link btn-xs" data-toggle="collapse"
                                            href="#collapse{{$booked_car->id}}" role="button" aria-expanded="false"
                                            aria-controls="collapse{{$booked_car->id}}">
                                            Select Driver
                                        </a>
                                    </p>
                                    <div class="collapse pb-3 border-bottom" id="collapse{{$booked_car->id}}">
                                        <form action="/car/r/assign-driver" method="post">
                                            @csrf
                                            <input type="hidden" name="booked_car_id" value="{{ $booked_car->id }}">
                                            <div class="form-group row">
                                                <select name="driver_id" id="driver_id{{$booked_car->id}}"
                                                    class="form-control">
                                                    <option value="">* SELECT *</option>
                                                    @foreach (App\Models\User::where('user_type', 'driver')->get() as
                                                    $driver)
                                                    <option value="{{$driver->id}}">{{$driver->name}}</option>
                                                    @endforeach
                                                </select>
                                                @error('booked_car_id')
                                                <span class="text-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                                @error('driver_id')
                                                <span class="text-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-12">
                                                    <button name="submit" type="submit"
                                                        class="btn btn-success btn-xs">Assign</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    @endif
                                    @endif

                                    @endif
                                    {{-- --}}
                                    @if ($booked_car->status != 'cancel')
                                    <form action="/car/r/reservation/{{$booked_car->id}}" method="post">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="action_name" value="cancel">
                                        <button type="submit" class="btn btn-danger btn-sm mt-1">Cancel
                                            Reservation</button>
                                    </form>
                                    @endif
                                    @if ($booked_car->cancel_by != 'customer')

                                    @if ($booked_car->status != 'approved')
                                    <form action="/car/r/reservation/{{$booked_car->id}}" method="post">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="action_name" value="approved">
                                        <button type="submit" class="btn btn-success btn-sm mt-1">Approve
                                            Reservation</button>
                                    </form>
                                    @endif
                                    @endif
                                </td>
                                @endif
                            </tr>
                            @endforeach

                            @else
                            <tr>
                                @if (auth()->user()->is_rentalofficer)
                                <th colspan="6">There is no any Booked car yet!</th>
                                @else
                                <th colspan="5">There is no any Booked car yet!</th>
                                @endif
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
