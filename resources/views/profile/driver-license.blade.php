@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-3 ">
            @include('profile.shared.side-nav')
        </div>
        <div class="col-md-9">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <h4>Upload your driver license file</h4>
                            <hr>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            @if ($driver_license_file != null)
                            <p class="font-weight-bold">Driver license is uploaded. <a href="/{{$driver_license_file}}"
                                    target="_blank" rel="noopener noreferrer">See/Download File</a></p>

                            @else
                            <p class="text-danger font-weight-bold">Upload your driver license now!</p>
                            @endif
                        </div>
                        <div class="col-md-12">
                            <form method="POST" action="/profile/driver-license" enctype="multipart/form-data">
                                @csrf

                                <div class="input-group row p-2">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Driver License File</span>
                                    </div>
                                    <div class="custom-file">
                                        <input type="file" name="file" class="custom-file-input" id="inputGroupFile01">
                                        <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                    </div>
                                    @error('file')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group row">
                                    <div class="offset-4 col-8">
                                        <button name="submit" type="submit" class="btn btn-primary">Upload File</button>
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
