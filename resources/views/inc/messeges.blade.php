@if(count($errors) > 0)
    @foreach ($errors->all() as $error)
        {{--<div class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-autohide="true" data-delay='5000'>
            <div class="toast-header">
                <span class="bg-danger i"></span>
                <strong class="mr-auto">Notification</strong>
                <small class="text-muted">just now</small>
                <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="toast-body">
                {{$error}}
            </div>
        </div>--}}
        <div class="toast"
            data-title="Notification!"
            data-message="{{$error}}"
            data-type="error">
        </div>
    @endforeach
@endif

@if (session('success'))
    <div class="toast"
        data-title="Notification!"
        data-message="{{session('success')}}"
        data-type="success">
    </div>
@endif

@if (session('error'))
    {{--<div class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-autohide="true" data-delay='5000'>
        <div class="toast-header">
            <span class="bg-anger i"></span>
            <strong class="mr-auto">Notification</strong>
            <small class="text-muted">just now</small>
            <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="toast-body">
            {{session('error')}}
        </div>
    </div>--}}
    <div class="toast"
        data-title="Notification!"
        data-message="{{session('error')}}"
        data-type="error">
    </div>
    
@endif