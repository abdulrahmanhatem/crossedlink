@include('inc.home.head', ['title' => $job->title])

<section class="section p-150">
    <div class="container">
        <a href="{{ url('/') }}" class="text-muted" class="mr-1">{{trans('main.Home')}}</a>  /  <a href="{{ url('search/jobs') }}" class="text-primary mx-1">{{trans('main.Jobs')}}</a> /  <a href="{{ url('/jobs/'.$job->id) }}" class="text-primary">{{ $job->title }}</a>
    </div>
</section>

    <!-- JOB DETAILS START -->
    <section class="section my-4 job-show">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h4 class="text-dark mb-3">{{ $job->title }}

                        <span class="float-right small-text">
                            @if(auth()->check())
                                @if (auth()->user()->role == 0)
                                    <div class="grid-fev-icon d-inline-block v-align-bottom">
                                        @if(Helper::savedJobCheck($job->id))
                                            @if(count(auth()->user()->savedJobs) > 0)
                                                @foreach(auth()->user()->savedJobs as $saved)
                                                    @if($saved->saved_id == $job->id)
                                                        <span class="list-inline-item float-right">
                                                            <button class="text-danger saved-btn">
                                                                <div class="grid-fev-icon active">
                                                                    <a data-toggle="modal" data-target="#saved-{{ $saved->id }}-delete" title="{{trans('main.Unsave Job')}}">
                                                                        <i class="mdi mdi-heart"></i>
                                                                    </a>
                                                                </div>
                                                            </button>
                                                        </span>
                                                    @endif
                                                @endforeach
                                            @endif
                                        @else
                                            <span>
                                                <div class="lable text-center d-block saved-btn">
                                                    <ul class="list-unstyled best text-white mb-0 text-uppercase ">
                                                        <li class="list-inline-item">
                                                            {!! Form::open(['action'=>'ProfileController@store', 'method'=>'POST'])!!}
                                                            {!! Form::text('saved_id', $job->id, ['hidden'])!!}
                                                            {!! Form::button('<i class="mdi mdi-heart"></i>', ['class' => "", 'name' => 'create-saved-job', 'type' => 'submit', 'title' => trans('main.Save Job')], false) !!}
                                                            {!! Form::close() !!} 
                                                        </li>
                                                    </ul>
                                                </div>
                                            </span>
                                        @endif
                                    </div>
                                    @if (Helper::applysByUserCheck($job->id))
                                <span class="text-success pt-2 d-inline-block you-applied"  data-toggle="modal" data-target="#unapply-{{ $job->id }}" title="{{trans('main.Unapply')}}">{{trans('main.Unapply')}}</span> 
                                    @else
                                        <div class="job-detail mt-4">
                                            @if (Helper::canJobApply())
                                                {!! Form::open(['action'=>'ProfileController@store', 'method'=>'POST'])!!}
                                                {!! Form::text('job_id', $job->id, ['hidden'])!!}
                                                {!! Form::submit(trans('main.Apply Now'), ['class' => "btn btn-primary btn-sm", 'name' => 'create-apply']) !!}
                                                {!! Form::close() !!}
                                            @else 
                                                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#cant_apply">
                                                    {{trans('main.Apply Now')}}
                                                </button>
                                            @endif
                                        </div>
                                    @endif 
                                @endif 
                            @endif 
                        </span>
                        
                    </h4>
                    @if(auth()->check())
                        @if ($job->employer_id == auth()->user()->id)
                            <div class="dropdown position-absolute options-dropdown job-dropdown job-dropdown-show">
                                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="far fa-ellipsis-v"></i>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                <a class="dropdown-item" href="{{ url('post/job/' .$job->id . '/edit')}}">{{trans('main.Edit')}}</a>
                                <a class="dropdown-item"  data-toggle="modal" data-target="#job-{{ $job->id}}-delete">{{trans('main.Delete')}}</a>
                                </div>
                            </div>
                        @endif
                    @endif
                    <!-- Delete Modal -->
                    <div class="modal fade" id="job-{{ $job->id }}-delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">{{trans('main.Delete')}} {{ $job->title }}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            {!! Form::open(['action'=> ['EmployerClientController@destroyJob', $job->id], 'method'=>'POST', 'enctype' =>'multipart/form-data', 'class' => 'w-100'])!!}
                                <div class="modal-body">
                                    {{trans('main.Are You Sure to Delete')}}  {{ $job->title }} {{trans('main.Job?')}} 
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{trans('main.Close')}}</button>
                                    {!! Form::submit(trans('main.Delete'), ['class' => "btn btn-primary", 'name' => 'delete-experience']) !!}
                                    
                                </div>
                            {!! Form::hidden('_method', 'DELETE') !!}
                            {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row pb-3">
                <div class="col-lg-8 col-md-7">
                    <div class="job-detail border rounded p-4">
                        <div class="job-detail-content">
                            @foreach(Helper::userByID($job->employer_id) as $user)
                                @if(!empty($user->profile_image))
                                    <img src="{{ asset('uploads/images/profile_images/'.$user->profile_image ) }}" alt="" class="img-fluid float-left mr-md-3 mr-2 d-block employer-avatar">
                                @else
                                    <img src="{{ asset('uploads/images/profile_images/default_company.jpg') }}" alt="" class="img-fluid float-left mr-md-3 mr-2 d-block employer-avatar">
                                @endif
                            @endforeach
                            <div class="job-detail-com-desc overflow-hidden d-block">
                                <h4 class="mb-2"><a href="#" class="text-dark">{{ $job->title }}</a></h4>
                                <p class="text-muted mb-0"><i class="mdi mdi-link-variant mr-2"></i>
                                    @foreach(Helper::userByID($job->employer_id) as $user)
                                        @if(!empty($user->company_name))
                                        <a href="{{ url('profiles/'.$user->id ) }}">{{ $user->company_name }}</p></a>
                                        @else
                                        <a href="{{ url('profiles/'.$user->id ) }}">{{ $user->name }}</p></a>
                                        @endif
                                    @endforeach
                                    
                                <p class="text-muted mb-0"><i class="mdi mdi-map-marker mr-2"></i>{{ $job->address }}</p>
                            </div>
                        </div>
                        <div class="job-detail-desc mt-4">
                            <p class="text-muted mb-3">{{ $job->overview }}</p>
                        </div>
                    </div>
                    @if(!empty($job->desc ))
                        <div class="row">
                            <div class="col-lg-12">
                                <h5 class="text-dark mt-4">{{trans('main.Job Description')}} :</h5>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="job-detail border rounded mt-2 p-4">
                                    <div class="job-detail-desc">
                                        <p class="text-muted mb-3">{{ $job->desc }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                    

                    @if(!empty($job->qual ))
                        <div class="row">
                            <div class="col-lg-12">
                                <h5 class="text-dark mt-4">{{trans('main.Qualification')}} :</h5>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="job-detail border rounded mt-2 p-4">
                                    <div class="job-detail-desc">
                                        <div class="job-details-desc-item">
                                            <div class="float-left mr-3">
                                                <i class="mdi mdi-send text-primary"></i>
                                            </div>
                                            <p class="text-muted mb-2">{{ $job->qual }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                    

                    @if(!empty($job->resp ))
                        <div class="row">
                            <div class="col-lg-12">
                                <h5 class="text-dark mt-4">{{trans('main.Primary Responsibilities')}} :</h5>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="job-detail border rounded mt-2 p-4">
                                    <div class="job-detail-desc">
                                        <div class="job-details-desc-item">
                                            <div class="float-left mr-3">
                                                <i class="mdi mdi-send text-primary"></i>
                                            </div>
                                            <p class="text-muted mb-2">{{ $job->resp }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    @if(!empty($job->docs))
                        <div class="row">
                            <div class="col-lg-12">
                                <h5 class="text-dark mt-4">{{trans('main.Documents')}}:</h5>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="job-detail border rounded mt-2 p-4">
                                    <div class="job-detail-desc">
                                        <div class="job-details-desc-item">
                                            <div class="float-left mr-3">
                                                <i class="mdi mdi-send text-primary"></i>
                                            </div>
                                            @if (!empty($job->docs))
                                            <i class="fad fa-file-alt"></i>
                                            <span>
                                                <a href="{{url('download/docs/'.$job->id )}}" class="download" target="_blank">{{trans('main.Download')}}</a>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                    @if(auth()->check())
                        @if (count($job->requests) > 0)
                            @foreach(Helper::userByID($job->employer_id) as $user)   
                                @if(auth()->user()->id != 0 && auth()->user()->id == $user->id)
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <h5 class="text-dark mt-4">{{trans('main.Workers Applications For This Job')}}:</h5>
                                        </div>
                                    </div>

                                    <div class="row job-view-accept">
                                        <div class="col-lg-12">
                                            @foreach ($job->requests as $request)
                                                @foreach (Helper::userByID($request->worker_id) as $worker)
                                                {{--@if (!empty($worker->category_id) )--}}
                                                <div class="mt-4 p-3 card-view">
                                                    <div class="row position-relative">
                                                        @if (Helper::unlockCheck($worker->id))
                                                            @foreach (Helper::unlocklist() as $req)
                                                                @if ($worker->id == $req->worker_id)
                                                                    <span class="unlocked-badge">{{trans('main.Unlocked')}}</span>
                                                                @endif
                                                            @endforeach
                                                        @endif
                                                        <div class="col-md-9">
                                                            <a href="{{ url('profiles/'.$worker->id) }}">
                                                                <div class="float-left mr-4 img-cont">
                                                                    @if (!empty($worker->profile_image))
                                                                        <img src="{{ asset('uploads/images/profile_images/'.$worker->profile_image) }}" alt="" class="d-block rounded" height="90" width="92">
                                                                    @else 
                                                                        <img src="{{ asset('uploads/images/profile_images/default.jpg') }}" alt="" class="d-block rounded" height="90" width="92">
                                                                    @endif
                                                                </div>
                                                                <div class="candidates-list-desc overflow-hidden job-single-meta  pt-2">
                                                                    @if (Helper::unlockCheck($worker->id))
                                                                        <h5 class="mb-2 name text-dark">{{ucwords($worker->name) }}</h5>
                                                                    @else
                                                                        <h5 class="mb-2 name text-dark">{{ ucwords(Helper::hashString($worker->name)) }}</h5>
                                                                    @endif
                                                                    <ul class="list-unstyled">
                                                                        @if (!empty(Helper::categotyByID($worker->category_id)))
                                                                            <li class="text-muted"><i class="mdi mdi-account mr-1"></i>
                                                                            {{Helper::categotyByID($worker->category_id)->name}}
                                                                        @endif 
                                                                        @if (!empty($worker->city) || !empty($worker->country))
                                                                            <li class="text-muted"><i class="mdi mdi-map-marker mr-1"></i>
                                                                                @if(!empty($worker->city))
                                                                                        {{$worker->city}} ,  
                                                                                @endif
                                                                                @if(!empty($worker->country))
                                                                                        {{ Helper::getCountryByKey($worker->country)}}
                                                                                @endif
                                                                            </li>    
                                                                        @endif  
                                                                        @foreach(Helper::salaryRange() as $key => $salary)
                                                                            @if (!empty($worker->average_salary))
                                                                                @if ($worker->average_salary == $key)
                                                                                    <li class="text-muted"><i class="mdi mdi-currency-usd mr-1"></i>{{ $salary }}/month</li>
                                                                                @endif
                                                                            @endif
                                                                        @endforeach
                                                                        @foreach (Helper::experience() as $key => $experience)
                                                                            @if ($worker->experience == $key)
                                                                                <li class="text-muted"><i class="far fa-briefcase mr-1"></i>{{ $experience }}</li>
                                                                            @endif
                                                                        @endforeach
                                                                        @if ($worker->about)
                                                                            <li class="text-muted about">{{ $worker->about }}</li>
                                                                        @endif
                                                                    </ul>
                                                                    @if (count($worker->skills) > 0)
                                                                        <span class="text-muted">Skills:</span>
                                                                            @foreach ($worker->skills as $skill)
                                                                                @foreach (Helper::getSkills($skill->name) as $s)
                                                                                <span class="skill">{{ $s }}</span>
                                                                                @endforeach
                                                                            @endforeach
                                                                    @endif
                                                                    
                                                                </div>
                                                            </a>
                                                        </div>
                    
                                                        <div class="col-md-3">
                                                            <div class="candidates-list-fav-btn text-right">
                                                                <div class="fav-icon">
                                                                    <i class="fal fa-star"></i>
                                                                </div>
                                                            
                                                                @if(auth()->user()->role == 2 || auth()->user()->role == 1)
                                                                    <div class="candidates-listing-btn mt-1">
                                                                        @if (Helper::unlockCheck($worker->id))
                                                                        <a href="{{url('profiles/'.$worker->id)}}" class="btn btn-sm text-green btn-card-option">{{trans('main.View')}}</a>
                                                                        @else 
                                                                        <a href="{{url('profiles/'.$worker->id)}}" class="btn btn-sm mb-1 text-green btn-card-option with-unlock">{{trans('main.View')}}</a>
                                                                            {!! Form::open(['action'=> 'ProfileController@store', 'method'=>'POST', 'enctype' =>'multipart/form-data', 'class' => 'w-100'])!!}
                                                                            {!! Form::submit(trans('main.Unlock'), ['class' => "btn text-red btn-sm btn-card-option", 'name' => 'create-unlock']) !!}
                                                                            {!! Form::text('worker_id', $worker->id, ['hidden']) !!}
                                                                            {!! Form::close() !!}
                                                                        @endif
                                                                    </div>
                                                                @endif
                                                            
                                                            </div>
                                                        </div>
                                                    </div>
                    
                                                </div>
                                                {{--@endif--}}
                                                        @endforeach
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                            @endforeach  
                        @endif
                    @endif
                      
                </div>

                <div class="col-lg-4 col-md-5 mt-4 mt-sm-0">
                    <div class="job-detail border rounded p-4">
                        <h5 class="text-muted text-center pb-2"><i class="mdi mdi-map-marker mr-2"></i>{{trans('main.Details')}}</h5>

                        <div class="job-detail-location pt-4 border-top">
                            <div class="job-details-desc-item">
                                <div class="float-left mr-2">
                                    <i class="mdi mdi-bank text-muted"></i>
                                </div>
                                <p class="text-muted mb-2">: {{ $job->city }} {{ Helper::getCountryByKey($job->country) }} </p>
                            </div>

                            <div class="job-details-desc-item">
                                <div class="float-left mr-2">
                                    <i class="mdi mdi-currency-usd text-muted"></i>
                                </div>
                                @if (Helper::getSalaryRange($job->salary))
                                    <p class="text-muted mb-2">: {{ Helper::getSalaryRange($job->salary) }}/{{trans('main.month')}}</p>
                                @endif
                            </div>

                            <div class="job-details-desc-item">
                                <div class="float-left mr-2">
                                    <i class="mdi mdi-security text-muted"></i>
                                </div>
                                <p class="text-muted mb-2">: {{Helper::getExperience($job->experience) }}</p>
                            </div>

                            <div class="job-details-desc-item">
                                <div class="float-left mr-2">
                                    <i class="mdi mdi-clock-outline text-muted"></i>
                                </div>
                                @if (Config::get('app.locale') == 'ar')
                                    <p class="text-muted mb-2">: منذ {{ Helper::since($job->created_at)}}</p>
                                @else 
                                    <p class="text-muted mb-2">: {{ Helper::since($job->created_at)}} {{trans('main.ago')}}</p>
                                @endif
                                
                            </div>

                            <!--<h6 class="text-dark f-17 mt-3 mb-0">Share Job :</h6>
                            <ul class="social-icon list-inline mt-3 mb-0">
                                <li class="list-inline-item"><a href="#" class="rounded"><i class="mdi mdi-facebook"></i></a></li>
                                <li class="list-inline-item"><a href="#" class="rounded"><i class="mdi mdi-twitter"></i></a></li>
                                <li class="list-inline-item"><a href="#" class="rounded"><i class="mdi mdi-google-plus"></i></a></li>
                                <li class="list-inline-item"><a href="#" class="rounded"><i class="mdi mdi-whatsapp"></i></a></li>
                                <li class="list-inline-item"><a href="#" class="rounded"><i class="mdi mdi-linkedin"></i></a></li>
                            </ul>-->
                        </div>
                    </div>

                    @foreach(Helper::userByID($job->employer_id) as $user)
                           @if(empty($user->sa_from) && empty($user->su_from) && empty($user->mo_from) && empty($user->tu_from) && empty($user->we_from) && empty($user->th_from) && empty($user->fr_from) && empty($user->sa_to) && empty($user->su_to) && empty($user->mo_to) && empty($user->tu_to) && empty($user->we_to) && empty($user->th_to) && empty($user->fr_to))
                        
                        @else
                        <div class="job-detail border rounded mt-4 p-4">
                            <h5 class="text-muted text-center pb-2"><i class="mdi mdi-clock-outline mr-2"></i>{{trans('main.Operating Hours')}}</h5>

                            <div class="job-detail-time border-top pt-4">
                                <ul class="list-inline mb-0">
                                     @if (!empty($user->sa_from) && !empty($user->sa_to))
                                        <li class="clearfix text-muted border-bottom pb-3">
                                            <div class="float-left">{{trans('main.Saturday')}}</div>
                                            <div class="float-right">
                                                <h5 class="f-13 mb-0">{{ Helper::operatingHoursCheck($user->sa_from)   . ' - ' . Helper::operatingHoursCheck($user->sa_to)}}</h5>
                                            </div>
                                        </li>
                                    @endif
                                    
                                     @if (!empty($user->su_from) && !empty($user->su_to))
                                        <li class="clearfix text-muted border-bottom pb-3">
                                            <div class="float-left">{{trans('main.Sunday')}}</div>
                                            <div class="float-right">
                                                <h5 class="f-13 mb-0">{{ Helper::operatingHoursCheck($user->su_from)  . ' - ' .Helper::operatingHoursCheck($user->su_to)}}</h5>
                                            </div>
                                        </li>
                                    @endif
                                    
                                    @if (!empty($user->mo_from) && !empty($user->mo_to))
                                        <li class="clearfix text-muted border-bottom pb-3">
                                            <div class="float-left">{{trans('main.Monday')}}</div>
                                            <div class="float-right">
                                                <h5 class="f-13 mb-0">{{ Helper::operatingHoursCheck($user->mo_from)   . ' - ' . Helper::operatingHoursCheck($user->mo_to)}}</h5>
                                            </div>
                                        </li>
                                    @endif

                                    @if (!empty($user->tu_from) && !empty($user->tu_to))
                                        <li class="clearfix text-muted border-bottom pb-3">
                                            <div class="float-left">{{trans('main.Tuesday')}}</div>
                                            <div class="float-right">
                                                <h5 class="f-13 mb-0">{{ Helper::operatingHoursCheck($user->tu_from)  . ' - ' . Helper::operatingHoursCheck($user->tu_to)}}</h5>
                                            </div>
                                        </li>
                                    @endif

                                     @if (!empty($user->we_from) && !empty($user->we_to))
                                        <li class="clearfix text-muted border-bottom pb-3">
                                            <div class="float-left">{{trans('main.Wednesday')}}</div>
                                            <div class="float-right">
                                                <h5 class="f-13 mb-0">{{ Helper::operatingHoursCheck($user->we_from)   . ' - ' .  Helper::operatingHoursCheck($user->we_to)}}</h5>
                                            </div>
                                        </li>
                                    @endif

                                    @if (!empty($user->th_from) && !empty($user->th_to))
                                        <li class="clearfix text-muted border-bottom pb-3">
                                            <div class="float-left">{{trans('main.Thursday')}}</div>
                                            <div class="float-right">
                                                <h5 class="f-13 mb-0">{{ Helper::operatingHoursCheck($user->th_from)   . ' - ' .  Helper::operatingHoursCheck($user->th_to)}}</h5>
                                            </div>
                                        </li>
                                    @endif

                                    @if (!empty($user->fr_from) && !empty($user->fr_to))
                                        <li class="clearfix text-muted pb-3">
                                            <div class="float-left">{{trans('main.Friday')}}</div>
                                            <div class="float-right">
                                                <h5 class="f-13 mb-0">{{ Helper::operatingHoursCheck($user->fr_from)   . ' - ' . Helper::operatingHoursCheck($user->fr_to)}}</h5>
                                            </div>
                                        </li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                        @endif
                    @endforeach

                    {{--@if (count(Helper::workerRequests()) > 0)
                        
                        @foreach (Helper::workerRequests() as $req )
                            @if($req->job_id == $job->id)
                                @if ($req->state == 2)
                                    <span class="text-success pt-2 d-block">Congratulations!<br>You Are Accepted</span> 
                                @else 
                                    <span class="text-success pt-2 d-block">You Applied For This Job Already!</span> 
                                @endif
                            @endif
                        @endforeach
                    @else
                        @if (auth()->user()->role == 0)
                            <div class="job-detail mt-4">
                                @if (Helper::canJobApply())
                                    {!! Form::open(['action'=>'ProfileController@store', 'method'=>'POST'])!!}
                                    {!! Form::text('job_id', $job->id, ['hidden'])!!}
                                    {!! Form::submit(trans('main.Apply Now'), ['class' => "btn btn-primary btn-sm  mb-3", 'name' => 'create-apply']) !!}
                                    {!! Form::close() !!}
                                @else 
                                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#cant_apply">
                                        Applzy Now
                                    </button>
                                @endif
                            </div>
                        @endif
                    @endif --}}
                    @if(auth()->check())
                        @if (auth()->user()->role == 0)
                            <div class="modal fade" id="cant_apply" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">{{trans('main.Complete Your Profile First!')}}</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>
                                    <div class="modal-body">
                                        {{trans('main.You Can Not Apply For Jobs Untill You Complete Your Profile Informations!')}}
                                        <hr>
                                        <div class="clearfix"></div>
                                        @if (!empty(Helper::completeProfile()))
                                            @foreach(Helper::completeProfile() as $error)
                                                <div class="text-danger">{{ $error }}</div>
                                            @endforeach
                                        @endif
                                    </div>
                                    <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{trans('main.Close')}}</button>
                                    <a type="button" class="btn btn-primary" href="{{ url('me') }}">{{trans('main.My Profile')}}</a>
                                    </div>
                                </div>
                                </div>
                            </div>  
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </section>
    @if(auth()->check())
        @if (auth()->user()->role == 0)
            @if(count(auth()->user()->savedJobs) > 0)
                @foreach(auth()->user()->savedJobs as $saved)
                    <!-- Delete Modal -->
                    <div class="modal fade" id="saved-{{ $saved->id }}-delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">{{trans('main.Unsave Job')}} </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    {{trans('main.Are You Sure To Un Save This Job?')}}
                                </div>
                                <div class="modal-footer">
                                    {!! Form::open(['action'=> ['ProfileController@update', auth()->user()->id], 'method'=>'POST', 'enctype' =>'multipart/form-data', 'class' => 'w-100'])!!}
                                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">{{trans('main.Close')}}</button>
                                    {!! Form::submit(trans('main.Un Save'), ['class' => "text-danger btn btn-secondary btn-sm", 'name' => 'delete-saved-job']) !!}
                                    {!! Form::text('job_id', $saved->job_id, ['hidden'])!!}
                                    {!! Form::text('saved_id', $saved->id, ['hidden']) !!}
                                    {!! Form::hidden('_method', 'PUT') !!}
                                    {!! Form::close() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        @endif
    @endif
    <!-- JOB DETAILS END -->
    @if(auth()->check())
    @if (auth()->user()->role == 0)
        @if(count(Helper::categoriesJobs(auth()->user()->category_id)) > 0)
            @foreach (Helper::categoriesJobs(auth()->user()->category_id) as $job)
            <!-- Un Apply Modal -->
            <div class="modal fade" id="unapply-{{ $job->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">{{trans('main.Unapply Job')}}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            {{trans('main.Are You Sure To Unapply This Job?')}}
                        </div>
                        <div class="modal-footer">
                            {!! Form::open(['action'=> ['ProfileController@update', auth()->user()->id], 'method'=>'POST', 'enctype' =>'multipart/form-data', 'class' => 'w-100'])!!}
                            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">{{trans('main.Close')}}</button>
                            {!! Form::submit(trans('main.Unapply'), ['class' => "text-danger btn btn-secondary btn-sm", 'name' => 'unapply-job']) !!}
                            {!! Form::text('job_id', $job->id, ['hidden'])!!}
                            {!! Form::hidden('_method', 'PUT') !!}
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
            <!-- Un Save Modal -->
                @if(count(auth()->user()->savedJobs) > 0)
                    @foreach(auth()->user()->savedJobs as $saved)
                        <!-- Delete Modal -->
                        <div class="modal fade" id="saved-{{ $job->id }}-delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">{{trans('main.Unsave Job')}}</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        {{trans('main.Are You Sure To Un Save This Job?')}}
                                    </div>
                                    <div class="modal-footer">
                                        {!! Form::open(['action'=> ['ProfileController@update', auth()->user()->id], 'method'=>'POST', 'enctype' =>'multipart/form-data', 'class' => 'w-100'])!!}
                                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">{{trans('main.Close')}}</button>
                                        {!! Form::submit(trans('main.Un Save'), ['class' => "text-danger btn btn-secondary btn-sm", 'name' => 'delete-saved-job']) !!}
                                        {!! Form::text('job_id', $saved->job_id, ['hidden'])!!}
                                        {!! Form::text('saved_id', $saved->id, ['hidden']) !!}
                                        {!! Form::hidden('_method', 'PUT') !!}
                                        {!! Form::close() !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            @endforeach
        @endif
    @endif
@endif
    @include('inc.home.foot')
    @include('inc.home.scripts')
</body>
</html>