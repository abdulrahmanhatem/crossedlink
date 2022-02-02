@include('inc.home.head', ['title' => 'Profile'])
<section class="section p-150 bread-crumbs">
    <div class="container">
    <a href="{{ url('/') }}" class="text-muted">{{trans('main.Home')}}</a> / <a href="{{ url('profiles/'.auth()->user()->id) }}" class="text-primary">{{trans('main.Profile')}}</a>
    </div>
</section>

    <div class="worker-profile pt-4">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-12">
                    <div class="left-sidebar ">
                        <ul class="nav nav-pills nav nav-pills bg-white rounded mb-3" id="pills-tab" role="tablist">
                            <li class="nav-item d-block col-12">
                                <a class="nav-link active" href="{{ url('profiles/'. auth()->user()->id) }}">{{trans('main.General Information')}}</a>
                            </li>
                            <li class="nav-item d-block col-12">
                                <a class="nav-link" href="{{ url('profiles/'. auth()->user()->id. '/edit/experience') }}">{{trans('main.Experiences')}}</a>
                            </li>
                            <li class="nav-item d-block col-12">
                                <a class="nav-link"  href="{{ url('profiles/'. auth()->user()->id. '/edit/education') }}">{{trans('main.Education')}}</a>
                            </li>
                            <li class="nav-item d-block col-12">
                                <a class="nav-link"  href="{{ url('profiles/'. auth()->user()->id. '/edit/skills') }}">{{trans('main.Skills')}}</a>
                            </li>
                            <li class="nav-item d-block col-12">
                                <a class="nav-link"  href="{{ url('profiles/'. auth()->user()->id. '/edit/languages') }}">{{trans('main.Languages')}}</a>
                            </li>
                            <li class="nav-item d-block col-12">
                                <a class="nav-link"  href="{{ url('profiles/'. auth()->user()->id. '/edit/social') }}">{{trans('main.Online Presence')}} </a>
                            </li>
                            <li class="nav-item d-block col-12 ">
                                <a class="nav-link"  href="{{ url('profiles/'. auth()->user()->id. '/edit/gallery') }}">{{trans('main.Portfolio')}}</a>
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
                                    {!! Form::open(['action'=> ['ProfileController@update', $user->id], 'method'=>'POST', 'enctype' =>'multipart/form-data' ])!!}
                                        <h5 class="mt-2">{{trans('main.Your Personal Informations')}} :</h5>
                                        <div class="row top-section">
                                            <div class="col-md-8">
                                                <div class="row">
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
                                                            <label class="text-muted">{{trans('main.Phone')}}<span class="valid-star">*</span></label>
                                                            <div class="form-button">
                                                                {!! Form::text('phone', $user->phone ,  ['class' => "form-control r-0 light s-12", 'placeholder' => '+8805112345678', 'id' => 'phone'])!!}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <div class="col-md-4">
                                                <div class="form-group app-label mt-2">
                                                    <label  class="club_avatar employer-avatar" for="profile_image">
                                                        @if (!empty($user->profile_image))
                                                            <img src="{{ asset('uploads/images/profile_images/'.$user->profile_image) }}" alt="" class=" d-block" id ="preview_image">
                                                        @else 
                                                            <img src="{{ asset('uploads/images/profile_images/default.jpg') }}" alt="" class="d-block" id ="preview_image">
                                                        @endif
                                                    </label>
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

                                            
                                        </div>
                                        <h5 class="mt-2">{{trans('main.Location Infomation')}} :</h5>
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
                                            <div class="col-md-4">
                                                <div class="form-group app-label mt-2">
                                                    <label class="text-muted">{{trans('main.Country')}}<span class="valid-star">*</span></label>
                                                    {!! Form::select('country', Helper::countries(), $user->country,  ['class' => "form-control r-0 light s-1 selectpicker", 'placeholder' => trans('main.Country'), 'id' => 'country', 'data-live-search' => "true"])!!}
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group app-label mt-2">
                                                    <label class="text-muted">{{trans('main.City')}}<span class="valid-star">*</span></label>
                                                    @if (!empty(auth()->user()->city))
                                                        <select name='city' class="form-control r-0 light s-12 selectpicker cities" id="city_yes" placeholder = '{{trans('main.City')}}' data-live-search="true"> 
                                                            @foreach($user_city as $key => $value)
                                                                <option name='Kabul' value="{{$key}}" {{auth()->user()->city == $key ? 'selected="selected"':''}} country_code=''>{{$value}} </option>
                                                            @endforeach
                                                        </select>
                                                    @else 
                                                        <select name='city' class="form-control r-0 light s-12 selectpicker cities" id="city" placeholder = '{{trans('main.City')}}' data-live-search="true"> 
                                                            @foreach($user_city as $key => $value)
                                                                <option name='Kabul' value="{{$key}}" {{auth()->user()->city == $key ? 'selected="selected"':''}} country_code=''>{{$value}} </option>
                                                            @endforeach
                                                        </select>

                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group app-label mt-2">
                                                    {!! Form::label('legal', trans('main.Legal State'), ['class' => 'text-muted'], false) !!}
                                                    {!! Form::select('legal', Helper::legal() ,$user->legal,  ['class' => "form-control r-0 light s-12", 'placeholder' => trans('main.Legal State'), 'id' => 'legal'])!!}
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group app-label mt-2">
                                                    <label class="text-muted">{{trans('main.Address')}}</label>
                                                    {!! Form::text('address', $user->address,  ['class' => "form-control resume", 'placeholder' => trans('main.Enter Address'), 'id' => 'address'])!!}
                                                </div>
                                            </div>
                                        </div>

                                        <h5 class="mt-2">{{trans('main.Personal Infomation')}} :</h5>
                                        <div class="row" id ='about'>
                                            <div class="col-md-4">
                                                <div class="form-group app-label mt-2">
                                                    <label class="text-muted">{{trans('main.Birth Date')}}<span class="valid-star">*</span></label>
                                                    {!! Form::text('birth', $user->birth,  ['class' => "form-control r-0 light s-12 date-picker", 'placeholder' => trans('main.Birth Date'), 'id' => 'date-picker'])!!}
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group app-label mt-2">
                                                    <label class="text-muted">{{trans('main.Gender')}}<span class="valid-star">*</span></label>
                                                    {!! Form::select('gender', Helper::gender(), $user->gender,  ['class' => "form-control r-0 light s-12", 'placeholder' => trans('main.Gender'), 'id' => 'gender'])!!}
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group app-label mt-2">
                                                    <label class="text-muted">{{trans('main.Married')}}<span class="valid-star">*</span></label>
                                                    {!! Form::select('married', Helper::married(), $user->married,  ['class' => "form-control r-0 light s-12", 'placeholder' => 'Not Specified', 'id' => 'married'])!!}
                                                </div>
                                            </div>
                                        </div>

                                        <h5 class="mt-2">{{trans('main.Professional Infomation')}} :</h5>
                                        <div class="row">
                                            <div class="col-md-12" >
                                                <div class="form-group app-label mt-2">
                                                    <label class="text-muted">{{trans('main.About Me')}}</label>
                                                    {!! Form::textarea('about', $user->about,  ['class' => "form-control r-0 light s-12", 'placeholder' => trans('main.About Me'), 'id' => 'about'])!!}
                                                </div>
                                            </div>
                                            <div class="col-md-4">
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
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group app-label mt-2">
                                                    <label class="text-muted">{{trans('main.Experience In Years')}}<span class="valid-star">*</span></label>
                                                    {!! Form::select('experience', Helper::experience(), $user->experience,  ['id' => 'experience', 'class' => "form-control r-0 light s-12", 'placeholder' => trans('main.Experience')])!!}
                                                </div>
                                            </div>
                                            <div class="col-md-4">
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
                                        <h5 class="mt-2">{{trans('main.Upload CV')}}:</h5>
                                        <div class="row">
                                            @if (!empty($user->cv))
                                                <div class="col-md-6">
                                                    <div class="input-group app-label  mt-2 mb-2">
                                                        <div class="custom-file">
                                                            <input type="file" name ="cv" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
                                                            <label class="custom-file-label rounded"><i class="mdi mdi-cloud-upload mr-1"></i> {{trans('main.Update CV')}}</label>
                                                        </div>
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
                                        <div class="row">
                                            <div class="col-lg-12 mt-2">
                                                {!! Form::submit(trans('main.Save'), ['class' => "btn btn-primary mt-2 btn-sm", 'name' => 'general']) !!}
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
        </div>
    </div>
    @include('inc.home.foot')
    @include('inc.home.scripts')
<script>
    $(document).ready(function(){
    $("#country").on('change', function() {
            var id = $("#country option:selected").val();
            console.log();
            $.ajax({
                type: 'get',
                url: '{{url("get/cites/")}}/' + id,
                success: function (response) {
                        $('#city').empty();
                        $('#city_yes').empty();
                        
                    $.each(response, function(k, v) {
                        $('#city').append($('<option>', {value:k, text:v}));
                        $('#city_yes').append($('<option>', {value:k, text:v}));
                        
                    });
                    $('#city').selectpicker('refresh');  
                    $('#city_yes').selectpicker('refresh');
                }
            });
        });
        
    }); //END document.ready

    $("#country").on('change', function() {
        console.log($("#cities").val());
        if ($("#cities").val() == $("#country").val()) {
            console.log($("#cities").val());
            $("#cities").val();
        }
    });                                   
    // Date Picker 
    $(".date-picker").flatpickr();
</script>
</body>
</html>