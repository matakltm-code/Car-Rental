@extends('layouts.app')

@section('content')
<div class="container mb-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card-header pb-3 d-flex justify-content-between">
                <span>{{ __('Send your report') }}</span>
                <a href="/" class="btn btn-info btn-sm">Cancel</a>
            </div>


            <form method="post" action="/d/send-report-rental-officer" enctype="multipart/form-data">
                @csrf

                <div class="form-group row">
                    <label for="title" class="col-12 col-form-label">Title</label>
                    <div class="col-12">
                        <input value="{{ old('title') }}" id="title" name="title" placeholder="Enter report title"
                            class="form-control  @error('title') is-invalid @enderror" type="text">
                        @error('title')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                {{-- detail --}}
                <div class="form-group row">
                    <label for="editor" class="col-12 col-form-label">Description</label>
                    <div class="col-12">
                        <textarea name="detail" class="editor" rows="10" value="{!! old('detail') !!}"></textarea>
                    </div>
                    @error('detail')
                    <span class="text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>


                <div class="form-group row">
                    <div class="col-12">
                        <button name="submit" type="submit" class="btn btn-primary">Send</button>
                    </div>
                </div>

            </form>

        </div>
    </div>
</div>
@endsection
