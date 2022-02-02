@if(count($errors) > 0)
    @foreach ($errors->all() as $error)
    <div class="toast error" role="alert" aria-live="assertive" aria-atomic="true" data-autohide="true" data-delay='5000'>
        <div class="toast-header">
            <span class=" i  mr-2"><i class="fal fa-exclamation-square"></i></span>
        <strong class="mr-auto ">{{trans('main.Alert')}}</strong>
            {{-- <smallclass="text-muted">1 Second ago</small> --}}
          <button type="button" class="ml-2 mb-1 close " data-dismiss="toast" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="toast-body">
            <span class=" message">{!! $error!!}</span>
        </div>
    </div>
    @endforeach
@endif

@if (session('success'))
<div class="toast success" role="alert" aria-live="assertive" aria-atomic="true" data-autohide="true" data-delay='5000'>
    <div class="toast-header">
        <span class=" i  mr-2"><i class="fal fa-check"></i></span>
        <strong class="mr-auto ">{{trans('main.Success')}}</strong>
        {{-- <smallclass="text-muted">1 Second ago</small> --}}
          <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="toast-body">
            <span class=" message">{!!session('success')!!}</span>
        </div>
    </div>
@endif

@if (session('error'))
<div class="toast error" role="alert" aria-live="assertive" aria-atomic="true" data-autohide="true" data-delay='5000'>
    <div class="toast-header">
        <span class=" i  mr-2"><i class="fal fa-exclamation-square"></i></span>
        <strong class="mr-auto ">{{trans('main.Alert')}}</strong>
            {{-- <smallclass="text-muted">1 Second ago</small> --}}
            <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="toast-body">
            <span class=" message">{!! session('error')!!}</span>
        </div>
    </div>
@endif
<div class="toast success hide" role="alert" aria-live="assertive" aria-atomic="true" data-autohide="true" data-delay='0'>
    <div class="toast-header">
        <span class=" i  mr-2"><i class="fal fa-check"></i></span>
        <strong class="mr-auto ">{{trans('main.Success')}}</strong>
          <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="toast-body">
            <span class=" message"></span>
        </div>
    </div>
</div>