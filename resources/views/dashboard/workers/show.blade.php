@include('inc.header')
    <link href="https://fonts.googleapis.com/css?family=Cairo:200,300,400,600,700,900&display=swap&subset=arabic,latin-ext" rel="stylesheet">

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}" type="text/css">

    <!--Material Icon -->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/materialdesignicons.min.css')}}" />

    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/fontawesome.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/style.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/custom.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('css/custom.css')}}" />
    <style>
        .candidate-profile {
            background: #fbfbfb;
            min-height: 100vh;
        }
    </style>

<div class="page has-sidebar-left  height-full company-crete">
    <header class="blue accent-3 relative">
        <div class="container-fluid text-white">
            <div class="row p-t-b-10 ">
                <div class="col">
                    <h4>
                        <i class="icon-database"></i>
                        Workers
                    </h4>
                </div>
            </div>
            <div class="row justify-content-between">
                <ul class="nav nav-material nav-material-white responsive-tab" id="v-pills-tab" role="tablist">
                    <li>
                        <a class="nav-link"  href="{{url('dashboard/workers')}}"><i class="icon icon-home2"></i>All Workers</a>
                    </li>
                    <li>
                        <a class="nav-link active"  href="{{url('dashboard/workers/create')}}" ><i class="icon icon-plus-circle"></i> Add New Workers</a>
                    </li>
                </ul>
            </div>
        </div>
    </header>
    <div class="container-fluid animatedParent animateOnce">
        <div class="animated fadeInUpShort">

            <section class="candidate-profile">
            
                <div class="container">
                    <div class="row big-row">
                        <div class="col-md-3 col-sm-12 pb-3 view-face">
                            <div class="user-avatar">
                                @if(!empty($worker->profile_image))
                                <img src="{{ asset('uploads/images/profile_images/'.$worker->profile_image ) }}" alt="" class="d-block mx-auto shadow rounded-pill mb-4 worker-avatar">
                                @else 
                                    <img src="{{ asset('uploads/images/profile_images/default.jpg') }}" alt="" class="d-block mx-auto shadow rounded-pill mb-4 worker-avatar">
                                @endif
                            </div>
                            <h5 class="mb-2 text-center worker-name">{{ $worker->name }}</h5>
                            <div class="nationality text-center">
                                @if (!empty($user->category_id))
                                    @foreach(Helper::userCats($user->category_id) as $key => $value)
                                    @if($loop->index < 4)
                                        <span class="category">
                                            {{ Helper::getCategoryName($value) }}
                                        </span>
                                    @endif
                                    @endforeach
                                @endif
                            </div>
                            <div class="country text-center">
                                
                                @if (!empty($worker->city))
                                    <span>
                                        {{ $worker->city }}
                                    </span>
                                @endif
                                @if (!empty($worker->country))
                                    <span>
                                        {{ Helper::getCountryByKey($worker->country) }}
                                    </span>
                                @endif
                            </div>

                            <div class="verified mt-4 text-center">
                            <h6 class="mb-2 text-center text-muted worker-name">{{ $worker->name }} Provided</h6>
                                <div>
                                    
                                    
                                    @if (empty($worker->gov_id))
                                        <i class="fas fa-times text-danger"></i>
                                        Government ID
                                    @else 
                                        @if ($worker->gov_id == 'verified')
                                            <i class="fal fa-badge-check"></i>
                                            Government ID
                                        @else 
                                            <i class="fas fa-times text-danger"></i>
                                            Government ID
                                            <a class="btn btn-success btn-sm" data-toggle="modal" data-target="#gov_id-modal">Sent</a> 
                                        @endif
                                    @endif
                                    
                                    
                                </div>		
                                <div>                       
                                					
                                @if(($worker->email_verified_at==NULL && $worker->email_verify_token==NULL) || ($worker->email_verified_at==NULL && $worker->email_verify_token!=NULL))			
                                    <i class="fas fa-times text-danger"></i>   
                                    Email Address  	
                                @else
                                    <i class="fal fa-badge-check"></i> 
                                    Email Address  	
                                @endif                   
                                </div>                   
                                <div>                        
                                						
                                @if($worker->IsPhoneVerified)	
                                    <i class="fal fa-badge-check"></i>                         
                                    Phone Number  						
                                    <a href="javascript:void(0)" class="btn btn-primary" style="padding: 0 16px;margin-bottom:4px ;background: green;border: 1px solid #green;">Verified</a>
                                @else 
                                    <i class="fas fa-times text-danger"></i>                     
                                    Phone Number  
                                @endif                    
                                </div>
                            </div>
                            

                            
                        </div>
                        <div class="col-md-9 col-sm-12">
                            <div class="container">
                                <div class="row justify-content-center row-top">
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
                                                <a class="nav-link rounded" id="portfolio-tab" data-toggle="pill" href="#portfolio" role="tab" aria-controls="portfolio" aria-selected="false">Portfolio</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="w-100">
                                        <div class="tab-content my-2" id="pills-tabContent">
                                            <div class="tab-pane fade show active" id="about" role="tabpanel" aria-labelledby="about-tab">
                                                <div class="row">
                                                    <div class="col-lg-12 px-0">
                                                        <div class="py-2 text-left">
                                                            <div class="row profile-top">
                                                                <div class="col-sm-6 view-profile-details">
                                                                    <div class="email">
                                                                        <i class="fal fa-envelope mr-1"></i>
                                                                        <label class="profile-label">Email:</label>
                                                                        <span>
                                                                            
                                                                            {{ $worker->email }}
                                                                        </span>
                                                                    </div>
                                                                    
                                                                        @if (!empty($worker->phone) || !empty($worker->phone_2))
                                                                            
                                                                            <div class="phone">
                                                                                <i class="fal fa-phone-alt"></i>
                                                                                <label class="profile-label">Phone:</label>
                                                                                @if (!empty($worker->phone))
                                                                                    <span>
                                                                                        0{{ $worker->phone }}
                                                                                    </span>
                                                                                @endif
                                                                                @if (!empty($worker->phone) && !empty($worker->phone_2))
                                                                                -
                                                                                @endif
                                                                                @if (!empty($worker->phone_2))
                                                                                    <span>
                                                                                        0{{ $worker->phone_2 }}
                                                                                    </span>
                                                                                @endif
                                                                            </div>
                                                                        @else 
                                                                            @if (auth()->user()->id == $worker->id)
                                                                                <a href="{{ url('profiles/'.auth()->user()->id) }}" class="btn back mt-2 btn-sm add-empty">Add Phone Numbers</a>
                                                                            @else
                                                                                <span class="empty-to-show w-75 ">No Phone To Show</span>
                                                                            @endif
                                                                        
                                                                        @endif
                                                                    
                                                                    
                                                                    <span class="salary">
                                                                        @foreach (Helper::salaryRange() as $key => $option)
                                                                            @if($worker->average_salary == $key)
                                                                                <i class="fal fa-wallet"></i>
                                                                                <label class="profile-label">Minimal Salary:</label>
                                                                                @if ($worker->salary_hide == 0)
                                                                                    {{ $option }}
                                                                                @else 
                                                                                    Confidential
                                                                                @endif
                                                                            @endif
                                                                        @endforeach
                                                                    </span>
                                                                
                                                                    @if (count($worker->socials) > 0)
                                                                        <div class="social">
                                                                                @foreach ($worker->socials as $social)
                                                                                    <ul class="list-unstyled social-icon social mb-0">
                                                                                        @if (!empty($social->facebook))
                                                                                        
                                                                                            <li class="list-inline-item"><a href="{{ $social->facebook }}" class="rounded"><i class="mdi mdi-facebook"></i></a></li>
                                                                                        @endif
                                                                                        @if (!empty($social->twitter))
                                                                                            <li class="list-inline-item"><a href="{{ $social->twitter }}" class="rounded"><i class="mdi mdi-twitter"></i></a></li>
                                                                                        @endif
                                                                                        {{--@if (!empty($social->google_plus))
                                                                                            <li class="list-inline-item"><a href="{{ $social->google_plus }}" class="rounded"><i class="mdi mdi-google-plus"></i></a></li>
                                                                                        @endif--}}
                                                                                        @if (!empty($social->linkedin))
                                                                                            <li class="list-inline-item"><a href="{{ $social->linkedin }}" class="rounded"><i class="mdi mdi-linkedin"></i></a></li>
                                                                                        @endif
                                                                                        @if (!empty($social->pinterest))
                                                                                            <li class="list-inline-item"><a href="{{ $social->pinterest }}" class="rounded"><i class="mdi mdi-pinterest"></i></a></li>
                                                                                        @endif
                                                                                        @if (!empty($social->instagram))
                                                                                            <li class="list-inline-item"><a href="{{ $social->instagram }}" class="rounded"><i class="mdi mdi-instagram"></i></a></li>
                                                                                        @endif
                                                                                    </ul>
                                                                                @endforeach
                                                                            
                                                                        </div>
                                                                    @else 
                                                                        @if (auth()->user()->id == $worker->id)
                                                                            <a href="{{ url('profiles/'.auth()->user()->id.'/edit/social') }}" class="btn back mt-2 btn-sm mb-3 add-empty">Add Social Media</a>
                                                                        @else
                                                                            <span class="empty-to-show w-75 ">No Contacts To Show</span>
                                                                        @endif
                                                                    @endif
                                                                    
                                                                </div>
                                                                <div class="col-sm-6  view-profile-contact">
                                                                    <div class="">
                                                                        <div class="birth">
                                                                            @if (!empty($worker->birth))
                                                                                @if (Helper::getAge($worker->birth) > 15)
                                                                                    <i class="fal fa-phone-alt"></i>
                                                                                    <label class="profile-label">Age:</label>
                                                                                    <span>
                                                                                        {{ Helper::getAge($worker->birth) }}
                                                                                    </span>
                                                                                @endif
                                                                            @endif
                                                                            
                                                                            @foreach (Helper::married() as $key => $option)
                                                                                @if($worker->married == $key)
                                                                                <i class="fal fa-phone-alt"></i>
                                                                                    <label class="profile-label">Married:</label>
                                                                                    <span>
                                                                                        {{ $option }}
                                                                                    </span>
                                                                                @endif
                                                                            @endforeach
                
                                                                            @foreach (Helper::gender() as $key => $option)
                                                                                @if($worker->gender == $key)
                                                                                <i class="fas fa-venus-mars"></i>
                                                                                
                                                                                <label class="profile-label">Gender:</label>
                                                                                    <span>
                                                                                        {{ $option }}
                                                                                    @endif
                                                                                </span>
                                                                            @endforeach
                                                                        </div>
                                                                        <div>
                                                                            @if (!empty($worker->nationality))
                                                                                <i class="fal fa-flag-alt"></i>
                                                                                <label class="profile-label">Nationality:</label>
                                                                                <span>
                                                                                    {{ Helper::nationalityByKey($worker->nationality) }}
                                                                                </span>
                                                                            @endif
                                                                            
                                                                        </div>
                                                                        <div>
                                                                            @if (!empty($worker->address))
                                                                                <i class="fal fa-map-marker-alt"></i>
                                                                                <label class="profile-label">Address:</label>
                                                                                <span>
                                                                                    {{ $worker->address }}
                                                                                </span>
                                                                            @endif
                                                                        </div>
                                                                        <div class="email">
                                                                            @if (!empty($worker->cv))
                                                                            <i class="fal fa-address-card"></i>
                                                                            <label class="profile-label">Cv:</label>
                                                                            <span>
                                                                            
                                                                                <a href="{{url('download/'.$worker->id )}}" class="download">Download</a>
                                                                                </span>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                        <div class="col-md-6 col-sm-12 text-left view-profile-details">
                                                            @if (count($worker->skills) > 0)
                                                            <h5 class="text-dark">Skills</h5>
                                                                @foreach ($worker->skills as $skill)
                                                                    @foreach (Helper::getSkills($skill->name) as $s)
                                                                    <span class="skill">{{ $s }}</span>
                                                                    @endforeach
                                                                @endforeach
                                                            @else 
                                                                @if(auth()->user()->id == $worker->id)
                                                                
                                                                    <a href="{{ url('profiles/'.auth()->user()->id.'/edit/skills') }}" class=" box add-empty my-4">
                                                                        @if (Helper::checkGender($worker->gender) == 'Male')
                                                                            <img src="{{ asset('assets/images/creative/skill-m.png')}}" class="creative-profile">
                                                                        @else 
                                                                            <img src="{{ asset('assets/images/creative/skill-f.png')}}" class="creative-profile">
                                                                        @endif
                                                                        <br>
                                                                        Add Skills
                                                                    </a>
                                                                @else
                                                                    <span class="empty-to-show box my-4">No Skills To Show</span>
                                                                @endif
                                                            @endif
                                                        </div>

                                                        <div class="col-md-6 col-sm-12 text-left view-profile-contact lang">
                                                            <h6 class="text-dark">Languages</h6>
                                                            @if (count($worker->languages) > 0)
                                                                <div class="progress-box">
                                                                    @foreach($worker->languages as $language)
                                                                    <h6 class="title text-muted">{{Helper::languageByKey($language->language)}}</h6>
                                                                    <div class="progress">
                                                                        @if($language->proficiency == 0)
                                                                            <div class="progress-bar progress-bar-striped position-relative bg-primary" style="width:20%;">
                                                                                <div class="progress-value d-block h6 w-100">Beginner</div>
                                                                            </div>
                                                                        @elseif($language->proficiency == 1)
                                                                            <div class="progress-bar progress-bar-striped position-relative bg-primary" style="width:40%;">
                                                                                <div class="progress-value d-block h6 w-100">Intermediate</div>
                                                                            </div>
                                                                        @elseif($language->proficiency == 2)
                                                                            <div class="progress-bar progress-bar-striped position-relative bg-primary" style="width:60%;">
                                                                                <div class="progress-value d-block h6 w-100">Advanced</div>
                                                                            </div>
                                                                        @elseif($language->proficiency == 3)
                                                                            <div class="progress-bar progress-bar-striped position-relative bg-primary" style="width:80%;">
                                                                                <div class="progress-value d-block h6 w-100">Fluent</div>
                                                                            </div>
                                                                        @elseif($language->proficiency == 4)
                                                                            <div class="progress-bar progress-bar-striped position-relative bg-primary" style="width:100%;">
                                                                                <div class="progress-value d-block h6 w-100">Native</div>
                                                                            </div>
                                                                        @endif
                                                                    </div>
                                                                    @endforeach
                                                                </div><!--end process box-->
                                                            @else    
                                                                @if (auth()->user()->id == $worker->id)
                                                                    <a href="{{ url('profiles/'.auth()->user()->id.'/edit/languages') }}" class="box add-empty my-4">
                                                                        @if (Helper::checkGender($worker->gender) == 'Male')
                                                                            <img src="{{ asset('assets/images/creative/lang.png')}}" class="creative-profile">
                                                                        @else 
                                                                            <img src="{{ asset('assets/images/creative/lang.png')}}" class="creative-profile">
                                                                        @endif
                                                                        <br>
                                                                        Add Language</a>
                                                                @else
                                                                    <span class="empty-to-show box my-4">No Languages To Show</span>
                                                                @endif      
                                                            @endif 
                                                        </div>
                                                </div>
                                                <div class="row view-about mt-2 d-block">
                                                    @if(!empty($worker->about))
                                                        @if(auth()->user()->id == $worker->id)
                                                            <h5 class="text-dark d-block">About Me</h5>
                                                        @else
                                                            <h5 class="text-dark d-block">About {{ $worker->name }}</h5>
                                                        @endif
                                                        <p class="text-muted text-justify d-block">{{ $worker->about }}</p>
                                                    @else 
                                                        @if (auth()->user()->id == $worker->id)
                                                            <a href="{{ url('profiles/'.auth()->user()->id.'#about') }}" class="add-empty box my-3 w-100">
                                                                @if (Helper::checkGender($worker->gender) == 'Male')
                                                                    <img src="{{ asset('assets/images/creative/talk-m.png')}}" class="creative-profile">
                                                                    @else 
                                                                    <img src="{{ asset('assets/images/creative/talk-f.png')}}" class="creative-profile">
                                                                @endif
                                                                <br>
                                                                Talk About Your Self</a>
                                                        @else
                                                            <span class="empty-to-show box my-3 w-100">No Discription To Show</span>
                                                        @endif
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="tab-pane fade show " id="education" role="tabpanel" aria-labelledby="education-tab">
                                                <div class="row education mx-0 mt-3">
                                                    <div class="col-sm-12 px-0 ">
                                                        @if (count($worker->educations) > 0)
                                                            @foreach ($worker->educations as $education)
                                                                <div class="text-left text-muted view-edu">
                                                                    <span class="bg-white text-primary">
                                                                        @if($education->level == 0)
                                                                            <i class="mdi mdi-36px mdi-school"></i>
                                                                        @elseif($education->level == 1)
                                                                            <i class="mdi mdi-36px mdi-library"></i>
                                                                        @else
                                                                            <i class="mdi mdi-36px mdi-briefcase-check"></i>
                                                                        @endif
                                                                    </span>
                                                                    <span class="mb-0 degree d-inline-block text-dark"><h6>{{ $education->degree }}</h6></span>
                                                                    
                                                                    <p class="f-17 text-muted school"><a class="f-17 school text-muted ref" href="{{$education->ref}}">{{ $education->school }}</a></p>
                                                                    <p class="f-14">{{ Helper::getMonthNameYear($education->from) }} - {{ Helper::getMonthNameYear($education->to) }}</p>
                                                                    <p class="brief">{{ Str::limit( $education->brief , 90)}}</p>
                                                                </div>
                                                            @endforeach
                                                        @else 
                                                            @if (auth()->user()->id == $worker->id)
                                                                <a href="{{ url('profiles/'.auth()->user()->id.'/edit/education') }}" class="box add-empty my-4">
                                                                    @if (Helper::checkGender($worker->gender) == 'Male')
                                                                        <img src="{{ asset('assets/images/creative/edu-m.png')}}" class="creative-profile">
                                                                    @else 
                                                                        <img src="{{ asset('assets/images/creative/edu-f.png')}}" class="creative-profile">
                                                                    @endif
                                                                    <br>
                                                                    Add Education</a>
                                                            @else
                                                                <div class=" view-edu">
                                                                    <span class="empty-to-show box my-4">No Education To Show</span>
                                                                </div>
                                                            @endif
                                                        @endif

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade show" id="experience" role="tabpanel" aria-labelledby="experience-tab">
                                                <div class="row education mx-0 mt-3">
                                                    <div class="col-sm-12 px-0 ">
                                                        @if (count($worker->experiences) > 0)
                                                            @foreach ($worker->experiences as $experience)
                                                                <div class="text-left text-muted view-edu">
                                                                    <span class="mb-0 degree text-dark"><h6 class="mb-0">{{ $experience->job_title }} at <a class="text-muted ref" href="{{$experience->ref}}">{{ $experience->company_name }}</a></h6></span>
                                                                    
                                                                    <p class="date">{{ Helper::getMonthNameYear($experience->from) }} - {{ Helper::getMonthNameYear($experience->to) }}</p>
                                                                    
                                                                </div>
                                                            @endforeach
                                                        @else 
                                                            @if (auth()->user()->id == $worker->id)
                                                                <a href="{{ url('profiles/'.auth()->user()->id.'/edit/education') }}" class="box add-empty my-4">
                                                                    @if (Helper::checkGender($worker->gender) == 'Male')
                                                                        <img src="{{ asset('assets/images/creative/edu-m.png')}}" class="creative-profile">
                                                                    @else 
                                                                        <img src="{{ asset('assets/images/creative/edu-f.png')}}" class="creative-profile">
                                                                    @endif
                                                                    <br>
                                                                    Add Experience</a>
                                                            @else
                                                                <div class=" view-edu">
                                                                    <span class="empty-to-show box my-4">No Experiences To Show</span>
                                                                </div>
                                                            @endif
                                                        @endif

                                                    </div>
                                                </div>
                                            
                                            </div>
                                            <div class="tab-pane fade show" id="portfolio" role="tabpanel" aria-labelledby="portfolio-tab">
                                                <div class="row view-gallery gallery">
                                                    <div class="col-lg-12">
                                                        @if (count(Helper::galleryByUser($worker->id)) > 0)
                                                            <div class="gallery pt-2">
                                                                @foreach(Helper::galleryByUser($worker->id ) as $image)
                                                                    <div class="image-box">
                                                                        <img src="{{ asset('uploads/images/gallery_images/'.$image->gallery_image) }}" alt="" class="img-fluid gallery_image" id ="preview_image" data-toggle="modal" data-target="#gallery-{{$image->id}}">
                                                                            @if (auth()->user()->id == $worker->id)
                                                                                <span class="delete-image" aria-hidden="true" data-toggle="modal" data-target="#gallery-{{ $image->id }}-delete">&times;</span>
                                                                            @endif
                                                                        </div>
                                                                    <!-- View Modal -->
                                                                    <div class="modal modal-view fade" id="gallery-{{$image->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                        <div class="modal-dialog" role="document">
                                                                        <div class="modal-content">
                                                                            <div class="modal-body">
                                                                                <img src="{{ asset('uploads/images/gallery_images/'.$image->gallery_image) }}" alt="" class="img-fluid" id ="preview_image" data-toggle="modal" data-target="#gallery-{{$image->id}}">
                                                                            </div>
                                                                        </div>
                                                                        </div>
                                                                    </div>
                                                                    <!-- Delete Modal -->
                                                                    <div class="modal fade" id="gallery-{{ $image->id }}-delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                        <div class="modal-dialog" role="document">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title" id="exampleModalLabel">Delete Image</h5>
                                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                    <span aria-hidden="true">&times;</span>
                                                                                </button>
                                                                            </div>
                                                                            {!! Form::open(['action'=> ['ProfileController@update', $worker->id], 'method'=>'POST', 'enctype' =>'multipart/form-data', 'class' => 'w-100'])!!}
                                                                                <div class="modal-body">
                                                                                    Are You Sure To Delete The Photo?
                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                                    {!! Form::submit('Delete', ['class' => "btn btn-primary", 'name' => 'delete-gallery-image']) !!}
                                                                                </div>
                                                                            {!! Form::text('image_id', $image->id, ['hidden']) !!}
                                                                            {!! Form::hidden('_method', 'PUT') !!}
                                                                            {!! Form::close() !!}
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                @endforeach
                                                                <div class="clearfix"></div>
                                                            </div>
                                                        @else
                                                            <div class=" mt-3 view-gallery">
                                                                <span class="empty-to-show box my-4">No Portfolio To Show</span>
                                                            </div>
                                                        @endif
                                                        @if (auth()->user()->id == $worker->id)
                                                            {!! Form::open(['action'=> ['ProfileController@store', $worker->id], 'method'=>'POST', 'enctype' =>'multipart/form-data' ])!!}
                                                            
                                                                <div class="row">
                                                                    <div class="form-group app-label mt-2 w-100">
                                                                        {!! Form::file('gallery_image[]', [ 'hidden', 'id' => 'gallery_image', 'multiple', 'required'])!!}
                                                                        <label  class="empty-to-show box mx-4" for="gallery_image">
                                                                            Upload Photos
                                                                        </label>
                                                                        <div class="previewer px-0"></div>
                                                                        
                                                                    </div>
                                                                </div>
                                                                
                                                                <div class="row">
                                                                    <div class="col-lg-12 mt-2">
                                                                        {!! Form::submit('Add', ['class' => "btn btn-primary mt-2 btn-sm", 'name' => 'create-gallery']) !!}
                                                                    </div>
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
                
            </section>
        </div>


@include('inc.foot')
