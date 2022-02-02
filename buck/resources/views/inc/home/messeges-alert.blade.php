@if(count($errors) > 0)
    @foreach ($errors->all() as $error)
        <div class="alert text-danger text-center" role="alert">
            {!! $error!!}
        </div>
    @endforeach
@endif

@if (session('success'))
    <div class="alert text-success text-center" role="alert">
        {!!session('success')!!}
    </div>
@endif

@if (session('error'))
    <div class="alert text-danger text-center" role="alert">
        {!! session('error')!!}
    </div>
@endif