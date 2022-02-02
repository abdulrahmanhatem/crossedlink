@include('inc.home.head_cover', ['title' => trans('main.Home')])
    <!-- Start Home -->
    <section class="bg-home">
        <div class="home-center">
            <div class="home-desc-center bg-light">
                <div class="container">
                    @if(auth()->check())
                        @if(auth()->user()->role > 0)
                            <div class="home-form-position">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="home-registration-form p-4 mb-3">
                                            {!! Form::open(['action'=>'ajaxController@request', 'method'=>'POST'])!!}
                                                <div class="row">
                                                     <div class="col-lg-4 col-md-6">
                                                        <div class="registration-form-box">
                                                            <i class="fa fa-list-alt"></i>
                                                            @if(auth()->user()->role == 2 || auth()->user()->role == 3)
                                                                {!! Form::select('category', Helper::companies_categories(), '', ['id' => 'select-category', 'class' => '', 'placeholder' => trans('main.Category')]) !!}
                                                            @elseif(auth()->user()->role == 1)
                                                                {!! Form::select('category', Helper::personal_categories(), '', ['id' => 'select-category', 'class' => '', 'placeholder' => trans('main.Category')])!!}
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 col-md-6">
                                                        <div class="registration-form-box">
                                                            <i class="fa fa-location-arrow"></i>
                                                            <select class="form-control resume" id="countries" multiple="multiple" name="country[]" size="4" placeholder="Country">
                                                                @foreach (Helper::countries() as $key => $country)
                                                                    <option value="{{$key}}">{{$country}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 col-md-6">
                                                        <div class="registration-form-box">
                                                        <input type="submit" id="submit" name="send" class="submitBnt btn btn-primary btn-block" value="{{trans('main.Submit')}}">
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
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
    <!-- end home -->
    @if(auth()->check())
        @if(auth()->user()->role > 0)
            <!-- popular category start -->
            <section class="section categories-show">
                <div class="container">
                    <div class="row justify-content-center ">
                        <div class="col-12">
                            <div class="section-title text-center mb-4 pb-2">
                                <h4 class="title title-line pb-5">{{trans('main.Categories')}}</h4>
                              
                                <p class="text-muted para-desc mx-auto mb-1">{{trans('main.Post a job to tell us about your project. We will quickly match you with the right artisans.')}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        @if(auth()->user()->role == 3)
                            @foreach(Helper::categoriesShow() as $category)
                                @if($loop->index < 8  )
                                    @if(!empty($category->icon))
                                        <div class="col-lg-3 col-md-6 mt-4 pt-2 cat-box">
                                            <a href="javascript:void(0)">
                                                <div class="popu-category-box bg-light rounded text-center p-4">
                                                    
                                                        <div class="popu-category-icon mb-3">
                                                            <i class="fa fa-{{$category->icon}} d-inline-block rounded-pill text-primary"></i>
                                                        </div>
                                                    
                                                    <div class="popu-category-content">
                                                        @if (Config::get('app.locale') == 'ar')
                                                            <h5 class="mb-2 text-dark title">{{$category->name_ar}}</h5>
                                                        @else
                                                            <h5 class="mb-2 text-dark title">{{$category->name}}</h5>  
                                                        @endif
                                                        
                                                        {{--<p class="text-success mb-0 rounded">{{ count($category->jobs)}} {{trans('main.Jobs')}}</p>--}}
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    @endif
                                @endif
                            @endforeach
                        @elseif(auth()->user()->role == 2)  
                            @foreach(Helper::companyCategoriesShow() as $category)
                                @if($loop->index < 8  )
                                      @if(!empty($category->icon))
                                        <div class="col-lg-3 col-md-6 mt-4 pt-2 cat-box">
                                            <a href="javascript:void(0)">
                                                <div class="popu-category-box bg-light rounded text-center p-4">
                                                    
                                                        <div class="popu-category-icon mb-3">
                                                            <i class="fa fa-{{$category->icon}} d-inline-block rounded-pill text-primary"></i>
                                                        </div>
                                                    
                                                    <div class="popu-category-content">
                                                        @if (Config::get('app.locale') == 'ar')
                                                            <h5 class="mb-2 text-dark title">{{$category->name_ar}}</h5>
                                                        @else
                                                            <h5 class="mb-2 text-dark title">{{$category->name}}</h5>  
                                                        @endif
                                                        
                                                        {{--<p class="text-success mb-0 rounded">{{ count($category->jobs)}} {{trans('main.Jobs')}}</p>--}}
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    @endif
                                @endif
                            @endforeach
                        @elseif(auth()->user()->role == 1)
                            @foreach(Helper::personalCategoriesShow() as $category)
                                @if($loop->index < 8  )
                                     @if(!empty($category->icon))
                                        <div class="col-lg-3 col-md-6 mt-4 pt-2 cat-box">
                                            <a href="javascript:void(0)">
                                                <div class="popu-category-box bg-light rounded text-center p-4">
                                                    
                                                        <div class="popu-category-icon mb-3">
                                                            <i class="fa fa-{{$category->icon}} d-inline-block rounded-pill text-primary"></i>
                                                        </div>
                                                    
                                                    <div class="popu-category-content">
                                                        @if (Config::get('app.locale') == 'ar')
                                                            <h5 class="mb-2 text-dark title">{{$category->name_ar}}</h5>
                                                        @else
                                                            <h5 class="mb-2 text-dark title">{{$category->name}}</h5>  
                                                        @endif
                                                        
                                                        {{--<p class="text-success mb-0 rounded">{{ count($category->jobs)}} {{trans('main.Jobs')}}</p>--}}
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    @endif
                                @endif
                            @endforeach
                        @endif
                    </div>
                </div>
            </section>
            <!-- popular category end -->
        @endif
    @endif


    <!-- all jobs start -->
    @if(auth()->check())
        @if (auth()->user()->role == 2 || auth()->user()->role == 1)
        <section class="section bg-light">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12">
                        <div class="section-title text-center mb-4 pb-2">
                            <h4 class="title title-line pb-5">{{trans('main.Find Your Candidate')}}</h4>
                            <p class="text-muted para-desc mx-auto mb-1">{{trans('main.Post a job to tell us about your project. We will quickly match you with the right artisans.')}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <div class="container">
            @if(count(Helper::categoriesWorkersSearchGet()) > 0)
                <div class="candidates-listing-item home">
                    @foreach (Helper::categoriesWorkersSearchGet() as $worker)
                        @if ($loop->index < 7)
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
                                                @if (App\FavWorker::where('employer_id', auth()->user()->id)->where('worker_id', $worker->id)->first())
                                                    <!--<button class="text-danger saved-btn">-->
                                                    <!--    <div class="grid-fev-icon active">-->
                                                    <!--        <a data-toggle="modal" data-target="#fav-{{ $worker->id }}-delete">-->
                                                    <!--            <i class="fas fa-star fav-saved fav-{{ $worker->id }}-delete"></i>-->
                                                    <!--        </a>-->
                                                    <!--    </div>-->
                                                    <!--</button>-->
                                                    <form action="#" id="favourite{{$worker->id}}" class="dislike" >
                                                           {!! Form::text('worker_id', $worker->id, ['hidden'])!!}
                                                         
                                                            @csrf
                                                    <button class="non-button saved-btn" onclick="favourite('#favourite{{$worker->id}}')"><i class="fas fa-star fav-saved fav-{{ $worker->id }}-delete"></i></button>
                                                    </form>
                                                @else
                                                    <form action="#"   id="favourite{{$worker->id}}" class="like" >
                                                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                                                        <input type="hidden" name="worker_id" value="{{$worker->id}}">   
                                                         
                                                        <button name="create-fav" class="non-button feo" onclick="favourite('#favourite{{$worker->id}}')" ><i class="fas fa-star"></i></button>
                                                    </form>
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
                                                    <form class="w-100" id="fav-{{$worker->id}}-remove">
                                                        
                                                        <div class="modal-body">
                                                            {{trans('main.Are You Sure to Delete worker From Favorite List?')}}
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">{{trans('main.Close')}}</button>
                                                            {!! Form::text('worker_id', $worker->id, ['hidden'])!!}
                                                            {!! Form::hidden('delete-fav',null, [])!!}
                                                            @csrf
                                                            {!! Form::hidden('_method', 'PUT') !!}

                                                            <button class="btn btn-primary" onclick="deletefavourite('#fav-{{$worker->id}}-remove','#fav-{{$worker->id}}-delete','.fav-{{ $worker->id }}-delete')">{{trans('main.Delete')}}</button>
                                                        </div>
                                                    </form>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        {{--@endif--}}
                        @endif
                    @endforeach
                </div>
            @else 
            <span class="m-5 empty-to-show box">{{trans('main.No Candidates To Show')}}
            </span>    
            @endif
        </div>
        @endif

        @if(auth()->user()->role == 0)
            @if(Helper::categoriesJobs(auth()->user()->category_id))
                <section class="section bg-light">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-12">
                                <div class="section-title text-center mb-4 pb-2">
                                    
                                    <h4 class="title title-line pb-5">{{trans('main.Find Your Jobs')}}</h4>
                                    <p class="text-muted para-desc mx-auto mb-1">{{trans('main.Post a job to tell us about your project. We will quickly match you with the right artisans.')}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-9 text-center mt-4 pt-2">
                            <ul class="nav nav-pills nav nav-pills bg-white rounded nav-justified flex-column flex-sm-row" id="pills-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link rounded active" id="explore-tab" data-toggle="pill" href="#explore" role="tab" aria-controls="explore" aria-selected="true">{{trans('main.Explore')}}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link rounded" id="saved-tab" data-toggle="pill" href="#saved" role="tab" aria-controls="saved" aria-selected="false">{{trans('main.Saved')}}</a>
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
                                <div class="tab-pane fade show active" id="explore" role="tabpanel" aria-labelledby="explore-tab">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            @if(count(Helper::categoriesJobs(auth()->user()->category_id)) > 0)
                                                @foreach (Helper::categoriesJobs(auth()->user()->category_id) as $job)
                                                    @if ($loop->index < 15)
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
                                                                                                {{--    {!! Form::open(['action'=> ['ProfileController@update', auth()->user()->id], 'method'=>'POST', 'enctype' =>'multipart/form-data', 'class' => 'w-100'])!!} --}}
                                                                                                    <form action="" method="get" id="" class="w-100 liked-star click-star{{$saved->saved_id}}">
                                                                                                        <button  onclick="job_favourite('.click-star{{$saved->saved_id}}')"><i class="mdi mdi-star"></i></button>
                                                                                                        {!! Form::text('saved_id', $saved->saved_id, ['hidden']) !!}
                                                                                                        {{-- {!! Form::text('saved_id', $saved->id, ['hidden']) !!} --}}
                                                                                                    </form>
                                                                                                    {{-- {!! Form::button('<i class="mdi mdi-star"></i></li>', ['class' => "", 'name' => 'delete-saved-job', 'type' => 'submit'], false) !!} --}}
                                                                                                    {{-- {!! Form::hidden('_method', 'PUT') !!} --}}
                                                                                                    {{--{!! Form::close() !!}--}}
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
                                                                                            {{--    {!! Form::open(['action'=> ['ProfileController@update', auth()->user()->id], 'method'=>'POST', 'enctype' =>'multipart/form-data', 'class' => 'w-100'])!!} --}}
                                                                                                    <form action="" method="get" id="" class="w-100 unliked-star click-unstar{{$job->id}}">
                                                                                                        <button  onclick="job_favourite('.click-unstar{{$job->id}}')"><i class="mdi mdi-star"></i></button>
                                                                                                        {!! Form::text('saved_id', $job->id, ['hidden']) !!}
                                                                                                    </form>
                                                                                                    {{-- {!! Form::button('<i class="mdi mdi-star"></i></li>', ['class' => "", 'name' => 'delete-saved-job', 'type' => 'submit'], false) !!} --}}
                                                                                                    {{-- {!! Form::hidden('_method', 'PUT') !!} --}}
                                                                                                    {{--{!! Form::close() !!}--}}
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
                                                    @endif
                                                @endforeach
                                                <!-- Modal -->
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
                                                        <a type="button" class="btn btn-primary" href="{{ url('me') }}">{{trans('main.My Profile')}}</a>
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
                                <div class="tab-pane fade show " id="saved" role="tabpanel" aria-labelledby="saved-tab">
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
                                                                                <button type="button" class="btn btn-success btn-sm">
                                                                                    {{trans('main.Applied')}}
                                                                                </button>
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
                                
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end containar -->
            @endif
        @endif
    @endif
    <!-- all jobs end -->

    
    

@if(!auth()->check())
    <section class="section bg-light">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-9 text-center mt-4 pt-2">
                    <ul class="nav nav-pills nav nav-pills bg-white rounded nav-justified flex-column flex-sm-row" id="pills-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link rounded active" id="explore-tab" data-toggle="pill" href="#workers" role="tab" aria-controls="explore" aria-selected="true" title="Related To Your Experience">{{trans('main.Candidates')}}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link rounded" id="saved-tab" data-toggle="pill" href="#jobs" role="tab" aria-controls="saved" aria-selected="false">{{trans('main.Jobs')}}</a>
                        </li>
                    </ul>
                </div>
            </div>
           
            <div class="row">
                <div class="col-12">
                    <div class="tab-content tab-content mt-3 mb-4" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="workers" role="tabpanel" aria-labelledby="explore-tab">
                            <div class="row">
                                <div class="col-lg-12 candidates-listing-item">
                                   
                                    @if(count(Helper::visitorWorkers()) > 0)
                                        @foreach (Helper::visitorWorkers() as $worker)
                                        @if ($loop->index < 7)
                                        {{--@if (!empty($worker->category_id) )--}}
                                        <div class="mt-4 p-3 card-view visitor-workers">
                                            <div class="row position-relative">
                                               
                                                <div class="col-md-9">
                                                    <a href="{{ url('candidate/'.$worker->id) }}">
                                                        <div class="float-left mr-4 img-cont">
                                                            @if (!empty($worker->profile_image))
                                                                <img src="{{ asset('uploads/images/profile_images/'.$worker->profile_image) }}" alt="" class="d-block rounded" height="90" width="92">
                                                            @else 
                                                                <img src="{{ asset('uploads/images/profile_images/default.jpg') }}" alt="" class="d-block rounded" height="90" width="92">
                                                            @endif
                                                        </div>
                                                        <div class="candidates-list-desc overflow-hidden job-single-meta  pt-2">
                                                           <h5 class="mb-2 name text-dark">{{ucwords(Helper::hashString($worker->name))}}</h5>
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
                                                            <button name="create-fav" class="non-button feo" onclick="" ><i class="fas fa-star"></i></button>
                                                        </div>
                                                        <div class="candidates-listing-btn mt-1">
                                                            <a href="{{url('profiles/'.$worker->id)}}" class="btn btn-sm text-green btn-card-option">{{trans('main.View')}}</a>
                                                            <a href="{{url('profiles/'.$worker->id)}}" class="btn text-red btn-sm btn-card-option">{{trans('main.Unlock')}}</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    {{--@endif--}}
                                    @endif
                                        @endforeach
                                    @else 
                                    <span class="m-5 empty-to-show box">{{trans('main.No Candidates To Show')}}</span>   
                                    @endif 
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade show" id="jobs" role="tabpanel" aria-labelledby="saved-tab">
                            <div class="row">
                                
                                <div class="col-lg-12">
                                     @if(count(Helper::visitorJobs()) > 0)
                                        @foreach (Helper::visitorJobs() as $job)
                                            @if ($loop->index < 15)
                                                @if (count(Helper::userByID($job->employer_id)) > 0)
                                                    @foreach(Helper::userByID($job->employer_id) as $key => $employer)
                                                            <div class="job-box bg-white overflow-hidden border rounded mt-4 position-relative overflow-hidden">
                                                               
                                                                    
                                                                    <div class="lable text-center pt-2 pb-2 d-block not-saved-job-btn">
                                                                        <ul class="list-unstyled best text-white mb-0 text-uppercase">
                                                                            <li class="list-inline-item">
                                                                                <form action="" method="get" id="" class="w-100 liked-star click-star">
                                                                                    <button  onclick=""><i class="mdi mdi-star"></i></button>
                                                                                </form>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                    
                                                                        <div class="lable text-center pt-2 pb-2 d-block saved-job-btn">
                                                                            <ul class="list-unstyled best text-white mb-0 text-uppercase ">
                                                                                <li class="list-inline-item">
                                                                                    <form action="" method="get" id="" class="w-100 unliked-star click-unstar">
                                                                                        <button ><i class="mdi mdi-star"></i></button>
                                                                                        
                                                                                    </form> 
                                                                                </li>
                                                                            </ul>
                                                                        </div>
                                                                        
                                                                   
                                                               
                                                                <a href="{{ url('job-details/'.$job->id)}}">
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
                                                                                    <span class="apply-form-btn">
                                                                                        {!! Form::submit(trans('main.Apply Now'), ['class' => "btn btn-primary btn-sm", 'name' => 'create-apply']) !!}

                                                                                    </span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                    @endforeach
                                                @endif
                                            @endif
                                        @endforeach
                                    @else 
                                        <h6 class="text-center w-100 mt-3 empty-to-show box">{{trans('main.No Jobs Saved')}}</h6>
                                    @endif  
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif

    <!-- counter start -->
    <section class="section bg-counter position-relative d-none" style="background: url('{{ asset('assets/images/about.jpg')}}') top center;background-size: 100% 120%;">
        <div class="bg-overlay bg-overlay-gradient"></div>
        <div class="container">
            <div class="row" id="counter">
                <div class="col-md-3 col-6">
                    <div class="home-counter pt-4 pb-4">
                        <div class="float-left counter-icon mr-3">
                            <i class="mdi mdi-bank h1 text-white"></i>
                        </div>
                        <div class="counter-content overflow-hidden">
                            <h1 class="counter-value text-white mb-1" data-count="{{count(Helper::employers())}}">{{count(Helper::employers())}}</h1>
                            <p class="counter-name text-white text-uppercase mb-0">{{trans('main.Companies')}}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="home-counter pt-4 pb-4">
                        <div class="float-left counter-icon mr-3">
                            <i class="mdi mdi-file-document-box h1 text-white"></i>
                        </div>
                        <div class="counter-content overflow-hidden">
                            <h1 class="counter-value text-white mb-1" data-count="{{count(Helper::jobRequestsAll())}}">{{count(Helper::jobRequestsAll())}}</h1>
                            <p class="counter-name text-white text-uppercase mb-0">{{trans('main.Applications')}}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="home-counter pt-4 pb-4">
                        <div class="float-left counter-icon mr-3">
                            <i class="mdi mdi-calendar-multiple-check h1 text-white"></i>
                        </div>
                        <div class="counter-content overflow-hidden">
                            <h1 class="counter-value text-white mb-1" data-count="{{count(Helper::JobsNames())}}">{{count(Helper::JobsNames())}}</h1>
                            <p class="counter-name text-white text-uppercase mb-0">{{trans('main.Job Posted')}}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="home-counter pt-4 pb-4">
                        <div class="float-left counter-icon mr-3">
                            <i class="mdi mdi-account-multiple-plus h1 text-white"></i>
                        </div>
                        <div class="counter-content overflow-hidden">
                            <h1 class="counter-value text-white mb-1" data-count="{{count(Helper::users())}}">{{count(Helper::users())}}</h1>
                            <p class="counter-name text-white text-uppercase mb-0">{{trans('main.Member')}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- counter end -->
    <!-- testimonial start -->
    <section class="section d-none">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="section-title text-center mb-4 pb-2">
                        <h4 class="title title-line pb-5">{{trans('main.Home')}}Our Success Stories</h4>
                        <p class="text-muted para-desc mx-auto mb-1">{{trans('main.Home')}}Post a job to tell us about your project. We'll quickly match you with the right artisans.</p>
                    </div>
                </div>
            </div>
           
        </div>
        
    </section>
    <!-- testimonial end -->
    <!-- subscribe start -->
    <section class="section bg-light d-none">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-5">
                    <div class="float-left position-relative notification-icon mr-2">
                        <i class="mdi mdi-bell-outline text-primary"></i>
                        <span class="badge badge-pill badge-danger">1</span>
                    </div>
                    <h5 class="mt-2 mb-0">{{trans('main.Your Job Notification')}}</h5>
                </div>
                <div class="col-lg-8 col-md-7 mt-4 mt-sm-0">
                    <form>
                        <div class="form-group mb-0">
                            <div class="input-group mb-0">
                                <input name="email" id="email" type="email" class="form-control" placeholder="Your email :" required="" aria-describedby="newssubscribebtn">
                                <div class="input-group-append">
                                    <button class="btn btn-primary submitBnt" type="submit" id="newssubscribebtn">Subscribe</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
<!-- subscribe end -->
<!-- footer start -->
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
<!-- How it Work start -->
<section class="section bg-light">
    <div class="container">
        <div class="row justify-content-center ">
            <div class="col-12">
                <div class="section-title text-center mb-4 pb-2">
                    <h4 class="title title-line pb-5">{{trans('main.How It Work')}}</h4>
                    @if(auth()->check())
                        @if(auth()->user()->role == 2 || auth()->user()->role == 1 || auth()->user()->role == 3)
                            <p class="text-muted para-desc mx-auto mb-1">{{trans('main.Post a job to tell us about your project. We will quickly match you with the right artisans.')}}</p>
                        @endif
                    @endif
                </div>
            </div>
        </div>
      
            <div class="row pb-5">
                <div class="col-md-4 mt-4 pt-2">
                    <div class="how-it-work-box bg-light p-4 text-center rounded shadow">
                        <div class="how-it-work-img position-relative rounded-pill mb-3">
                            <img src="{{ asset('assets/images/how-it-work/img-1.png')}}" alt="" class="mx-auto d-block" height="50">
                        </div>
                        <div>
                            <h5>{{trans('main.Register an account')}}</h5>
                            <p class="text-muted">{{trans('main.All you need is email address to create an account and start building your Career Profile')}}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mt-4 pt-2">
                    <div class="how-it-work-box bg-light p-4 text-center rounded shadow">
                        <div class="how-it-work-img position-relative rounded-pill mb-3">
                            <img src="{{ asset('assets/images/how-it-work/img-2.png')}}" alt="" class="mx-auto d-block" height="50">
                        </div>
                        <div>
                            <h5>{{trans('main.Search your job')}}</h5>
                            <p class="text-muted">{{trans('main.Then just add a some informations about you, and start search your job')}}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mt-4 pt-2">
                    <div class="how-it-work-box bg-light p-4 text-center rounded shadow">
                        <div class="how-it-work-img position-relative rounded-pill mb-3">
                            <img src="{{ asset('assets/images/how-it-work/img-3.png')}}" alt="" class="mx-auto d-block" height="50">
                        </div>
                        <div>
                            <h5>{{trans('main.Apply for job')}}</h5>
                            <p class="text-muted">{{trans('main.After you apply on your job , we will be accepted to your dream job')}}</p>
                        </div>
                    </div>
                </div>
            </div>
       
    </div>
</section>
<!-- How it Work end -->

    @include('inc.home.foot')
    @include('inc.home.scripts')
    <script src="{{asset('assets/js/counter.int.js')}}"></script>
    @auth
    @if(app()->getLocale() == 'ar')
    <script>
    function favourite(id){
        $(id).unbind().bind('submit', function(e) {
          e.preventDefault();
        if($(id).hasClass('dislike')){
              $.ajax({
                  type: "POST",
                  url: "{{url('/profiles/'.auth()->user()->id)}}",
                  data: $(this).serialize()+"&_method=PUT&delete-fav=''",
                  success: (response)=>{
                      $(this).removeClass('dislike').addClass('like');
                      $('.toast').fadeIn().removeClass('hide').addClass('show');
                      $('.toast').find(".message").text('تم إلغاء حفظ الوظيفة');
                      $(this).find("i").removeClass('fav-saved');
                      setTimeout(function () {
                        $('.toast').fadeOut().removeClass('show').addClass('hide');
                    }, 5000);
                  }
              });
          }else{
          $.ajax({
              type: "POST",
              url: "{{url('/profiles')}}",
              data: $(this).serialize()+"&create-fav=''",
              success: (response)=>{
                $(this).removeClass('like').addClass('dislike');
                  $('.toast').fadeIn().removeClass('hide').addClass('show');
                  $('.toast').find(".message").text('تم حفظ الوظيفة');
                  $(this).find("i").addClass('fav-saved');
                  setTimeout(function () {
                    $('.toast').fadeOut().removeClass('show').addClass('hide');
                }, 5000);
              }
          });
        }
     });
    }  
    
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
                    // console.log($(this).closest('.overflow-hidden').clone().appendTo("#saved .row .col-lg-12"));
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
    // function deletefavourite(form){
    //     $(form).on('submit', function(e) {
    //       e.preventDefault();
    //       if(form.hasClass('like')){
    //           favourite()
    //       }else{
    //           $.ajax({
    //               type: "POST",
    //               url: "{{url('/profiles/'.auth()->user()->id)}}",
    //               data: $(this).serialize(),
    //               success: (response)=>{
    //                 //   $(id).removeClass('fade').removeClass('show').addClass('hide').css('display','none');
    //                 //   $('.modal-backdrop').remove();
    //                   $('.toast').fadeIn().removeClass('hide').addClass('show');
    //                   $('.toast').find(".message").text('Worker deleted from favourite !');
    //                   $(this).find("i").removeClass('fav-saved');
    //                   setTimeout(function () {
    //                     $('.toast').fadeOut().removeClass('show').addClass('hide');
    //                 }, 5000);
    //               }
    //           });
    //       }
    //  });
    // }
    </script>
    @else 
    <script>
    function favourite(id){
        $(id).unbind().bind('submit', function(e) {
          e.preventDefault();
        if($(id).hasClass('dislike')){
              $.ajax({
                  type: "POST",
                  url: "{{url('/profiles/'.auth()->user()->id)}}",
                  data: $(this).serialize()+"&_method=PUT&delete-fav=''",
                  success: (response)=>{
                      $(this).removeClass('dislike').addClass('like');
                      $('.toast').fadeIn().removeClass('hide').addClass('show');
                      $('.toast').find(".message").text('Worker deleted from favourite !');
                      $(this).find("i").removeClass('fav-saved');
                      setTimeout(function () {
                        $('.toast').fadeOut().removeClass('show').addClass('hide');
                    }, 5000);
                  }
              });
          }else{
          $.ajax({
              type: "POST",
              url: "{{url('/profiles')}}",
              data: $(this).serialize()+"&create-fav=''",
              success: (response)=>{
                $(this).removeClass('like').addClass('dislike');
                  $('.toast').fadeIn().removeClass('hide').addClass('show');
                  $('.toast').find(".message").text('Job added to favourite !');
                  $(this).find("i").addClass('fav-saved');
                  setTimeout(function () {
                    $('.toast').fadeOut().removeClass('show').addClass('hide');
                }, 5000);
              }
          });
        }
     });
    }  
    
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
                    // console.log($(this).closest('.overflow-hidden').clone().appendTo("#saved .row .col-lg-12"));
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
    // function deletefavourite(form){
    //     $(form).on('submit', function(e) {
    //       e.preventDefault();
    //       if(form.hasClass('like')){
    //           favourite()
    //       }else{
    //           $.ajax({
    //               type: "POST",
    //               url: "{{url('/profiles/'.auth()->user()->id)}}",
    //               data: $(this).serialize(),
    //               success: (response)=>{
    //                 //   $(id).removeClass('fade').removeClass('show').addClass('hide').css('display','none');
    //                 //   $('.modal-backdrop').remove();
    //                   $('.toast').fadeIn().removeClass('hide').addClass('show');
    //                   $('.toast').find(".message").text('Worker deleted from favourite !');
    //                   $(this).find("i").removeClass('fav-saved');
    //                   setTimeout(function () {
    //                     $('.toast').fadeOut().removeClass('show').addClass('hide');
    //                 }, 5000);
    //               }
    //           });
    //       }
    //  });
    // }
    </script>
    @endif
    
    @endauth

    </body>
</html>