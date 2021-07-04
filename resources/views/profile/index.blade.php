@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-3 ">
            <div class="list-group ">
                <a href="/profile"
                    class="list-group-item list-group-item-action <?=(Route::current()->uri() == '/profile' ? 'active':'')?>">
                    Profile
                </a>
                <a href="/profile/edit" class="list-group-item list-group-item-action">
                    Edit Profile
                </a>
                <a href="/profile/change-password" class="list-group-item list-group-item-action">
                    Change password
                </a>


            </div>
        </div>
        <div class="col-md-9">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <h4 class="font-weight-bold">
                                {{ $user->account_type_text($user->user_type) }}
                                User Profile
                            </h4>
                            <hr>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <p class="h5 pb-1">
                                Name: {{ $user->name }}
                            </p>
                            <p class="h5 pb-1">
                                Phone: {{ $user->phone }}
                            </p>
                            <p class="h5 pb-1">
                                Address: {{ $user->address }}
                            </p>
                            <p class="h5 pb-1">
                                Date of birth: {{ $user->date_of_birth }}
                            </p>
                            <p class="h5 pb-1">
                                Email: {{ $user->username }}
                            </p>
                            <p class="h5 pb-1">
                                Email: {{ $user->email }}
                            </p>
                            <p class="h5 pb-1">
                                Account status: {{ ($user->active_account == true ? 'Active' : 'Disabled') }}
                            </p>
                            <p class="h5 pb-1">
                                User Type: {{ $user->account_type_text($user->user_type) }}
                            </p>
                            <p class="h5 pb-1">
                                Account Status: {{ $user->active_account == true ? 'Active' : 'Deactivated' }}
                            </p>
                            <p class="h5 pb-1">
                                Account created at: {{ $user->created_at->diffForHumans() }}
                            </p>
                            <p class="h5 pb-1">
                                Last logged in: {{ \Carbon\Carbon::parse($user->last_login_at)->diffForHumans() }}
                            </p>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
