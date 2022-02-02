@include('inc.home.head', ['title' => ucwords(Helper::hashString($user->name))])

<section class="p-150 candidate-profile cannot-view">
  
    <div class="container">
        <div class="row big-row">
            <div class="col-md-3 col-sm-12 pb-3 view-face">
                <div class="avatar">
                    @if(!empty($user->profile_image))
                    <img src="{{ asset('uploads/images/profile_images/'.$user->profile_image ) }}" alt="" class="d-block mx-auto shadow rounded-pill mb-4 worker-avatar">
                    @else 
                        <img src="{{ asset('uploads/images/profile_images/default.jpg') }}" alt="" class="d-block mx-auto shadow rounded-pill mb-4 worker-avatar">
                    @endif
                </div>
                <h5 class="mb-2 text-center worker-name">{{ ucwords(Helper::hashString($user->name)) }}</h5>
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
                    @if (!empty($user->town))
                        <span>
                            {{ $user->town }}
                        </span>
                    @endif
                    @if (!empty($user->city))
                        <span>
                            {{ $user->city }}
                        </span>
                    @endif
                    @if (!empty($user->country))
                        <span>
                            {{ Helper::getCountryByKey($user->country) }}
                        </span>
                    @endif
                </div>
                <div class="text-center">
                    {!! Form::open(['action'=> 'ProfileController@store', 'method'=>'POST', 'enctype' =>'multipart/form-data', 'class' => 'w-100'])!!}
                    @auth
                    @if($pricing)
                        {!! Form::submit(trans('main.Unlock'), ['class' => "btn profile-unlock btn-sm mt-2 ", 'name' => 'create-unlock']) !!}
                    @else 
                        {!! Form::submit(trans('main.Subscribe to Unlock'), ['class' => "btn profile-unlock btn-sm mt-2 ", 'name' => 'create-unlock']) !!}
                    @endif
                    {!! Form::text('worker_id', $user->id, ['hidden'])!!}
                    {!! Form::close() !!}
                    @endauth
                </div>
                <div class="verified mt-4 text-center">
                <h6 class="mb-2 text-center text-muted worker-name">{{ ucwords(Helper::hashString($user->name)) }} {{trans('main.Provided')}}</h6>
                    <div>
                        
                        
                            @if (empty($user->gov_id))
                                <i class="fad fa-exclamation text-danger"></i>
                                {{trans('main.Government ID')}}
                            @else 
                                @if ($user->gov_id == 'verified')
                                    <i class="fal fa-badge-check"></i>
                                    {{trans('main.Government ID')}}
                                @else 
                                    <i class="fad fa-exclamation text-danger"></i>
                                    {{trans('main.Government ID')}}
                                    <a class="btn btn-success btn-sm" data-toggle="modal" data-target="#gov_id-modal">Sent</a> 
                                @endif
                            @endif
                            
                        </div>		
                        <div>                       
                                                
                        @if(($user->email_verified_at==NULL && $user->email_verify_token==NULL) || ($user->email_verified_at==NULL && $user->email_verify_token!=NULL))							
                            <i class="fad fa-exclamation text-danger"></i>   
                            {{trans('main.Email Address')}}
                        @else
                            <i class="fal fa-badge-check"></i> {{trans('main.Email Address')}}
                        @endif                   
                        </div>                   
                        <div>                        
                                                  
                        @if($user->IsPhoneVerified)							
                            <i class="fal fa-badge-check"></i>                         
                            {{trans('main.Phone Number')}}
                        @else 
                            <i class="fad fa-exclamation text-danger"></i> {{trans('main.Phone Number')}}
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
                            <div class="tab-content my-2" id="pills-tabContent">
                                <div class="tab-pane fade show active" id="about" role="tabpanel" aria-labelledby="about-tab">
                                    <div class="row">
                                        <div class="col-lg-12 px-0">
                                            <div class="py-2 text-left">
                                                <div class="row profile-top">
                                                    <div class="col-sm-6 view-profile-details">
                                                        <div class="email">
                                                            <i class="fal fa-envelope mr-1"></i>
                                                            <label class="profile-label">{{trans('main.Email')}}:</label>
                                                            <span>
                                                                {{trans('main.Unlock')}}
                                                            </span>
                                                        </div>
                                                        
                                                        <div class="phone">
                                                            <i class="fal fa-phone-alt"></i>
                                                            <label class="profile-label">{{trans('main.Phone')}}:</label>
                                                            <span class=" w-75 ">{{trans('main.Unlock')}}</span>
                                                        </div>

                                                        <div class="email">
                                                            <i class="fad fa-scroll"></i>
                                                            <label class="profile-label">{{trans('main.CV')}}:</label>
                                                            <span class=" w-75 ">{{trans('main.Unlock')}}</span>
                                                        </div>

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
                                                        @endif 
                                                        
                                                      
                                                       
                                                        <div class="social">
                                                            <i class="fal fa-share-alt-square"></i>
                                                            <label class="profile-label">{{trans('main.Social Media')}} :</label>
                                                            <span class=" w-75 ">{{trans('main.Unlock')}}</span>
                                                        </div>
                                                      
                                                        
                                                    </div>
                                                    <div class="col-sm-6  view-profile-contact">
                                                        <div class="">
                                                            <div class="birth">
                                                                @if (!empty($user->birth))
                                                                <i class="fad fa-calendar-star"></i>
                                                                <label class="profile-label">{{trans('main.Age')}}:</label>
                                                                <span>
                                                                    {{ Helper::getAge($user->birth) }}
                                                                </span>
                                                                @endif
                                                                
                                                                @foreach (Helper::gender() as $key => $option)
                                                                    @if($user->gender == $key)
                                                                    <i class="fas fa-venus-mars"></i>
                                                                    
                                                                    <label class="profile-label">{{trans('main.Gender')}}:</label>
                                                                        <span>
                                                                            {{ $option }}
                                                                        @endif
                                                                    </span>
                                                                @endforeach
                                                                
                                                                @foreach (Helper::married() as $key => $option)
                                                                    @if($user->married == $key)
                                                                    <i class="fal fa-rings-wedding"></i>
                                                                        <label class="profile-label">{{trans('main.Married')}}:</label>
                                                                        <span>
                                                                            {{ $option }}
                                                                        </span>
                                                                    @endif
                                                                @endforeach
                                                                
                                                            </div>

                                                            <div>
                                                                @foreach (Helper::legal() as $key => $option)
                                                                    @if($user->legal == $key)
                                                                    <i class="fal fa-passport"></i>
                                                                    <label class="profile-label">{{trans('main.Legal')}}:</label>
                                                                        <span>
                                                                            {{ $option }}
                                                                        @endif
                                                                    </span>
                                                                @endforeach
                                                            </div>
                                                            
                                                            <div>
                                                                @if (!empty($user->nationality))
                                                                    <i class="fal fa-flag-alt"></i>
                                                                    <label class="profile-label">{{trans('main.Nationality')}}:</label>
                                                                    <span>
                                                                        {{ Helper::nationalityByKey($user->nationality) }}
                                                                    </span>
                                                                @endif
                                                                
                                                            </div>
                                                            <div>
                                                                @if (!empty($user->address))
                                                                    <i class="fal fa-map-marker-alt"></i>
                                                                    <label class="profile-label">{{trans('main.Address')}}:</label>
                                                                    <span>
                                                                        {{ $user->address }}
                                                                    </span>
                                                                @endif
                                                            </div>

                                                            <span class="salary">
                                                                @foreach (Helper::minimalSalary() as $key => $option)
                                                                    @if($user->average_salary == $key)
                                                                        <i class="fal fa-wallet"></i>
                                                                        <label class="profile-label">{{trans('main.Monthly Salary')}}:</label>
                                                                        {{ $option }}
                                                                    @endif
                                                                @endforeach
                                                            </span>
                                                            
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                            <div class="col-md-6 col-sm-12 text-left view-profile-details">
                                                @if (!empty($user->skills) ||count($user->skills) > 0)
                                                <h5 class="text-dark">{{trans('main.Skills')}}</h5>
                                                    @foreach ($user->skills as $skill)
                                                        @foreach (Helper::getSkills($skill->name) as $s)
                                                        <span class="skill">{{ $s }}</span>
                                                        @endforeach
                                                    @endforeach
                                                @else 
                                                @if(auth()->check())
                                                    @if(auth()->user()->id == $user->id)
                                                       
                                                        <a href="{{ url('profiles/'.auth()->user()->id.'/edit/skills') }}" class=" box add-empty my-4">
                                                            @if (Helper::checkGender($user->gender) == 'Male')
                                                                <img src="{{ asset('assets/images/creative/skill-m.png')}}" class="creative-profile">
                                                            @else 
                                                                <img src="{{ asset('assets/images/creative/skill-f.png')}}" class="creative-profile">
                                                            @endif
                                                            <br>
                                                            {{trans('main.Add Skills')}}
                                                        </a>
                                                    @else
                                                        <span class="empty-to-show box my-4">{{trans('main.No Skills To Show')}}</span>
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
                                                @if(auth()->check())
                                                    @if(auth()->user()->id == $user->id)
                                                        <a href="{{ url('profiles/'.auth()->user()->id.'/edit/languages') }}" class="box add-empty my-4">
                                                            @if (Helper::checkGender($user->gender) == 'Male')
                                                                <img src="{{ asset('assets/images/creative/lang.png')}}" class="creative-profile">
                                                            @else 
                                                                <img src="{{ asset('assets/images/creative/lang.png')}}" class="creative-profile">
                                                            @endif
                                                            <br>
                                                            {{trans('main.Add Language')}}</a>
                                                    @else
                                                        <span class="empty-to-show box my-4">{{trans('main.No Languages To Show')}}</span>
                                                    @endif 
                                                @else
                                                    <span class="empty-to-show box my-4">{{trans('main.No Languages To Show')}}</span>
                                                @endif      
                                                @endif 
                                            </div>
                                    </div>
                                    <div class="row view-about mt-2 d-block">
                                        @if(!empty($user->about))
                                            @if(auth()->check())
                                                @if(auth()->user()->id == $user->id)
                                                    <h5 class="text-dark d-block">{{trans('main.About Me')}}</h5>
                                                @else
                                                    <h5 class="text-dark d-block">{{trans('main.About')}} {{ $user->name }}</h5>
                                                @endif
                                            @else
                                                <h5 class="text-dark d-block">{{trans('main.About')}} {{ $user->name }}</h5>
                                            @endif
                                                <div class="text-muted text-justify d-block">{{ $user->about }}</div>

                                        @else 
                                        @if(auth()->check())
                                            @if(auth()->user()->id == $user->id)
                                                <a href="{{ url('profiles/'.auth()->user()->id.'#about') }}" class="add-empty box my-3">
                                                    @if (Helper::checkGender($user->gender) == 'Male')
                                                        <img src="{{ asset('assets/images/creative/talk-m.png')}}" class="creative-profile">
                                                        @else 
                                                        <img src="{{ asset('assets/images/creative/talk-f.png')}}" class="creative-profile">
                                                    @endif
                                                    <br>
                                                    {{trans('main.Talk About Your Self')}}</a>
                                            @else
                                                <span class="empty-to-show box my-3 w-100">{{trans('main.No Discription To Show')}}</span>
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
                                                        <p class="f-17 text-muted school">{{ $education->school }}</p>
                                                        <p class="f-14">{{ Helper::getMonthNameYear($education->from) }} - {{ Helper::getMonthNameYear($education->to) }}</p>
                                                        <p class="brief">{{ Str::limit( $education->brief , 90)}}</p>
                                                    </div>
                                                @endforeach
                                            @else 
                                            @if(auth()->check())
                                                @if(auth()->user()->id == $user->id)
                                                    <a href="{{ url('profiles/'.auth()->user()->id.'/edit/education') }}" class="box add-empty my-4">
                                                        @if (Helper::checkGender($user->gender) == 'Male')
                                                            <img src="{{ asset('assets/images/creative/edu-m.png')}}" class="creative-profile">
                                                        @else 
                                                            <img src="{{ asset('assets/images/creative/edu-f.png')}}" class="creative-profile">
                                                        @endif
                                                        <br>
                                                        {{trans('main.Add Education')}}</a>
                                                @else
                                                    <div class=" view-edu">
                                                        <span class="empty-to-show box my-4">{{trans('main.No Education To Show')}}</span>
                                                    </div>
                                                @endif
                                            @else
                                                <div class=" view-edu">
                                                    <span class="empty-to-show box my-4">{{trans('main.No Education To Show')}}</span>
                                                </div>
                                            @endif
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
                                            @if(auth()->check())
                                                @if(auth()->user()->id == $user->id)
                                                    <a href="{{ url('profiles/'.auth()->user()->id.'/edit/education') }}" class="box add-empty my-4">
                                                        @if (Helper::checkGender($user->gender) == 'Male')
                                                            <img src="{{ asset('assets/images/creative/edu-m.png')}}" class="creative-profile">
                                                        @else 
                                                            <img src="{{ asset('assets/images/creative/edu-f.png')}}" class="creative-profile">
                                                        @endif
                                                        <br>
                                                        {{trans('main.Add Experience')}}</a>
                                                @else
                                                    <div class=" view-edu">
                                                        <span class="empty-to-show box my-4">{{trans('main.No Experiences To Show')}}</span>
                                                    </div>
                                                @endif
                                            @else
                                                <div class=" view-edu">
                                                    <span class="empty-to-show box my-4">{{trans('main.No Experiences To Show')}}</span>
                                                </div>
                                            @endif
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
                                                            <img src="{{ asset('uploads/images/gallery_images/'.$image->gallery_image) }}" alt="" class="gallery_image" id ="preview_image" data-toggle="modal" data-target="#gallery-{{$image->id}}">
                                                            @if(auth()->check())   
                                                                @if(auth()->user()->id == $user->id)
                                                                    <span class="delete-image" aria-hidden="true" data-toggle="modal" data-target="#gallery-{{ $image->id }}-delete">&times;</span>
                                                                @endif
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
                                                                        {{trans('main.Are You Sure To Delete The Photo?')}}
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{trans('main.Close')}}</button>
                                                                        {!! Form::submit(trans('main.Delete'), ['class' => "btn btn-primary", 'name' => 'delete-gallery-image']) !!}
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
                                                    <span class="empty-to-show box my-4">{{trans('main.No Portfolio To Show')}}</span>
                                                </div>
                                            @endif
                                            @if(auth()->check())
                                                @if(auth()->user()->id == $user->id)
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
                                                            <div class="col-lg-12 mt-2">
                                                                {!! Form::submit(trans('main.Add'), ['class' => "btn btn-primary mt-2 btn-sm", 'name' => 'create-gallery']) !!}
                                                            </div>
                                                        </div>
                                                    {!! Form::close() !!}
                                                @endif
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

<!-- subscribe end -->
<!-- footer start -->
@include('inc.home.foot')
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
    </script>

    </body>
</html>