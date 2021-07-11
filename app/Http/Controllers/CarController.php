<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Car;
use App\Models\BookedCar;

class CarController extends Controller
{
    public function checkDateIsAvailableForReservation($start_date, $end_date, $db_start_date, $db_end_date)
    {
        if ($start_date == $db_start_date) return false;
        if ($end_date == $db_end_date) return false;
        if ($start_date <= $db_end_date) return false;
        return true;
    }

    public function index()
    {
        // Get available cars
        // http://hotel-management.test/cars?start_date=12-34-45&end_date=34-23-45
        $start_date = (isset($_GET['start_date'])) ? $_GET['start_date'] : '';
        $end_date = (isset($_GET['end_date'])) ? $_GET['end_date'] : '';

        $cars = Car::with('booked_cars')->orderBy('created_at', 'DESC')->paginate(10);
        return view('cars.index', [
            'cars' => $cars,
            'start_date' => $start_date,
            'end_date' => $end_date,
        ]);
    }


    public function store(Request $request)
    {

        $data = $request->validate([
            'car_id' => ['required', 'int'],
            'start_date' => ['required', 'date'],
            'end_date' => ['required', 'date', 'after:start_date'],
            'with_driver_or_not' => ['required'],
            'file' => ['required', 'file'],
        ]);
        //  Check the user insertes true available date : this might chage in the html or url se we must do this check
        // $car = Room::with('booked_cars')->where('id', '=', $data['car_id'])->get();
        $car = Car::findorfail($data['car_id']);
        // dd($car);
        // dd($car->booked_cars);
        $skip_room = false;
        foreach ($car->booked_cars as $booked_car) {
            if ($this->checkDateIsAvailableForReservation($data['start_date'], $data['end_date'], $booked_car->start_date, $booked_car->end_date)) {
                $skip_room = false;
            } else {
                $skip_room = true;
            }
        }
        if ($skip_room) {
            return back()->with('error', 'Car is reserved between your selected date. <br/> Please select different date!');
        }

        // File attachiment
        $file_path = 'storage/' . $request->file->store('uploads', 'public');

        // Total price = total_days * price/day
        $total_days = \Carbon\Carbon::parse($data['start_date'])->diffinDays(\Carbon\Carbon::parse($data['end_date']));
        $total_price = 0;
        if ($data['with_driver_or_not'] === 'true') {
            $total_price = $total_days * $car->price_with_driver;
        } else {
            $total_price = $total_days * $car->price_with_out_driver;
        }

        // Reserve a car
        BookedCar::create([
            'car_id' => $data['car_id'],
            'user_id' => auth()->user()->id,
            'start_date' => $data['start_date'],
            'end_date' => $data['end_date'],
            'status' => 'pending',
            'total_price' => $total_price,
            'with_driver' => ($data['with_driver_or_not'] === 'true') ? true : false,
            'payment_attached_file_path' => $file_path,
        ]);
        return back()->with('success', 'Car is successfuly reserved!');
    }

    public function show(Car $car)
    {
        // This wiil shown in the user car reservation form as hidden input
        // http://hotel-management.test/cars/5?start_date=12-34-45&end_date=34-23-45
        $start_date = (isset($_GET['start_date'])) ? $_GET['start_date'] : '';
        $end_date = (isset($_GET['end_date'])) ? $_GET['end_date'] : '';
        return view('cars.show', [
            'car' => $car,
            'start_date' => $start_date,
            'end_date' => $end_date,
        ]);
    }
}
