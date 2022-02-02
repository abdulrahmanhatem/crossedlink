@include('inc.home.head', ['title' => trans('main.Skills')])
<section class="section p-150 bread-crumbs">
    <div class="container">
        <a href="{{ url('/') }}" class="text-muted">{{trans('main.Home')}}</a> / <a href="{{ url('profiles/'.auth()->user()->id.'/edit/skills') }}" class="text-primary">{{trans('main.Skills')}}</a>
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
                                <a class="nav-link active"  href="{{ url('profiles/'. auth()->user()->id. '/edit/skills') }}">{{trans('main.Skills')}}</a>
                            </li>
                            <li class="nav-item d-block col-12">
                                <a class="nav-link"  href="{{ url('profiles/'. auth()->user()->id. '/edit/languages') }}">{{trans('main.Languages')}}</a>
                            </li>
                            <li class="nav-item d-block col-12">
                                <a class="nav-link"  href="{{ url('profiles/'. auth()->user()->id. '/edit/social') }}">{{trans('main.Online Presence')}}</a>
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

                        
                        <div class="tab-pane fade skills  show active" id="skills" role="tabpanel" aria-labelledby="skills-tab">
                            @if (count($user->skills) > 0)
                                <div class="row text-center pt-5 mt-5">
                                    <div class="col-md-12 pt-2">
                                            @foreach($user->skills as $skill)
                                                {!! Form::open(['action'=>['ProfileController@update', $user->id], 'method'=>'POST', 'enctype' =>'multipart/form-data', ' novalidate', 'class' => 'needs-validation'])!!}
                                                <div class="tab-pane" id="TabCareerInfo" name="Career History">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                        <label for="txtSkills" class="pr-2">{{trans('main.Skills')}}</label>
                                                            <input type="text" class="form-control" id="txtSkills" name = "name"  data-role="tagsinput" value="{{ $skill->name }}"> 
                                                            {!! Form::submit(trans('main.Update'), ['class' => "btn btn-primary mt-2 btn-sm ml-2", 'name' => 'edit-skill']) !!}                                   
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="">
                                                    
                                                </div>
                                                {!! Form::text('skill_id', $skill->id, ['hidden']) !!}
                                                {!! Form::hidden('_method', 'PUT') !!}
                                                {!! Form::close() !!}
                                            @endforeach
                                        </div><!--end process box-->
                                    </div>
                                </div> 
                            @else
                                <div class="row">
                                    <div class="col-md-12 text-center pt-5 mt-5">
                                        {!! Form::open(['action'=>['ProfileController@store', $user->id], 'method'=>'POST', 'enctype' =>'multipart/form-data', ' novalidate', 'class' => 'needs-validation'])!!}
                                        <div class="tab-pane" id="TabCareerInfo" name="Career History">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <label for="txtSkills" class="pr-2">{{trans('main.Skills')}}</label>
                                                    <input type="text" class="form-control" id="txtSkills" name = "name"  data-role="tagsinput"> 
                                                    {!! Form::submit(trans('main.Add'), ['class' => "btn btn-primary mt-2 btn-sm ml-2", 'name' => 'create-skill']) !!}                                   
                                                </div>
                                            </div>
                                            
                                        </div>
                                        {!! Form::close() !!}
                                        </div><!--end process box-->
                                    </div>
                                </div> 
                            @endif  
                        </div>
                        <div class="tab-pane fade languages" id="languages" role="tabpanel" aria-labelledby="languages-tab">
                            
                        </div>
                        
                        <div class="tab-pane fade social" id="social" role="tabpanel" aria-labelledby="social-tab">
                            
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