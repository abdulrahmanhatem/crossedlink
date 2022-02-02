@include('inc.home.head', ['title' => !empty($user->company_name) ?  $user->company_name : $user->name])

<section class="p-150 candidate-profile employers-profile">
    <div class="container">
        <div class="row big-row">
            <div class="col-md-3 col-sm-12 pb-4 text-center view-face">
                <div class="avatar">
                    @if(!empty($user->profile_image))
                    <img src="{{ asset('uploads/images/profile_images/'.$user->profile_image ) }}" alt="" class="d-block mx-auto shadow rounded-pill mb-4 worker-avatar">
                    @else 
                        <img src="{{ asset('uploads/images/profile_images/default_company.jpg') }}" alt="" class="d-block mx-auto shadow rounded-pill mb-4 worker-avatar">
                    @endif
                </div>
                @if (!empty($user->company_name))
                    <h5 class="mb-2 text-center worker-name">{{ ucwords($user->company_name) }}</h5>
                @else 
                    <h5 class="mb-2 text-center worker-name">{{ ucwords($user->name) }}</h5>     
                @endif
                
                <div class="nationality">
                    @if (auth()->user()->role == 2)
                    <div>
                        @if (!empty($user->website ))
                            {{ $user->website }}
                        @else    
                            @if (auth()->user()->id == $user->id)
                                <a href="{{ url('profiles/'.auth()->user()->id.'/edit') }}" class="btn back mt-2 btn-sm mb-3 add-empty">{{trans('main.Add Website')}}</a>
                            @else
                                <span class="empty-to-show w-75 ">{{trans('main.No Website')}}</span>
                            @endif
                        @endif
                    </div>
                    
                    <div>
                        @if (!empty($user->experience))
                            {{ $user->experience }} {{trans('main.Years Of Experience')}}
                        @else    
                            @if (auth()->user()->id == $user->id)
                                <a href="{{ url('profiles/'.auth()->user()->id.'/edit') }}" class="btn back mt-2 btn-sm mb-3 add-empty">{{trans('main.Add Experience')}}</a>
                            @else
                                <span class="empty-to-show w-75 ">{{trans('main.No Experience')}}</span>
                            @endif    
                        @endif
                        
                    </div>
                    @endif
                </div>
                {{--<div class="email">
                    <span>
                        <i class="fal fa-envelope mr-1"></i>
                        {{ $user->email }}
                    </span>
                </div>
                @if (!empty($user->phone)  || !empty($user->phone_2))
                <div class="phone">
                    <i class="fal fa-phone-alt"></i>
                    <span>
                        @if (!empty($user->phone))
                            0{{ $user->phone }}
                        @endif
                    </span>
                    <span>
                        -
                        @if (!empty($user->phone_2))
                            0{{ $user->phone_2 }}
                        @endif
                    </span>
                </div>
                @else    
                    @if (auth()->user()->id == $user->id)
                        <a href="{{ url('profiles/'.auth()->user()->id.'/edit') }}" class="btn back mt-2 btn-sm mb-3 add-empty">Add Phones</a>
                    @else
                        <span class="empty-to-show w-75 ">No Phones</span>
                    @endif 
                @endif--}}

                <div class="country">
                    @if (!empty($user->country))
                        <span>
                            <i class="fal fa-globe mr-1"></i>
                            {{ Helper::getCountryBykey($user->country) }}
                        </span>
                    @else    
                        @if (auth()->user()->id == $user->id)
                            <a href="{{ url('profiles/'.auth()->user()->id.'/edit') }}" class="btn back mt-2 btn-sm mb-3 add-empty">{{trans('main.Add Country')}}</a>
                        @else
                            <span class="empty-to-show w-75 ">{{trans('main.No Country')}}</span>
                        @endif     
                    @endif

                    @if (!empty($user->address))
                        <div>
                            <span>
                                <i class="fal fa-map-marker-alt mr-1"></i>
                                {{ $user->address }}
                            </span>
                        </div>
                    @else    
                        @if (auth()->user()->id == $user->id)
                            <a href="{{ url('profiles/'.auth()->user()->id.'/edit') }}" class="btn back mt-2 btn-sm mb-3 add-empty">{{trans('main.Add Address')}}</a>
                        @else
                            <span class="empty-to-show w-75 ">{{trans('main.No Address')}}</span>
                        @endif     
                    @endif
                </div>
                <div class="birth">
                    @if (auth()->user()->role == 2)
                        @if (!empty($user->employers))
                            <span>
                                {{ $user->employers }} {{trans('main.Employers')}}
                            </span>
                        @else    
                            @if (auth()->user()->id == $user->id)
                                <a href="{{ url('profiles/'.auth()->user()->id.'/edit') }}" class="btn back mt-2 btn-sm mb-3 add-empty">{{trans('main.Add Company Size')}}</a>
                            @else
                                <span class="empty-to-show w-75 ">{{trans('main.No Company Size')}}</span>
                            @endif     
                        @endif
                    @endif
                </div>

                
                {{--<div class="social">
                    @if (count($user->socials) > 0)
                    <div class="contacts">
                        Contacts
                    </div>
    
                        @foreach ($user->socials as $social)
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
                        @if (auth()->user()->id == $user->id)
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
                                    <a class="nav-link rounded active" id="about-tab" data-toggle="pill" href="#about" role="tab" aria-controls="about" aria-selected="true">{{trans('main.About')}}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link rounded" id="education-tab" data-toggle="pill" href="#education" role="tab" aria-controls="education" aria-selected="false">{{trans('main.Services')}}</a>
                                </li>
                                @if (auth()->user()->role == 2)
                                <li class="nav-item">
                                    <a class="nav-link rounded" id="branches-tab" data-toggle="pill" href="#branches" role="tab" aria-controls="branches" aria-selected="false">{{trans('main.Branches')}}</a>
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
                                                    @if(auth()->user()->id == $user->id)
                                                            <h5 class="text-dark">{{trans('main.About Us')}} </h5>
                                                    @else
                                                        @if (!empty($user->company_name))
                                                            <h5 class="text-dark">{{trans('main.About')}} {{ ucwords($user->company_name) }}</h5>
                                                        @else 
                                                            <h5 class="text-dark">{{trans('main.About')}} {{ ucwords($user->name) }}</h5>  
                                                        @endif
                                                    @endif
                                                    @if(!empty($user->overview ))
                                                        
                                                        <p class="text-muted text-justify">{{ $user->overview }}</p>
                                                    @else    
                                                        
                                                        @if (auth()->user()->id == $user->id)
                                                            <a href="{{ url('profiles/'.auth()->user()->id.'/edit') }}" class="btn back mt-2 btn-sm mb-3 add-empty box my-3">
                                                                <img src="{{ asset('assets/images/creative/com-desc.png')}}" class="creative-profile">
                                                                <br>

                                                                {{trans('main.Add Company Description')}}
                                                            
                                                            </a>
                                                        @else
                                                            <span class="empty-to-show w-75 box my-3">{{trans('main.No Description')}}</span>
                                                        @endif 
                                                    
                                                    @endif  
                                                </div> 
                                                @endif  
                                                
                                            
                                            {{--<div class="map mt-3 pb-3 view-about">
                                                <iframe src="https://www.google.com/maps/embed?pb=!1m10!1m8!1m3!1d6030.418742494061!2d-111.34563870463673!3d26.01036670629853!3m2!1i1024!2i768!4f13.1!5e0!3m2!1ses-419!2smx!4v1471908546569" class="rounded" style="border: 0" allowfullscreen=""></iframe>
                                            </div>--}}
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade show " id="education" role="tabpanel" aria-labelledby="education-tab">
                                    <div class="row education">
                                        <div class="col-sm-12 p-0">
                                        @if (auth()->user()->role == 2)
                                            @if(!empty($user->services ))
                                                @if (!empty($user->services))
                                                    <div class="border-bottom p-2 text-left  view-about">
                                                        
                                                        @if(auth()->user()->id == $user->id)
                                                            <h5 class="text-dark p-2">{{trans('main.Our Services')}}</h5>
                                                        @else
                                                            <h5 class="text-dark p-2">{{trans('main.Services')}}</h5>
                                                        @endif
                                                        <p class="text-muted text-justify p-2">{{ $user->services }}</p>
                                                    </div>
                                                @endif
                                            @else    
                                                @if (auth()->user()->id == $user->id)
                                                    <a href="{{ url('profiles/'.auth()->user()->id.'/edit') }}" class="btn back mt-2 btn-sm mb-3 add-empty box my-3">
                                                        <img src="{{ asset('assets/images/creative/com-ser.png')}}" class="creative-profile">
                                                        <br>
                                                        {{trans('main.Add Company Services')}}
                                                    </a>
                                                @else
                                                    <span class="empty-to-show w-75 box my-3">{{trans('main.No Services')}}</span>
                                                @endif  
                                            @endif   
                                        @endif

                                        <div class="hours mt-4 p-2 text-left  view-about">
                                            
                                            @if(empty($user->sa_from) && empty($user->su_from) && empty($user->mo_from) && empty($user->tu_from) && empty($user->we_from) && empty($user->th_from) && empty($user->fr_from) && empty($user->sa_to) && empty($user->su_to) && empty($user->mo_to) && empty($user->tu_to) && empty($user->we_to) && empty($user->th_to) && empty($user->fr_to))
                                            
                                                @if (auth()->user()->id == $user->id)
                                                    <a href="{{ url('profiles/'.auth()->user()->id.'/edit') }}" class="btn back mt-2 btn-sm mb-3 add-empty box my-3">
                                                        <img src="{{ asset('assets/images/creative/clock.png')}}" class="creative-profile">
                                                        <br>    
                                                        {{trans('main.Add Opening Hours')}}
                                                    </a>
                                                @else
                                                    <span class="empty-to-show w-75 box my-3">{{trans('main.No opening Houres')}}</span>
                                                @endif 
                                            @else
                                            
                                            <h5 class="text-muted text-left px-2 pb-2"><i class="mdi mdi-clock-outline mr-2"></i>{{trans('main.Opening Hours')}}</h5>
                                                <div class="job-detail-time p-2">
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

                                        </div>
                                    </div>
                                </div>
                                @if (auth()->user()->role == 2)
                                    <div class="tab-pane fade show" id="branches" role="tabpanel" aria-labelledby="branches-tab">
                                        <div class="row education mx-0 mt-3">
                                            <div class="col-sm-12 px-0 ">
                                                @if (count($user->branches) > 0)
                                                    @foreach ($user->branches as $branch)
                                                        <div class="text-left text-muted view-edu py-3">
                                                            <span class="mb-0 degree text-dark"><h6 class="mb-0">{{ $branch->name }} at {{ $branch->address }}</h6></span>
                                                        </div>
                                                    @endforeach
                                                @else 
                                                    @if (auth()->user()->id == $user->id)
                                                        <a href="{{ url('profiles/'.auth()->user()->id.'/edit/branch') }}" class="box add-empty my-4">
                                                            <span class="empty-to-show box my-4">{{trans('main.Add Branches')}}</span>
                                                        </a>
                                                    @else
                                                        <div class=" view-edu">
                                                            <span class="empty-to-show box my-4">{{trans('main.No Branches To Show')}}</span>
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
@include('inc.home.foot')
    @include('inc.home.scripts')
</body>
</html>
