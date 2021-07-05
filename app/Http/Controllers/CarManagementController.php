<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class CarManagementController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        // Check user is admin
        if (auth()->user()->user_type != 'rentalofficer') {
            return redirect('/')->with('error', 'Your are not allowed to see this page');
        }

        $cars = Car::orderBy('created_at', 'DESC')->paginate(10);
        return view('rentalofficer.car-management.index', [
            'cars' => $cars
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('rentalofficer.car-management.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
        $data = $request->validate([
            'name' => 'required|string',
            'plate_number' => 'required|string',
            'price_with_driver' => 'required',
            'price_with_out_driver' => 'required',
            'model' => 'required|string',
            'seat_capacity' => 'required|string',
            'car_status' => 'required',
            'image' => 'required|image',
        ]);

        $image_path = 'storage/' . $request->image->store('uploads', 'public');
        // Fit image not Resize image to 1200 x 1200 pixle
        $image = Image::make(public_path($image_path))->fit(1200, 1200);
        $image->save();

        Car::create([
            'name' => $data['name'],
            'plate_number' => $data['plate_number'],
            'price_with_driver' => $data['price_with_driver'],
            'price_with_out_driver' => $data['price_with_out_driver'],
            'model' => $data['model'],
            'seat_capacity' => $data['seat_capacity'],
            'car_status' => $data['car_status'],
            'image_url' => $image_path,
        ]);
        return redirect('/car-management')->with('success', 'New car added successfuly!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function show(Car $car)
    {
        return view('rentalofficer.car-management.show', [
            'car' => $car
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function edit(Car $car)
    {
        // Check user is rentalofficer
        if (auth()->user()->user_type != 'rentalofficer') {
            return redirect('/')->with('error', 'Your are not allowed to see this page');
        }
        return view('rentalofficer.car-management.edit', [
            'car' => $car
        ]);
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
        // Check user is rentalofficer
        if (auth()->user()->user_type != 'rentalofficer') {
            return redirect('/')->with('error', 'Your are not allowed to see this page');
        }
        $data = $request->validate([
            'name' => 'required|string',
            'plate_number' => 'required|string',
            'price_with_driver' => 'required',
            'price_with_out_driver' => 'required',
            'model' => 'required|string',
            'seat_capacity' => 'required|string',
            'car_status' => 'required',
            'image' => 'required|image',
        ]);

        $image_path = 'storage/' . $request->image->store('uploads', 'public');
        // Fit image not Resize image to 1200 x 1200 pixle
        $image = Image::make(public_path($image_path))->fit(1200, 1200);
        $image->save();

        $car->update([
            'name' => $data['name'],
            'plate_number' => $data['plate_number'],
            'price_with_driver' => $data['price_with_driver'],
            'price_with_out_driver' => $data['price_with_out_driver'],
            'model' => $data['model'],
            'seat_capacity' => $data['seat_capacity'],
            'car_status' => $data['car_status'],
            'image_url' => $image_path,
        ]);
        return redirect('/car-management')->with('success', 'Car information updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function destroy(Car $car)
    {
        // Check user is rentalofficer
        if (auth()->user()->user_type != 'rentalofficer') {
            return redirect('/')->with('error', 'Your are not allowed to see this page');
        }
        $car->delete();
        return redirect('/car-management')->with('success', 'Car information Deleted');
    }



    public function enable_disable_car(Request $request)
    {
        // Check user is rentalofficer
        if (auth()->user()->user_type != 'rentalofficer') {
            return redirect('/')->with('error', 'Your are not allowed to see this page');
        }

        $car_id = $request['car_id'];
        $status = $request['status'];
        $message = '';
        if ($status) {
            $status = false;
            $message = 'Car visibility is Disabled';
        } else {
            $status = true;
            $message = 'Car visibility is Enabled';
        }
        $data = [
            'activated' => $status
        ];

        Car::where('id', $car_id)->update($data);
        return back()->with('success', $message);
    }
}
