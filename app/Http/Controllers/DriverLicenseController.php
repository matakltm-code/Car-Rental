<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class DriverLicenseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $file = User::findorfail(auth()->user()->id);
        // dd($file->driver_license_file_path);
        return view('profile.driver-license', [
            'driver_license_file' => $file->driver_license_file_path
        ]);
    }


    public function store(Request $request)
    {
        // dd(auth()->user()->password . '       '. Hash::check($value, $hashedValue));
        // dd($request['current_password']);
        $data = $request->validate([
            'file' => 'required|file',
        ]);


        $file_path = 'storage/' . $request->file->store('uploads', 'public');

        $request->user()->fill([
            'driver_license_file_path' => $file_path
        ])->save();

        // User::where('id', auth()->user()->id)->update($data);
        return back()->with('success', 'Your Driver License File Successfuly Uploaded');
    }
}
