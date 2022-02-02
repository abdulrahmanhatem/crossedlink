@include('inc.home.head', ['title' => trans('main.Settings')])

<section class="section p-150 bread-crumbs">
    <div class="container">
        <a href="{{ url('/') }}" class="text-muted">{{trans('main.Home')}}</a> / <a href="{{ url('/profiles/'.auth()->user()->id) }}" class="text-muted">{{trans('main.Profile')}}</a> / <a href="{{ url('settings') }}" class="text-primary">{{trans('main.Settings')}}</a>
    </div>
</section>

<section class="sign-up">
    <div class="container">
        <div class="row">
            <div class="offset-lg-3 col-lg-6 col-sm-12 sign-up-panel">
                {!! Form::open(['action'=> ['ProfileController@update', $user->id], 'method'=>'POST', 'enctype' =>'multipart/form-data'])!!}
                    <div class="col-md-12">
                        <div class="form-group app-label mt-2">
                            <h6>{{trans('main.Change Password')}}</h6>
                            <label class="text-muted">{{trans('main.To Change Your Account Password, Enter Your New Account Password and Confirm It.')}}</label>
                            <div class="col-lg-12 px-0">
                                <div class="form-group position-relative">
                                    <input class="form-control my-2" placeholder="{{trans('main.Old Password')}}" id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="old-password" autocomplete="current-password">
                                </div>
                            </div>
                            <div class="col-lg-12 px-0">
                                <div class="form-group position-relative">
                                    <input class="form-control my-2" placeholder="{{trans('main.New Password')}}" id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="current-password">
                                </div>
                            </div>
                            <div class="col-lg-12 px-0">
                                <div class="form-group position-relative">
                                    <input class="form-control my-2" placeholder="{{trans('main.Confirm New Password')}}" id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password_confirmation" autocomplete="current-password">
                                </div>
                            </div>
                            {!! Form::submit(trans('main.Update Password'), ['class' => "btn btn-primary mt-2 btn-sm", 'name' => 'reset-password']) !!}
                        </div>
                    </div>
                {!! Form::hidden('_method', 'PUT') !!}
                {!! Form::close() !!}
            </div>
        </div>
        {{--<div class="row">
            <div class="offset-lg-3 col-lg-6 col-sm-12 sign-up-panel mt-2">
                {!! Form::open(['action'=> ['ProfileController@update', $user->id], 'method'=>'POST', 'enctype' =>'multipart/form-data'])!!}
                    <div class="col-md-12">
                        <div class="form-group app-label mt-2">
                            <h6>{{trans('main.Change Email')}}</h6>
                            <label class="text-muted"> {{trans('main.If You Would Like To Login And Recieve Emails On A different Address, Write This New Email Here')}}</label>
                            {!! Form::text('email', '',  ['class' => "form-control resume my-2", 'placeholder' => trans('main.New Email')])!!}
                            {!! Form::text('email_confirm', '',  ['class' => "form-control resume my-2", 'placeholder' => trans('main.Confirm New Email')])!!}
                        </div>
                        <div class="form-group app-label mt-2 ">
                            {!! Form::submit(trans('main.Update Email'), ['class' => "btn btn-primary mt-2 btn-sm", 'name' => 'edit-email']) !!}
                        </div>
                    </div>
                {!! Form::hidden('_method', 'PUT') !!}
                {!! Form::close() !!}
            </div>
        </div>--}}
        <div class="row">
            <div class="offset-lg-3 col-lg-6 col-sm-12 sign-up-panel mt-2">
                {!! Form::open(['action'=> ['ProfileController@update', $user->id], 'method'=>'POST', 'enctype' =>'multipart/form-data'])!!}
                    <div class="col-md-12">
                        <div class="form-group app-label mt-2">
                            <h6>{{trans('main.Deleting Account')}} <span class="text-danger">( {{trans('main.Danger Area')}} )</span></h6>
                            <label class="text-muted"> {{trans('main.In Case You Like To Delete Your Account And delete All Your Account Data?')}}</label>
                            <a class="btn btn-primary mt-2 btn-sm"  data-toggle="modal" data-target="#account-{{ $user->id}}-delete">{{trans('main.Delete')}}</a>
                        </div>
                    </div>
                {!! Form::hidden('_method', 'PUT') !!}
                {!! Form::close() !!}
            </div>
        </div>
        <div class="modal fade" id="account-{{ $user->id }}-delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{trans('main.Delete account')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                {!! Form::open(['action'=> ['ProfileController@destroy', $user->id], 'method'=>'POST', 'enctype' =>'multipart/form-data', 'class' => 'w-100'])!!}
                    <div class="modal-body">
                        {{trans('main.Are You Sure About Deleting About, You Will Lose Everything About this Account')}}
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{trans('main.Close')}}</button>
                        {!! Form::submit(trans('main.Delete'), ['class' => "btn btn-danger text-danger", 'name' => 'delete-account']) !!}
                    </div>
                {!! Form::hidden('_method', 'DELETE') !!}
                {!! Form::close() !!}
                   
                </div>
            </div>
        </div>
    </div>
</section>
@include('inc.home.foot')
    @include('inc.home.scripts')
</body>
</html>