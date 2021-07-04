{{-- @if(count($errors) > 0)
    <div class="alert alert-danger p-1">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        @foreach($errors->all() as $error)
            # <b>{{$error}}</b> <br />
@endforeach
</div>
@endif --}}
@if(session('success'))
<div class="container">
    <div class="alert alert-success" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <b>{!! session('success') !!}</b>
    </div>
</div>
@endif

@if(session('error'))
<div class="container">
    <div class="alert alert-danger" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        {!! session('error') !!}
    </div>
</div>
@endif
