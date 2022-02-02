@include('inc.home.head', ['title' => trans('main.Checkout')])
 
    <section class="section p-150 bread-crumbs">
        <div class="container">
        <a href="{{ url('/') }}" class="text-muted">{{trans('main.Home')}}</a> / <a href="{{ url('myPackage') }}" class="text-primary">{{trans('main.Packages')}}</a>/ <a href="{{ url('checkout') }}" class="text-primary">{{trans('main.Checkout')}}</a>
        </div>
    </section>
    <section class="section candidate-profile checkout-page">
        <div class="container">
            <h5 class="text-center">{{trans('main.Checkout')}}</h5>
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div class="container">
                        {{--<div class="row justify-content-center row-top">
                            <div class="col-lg-9 text-center mt-4 pt-2">
                                <ul class="nav nav-pills nav nav-pills bg-white rounded nav-justified flex-column flex-sm-row" id="pills-tab" role="tablist">
                                    <li class="nav-item w-100" style="width:100%!important">
                                        <a class="nav-link rounded active" id="about-tab" data-toggle="pill" href="#about" role="tab" aria-controls="about" aria-selected="true">{{trans('main.Cobone')}}</a>
                                    </li>
                                </ul>
                            </div>
                        </div>--}}
                        <div class="row">
                            <div class="w-100">
                                <div class="tab-content" id="pills-tabContent">
                                    <div class="tab-pane fade show active" id="about" role="tabpanel" aria-labelledby="about-tab">
                                        <div class="row">
                                            <div class="col-lg-12 px-0">
                                                <div class="py-2 text-left">
                                                    <div class="row profile-top">

                                                        <div class="offset-md-0 col-md-6 offset-lg-2 col-lg-4 col-sm-12 checkout-box ">
                                                            <h2>{{trans('main.Billing Details')}}</h2>
                                                            <div class="billing-box">
                                                                @if (!empty(auth()->user()->company_name))
                                                                <div class="email">
                                                                    <label class="profile-label">{{trans('main.Company Name')}}:</label>
                                                                    <span>
                                                                        
                                                                            {{ ucwords(auth()->user()->company_name) }}
                                                                        
                                                                    </span>
                                                                </div>
                                                            @endif
                                                            <div class="email">
                                                                <label class="profile-label">{{trans('main.Contact Name')}}:</label>
                                                                <span>
                                                                    {{ auth()->user()->name }}
                                                                </span>
                                                            </div>
                                                            <div class="email">
                                                                <label class="profile-label">{{trans('main.Email')}}:</label>
                                                                <span>
                                                                    {{ auth()->user()->email }}
                                                                </span>
                                                            </div>
                                                                @if (!empty(auth()->user()->phone) || !empty(auth()->user()->phone_2))
                                                                    
                                                                    <div class="email">
                                                                        <label class="profile-label">{{trans('main.Phone')}}:</label>
                                                                        @if (!empty(auth()->user()->phone))
                                                                            <span>
                                                                                {{ auth()->user()->phone }}
                                                                            </span>
                                                                        @endif
                                                                    </div>
                                                                @else 
                                                                @endif
                                                                @if (!empty(auth()->user()->country))
                                                                    <div class="email">
                                                                        <label class="profile-label">{{trans('main.Country')}}:</label>
                                                                        <span>
                                                                            {{ Helper::getCountryByKey(auth()->user()->country) }}
                                                                        </span>
                                                                    </div>
                                                                @endif
                                                                @if (!empty(auth()->user()->city))
                                                                    <div class="email">
                                                                        <label class="profile-label">{{trans('main.City')}}:</label>
                                                                        <span>
                                                                            {{ Helper::getCityByID(auth()->user()->city) }}
                                                                        </span>
                                                                    </div>
                                                                @endif
                                                                
                                                                    @if (!empty(auth()->user()->address))
                                                                        <div class="email">
                                                                            <label class="profile-label">{{trans('main.Address')}}:</label>
                                                                            <span>
                                                                                {{ auth()->user()->address }}
                                                                            </span>
                                                                        </div>
                                                                    @endif
                                                                
                                                            </div>
                                                            <div class="sub">
                                                            <span class='sub-label'>{{trans('main.Subtotal')}}</span><span class='sub-price'>{{$package->price}}<span class="currency"> {{trans('main.SAR')}}</span>
                                                            </div>
                                                           
                                                        </div>
                                                        <div class="offset-md-0 col-md-6 col-lg-4 col-sm-12 package-box">
                                                               
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
                                                                                    <li class="text-muted"><i class="fal fa-clock mx-1"></i>{{trans('main.Package Duration')}} <span class="pricing-val">{{ $package->period }} {{trans('main.Days')}}</span></li>
                                                                                </ul>
                                                                                <ul class="list-unstyled mb-0 " id="">
                                                                                    <li class="text-muted"><i class="fad fa-money-check-edit-alt"></i>{{trans('main.Tax')}} <span class="pricing-val">{{ $package->tax = 1 ? trans('main.Included') : trans('main.Not Included') }}</span></li>
                                                                                </ul>
                                                                            </div>
                                                                        </div>
                                                                         @if (count($pricing) > 0)
                                                                            @if($package->role == 3 || $package->role == 4)
                                                                                <div class="text-center border-top p-4 mt-4">
                                                                                    {!! Form::open(['action'=>'EmployerClientController@pricing_request', 'method'=>'POST'])!!}
                                                                                    {!! Form::text('package_id', $package->id, ['hidden'])!!}
                                                                                    {!! Form::text('profiles', $package->profiles, ['hidden'])!!}
                                                                                    {!! Form::text('ads', $package->ads, ['hidden'])!!}
                                                                                    {!! Form::text('period', $package->period, ['hidden'])!!}
                                                                                    {!! Form::submit(trans('main.Confirm'), ['class' => "btn btn-block btn-primary-outline", 'name' => 'add-extention']) !!}
                                                                                    {!! Form::close() !!} 
                                                                                </div>
                                                                            @else 
                                                                                <div class="text-center border-top p-4 mt-4">
                                                                                    <a href="{{url('myPackage')}}">
                                                                                        {{trans('main.You Subscribed A Package')}}
                                                                                    </a> 
                                                                                </div>   
                                                                            @endif
                                                                        @else 
                                                                            <div class="text-center border-top p-4 mt-4">
                                                                                {!! Form::open(['action'=>'EmployerClientController@pricing_request', 'method'=>'POST'])!!}
                                                                                {!! Form::text('package_id', $package->id, ['hidden'])!!}
                                                                                {!! Form::text('profiles', $package->profiles, ['hidden'])!!}
                                                                                {!! Form::text('ads', $package->ads, ['hidden'])!!}
                                                                                {!! Form::text('period', $package->period, ['hidden'])!!}
                                                                                {!! Form::submit(trans('main.Confirm'), ['class' => "btn btn-block btn-primary-outline"]) !!}
                                                                                {!! Form::close() !!} 
                                                                            </div>
                                                                        @endif
                                                            </div>
                                                      
                                                            <!-- Modal -->
                                                            <div class="modal fade" id="cobone" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLabel">{{trans('main.Deduction Coupon')}}</h5>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <div class="form-group  m-0">
                                                                                {!! Form::label('code', 'Coupon Code', ['class' => 'col-form-label s-12']) !!}
                                                                                {!! Form::text('code', '', ['class' => "form-control r-0 light s-12", 'placeholder' => trans('main.Coupon code')])!!}
                                                                                <div class="valid-feedback">
                                                                                    {{trans('main.Looks Good')}}
                                                                                </div>
                                                                                <div class="invalid-feedback">
                                                                                    {{trans('main.Please Provide a Valid Input')}}
                                                                                </div>
                                                                                {{--{!! Form::submit(trans('main.Activate'), ['class' => "btn btn-primary btn-lg"]) !!}--}}
                                                                                {!! Form::close() !!}
                                                                            </div>
                                                                            
                                                                            {{--{!! Form::open(['action'=> ['CoboneController@update', $cobone->id], 'method'=>'POST', 'enctype' =>'multipart/form-data' ])!!}
                                                                
                                                                            <div class="form-group col-4 m-0">
                                                                                {!! Form::label('code', 'Cobone Code', ['class' => 'col-form-label s-12']) !!}
                                                                                {!! Form::text('code', $cobone->code, ['class' => "form-control r-0 light s-12", 'placeholder' => 'Cobone code'])!!}
                                                                                <div class="valid-feedback">
                                                                                    Looks Good
                                                                                </div>
                                                                                <div class="invalid-feedback">
                                                                                    Please Provide a Valid Name
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group col-4 m-0">
                                                                                {!! Form::label('percentage', 'percentage', ['class' => 'col-form-label s-12']) !!}
                                                                                {!! Form::text('percentage',$cobone->percentage, ['class' => "form-control r-0 light s-12", 'placeholder' => 'percentage', 'id' => 'percentage'])!!}
                                                                                <div class="valid-feedback">
                                                                                    Looks Good
                                                                                </div>
                                                                                <div class="invalid-feedback">
                                                                                    Please Provide a Valid Name
                                                                                </div>
                                                                            </div> 
                                                                            @csrf
                                                                            {!! Form::hidden('_method', 'PUT') !!}
                                                                            {!! Form::submit('Save Data', ['class' => "btn btn-primary btn-lg"]) !!}
                                                                            {!! Form::close() !!}--}}
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{trans('main.Close')}}</button>
                                                                        {{--<a type="button" class="btn btn-primary" href="{{url('checkout_success')}}">{{trans('main.Activate')}}</a>--}}
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