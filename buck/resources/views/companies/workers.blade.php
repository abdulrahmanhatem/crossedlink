@include('inc.home.head', ['title' => trans('main.My Jobs')])

<section class="section p-150 bread-crumbs">
    <div class="container">
        <a href="{{ url('/') }}" class="text-muted">{{trans('main.Home')}}</a> / <a href="{{ url('workers') }}" class="text-primary">{{trans('main.My Jobs')}}</a>
    </div>
</section>
<section class="section bg-light pt-4">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-9 text-center mt-4 pt-2">
                <ul class="nav nav-pills nav nav-pills bg-white rounded nav-justified flex-column flex-sm-row" id="pills-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link rounded active" id="explore-tab" data-toggle="pill" href="#explore" role="tab" aria-controls="explore" aria-selected="true">{{trans('main.Job List')}}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link rounded" id="saved-tab" data-toggle="pill" href="#saved" role="tab" aria-controls="saved" aria-selected="false">{{trans('main.Requests')}}
                            @if (auth()->user()->role == 1 || auth()->user()->role == 2)
                                @if(count(Helper::JobReqList()) > 0)
                                    <span class="badge badge-light">{{ count(Helper::JobReqList()) }}</span>
                                @endif
                            @endif   
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="tab-content mt-2  pb-4" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="explore" role="tabpanel" aria-labelledby="explore-tab">
                        <div class="row">
                            <div class="col-lg-12">
                                @foreach ($all_jobs as $job)
                                <div class="job-box bg-white overflow-hidden border rounded mt-4 position-relative overflow-hidden">
                                    <div class="dropdown position-absolute options-dropdown job-dropdown">
                                        <a class="dropdown-toggle" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="far fa-ellipsis-v"></i>
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                        <a class="dropdown-item" href="{{ url('post/job/' .$job->id . '/edit')}}">{{trans('main.Edit')}}</a>
                                          <a class="dropdown-item"  data-toggle="modal" data-target="#job-{{ $job->id}}-delete">{{trans('main.Delete')}}</a>
                                        </div>
                                    </div>
                                    <a href="{{ url('jobs/'.$job->id)}}">
                                        <div class="p-4">
                                            <div class="row align-items-center">
                                                <div class="col-md-2">
                                                    <div class="mo-mb-2">
                                                        @if(!empty(auth()->user()->profile_image))
                                                            <img src="{{ asset('uploads/images/profile_images/'.auth()->user()->profile_image ) }}" alt="" class="img-fluid mx-auto d-block">
                                                        @else 
                                                            <img src="{{ asset('uploads/images/profile_images/default_company.jpg') }}" alt="" class="img-fluid mx-auto d-block">
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div>
                                                        <h5 class="f-18 text-dark">{{ $job->title }}</></h5>
                                                        @if(auth()->user()->role == 2)
                                                            <p class="text-muted mb-0">{{ auth()->user()->company_name }}</p>
                                                        @elseif(auth()->user()->role == 1)
                                                            <p class="text-muted mb-0">{{ auth()->user()->name }}</p>
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
                                                        <p class="text-muted mb-0 mo-mb-2 small-text"> {{ Helper::getSalaryRange($job->salary) }}/m</p>
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
                                            <div class="col-md-6">
                                                
                                            </div>
                                            <div class="col-md-2">
                                                <div>
                                                    {{--<a href="{{ url('jobs/'.$job->id)}}" class="text-primary">Apply Now <i class="mdi mdi-chevron-double-right"></i></a>--}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
                                                {{trans('main.Are You Sure to Delete Job')}}
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
                            @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade show" id="saved" role="tabpanel" aria-labelledby="saved-tab">
                        <div class="row">
                            
                            <div class="col-lg-12">
                                @if(count(Helper::JobReqList()) > 0)
                                    <div class="candidates-listing-item">
                                        @foreach (Helper::JobReqList() as $worker)
                                            <div class="mt-4 p-3 card-view">
                                                @if (Helper::favCheck($worker->id))
                                                @endif 
                                                <div class="row position-relative">
                                                    @if (Helper::unlockCheck($worker->id))
                                                        @foreach (Helper::unlockList()  as $req)
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
                                                                                    {{ Helper::getCityByID($worker->city)}} ,  
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
                                                                @if (Helper::favCheck($worker->id))
                                                                    <button class="text-danger saved-btn">
                                                                        <div class="grid-fev-icon active">
                                                                            <a data-toggle="modal" data-target="#fav-{{ $worker->id }}-delete">
                                                                                <i class="fal fa-star fav-saved"></i>
                                                                            </a>
                                                                        </div>
                                                                    </button>
                                                                @else 
                                                                    {!! Form::open(['action'=> 'ProfileController@store', 'method'=>'POST', 'enctype' =>'multipart/form-data', 'class' => 'w-100'])!!}
                                                                    {!! Form::button('<i class="fal fa-star"></i>', ['class' => "non-button", 'name' => 'create-fav', 'type' => 'submit'], false) !!}
                                                                    {!! Form::text('worker_id', $worker->id, ['hidden'])!!}
                                                                    {!! Form::close() !!}
                                                                @endif
                                                            </div>
                                                        
                                                            @if(auth()->user()->role == 2 || auth()->user()->role == 1)
                                                                <div class="candidates-listing-btn mt-1">
                                                                    @if (Helper::unlockCheck($worker->id))
                                                                    <a href="{{url('profiles/'.$worker->id)}}" class="btn btn-sm text-green btn-card-option">{{trans('main.View')}}</a>
                                                                    @else 
                                                                    <a href="{{url('profiles/'.$worker->id)}}" class="btn btn-sm mb-1 text-green btn-card-option with-unlock">{{trans('main.View')}}</a>
                                                                        {!! Form::open(['action'=> 'ProfileController@store', 'method'=>'POST', 'enctype' =>'multipart/form-data', 'class' => 'w-100'])!!}
                                                                        {!! Form::submit(trans('main.Unlock'), ['class' => "btn text-red btn-sm btn-card-option", 'name' => 'create-unlock']) !!}
                                                                        {!! Form::text('worker_id', $worker->id, ['hidden'])!!}
                                                                        {!! Form::close() !!}
                                                                    @endif
                                                                </div>
                                                            @endif
                                                            <!-- Button trigger modal -->
                                                                <!-- Modal -->
                                                            <div class="modal fade" id="fav-{{ $worker->id }}-delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLabel">{{trans('main.Delete Worker')}}</h5>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    {!! Form::open(['action'=> ['ProfileController@update', auth()->user()->id], 'method'=>'POST', 'enctype' =>'multipart/form-data', 'class' => 'w-100'])!!}
                                                                        <div class="modal-body">
                                                                            {{trans('main.Are You Sure to Delete worker From Favorite List?')}}
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">{{trans('main.Close')}}</button>
                                                                            {!! Form::submit(trans('main.Delete'), ['class' => "btn btn-primary", 'name' => 'delete-fav']) !!}
                                                                            {!! Form::text('worker_id', $worker->id, ['hidden'])!!}
                                                                        </div>
                                                                    {!! Form::hidden('_method', 'PUT') !!}
                                                                    {!! Form::close() !!}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                
                                            </div>
                                        @endforeach
                                    </div>
                                @else 
                                    <div>
                                        <span class="empty-to-show box p-5 m-5 text-primary">
                                            {{trans('main.No Requests Yet')}}
                                        </span>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>



    @include('inc.home.foot')
    @include('inc.home.scripts')
</body>
</html>