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
        .view-face .avatar {
            width: 51%;
            border-radius: 0;
            margin: auto;
            display: block;
            max-width: 50%;
            height: auto;
        }
        .candidate-profile .worker-avatar {
            width: 105px;
            height: 105px;
            margin-top: 30px;
            border-radius: 4px!important;
            display: block!important;
            position: relative;
        }
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
                            Companies
                        </h4>
                    </div>
                </div>
                <div class="row justify-content-between">
                    <ul class="nav nav-material nav-material-white responsive-tab" id="v-pills-tab" role="tablist">
                        <li>
                            <a class="nav-link"  href="{{url('dashboard/companies')}}"><i class="icon icon-home2"></i>All Companies</a>
                        </li>
                        <li>
                            <a class="nav-link active"  href="{{url('dashboard/companies/create')}}" ><i class="icon icon-plus-circle"></i> Add New Company</a>
                        </li>
                    </ul>
                </div>
            </div>
        </header>
    <div class="container-fluid animatedParent animateOnce">
        <div class="animated fadeInUpShort">
            <section class="p-150 candidate-profile employers-profile">
                <div class="container">
                    <div class="row big-row">
                        <div class="col-md-3 col-sm-12 pb-4 text-center view-face">
                            <div class="avatar">
                                @if(!empty($company->profile_image))
                                <img src="{{ asset('uploads/images/profile_images/'.$company->profile_image ) }}" alt="" class="d-block mx-auto shadow rounded-pill mb-4 worker-avatar">
                                @else 
                                    <img src="{{ asset('uploads/images/profile_images/default_company.jpg') }}" alt="" class="d-block mx-auto shadow rounded-pill mb-4 worker-avatar">
                                @endif
                            </div>
                            @if (!empty($company->company_name))
                                <h5 class="mb-2 text-center worker-name">{{ ucwords($company->company_name) }}</h5>
                            @else 
                                <h5 class="mb-2 text-center worker-name">{{ ucwords($company->name) }}</h5>     
                            @endif
                            
                            <div class="nationality">
                                @if (auth()->user()->role == 2)
                                <div>
                                    @if (!empty($company->website ))
                                        {{ $company->website }}
                                    @else    
                                        @if (auth()->user()->id == $company->id)
                                            <a href="{{ url('profiles/'.auth()->user()->id.'/edit') }}" class="btn back mt-2 btn-sm mb-3 add-empty">Add Website</a>
                                        @else
                                            <span class="empty-to-show w-75 ">No Website</span>
                                        @endif
                                    @endif
                                </div>
                                
                                <div>
                                    @if (!empty($company->experience))
                                        {{ $company->experience }} Years Of Experience
                                    @else    
                                        @if (auth()->user()->id == $company->id)
                                            <a href="{{ url('profiles/'.auth()->user()->id.'/edit') }}" class="btn back mt-2 btn-sm mb-3 add-empty">Add Experience</a>
                                        @else
                                            <span class="empty-to-show w-75 ">No Experience</span>
                                        @endif    
                                    @endif
                                    
                                </div>
                                @endif
                            </div>
                            {{--<div class="email">
                                <span>
                                    <i class="fal fa-envelope mr-1"></i>
                                    {{ $company->email }}
                                </span>
                            </div>
                            @if (!empty($company->phone)  || !empty($company->phone_2))
                            <div class="phone">
                                <i class="fal fa-phone-alt"></i>
                                <span>
                                    @if (!empty($company->phone))
                                        0{{ $company->phone }}
                                    @endif
                                </span>
                                <span>
                                    -
                                    @if (!empty($company->phone_2))
                                        0{{ $company->phone_2 }}
                                    @endif
                                </span>
                            </div>
                            @else    
                                @if (auth()->user()->id == $company->id)
                                    <a href="{{ url('profiles/'.auth()->user()->id.'/edit') }}" class="btn back mt-2 btn-sm mb-3 add-empty">Add Phones</a>
                                @else
                                    <span class="empty-to-show w-75 ">No Phones</span>
                                @endif 
                            @endif--}}
            
                            <div class="country">
                                @if (!empty($company->country))
                                    <span>
                                        <i class="fal fa-globe mr-1"></i>
                                        {{ Helper::getCountryByKey($company->country) }}
                                    </span>
                                @else    
                                    @if (auth()->user()->id == $company->id)
                                        <a href="{{ url('profiles/'.auth()->user()->id.'/edit') }}" class="btn back mt-2 btn-sm mb-3 add-empty">Add Country</a>
                                    @else
                                        <span class="empty-to-show w-75 ">No Country</span>
                                    @endif     
                                @endif
            
                                @if (!empty($company->address))
                                    <div>
                                        <span>
                                            <i class="fal fa-map-marker-alt mr-1"></i>
                                            {{ $company->address }}
                                        </span>
                                    </div>
                                    
                                @else    
                                    @if (auth()->user()->id == $company->id)
                                        <a href="{{ url('profiles/'.auth()->user()->id.'/edit') }}" class="btn back mt-2 btn-sm mb-3 add-empty">Add Address</a>
                                    @else
                                        <span class="empty-to-show w-75 ">No Address</span>
                                    @endif     
                                @endif
                            </div>
                            <div class="birth">
                                @if (auth()->user()->role == 2)
                                    @if (!empty($company->employers))
                                        <span>
                                            {{ $company->employers }} Employers
                                        </span>
                                    @else    
                                        @if (auth()->user()->id == $company->id)
                                            <a href="{{ url('profiles/'.auth()->user()->id.'/edit') }}" class="btn back mt-2 btn-sm mb-3 add-empty">Add Company Size</a>
                                        @else
                                            <span class="empty-to-show w-75 ">No Company Size</span>
                                        @endif     
                                    @endif
                                @endif
                            </div>
            
                            
                            {{--<div class="social">
                                @if (count($company->socials) > 0)
                                <div class="contacts">
                                    Contacts
                                </div>
                
                                    @foreach ($company->socials as $social)
                                        <ul class="list-unstyled social-icon social mb-0">
                                            @if (!empty($social->facebook))
                                            
                                                <li class="list-inline-item"><a href="{{ $social->facebook }}" class="rounded"><i class="mdi mdi-facebook"></i></a></li>
                                            @endif
                                            @if (!empty($social->twitter))
                                                <li class="list-inline-item"><a href="{{ $social->twitter }}" class="rounded"><i class="mdi mdi-twitter"></i></a></li>
                                            @endif
                                            @if (!empty($social->google_plus))
                                                <li class="list-inline-item"><a href="{{ $social->google_plus }}" class="rounded"><i class="mdi mdi-google-plus"></i></a></li>
                                            @endif
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
                                @else    
                                    @if (auth()->user()->id == $company->id)
                                        <a href="{{ url('profiles/'.auth()->user()->id.'/edit') }}" class="btn back mt-2 btn-sm mb-3 add-empty">Add Social Media</a>
                                    @else
                                        <span class="empty-to-show w-75 ">No Contacts</span>
                                    @endif     
                                @endif
                            </div>--}}
            
                            
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
                                                <a class="nav-link rounded" id="education-tab" data-toggle="pill" href="#education" role="tab" aria-controls="education" aria-selected="false">services</a>
                                            </li>
                                            @if ($company->role == 2)
                                            <li class="nav-item">
                                                <a class="nav-link rounded" id="branches-tab" data-toggle="pill" href="#branches" role="tab" aria-controls="branches" aria-selected="false">Branches</a>
                                            </li>
                                            @endif
                                            
                                        </ul>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="w-100">
                                        <div class="tab-content mt-2" id="pills-tabContent">
                                            <div class="tab-pane fade show active" id="about" role="tabpanel" aria-labelledby="about-tab">
                                                <div class="row">
                                                    <div class="col-lg-12 p-0">
                                                        @if (auth()->user()->role == 2)
                                                        <div class="border-bottom p-2 text-left view-about">
                                                            
                                                                @if(!empty($company->overview ))
                                                                    @if(auth()->user()->id == $company->id)
                                                                        <h5 class="text-dark">About Us</h5>
                                                                    @else
                                                                        @if (!empty($company->company_name))
                                                                            <h5 class="text-dark">About {{ ucwords($company->company_name) }}</h5>
                                                                        @else 
                                                                            <h5 class="text-dark">About {{ ucwords($company->name) }}</h5>  
                                                                        @endif
                                                                    @endif
                                                                    <p class="text-muted text-justify">{{ $company->overview }}</p>
                                                                @else    
                                                                    
                                                                    @if (auth()->user()->id == $company->id)
                                                                        <a href="{{ url('profiles/'.auth()->user()->id.'/edit') }}" class="btn back mt-2 btn-sm mb-3 add-empty box my-3">
                                                                            <img src="{{ asset('assets/images/creative/com-desc.png')}}" class="creative-profile">
                                                                            <br>
            
                                                                            Add Company Description
                                                                        
                                                                        </a>
                                                                    @else
                                                                        <span class="empty-to-show w-75 box my-3">No Description</span>
                                                                    @endif 
                                                                
                                                                @endif  
                                                            </div> 
                                                            @endif  
                                                            
                                                        
                                                        <div class="map mt-3 pb-3 view-about">
                                                            <iframe src="https://www.google.com/maps/embed?pb=!1m10!1m8!1m3!1d6030.418742494061!2d-111.34563870463673!3d26.01036670629853!3m2!1i1024!2i768!4f13.1!5e0!3m2!1ses-419!2smx!4v1471908546569" class="rounded" style="border: 0" allowfullscreen=""></iframe>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade show " id="education" role="tabpanel" aria-labelledby="education-tab">
                                                <div class="row education">
                                                    <div class="col-sm-12 p-0">
                                                    @if (auth()->user()->role == 2)
                                                        @if(!empty($company->services ))
                                                            @if (!empty($company->services))
                                                                <div class="border-bottom p-2 text-left  view-about">
                                                                    
                                                                    @if(auth()->user()->id == $company->id)
                                                                        <h5 class="text-dark p-2">Our Services</h5>
                                                                    @else
                                                                        <h5 class="text-dark p-2">Services</h5>
                                                                    @endif
                                                                    <p class="text-muted text-justify p-2">{{ $company->services }}</p>
                                                                </div>
                                                            @endif
                                                        @else    
                                                            @if (auth()->user()->id == $company->id)
                                                                <a href="{{ url('profiles/'.auth()->user()->id.'/edit') }}" class="btn back mt-2 btn-sm mb-3 add-empty box my-3">
                                                                    <img src="{{ asset('assets/images/creative/com-ser.png')}}" class="creative-profile">
                                                                    <br>
                                                                    Add Company Services
                                                                </a>
                                                            @else
                                                                <span class="empty-to-show w-75 box my-3">No Services</span>
                                                            @endif  
                                                        @endif   
                                                    @endif
            
                                                    <div class="hours mt-4 p-2 text-left  view-about">
                                                        
                                                        @if(empty($company->sa) && empty($company->su) && empty($company->mo) && empty($company->tu) && empty($company->we) && empty($company->th) && empty($company->fa))
                                                        
                                                            @if (auth()->user()->id == $company->id)
                                                                <a href="{{ url('profiles/'.auth()->user()->id.'/edit') }}" class="btn back mt-2 btn-sm mb-3 add-empty box my-3">
                                                                    <img src="{{ asset('assets/images/creative/clock.png')}}" class="creative-profile">
                                                                    <br>    
                                                                    Add Opening Hours
                                                                </a>
                                                            @else
                                                                <span class="empty-to-show w-75 box my-3">No opening Houres</span>
                                                            @endif 
                                                        @else
                                                        
                                                        <h5 class="text-muted text-left px-2 pb-2"><i class="mdi mdi-clock-outline mr-2"></i>Opening Hours</h5>
                                                            <div class="job-detail-time p-2">
                                                                <ul class="list-inline mb-0">
            
                                                                    @if (!empty($company->sa))
                                                                        <li class="clearfix text-muted border-bottom pb-3">
                                                                            <div class="float-left">Saturday</div>
                                                                            <div class="float-right">
                                                                                <h5 class="f-13 mb-0">{{ $company->sa }}</h5>
                                                                            </div>
                                                                        </li>
                                                                    @endif
                                                                    
                                                                    @if (!empty($company->sa))
                                                                        <li class="clearfix text-muted border-bottom pb-3">
                                                                            <div class="float-left">Sunday</div>
                                                                            <div class="float-right">
                                                                                <h5 class="f-13 mb-0">{{ $company->su }}</h5>
                                                                            </div>
                                                                        </li>
                                                                    @endif
                                                                    
                                                                    @if (!empty($company->sa))
                                                                        <li class="clearfix text-muted border-bottom pb-3">
                                                                            <div class="float-left">Monday</div>
                                                                            <div class="float-right">
                                                                                <h5 class="f-13 mb-0">{{ $company->mo }}</h5>
                                                                            </div>
                                                                        </li>
                                                                    @endif
            
                                                                    @if (!empty($company->sa))
                                                                        <li class="clearfix text-muted border-bottom pb-3">
                                                                            <div class="float-left">Tuesday</div>
                                                                            <div class="float-right">
                                                                                <h5 class="f-13 mb-0">{{ $company->tu }}</h5>
                                                                            </div>
                                                                        </li>
                                                                    @endif
            
                                                                    @if (!empty($company->sa))
                                                                        <li class="clearfix text-muted border-bottom pb-3">
                                                                            <div class="float-left">Wednesday</div>
                                                                            <div class="float-right">
                                                                                <h5 class="f-13 mb-0">{{ $company->we }}</h5>
                                                                            </div>
                                                                        </li>
                                                                    @endif
            
                                                                    @if (!empty($company->sa))
                                                                        <li class="clearfix text-muted border-bottom pb-3">
                                                                            <div class="float-left">Thursday</div>
                                                                            <div class="float-right">
                                                                                <h5 class="f-13 mb-0">{{ $company->th }}</h5>
                                                                            </div>
                                                                        </li>
                                                                    @endif
            
                                                                    @if (!empty($company->sa))
                                                                        <li class="clearfix text-muted pb-3">
                                                                            <div class="float-left">Friday</div>
                                                                            <div class="float-right">
                                                                                <h5 class="f-13 mb-0">{{ $company->fr }}</h5>
                                                                            </div>
                                                                        </li>
                                                                    @endif
                                                                </ul>
                                                            </div>
                                                        </div>
                                                        @endif
            
                                                    </div>
                                                </div>
                                            </div>
                                            @if ($company->role == 2)
                                                <div class="tab-pane fade show" id="branches" role="tabpanel" aria-labelledby="branches-tab">
                                                    <div class="row education mx-0 mt-3">
                                                        <div class="col-sm-12 px-0 ">
                                                            @if (count($company->branches) > 0)
                                                                @foreach ($company->branches as $branch)
                                                                    <div class="text-left text-muted view-edu py-3">
                                                                        <span class="mb-0 degree text-dark"><h6 class="mb-0">{{ $branch->name }} at {{ $branch->address }}</h6></span>
                                                                    </div>
                                                                @endforeach
                                                            @else 
                                                                @if (auth()->user()->id == $company->id)
                                                                    <a href="{{ url('profiles/'.auth()->user()->id.'/edit/branch') }}" class="box add-empty my-4">
                                                                        <div class=" view-edu">
                                                                        <span class="empty-to-show box my-4">Add Branches</span>
            
                                                                    </a>
                                                                        
                                                                @else
                                                                    <div class=" view-edu">
                                                                        <span class="empty-to-show box my-4">No Branches To Show</span>
                                                                    </div>
                                                                @endif
                                                            @endif
                                                        </div>
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
            </section>
        </div>


