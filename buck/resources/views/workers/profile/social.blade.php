@include('inc.home.head', ['title' => trans('main.Social Media')])
<section class="section p-150 bread-crumbs">
    <div class="container">
    <a href="{{ url('/') }}" class="text-muted">{{trans('main.Home')}}</a> / <a href="{{ url('profiles/'.auth()->user()->id.'/edit/social') }}" class="text-primary">{{trans('main.Social Media')}}</a>
    </div>
</section>

    <div class="worker-profile pt-4">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-12">
                    <div class="left-sidebar ">
                        <ul class="nav nav-pills nav nav-pills bg-white rounded mb-3" id="pills-tab" role="tablist">
                            <li class="nav-item d-block col-12">
                                <a class="nav-link" href="{{ url('profiles/'. auth()->user()->id) }}">{{trans('main.General Information')}}</a>
                            </li>
                            <li class="nav-item d-block col-12">
                                <a class="nav-link" href="{{ url('profiles/'. auth()->user()->id. '/edit/experience') }}">{{trans('main.Experiences')}}</a>
                            </li>
                            <li class="nav-item d-block col-12">
                                <a class="nav-link"  href="{{ url('profiles/'. auth()->user()->id. '/edit/education') }}">{{trans('main.Education')}}</a>
                            </li>
                            <li class="nav-item d-block col-12">
                                <a class="nav-link"  href="{{ url('profiles/'. auth()->user()->id. '/edit/skills') }}">{{trans('main.Skills')}}</a>
                            </li>
                            <li class="nav-item d-block col-12">
                                <a class="nav-link"  href="{{ url('profiles/'. auth()->user()->id. '/edit/languages') }}">{{trans('main.Languages')}}</a>
                            </li>
                            <li class="nav-item d-block col-12">
                                <a class="nav-link active"  href="{{ url('profiles/'. auth()->user()->id. '/edit/social') }}">{{trans('main.Online Presence')}}</a>
                            </li>
                            <li class="nav-item d-block col-12 ">
                                <a class="nav-link"  href="{{ url('profiles/'. auth()->user()->id. '/edit/gallery') }}">{{trans('main.Portfolio')}}</a>
                            </li>
                            <li class="nav-item d-block col-12 ">
                                <a class="nav-link"  href="{{ url('chat') }}">{{trans('main.Chat')}}</a>
                            </li>
                        </ul>
                    </div>
                </div>
        
                <div class="col-lg-9 col-md-12 profile-edit">
                    <div class="tab-content mt-2" id="pills-tabContent">
                        <div class="tab-pane fade general" id="general" role="tabpanel" aria-labelledby="general-tab">
                            
                        </div>
                        <div class="tab-pane fade experiences" id="experiences" role="tabpanel" aria-labelledby="experiences-tab">
                       
                            
                        </div>
                        
                        <div class="tab-pane fade education" id="education" role="tabpanel" aria-labelledby="education-tab">
                        </div>

                        
                        <div class="tab-pane fade skills" id="skills" role="tabpanel" aria-labelledby="skills-tab">
                       
                              
                           
                        </div>
                        <div class="tab-pane fade languages" id="languages" role="tabpanel" aria-labelledby="languages-tab">
                            
                        </div>
                        
                        <div class="tab-pane fade social  show active" id="social" role="tabpanel" aria-labelledby="social-tab">
                            <div class="container-fluid animatedParent animateOnce">
                                <div class="animated fadeInUpShort">
                                    <div class="row mt-3">
                                        <div class="">
                                            @if(count($user->socials) > 0)
                                                @foreach ($user->socials as $social)
                                                    {!! Form::open(['action'=> ['ProfileController@update', $user->id], 'method'=>'POST', 'enctype' =>'multipart/form-data', ' novalidate', 'class' => 'needs-validation'])!!}
                                                        <div class=" no-b  no-r">
                                                            <div class="">
                                                                <div class="form-row">
                                                                    <div class="col-md-12">
                                                                        <div class="form-row mt-1">
                                                                            <div class="form-group col-md-4 col-sm-6 m-0">
                                                                                {!! Form::label('facebook', trans('main.Facebook'), ['class' => 'col-form-label s-12']) !!}
                                                                                {!! Form::text('facebook', $social->facebook, ['class' => "form-control r-0 light s-12", 'placeholder' => trans('main.Facebook'), 'id' => 'facebook'])!!}
                                                                                <div class="valid-feedback">
                                                                                    {{trans('main.Looks Good')}}
                                                                                </div>
                                                                                <div class="invalid-feedback">
                                                                                    {{trans('main.Please Provide a Valid Input')}}
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group col-md-4 col-sm-6 m-0">
                                                                                {!! Form::label('twitter', trans('main.Twitter'), ['class' => 'col-form-label s-12']) !!}
                                                                                {!! Form::text('twitter', $social->twitter, ['class' => "form-control r-0 light s-12", 'placeholder' => trans('main.Twitter'), 'id' => 'twitter'])!!}
                                                                                <div class="valid-feedback">
                                                                                    {{trans('main.Looks Good')}}
                                                                                </div>
                                                                                <div class="invalid-feedback">
                                                                                    {{trans('main.Please Provide a Valid Input')}}
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group col-md-4 col-sm-6 m-0">
                                                                                {!! Form::label('google_plus', trans('main.Google Plus'), ['class' => 'col-form-label s-12']) !!}
                                                                                {!! Form::text('google_plus', $social->google_plus, ['class' => "form-control r-0 light s-12", 'placeholder' => trans('main.Google Plus'), 'id' => 'google_plus'])!!}
                                                                                <div class="valid-feedback">
                                                                                    {{trans('main.Looks Good')}}
                                                                                </div>
                                                                                <div class="invalid-feedback">
                                                                                    {{trans('main.Please Provide a Valid Input')}}
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group col-md-4 col-sm-6 m-0">
                                                                                {!! Form::label('linkedin', trans('main.Linkedin'), ['class' => 'col-form-label s-12']) !!}
                                                                                {!! Form::text('linkedin', $social->linkedin, ['class' => "form-control r-0 light s-12", 'placeholder' => trans('main.Linkedin'), 'id' => 'linkedin'])!!}
                                                                                <div class="valid-feedback">
                                                                                    {{trans('main.Looks Good')}}
                                                                                </div>
                                                                                <div class="invalid-feedback">
                                                                                    {{trans('main.Please Provide a Valid Input')}}
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group col-md-4 col-sm-6 m-0">
                                                                                {!! Form::label('pinterest', trans('main.Pinterest'), ['class' => 'col-form-label s-12']) !!}
                                                                                {!! Form::text('pinterest', $social->pinterest, ['class' => "form-control r-0 light s-12", 'placeholder' => trans('main.Pinterest'), 'id' => 'pinterest'])!!}
                                                                                <div class="valid-feedback">
                                                                                    {{trans('main.Looks Good')}}
                                                                                </div>
                                                                                <div class="invalid-feedback">
                                                                                    {{trans('main.Please Provide a Valid Input')}}
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group col-md-4 col-sm-6 m-0">
                                                                                {!! Form::label('instagram', trans('main.Instagram'), ['class' => 'col-form-label s-12']) !!}
                                                                                {!! Form::text('instagram', $social->instagram, ['class' => "form-control r-0 light s-12", 'placeholder' => trans('main.Instagram'), 'id' => 'instagram'])!!}
                                                                                <div class="valid-feedback">
                                                                                    {{trans('main.Looks Good')}}
                                                                                </div>
                                                                                <div class="invalid-feedback">
                                                                                    {{trans('main.Please Provide a Valid Input')}}
                                                                                </div>
                                                                            </div>
                                                                        </div>   
                                                                    
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        <div class="">
                                                            {!! Form::text('social_id', $social->id, ['hidden']) !!}
                                                            {!! Form::hidden('_method', 'PUT') !!}
                                                            {!! Form::submit(trans('main.Edit'), ['class' => "btn btn-primary mt-2 btn-sm", 'name' => 'edit-social']) !!}
                                                        </div>
                                                    {!! Form::close() !!}
                                                @endforeach
                                            @else
                                            {!! Form::open(['action'=> 'ProfileController@store', 'method'=>'POST', 'enctype' =>'multipart/form-data', ' novalidate', 'class' => 'needs-validation'])!!}
                                                <div class=" no-b  no-r">
                                                    <div class="">
                                                        <div class="form-row">
                                                            <div class="col-md-12">
                                                            <h5 class="card-title">{{trans('main.My Social Media')}}</h5>
                                                                <div class="form-row mt-1">
                                                                    <div class="form-group col-md-4 col-sm-6 m-0">
                                                                        {!! Form::label('facebook', trans('main.Facebook'), ['class' => 'col-form-label s-12']) !!}
                                                                        {!! Form::text('facebook','', ['class' => "form-control r-0 light s-12", 'placeholder' => trans('main.Facebook'), 'id' => 'facebook'])!!}
                                                                        <div class="valid-feedback">
                                                                            {{trans('main.Looks Good')}}
                                                                        </div>
                                                                        <div class="invalid-feedback">
                                                                            {{trans('main.Please Provide a Valid Input')}}
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group col-md-4 col-sm-6 m-0">
                                                                        {!! Form::label('twitter', trans('main.Twitter'), ['class' => 'col-form-label s-12']) !!}
                                                                        {!! Form::text('twitter', '', ['class' => "form-control r-0 light s-12", 'placeholder' => trans('main.Twitter'), 'id' => 'twitter'])!!}
                                                                        <div class="valid-feedback">
                                                                            {{trans('main.Looks Good')}}
                                                                        </div>
                                                                        <div class="invalid-feedback">
                                                                            {{trans('main.Please Provide a Valid Input')}}
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group col-md-4 col-sm-6 m-0">
                                                                        {!! Form::label('google_plus', trans('main.Google Plus'), ['class' => 'col-form-label s-12']) !!}
                                                                        {!! Form::text('google_plus', '', ['class' => "form-control r-0 light s-12", 'placeholder' => trans('main.Google Plus'), 'id' => 'google_plus'])!!}
                                                                        <div class="valid-feedback">
                                                                            {{trans('main.Looks Good')}}
                                                                        </div>
                                                                        <div class="invalid-feedback">
                                                                            {{trans('main.Please Provide a Valid Input')}}
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group col-md-4 col-sm-6 m-0">
                                                                        {!! Form::label('linkedin', trans('main.Linkedin'), ['class' => 'col-form-label s-12']) !!}
                                                                        {!! Form::text('linkedin', '', ['class' => "form-control r-0 light s-12", 'placeholder' => trans('main.Linkedin'), 'id' => 'linkedin'])!!}
                                                                        <div class="valid-feedback">
                                                                            {{trans('main.Looks Good')}}
                                                                        </div>
                                                                        <div class="invalid-feedback">
                                                                            {{trans('main.Please Provide a Valid Input')}}
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group col-md-4 col-sm-6 m-0">
                                                                        {!! Form::label('pinterest', trans('main.Pinterest'), ['class' => 'col-form-label s-12']) !!}
                                                                        {!! Form::text('pinterest', '', ['class' => "form-control r-0 light s-12", 'placeholder' => trans('main.Pinterest'), 'id' => 'pinterest'])!!}
                                                                        <div class="valid-feedback">
                                                                            {{trans('main.Looks Good')}}
                                                                        </div>
                                                                        <div class="invalid-feedback">
                                                                            {{trans('main.Please Provide a Valid Input')}}
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group col-md-4 col-sm-6 m-0">
                                                                        {!! Form::label('instagram', trans('main.Instagram'), ['class' => 'col-form-label s-12']) !!}
                                                                        {!! Form::text('instagram', '', ['class' => "form-control r-0 light s-12", 'placeholder' => trans('main.Instagram'), 'id' => 'instagram'])!!}
                                                                        <div class="valid-feedback">
                                                                            {{trans('main.Looks Good')}}
                                                                        </div>
                                                                        <div class="invalid-feedback">
                                                                            {{trans('main.Please Provide a Valid Input')}}
                                                                        </div>
                                                                    </div>
                                                                </div>   
                                                            
                                                            </div>
                                                        </div>
                                                    </div>
                                                <div class="">
                                                    {!! Form::submit(trans('main.Add'), ['class' => "btn btn-primary my-3", 'name' => 'create-social']) !!}
                                                </div>
                                            {!! Form::close() !!}
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>   
        </div>
    </div>


    @include('inc.home.foot')

@include('inc.home.scripts')
<script>
    // Date Picker 
    $(".date-picker").flatpickr();

    Dropzone.options.dropzone =
        {
            maxFilesize: 12,
            renameFile: function(file) {
                var dt = new Date();
                var time = dt.getTime();
               return time+file.name;
            },
            acceptedFiles: ".jpeg,.jpg,.png,.gif",
            addRemoveLinks: true,
            timeout: 5000,
            success: function(file, response) 
            {
                console.log(response);
            },
            error: function(file, response)
            {
               return false;
            }
        };
</script>
</body>
</html>