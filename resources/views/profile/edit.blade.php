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
                            <h4>Edit Your Profile</h4>
                            <hr>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <form method="post" action="/profile/{{ $user->id }}">
                                @csrf
                                @method('PATCH')
                                <div class="form-group row">
                                    <label for="name" class="col-4 col-form-label">Name</label>
                                    <div class="col-8">
                                        <input value="{{ old('name') ?? $user->name }}" id="name" name="name"
                                            placeholder="Name" class="form-control  @error('name') is-invalid @enderror"
                                            type="text">
                                        @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="phone" class="col-4 col-form-label">Phone</label>
                                    <div class="col-8">
                                        <input value="{{ old('phone') ?? $user->phone }}" id="phone" name="phone"
                                            placeholder="phone"
                                            class="form-control  @error('phone') is-invalid @enderror" type="text">
                                        @error('phone')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="address" class="col-4 col-form-label">Address</label>
                                    <div class="col-8">
                                        <input value="{{ old('address') ?? $user->address }}" id="address"
                                            name="address" placeholder="Address"
                                            class="form-control  @error('address') is-invalid @enderror">
                                        @error('address')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="date_of_birth" class="col-4 col-form-label">Date of birth</label>
                                    <div class="col-8">
                                        <input type="date" value="{{ old('date_of_birth') ?? $user->date_of_birth }}"
                                            id="date_of_birth" name="date_of_birth" placeholder="date_of_birth"
                                            class="form-control  @error('date_of_birth') is-invalid @enderror">
                                        @error('date_of_birth')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="username" class="col-4 col-form-label">Username</label>
                                    <div class="col-8">
                                        <input value="{{ old('username') ?? $user->username }}" id="username"
                                            name="username" placeholder="username"
                                            class="form-control  @error('username') is-invalid @enderror"
                                            required="required" type="username">
                                        @error('username')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="email" class="col-4 col-form-label">Email</label>
                                    <div class="col-8">
                                        <input value="{{ old('email') ?? $user->email }}" id="email" name="email"
                                            placeholder="Email"
                                            class="form-control  @error('email') is-invalid @enderror"
                                            required="required" type="email">
                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="offset-4 col-8">
                                        <button name="submit" type="submit" class="btn btn-primary">Update My
                                            Profile</button>
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
