@include('inc.home.head', ['title' => trans('main.Jobs')])
<section class="section p-150 bread-crumbs">
    <div class="container">
    <a href="{{ url('/') }}" class="text-muted">{{trans('main.Home')}}</a> / <a href="{{ url('jobs')}}" class="text-primary">{{trans('main.My jobs')}}</a>
    </div>
</section>
    

<section class="section bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-9 text-center mt-4 pt-2">
                <ul class="nav nav-pills nav nav-pills bg-white rounded nav-justified flex-column flex-sm-row" id="pills-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link rounded" id="explore-tab" data-toggle="pill" href="#explore" role="tab" aria-controls="explore" aria-selected="true" title="Related To Your Experience">{{trans('main.Explore')}}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link rounded active" id="saved-tab" data-toggle="pill" href="#saved" role="tab" aria-controls="saved" aria-selected="false">{{trans('main.Saved')}}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link rounded" id="apply-tab" data-toggle="pill" href="#apply" role="tab" aria-controls="apply" aria-selected="false">{{trans('main.Applications')}}</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="tab-content tab-content mt-3 mb-4" id="pills-tabContent">
                    <div class="tab-pane fade show" id="explore" role="tabpanel" aria-labelledby="explore-tab">
                        <div class="row">
                            <div class="col-lg-12">
                                @if(count(Helper::categoriesJobs(auth()->user()->category_id)) > 0)
                                    @foreach (Helper::categoriesJobs(auth()->user()->category_id) as $job)
                                        @if (count(Helper::userByID($job->employer_id)) > 0)
                                            @foreach(Helper::userByID($job->employer_id) as $key => $employer)
                                            <div class="job-box bg-white overflow-hidden border rounded mt-4 position-relative overflow-hidden">
                                                  @if (auth()->user()->role == 0)
                                                    @if(Helper::savedJobCheck($job->id))
                                                    <div class="lable text-center pt-2 pb-2 d-block not-saved-job-btn">
                                                        <ul class="list-unstyled best text-white mb-0 text-uppercase">
                                                            <li class="list-inline-item">
                                                                @if(count(auth()->user()->savedJobs) > 0)
                                                                    @foreach(auth()->user()->savedJobs as $saved)
                                                                        @if($saved->saved_id == $job->id)
                                                                            <form action="" method="get" id="" class="w-100 liked-star click-star{{$saved->saved_id}}">
                                                                                <button  onclick="job_favourite('.click-star{{$saved->saved_id}}')"><i class="mdi mdi-star"></i></button>
                                                                                {!! Form::text('saved_id', $saved->saved_id, ['hidden']) !!}
                                                                            </form>
                                                                            
                                                                        @endif
                                                                    @endforeach
                                                                @endif
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    @else 
                                                        <div class="lable text-center pt-2 pb-2 d-block saved-job-btn">
                                                            <ul class="list-unstyled best text-white mb-0 text-uppercase ">
                                                                <li class="list-inline-item">
                                                                        <form action="" method="get" id="" class="w-100 unliked-star click-unstar{{$job->id}}">
                                                                            <button  onclick="job_favourite('.click-unstar{{$job->id}}')"><i class="mdi mdi-star"></i></button>
                                                                            {!! Form::text('saved_id', $job->id, ['hidden']) !!}
                                                                        </form>
                                                                     
                                                                </li>
                                                            </ul>
                                                        </div>
                                                        
                                                    @endif
                                                @endif
                                                <a href="{{ url('jobs/'.$job->id)}}">
                                                    <div class="p-4">
                                                        <div class="row align-items-center">
                                                            <div class="col-md-2">
                                                                <div class="mo-mb-2">
                                                                    @if(!empty($employer->profile_image))
                                                                        <img src="{{ asset('uploads/images/profile_images/'.$employer->profile_image ) }}" alt="" class="img-fluid mx-auto d-block">
                                                                    @else 
                                                                        <img src="{{ asset('uploads/images/profile_images/default_company.jpg') }}" alt="" class="img-fluid mx-auto d-block">
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div>
                                                                    <h5 class="f-18 text-dark">{{ $job->title }}</h5>
                                                                    @if($employer->role == 2)
                                                                        <p class="text-muted mb-0">{{ $employer->company_name }}</p>
                                                                    @elseif($employer->role == 1)
                                                                        <p class="text-muted mb-0">{{ $employer->name }}</p>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div>
                                                                    <p class="text-muted mb-0"><i class="mdi mdi-map-marker text-primary mr-2"></i>{{ $job->address}}</p>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2">
                                                                @if (Helper::getSalaryRange($job->salary))
                                                                    <p class="text-muted mb-0 mo-mb-2 small-text"> {{ Helper::getSalaryRange($job->salary) }}/{{trans('main.month')}}</p>
                                                                @endif
                                                            </div>
                                                            <div class="col-md-2">
                                                                <div>
                                                                    <p class="text-muted mb-0">
                                                                        @foreach (Helper::job_type() as $key => $type)
                                                                            @if ($key == $job->type )
                                                                                {{ $type}}
                                                                            @endif
                                                                        @endforeach
                                                                    
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                                <div class="p-3 bg-light">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div>
                                                                <p class="text-muted mb-0 mo-mb-2"><span class="text-dark">{{trans('main.Experience')}} : </span>
                                                                    @foreach (Helper::experience() as $key => $type)
                                                                        @if ($key == $job->experience )
                                                                            {{$type}} 
                                                                        @endif
                                                                    @endforeach
                                                                   </p>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="text-right job-options">
                                                                @if (Helper::applysByUserCheck($job->id))
                                                                    <a data-toggle="modal" data-target="#unapply-{{ $job->id }}"  class="btn btn-success btn-sm">
                                                                        {{trans('main.Unapply')}}
                                                                    </a>
                                                                @else z
                                                                    @if (Helper::canJobApply())
                                                                        {!! Form::open(['action'=>'ProfileController@store', 'method'=>'POST', 'class' => 'apply-form-btn'])!!}
                                                                        {!! Form::text('job_id', $job->id, ['hidden'])!!}
                                                                        {!! Form::submit(trans('main.Apply Now'), ['class' => "btn btn-primary btn-sm", 'name' => 'create-apply']) !!}
                                                                        {!! Form::close() !!}
                                                                    @else 
                                                                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#cant_apply">
                                                                            {{trans('main.Apply Now')}}
                                                                        </button>
                                                                    @endif
                                                                @endif
                                                                
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                        @endif
                                    @endforeach
                                    <div class="modal fade" id="cant_apply" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">{{trans('main.Complete Your Profile!')}}</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                            </div>
                                            <div class="modal-body">
                                                {{trans('main.You Can not Apply For Jobs Untill You Complete Your Profile Informations!')}}
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
                                            <a type="button" class="btn btn-primary" href="{{ url('profiles/'.auth()->user()->id) }}">{{trans('main.My Profile')}}</a>
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                    
                                @else 
                                    <h6 class="text-center w-100 mt-3 empty-to-show box">{{trans('main.No Jobs To Show')}}</h6>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade show active " id="saved" role="tabpanel" aria-labelledby="saved-tab">
                        <div class="row">
                            
                            <div class="col-lg-12">
                                @if(count(Helper::savedJobsByUser(auth()->user()->id)) > 0)
                                    @foreach (Helper::savedJobsByUser(auth()->user()->id) as $job)
                                        @if (count(Helper::userByID($job->employer_id)) > 0)
                                            @foreach(Helper::userByID($job->employer_id) as $key => $employer)
                                            <div class="job-box bg-white overflow-hidden border rounded mt-4 position-relative overflow-hidden">
                                                @if (auth()->user()->role == 0)
                                                    @if(Helper::savedJobCheck($job->id))
                                                    <div class="lable text-center pt-2 pb-2 d-block not-saved-job-btn">
                                                        <ul class="list-unstyled best text-white mb-0 text-uppercase">
                                                            <li class="list-inline-item">
                                                                @if(count(auth()->user()->savedJobs) > 0)
                                                                    @foreach(auth()->user()->savedJobs as $saved)
                                                                        @if($saved->saved_id == $job->id)
                                                                            <form action="" method="get" id="" class="w-100 liked-star click-star{{$saved->saved_id}}">
                                                                                <button  onclick="job_favourite('.click-star{{$saved->saved_id}}')"><i class="mdi mdi-star"></i></button>
                                                                                {!! Form::text('saved_id', $saved->saved_id, ['hidden']) !!}
                                                                            </form>
                                                                            
                                                                        @endif
                                                                    @endforeach
                                                                @endif
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    @else 
                                                        <div class="lable text-center pt-2 pb-2 d-block saved-job-btn">
                                                            <ul class="list-unstyled best text-white mb-0 text-uppercase ">
                                                                <li class="list-inline-item">
                                                                        <form action="" method="get" id="" class="w-100 unliked-star click-unstar{{$job->id}}">
                                                                            <button  onclick="job_favourite('.click-unstar{{$job->id}}')"><i class="mdi mdi-star"></i></button>
                                                                            {!! Form::text('saved_id', $job->id, ['hidden']) !!}
                                                                        </form>
                                                                     
                                                                </li>
                                                            </ul>
                                                        </div>
                                                        
                                                    @endif
                                                @endif
                                                <a href="{{ url('jobs/'.$job->id)}}">
                                                    <div class="p-4">
                                                        <div class="row align-items-center">
                                                            <div class="col-md-2">
                                                                <div class="mo-mb-2">
                                                                    @if(!empty($employer->profile_image))
                                                                        <img src="{{ asset('uploads/images/profile_images/'.$employer->profile_image ) }}" alt="" class="img-fluid mx-auto d-block">
                                                                    @else 
                                                                        <img src="{{ asset('uploads/images/profile_images/default_company.jpg') }}" alt="" class="img-fluid mx-auto d-block">
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div>
                                                                    <h5 class="f-18 text-dark">{{ $job->title }}</h5>
                                                                    @if($employer->role == 2)
                                                                        <p class="text-muted mb-0">{{ $employer->company_name }}</p>
                                                                    @elseif($employer->role == 1)
                                                                        <p class="text-muted mb-0">{{ $employer->name }}</p>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div>
                                                                    <p class="text-muted mb-0"><i class="mdi mdi-map-marker text-primary mr-2"></i>{{ $job->address}}</p>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2">
                                                                @if (Helper::getSalaryRange($job->salary))
                                                                    <p class="text-muted mb-0 mo-mb-2 small-text"> {{ Helper::getSalaryRange($job->salary) }}/{{trans('main.month')}}</p>
                                                                @endif
                                                            </div>
                                                            <div class="col-md-2">
                                                                <div>
                                                                    <p class="text-muted mb-0">
                                                                        @foreach (Helper::job_type() as $key => $type)
                                                                            @if ($key == $job->type )
                                                                                {{ $type}}
                                                                            @endif
                                                                        @endforeach
                                                                    
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                                <div class="p-3 bg-light">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div>
                                                                <p class="text-muted mb-0 mo-mb-2"><span class="text-dark">{{trans('main.Experience')}} : </span>
                                                                    @foreach (Helper::experience() as $key => $type)
                                                                        @if ($key == $job->experience )
                                                                            {{$type}} 
                                                                        @endif
                                                                    @endforeach
                                                                   </p>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="text-right job-options">
                                                                @if (Helper::applysByUserCheck($job->id))
                                                                    <a data-toggle="modal" data-target="#unapply-{{ $job->id }}"  class="btn btn-success btn-sm">
                                                                        {{trans('main.Unapply')}}
                                                                    </a>
                                                                @else 
                                                                    @if (Helper::canJobApply())
                                                                        {!! Form::open(['action'=>'ProfileController@store', 'method'=>'POST', 'class' => 'apply-form-btn'])!!}
                                                                        {!! Form::text('job_id', $job->id, ['hidden'])!!}
                                                                        {!! Form::submit(trans('main.Apply Now'), ['class' => "btn btn-primary btn-sm", 'name' => 'create-apply']) !!}
                                                                        {!! Form::close() !!}
                                                                    @else 
                                                                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#cant_apply">
                                                                            {{trans('main.Apply Now')}}
                                                                        </button>
                                                                    @endif
                                                                @endif
                                                                
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                        @endif
                                    @endforeach
                                @else 
                                    <h6 class="text-center w-100 mt-3 empty-to-show box">{{trans('main.No Jobs Saved')}}</h6>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade show" id="apply" role="tabpanel" aria-labelledby="apply-tab">
                        <div class="row">
                            <div class="col-lg-12">
                                @if(count(Helper::applysByUser(auth()->user()->id)) > 0)
                                    @foreach (Helper::applysByUser(auth()->user()->id) as $job)
                                        @if (count(Helper::userByID($job->employer_id)) > 0)
                                            @foreach(Helper::userByID($job->employer_id) as $key => $employer)
                                            <div class="job-box bg-white overflow-hidden border rounded mt-4 position-relative overflow-hidden">
                                               @if (auth()->user()->role == 0)
                                                    @if(Helper::savedJobCheck($job->id))
                                                    <div class="lable text-center pt-2 pb-2 d-block not-saved-job-btn">
                                                        <ul class="list-unstyled best text-white mb-0 text-uppercase">
                                                            <li class="list-inline-item">
                                                                @if(count(auth()->user()->savedJobs) > 0)
                                                                    @foreach(auth()->user()->savedJobs as $saved)
                                                                        @if($saved->saved_id == $job->id)
                                                                            <form action="" method="get" id="" class="w-100 liked-star click-star{{$saved->saved_id}}">
                                                                                <button  onclick="job_favourite('.click-star{{$saved->saved_id}}')"><i class="mdi mdi-star"></i></button>
                                                                                {!! Form::text('saved_id', $saved->saved_id, ['hidden']) !!}
                                                                            </form>
                                                                            
                                                                        @endif
                                                                    @endforeach
                                                                @endif
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    @else 
                                                        <div class="lable text-center pt-2 pb-2 d-block saved-job-btn">
                                                            <ul class="list-unstyled best text-white mb-0 text-uppercase ">
                                                                <li class="list-inline-item">
                                                                        <form action="" method="get" id="" class="w-100 unliked-star click-unstar{{$job->id}}">
                                                                            <button  onclick="job_favourite('.click-unstar{{$job->id}}')"><i class="mdi mdi-star"></i></button>
                                                                            {!! Form::text('saved_id', $job->id, ['hidden']) !!}
                                                                        </form>
                                                                     
                                                                </li>
                                                            </ul>
                                                        </div>
                                                        
                                                    @endif
                                                @endif
                                                <a href="{{ url('jobs/'.$job->id)}}">
                                                    <div class="p-4">
                                                        <div class="row align-items-center">
                                                            <div class="col-md-2">
                                                                <div class="mo-mb-2">
                                                                    @if(!empty($employer->profile_image))
                                                                        <img src="{{ asset('uploads/images/profile_images/'.$employer->profile_image ) }}" alt="" class="img-fluid mx-auto d-block">
                                                                    @else 
                                                                        <img src="{{ asset('uploads/images/profile_images/default_company.jpg') }}" alt="" class="img-fluid mx-auto d-block">
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div>
                                                                    <h5 class="f-18 text-dark">{{ $job->title }}</h5>
                                                                    @if($employer->role == 2)
                                                                        <p class="text-muted mb-0">{{ $employer->company_name }}</p>
                                                                    @elseif($employer->role == 1)
                                                                        <p class="text-muted mb-0">{{ $employer->name }}</p>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div>
                                                                    <p class="text-muted mb-0"><i class="mdi mdi-map-marker text-primary mr-2"></i>{{ $job->address}}</p>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2">
                                                                @if (Helper::getSalaryRange($job->salary))
                                                                    <p class="text-muted mb-0 mo-mb-2 small-text"> {{ Helper::getSalaryRange($job->salary) }}/{{trans('main.month')}}</p>
                                                                @endif
                                                            </div>
                                                            <div class="col-md-2">
                                                                <div>
                                                                    <p class="text-muted mb-0">
                                                                        @foreach (Helper::job_type() as $key => $type)
                                                                            @if ($key == $job->type )
                                                                                {{ $type}}
                                                                            @endif
                                                                        @endforeach
                                                                    
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                                <div class="p-3 bg-light">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div>
                                                                <p class="text-muted mb-0 mo-mb-2"><span class="text-dark">{{trans('main.Experience')}} : </span>
                                                                    @foreach (Helper::experience() as $key => $type)
                                                                        @if ($key == $job->experience )
                                                                            {{$type}} 
                                                                        @endif
                                                                    @endforeach
                                                                   </p>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="text-right job-options">
                                                                @if (Helper::applysByUserCheck($job->id))
                                                                    <a data-toggle="modal" data-target="#unapply-{{ $job->id }}"  class="btn btn-success btn-sm">
                                                                        {{trans('main.Unapply')}}
                                                                    </a>
                                                                @else 
                                                                    @if (Helper::canJobApply())
                                                                        {!! Form::open(['action'=>'ProfileController@store', 'method'=>'POST', 'class' => 'apply-form-btn'])!!}
                                                                        {!! Form::text('job_id', $job->id, ['hidden'])!!}
                                                                        {!! Form::submit(trans('main.Apply Now'), ['class' => "btn btn-primary btn-sm", 'name' => 'create-apply']) !!}
                                                                        {!! Form::close() !!}
                                                                    @else 
                                                                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#cant_apply">
                                                                            {{trans('main.Apply Now')}}
                                                                        </button>
                                                                    @endif
                                                                @endif
                                                                
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                        @endif
                                    @endforeach
                                @else 
                                    <h6 class="text-center w-100 mt-3 empty-to-show box">{{trans('main.Apply To Some')}}<a href="search/jobs">{{trans('main.Jobs')}} </a></h6>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
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
     @auth
     @if(app()->getLocale() == "ar")  
    <script>
    function job_favourite(id){
        $(id).unbind().bind('submit', function(e) {
          e.preventDefault();
        if($(id).hasClass('liked-star')){
              $.ajax({
                  type: "GET",
                  url: "{{url('operations/ajax')}}",
                  data: $(this).serialize()+"&delete-saved-job-worker=''",
                  success: (response)=>{
                    $(id).removeClass('liked-star').addClass('unliked-star');
                    $(id).closest('div').removeClass('not-saved-job-btn');
                    $('.toast').fadeIn().removeClass('hide').addClass('show');
                    $('.toast').find(".message").text('تم إلغاء حفظ الوظيفة');
                    $(id).each(function(){
                        if($(this).parents('#saved').length != 0){
                            $(this).closest('.overflow-hidden').fadeOut(1000);
                        }
                    });
                     
                      setTimeout(function () {
                        $('.toast').fadeOut().removeClass('show').addClass('hide');
                    }, 5000);
                  }
              });
          }else{
           $.ajax({
                  type: "GET",
                  url: "{{url('operations/ajax')}}",
                  data: $(this).serialize()+"&create-saved-job-worker=''",
                  success: (response)=>{
                      $(this).removeClass('unliked-star').addClass('liked-star');
                      $(this).closest('div').addClass('not-saved-job-btn');
                      $('.toast').fadeIn().removeClass('hide').addClass('show');
                      $('.toast').find(".message").text('تم حفظ الوظيفة');
                        $(this).closest('.overflow-hidden').clone().appendTo("#saved .row .col-lg-12");
                      setTimeout(function () {
                        $('.toast').fadeOut().removeClass('show').addClass('hide');
                    }, 5000);
                  }
              });
        }
     });
    }
   
    </script>
     @else 
         <script>
    function job_favourite(id){
        $(id).unbind().bind('submit', function(e) {
          e.preventDefault();
        if($(id).hasClass('liked-star')){
              $.ajax({
                  type: "GET",
                  url: "{{url('operations/ajax')}}",
                  data: $(this).serialize()+"&delete-saved-job-worker=''",
                  success: (response)=>{
                    $(id).removeClass('liked-star').addClass('unliked-star');
                    $(id).closest('div').removeClass('not-saved-job-btn');
                    $('.toast').fadeIn().removeClass('hide').addClass('show');
                    $('.toast').find(".message").text('Worker deleted from favourite !');
                    $(id).each(function(){
                        if($(this).parents('#saved').length != 0){
                            $(this).closest('.overflow-hidden').fadeOut(1000);
                        }
                    });
                     
                      setTimeout(function () {
                        $('.toast').fadeOut().removeClass('show').addClass('hide');
                    }, 5000);
                  }
              });
          }else{
           $.ajax({
                  type: "GET",
                  url: "{{url('operations/ajax')}}",
                  data: $(this).serialize()+"&create-saved-job-worker=''",
                  success: (response)=>{
                      $(this).removeClass('unliked-star').addClass('liked-star');
                      $(this).closest('div').addClass('not-saved-job-btn');
                      $('.toast').fadeIn().removeClass('hide').addClass('show');
                      $('.toast').find(".message").text('Worker saved to favourite !');
                        $(this).closest('.overflow-hidden').clone().appendTo("#saved .row .col-lg-12");
                      setTimeout(function () {
                        $('.toast').fadeOut().removeClass('show').addClass('hide');
                    }, 5000);
                  }
              });
        }
     });
    }
     @endif
        @endauth
</body>
</html>