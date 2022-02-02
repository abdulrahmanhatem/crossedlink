<div class="tagline">
    <div class="container">
        <div class="float-left">
            {{--<div class="phone">
                <i class="mdi mdi-phone-classic"></i> +966 5600070000
            </div>--}}
            <div class="email">
                <a href="info@crossedlink.com">
                    <i class="mdi mdi-email"></i> info@crossedlink.com
                </a>
            </div>
        </div>
        <div class="float-right">
            <ul class="topbar-list list-unstyled d-flex" style="margin: 11px 0px;">

            @if(auth()->check())
                <div class="dropdown profile-dropdown">
                    <span class="list-inline-item" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="mdi mdi-account mr-2"></i>
                        @if(empty(auth()->user()->company_name))
                            {{ ucwords(auth()->user()->name) }}
                        @else 
                            {{ ucwords(auth()->user()->company_name) }}
                        @endif
                        
                    </span>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        @if(auth()->user()->role == 3)
                    <a class="dropdown-item" href="{{url('/dashboard')}}"><i class="fal fa-chart-line mr-2"></i>{{trans('main.Dashboard')}}</a>
                            <div class="dropdown-divider"></div>
                        @endif
                        @if(auth()->user()->role != 3)
                            @if(auth()->user()->role > 0)
                                <a class="dropdown-item " href="{{url('us')}}"><i class="fal fa-eye mr-2"></i>{{trans('main.View As')}}</a>
                            @else 
                                <a class="dropdown-item " href="{{url('me')}}"><i class="fal fa-eye mr-2"></i>{{trans('main.Profile')}}</a>
                            @endif
                        @endif
                        @if(auth()->user()->role != 3)
                            @if(auth()->user()->role == 1 || auth()->user()->role == 2)
                                <a class="dropdown-item " href="{{url('profiles/'. auth()->user()->id. '/edit')}}"><i class="fal fa-user-alt mr-2"></i>{{trans('main.Profile')}}</a>
                                <a class="dropdown-item " href="{{url('myPackage')}}"><i class="fal fa-hand-holding-box mr-2"></i>{{trans('main.Package')}}</a>
                                <a class="dropdown-item " href="{{url('workers')}}"><i class="fad fa-stream mr-2"></i>{{trans('main.My Jobs')}}</a>
                                <a class="dropdown-item " href="{{url('unlock')}}"><i class="fal fa-unlock-alt mr-2"></i>{{trans('main.Unlock List')}}</a>
                                <a class="dropdown-item " href="{{url('favorite')}}"><i class="fad fa-archive mr-2"></i>{{trans('main.Saved List')}}</a>
                            @else 
                                {{--<a class="dropdown-item " href="{{url('profiles/'. auth()->user()->id)}}"><i class="fal fa-user-alt mr-2"></i>{{trans('main.Profile')}}</a>--}}
                                <a class="dropdown-item " href="{{url('jobs')}}"><i class="fad fa-stream mr-2"></i>{{trans('main.Jobs')}}</a>
                                <a class="dropdown-item " href="{{url('saved-jobs')}}"><i class="fad fa-save mr-2"></i>{{trans('main.Saved Jobs')}}</a>
                                <a class="dropdown-item " href="{{url('apply-jobs')}}"><i class="fad fa-hand-holding-water mr-2"></i>{{trans('main.Apply Jobs')}}</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item " href="{{url('settings')}}"><i class="fal fa-user-cog mr-2"></i>{{trans('main.Settings')}}</a>
                            @endif
                        @endif
                        @if(auth()->user()->role != 3)
                            @if(auth()->user()->role == 1 || auth()->user()->role == 2)
                                <div class="dropdown-divider"></div>
                                {{--<a class="dropdown-item " href="#"><i class="fal fa-info-circle mr-2"></i>Help Center</a>--}}
                                <a class="dropdown-item " href="{{url('contact')}}"><i class="fal fa-envelope mr-2"></i>{{trans('main.Contact Us')}}</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item " href="{{url('settings')}}"><i class="fal fa-user-cog mr-2"></i>{{trans('main.Settings')}}</a>
                            @endif 
                        @endif
                            <a class="dropdown-item" href="{{url('logout')}}"><i class="fal fa-sign-out mr-2"></i>{{trans('main.Logout')}}</a>
                    </div>
                </div>

                <div class="dropdown notification">
                    <span class="list-inline-item" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fal fa-bell"></i>
                    <badge v-bind:notifies='notifies' v-bind:notifications='notifications'></badge>

                        {{--@if (auth()->user()->role == 1 || auth()->user()->role == 2)
                            @if(count(Helper::requestsNotifications()) > 0)
                                <span class="badge">{{ count(Helper::requestsNotifications()) + count(Helper::pricingExtentions()) + count(Helper::pricingNotifications())}}</span>
                            @endif
                        @elseif (auth()->user()->role == 0)    
                            @if(count(Helper::workerNotifications()) > 0)
                                <span class="badge">{{ count(Helper::workerNotifications()) }}</span>
                            @endif
                        @endif--}}
                    </span>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        @if (auth()->check())
                            @if (auth()->user()->role == 1 || auth()->user()->role == 2)
                            <div class="jobs">
                                <div class="head">
                                    {{trans('main.Job Requests')}}
                                </div>
                                @if (app()->getLocale() == 'ar')
                                 <example-ar v-bind:notifies='notifies' v-bind:notifications='notifications'></example-ar>
                                @else
                                 <example v-bind:notifies='notifies' v-bind:notifications='notifications'></example>
                                @endif 
                                
                            {{--  <div class="body">
                                    @php
                                
                                    $notifications = auth()->user()->unreadNotifications;
                                    @endphp
                                    @if(count($notifications) > 0)
                                    @foreach ($notifications as $note)
                                    @php
                                         $worker = Helper::userByIDFirst($note->data['worker'])
                                    @endphp
                                                @if (!empty($worker->profile_image))
                                                <div class="note-item dropdown-item d-inline-block">
                                                    <a href="{{url('/profiles/'. $worker->id)}}" class="ml-1">
                                                        <img src="{{ asset('uploads/images/profile_images/'.$worker->profile_image) }}" alt="" class="img-fluid employer-avatar">
                                                @else 
                                                        <img src="{{ asset('uploads/images/profile_images/default.jpg') }}" alt="" class="img-fluid employer-avatar">
                                                @endif
                                                        @if(Helper::unlockCheck($worker->id))
                                                            <div class="d-inline-block ml-1">{{ ucwords($worker->name)}}</div>
                                                        @else
                                                            <div class="d-inline-block ml-1">{{ ucwords(Helper::hashString($worker->name))}}</div>
                                                        @endif
                                                    </a>
                                                    {{trans('main.requests for')}}
                                                    <a class="" href="{{url('/jobs/'. $note->data['job'])}}">
                                                        @php
                                                            $job = Helper::jobByIDFirst($note->data['job']); 
                                                        @endphp
                                                            {{ $job->title }} 
                                                        
                                                        {{trans('main.Job')}}
                                                    </a>
                                                    <small class="float-right">{{ $note->created_at->diffForHumans() }}</small>
                                        </div>
                                    @endforeach
                                @else 
                                <a class="dropdown-item">
                                    {{trans('main.No Jobs Requests To Show ')}}
                                </a> 
                                @endif
                                </div> --}}
                            </div>
                            
                            <div class="pricing">
                                <div class="head">
                                    {{trans('main.Pricing')}}
                                </div>
                                
                                @if(count(Helper::pricingExtentions()) > 0)
                                    @foreach (Helper::pricingExtentions() as $n)
                                        <a class="dropdown-item" href="{{url('/myPackage/')}}">
                                            {{ $n->package->name }} {{trans('main.Package Subscribed')}}
                                            <small class="float-right">{{Helper::since($n->updated_at)}}</small>
                                        </a>
                                    @endforeach
                                @else 
                                @endif

                                @if(count(Helper::pricingNotifications()) > 0)
                                    @foreach (Helper::pricingNotifications() as $n)
                                        <a class="dropdown-item" href="{{url('/myPackage/')}}">
                                            {{ $n->package->name }} {{trans('main.Package Subscribed')}}
                                            <small class="float-right">{{Helper::since($n->updated_at)}}</small>
                                        </a>
                                    @endforeach
                                @else 
                                <a class="dropdown-item" href="{{url('/packages')}}">
                                    {{trans('main.Take a look On Our')}} <b class="text-primary">{{trans('main.Packages')}}</b>
                                </a> 
                                @endif

                            </div>
                            @endif
                            @if (auth()->user()->role == 0)
                            <div class="jobs">
                                <div class="head">
                                    {{trans('main.Your Job Requests')}}
                                </div>
                                @if (app()->getLocale() == 'ar')
                                 <example-ar v-bind:notifies='notifies' v-bind:notifications='notifications'></example-ar>
                                @else
                                 <example v-bind:notifies='notifies' v-bind:notifications='notifications'></example>
                                @endif
                                {{-- @if(count(Helper::workerNotifications()) > 0)
                                    
                                    @foreach (Helper::workerNotifications() as $req)
                                    @if ($req->state > 0)
                                        <a class="dropdown-item" href="{{url('/jobs/'. $req->job_id)}}">
                                            @foreach (Helper::jobByID($req->job_id) as $job)
                                                @foreach (Helper::userByID($job->employer_id) as $user)
                                                    @if (!empty($user->profile_image))
                                                        <a href="{{url('/profiles/'. $user->id)}}" class="ml-1">
                                                            <img src="{{ asset('uploads/images/profile_images/'.$user->profile_image) }}" alt="" class="img-fluid employer-avatar">
                                                                @else 
                                                                    <img src="{{ asset('uploads/images/profile_images/default_company.jpg') }}" alt="" class="img-fluid employer-avatar">
                                                                @endif

                                                                @if(!empty($user->company_name))
                                                                    <div class="d-inline-block ml-1">{{ ucwords($user->company_name)}}</div>
                                                                @else 
                                                                    <div class="d-inline-block ml-1">{{ ucwords($user->name)}}</div>
                                                                @endif

                                                                @if ($req->state == 1)
                                                                    <b class="text-primary">{{trans('main.Likes')}}</b>{{trans('main.You')}} 
                                                                @endif

                                                                @if ($req->state == 2)
                                                                    <b class="text-success">{{trans('main.Applied')}}</b> {{trans('main.You')}}
                                                                @endif

                                                                {{trans('main.For')}} 

                                                                @foreach (Helper::jobByID($req->job_id) as $job)
                                                                    {{ $job->title }} 
                                                                @endforeach
                                                                
                                                                {{trans('main.Job')}}

                                                                <small class="float-right">{{ Helper::since($req['updated_at']) }}</small>
                                                        </a>
                                                @endforeach
                                            @endforeach
                                        </a>
                                    @endif
                                    @endforeach
                                @else 
                                <a class="dropdown-item">
                                    {{trans('main.No Jobs Requests To Show ')}}
                                </a> 
                                @endif --}}
                            </div>
                            @endif
                        @endif
                        
                    </div>
                </div>
            @else 
                <li class="list-inline-item"><a href="{{url('login')}}"><i class="fal fa-sign-in mr-2"></i>{{trans('main.Login')}}</a></li>
                <li class="list-inline-item"><a href="{{url('register')}}"><i class="fal fa-user-plus mr-2"></i>{{trans('main.Join Now')}}</a></li>
                <li class="list-inline-item"><a href="{{url('employer/register')}}"><i class="fad fa-user-tie mr-2"></i></i>{{trans('main.Employer ?')}}</a></li>
            @endif
                @if(auth()->check())
                    @if(auth()->user()->role != 3)
                        <li class="list-inline-item ">
                            <div class="dropdown list-inline-item languages">
                                <span class="list-inline-item" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    {{trans('main.Language')}} 
                                </span>
                                <div class="dropdown-menu demo-default" aria-labelledby="dropdownMenuButton">  
                                <a href="{{url('lang/ar')}}" class="dropdown-item"><img src="{{asset('assets/images/arabic.png')}}">{{trans('main.Arabic')}}</a>
                                    <a href="{{url('lang/en')}}" class="dropdown-item"><img src="{{asset('assets/images/english.png')}}">{{trans('main.English')}}</a>
                                    {{--<a href="lang/hi" class="dropdown-item">{{trans('main.Hindi')}}</a>
                                    <a href="lang/tg" class="dropdown-item">{{trans('main.Tagalog')}}</a>--}}
                                </div>
                            </div>
                        </li>
                    @endif
                @else
                    <li class="list-inline-item ">
                        <div class="dropdown list-inline-item languages">
                            <span class="list-inline-item" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{trans('main.Language')}} 
                            </span>
                            <div class="dropdown-menu demo-default" aria-labelledby="dropdownMenuButton">  
                            <a href="{{url('lang/ar')}}" class="dropdown-item"><img src="{{asset('assets/images/arabic.png')}}">{{trans('main.Arabic')}}</a>
                                <a href="{{url('lang/en')}}" class="dropdown-item"><img src="{{asset('assets/images/english.png')}}">{{trans('main.English')}}</a>
                                {{--<a href="lang/hi" class="dropdown-item">{{trans('main.Hindi')}}</a>
                                <a href="lang/tg" class="dropdown-item">{{trans('main.Tagalog')}}</a>--}}
                            </div>
                        </div>
                    </li>
                @endif
                
            </ul>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