@include('inc.foot')
<!-- Governemt ID Veification Modal -->
<div class="modal modal-view fade" id="gov_id-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5>Government ID</h5>
            </div>
            <div class="modal-body">
                <div class="form-group app-label mt-2">
                    {!! Form::open(['action'=> ['WorkerController@update', $company->id], 'method'=>'POST', 'enctype' =>'multipart/form-data' ])!!}
                    <div class="">

                    
                        @if ($company->gov_id == 'verified')
                            <i class="fal fa-badge-check"></i>
                            Verified
                        @else 
                            <img src="{{ asset('uploads/images/gov_id/'.$company->gov_id) }}" alt="" class="w-50 d-block m-auto">
                        @endif
                    </div>
                    <div class="row">
                        <div class="col-lg-12 mt-2">
                            {!! Form::submit('Verify Worker', ['class' => "btn btn-primary mt-2 btn-sm", 'name' => 'verify-gov_id']) !!}
                            {!! Form::submit('Reject', ['class' => "btn btn-danger mt-2 btn-sm", 'name' => 'reject-gov_id']) !!}
                        </div>
                    </div>
                    {!! Form::hidden('_method', 'PUT') !!}
                    {!! Form::close() !!}
                </div>
            </div>
            
            </div>
        </div>
    </div>
</div>