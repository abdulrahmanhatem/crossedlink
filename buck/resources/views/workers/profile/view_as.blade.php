@include('inc.home.head', ['title' => ucwords($user->name)])

<section class="p-150 candidate-profile">
    <div class="container">
        <div class="row big-row">

            <div class="col-md-3 col-sm-12 pb-3 view-face">
                @if(auth()->user()->id == $user->id)
                <span type="button" class="text-primary box-modal-edit" data-toggle="modal" data-target="#general-box-1">
                    <i class="fad fa-edit"></i>
                </span>
                @endif
                <div class="avatar">
                    @if(!empty($user->profile_image))
                    <img src="{{ asset('uploads/images/profile_images/'.$user->profile_image ) }}" alt="" class="d-block mx-auto shadow rounded-pill mb-4 worker-avatar">
                    @else 
                        <img src="{{ asset('uploads/images/profile_images/default.jpg') }}" alt="" class="d-block mx-auto shadow rounded-pill mb-4 worker-avatar">
                    @endif
                   
                </div>
                <h5 class="mb-2 text-center worker-name">{{ ucwords($user->name) }}</h5>
                <div class="nationality text-center">
                    @if (!empty($user->category_id))
                        @foreach(Helper::userCats($user->category_id) as $key => $value)
                            @if($loop->index < 4)
                                <span class="category">
                                    {{ Helper::getCategoryName($value) }}
                                </span>
                            @endif
                        @endforeach
                    @else 
                        @if(auth()->user()->id == $user->id)
                            <div class="add-missing">
                                <a data-toggle="modal" data-target="#general-box-1"  class="text-primary btn back mt-2 btn-sm add-empty">{{trans('main.Add') . ' ' . trans('main.Job Role')}}</a>
                            </div>
                        @endif
                    @endif
                </div>
                <div class="country text-center">
                    @if (!empty($user->town))
                        <span>
                            {{ $user->town }}
                        </span>
                    @endif
                    @if (!empty($user->city))
                        <span>
                            {{$user->city }}
                        </span>
                    @endif
                    @if (!empty($user->country))
                        <span>
                            {{ Helper::getCountryByKey($user->country) }}
                        </span>
                    @else 
                        @if(auth()->user()->id == $user->id)
                            <div class="add-missing">
                                <a data-toggle="modal" data-target="#general-box-1"  class="text-primary btn back mt-2 btn-sm add-empty">{{trans('main.Add') ." ". trans('main.Country')}}</a>
                            </div> 
                        @endif
                    @endif
                </div>

                <div class="verified mt-4 text-center">
                <h6 class="mb-2 text-center text-muted worker-name">{{ ucwords($user->name) }} {{trans('main.Provided')}}</h6>
                    <div>
                        @if (empty($user->gov_id))
                            <i class="fal fa-exclamation-circle text-danger"></i>
                            {{trans('main.Government ID')}}
                            @if($user->id == auth()->user()->id)
                                <a class="text-primary" data-toggle="modal" data-target="#gov_id-modal">{{trans('main.Verify')}}</a>
                            @endif  
                        @else 
                            @if ($user->gov_id == 'verified')
                                <i class="fal fa-check-circle"></i>
                                {{trans('main.Government ID')}}
                            @else 
                                <i class="fal fa-exclamation-circle text-danger"></i>
                                {{trans('main.Government ID')}}
                                @if($user->id == auth()->user()->id)
                                    <span class="badge badge-success badge-sm">{{trans('main.Sent')}}</span> 
                                @endif  
                            @endif
                        @endif
                    </div>      
                    <div>                       
                    
                        
                                        
                    @if(($user->email_verified_at==NULL && $user->email_verify_token==NULL) || ($user->email_verified_at==NULL && $user->email_verify_token!=NULL))                         
                        <i class="fal fa-exclamation-circle text-danger"></i>   
                        {{trans('main.Email Address')}}
                        @if($user->id == auth()->user()->id)
                            <a href="{{url('verify-email')}}" class="text-primary" style="padding: 0 5px;margin-bottom:4px">{{trans('main.Verify')}}</a>
                        @endif  
                    @else
                        <i class="fal fa-check-circle"></i> {{trans('main.Email Address')}}
                    @endif                   
                    </div>                   
                    <div>                        
                                            
                    @if($user->IsPhoneVerified)                         
                        <i class="fal fa-check-circle"></i>                         
                        {{trans('main.Phone Number')}}
                    @else 
                        <i class="fal fa-exclamation-circle text-danger"></i> {{trans('main.Phone Number')}}
                        @if($user->id == auth()->user()->id)
                            <a href="javascript:void(0)" class="phoneverficationModal  text-primary _verify" style="padding: 0 5px;margin-bottom:4px">{{trans('main.Verify')}}</a>  
                        @endif  
                    @endif                    
                    </div>
                    
                </div>
                <div class="text-center">
                    @if (auth()->user()->role == 2 || auth()->user()->role == 1)
                    @if (Helper::unlockCheck($user->id))
                        @foreach (Helper::unlockList() as $req)
                            @if ($user->id == $req->worker_id)
                                
                                <span class=""><a href="{{url('chat/'.$user->id)}}" class="btn btn-primary btn-sm"><i class="fad fa-comments-alt mx-1"></i>{{trans('main.Chat')}}</a></span>
                            @endif
                        @endforeach
                    @endif
                    @endif
                </div>
                
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
                                    <a class="nav-link rounded" id="education-tab" data-toggle="pill" href="#education" role="tab" aria-controls="education" aria-selected="false">{{trans('main.Education')}}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link rounded" id="experience-tab" data-toggle="pill" href="#experience" role="tab" aria-controls="experience" aria-selected="false">{{trans('main.Experience')}}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link rounded" id="portfolio-tab" data-toggle="pill" href="#portfolio" role="tab" aria-controls="portfolio" aria-selected="false">{{trans('main.Portfolio')}}</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="row">
                        <div class="w-100">
                            <div class="tab-content" id="pills-tabContent">
                                <div class="tab-pane fade show active" id="about" role="tabpanel" aria-labelledby="about-tab">
                                    <div class="row">
                                        <div class="col-lg-12 px-0">
                                            <div class="py-2 text-left">
                                                <div class="row profile-top">
                                                    <div class="col-md-6 col-sm-12 view-profile-details">
                                                        
                                                        <div class="email">
                                                            <i class="fal fa-envelope mr-1"></i>
                                                            <label class="profile-label">{{trans('main.Email')}}:</label>
                                                            <span>
                                                                {{ $user->email }}
                                                            </span>
                                                        </div>
                                                            @if (!empty($user->phone) || !empty($user->phone_2))
                                                                <div class="phone">
                                                                    <i class="fal fa-phone-alt"></i>
                                                                    <label class="profile-label">{{trans('main.Phone')}}:</label>
                                                                    @if (!empty($user->phone))
                                                                        <span>
                                                                            {{ $user->phone }}
                                                                        </span>
                                                                    @endif
                                                                </div>
                                                            @else 
                                                                @if (auth()->user()->id == $user->id)
                                                                <div class="phone">
                                                                    <i class="fal fa-phone-alt"></i>
                                                                    <label class="profile-label">{{trans('main.Phone')}}:</label>
                                                                    <a data-toggle="modal" data-target="#general-box-2"  class="text-primary btn back btn-sm add-empty">{{trans('main.Add'). ' ' .trans('main.Phone')}}</a>
                                                                </div>
                                                                @else
                                                                    <span class="empty-to-show w-75 ">{{trans('main.No Phone To Show')}}</span>
                                                                @endif
                                                            
                                                            @endif

                                                            @if (!empty($user->experience))
                                                                <div class="phone">
                                                                    <i class="fas fa-briefcase"></i>
                                                                    <label class="profile-label">{{trans('main.Experience')}}:</label>
                                                                    @if (!empty($user->experience))
                                                                        <span>
                                                                            @foreach (Helper::experience() as $key => $experience)
                                                                            @if ($user->experience == $key)
                                                                                {{ $experience }}
                                                                            @endif
                                                                            @endforeach
                                                                        </span>
                                                                    @endif
                                                                </div>
                                                            @else 
                                                                @if (auth()->user()->id == $user->id)
                                                                <div class="phone">
                                                                    <i class="fal fa-phone-alt"></i>
                                                                    <label class="profile-label">{{trans('main.Experience')}}:</label>
                                                                    <a data-toggle="modal" data-target="#general-box-2"  class="text-primary btn back btn-sm add-empty">{{trans('main.Add'). ' ' .trans('main.Experience')}}</a>
                                                                </div>
                                                                @else
                                                                    <span class="empty-to-show w-75 ">{{trans('main.No Experience To Show')}}</span>
                                                                @endif
                                                            @endif
                                                            @foreach (Helper::minimalSalary() as $key => $option)
                                                                @if($user->average_salary == $key)
                                                                    <span class="salary">
                                                                        <i class="fal fa-wallet"></i>
                                                                        <label class="profile-label">{{trans('main.Salary')}}:</label>
                                                                        @if ($user->salary_hide == 0)
                                                                            {{ $option }}
                                                                        @else 
                                                                        {{trans('main.Confidential')}}
                                                                        @endif
                                                                    </span>
                                                                @endif
                                                            @endforeach
                                                            @if(auth()->user()->id == $user->id)
                                                            <span type="button" class="text-primary box-modal-edit" data-toggle="modal" data-target="#general-box-2">
                                                                <i class="fad fa-edit"></i>
                                                            </span>
                                                            @endif
                                                            
                                                       
                                                        @if (count($user->socials) > 0)
                                                            <div class="social">
                                                                @foreach ($user->socials as $social)
                                                                    <ul class="list-unstyled social-icon social mb-0">
                                                                        @if (!empty($social->facebook))
                                                                        
                                                                            <li class="list-inline-item"><a href="{{ $social->facebook }}" class="rounded"><i class="mdi mdi-facebook"></i></a></li>
                                                                        @endif
                                                                        @if (!empty($social->twitter))
                                                                            <li class="list-inline-item"><a href="{{ $social->twitter }}" class="rounded"><i class="mdi mdi-twitter"></i></a></li>
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
                                                                @if(auth()->user()->id == $user->id)
                                                                    <span type="button" class="text-primary box-modal-edit" data-toggle="modal" data-target="#social-modal">
                                                                        <i class="fad fa-edit"></i>
                                                                    </span>
                                                                @endif
                                                                
                                                            </div>
                                                        @else 
                                                            @if (auth()->user()->id == $user->id)
                                                            
                                                            <span type="button" class="text-primary box-modal-edit" data-toggle="modal" data-target="#social-modal">
                                                                <i class="fad fa-edit"></i>{{trans('main.Add Social Media')}}
                                                            </span>
                                                            @else
                                                                <span class="empty-to-show w-75 ">{{trans('main.No Contacts To Show')}}</span>
                                                            @endif
                                                        @endif
                                                        
                                                    </div>
                                                    <div class="col-md-6 col-sm-12  view-profile-contact">
                                                        <div class="">
                                                            <div class="birth">
                                                                @if (!empty($user->birth))
                                                                    @if (Helper::getAge($user->birth) > 15)
                                                                        <i class="fad fa-calendar-star"></i>
                                                                        <label class="profile-label">{{trans('main.Age')}}:</label>
                                                                        <span>
                                                                            {{ Helper::getAge($user->birth) }}
                                                                        </span>
                                                                    @endif
                                                                @else 
                                                                    @if(auth()->user()->id == $user->id)
                                                                        <div class="add-missing">
                                                                            <a data-toggle="modal" data-target="#general-box-3"  class="text-primary btn back mt-2 btn-sm add-empty">{{trans('main.Add') . ' ' . trans('main.Birthday')}}</a>
                                                                        </div> 
                                                                    @endif
                                                                @endif

                                                                @if (!empty($user->gender))
                                                                    @foreach (Helper::gender() as $key => $option)
                                                                        @if($user->gender == $key)
                                                                            <i class="fas fa-venus-mars"></i>
                                                                            <label class="profile-label">{{trans('main.Gender')}}:</label>
                                                                                <span>
                                                                                    {{ $option }}
                                                                        @endif
                                                                            </span>
                                                                    @endforeach
                                                                @else 
                                                                    @if(auth()->user()->id == $user->id)
                                                                        <div class="add-missing">
                                                                            <a data-toggle="modal" data-target="#general-box-3"  class="text-primary btn back mt-2 btn-sm add-empty">{{trans('main.Add') . ' ' . trans('main.Gender')}}</a>
                                                                        </div> 
                                                                    @endif  
                                                                @endif
                                                                @if (!empty($user->married))
                                                                @foreach (Helper::married() as $key => $option)
                                                                    @if($user->married == $key)
                                                                    <i class="fal fa-rings-wedding"></i>
                                                                        <label class="profile-label">{{trans('main.Married')}}:</label>
                                                                        <span>
                                                                            {{ $option }}
                                                                        </span>
                                                                    @endif
                                                                @endforeach
                                                                @else 
                                                                    @if(auth()->user()->id == $user->id)
                                                                        <div class="add-missing">
                                                                            <a data-toggle="modal" data-target="#general-box-3"  class="text-primary btn back mt-2 btn-sm add-empty">{{trans('main.Add') . ' ' . trans('main.Married')}}</a>
                                                                        </div> 
                                                                    @endif  
                                                                @endif
                                                            </div>

                                                            @if (!empty($user->legal))
                                                                @foreach (Helper::legal() as $key => $option)
                                                                    <div>
                                                                        @if($user->legal == $key)
                                                                        <i class="fal fa-passport"></i>
                                                                        <label class="profile-label">{{trans('main.Legal')}}:</label>
                                                                            <span>
                                                                                {{ $option }}
                                                                            @endif
                                                                        </span>
                                                                    </div>
                                                                @endforeach
                                                            @else 
                                                                @if(auth()->user()->id == $user->id)
                                                                    <div class="add-missing">
                                                                        <a data-toggle="modal" data-target="#general-box-3"  class="text-primary btn back mt-2 btn-sm add-empty">{{trans('main.Add') . ' ' . trans('main.Legal')}}</a>
                                                                    </div> 
                                                                @endif  
                                                            @endif
                                                        
                                                            @if (!empty($user->nationality))
                                                                <div>
                                                                    <i class="fal fa-flag-alt"></i>
                                                                    <label class="profile-label">{{trans('main.Nationality')}}:</label>
                                                                    <span>
                                                                        {{ Helper::nationalityByKey($user->nationality) }}
                                                                    </span>
                                                                </div>
                                                            @else 
                                                                @if(auth()->user()->id == $user->id)
                                                                    <div class="add-missing">
                                                                        <a data-toggle="modal" data-target="#general-box-3"  class="text-primary btn back mt-2 btn-sm add-empty">{{trans('main.Add') . ' ' . trans('main.Nationality')}}</a>
                                                                    </div> 
                                                                @endif  
                                                            @endif
                                                        

                                                            @if (!empty($user->religion))
                                                                <div>
                                                                    <i class="fad fa-dove"></i>
                                                                    <label class="profile-label">{{trans('main.Religion')}}:</label>
                                                                    <span>
                                                                        {{ Helper::religionByKey($user->religion) }}
                                                                    </span>
                                                                </div>
                                                            @else 
                                                                @if(auth()->user()->id == $user->id)
                                                                    <div class="add-missing">
                                                                        <a data-toggle="modal" data-target="#general-box-3"  class="text-primary btn back mt-2 btn-sm add-empty">{{trans('main.Add') . ' ' . trans('main.Religion')}}</a>
                                                                    </div> 
                                                                @endif  
                                                            @endif
                                                        
                                                            @if (!empty($user->address))
                                                                <div>
                                                                    <i class="fal fa-map-marker-alt"></i>
                                                                    <label class="profile-label">{{trans('main.Address')}}:</label>
                                                                    <span>
                                                                        {{ $user->address }}
                                                                    </span>
                                                                </div>
                                                            @else 
                                                                @if(auth()->user()->id == $user->id)
                                                                    <div class="add-missing">
                                                                        <a data-toggle="modal" data-target="#general-box-3"  class="text-primary btn back mt-2 btn-sm add-empty">{{trans('main.Add') . ' ' . trans('main.Address')}}</a>
                                                                    </div> 
                                                                @endif  
                                                            @endif
                                                          
                                                            @if (Helper::CVCheck($user->cv))
                                                                <div class="email">
                                                                    <i class="fal fa-address-card"></i>
                                                                    <label class="profile-label">{{trans('main.Cv')}}:</label>
                                                                    @if (Helper::CVCheck($user->cv))
                                                                        <span>
                                                                            <a href="{{url('download/cv/'.$user->id )}}" class="download">{{trans('main.Download')}}</a>
                                                                        </span>
                                                                    @else 
                                                                        <span>
                                                                            {{trans('main.No CV To Show')}}
                                                                        </span>    
                                                                    @endif
                                                                </div>
                                                            @else 
                                                                @if(auth()->user()->id == $user->id)
                                                                    <div class="add-missing">
                                                                        <a data-toggle="modal" data-target="#general-box-3"  class="text-primary btn back mt-2 btn-sm add-empty">{{trans('main.Add') . ' ' . trans('main.Cv')}}</a>
                                                                    </div> 
                                                                @endif  
                                                            @endif
                                                            
                                                        </div>
                                                        @if(auth()->user()->id == $user->id)
                                                            <span type="button" class="text-primary box-modal-edit" data-toggle="modal" data-target="#general-box-3">
                                                                <i class="fad fa-edit"></i>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
        <div class="col-md-6 col-sm-12 text-left view-profile-details">
            <h5 class="text-dark">{{trans('main.Skills')}}</h5>
                @if (count($user->skills) > 0)
                
                    @foreach ($user->skills as $skill)
                        @foreach (Helper::getSkills($skill->name) as $s)
                        <span class="skill">{{ $s }}</span>
                        @endforeach
                    @endforeach
                    @if (count($user->skills) > 0)
                        <div class="row h-auto">
                            @if(auth()->user()->id == $user->id)
                                <p>
                                    <span class="view-add-btn text-primary" data-toggle="collapse" href="#skills-edit-collapse" role="button" aria-expanded="false" aria-controls="skills-collapse">
                                        <i class="fad fa-edit"></i>
                                    </span>
                                </p>
                            @endif
                            
                            @foreach($user->skills as $skill)
                            <div class="collapse" id="skills-edit-collapse">
                                {!! Form::open(['action'=>['ProfileController@update', $user->id], 'method'=>'POST', 'enctype' =>'multipart/form-data', ' novalidate', 'class' => 'needs-validation'])!!}
                                <div class="tab-pane" id="TabCareerInfo" name="Career History">
                                    <div class="w-100">
                                        <label for="txtSkills" class="pr-2">{{trans('main.Skills')}}</label>
                                        <input type="text" class="form-control" id="txtSkills" name = "name"  data-role="tagsinput" value="{{ $skill->name }}"> 
                                        {!! Form::submit(trans('main.Update'), ['class' => "btn btn-primary mt-2 btn-sm ml-2", 'name' => 'edit-skill']) !!}                                   
                                    </div>
                                </div>
                                {!! Form::text('skill_id', $skill->id, ['hidden']) !!}
                                {!! Form::hidden('_method', 'PUT') !!}
                                {!! Form::close() !!}
                            </div>
                            @endforeach
                        </div> 
                    @else
                        @if(auth()->user()->id == $user->id)
                            <p>
                                <span class="view-add-btn text-primary" data-toggle="collapse" href="#skills-add-collapse" role="button" aria-expanded="false" aria-controls="skills-collapse">
                                    <i class="fal fa-plus mr-1"></i>
                                </span>
                            </p>
                        @endif
                        <div class="collapse" id="skills-add-collapse">
                            <div class="row">
                                {!! Form::open(['action'=>['ProfileController@store', $user->id], 'method'=>'POST', 'enctype' =>'multipart/form-data', ' novalidate', 'class' => 'needs-validation'])!!}
                                <div class="tab-pane" id="TabCareerInfo" name="Career History">
                                    <div class="row">
                                        <label for="txtSkills" class="pr-2">{{trans('main.Skills')}}</label>
                                        <input type="text" class="form-control" id="txtSkills" name = "name"  data-role="tagsinput"> 
                                        {!! Form::submit(trans('main.Add'), ['class' => "btn btn-primary mt-2 btn-sm ml-2", 'name' => 'create-skill']) !!}      
                                    </div>
                                </div>
                                {!! Form::close() !!}
                            </div><!--end process box-->
                        </div>
                    @endif  
                @else 
                    @if(auth()->user()->id == $user->id)
                        @if (Helper::checkGender($user->gender) != 'Female' )
                            <img src="{{ asset('assets/images/creative/skill-m.png')}}" class="creative-profile">
                        @else 
                            <img src="{{ asset('assets/images/creative/skill-f.png')}}" class="creative-profile">
                        @endif
                        <br>
                        
                        @if (count($user->skills) > 0)
                            <div class="row h-auto">
                                @if(auth()->user()->id == $user->id)
                                    <p>
                                        <span class="box-modal-edit text-primary" data-toggle="collapse" href="#skills-edit-collapse" role="button" aria-expanded="false" aria-controls="skills-collapse">
                                            <i class="fad fa-edit"></i>
                                        </span>
                                    </p>
                                @endif
                                
                                
                                @foreach($user->skills as $skill)
                                <div class="collapse" id="skills-edit-collapse">
                                    {!! Form::open(['action'=>['ProfileController@update', $user->id], 'method'=>'POST', 'enctype' =>'multipart/form-data', ' novalidate', 'class' => 'needs-validation'])!!}
                                    <div class="tab-pane" id="TabCareerInfo" name="Career History">
                                        <div class="row">
                                            <label for="txtSkills" class="pr-2">{{trans('main.Skills')}}</label>
                                            <input type="text" class="form-control" id="txtSkills" name = "name"  data-role="tagsinput" value="{{ $skill->name }}"> 
                                            {!! Form::submit(trans('main.Update'), ['class' => "btn btn-primary mt-2 btn-sm ml-2", 'name' => 'edit-skill']) !!}                                   
                                        </div>
                                    </div>
                                    <div class="">
                                        
                                    </div>
                                    {!! Form::text('skill_id', $skill->id, ['hidden']) !!}
                                    {!! Form::hidden('_method', 'PUT') !!}
                                    {!! Form::close() !!}
                                </div>
                                @endforeach
                            </div> 
                        @else
                        
                            <p>
                                <span class="view-add-btn text-primary" data-toggle="collapse" href="#skills-add-collapse" role="button" aria-expanded="false" aria-controls="skills-collapse">
                                    <i class="fal fa-plus mr-1"></i>{{trans('main.Add Skills')}}
                                </span>
                            </p>
                            
                            <div class="collapse" id="skills-add-collapse">
                                <div class="row">
                                    {!! Form::open(['action'=>['ProfileController@store', $user->id], 'method'=>'POST', 'enctype' =>'multipart/form-data', ' novalidate', 'class' => 'needs-validation'])!!}
                                    <div class="tab-pane" id="TabCareerInfo" name="Career History">
                                        <div class="row">
                                            <label for="txtSkills" class="pr-2">{{trans('main.Skills')}}</label>
                                            <input type="text" class="form-control" id="txtSkills" name = "name"  data-role="tagsinput"> 
                                            {!! Form::submit(trans('main.Add'), ['class' => "btn btn-primary mt-2 btn-sm ml-2", 'name' => 'create-skill']) !!}
                                        </div>
                                    </div>
                                    {!! Form::close() !!}
                                </div>
                            </div>
            @endif  
                @else
                    <span class="empty-to-show box my-4">{{trans('main.No Skills To Show')}}</span>
                @endif
            @endif
        </div>
        <div class="col-md-6 col-sm-12 text-left view-profile-contact lang">
            <h6 class="text-dark">{{trans('main.Languages')}}</h6>
            @if (count($user->languages) > 0)
                <div class="progress-box">
                    @foreach($user->languages as $language)
                
                    <h6 class="title text-muted">{{Helper::languageByKey($language->language)}}</h6>
                    <div class="progress">
                        @if(auth()->user()->id == $user->id)
                            <div class="dropdown position-absolute options-dropdown">
                                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="far fa-ellipsis-v"></i>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                    <a class="dropdown-item" data-toggle="modal" data-target="#language-{{ $language->id }}">{{trans('main.Edit')}}</a>
                                    <a class="dropdown-item" data-toggle="modal" data-target="#language-{{ $language->id }}-delete">{{trans('main.Delete')}}</a>
                                </div>
                            </div>
                        @endif
                        
                        @if($language->proficiency == 0)
                            <div class="progress-bar progress-bar-striped position-relative bg-primary" style="width:20%;">
                                <div class="progress-value d-block h6 w-100">{{trans('main.Beginner')}}</div>
                            </div>
                        @elseif($language->proficiency == 1)
                            <div class="progress-bar progress-bar-striped position-relative bg-primary" style="width:40%;">
                                <div class="progress-value d-block h6 w-100">{{trans('main.Intermediate')}}</div>
                            </div>
                        @elseif($language->proficiency == 2)
                            <div class="progress-bar progress-bar-striped position-relative bg-primary" style="width:60%;">
                                <div class="progress-value d-block h6 w-100">{{trans('main.Advanced')}}</div>
                            </div>
                        @elseif($language->proficiency == 3)
                            <div class="progress-bar progress-bar-striped position-relative bg-primary" style="width:80%;">
                                <div class="progress-value d-block h6 w-100">{{trans('main.Fluent')}}</div>
                            </div>
                        @elseif($language->proficiency == 4)
                            <div class="progress-bar progress-bar-striped position-relative bg-primary" style="width:100%;">
                                <div class="progress-value d-block h6 w-100">{{trans('main.Native')}}</div>
                            </div>
                        @endif
                    </div>
                    @endforeach
                    
                </div><!--end process box-->
            @else    
                @if (auth()->user()->id == $user->id)
                    @if (Helper::checkGender($user->gender) != 'Female')
                        <img src="{{ asset('assets/images/creative/lang.png')}}" class="creative-profile">
                    @else 
                        <img src="{{ asset('assets/images/creative/lang.png')}}" class="creative-profile">
                    @endif
                    <br>
                   
                @else
                    <span class="empty-to-show box my-4">{{trans('main.No Languages To Show')}}</span>
                @endif      
            @endif 
            @if (auth()->user()->id == $user->id)
            <p>
                <span class="box-modal-edit text-primary" data-toggle="collapse" href="#lang-edit-collapse" role="button" aria-expanded="false" aria-controls="skills-collapse">
                    <i class="fal fa-plus mr-1"></i>{{trans('main.Add') . ' ' . trans('main.Language')}}
                </span>
            </p>
            <div class="collapse" id="lang-edit-collapse">
                <div class="row">
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
                                {!! Form::submit(trans('main.Save'), ['class' => "btn btn-primary mt-2 btn-sm", 'name' => 'create-language']) !!}
                            </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
                                    <div class="row view-about mt-2 d-block">
                                        @if(auth()->user()->id == $user->id)
                                            
                                                <h5 class="text-dark d-block">{{trans('main.About Me')}}</h5>
                                            @else
                                                <h5 class="text-dark d-block">{{trans('main.About')}} {{ ucwords($user->name) }}</h5>
                                            @endif
                                        @if(!empty($user->about))
                                            
                                            <div class="text-muted text-justify d-block">{{ $user->about }}</div>
                                            @if(auth()->user()->id == $user->id)
                                              
                                                <span type="button" class="text-primary box-modal-edit" data-toggle="modal" data-target="#general-box-4">
                                                    <i class="fad fa-edit"></i>{{trans('main.Update')}}
                                                </span>
                                            @endif
                                        @else 
                                            @if (auth()->user()->id == $user->id)
                                                @if (Helper::checkGender($user->gender) != 'Female')
                                                    <img src="{{ asset('assets/images/creative/talk-m.png')}}" class="creative-profile">
                                                    @else 
                                                    <img src="{{ asset('assets/images/creative/talk-f.png')}}" class="creative-profile">
                                                @endif

                                                <br>
                                                @if(auth()->user()->id == $user->id)
                                                <span type="button" class="text-primary box-modal-edit" data-toggle="modal" data-target="#general-box-4">
                                                    <i class="fad fa-edit"></i>{{trans('main.Update')}}
                                                </span>
                                            @endif
                                            @else
                                                <span class="empty-to-show box my-3 w-100">{{trans('main.No Discription To Show')}}</span>
                                            @endif
                                        @endif
                                    </div>
                                </div>
                                <div class="tab-pane fade show " id="education" role="tabpanel" aria-labelledby="education-tab">
                                    <div class="row education mx-0 mt-3">
                                        <div class="col-sm-12 px-0 ">
                                            @if (count($user->educations) > 0)
                                                @foreach ($user->educations as $education)
                                                    <div class="text-left text-muted view-edu">
                                                        @if (auth()->user()->id == $user->id)
                                                            <div class="dropdown position-absolute options-dropdown">
                                                                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                    <i class="far fa-ellipsis-v"></i>
                                                                </a>
                                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                                    <a class="dropdown-item text-muted" data-toggle="modal" data-target="#education-{{ $education->id }}">{{trans('main.Edit')}}</a>
                                                                    <a class="dropdown-item text-muted" data-toggle="modal" data-target="#education-{{ $education->id }}-delete">{{trans('main.Delete')}}</a>
                                                                </div>
                                                            </div>
                                                        @endif
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
                                                        
                                                        <p class="f-17 text-muted school">
                                                            <p class="f-17 school text-muted ">{{ $education->school }}</p>
                                                        </p>
                                                        <p class="f-14">{{ Helper::getMonthNameYear($education->from) }} - {{ Helper::getMonthNameYear($education->to) }}</p>
                                                        <p class="brief">{{ Str::limit( $education->brief , 90)}}</p>
                                                    </div>
                                                @endforeach
                                            @else 
                                                @if (auth()->user()->id == $user->id)
                                                        @if (Helper::checkGender($user->gender) != 'Female')
                                                            <img src="{{ asset('assets/images/creative/edu-m.png')}}" class="creative-profile">
                                                        @else 
                                                            <img src="{{ asset('assets/images/creative/edu-f.png')}}" class="creative-profile">
                                                        @endif
                                                        <br>
                                                        
                                                @else
                                                    <div class=" view-edu">
                                                        <span class="empty-to-show box my-4">{{trans('main.No Education To Show')}}</span>
                                                    </div>
                                                @endif
                                            @endif
                                            @if (auth()->user()->id == $user->id)
                                            <p>
                                                <span class="box-modal-edit text-primary add" data-toggle="collapse" href="#edu-edit-collapse" role="button" aria-expanded="false" aria-controls="skills-collapse">
                                                    <i class="fal fa-plus mx-1"></i> {{trans('main.Add Education')}}
                                                </span>
                                            </p>
                                            <div class="collapse" id="edu-edit-collapse">
                                                <div class="row mt-3 view-edu">
                                                    <div class="col-md-12">
                                                        {!! Form::open(['action'=>'ProfileController@store', 'method'=>'POST', 'enctype' =>'multipart/form-data', ' novalidate', 'class' => 'needs-validation'], false)!!}
                                                            <div class="no-b  no-r">
                                                                <div class="">
                                                                    <div class="form-row">
                                                                        <div class="col-md-12">
                                                                            <h5 class="card-title">{{trans('main.New Education')}}</h5>
                                                                            <div class="form-row mt-1">
                                                                                <div class="form-group col-md-6 col-sm-12 m-0">
                                                                                    {!! Form::label('level', trans('main.Level') . '<span class="valid-star">*</span>', ['class' => 'col-form-label s-12'], false) !!}
                                                                                    {!! Form::select('level', Helper::educationalLevel(), '', ['class' => "form-control r-0 light s-12", 'placeholder' => trans('main.Level'), 'id' => 'level'])!!}
                                                                                    <div class="valid-feedback">
                                                                                        {{trans('main.Looks Good')}}
                                                                                    </div>
                                                                                    <div class="invalid-feedback">
                                                                                        {{trans('main.Please Provide a Valid Input')}}
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group col-md-6 col-sm-12 m-0">
                                                                                    {!! Form::label('school', trans('main.School') . '<span class="valid-star">*</span>', ['class' => 'col-form-label s-12'], false) !!}
                                                                                    {!! Form::text('school', '', ['class' => "form-control r-0 light s-12", 'placeholder' => trans('main.School'), 'id' => 'school'])!!}
                                                                                    <div class="valid-feedback">
                                                                                        {{trans('main.Looks Good')}}
                                                                                    </div>
                                                                                    <div class="invalid-feedback">
                                                                                        {{trans('main.Please Provide a Valid Input')}}
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group col-md-6 col-sm-12 m-0">
                                                                                    {!! Form::label('degree', trans('main.Certificate Title') . '<span class="valid-star">*</span>', ['class' => 'col-form-label s-12'], false) !!}
                                                                                    {!! Form::text('degree', '', ['class' => "form-control r-0 light s-12", 'placeholder' => trans('main.Certificate Title'), 'id' => 'degree'])!!}
                                                                                    <div class="valid-feedback">
                                                                                        {{trans('main.Looks Good')}}
                                                                                    </div>
                                                                                    <div class="invalid-feedback">
                                                                                        {{trans('main.Please Provide a Valid Input')}}
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group col-md-6 col-sm-12 m-0">
                                                                                    {!! Form::label('from', trans('main.Started Date') . '<span class="valid-star">*</span>', ['class' => 'col-form-label s-12'], false) !!}
                                                                                    {!! Form::text('from', '', ['class' => "form-control r-0 light s-12 date-picker", 'placeholder' => trans('main.Started Date'), 'id' => 'from'])!!}
                                                                                    <div class="valid-feedback">
                                                                                        {{trans('main.Looks Good')}}
                                                                                    </div>
                                                                                    <div class="invalid-feedback">
                                                                                        {{trans('main.Please Provide a Valid Input')}}
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group col-md-6 col-sm-12 m-0">
                                                                                    {!! Form::label('to',  trans('main.Finished Date') . '<span class="valid-star">*</span>', ['class' => 'col-form-label s-12'], false) !!}
                                                                                    {!! Form::text('to', '', ['class' => "form-control r-0 light s-12 date-picker", 'placeholder' => trans('main.Finished Date'), 'id' => 'to'])!!}
                                                                                    <div class="valid-feedback">
                                                                                        {{trans('main.Looks Good')}}
                                                                                    </div>
                                                                                    <div class="invalid-feedback">
                                                                                        {{trans('main.Please Provide a Valid Input')}}
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group col-md-6 col-sm-12 m-0">
                                                                                    {!! Form::label('ref', trans('main.Reference Link'), ['class' => 'col-form-label s-12'], false) !!}
                                                                                    {!! Form::text('ref', '', ['class' => "form-control r-0 light s-12", 'placeholder' => trans('main.Reference Link'), 'id' => 'ref'])!!}
                                                                                    <div class="valid-feedback">
                                                                                        {{trans('main.Looks Good')}}
                                                                                    </div>
                                                                                    <div class="invalid-feedback">
                                                                                        {{trans('main.Please Provide a Valid Input')}}
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group col-12 m-0">
                                                                                    {!! Form::label('brief', trans('main.Brief'), ['class' => 'col-form-label s-12']) !!}
                                                                                    {!! Form::textarea('brief', '', ['class' => "form-control r-0 light s-12", 'placeholder' => trans('main.Write Brief'), 'id' => 'brief'])!!}
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
                                                            <div class='edu-submit-btn'>
                                                                {!! Form::submit(trans('main.Save'), ['class' => "btn btn-primary mt-2 btn-sm", 'name' => 'create-education']) !!}
                                                            </div>
                                                        {!! Form::close() !!}
                                                    </div>
                                                </div>
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade show" id="experience" role="tabpanel" aria-labelledby="experience-tab">
                                    <div class="row education mx-0 mt-3">
                                        <div class="col-sm-12 px-0 ">
                                            @if (count($user->experiences) > 0)
                                                @foreach ($user->experiences as $experience)
                                                    <div class="text-left text-muted view-edu">
                                                        @if(auth()->user()->id == $user->id)
                                                            <div class="dropdown position-absolute options-dropdown">
                                                                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                    <i class="far fa-ellipsis-v"></i>
                                                                </a>
                                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                                    <a class="dropdown-item text-muted" data-toggle="modal" data-target="#experience-{{ $experience->id }}">{{trans('main.Edit')}}</a>
                                                                    <a class="dropdown-item text-muted" data-toggle="modal" data-target="#experience-{{ $experience->id }}-delete">{{trans('main.Delete')}}</a>
                                                                </div>
                                                            </div>
                                                        @endif
                                                        <span class="mb-0 degree text-dark">
                                                            <h6 class="mb-0">
                                                                @if (!empty($experience->job_title))
                                                                        {{ Helper::getCategoryName($experience->job_title) }}
                                                                @endif
                                                                @if(!empty($experience->company_name))
                                                                {{trans('main.at')}} 
                                                                 <span class="text-muted ref" >{{ $experience->company_name }}</span>
                                                                   
                                                                @endif
                                                            </h6>
                                                        </span>
                                                        
                                                        <p class="date">{{ Helper::getMonthNameYear($experience->from) }} - {{ Helper::getMonthNameYear($experience->to) }}</p>
                                                        
                                                    </div>
                                                @endforeach
                                                
                                            @else 
                                                @if (auth()->user()->id == $user->id)
                                                    @if (Helper::checkGender($user->gender) != 'Female')
                                                        <img src="{{ asset('assets/images/creative/edu-m.png')}}" class="creative-profile">
                                                    @else 
                                                        <img src="{{ asset('assets/images/creative/edu-f.png')}}" class="creative-profile">
                                                    @endif
                                                    <br>
                                                @else
                                                    <div class=" view-edu">
                                                        <span class="empty-to-show box my-4">{{trans('main.No Experiences To Show')}}</span>
                                                    </div>
                                                @endif
                                            @endif
                                            @if (auth()->user()->id == $user->id)
                                            <p>
                                                <span class="box-modal-edit text-primary add" data-toggle="collapse" href="#exp-edit-collapse" role="button" aria-expanded="false" aria-controls="skills-collapse">
                                                    <i class="fal fa-plus mx-1"></i> {{trans('main.Add Experience')}}
                                                </span>
                                            </p>
                                            <div class="collapse" id="exp-edit-collapse">
                                                <div class="row view-edu">
                                                    <div class="col-sm-12">
                                                        {!! Form::open(['action'=> 'ProfileController@store', 'method'=>'POST', 'enctype' =>'multipart/form-data', 'class' => 'w-100'])!!}
                                                        <h5 class="mt-4">{{trans('main.New Experience')}}</h5>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="row mt-1 create-field">
                                                                    <div class="form-group col-md-4 col-sm-12 m-0">
                                                                        {!! Form::label('job_title', trans('main.Job Title').'<span class="valid-star">*</span>', ['class' => 'col-form-label s-12'], false) !!}
                                                                        {!! Form::select('job_title', Helper::categoriesNames(), '',  ['class' => "form-control r-0 light s-12 selectpicker",  'data-live-search' => "true", 'placeholder' => trans('main.Job Title')])!!}
                                                                    </div>
                                                                    <div class="form-group col-md-4 col-sm-12  m-0">
                                                                        {!! Form::label('company_name', trans('main.Company Name').'<span class="valid-star">*</span>', ['class' => 'col-form-label s-12'], false) !!}
                                                                        {!! Form::text('company_name', '',  ['id' => 'middle_name', 'class' => "form-control r-0 light s-12", 'placeholder' => trans('main.Company Name'), 'id' => 'job_title'])!!}
                                                                        <div class="valid-feedback">
                                                                            {{trans('main.Looks Good')}}
                                                                        </div>
                                                                        <div class="invalid-feedback">
                                                                            {{trans('main.Please Provide a Valid Input')}}
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group col-md-4 col-sm-12  m-0">
                                                                        {!! Form::label('ref', trans('main.Reference Link'), ['class' => 'col-form-label s-12'], false) !!}
                                                                        {!! Form::text('ref', '', ['class' => "form-control r-0 light s-12", 'placeholder' => trans('main.Reference Link'), 'id' => 'ref'])!!}
                                                                        <div class="valid-feedback">
                                                                            {{trans('main.Looks Good')}}
                                                                        </div>
                                                                        <div class="invalid-feedback">
                                                                            {{trans('main.Please Provide a Valid Input')}}
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row mt-1">
                                                                    <div class="form-group col-md-6 m-0">
                                                                        {!! Form::label('from', trans('main.Started Date'), ['class' => 'col-form-label s-12'], false) !!}
                                                                        {!! Form::text('from', '',  ['class' => "form-control r-0 light s-12 date-picker", 'placeholder' => trans('main.Started Date'), 'id' => 'from'])!!}
                                                                    </div>
                                
                                                                    <div class="form-group col-md-6 m-0">
                                                                        {!! Form::label('to', trans('main.Finished Date'), ['class' => 'col-form-label s-12'], false) !!}
                                                                        {!! Form::text('to', '',  ['class' => "form-control r-0 light s-12 date-picker", 'placeholder' => trans('main.Finished Date'), 'id' => 'to'])!!}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div class="">
                                                        {!! Form::submit(trans('main.Save'), ['class' => "btn btn-primary mt-2 btn-sm ex-submit-btn", 'name' => 'create-experience']) !!}
                                                        {!! Form::close() !!}
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                            @endif

                                        </div>
                                    </div>
                                   
                                </div>
                                <div class="tab-pane fade show" id="portfolio" role="tabpanel" aria-labelledby="portfolio-tab">
                                    <div class="row view-gallery gallery">
                                        <div class="col-lg-12">

                                            @if (count(Helper::galleryByUser($user->id)) > 0)
                                                <div class="gallery pt-2">
                                                    @foreach(Helper::galleryByUser($user->id ) as $image)
                                                        <div class="image-box">
                                                            <img src="{{ asset('uploads/images/gallery_images/'.$image->gallery_image) }}" alt="" class="img-fluid gallery_image" id ="preview_image" data-toggle="modal" data-target="#gallery-{{$image->id}}">
                                                                @if (auth()->user()->id == $user->id)
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
                                                                    <h5 class="modal-title" id="exampleModalLabel">{{trans('main.Delete Image')}}</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                {!! Form::open(['action'=> ['ProfileController@update', $user->id], 'method'=>'POST', 'enctype' =>'multipart/form-data', 'class' => 'w-100'])!!}
                                                                    <div class="modal-body">
                                                                        {{trans('main.Are You Sure To Delete Photo?')}}
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        {!! Form::submit(trans('main.Delete'), ['class' => "btn btn-primary", 'name' => 'delete-gallery-image']) !!}
                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{trans('main.Close')}}</button>
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
                                                @if(auth()->user()->id != $user->id)
                                                    <div class=" mt-3 view-gallery">
                                                        <span class="empty-to-show box my-4">{{trans('main.No Portfolio To Show')}}</span>
                                                    </div>
                                                @endif
                                            @endif
                                            @if (auth()->user()->id == $user->id)
                                                {!! Form::open(['action'=> ['ProfileController@store', $user->id], 'method'=>'POST', 'enctype' =>'multipart/form-data' ])!!}
                                                
                                                    <div class="row">
                                                        <div class="form-group app-label mt-2 w-100">
                                                            {!! Form::file('gallery_image[]', [ 'hidden', 'id' => 'gallery_image', 'multiple', 'required'])!!}
                                                            <label  class="empty-to-show box mx-4" for="gallery_image">
                                                                {{trans('main.Upload Photos')}}
                                                            </label>
                                                            <div class="previewer px-0"></div>
                                                            
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="row">
                                                        <div class="col-lg-12 mt-2 text-center">
                                                            {!! Form::submit(trans('main.Save'), ['class' => "btn btn-primary mt-2 btn-sm", 'name' => 'create-gallery']) !!}
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

