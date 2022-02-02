@include('inc.home.head', ['title' => trans('main.professional Info')])

<section class="p-150 sign-up">
    <div class="container">
        <div class="row steps">
            <div class="col-md-4 col-sm-4 step active">
                <div>
                    <i class="fal fa-grip-lines active"></i>
                    <p>{{trans('main.Career Details')}}</p>
                </div>
            </div>
            <div class="col-md-4 col-sm-4 step  active">
                <div>
                    <i class="fal fa-id-card active"></i>
                    <p>{{trans('main.General Info')}}</p>
                </div>
            </div>
            <div class="col-md-4 col-sm-4 step active">
                <div>
                    <i class="fal fa-briefcase"></i>
                    <p>{{trans('main.professional Info')}}</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="offset-lg-3 col-lg-6 offset-sm-2 col-sm-8 sign-up-panel">
                {!! Form::open(['action'=> ['ProfileController@update', $user->id], 'method'=>'POST', 'enctype' =>'multipart/form-data' ])!!}
                    <div class="col-md-12" >
                        <div class="form-group app-label mt-2">
                            <label class="text-muted">{{trans('main.About Me')}}</label>
                            {!! Form::textarea('about', $user->about,  ['class' => "form-control r-0 light s-12", 'placeholder' => trans('main.About Me'), 'id' => 'about'])!!}
                        </div>
                    </div>
                    <div class="col-md-12 my-3">
                        <div class="input-group app-label  mt-2 mb-2">
                            <div class="custom-file">
                                <input type="file" name ="cv" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
                                <label class="custom-file-label rounded"><i class="mdi mdi-cloud-upload mr-1"></i>{{trans('main.Upload CV')}} </label>
                            </div>
                            
                        </div>
                        <spn class="val-tip muted-text text-left">{{trans('main.Document Type Has To Be An Image(jpeg,png,jpg,gif,svg) Or PDF with Max Size: 3MB')}}</spn>
                    </div>
                    <div class="col-lg-12 mt-2">
                        <div class="form-group app-label mt-2 ">
                            <a href="{{ url('interests') }}" class="btn back mt-2 btn-sm mb-3">{{trans('main.Back')}}</a>
                            {!! Form::submit(trans('main.Save And Continue'), ['class' => "btn btn-primary mt-2 btn-sm float-right  sign-save", 'name' => 'edit-professional']) !!}
                        </div>
                        <div class="clearfix"></div>
                    </div>
                {!! Form::hidden('_method', 'PUT') !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</section>
@include('inc.home.foot')
    @include('inc.home.scripts')
</body>
</html>