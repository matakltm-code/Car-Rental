<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use Carbon\Carbon;

class AccountController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        // Check user is admin
        if (auth()->user()->user_type != 'admin') {
            return redirect('/')->with('error', 'Your are not allowed to see this page');
        }

        return view('admin.account.index');
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
        $data = request()->validate([
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'max:255'],
            'address' => ['required', 'max:255'],
            'date_of_birth' => ['required', 'date'],
            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'user_type' => ['required'],
            'password' => ['required', 'string', 'min:4', 'confirmed'],
        ]);
        // dd($data);
        User::create([
            'name' => $data['name'],
            'phone' => $data['phone'],
            'address' => $data['address'],
            'date_of_birth' => $data['date_of_birth'],
            'username' => $data['username'],
            'email' => $data['email'],
            'user_type' => $data['user_type'],
            'password' => Hash::make($data['password']),
            'last_login_at' => Carbon::now()->toDateTimeString()
        ]);
        return redirect('/account')->with('success', 'Account created successfuly!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }


    public function login_history()
    {
        // Check user is admin
        if (auth()->user()->user_type != 'admin') {
            return redirect('/')->with('error', 'Your are not allowed to see this page');
        }

        $users = User::orderBy('last_login_at', 'DESC')->paginate(10);
        return view('admin.loginhistory.index', [
            'users' => $users
        ]);
    }

    public function enable_disable_account(Request $request)
    {
        // Check user is admin
        if (auth()->user()->user_type != 'admin') {
            return redirect('/')->with('error', 'Your are not allowed to see this page');
        }

        $user_id = $request['user_id'];
        $status = $request['status'];
        $message = '';
        if ($status) {
            $status = false;
            $message = 'User account Disabled';
        } else {
            $status = true;
            $message = 'User account Enabled';
        }
        $data = [
            'active_account' => $status
        ];

        User::where('id', $user_id)->update($data);
        return back()->with('success', $message);
    }
}