@include('inc.home.foot')

@if(auth()->check())
    @if(auth()->user()->id == $user->id)

        <!-- Governemt ID Veification Modal -->
        <div class="modal modal-view fade gov-modal" id="gov_id-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5>{{trans('main.Government ID')}}</h5>
                </div>
                {!! Form::open(['action'=> ['ProfileController@update', $user->id], 'method'=>'POST', 'enctype' =>'multipart/form-data' ])!!}
                <div class="modal-body">
                    <div class="form-group app-label">
                        <label  class="d-block" for="gov_id">
                            <img src="{{ asset('uploads/images/profile_images/default.jpg') }}" alt="" class="d-block m-auto rounded" id ="preview_image" title="Insert Your Government ID  Photo">
                        </label>
                        {!! Form::file('gov_id', [ 'hidden', 'id' => 'gov_id'])!!}
                        <div class="custom-control m-0 custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="customCheck2" required>
                            <label class="custom-control-label" for="customCheck2">{{trans('main.Privacy policy : Image Will Be reviewd from our adminstrators then will be Removed Completely From Databases')}}
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="form-group app-label">
                        <div class="row">
                            <div class="col-lg-12 mt-2">
                                {!! Form::submit(trans('main.Send'), ['class' => "btn btn-primary mt-2 btn-sm", 'name' => 'edit-gov_id']) !!}
                            </div>
                        </div>
                    </div>
                </div>
                {!! Form::hidden('_method', 'PUT') !!}
                {!! Form::close() !!}
                    <script>
                    const inputFile = document.getElementById('gov_id');
                    const preview = document.getElementById('preview');
                    const preview_image = document.getElementById('preview_image');
                    
                    inputFile.addEventListener('change', function(){
                        const file = this.files[0];
                        
                        if(file){
                            console.log(file);
                            const reader = new FileReader();
                    
                            reader.addEventListener("load", function(){
                                preview_image.setAttribute("src", this.result);
                                console.log(this);
                            })
                    
                            reader.readAsDataURL(file);
                        } 
                    })
                    </script>
                </div>
            </div>
            </div>
        </div>   

        <!-- Mobile Veification Modal -->
        <div class="modal fade phone_verfication_modal  mobile-modal" tabindex="-1" role="dialog" aria-hidden="true"></div>

        <!-- General Box 1 Modal -->
        <div class="modal fade" id="general-box-1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{trans('main.Your Personal Informations')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                {!! Form::open(['action'=> ['ProfileController@update', $user->id], 'method'=>'POST', 'enctype' =>'multipart/form-data' ])!!}
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group app-label mt-2">
                                        <label  class="club_avatar employer-avatar d-block m-auto" for="profile_image">
                                            @if (!empty($user->profile_image))
                                                <img src="{{ asset('uploads/images/profile_images/'.$user->profile_image) }}" alt="" class=" d-block" id ="preview_image">
                                            @else 
                                                <img src="{{ asset('uploads/images/profile_images/default.jpg') }}" alt="" class="d-block" id ="preview_image">
                                            @endif
                                        </label>
                                        <span class="val-tip muted-text">{{trans('main.Profile Image Type Has To Be An Image with Max Size: 2MB')}}</span>
                                        {!! Form::file('profile_image', [ 'hidden', 'id' => 'profile_image'])!!}
                                    </div>
                                </div>
                                <script>
                                    const inputFile = document.getElementById('profile_image');
                                    const preview = document.getElementById('preview');
                                    const preview_image = document.getElementById('preview_image');
                
                                    inputFile.addEventListener('change', function(){
                                        const file = this.files[0];
                                        
                                        if(file){
                                            console.log(file);
                                            const reader = new FileReader();
                
                                            reader.addEventListener("load", function(){
                                                preview_image.setAttribute("src", this.result);
                                                console.log(this);
                                            })
                                            reader.readAsDataURL(file);
                                        } 
                                    })
                                </script>
                            
                                <div class="col-md-6">
                                    <div class="form-group app-label mt-2">
                                        <label class="text-muted">{{trans('main.First Name')}}<span class="valid-star">*</span></label>
                                        <div class="form-button">
                                            {!! Form::text('first_name', $user->first_name,  ['class' => "form-control r-0 light s-12", 'placeholder' =>trans('main.First Name') ])!!}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group app-label mt-2">
                                        <label class="text-muted">{{trans('main.Last Name')}}<span class="valid-star">*</span></label>
                                        <div class="form-button">
                                            {!! Form::text('middle_name', $user->middle_name,  ['id' => 'middle_name', 'class' => "form-control r-0 light s-12", 'placeholder' => trans('main.Last Name')])!!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group app-label mt-2">
                                <label class="text-muted">{{trans('main.Job Role')}}<span class="valid-star">*</span></label>
                            </div>
                            <div class="form-group app-label">
                                @if (auth()->user()->category_id)
                                    <select class="form-control resume" id="example-getting-started" multiple="multiple" name="category_id[]" size="4" value="{{auth()->user()->category_id}}">
                                    
                                        @foreach (Helper::categoriesNames() as $key => $category)
                                        @if (auth()->user()->category_id)
                                            
                                            @if (Helper::userCatCheck(auth()->user()->category_id,$key ))
                                                <option value="{{$key}}" selected>{{$category}}</option>
                                            @else 
                                                <option value="{{$key}}">{{$category}}</option>
                                            @endif
                                        @endif
                                    @endforeach
                                @else 
                                    <select class="form-control resume" id="example-getting-started" multiple="multiple" name="category_id[]" size="4">
                                    @foreach (Helper::categoriesNames() as $key => $category)
                                        <option value="{{$key}}">{{$category}}</option>
                                    @endforeach
                                @endif
                                    </select>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group app-label mt-2">
                                        <label class="text-muted">{{trans('main.Country')}}<span class="valid-star">*</span></label>
                                        {!! Form::select('country', Helper::countries(), $user->country,  ['class' => "form-control r-0 light s-1 selectpicker", 'placeholder' => trans('main.Country'), 'id' => 'country', 'data-live-search' => "true"])!!}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group app-label mt-2">
                                        <label class="text-muted">{{trans('main.City')}}<span class="valid-star">*</span></label>
                                        {!! Form::text('city', $user->city,  ['id' => 'city', 'class' => "form-control r-0 light s-12", 'placeholder' => trans('main.City')])!!}
                                        <!--@if (!empty($user->city))-->
                                        <!--    <select name='city' class="form-control r-0 light s-12 selectpicker cities" id="city_yes" placeholder = '{{trans('main.City')}}' data-live-search="true"> -->
                                        <!--        @foreach($user_city as $key => $value)-->
                                        <!--            <option name='Kabul' value="{{$key}}" {{auth()->user()->city == $key ? 'selected="selected"':''}} country_code=''>{{$value}} </option>-->
                                        <!--        @endforeach-->
                                        <!--    </select>-->
                                        <!--@else -->
                                        <!--    <select name='city' class="form-control r-0 light s-12 selectpicker cities" id="city" placeholder = '{{trans('main.City')}}' data-live-search="true"> -->
                                        <!--        @foreach($user_city as $key => $value)-->
                                        <!--            <option name='Kabul' value="{{$key}}" {{auth()->user()->city == $key ? 'selected="selected"':''}} country_code=''>{{$value}} </option>-->
                                        <!--        @endforeach-->
                                        <!--    </select>-->
                
                                        <!--@endif-->
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group app-label mt-2">
                                        <label class="text-muted">{{trans('main.Town')}}<span class="valid-star">*</span></label>
                                        {!! Form::text('town', $user->town,  ['class' => "form-control r-0 light s-1", 'placeholder' => trans('main.Town'), 'id' => 'town'])!!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                
                {!! Form::submit(trans('main.Save'), ['class' => "btn btn-primary btn-sm", 'name' => 'general-box-1']) !!}
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">{{trans("main.Close")}}</button>
                </div>
                {!! Form::hidden('_method', 'PUT') !!}
                {!! Form::close() !!}
            </div>
            </div>
        </div>

        <!-- General Box 2 Modal -->
        <div class="modal fade" id="general-box-2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{trans('main.Your Personal Informations')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                {!! Form::open(['action'=> ['ProfileController@update', $user->id], 'method'=>'POST', 'enctype' =>'multipart/form-data' ])!!}
                <div class="modal-body">
                    <div class="row top-section">

                        <div class="col-md-12">
                            <div class="form-group app-label mt-2">
                                <label class="text-muted">{{trans('main.Email')}}</label>
                                <div class="form-button">
                                    {!! Form::text('email', $user->email ,  ['id' => 'email', 'class' => "form-control rounded", 'placeholder' => trans('main.Category'), 'readonly'])!!}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group app-label mt-2">
                                <label class="text-muted">{{trans('main.Phone')}}<span class="valid-star">*</span></label>
                                <div class="form-button">
                                    {!! Form::text('phone', $user->phone ,  ['class' => "form-control r-0 light s-12", 'placeholder' => '+8805112345678', 'id' => 'phone'])!!}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group app-label mt-2">
                                <label class="text-muted"> {{trans('main.Experience')}} <span class="valid-star">*</span></label>
                                {!! Form::select('experience', Helper::experience( ), $user->experience,  ['class' => "form-control resume", 'placeholder' => trans('main.Experience')])!!}
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-group app-label mt-2">
                                <label class="text-muted">{{trans('main.Monthly Salary')}}<span class="valid-star">*</span></label>
                                {!! Form::select('average_salary', Helper::minimalSalary(),$user->average_salary,  ['class' => "form-control resume", 'placeholder' => trans('main.Monthly Salary'), 'id' => 'average_salary'])!!}
                            </div>
                            <div class="form-group app-label mt-2 pl-4">
                                @if ($user->salary_hide == 1)
                                    <input type="checkbox" id="salary_hide" name="salary_hide" class="custom-control-input" value ="0" Checked>
                                @else 
                                    <input type="checkbox" id="salary_hide" name="salary_hide" class="custom-control-input" value ="1" >
                                @endif 
                                <label class="custom-control-label ml-1 text-muted" for="salary_hide">{{trans('main.Confidential')}}</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                
                {!! Form::submit(trans('main.Save'), ['class' => "btn btn-primary btn-sm", 'name' => 'general-box-2']) !!}
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">{{trans("main.Close")}}</button>
                </div>
                {!! Form::hidden('_method', 'PUT') !!}
                {!! Form::close() !!}
            </div>
            </div>
        </div>

        <!-- General Box 3 Modal -->
        <div class="modal fade" id="general-box-3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{trans('main.Your Personal Informations')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                {!! Form::open(['action'=> ['ProfileController@update', $user->id], 'method'=>'POST', 'enctype' =>'multipart/form-data' ])!!}
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group app-label mt-2">
                                <label class="text-muted">{{trans('main.Nationality')}}<span class="valid-star">*</span></label>
                                {!! Form::select('nationality', Helper::nationalities() , $user->nationality,  ['class' => "form-control r-0 light s-12 selectpicker", 'placeholder' => trans('main.Nationality'), 'id' => 'nationality', 'data-live-search' => "true"])!!}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group app-label mt-2">
                                <label class="text-muted">{{trans('main.Religion')}}<span class="valid-star">*</span></label>
                                {!! Form::select('religion', Helper::religions() , $user->religion,  ['class' => "form-control r-0 light s-12 ", 'placeholder' => trans('main.Religion'), 'id' => 'religion'])!!}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group app-label mt-2">
                                {!! Form::label('legal', trans('main.Legal State'), ['class' => 'text-muted'], false) !!}
                                {!! Form::select('legal', Helper::legal() ,$user->legal,  ['class' => "form-control r-0 light s-12", 'placeholder' => trans('main.Legal State'), 'id' => 'legal'])!!}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group app-label mt-2">
                                <label class="text-muted">{{trans('main.Gender')}}<span class="valid-star">*</span></label>
                                {!! Form::select('gender', Helper::gender(), $user->gender,  ['class' => "form-control r-0 light s-12", 'placeholder' => trans('main.Gender'), 'id' => 'gender'])!!}
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group app-label mt-2">
                                <label class="text-muted">{{trans('main.Address')}}</label>
                                {!! Form::text('address', $user->address,  ['class' => "form-control resume", 'placeholder' => trans('main.Enter Address'), 'id' => 'address'])!!}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group app-label mt-2">
                                <label class="text-muted">{{trans('main.Birth Date')}}<span class="valid-star">*</span></label>
                                {!! Form::text('birth', $user->birth,  ['class' => "form-control r-0 light s-12 date-picker", 'placeholder' => trans('main.Birth Date'), 'id' => 'date-picker'])!!}
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-group app-label mt-2">
                                <label class="text-muted">{{trans('main.Married')}}<span class="valid-star">*</span></label>
                                {!! Form::select('married', Helper::married(), $user->married,  ['class' => "form-control r-0 light s-12", 'placeholder' => 'Not Specified', 'id' => 'married'])!!}
                            </div>
                        </div>
                    </div>
                    <h5 class="mt-2">{{trans('main.Upload CV')}}:</h5>
                    <div class="row">
                        @if (!empty($user->cv))
                            <div class="col-md-6">
                                <div class="input-group app-label  mt-2 mb-2">
                                    <div class="custom-file">
                                        <input type="file" name ="cv" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
                                        <label class="custom-file-label rounded"><i class="mdi mdi-cloud-upload mr-1"></i> {{trans('main.Update CV')}}</label>
                                    </div>
                                    <spn class="val-tip muted-text text-left">{{trans('main.Document Type Has To Be An Image(jpeg,png,jpg,gif,svg) Or PDF with Max Size: 3MB')}}</spn>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group app-label  mt-2 mb-2">
                                    <a class="btn btn-primary btn-sm" target="_blank" title="View CV" href= "{{url(asset('uploads/files/cv/'.$user->cv))}}">{{trans('main.Old CV')}}
                                    </a>  
                                </div>
                            </div>
                        @else 
                            <div class="col-md-6">
                                <div class="input-group app-label  mt-2 mb-2">
                                    <div class="custom-file">
                                        <input type="file" name ="cv" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
                                        <label class="custom-file-label rounded"><i class="mdi mdi-cloud-upload mr-1"></i> {{trans('main.Upload CV')}}</label>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                
                </div>
                <div class="modal-footer">
                
                {!! Form::submit(trans('main.Save'), ['class' => "btn btn-primary btn-sm", 'name' => 'general-box-3']) !!}
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">{{trans("main.Close")}}</button>
                </div>
                {!! Form::hidden('_method', 'PUT') !!}
                {!! Form::close() !!}
            </div>
            </div>
        </div>

        <!-- General Box 4 Modal -->
        <div class="modal fade" id="general-box-4" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{trans('main.Your Personal Informations')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                {!! Form::open(['action'=> ['ProfileController@update', $user->id], 'method'=>'POST', 'enctype' =>'multipart/form-data' ])!!}
                <div class="modal-body">
                <div class="row">
                        <div class="col-md-12" >
                            <div class="form-group app-label mt-2">
                                <label class="text-muted">{{trans('main.About Me')}}</label>
                                {!! Form::textarea('about', $user->about,  ['class' => "form-control r-0 light s-12", 'placeholder' => trans('main.About Me'), 'id' => 'about'])!!}
                            </div>
                        </div>
                </div>
                
                </div>
                <div class="modal-footer">
                
                {!! Form::submit(trans('main.Save'), ['class' => "btn btn-primary btn-sm", 'name' => 'general-box-4']) !!}
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">{{trans("main.Close")}}</button>
                </div>
                {!! Form::hidden('_method', 'PUT') !!}
                {!! Form::close() !!}
            </div>
            </div>
        </div>

        <!-- Social Modal -->
        <div class="modal fade" id="social-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{trans('main.Social Media')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    @if(count($user->socials) > 0)
                    @foreach ($user->socials as $social)
                        {!! Form::open(['action'=> ['ProfileController@update', $user->id], 'method'=>'POST', 'enctype' =>'multipart/form-data', ' novalidate', 'class' => 'needs-validation'])!!}
                            <div class=" no-b  no-r">
                                <div class="">
                                    <div class="form-row">
                                        <div class="col-md-12">
                                            <div class="form-row mt-1">
                                                <div class="form-group col-md-4 col-sm-6 m-0">
                                                    {!! Form::label('facebook', trans('main.Facebook'), ['class' => 'col-form-label s-12']) !!}
                                                    {!! Form::text('facebook', $social->facebook, ['class' => "form-control r-0 light s-12", 'placeholder' => trans('main.Facebook'), 'id' => 'facebook'])!!}
                                                    <div class="valid-feedback">
                                                        {{trans('main.Looks Good')}}
                                                    </div>
                                                    <div class="invalid-feedback">
                                                        {{trans('main.Please Provide a Valid Input')}}
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-4 col-sm-6 m-0">
                                                    {!! Form::label('twitter', trans('main.Twitter'), ['class' => 'col-form-label s-12']) !!}
                                                    {!! Form::text('twitter', $social->twitter, ['class' => "form-control r-0 light s-12", 'placeholder' => trans('main.Twitter'), 'id' => 'twitter'])!!}
                                                    <div class="valid-feedback">
                                                        {{trans('main.Looks Good')}}
                                                    </div>
                                                    <div class="invalid-feedback">
                                                        {{trans('main.Please Provide a Valid Input')}}
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-4 col-sm-6 m-0">
                                                    {!! Form::label('google_plus', trans('main.Google Plus'), ['class' => 'col-form-label s-12']) !!}
                                                    {!! Form::text('google_plus', $social->google_plus, ['class' => "form-control r-0 light s-12", 'placeholder' => trans('main.Google Plus'), 'id' => 'google_plus'])!!}
                                                    <div class="valid-feedback">
                                                        {{trans('main.Looks Good')}}
                                                    </div>
                                                    <div class="invalid-feedback">
                                                        {{trans('main.Please Provide a Valid Input')}}
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-4 col-sm-6 m-0">
                                                    {!! Form::label('linkedin', trans('main.Linkedin'), ['class' => 'col-form-label s-12']) !!}
                                                    {!! Form::text('linkedin', $social->linkedin, ['class' => "form-control r-0 light s-12", 'placeholder' => trans('main.Linkedin'), 'id' => 'linkedin'])!!}
                                                    <div class="valid-feedback">
                                                        {{trans('main.Looks Good')}}
                                                    </div>
                                                    <div class="invalid-feedback">
                                                        {{trans('main.Please Provide a Valid Input')}}
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-4 col-sm-6 m-0">
                                                    {!! Form::label('pinterest', trans('main.Pinterest'), ['class' => 'col-form-label s-12']) !!}
                                                    {!! Form::text('pinterest', $social->pinterest, ['class' => "form-control r-0 light s-12", 'placeholder' => trans('main.Pinterest'), 'id' => 'pinterest'])!!}
                                                    <div class="valid-feedback">
                                                        {{trans('main.Looks Good')}}
                                                    </div>
                                                    <div class="invalid-feedback">
                                                        {{trans('main.Please Provide a Valid Input')}}
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-4 col-sm-6 m-0">
                                                    {!! Form::label('instagram', trans('main.Instagram'), ['class' => 'col-form-label s-12']) !!}
                                                    {!! Form::text('instagram', $social->instagram, ['class' => "form-control r-0 light s-12", 'placeholder' => trans('main.Instagram'), 'id' => 'instagram'])!!}
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
                            <div class="row p-3">
                                {!! Form::text('social_id', $social->id, ['hidden']) !!}
                                {!! Form::hidden('_method', 'PUT') !!}
                                {!! Form::submit(trans('main.Edit'), ['class' => "btn btn-primary btn-sm mx-1", 'name' => 'edit-social']) !!}
                                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">{{trans("main.Close")}}</button>
                            </div>
                        {!! Form::close() !!}
                    @endforeach
                @else
                {!! Form::open(['action'=> 'ProfileController@store', 'method'=>'POST', 'enctype' =>'multipart/form-data', ' novalidate', 'class' => 'needs-validation'])!!}
                    <div class=" no-b  no-r">
                        <div class="">
                            <div class="form-row">
                                <div class="col-md-12">
                                    <h5 class="card-title">{{trans('main.My Social Media')}}</h5>
                                    <div class="form-row mt-1">
                                        <div class="form-group col-md-4 col-sm-6 m-0">
                                            {!! Form::label('facebook', trans('main.Facebook'), ['class' => 'col-form-label s-12']) !!}
                                            {!! Form::text('facebook','', ['class' => "form-control r-0 light s-12", 'placeholder' => trans('main.Facebook'), 'id' => 'facebook'])!!}
                                            <div class="valid-feedback">
                                                {{trans('main.Looks Good')}}
                                            </div>
                                            <div class="invalid-feedback">
                                                {{trans('main.Please Provide a Valid Input')}}
                                            </div>
                                        </div>
                                        <div class="form-group col-md-4 col-sm-6 m-0">
                                            {!! Form::label('twitter', trans('main.Twitter'), ['class' => 'col-form-label s-12']) !!}
                                            {!! Form::text('twitter', '', ['class' => "form-control r-0 light s-12", 'placeholder' => trans('main.Twitter'), 'id' => 'twitter'])!!}
                                            <div class="valid-feedback">
                                                {{trans('main.Looks Good')}}
                                            </div>
                                            <div class="invalid-feedback">
                                                {{trans('main.Please Provide a Valid Input')}}
                                            </div>
                                        </div>
                                        <div class="form-group col-md-4 col-sm-6 m-0">
                                            {!! Form::label('google_plus', trans('main.Google Plus'), ['class' => 'col-form-label s-12']) !!}
                                            {!! Form::text('google_plus', '', ['class' => "form-control r-0 light s-12", 'placeholder' => trans('main.Google Plus'), 'id' => 'google_plus'])!!}
                                            <div class="valid-feedback">
                                                {{trans('main.Looks Good')}}
                                            </div>
                                            <div class="invalid-feedback">
                                                {{trans('main.Please Provide a Valid Input')}}
                                            </div>
                                        </div>
                                        <div class="form-group col-md-4 col-sm-6 m-0">
                                            {!! Form::label('linkedin', trans('main.Linkedin'), ['class' => 'col-form-label s-12']) !!}
                                            {!! Form::text('linkedin', '', ['class' => "form-control r-0 light s-12", 'placeholder' => trans('main.Linkedin'), 'id' => 'linkedin'])!!}
                                            <div class="valid-feedback">
                                                {{trans('main.Looks Good')}}
                                            </div>
                                            <div class="invalid-feedback">
                                                {{trans('main.Please Provide a Valid Input')}}
                                            </div>
                                        </div>
                                        <div class="form-group col-md-4 col-sm-6 m-0">
                                            {!! Form::label('pinterest', trans('main.Pinterest'), ['class' => 'col-form-label s-12']) !!}
                                            {!! Form::text('pinterest', '', ['class' => "form-control r-0 light s-12", 'placeholder' => trans('main.Pinterest'), 'id' => 'pinterest'])!!}
                                            <div class="valid-feedback">
                                                {{trans('main.Looks Good')}}
                                            </div>
                                            <div class="invalid-feedback">
                                                {{trans('main.Please Provide a Valid Input')}}
                                            </div>
                                        </div>
                                        <div class="form-group col-md-4 col-sm-6 m-0">
                                            {!! Form::label('instagram', trans('main.Instagram'), ['class' => 'col-form-label s-12']) !!}
                                            {!! Form::text('instagram', '', ['class' => "form-control r-0 light s-12", 'placeholder' => trans('main.Instagram'), 'id' => 'instagram'])!!}
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
                    <div class="row p-3">
                        {!! Form::submit(trans('main.Save'), ['class' => "btn btn-primary mx-1", 'name' => 'create-social']) !!}
                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">{{trans("main.Close")}}</button>
                    </div>
                {!! Form::close() !!}
                @endif
                </div>
            </div>
            </div>
        </div>

        <!-- Education Modals -->
        @if (!empty($user->educations))
            @foreach ($user->educations as $education)
                <!-- Edit Modal -->
                <div class="modal fade" id="education-{{ $education->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">{{trans('main.Edit Education')}}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                            {!! Form::open(['action'=>['ProfileController@update', $user->id ], 'method'=>'POST', 'enctype' =>'multipart/form-data', ' novalidate', 'class' => 'needs-validation'])!!}
                            <div class="modal-body">
                                <div class="row mt-1">
                                    <div class="form-group col-md-6 col-sm-12 m-0">
                                        {!! Form::label('title', trans('main.Title'), ['class' => 'col-form-label s-12']) !!}
                                        {!! Form::text('title', $education->title, ['class' => "form-control r-0 light s-12", 'placeholder' => trans('main.Title'), 'id' => 'title'])!!}
                                        <div class="valid-feedback">
                                            {{trans('main.Looks Good')}}
                                        </div>
                                        <div class="invalid-feedback">
                                            {{trans('main.Please Provide a Valid Input')}}
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6 col-sm-12 m-0">
                                        {!! Form::label('level', trans('main.Level') . '<span class="valid-star">*</span>', ['class' => 'col-form-label s-12'], false) !!}
                                        {!! Form::select('level', Helper::educationalLevel(), $education->level, ['class' => "form-control r-0 light s-12", 'placeholder' => trans('main.Level'), 'id' => 'level'])!!}
                                        <div class="valid-feedback">
                                            {{trans('main.Looks Good')}}
                                        </div>
                                        <div class="invalid-feedback">
                                            {{trans('main.Please Provide a Valid Input')}}
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6 col-sm-12 m-0">
                                        {!! Form::label('school', trans('main.School') . '<span class="valid-star">*</span>', ['class' => 'col-form-label s-12'], false) !!}
                                        {!! Form::text('school', $education->school, ['class' => "form-control r-0 light s-12", 'placeholder' => trans('main.School'), 'id' => 'school'])!!}
                                        <div class="valid-feedback">
                                            {{trans('main.Looks Good')}}
                                        </div>
                                        <div class="invalid-feedback">
                                            {{trans('main.Address')}}
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6 col-sm-12 m-0">
                                        {!! Form::label('degree', trans('main.Certificate Title') . '<span class="valid-star">*</span>', ['class' => 'col-form-label s-12'], false) !!}
                                        {!! Form::text('degree', $education->degree, ['class' => "form-control r-0 light s-12", 'placeholder' => trans('main.Certificate Title'), 'id' => 'degree'])!!}
                                        <div class="valid-feedback">
                                            {{trans('main.Looks Good')}}
                                        </div>
                                        <div class="invalid-feedback">
                                            {{trans('main.Please Provide a Valid Input')}}
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6 col-sm-12 m-0">
                                        {!! Form::label('ref', trans('main.Reference Link') . '<span class="valid-star">*</span>', ['class' => 'col-form-label s-12'], false) !!}
                                        {!! Form::text('ref', $education->ref, ['class' => "form-control r-0 light s-12", 'placeholder' => trans('main.Reference Link'), 'id' => 'ref'])!!}
                                        <div class="valid-feedback">
                                            {{trans('main.Looks Good')}}
                                        </div>
                                        <div class="invalid-feedback">
                                            
                                        </div>
                                    </div>
                                    
                                    <div class="form-group col-6 m-0">
                                        {!! Form::label('from', trans('main.Started Date') . '<span class="valid-star">*</span>', ['class' => 'col-form-label s-12'], false) !!}
                                        {!! Form::text('from', $education->from, ['class' => "form-control r-0 light s-12 date-picker", 'placeholder' => trans('main.Started Date'), 'id' => 'from'])!!}
                                        <div class="valid-feedback">
                                            {{trans('main.Looks Good')}}
                                        </div>
                                        <div class="invalid-feedback">
                                            {{trans('main.Please Provide a Valid Input')}}
                                        </div>
                                    </div>
                                    <div class="form-group col-6 m-0">
                                        {!! Form::label('to', trans('main.Finished Date') . '<span class="valid-star">*</span>', ['class' => 'col-form-label s-12'], false) !!}
                                        {!! Form::text('to', $education->to, ['class' => "form-control r-0 light s-12 date-picker", 'placeholder' => trans('main.Finished Date'), 'id' => 'to'])!!}
                                        <div class="valid-feedback">
                                            
                                        </div>
                                        <div class="invalid-feedback">
                                            {{trans('main.Please Provide a Valid Input')}}
                                        </div>
                                    </div>
                                    <div class="form-group col-12 m-0">
                                        {!! Form::label('brief', trans('main.Brief') , ['class' => 'col-form-label s-12']) !!}
                                        {!! Form::textarea('brief', $education->brief, ['class' => "form-control r-0 light s-12", 'placeholder' => trans('main.Write Brief'), 'id' => 'brief'])!!}
                                        <div class="valid-feedback">
                                            {{trans('main.Looks Good')}}
                                        </div>
                                        <div class="invalid-feedback">
                                            {{trans('main.Please Provide a Valid Input')}}
                                        </div>
                                    </div>
                                </div>   
                            
                                
                                
                            </div>
                            <div class="modal-footer">
                                {!! Form::submit(trans('main.Edit'), ['class' => "btn btn-primary btn-sm", 'name' => 'edit-education']) !!}
                                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">{{trans('main.Close')}}</button>
                            </div>
                            @csrf
                            {!! Form::text('education_id', $education->id, ['hidden']) !!}
                            {!! Form::hidden('_method', 'PUT') !!}
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
                <!-- Delete Modal -->
                <div class="modal fade" id="education-{{ $education->id }}-delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">{{trans('main.Delete Education')}}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        {!! Form::open(['action'=> ['ProfileController@update', $user->id], 'method'=>'POST', 'enctype' =>'multipart/form-data', 'class' => 'w-100'])!!}
                                <div class="modal-body">
                                    {{trans('main.Are You Sure About Deleting')}} {{trans('main.Education')}}?
                                </div>
                                <div class="modal-footer">
                                    {!! Form::submit(trans('main.Delete'), ['class' => "btn btn-primary btn-sm", 'name' => 'delete-education']) !!}
                                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">{{trans('main.Close')}}</button>
                                </div>
                            {!! Form::text('education_id', $education->id, ['hidden']) !!}
                            {!! Form::hidden('_method', 'PUT') !!}
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            @endforeach
        @endif

        <!-- Experience Modals -->
        @if (count($user->experiences) > 0)
            @foreach ($user->experiences as $experience)
                <div class="modal fade" id="experience-{{ $experience->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">{{$experience->job_title}}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                            {!! Form::open(['action'=> ['ProfileController@update', $user->id], 'method'=>'POST', 'enctype' =>'multipart/form-data', 'class' => 'w-100'])!!}
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="row mt-1 create-field">
                                                <div class="form-group col-md-4 col-sm-12 m-0">
                                                    {!! Form::label('job_title', trans('main.Job Title').'<span class="valid-star">*</span>', ['class' => 'col-form-label s-12'], false) !!}
                                                    {!! Form::select('job_title', Helper::categoriesNames(), $experience->job_title,  ['class' => "form-control r-0 light s-12 selectpicker",  'data-live-search' => "true", 'placeholder' => trans('main.Job Title'), 'id' => 'country'])!!}
                                                </div>
                                                <div class="form-group col-md-4 col-sm-12 m-0">
                                                    {!! Form::label('company_name', trans('main.Company Name').'<span class="valid-star">*</span>', ['class' => 'col-form-label s-12'], false) !!}
                                                    {!! Form::text('company_name', $experience->company_name,  ['id' => 'middle_name', 'class' => "form-control r-0 light s-12", 'placeholder' => trans('main.Company Name'), 'id' => 'job_title'])!!}
                                                    <div class="valid-feedback">
                                                        {{trans('main.Looks Good')}}
                                                    </div>
                                                    <div class="invalid-feedback">
                                                        {{trans('main.Please Provide a Valid Input')}}
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-4 col-sm-12 m-0">
                                                    {!! Form::label('ref', trans('main.Reference Link').'<span class="valid-star">*</span>', ['class' => 'col-form-label s-12'], false) !!}
                                                    {!! Form::text('ref', $experience->ref, ['class' => "form-control r-0 light s-12", 'placeholder' => trans('main.Reference Link'), 'id' => 'ref'])!!}
                                                    <div class="valid-feedback">
                                                        {{trans('main.Looks Good')}}
                                                    </div>
                                                    <div class="invalid-feedback">
                                                        {{trans('main.Please Provide a Valid Input')}}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mt-1">
                                                <div class="form-group col-md-6 m-0">
                                                    {!! Form::label('from', trans('main.Started Date'), ['class' => 'col-form-label s-12'], false) !!}
                                                    {!! Form::text('from', $experience->from,  ['class' => "form-control r-0 light s-12 date-picker w-100", 'placeholder' => trans('main.Started Date'), 'id' => 'from'])!!}
                                                </div>
            
                                                <div class="form-group col-md-6  m-0">
                                                    {!! Form::label('to',  trans('main.Finished Date'), ['class' => 'col-form-label s-12'], false) !!}
                                                    {!! Form::text('to', $experience->to,  ['class' => "form-control r-0 light s-12 date-picker w-100", 'placeholder' => trans('main.Finished Date'), 'id' => 'to'])!!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                
                                    {!! Form::submit(trans('main.Edit'), ['class' => "btn btn-primary", 'name' => 'edit-experience']) !!}
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ trans('main.Close')}}</button>
                                    {!! Form::text('experience_id', $experience->id, ['hidden']) !!}
                                    {!! Form::hidden('_method', 'PUT') !!}
                                </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>

                <!-- Delete Modal -->
                <div class="modal fade" id="experience-{{ $experience->id }}-delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">{{trans('main.Delete Experience')}}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        {!! Form::open(['action'=> ['ProfileController@update', $user->id], 'method'=>'POST', 'enctype' =>'multipart/form-data', 'class' => 'w-100'])!!}
                            <div class="modal-body">
                                {{trans('main.Are You Sure About Deleting')}} {{trans('main.Experience')}}?
                            </div>
                            <div class="modal-footer">
                                
                                {!! Form::submit(trans('main.Delete'), ['class' => "btn btn-primary", 'name' => 'delete-experience']) !!}
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{trans('main.Close')}}</button>
                            </div>
                        {!! Form::text('experience_id', $experience->id, ['hidden']) !!}
                        {!! Form::hidden('_method', 'PUT') !!}
                        {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            @endforeach
        @endif

        <!-- Languages Modals -->
        @if (count($user->languages) > 0)
            @foreach($user->languages as $language)
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
                                <div class="form-row">
                                    <div class="col-md-12">
                                        <div class="form-row mt-1">
                                            <div class="form-group col-6 m-0">
                                                {!! Form::select('language', Helper::languages(), $language->language, ['class' => "form-control r-0 light s-12 selectpicker", 'placeholder' => trans('main.Language'), 'id' => 'language', 'data-live-search' => "true"])!!}
                                                <div class="valid-feedback">
                                                    {{trans('main.Looks Good')}}
                                                </div>
                                                <div class="invalid-feedback">
                                                    {{trans('main.Please Provide a Valid Input')}}
                                                </div>
                                            </div>
                                            <div class="form-group col-6 m-0">
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
                                    {{trans('main.Are You Sure About Deleting')}} {{trans('main.Language')}}?
                                </div>
                                <div class="modal-footer">
                                    
                                    {!! Form::submit(trans('main.Delete'), ['class' => "btn btn-primary btn-sm", 'name' => 'delete-language']) !!}
                                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">{{trans('main.Close')}}</button>

                                    
                                </div>
                            {!! Form::text('language_id', $language->id, ['hidden']) !!}
                            {!! Form::hidden('_method', 'PUT') !!}
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            @endforeach
        @endif 
    @endif
@endif









@include('inc.home.scripts')
<script>
    $(function() {
        // Multiple images preview in browser
        var imagesPreview = function(input, placeToInsertImagePreview) {
    
            if (input.files) {
                $('.empty-to-show').css('display', 'none');
                var filesAmount = input.files.length;
                for (i = 0; i < filesAmount; i++) {
                    var reader = new FileReader();
                    reader.onload = function(event) {
                        $($.parseHTML('<img>')).attr('src', event.target.result).appendTo(placeToInsertImagePreview);
                    }
                    reader.readAsDataURL(input.files[i]);
                }
            }
        };
        $('#gallery_image').on('change', function() {
            imagesPreview(this, 'div.previewer');
        });
    });     
    

    
//OPEN PHONE VERIFICATION MODAL 
var base_url ="{{url('/')}}";
$(document).on('click', '.phoneverficationModal' , function() {
    var csrf_token = $('input[name="_token"]').val();
     $.ajax({
        type: "POST",
        dataType: 'json',
        url: base_url+'/OpenPhoneVerificationModal',
        data: {_token:csrf_token},
        success: function(data) {
            if(data.success){
                $('.phone_verfication_modal').html(data.data);
                $('.phone_verfication_modal').modal('show');
            }else{
            }   
        },
    });
})
    
//SEND VERIFICATION CODE ON PHONE   
$(document).on('click', '.send_code_verification' , function() {
    var csrf_token = $('input[name="_token"]').val();
    var phone_number = $('#phone_number').val();
    $('.verification_loader').css('display','inline-block');
     $.ajax({
        type: "POST",
        dataType: 'json',
        url: base_url+'/send_phone_code',
        data: {phone_number:phone_number,_token:csrf_token},
        success: function(data) {
             $('.verification_loader').css('display','none');
            if(data.success){
                $('#phone_number_code_sent').val(phone_number);
                var message ="<p style='color:green;margin:0 auto;font-size:12px'>"+data.msg+"</p>"
                $('.phone_number_box').html(message);
                $('.code_verfication_box').show();
            }else{
                $('.phone_number_error').html(data.msg);
            }   
        },
        error :function( data ) {
            
         if( data.status === 422 ) {
            $('.verification_loader').css('display','none');
            $('.error').html('');
            var errors = $.parseJSON(data.responseText);
            $.each(errors, function (key, value) {
                
                if($.isPlainObject(value)) {
                    $.each(value, function (key, value) {                       
                      var key = key.replace('.','_');
                      $('.'+key+'_error').show().append(value);
                    });
                }
            }); 
          }
        }
    });
})


//CHECK ENTER CODE IS CORRECT OR NOT 
$(document).on('click', '.code_verification' , function() {

    var csrf_token = $('input[name="_token"]').val();
    var verfication_code = $('#verfication_code').val();
    var phone_number = $('#phone_number_code_sent').val();
    $('.code_verification_loader').css('display','inline-block');
     $.ajax({
        type: "POST",
        dataType: 'json',
        url: base_url+'/verify_phone_code',
        data: {_token:csrf_token,verfication_code:verfication_code,phone_number:phone_number},
        success: function(data) {
              $('.code_verification_loader').css('display','none');
            if(data.success){
                $('.phone_number_box').hide();
                $('.success_message').html(data.msg);
                $('.code_verfication_box').show();
                setTimeout(function(){ 
                $('.phone_verfication_modal').modal('hide');
                 
                $('._verify').removeClass('phoneverficationModal').css({"background": "green","border": "1px solid #green"});
                
                }, 3000);
            }else{
                $('.error_message1').html(data.msg);
            }   
        },
    });
})      

$(document).on('click', '.code_verification' , function() {

    var csrf_token = $('input[name="_token"]').val();
    var verfication_code = $('#verfication_code').val();
    var phone_number = $('#phone_number_code_sent').val();
    $('.code_verification_loader').css('display','inline-block');
     $.ajax({
        type: "POST",
        dataType: 'json',
        url: base_url+'/verify_phone_code',
        data: {_token:csrf_token,verfication_code:verfication_code,phone_number:phone_number},
        success: function(data) {
              $('.code_verification_loader').css('display','none');
            if(data.success){
                $('.phone_number_box').hide();
                $('.success_message').html(data.msg);
                $('.code_verfication_box').show();
                setTimeout(function(){ 
                $('.phone_verfication_modal').modal('hide');
                 
                $('._verify').removeClass('phoneverficationModal').css({"background": "green","border": "1px solid #green"});
                
                }, 3000);
            }else{
                $('.error_message1').html(data.msg);
            }   
        },
    });
})



</script>
 <script>


    $('.mobile-modal').on('shown.bs.modal', function() {
      const milliseconds = 1000 

        setInterval(
          () => { 
          $(this).find('[autofocus]').focus();
        
        }, milliseconds);
      
    });
        
    $('.mobile-modal .close').click(function(){
        $('.phone_verfication_modal').modal('hide')
    });
    
</script>

<script>
    $(document).ready(function(){
    // $("#country").on('change', function() {
    //         var id = $("#country option:selected").val();
    //         console.log();
    //         $.ajax({
    //             type: 'get',
    //             url: '{{url("get/cites/")}}/' + id,
    //             success: function (response) {
    //                     $('#city').empty();
    //                     $('#city_yes').empty();
                        
    //                 $.each(response, function(k, v) {
    //                     $('#city').append($('<option>', {value:k, text:v}));
    //                     $('#city_yes').append($('<option>', {value:k, text:v}));
                        
    //                 });
    //                 $('#city').selectpicker('refresh');  
    //                 $('#city_yes').selectpicker('refresh');
    //             }
    //         });
    //     });
        
    // }); //END document.ready

    // $("#country").on('change', function() {
    //     console.log($("#cities").val());
    //     if ($("#cities").val() == $("#country").val()) {
    //         console.log($("#cities").val());
    //         $("#cities").val();
    //     }
    // });                                   
    // Date Picker 
    $(".date-picker").flatpickr(
       
    );
    $(".date-picker[name='birth']").flatpickr(
        {
           disable: [
            {
                from: "2006-01-01",
                to: "2050-01-01"
            }
            ],
            defaultDate: ["2005-12-01"]
        }
    );
</script>
</body>
</html>