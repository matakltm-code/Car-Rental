@extends('layouts.app')

@section('content')
<div class="container mb-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card-header pb-3 d-flex justify-content-between">
                <span>{{ __('Add new car') }}</span>
                <a href="/car-management" class="btn btn-info btn-sm">Cancel</a>
            </div>


            <form method="post" action="/car-management" enctype="multipart/form-data">
                @csrf

                <div class="form-group row">
                    <label for="name" class="col-12 col-form-label">Car Name</label>
                    <div class="col-12">
                        <input value="{{ old('name') }}" id="name" name="name" placeholder="Car name"
                            class="form-control  @error('name') is-invalid @enderror" type="text">
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="plate_number" class="col-12 col-form-label">Plate Number</label>
                    <div class="col-12">
                        <input value="{{ old('plate_number') }}" id="plate_number" name="plate_number"
                            placeholder="Plate number" class="form-control  @error('plate_number') is-invalid @enderror"
                            type="text">
                        @error('plate_number')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="price_with_driver" class="col-12 col-form-label">Price With Driver</label>
                    <div class="col-12">
                        <input value="{{ old('price_with_driver') }}" id="price_with_driver" name="price_with_driver"
                            placeholder="Price with driver"
                            class="form-control  @error('price_with_driver') is-invalid @enderror" type="number">
                        @error('price_with_driver')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="price_with_out_driver" class="col-12 col-form-label">Price with out driver</label>
                    <div class="col-12">
                        <input value="{{ old('price_with_out_driver') }}" id="price_with_out_driver"
                            name="price_with_out_driver" placeholder="Price with out driver"
                            class="form-control  @error('price_with_out_driver') is-invalid @enderror" type="number">
                        @error('price_with_out_driver')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="model" class="col-12 col-form-label">Car model</label>
                    <div class="col-12">
                        <input value="{{ old('model') }}" id="model" name="model" placeholder="Car model"
                            class="form-control  @error('model') is-invalid @enderror" type="text">
                        @error('model')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="seat_capacity" class="col-12 col-form-label">Car seat capacity</label>
                    <div class="col-12">
                        <input value="{{ old('seat_capacity') }}" id="seat_capacity" name="seat_capacity"
                            placeholder="Car seat capacity"
                            class="form-control  @error('seat_capacity') is-invalid @enderror" type="number">
                        @error('seat_capacity')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                {{-- car_status --}}
                <div class="form-group row">
                    <label for="editor" class="col-12 col-form-label">Car detail description</label>
                    <div class="col-12">
                        <textarea name="car_status" class="editor" rows="10"
                            value="{!! old('car_status') !!}"></textarea>
                    </div>
                    @error('car_status')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="input-group row p-2">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Image</span>
                    </div>
                    <div class="custom-file">
                        <input type="file" name="image" class="custom-file-input" id="inputGroupFile01">
                        <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                    </div>
                    @error('image')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-group row">
                    <div class="col-12">
                        <button name="submit" type="submit" class="btn btn-primary">Add Car</button>
                    </div>
                </div>

            </form>

        </div>
    </div>
</div>
@endsection
