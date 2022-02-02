@include('inc.home.head')

<section class="p-150 candidate-profile">
    <div class="container">
        <div class="row big-row">
            <div class="col-md-3 col-sm-12">
                
                <div class="avatar">
                    @if(!empty($user->profile_image))
                    <img src="{{ asset('uploads/images/profile_images/'.$user->profile_image ) }}" alt="" class="d-block mx-auto shadow rounded-pill mb-4 worker-avatar">
                    @else 
                        <img src="{{ asset('uploads/images/profile_images/default.jpg') }}" alt="" class="d-block mx-auto shadow rounded-pill mb-4 worker-avatar">
                    @endif
                </div>
                
                    
               
                <h5 class="mb-2 text-center worker-name">{{ Helper::hashString($user->name) }}</h5>
                @if (Helper::unlockCheck($user->id))
                    <button class="btn btn-primary btn-sm mb-2 ">Unblocked</button>
                @else 
                    {!! Form::open(['action'=> 'ProfileController@store', 'method'=>'POST', 'enctype' =>'multipart/form-data', 'class' => 'w-100'])!!}
                    {!! Form::submit('Unlock', ['class' => "btn btn-primary-outline btn-sm  mb-2", 'name' => 'create-unlock']) !!}
                    {!! Form::text('worker_id', $user->id, ['hidden'])!!}
                    {!! Form::close() !!}
                @endif

                <div class="nationality">
                    <span>
                        {{ Helper::nationalityByKey($user->nationality) }}
                    </span>
                    <span>
                        {{ $user->category->name }}
                    </span>
                </div>
                
                <div class="email">
                    <span>
                        <i class="fal fa-envelope mr-1"></i>
                            Unblock User To See Email
                    </span>
                </div>
                <div class="phone">
                    <i class="fal fa-phone-alt"></i>
                    <span>
                        Unblock User To See Phone
                    </span>
                </div>
                <div class="country">
                    @if (!empty($user->country))
                        <div>
                            <i class="fal fa-globe-asia mr-1"></i>
                            {{ Helper::getCountryByKey($user->country) }}
                        </div>
                    @endif
                    @if (!empty($user->address))
                        <span>
                            <i class="fal fa-map-marker-alt mr-1"></i>
                            {{ $user->address }}
                        </span>
                    @endif
                </div>
                <div class="birth">
                    <span>
                        {{ Helper::getAge($user->birth) }}
                    </span>
                    <span>
                        @foreach (Helper::married() as $key => $option)
                            @if($user->married == $key)
                                {{ $option }}
                            @endif
                        @endforeach
                    </span>
                    
                    <span>
                        @foreach (Helper::gender() as $key => $option)
                            @if($user->gender == $key)
                                {{ $option }}
                            @endif
                        @endforeach
                    </span>
                </div>
                <span class="salary">
                    @foreach (Helper::salaryRange() as $key => $option)
                        @if($user->average_salary == $key)
                            {{ $option }}
                        @endif
                    @endforeach
                </span>

                <div class="contacts">
                    Contacts
                </div>

                <div class="social p-2">
                    Unblock User To See Phone
                </div>
                

                
            </div>
            <div class="col-md-9 col-sm-12">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-9 text-center mt-4 pt-2">
                            <ul class="nav nav-pills nav nav-pills bg-white rounded nav-justified flex-column flex-sm-row" id="pills-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link rounded active" id="about-tab" data-toggle="pill" href="#about" role="tab" aria-controls="about" aria-selected="true">About</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link rounded" id="education-tab" data-toggle="pill" href="#education" role="tab" aria-controls="education" aria-selected="false">Education</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link rounded" id="experience-tab" data-toggle="pill" href="#experience" role="tab" aria-controls="experience" aria-selected="false">Experience</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link rounded" id="languages-tab" data-toggle="pill" href="#languages" role="tab" aria-controls="languages" aria-selected="false">Languages</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="row">
                        <div class="w-100">
                            <div class="tab-content mt-2" id="pills-tabContent">
                                <div class="tab-pane fade show active" id="about" role="tabpanel" aria-labelledby="about-tab">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="border-bottom p-2 text-left">
                                                @if(auth()->user()->id == $user->id)
                                                    <h5 class="text-dark">About Me</h5>
                                                @else
                                                    <h5 class="text-dark">About {{ $user->name }}</h5>
                                                @endif
                                            <p class="text-muted text-justify">{{ $user->about }}</p>
                                            </div>
                                            <div class="p-2 text-left">
                                                @if (!empty($user->skills))
                                                <h5 class="text-dark">Skills</h5>
                                                    @foreach ($user->skills as $skill)
                                                        @foreach (Helper::getSkills($skill->name) as $s)
                                                        <span class="skill">{{ $s }}</span>
                                                        @endforeach
                                                    @endforeach
                                                @endif
                                            </div>
                                            
                                
                                            {{--  <div class="row">
                                                <div class="col-lg-12 mt-1">
                                                    <div class="border-bottom p-2 text-left">
                                                        <div class="job-detail-desc">
                                                            <h4 class="text-dark">Overview :</h4>
                                                            <p class="text-muted text-justify">{{ $user->overview }}</p>
                                
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>--}}
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade show " id="education" role="tabpanel" aria-labelledby="education-tab">
                                    <div class="row education">
                                        <div class="col-sm-12">
                                            @if (!empty($user->educations))
                                                @foreach ($user->educations as $education)
                                                    <div class="border-bottom text-left text-muted pb-3">
                                                        <span class="bg-white text-primary">
                                                            @if($education->level == 0)
                                                                <i class="mdi mdi-36px mdi-school"></i>
                                                            @elseif($education->level == 1)
                                                                <i class="mdi mdi-36px mdi-library"></i>
                                                            @else
                                                                <i class="mdi mdi-36px mdi-briefcase-check"></i>
                                                            @endif
                                                        </span>
                                                        <span class="mb-0 degree d-inline-block"><h6>{{ $education->degree }}</h6></span>
                                                        <p class="f-17 text-muted">{{ $education->school }}</p>
                                                        <p class="f-14">{{ Helper::getMonthNameYear($education->from) }} - {{ Helper::getMonthNameYear($education->to) }}</p>
                                                        <p class="mb-2 brief">{{ Str::limit( $education->brief , 90)}}</p>
                                                    </div>
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade show" id="experience" role="tabpanel" aria-labelledby="experience-tab">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            @if (!empty($user->experiences))
                                                <div class="row">
                                                    @foreach ($user->experiences as $experience)
                                                        <div class="col-md-6">
                                                            <div class="border rounded job-list-box p-2 text-left mb-3">
                                                                <div class="row">
                                                                    <div class="col-lg-3 pr-0">
                                                                        <div class="company-brand-logo text-center mb-4">
                                                                            @if(empty($experience->company_logo))
                                                                                <img src="{{asset('uploads/images/profile_images/default_company.jpg')}}" alt="" class="img-fluid mx-auto d-block">
                                                                            @else 
                                                                                <img src="{{asset('uploads/images/profile_images/'. $experience->company_logo)}}" alt="" class="img-fluid mx-auto d-block">
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                
                                                                    <div class="col-lg-9">
                                                                        <div class="job-list-desc candidates-profile-exp-desc">
                                                                            <h6 class="f-19 text-dark mb-0">{{$experience->company_name}}</h6>
                                                                            <p class="text-muted mb-0 f-16">{{$experience->job_title}}</p>
                                                                            <p class="text-muted mb-0 f-16">Jan 2016 - Dec 2017</p>
                                                                            <p class="text-muted mb-0 f-16">Salary : SAR 1050</p>
                                                                            <p class="text-muted mb-0 f-16"><i class="mdi mdi-bank mr-2"></i>{{$experience->company_website}}</p>
                                                                            <p class="text-muted mb-0 f-16"><i class="mdi mdi-map-marker mr-2"></i>{{$experience->company_address}}</p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade show" id="languages" role="tabpanel" aria-labelledby="languages-tab">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            @if (!empty($user->languages))
                                                <div class="row">
                                                    <div class="col-md-6 pt-2 offset-md-3 text-left mt-5">
                                                        <div class="progress-box">
                                                            @foreach($user->languages as $language)
                                                            <h6 class="title text-muted">{{Helper::languageByKey($language->language)}}</h6>
                                                            <div class="progress">
                                                                @if($language->proficiency == 0)
                                                                    <div class="progress-bar progress-bar-striped position-relative bg-primary" style="width:20%;">
                                                                        <div class="progress-value d-block text-muted h6">20%</div>
                                                                    </div>
                                                                @elseif($language->proficiency == 1)
                                                                    <div class="progress-bar progress-bar-striped position-relative bg-primary" style="width:40%;">
                                                                        <div class="progress-value d-block text-muted h6">40%</div>
                                                                    </div>
                                                                @elseif($language->proficiency == 2)
                                                                    <div class="progress-bar progress-bar-striped position-relative bg-primary" style="width:60%;">
                                                                        <div class="progress-value d-block text-muted h6">60%</div>
                                                                    </div>
                                                                @elseif($language->proficiency == 3)
                                                                    <div class="progress-bar progress-bar-striped position-relative bg-primary" style="width:80%;">
                                                                        <div class="progress-value d-block text-muted h6">80%</div>
                                                                    </div>
                                                                @elseif($language->proficiency == 4)
                                                                    <div class="progress-bar progress-bar-striped position-relative bg-primary" style="width:100%;">
                                                                        <div class="progress-value d-block text-muted h6">100%</div>
                                                                    </div>
                                                                @endif
                                                            </div>
                                                            @endforeach
                                                        </div><!--end process box-->
                                                    </div>
                                                </div> 
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
</section>
@include('inc.home.foot')