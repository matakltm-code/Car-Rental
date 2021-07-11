<?php

namespace App\Http\Controllers;

use App\Models\BookedCar;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        // Get all reservation
        $booked_cars = BookedCar::orderBy('created_at', 'DESC')->where('driver_id', auth()->user()->id)->paginate(10);
        return view('driver.reservation.assigned-cars', [
            'booked_cars' => $booked_cars
        ]);
        //
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
     * @param  \App\Models\BookedCar  $bookedCar
     * @return \Illuminate\Http\Response
     */
    public function show(BookedCar $bookedCar)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BookedCar  $bookedCar
     * @return \Illuminate\Http\Response
     */
    public function edit(BookedCar $bookedCar)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BookedCar  $bookedCar
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BookedCar $bookedCar)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BookedCar  $bookedCar
     * @return \Illuminate\Http\Response
     */
    public function destroy(BookedCar $bookedCar)
    {
        //
    }
}