<!-- Tagline End -->

<!-- Menu Start -->

@if(auth()->check())
    @if(auth()->user()->role == 1 || auth()->user()->role == 2 || auth()->user()->role == 3)
        <div class="container wide-head">
    @else 
        <div class="container">
    @endif
@else 
    <div class="container">
@endif

    
    <!-- Logo container-->
    <div>
        <div class="no-large-screen navs-drops">

            @if(auth()->check())
            <div class="dropdown profile-dropdown">
                <span class="list-inline-item"  id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="mdi mdi-account mr-2"></i>
                    {{--@if(empty(auth()->user()->company_name))
                        {{ ucwords(auth()->user()->name) }}
                    @else 
                        {{ ucwords(auth()->user()->company_name) }}
                    @endif--}}
                    
                </span>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    @if(auth()->user()->role == 3)
                        <a class="dropdown-item" href="{{url('/dashboard')}}"><i class="fal fa-chart-line mr-2"></i>{{trans('main.Dashboard')}}</a>
                        <div class="dropdown-divider"></div>
                    @endif
                    @if(auth()->user()->role != 3)
                        @if(auth()->user()->role > 0)
                            <a class="dropdown-item " href="{{url('us')}}"><i class="fal fa-eye mr-2"></i>{{trans('main.View As')}}</a>
                        @else 
                            <a class="dropdown-item " href="{{url('me')}}"><i class="fal fa-eye mr-2"></i>{{trans('main.Profile')}}</a>
                        @endif
                    @endif
                    @if(auth()->user()->role != 3)
                        @if(auth()->user()->role == 1 || auth()->user()->role == 2)
                            <a class="dropdown-item " href="{{url('profiles/'. auth()->user()->id. '/edit')}}"><i class="fal fa-user-alt mr-2"></i>{{trans('main.Profile')}}</a>
                            <a class="dropdown-item " href="{{url('myPackage')}}"><i class="fal fa-hand-holding-box mr-2"></i>{{trans('main.Package')}}</a>
                            <a class="dropdown-item " href="{{url('workers')}}"><i class="fad fa-stream mr-2"></i>{{trans('main.My Jobs')}}</a>
                            <a class="dropdown-item " href="{{url('unlock')}}"><i class="fal fa-unlock-alt mr-2"></i>{{trans('main.Unlock List')}}</a>
                            <a class="dropdown-item " href="{{url('favorite')}}"><i class="fad fa-archive mr-2"></i>{{trans('main.Saved List')}}</a>
                        @else 
                            {{--<a class="dropdown-item " href="{{url('profiles/'. auth()->user()->id)}}"><i class="fal fa-user-alt mr-2"></i>{{trans('main.Profile')}}</a>--}}
                            <a class="dropdown-item " href="{{url('jobs')}}"><i class="fad fa-stream mr-2"></i>{{trans('main.Jobs')}}</a>
                            <a class="dropdown-item " href="{{url('saved-jobs')}}"><i class="fad fa-save mr-2"></i>{{trans('main.Saved Jobs')}}</a>
                            <a class="dropdown-item " href="{{url('apply-jobs')}}"><i class="fad fa-hand-holding-water mr-2"></i>{{trans('main.Apply Jobs')}}</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item " href="{{url('settings')}}"><i class="fal fa-user-cog mr-2"></i>{{trans('main.Settings')}}</a>
                        @endif
                    @endif
                    @if(auth()->user()->role != 3)
                        @if(auth()->user()->role == 1 || auth()->user()->role == 2)
                            <div class="dropdown-divider"></div>
                            {{--<a class="dropdown-item " href="#"><i class="fal fa-info-circle mr-2"></i>{{trans('main.Help Center')}}</a>--}}
                            <a class="dropdown-item " href="{{url('contact')}}"><i class="fal fa-envelope mr-2"></i>{{trans('main.Contact Us')}}</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item " href="{{url('settings')}}"><i class="fal fa-user-cog mr-2"></i>{{trans('main.Settings')}}</a>
                        @endif 
                    @endif
                        <a class="dropdown-item" href="{{url('logout')}}"><i class="fal fa-sign-out mr-2"></i>{{trans('main.Logout')}}</a>
                </div>
            </div>
            
            <div class="dropdown notification">
                <span class="list-inline-item"  id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fal fa-bell"><badge-mobile v-bind:notifies='notifies' v-bind:notifications='notifications'></badge-mobile></i>

                    {{--@if (auth()->user()->role == 1 || auth()->user()->role == 2)
                        @if(count(Helper::requestsNotifications()) > 0)
                            <span class="badge">{{ count(Helper::requestsNotifications()) + count(Helper::pricingExtentions()) + count(Helper::pricingNotifications())}}</span>
                        @endif
                    @elseif (auth()->user()->role == 0)    
                        @if(count(Helper::workerNotifications()) > 0)
                            <span class="badge">{{ count(Helper::workerNotifications()) }}</span>
                        @endif
                    @endif--}}
                    
                    
                    
                </span>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    @if (auth()->check())
                        @if (auth()->user()->role == 1 || auth()->user()->role == 2)
                        <div class="jobs">
                            <div class="head">
                                {{trans('main.Job Requests')}}
                            </div>
                                @if (app()->getLocale() == 'ar')
                                 <example-ar v-bind:notifies='notifies' v-bind:notifications='notifications'></example-ar>
                                @else
                                 <example v-bind:notifies='notifies' v-bind:notifications='notifications'></example>
                                @endif
                           {{--  @if(count(Helper::requestsNotifications()) > 0)
                                
                                @foreach (Helper::requestsNotifications() as $note)
                                    @foreach ($note as $n)
                                    <a class="dropdown-item" href="{{url('/jobs/'. $n['job_id'])}}">
                                        @foreach (Helper::userByID($n['worker_id']) as $worker)
                                            @if (!empty($worker->profile_image))
                                            <a href="{{url('/profiles/'. $worker->id)}}" class="ml-1">
                                                <img src="{{ asset('uploads/images/profile_images/'.$worker->profile_image) }}" alt="" class="img-fluid employer-avatar">
                                                    @else 
                                                        <img src="{{ asset('uploads/images/profile_images/default.jpg') }}" alt="" class="img-fluid employer-avatar">
                                                    @endif

                                                    <div class="d-inline-block ml-1">{{ Helper::hashString($worker->name)}}</div>

                                                    {{trans('main.requests for')}}
                                                    
                                                    @foreach (Helper::jobByID($n['job_id']) as $job)
                                                        {{ $job->title }} 
                                                    @endforeach
                                                    
                                                    {{trans('main.Job')}}
                                                    <small class="float-right">{{ Helper::since($n['created_at']) }}</small>
                                            </a>
                                        @endforeach
                                    </a>
                                    @endforeach
                                @endforeach
                            @else 
                            <a class="dropdown-item">
                                {{trans('main.No Jobs Requests To Show ')}}
                            </a> 
                            @endif --}}
                        </div>
                        
                        <div class="pricing">
                            <div class="head">
                            {{trans('main.Pricing')}}
                            </div>
                            
                            @if(count(Helper::pricingExtentions()) > 0)
                                @foreach (Helper::pricingExtentions() as $n)
                                    <a class="dropdown-item" href="{{url('/myPackage/')}}">
                                        {{ $n->package->name }} {{trans('main.Package Subscribed')}}
                                        <small class="float-right">{{Helper::since($n->updated_at)}}</small>
                                    </a>
                                @endforeach
                            @else 
                            <a class="dropdown-item" href="{{url('/packages')}}">
                                {{trans('main.Take a look On Our')}} <b class="text-primary">{{trans('main.Packages')}}</b>
                            </a> 
                            @endif

                            @if(count(Helper::pricingNotifications()) > 0)
                                @foreach (Helper::pricingNotifications() as $n)
                                    <a class="dropdown-item" href="{{url('/myPackage/')}}">
                                        {{ $n->package->name }} {{trans('main.Package Subscribed')}}
                                        <small class="float-right">{{Helper::since($n->updated_at)}}</small>
                                    </a>
                                @endforeach
                            @else 
                            <a class="dropdown-item" href="{{url('/packages')}}">
                                {{trans('main.Take a look On Our')}} <b class="text-primary">{{trans('main.Packages')}}</b>
                            </a> 
                            @endif

                        </div>
                        @endif
                        @if (auth()->user()->role == 0)
                        <div class="jobs">
                            <div class="head">
                                {{trans('main.Your Job Requests')}}
                            </div>
                                @if (app()->getLocale() == 'ar')
                                 <example-ar v-bind:notifies='notifies' v-bind:notifications='notifications'></example-ar>
                                @else
                                 <example v-bind:notifies='notifies' v-bind:notifications='notifications'></example>
                                @endif
                           {{--  @if(count(Helper::workerNotifications()) > 0)
                                
                                @foreach (Helper::workerNotifications() as $req)
                                @if ($req->state > 0)
                                    <a class="dropdown-item" href="{{url('/jobs/'. $req->job_id)}}">
                                        @foreach (Helper::jobByID($req->job_id) as $job)
                                            @foreach (Helper::userByID($job->employer_id) as $user)
                                                @if (!empty($user->profile_image))
                                                    <a href="{{url('/profiles/'. $user->id)}}" class="ml-1">
                                                        <img src="{{ asset('uploads/images/profile_images/'.$user->profile_image) }}" alt="" class="img-fluid employer-avatar">
                                                            @else 
                                                                <img src="{{ asset('uploads/images/profile_images/default_company.jpg') }}" alt="" class="img-fluid employer-avatar">
                                                            @endif

                                                            @if(!empty($user->company_name))
                                                                <div class="d-inline-block ml-1">{{ ucwords($user->company_name)}}</div>
                                                            @else 
                                                                <div class="d-inline-block ml-1">{{ ucwords($user->name)}}</div>
                                                            @endif

                                                            @if ($req->state == 1)
                                                                <b class="text-primary">{{trans('main.Likes')}}</b> {{trans('main.You')}}
                                                            @endif

                                                            @if ($req->state == 2)
                                                                <b class="text-success">{{trans('main.Applied')}}</b> {{trans('main.You')}}
                                                            @endif

                                                            {{trans('main.For')}} 

                                                            @foreach (Helper::jobByID($req->job_id) as $job)
                                                                {{ $job->title }} 
                                                            @endforeach
                                                            
                                                            {{trans('main.Job')}}

                                                            <small class="float-right">{{ Helper::since($req['updated_at']) }}</small>
                                                    </a>
                                            @endforeach
                                        @endforeach
                                    </a>
                                @endif
                                @endforeach
                            @else 
                            <a class="dropdown-item">
                                {{trans('main.No Jobs Requests To Show ')}}
                            </a> 
                            @endif --}}
                        </div>
                        @endif
                    @endif
                    
                </div>
            </div>
            @else 
            <div class="dropdown profile-dropdown">
                <span class="list-inline-item"  id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="mdi mdi-account mr-2"></i>
                    
                </span>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="{{ url('/login')}}"><i class="fal fa-sign-in mr-2"></i>{{ trans('main.Login') }}</a>
                    <a class="dropdown-item" href="{{ url('/register')}}"><i class="fal fa-user-plus mr-2"></i>{{ trans('main.Join Now') }}</a>
                    <a class="dropdown-item" href="{{ url('/employer/register')}}"><i class="fad fa-user-tie mr-2"></i>{{ trans('main.Employer ?') }}</a>
                </div>
            </div>
            @endif
        </div>
        <a href="{{url('/')}}" class="logo">
            <img src="{{asset('assets/images/logo-light.png')}}" alt="" class="logo-light" height="40"/>
            <img src="{{asset('assets/images/logo-dark.png')}}" alt="" class="logo-dark" height="40"/>
        </a>
        @if(auth()->check())
            @if(auth()->user()->role != 3)
                <div class="dropdown list-inline-item languages no-large-screen">
                    <span class="list-inline-item"  id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fal fa-globe"></i>
                    </span>
                    <div class="dropdown-menu demo-default" aria-labelledby="dropdownMenuButton">
                        <a href="{{url('lang/ar')}}" class="dropdown-item"><img src="{{asset('assets/images/arabic.png')}}">{{trans('main.Arabic')}}</a>
                        <a href="{{url('lang/en')}}" class="dropdown-item"><img src="{{asset('assets/images/english.png')}}">{{trans('main.English')}}</a>
                        {{--<a href="lang/hi" class="dropdown-item">{{trans('main.Hindi')}}</a>
                        <a href="lang/tg" class="dropdown-item">{{trans('main.Tagalog')}}</a>--}}
                    </div>
                </div>
            @endif 
        @else 
            <div class="dropdown list-inline-item languages no-large-screen">
                <span class="list-inline-item"  id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fal fa-globe"></i>
                </span>
                <div class="dropdown-menu demo-default" aria-labelledby="dropdownMenuButton">
                    <a href="{{url('lang/ar')}}" class="dropdown-item"><img src="{{asset('assets/images/arabic.png')}}">{{trans('main.Arabic')}}</a>
                    <a href="{{url('lang/en')}}" class="dropdown-item"><img src="{{asset('assets/images/english.png')}}">{{trans('main.English')}}</a>
                    {{--<a href="lang/hi" class="dropdown-item">{{trans('main.Hindi')}}</a>
                    <a href="lang/tg" class="dropdown-item">{{trans('main.Tagalog')}}</a>--}}
                </div>
            </div>
        @endif    
        <div class="menu-extras">
            <div class="menu-item">
                <!-- Mobile menu toggle-->
                <a class="navbar-toggle">
                    <div class="lines">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                </a>
                <!-- End mobile menu toggle-->
            </div>
        </div>

        <div id="navigation" class="no-large-screen">
            <!-- Navigation Menu-->   
            <ul class="navigation-menu">
                    <li><a href="{{ url('/')}}">{{ trans('main.Home') }}</a></li>
                    <li><a href="{{ url('/about')}}">{{ trans('main.AboutUs') }}</a></li>
                    <li><a href="{{ url('/services')}}">{{ trans('main.Services') }}</a></li>
                    @if (Config::get('app.locale') == 'ar')
                        <li><a href="{{ url('/خدمة-معروفة')}}">خدمة معروفة</a></li>
                    @endif
                    @if(auth()->check())
                        <li><a href="{{ url('/search/jobs')}}">{{ trans('main.Jobs') }}</a></li>
                    @endif
                    @if(auth()->check())
                        @if(auth()->user()->role > 0)
                            <li><a href="{{ url('/search/workers')}}">{{ trans('main.Candidates') }}</a></li>
                        @endif
                        @if(auth()->user()->role == 1 || auth()->user()->role == 2)
                            <li><a href="{{ url('/packages')}}">{{ trans('main.Pricing') }}</a></li>
                        @endif
                    @endif
                    <li class="">
                        <a href="{{ url('/contact')}}">{{ trans('main.Contact') }}</a>
                    </li>
                   
            </ul><!--end navigation menu-->
        </div>
    </div>                 
    <div class="buy-button">
        @if(auth()->check())
            @if(auth()->user()->role == 1 || auth()->user()->role == 2)
                <a href="{{ url('post/job') }}" class="btn btn-primary"><i class="mdi mdi-cloud-upload"></i> {{trans('main.Post a Job')}}</a>
            @endif
        @endif
    </div><!--end login button-->
    <!-- End Logo container-->
    <div>
        <!-- Navigation Menu-->   
        <ul class="navigation-menu no-mobile">
                <li><a href="{{ url('/')}}">{{ trans('main.Home') }}</a></li>
                <li><a href="{{ url('/about')}}">{{ trans('main.AboutUs') }}</a></li>
                <li><a href="{{ url('/services')}}">{{ trans('main.Services') }}</a></li>
                @if (Config::get('app.locale') == 'ar')
                        <li><a href="{{ url('/خدمة-معروفة')}}">خدمة معروفة</a></li>
                @endif
                @if(auth()->check())
                    <li><a href="{{ url('/search/jobs')}}">{{ trans('main.Jobs') }}</a></li>
                @endif
                @if(auth()->check())
                    @if(auth()->user()->role > 0)
                        <li><a href="{{ url('/search/workers')}}">{{ trans('main.Candidates') }}</a></li>
                    @endif
                    @if(auth()->user()->role == 1 || auth()->user()->role == 2)
                        <li><a href="{{ url('/packages')}}">{{ trans('main.Pricing') }}</a></li>
                    @endif
                @endif
                <li>
                    <a href="{{ url('/contact')}}">{{ trans('main.Contact') }}</a>
                </li>
               
        </ul><!--end navigation menu-->
    </div>
</div><!--end container-->


