@include('inc.home.head', ['title' => !empty($user->company_name) ?  $user->company_name : $user->name])
    
    <section class="section p-150">
        <div class="container">
            <a href="{{ url('/profiles/'.auth()->user()->id) }}" class="text-primary">{{trans('main.Profile')}}</a> / <a href="{{ url('/') }}" class="text-muted">{{trans('main.Home')}}</a> 
        </div>
    </section>
    <!-- end home -->
    <div class="worker-profile pt-2">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-12  my-4">
                    <div class="left-sidebar ">
                        <ul class="nav nav-pills nav nav-pills bg-white rounded" id="pills-tab" role="tablist">
                            <li class="nav-item d-block col-12">
                                <a class="nav-link active" id="general-tab"  href="{{ url('profiles/'.$user->id.'/edit') }}">{{trans('main.General Information')}}</a>
                            </li>
                            @if (auth()->user()->role == 2)
                            <li class="nav-item d-block col-12">
                                <a class="nav-link" id="branch-tab"  href="{{ url('profiles/'.$user->id.'/edit/branch') }}">{{trans('main.Branches')}}</a>
                            </li>
                            @endif
                            <li class="nav-item d-block col-12">
                                <a class="nav-link" id="package-tab" href="{{ url('myPackage') }}">{{trans('main.Subscribed Package')}}</a>
                            </li>
                            <li class="nav-item d-block col-12">
                                <a class="nav-link" id="unblock-tab"  href="{{ url('unlock') }}" >{{trans('main.Unblock List')}}({{ count(Helper::unblockList(auth()->user()->id)) }})</a>
                            </li>
                            <li class="nav-item d-block col-12">
                                <a class="nav-link" id="unblock-tab"  href="{{ url('favorite') }}" >{{trans('main.Saved List')}}({{ count(Helper::favList(auth()->user()->id)) }})</a>
                            </li>
                            <li class="nav-item d-block col-12 ">
                                <a class="nav-link"  href="{{ url('chat') }}">{{trans('main.Chat')}}</a>
                            </li>
                        </ul>
                    </div>
                </div>
        
                <div class="col-lg-9 col-md-12 profile-edit">
                    <div class="tab-content mt-2" id="pills-tabContent">
                        <div class="tab-pane fade show active general" id="general" role="tabpanel" aria-labelledby="general-tab">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="custom-form">
                                        {!! Form::open(['action'=> ['ProfileController@update', $user->id], 'method'=>'POST', 'enctype' =>'multipart/form-data' ])!!}
                                        
                                        
                                        @if(count($errors) > 0)
                                            @foreach ($errors->all() as $error)
                                            <span class="text-danger">{{ $error }}</span>
                                            @endforeach
                                        @endif   
                                            <div class="row  top-section">
                                                <div class="col-md-8">
                                                @if (auth()->user()->role == 2)
                                                    <div class="form-group app-label mt-2">
                                                        <h5 class="mt-2">{{trans('main.Company Name')}}:</h5>
                                                        {!! Form::text('company_name', $user->company_name,  ['id' => 'company_name', 'class' => "form-control resume", 'placeholder' => trans('main.Company Name')])!!}
                                                    </div>
                                                @endif

                                                    <h5 class="mt-2">{{trans('main.Contact Informations')}} :</h5>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <label class="text-muted">{{trans('main.First Name')}}</label>
                                                            <div class="form-group">
                                                                {!! Form::text('first_name', $user->first_name,  ['class' => "form-control r-0 light s-12", 'placeholder' => trans('main.First Name')])!!}
                
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label class="text-muted">{{trans('main.Last Name')}}</label>
                                                            <div class="form-group">
                                                                {!! Form::text('middle_name', $user->middle_name,  ['id' => 'middle_name', 'class' => "form-control r-0 light s-12", 'placeholder' => trans('main.Last Name')])!!}
                
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group app-label mt-2">
                                                                <label class="text-muted">{{trans('main.Email')}}</label>
                                                                <div class="form-button">
                                                                    {!! Form::text('email', $user->email ,  ['id' => 'email', 'class' => "form-control rounded", 'placeholder' => trans('main.Category'), 'readonly'])!!}
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group app-label mt-2">
                                                                <label class="text-muted">{{trans('main.Phone')}}</label>
                                                                <div class="form-button">
                                                                    {!! Form::text('phone', $user->phone,  ['class' => "form-control r-0 light s-12", 'placeholder' => '+9665112345678', 'id' => 'phone'])!!}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
            
                                                <div class="col-md-4">
                                                    <div class="form-group app-label mt-2">
                                                        <label  class="club_avatar" for="profile_image" id ='preview'>
                                                            @if (!empty($user->profile_image))
                                                                <img src="{{ asset('uploads/images/profile_images/'.$user->profile_image) }}" alt="" class="img-fluid mx-md-auto d-block" id ="preview_image">
                                                            @else 
                                                                <img src="{{ asset('uploads/images/profile_images/default_company.jpg') }}" alt="" class="img-fluid mx-md-auto d-block" id ="preview_image">
                                                            @endif
                                                            <span class="val-tip muted-text">{{trans('main.Logo Type Has To Be An Image with Max Size: 2MB')}}</span>
                                                        </label>
                                                        {!! Form::file('profile_image', [ 'hidden', 'id' => 'profile_image'])!!}
                                                    </div>
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
            
                                            <div class="row">
                                                @if (auth()->user()->role == 2)
                                                <div class="col-md-6">
                                                    <div class="form-group app-label mt-2">
                                                        <label class="text-muted">{{trans('main.Website')}}</label>
                                                        {!! Form::text('website', $user->website,  ['class' => "form-control r-0 light s-12", 'placeholder' => 'WWW.example.com', 'id' => 'website'])!!}
                                                    </div>
                                                </div>
                                                @endif
                                              
                                                <div class="col-md-6">
                                                    <div class="form-group app-label mt-2">
                                                        <label class="text-muted">{{trans('main.Country')}}</label>
                                                        {!! Form::select('country', Helper::countries( ), $user->country,  ['class' => "form-control r-0 light s-12 selectpicker", 'placeholder' => trans('main.Country'), 'id' => 'country',  'data-live-search' => "true"])!!}
                                                    </div>
                                                </div>
                                                @if (auth()->user()->role == 2)
                                                    <div class="col-md-12">
                                                @else 
                                                    <div class="col-md-6">
                                                @endif
                                                
                                                    <div class="form-group app-label mt-2">
                                                        <label class="text-muted">{{trans('main.Address')}}</label>
                                                        {!! Form::text('address', $user->address,  ['class' => "form-control resume", 'placeholder' => trans('main.Enter Address'), 'id' => 'address'])!!}
                                                    </div>
                                                </div>
                                                {{--<div class="col-md-6">
                                                    <div class="form-group app-label mt-2">
                                                        <label class="text-muted">Another Phone</label>
                                                        <div class="form-button">
                                                            @if(!empty($user->phone_2))
                                                                {!! Form::text('phone_2', '0'.$user->phone,  ['class' => "form-control r-0 light s-12", 'placeholder' => '05112345678', 'id' => 'phone_2'])!!}
                                                            @else
                                                                {!! Form::text('phone_2', $user->phone,  ['class' => "form-control r-0 light s-12", 'placeholder' => '05112345678', 'id' => 'phone_2'])!!}
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>--}}
                                            </div>
            
                                            <div class="row">
                                                
                                            </div>
                                            @if (auth()->user()->role == 2)
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group app-label mt-2">
                                                            <label class="text-muted">{{trans('main.Experience (Years)')}}</label>
                                                            {!! Form::text('experience', $user->experience,  ['id' => 'experience', 'class' => "form-control r-0 light s-12", 'placeholder' => trans('main.Experience (Years)')])!!}
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group app-label mt-2">
                                                            <label class="text-muted">{{trans('main.Employers')}}</label>
                                                            {!! Form::text('employers', $user->employers,  ['class' => "form-control r-0 light s-12", 'placeholder' => trans('main.Employers'), 'id' => 'employers'])!!}
                                                        </div>
                                                    </div>
                                                </div>
                                            
                                           
            
                                            
            
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group app-label mt-2">
                                                        <label class="text-muted">{{trans('main.Company Description')}}</label>
                                                        {!! Form::textarea('overview', $user->overview,  ['class' => "form-control resume", 'placeholder' => trans('main.Company Description'), 'id' => 'overview'])!!}
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group app-label mt-2">
                                                        <label class="text-muted">{{trans('main.Company Services')}}</label>
                                                        {!! Form::textarea('services', $user->services,  ['class' => "form-control r-0 light s-12", 'placeholder' => trans('main.Company Services'), 'id' => 'services'])!!}
                                                    </div>
                                                </div>
                                            </div>
                                            @endif
                                            <h5 class="mt-2">{{trans('main.Operating Hours')}} :</h5>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-row">
                                                        <div class="form-group col-sm-3 col-sm-6 m-0 o-hours">
                                                            {!! Form::label('sa', trans('main.Saturday'), ['class' => 'col-form-label s-12'], false) !!}
                                                            {!! Form::select('sa_from',  Helper::operatingHours() ,$user->sa_from,['id' => 'sa', 'class' => "form-control r-0 light s-12", 'placeholder' => trans('main.From'), 'type' => 'number'])!!}
                                                            {!! Form::select('sa_to',  Helper::operatingHours() ,$user->sa_to,['id' => 'sa', 'class' => "form-control r-0 light s-12", 'placeholder' => trans('main.To'), 'type' => 'number'])!!}
                                                        </div>
                                                        
                                                       
                                                        <div class="form-group col-sm-3 col-sm-6 m-0 o-hours">
                                                            {!! Form::label('su', trans('main.Sunday'), ['class' => 'col-form-label s-12'], false) !!}
                                                            {!! Form::select('sa_from',  Helper::operatingHours() ,$user->sa_from,['id' => 'sa', 'class' => "form-control r-0 light s-12", 'placeholder' =>  trans('main.From'), 'type' => 'number'])!!}
                                                            {!! Form::select('su_to',  Helper::operatingHours() ,$user->su_to,  ['id' => 'su', 'class' => "form-control r-0 light s-12", 'placeholder' => trans('main.To'), 'type' => 'number'])!!}
                                                        </div>
                                                       
                                                        <div class="form-group col-sm-3 col-sm-6 m-0 o-hours">
                                                            {!! Form::label('mo', trans('main.Monday'), ['class' => 'col-form-label s-12'], false) !!}
                                                            {!! Form::select('mo_from',  Helper::operatingHours() ,$user->mo_from,  ['id' => 'mo', 'class' => "form-control r-0 light s-12", 'placeholder' =>  trans('main.From'), 'type' => 'number'])!!}
                                                            {!! Form::select('mo_to',  Helper::operatingHours() ,$user->mo_to,  ['id' => 'mo', 'class' => "form-control r-0 light s-12", 'placeholder' => trans('main.To'), 'type' => 'number'])!!}
                                                        </div>
                                                   
                                                        <div class="form-group col-sm-3 col-sm-6 m-0 o-hours">
                                                            {!! Form::label('tu', trans('main.Tuesday'), ['class' => 'col-form-label s-12'], false) !!}
                                                            {!! Form::select('tu_from',  Helper::operatingHours() ,$user->tu_from,  ['id' => 'tu', 'class' => "form-control r-0 light s-12", 'placeholder' =>  trans('main.From'), 'type' => 'number'])!!}
                                                            {!! Form::select('tu_to',  Helper::operatingHours() ,$user->tu_to,  ['id' => 'tu', 'class' => "form-control r-0 light s-12", 'placeholder' => trans('main.To'), 'type' => 'number'])!!}
                                                        </div>
                                                  
                                                        <div class="form-group col-sm-3 col-sm-6 m-0 o-hours">
                                                            {!! Form::label('we', trans('main.Wednesday'), ['class' => 'col-form-label s-12'], false) !!}
                                                            {!! Form::select('we_from',  Helper::operatingHours() ,$user->we_from,  ['id' => 'we', 'class' => "form-control r-0 light s-12", 'placeholder' =>  trans('main.From'), 'type' => 'number'])!!}
                                                            {!! Form::select('we_to',  Helper::operatingHours() ,$user->we_to,  ['id' => 'we', 'class' => "form-control r-0 light s-12", 'placeholder' => trans('main.To'), 'type' => 'number'])!!}
                                                        </div>
                                                     
                                                        <div class="form-group col-sm-3 col-sm-6 m-0 o-hours">
                                                            {!! Form::label('th', trans('main.Thursday'), ['class' => 'col-form-label s-12'], false) !!}
                                                            {!! Form::select('th_from',  Helper::operatingHours() ,$user->th_from,  ['id' => 'th', 'class' => "form-control r-0 light s-12", 'placeholder' =>  trans('main.From'), 'type' => 'number'])!!}
                                                            {!! Form::select('th_to',  Helper::operatingHours() ,$user->th_to,  ['id' => 'th', 'class' => "form-control r-0 light s-12", 'placeholder' => trans('main.To'), 'type' => 'number'])!!}
                                                        </div>
                                                       
                                                        <div class="form-group col-sm-3 col-sm-6 m-0 o-hours">
                                                            {!! Form::label('fr', trans('main.Friday'), ['class' => 'col-form-label s-12'], false) !!}
                                                            {!! Form::select('fr_from',  Helper::operatingHours() ,$user->fr_from,  ['id' => 'fr', 'class' => "form-control r-0 light s-12", 'placeholder' =>  trans('main.From'), 'type' => 'number'])!!}
                                                            {!! Form::select('fr_to',  Helper::operatingHours() , $user->fr_to,  ['id' => 'fr', 'class' => "form-control r-0 light s-12", 'placeholder' => trans('main.To'), 'type' => 'number'])!!}
                                                        </div>
                                                       
                                                    </div>
                                                </div>
                                            </div>
                                            
            
                                            </div>
            
                                            <div class="row">
                                                <div class="col-lg-12 mt-2">
                                                    {!! Form::submit('Save', ['class' => "btn btn-primary my-3"]) !!}
                                                </div>
                                            </div>
                                        {!! Form::hidden('_method', 'PUT') !!}
                                        {!! Form::close() !!}
                                    </div>
                                </div>
                            </div>
                        </div>
        
                        <div class="tab-pane fade experiences" id="experiences" role="tabpanel" aria-labelledby="experiences-tab">
                            
                        </div>

                        <div class="tab-pane fade education" id="education" role="tabpanel" aria-labelledby="education-tab">
                            
                        </div>
                        <div class="tab-pane fade skills" id="skills" role="tabpanel" aria-labelledby="skills-tab">
                            
                        </div>
                        <div class="tab-pane fade languages" id="languages" role="tabpanel" aria-labelledby="languages-tab">
                            
                        </div>
                        
                        <div class="tab-pane fade social" id="social" role="tabpanel" aria-labelledby="social-tab">
                           
                        </div>
                    </div>
                </div>
            </div>   
        </div>
    </div>

    <!-- POST A JOB START -->
    
    <!-- POST A JOB END -->


@include('inc.home.foot')
@include('inc.home.scripts')
<script>
    // Date Picker 
    $("#date-picker").flatpickr();

    const inpFile = document.getElementById('')
</script>
</body>
</html>