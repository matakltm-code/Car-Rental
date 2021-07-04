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
                            <h4>Change your password</h4>
                            <hr>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <form method="POST" action="/profile/change-password">
                                @csrf

                                <div class="form-group row">
                                    <label for="current_password" class="col-md-4 col-form-label  text-md-right">Current
                                        password</label>
                                    <div class="col-md-6">
                                        <input id="current_password" name="current_password"
                                            placeholder="Current Password"
                                            class="form-control  @error('current_password') is-invalid @enderror"
                                            type="password" autocomplete="current-password">
                                        @error('current_password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <hr>

                                <div class="form-group row">
                                    <label for="password"
                                        class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                                    <div class="col-md-6">
                                        <input id="password" type="password"
                                            class="form-control @error('password') is-invalid @enderror" name="password"
                                            required autocomplete="new-password">

                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="password-confirm"
                                        class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                                    <div class="col-md-6">
                                        <input id="password-confirm" type="password" class="form-control"
                                            name="password_confirmation" required autocomplete="new-password">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="offset-4 col-8">
                                        <button name="submit" type="submit" class="btn btn-primary">Change
                                            Password</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
