<?php

namespace App\Http\Controllers;

use App\Models\BookedCar;
use App\Models\Car;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }



    public function rentalofficer_reservation()
    {
        // Get all reservation
        $booked_cars = BookedCar::orderBy('created_at', 'DESC')->paginate(10);
        return view('rentalofficer.reservation.reservation_history', [
            'booked_cars' => $booked_cars
        ]);
    }


    public function cancel_or_approve_customer_reservation(Request $request, BookedCar $BookedCar)
    {
        // Check user is rentalofficer
        if (auth()->user()->user_type != 'rentalofficer') {
            return redirect('/')->with('error', 'Your are not allowed to see this page');
        }
        // dd($BookedCar->user_id . ' and ' . auth()->user()->id);
        // if (auth()->user()->user_type != 'rentalofficer') {
        //     return redirect('/')->with('error', 'Your are not allowed to see this page');
        // }
        $data = $request->validate([
            'action_name' => 'required|string',
        ]);

        $message = ($data['action_name'] == 'cancel') ? 'Reservation is canceled. <br/> <b>Refund the total price to our customer based on the document they attached.</b>' : 'Reservation is Approved';
        $data = [
            'status' => $data['action_name'],
            'cancel_by' => ($data['action_name'] == 'cancel') ? 'rentalofficer' : '',
        ];

        $BookedCar->update($data);
        return back()->with('success', $message);
    }

    public function assign_driver(Request $request)
    {
        if (auth()->user()->user_type != 'rentalofficer') {
            return redirect('/')->with('error', 'Your are not allowed to see this page');
        }
        // dd($request);
        $data = $request->validate([
            'driver_id' => 'required',
            'booked_car_id' => 'required',
        ]);
        BookedCar::where('id', $data['booked_car_id'])->update([
            'driver_id' => $data['driver_id']
        ]);
        // todo: Notify the user about the assignation
        return back()->with('success', 'Driver assigned successfuly');
    }


    // Customer
    public function customer_reservation()
    {
        // Check user is customer
        if (auth()->user()->user_type != 'customer') {
            return redirect('/')->with('error', 'Your are not allowed to see this page');
        }
        $booked_cars = BookedCar::orderBy('created_at', 'DESC')->where('user_id', '=', auth()->user()->id)->paginate(10);
        return view('customer.reservation.customer_reservation', [
            'booked_cars' => $booked_cars
        ]);
    }


    public function cancel_customer_reservation(Request $request, BookedCar $BookedCar)
    {
        // dd($BookedCar->user_id . ' and ' . auth()->user()->id);
        if ($BookedCar->user_id != auth()->user()->id) {
            return back()->with('error', 'You can not permitted to cancel reservation');
        }
        $data = [
            'status' => 'cancel',
            'cancel_by' => 'customer'
        ];

        $BookedCar->update($data);
        return back()->with('success', 'Success: Our receptionist staff memeber will return your money by using your bank account. <strong>Our staff memebers take 72 hours to return you money!</strong>');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function show(Car $car)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function edit(Car $car)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Car $car)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function destroy(Car $car)
    {
        //
    }
}
