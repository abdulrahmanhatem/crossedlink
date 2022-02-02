@include('inc.home.head', ['title' => trans('main.Languages')])
<section class="section p-150 bread-crumbs">
    <div class="container">
    <a href="{{ url('/') }}" class="text-muted">{{trans('main.Home')}}</a> / <a href="{{ url('profiles/'.auth()->user()->id.'/edit/languages') }}" class="text-primary">{{trans('main.Languages')}}</a>
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
                                <a class="nav-link active"  href="{{ url('profiles/'. auth()->user()->id. '/edit/languages') }}">{{trans('main.Languages')}}</a>
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

                        
                        <div class="tab-pane fade skills" id="skills" role="tabpanel" aria-labelledby="skills-tab">
                       
                              
                           
                        </div>
                        <div class="tab-pane fade languages  show active" id="languages" role="tabpanel" aria-labelledby="languages-tab">
                            <div class="row">
                                @if (count($user->languages) > 0)
                                    <div class="col-sm-6 pt-2">
                                        <div class="row">
                                            <div class="col-sm-12 position-relative">
                                                @foreach($user->languages as $language)
                                                <h6 class="title text-muted">{{Helper::languageByKey($language->language)}}</h6>
                                                <div class="position-relative ">
                                                    <div class="progress experience-view lang-view">
                                                        <div class="dropdown position-absolute options-dropdown">
                                                            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                <i class="far fa-ellipsis-v"></i>
                                                            </a>
                                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                            <a class="dropdown-item" data-toggle="modal" data-target="#language-{{ $language->id }}">{{trans('main.edit')}}</a>
                                                            <a class="dropdown-item" data-toggle="modal" data-target="#language-{{ $language->id }}-delete">{{trans('main.Delete')}}</a>
                                                            </div>
                                                        </div>
                                                        @if($language->proficiency == 0)
                                                            <div class="progress-bar progress-bar-striped position-relative bg-primary" style="width:20%;">
                                                                <div class="progress-value d-block h6">{{trans('main.Beginner')}}</div>
                                                            </div>
                                                        @elseif($language->proficiency == 1)
                                                            <div class="progress-bar progress-bar-striped position-relative bg-primary" style="width:40%;">
                                                                <div class="progress-value d-block h6">{{trans('main.Intermediate')}}</div>
                                                            </div>
                                                        @elseif($language->proficiency == 2)
                                                            <div class="progress-bar progress-bar-striped position-relative bg-primary" style="width:60%;">
                                                                <div class="progress-value d-block h6">{{trans('main.Advanced')}}</div>
                                                            </div>
                                                        @elseif($language->proficiency == 3)
                                                            <div class="progress-bar progress-bar-striped position-relative bg-primary" style="width:80%;">
                                                                <div class="progress-value d-block h6">{{trans('main.Fluent')}}</div>
                                                            </div>
                                                        @elseif($language->proficiency == 4)
                                                            <div class="progress-bar progress-bar-striped position-relative bg-primary" style="width:100%;">
                                                                <div class="progress-value d-block h6">{{trans('main.Native')}}</div>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                                
                                                
                                                <!-- Edit Modal -->
                                                <div class="modal fade" id="language-{{ $language->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">{{trans('main.Edit')}} {{Helper::languageByKey($language->language)}}</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                            </div>
                                                            {!! Form::open(['action'=>['ProfileController@update', $user->id], 'method'=>'POST', 'enctype' =>'multipart/form-data', ' novalidate', 'class' => 'needs-validation'])!!}

                                                            <div class="modal-body">
                                                                <div class="card no-b  no-r">
                                                                    <div class="card-body">
                                                                        <div class="form-row">
                                                                            <div class="col-md-12">
                                                                                <div class="form-row mt-1">
                                                                                    <div class="form-group col-4 m-0">
                                                                                        {!! Form::select('language', Helper::languages(), $language->language, ['class' => "form-control r-0 light s-12 selectpicker", 'placeholder' => trans('main.Language'), 'id' => 'language', 'data-live-search' => "true"])!!}
                                                                                        <div class="valid-feedback">
                                                                                            {{trans('main.Looks Good')}}
                                                                                        </div>
                                                                                        <div class="invalid-feedback">
                                                                                            {{trans('main.Please Provide a Valid Input')}}
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="form-group col-4 m-0">
                                                                                        {!! Form::select('proficiency', Helper::languageLevel(), $language->proficiency, ['class' => "form-control r-0 light s-12", 'placeholder' => trans('main.Proficiency'), 'name' => 'proficiency'])!!}
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
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">{{trans('main.Close')}}</button>
                                                                {!! Form::submit(trans('main.Update'), ['class' => "btn btn-primary btn-sm", 'name' => 'edit-language']) !!}
                                                            </div>
                                                            {!! Form::text('language_id', $language->id, ['hidden']) !!}
                                                            {!! Form::hidden('_method', 'PUT') !!}
                                                            {!! Form::close() !!}
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Delete Modal -->
                                                <div class="modal fade" id="language-{{ $language->id }}-delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">{{trans('main.Delete')}} {{Helper::languageByKey($language->language)}}</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        {!! Form::open(['action'=> ['ProfileController@update', $user->id], 'method'=>'POST', 'enctype' =>'multipart/form-data', 'class' => 'w-100'])!!}
                                                            <div class="modal-body">
                                                                {{trans('main.Are You Sure About Deleting')}} {{Helper::languageByKey($language->language)}} {{trans('main.Language')}}?
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">{{trans('main.Close')}}</button>
                                                                {!! Form::submit(trans('main.Delete'), ['class' => "btn btn-primary btn-sm", 'name' => 'delete-language']) !!}

                                                                
                                                            </div>
                                                        {!! Form::text('language_id', $language->id, ['hidden']) !!}
                                                        {!! Form::hidden('_method', 'PUT') !!}
                                                        {!! Form::close() !!}
                                                        </div>
                                                    </div>
                                                </div>
                                                @endforeach
                                            </div>
                                        </div><!--end process box-->
                                    </div>
                                @endif 
                                <div class="col-sm-6 pt-2 position-relative">
                                    <div class="container-fluid animatedParent animateOnce">
                                        <div class="animated fadeInUpShort">
                                            <div class="row mt-3">
                                                <div class="w-100">
                                                    {!! Form::open(['action'=>'ProfileController@store', 'method'=>'POST', 'enctype' =>'multipart/form-data', ' novalidate', 'class' => 'needs-validation'])!!}
                                                        <div class=" no-b  no-r">
                                                            <div class="">
                                                                <div class="form-row">
                                                                    <div class="col-md-12">
                                                                        <div class="form-row mt-1">
                                                                            <div class="form-group col-6 m-0">
                                                                                {!! Form::select('language', Helper::languages(),'', ['class' => "form-control r-0 light s-12 selectpicker", 'placeholder' => trans('main.Language'), 'id' => 'language', 'data-live-search' => "true"])!!}
                                                                                <div class="valid-feedback">
                                                                                    {{trans('main.Looks Good')}}
                                                                                </div>
                                                                                <div class="invalid-feedback">
                                                                                    {{trans('main.Please Provide a Valid Input')}}
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group col-6 m-0">
                                                                                {!! Form::select('proficiency', Helper::languageLevel(), '', ['class' => "form-control r-0 light s-12", 'placeholder' => trans('main.Proficiency'), 'name' => 'proficiency'])!!}
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
                                                        </div>
                                                        <div class="">
                                                            {!! Form::submit(trans('main.Add'), ['class' => "btn btn-primary mt-2 btn-sm", 'name' => 'create-language']) !!}
                                                        </div>
                                                    {!! Form::close() !!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            
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
</script>
</body>
</html>