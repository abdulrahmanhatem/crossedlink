@include('inc.home.head', ['title' => trans('main.Packages')])
 
    <section class="section p-150 bread-crumbs">
        <div class="container">
            <a href="{{ url('/') }}" class="text-muted">{{trans('main.Home')}}</a> / <a href="{{ url('myPackage') }}" class="text-primary">{{trans('main.Packages')}}</a>
        </div>
    </section>
    <section class="section">
        <div class="container">
            @if (count($packages) > 0)
                <h5 class="text-center my-4">{{trans('main.Packages')}}</h5>
            @endif
            <div class="row">
                @if (count($packages) > 0)
                    @foreach ($packages as $package)
                    <div class="col-md-4 mt-4 mt-sm-0 pt-2 pt-sm-0">
                        @if($package->rec == 1)
                            <div class="pricing-box border rounded pt-4 rec">
                        @else
                            <div class="pricing-box border rounded pt-4">
                        @endif
                            <div class="pl-2 pr-2 collapsed pointer" data-toggle="collapse" href="#collapseExample-{{$package->id}}" role="button" aria-expanded="false" aria-controls="collapseExample">
                                <div class="header">
                                    <h6 class="text-center text-uppercase font-weight-bold">{{ $package->name }}</h6>
                                    <p class="text-center text-muted ">{{ $package->details }}</p>
                                </div>
                                @if($package->old_price)
                                    <div class="price-box has-old">
                                        <p class="text-muted text-center mb-0 price mt-3"><span class="text-muted text-primary font-weight-normal h5 old-price">{{ $package->old_price }}<sup class="h6">{{trans('main.SAR')}}</sup>/</span>{{trans('main.Month')}}</p>
                                @else 
                                    <div class="price-box">
                                @endif
                                    <p class="text-muted text-center mb-0 price"><span class="text-primary font-weight-normal h3">{{ $package->price }}<sup class="h5">{{trans('main.SAR')}}</sup>/</span>{{trans('main.Month')}}</p>
                                </div>
                                <div class="pricing-plan-item text-center">
                                    <ul class="list-unstyled mb-0 " >
                                        <li class="text-muted"><i class="fad fa-file-alt mx-1"></i>{{trans('main.Jobs Package')}} <span class="pricing-val">{{ $package->ads }} {{trans('main.packageJobs')}}</span></li>
                                        <li class="text-muted"><i class="fad fa-eye mx-1"></i>{{trans('main.Visit Profiles Package')}} <span class="pricing-val">{{ $package->profiles }} {{trans('main.Profiles')}}</span></li>
                                        <li class="text-muted"><i class="fal fa-clock mx-1"></i>{{trans('main.Package Duration')}} <span class="pricing-val">{{ $package->period }} {{trans('main.packageDays')}}</span></li>
                                    </ul>
                                    <ul class="list-unstyled mb-0 " id="">
                                        <li class="text-muted"><i class="fad fa-money-check-edit-alt"></i>{{trans('main.Tax')}} <span class="pricing-val">{{ $package->tax = 1 ? trans('main.Included') : trans('main.Not Included') }}</span></li>
                                    </ul>
                                </div>
                            </div>

                            <div class="text-center border-top p-4 mt-4">
                               
                                @if ($approved)
                                    <a href="{{url('myPackage')}}">
                                        {{trans('main.You Subscribed A Package')}}
                                    </a>
                                @else 
                                    {!! Form::open(['action'=>'EmployerClientController@checkout', 'method'=>'GET'])!!}
                                    {!! Form::text('package_id', $package->id, ['hidden'])!!}
                                    {!! Form::submit(trans('main.Buy'), ['class' => "btn btn-block btn-primary"]) !!}
                                    {!! Form::close() !!}
                                @endif
                            </div>
                        </div>
                    </div>
                    @endforeach
                @else   
                
                    
                @endif
            </div>
            @if (!empty($approved))
                @if (count($extentions) > 0)
                    <h5 class="text-center my-4">{{trans('main.Addons')}}</h5>
                    <div class="row">
                        @foreach ($extentions as $package)
                         <div class="col-md-4 mt-4 mt-sm-0 pt-2 pt-sm-0">
                        @if($package->rec == 1)
                            <div class="pricing-box border rounded pt-4 rec">
                        @else
                            <div class="pricing-box border rounded pt-4">
                        @endif
                            <div class="pl-2 pr-2 collapsed pointer" data-toggle="collapse" href="#collapseExample-{{$package->id}}" role="button" aria-expanded="false" aria-controls="collapseExample">
                                <div class="header">
                                    <h6 class="text-center text-uppercase font-weight-bold">{{ $package->name }}</h6>
                                    <p class="text-center text-muted ">{{ $package->details }}</p>
                                </div>
                                @if($package->old_price)
                                    <div class="price-box has-old">
                                        <p class="text-muted text-center mb-0 price mt-3"><span class="text-muted text-primary font-weight-normal h5 old-price">{{ $package->old_price }}<sup class="h6">{{trans('main.SAR')}}</sup>/</span>{{trans('main.Month')}}</p>
                                @else 
                                    <div class="price-box">
                                @endif
                                    <p class="text-muted text-center mb-0 price"><span class="text-primary font-weight-normal h3">{{ $package->price }}<sup class="h5">{{trans('main.SAR')}}</sup>/</span>{{trans('main.Month')}}</p>
                                </div>
                                <div class="pricing-plan-item text-center">
                                    <ul class="list-unstyled mb-0 " >
                                        <li class="text-muted"><i class="fad fa-file-alt mx-1"></i>{{trans('main.Jobs Package')}} <span class="pricing-val">{{ $package->ads }} {{trans('main.packageJobs')}}</span></li>
                                        <li class="text-muted"><i class="fad fa-eye mx-1"></i>{{trans('main.Visit Profiles Package')}} <span class="pricing-val">{{ $package->profiles }} {{trans('main.Profiles')}}</span></li>
                                        <li class="text-muted"><i class="fal fa-clock mx-1"></i>{{trans('main.Package Duration')}} <span class="pricing-val">{{ $package->period }} {{trans('main.packageDays')}}</span></li>
                                    </ul>
                                    <ul class="list-unstyled mb-0 " id="">
                                        <li class="text-muted"><i class="fad fa-money-check-edit-alt"></i>{{trans('main.Tax')}} <span class="pricing-val">{{ $package->tax = 1 ? trans('main.Included') : trans('main.Not Included') }}</span></li>
                                    </ul>
                                </div>
                            </div>

                            <div class="text-center border-top p-4 mt-4">
                                    {!! Form::open(['action'=>'EmployerClientController@checkout', 'method'=>'GET'])!!}
                                    {!! Form::text('package_id', $package->id, ['hidden'])!!}
                                    {!! Form::submit(trans('main.Buy'), ['class' => "btn btn-block btn-primary"]) !!}
                                    {!! Form::close() !!}
                               
                            </div>
                        </div>
                    </div>
                       
                        @endforeach
                    </div>
                    {{--<span class="empty-to-show box p-5">No Extention To Show</span>--}}
                @endif
            @endif
        </div>
    </section>
    <!-- PRICING END -->

    <!-- CTA START -->
    {{--<section class="section cta-bg p-100" style="background: url({{asset('assets/images/about.jpg')}}) top center;background-size: 100% 120%;">
        <div class="bg-overlay"></div>
        <div class="container">
            <div class="row justify-content-center text-center">
                <div class="col-md-9">
                    <div class="cta">
                        <h4 class="text-white mb-4">Become a part of Cross Link bussiness community today</h4>
                        <p class="text-white-50">At vero at a accusamus dignissimos ducimus deleniticorrupti that at blanditiis praesentium deleniticorrupti quos dolores molesti excepturi occaecati similiquesunt culpa officia at deserunt.</p>
                    </div>
                    <div class="mt-4">
                        <a href="#" class="btn btn-primary">Get started</a>
                    </div>
                </div>
            </div>
        </div>
    </section>--}}
    <!-- CTA END -->

    @include('inc.home.foot')
    @include('inc.home.scripts')
</body>
</html>