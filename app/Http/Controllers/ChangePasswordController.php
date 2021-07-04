<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ChangePasswordController extends Controller
{
    public function index()
    {
        return view('profile.change-password');
    }


    public function store(Request $request)
    {
        // dd(auth()->user()->password . '       '. Hash::check($value, $hashedValue));
        // dd($request['current_password']);
        $request->validate([
            'current_password' => ['required', 'string', 'min:4'],
            'password' => ['required', 'string', 'min:4', 'confirmed'],
        ]);
        // Check old password is correct
        if (!Hash::check($request->current_password, auth()->user()->password)) {
            // if (auth()->user()->password != Hash::make($request->current_password)) {
            return back()->with('error', 'Current password is incorrect');
        }
        $request->user()->fill([
            'password' => Hash::make($request->password)
        ])->save();

        // User::where('id', auth()->user()->id)->update($data);
        return back()->with('success', 'Password changed successfuly');
    }
}
