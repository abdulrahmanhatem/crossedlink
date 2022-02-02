@include('inc.home.head', ['title' => trans('main.General Info')])

<section class="p-150 sign-up">
    <div class="container">
        <div class="row steps">
            <div class="col-md-4 col-sm-4 step active">
                <div>
                    <i class="fal fa-grip-lines active"></i>
                    <p>{{trans('main.Career Details')}}</p>
                </div>
            </div>
            <div class="col-md-4 col-sm-4 step  active">
                <div>
                    <i class="fal fa-id-card"></i>
                    <p>{{trans('main.General Info')}}</p>
                </div>
            </div>
            <div class="col-md-4 col-sm-4 step">
                <div>
                    <i class="fal fa-briefcase"></i>
                    <p>{{trans('main.professional Info')}}</p>
                </div>
            </div>
        </div>
        <div class="row">
            {!! Form::open(['action'=> ['ProfileController@update', $user->id], 'method'=>'POST', 'enctype' =>'multipart/form-data', 'class' => 'w-100'  ])!!}

                <div class="offset-lg-3 col-lg-6 offset-md-1 col-md-10 sign-up-panel">
                    <h5 class="mt-2">{{trans('main.Your Personal Informations')}}:</h5>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group app-label mt-2">
                                <label  class="employer-avatar" for="profile_image">
                                    @if (!empty($user->profile_image))
                                        <img src="{{ asset('uploads/images/profile_images/'.$user->profile_image) }}" alt="" class=" d-block" id ="preview_image">
                                    @else 
                                        <img src="{{ asset('uploads/images/profile_images/default.jpg') }}" alt="" class="d-block" id ="preview_image">
                                    @endif
                                </label>
                                {!! Form::file('profile_image', [ 'hidden', 'id' => 'profile_image'])!!}
                                <span class="val-tip muted-text">{{trans('main.Profile Image Type Has To Be An Image with Max Size: 2MB')}}</span>
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
                    <div class="row">
                       
                   
                        <div class="col-md-6">
                            <div class="form-group app-label mt-2">
                                <label class="text-muted">{{trans('main.First Name')}} <span class="valid-star">*</span></label>
                                <div class="form-button">
                                    {!! Form::text('first_name', $user->first_name,  ['class' => "form-control r-0 light s-12", 'placeholder' => trans('main.First Name')])!!}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group app-label mt-2">
                                <label class="text-muted">{{trans('main.Last Name')}} <span class="valid-star">*</span></label>
                                <div class="form-button">
                                    {!! Form::text('middle_name', $user->middle_name,  ['id' => 'middle_name', 'class' => "form-control r-0 light s-12", 'placeholder' => trans('main.Last Name')])!!}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group app-label mt-2">
                                <label class="text-muted">{{trans('main.Nationality')}} <span class="valid-star">*</span></label>
                                {!! Form::select('nationality', Helper::nationalities() , $user->nationality,  ['class' => "form-control r-0 light s-12 selectpicker", 'placeholder' => trans('main.Nationality'), 'id' => 'nationality',  'data-live-search' => "true", ])!!}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group app-label mt-2">
                                <label class="text-muted">{{trans('main.Religion')}} <span class="valid-star">*</span></label>
                                {!! Form::select('religion', Helper::religions() , $user->religion,  ['class' => "form-control r-0 light s-12", 'placeholder' => trans('main.Religion'), 'id' => 'religion'])!!}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group app-label mt-2">
                                <label class="text-muted">{{trans('main.Birth Date')}} <span class="valid-star">*</span></label>
                                {!! Form::text('birth', $user->birth,  ['class' => "form-control r-0 light s-12 date-picker", 'placeholder' => trans('main.Birth Date'), 'id' => 'date-picker'])!!}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group app-label mt-2">
                                <label class="text-muted">{{trans('main.Gender')}} <span class="valid-star">*</span></label>
                                {!! Form::select('gender', Helper::gender(), $user->gender,  ['class' => "form-control r-0 light s-12", 'placeholder' => trans('main.Gender'), 'id' => 'gender'])!!}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group app-label mt-2">
                                <label class="text-muted">{{trans('main.Married')}} <span class="valid-star">*</span></label>
                                {!! Form::select('married', Helper::married(), $user->married,  ['class' => "form-control r-0 light s-12", 'placeholder' => trans('main.Not Specified'), 'id' => 'married'])!!}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group app-label mt-2">
                                {!! Form::label('legal', trans('main.Legal State') , ['class' => 'col-form-label s-12 text-muted'], false) !!}
                                {!! Form::select('legal', Helper::legal() ,$user->legal,  ['class' => "form-control r-0 light s-12", 'placeholder' => trans('main.Legal State'), 'id' => 'legal'])!!}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="offset-sm-3 col-sm-6 sign-up-panel">
                    <h5 class="mt-2">{{trans('main.Your Location')}} :</h5>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group app-label mt-2">
                                <label class="text-muted">{{trans('main.Country')}}<span class="valid-star">*</span></label>
                                {!! Form::select('country', Helper::countries(), $user->country,  ['class' => "form-control r-0 light s-12 selectpicker",  'data-live-search' => "true", 'placeholder' => trans('main.Country'), 'id' => 'country'])!!}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group app-label mt-2">
                                <label class="text-muted">{{trans('main.City')}}<span class="valid-star">*</span></label>
                                {!! Form::text('city', $user->city,  ['id' => 'city', 'class' => "form-control r-0 light s-12", 'placeholder' => trans('main.City')])!!}
                                    <!--@if (!empty(auth()->user()->city))-->
                                    <!--    <select name='city' class="form-control r-0 light s-12 selectpicker" id="city" placeholder = '{{trans('main.City')}}' data-live-search="true"> -->
                                    <!--        @foreach($user_city as $key => $value)-->
                                    <!--            <option name='Kabul' value="{{$key}}" {{auth()->user()->city == $key ? 'selected="selected"':''}} country_code=''>{{$value}} </option>-->
                                    <!--        @endforeach-->
                                    <!--    </select>-->
                                    <!--@else -->
                                    <!--    <select name='city' class="form-control r-0 light s-12 selectpicker" id="city" placeholder = '{{trans('main.City')}}' data-live-search="true"> -->
                                    <!--        @foreach($user_city as $key => $value)-->
                                    <!--            <option name='Kabul' value="{{$key}}" {{auth()->user()->city == $key ? 'selected="selected"':''}} country_code=''>{{$value}} </option>-->
                                    <!--        @endforeach-->
                                    <!--    </select>-->
                                    <!--@endif-->
                                {{--<label class="text-muted">{{trans('main.City')}}</label>
                                {!! Form::select('city', $user_cities, $user->city,  ['class' => "form-control r-0 light s-12 selectpicker",  'data-live-search' => "true", 'placeholder' => trans('main.City'), 'id' => 'city'])!!}--}}
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group app-label mt-2">
                                <label class="text-muted">{{trans('main.Address')}}</label>
                                {!! Form::text('address', $user->address,  ['class' => "form-control resume", 'placeholder' => trans('main.Enter Address'), 'id' => 'address'])!!}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="offset-sm-3 col-sm-6 sign-up-panel country-code">
                    <h5 class="mt-2">{{trans('main.Contacts')}} :</h5>
                    <label class="text-muted">{{trans('main.Phone')}}<span class="valid-star">*</span></label>
                    <div class="row">
                        <div class="col-sm-3 pr-0">
                            <div class="form-group app-label mt-2">
                                    @if(!empty($user->phone_code))
                                        <select name="countryCode" id="countryCode" class="form-control r-0 light s-12 selectpicker countryCode" data-live-search ="true" value='{{explode("-",$user->phone_code)[0] }}'>
                                    @else 
                                        <select name="countryCode" id="countryCode" class="form-control r-0 light s-12 selectpicker countryCode" data-live-search ="true">
                                    @endif
                                    
                                    <option data-countryCode="SA" value="966">{{trans('main.Saudi Arabia')}} (+966)</option>
                                    
                                        <optgroup label="{{trans('main.Other Countries')}}">
                                        @foreach(Helper::countryCodes() as $key => $value)
                                            @if($key != 966)
                                                <option value="{{'+'.$key}}">{{$value}} (+{{$key}})</option>
                                            @endif
                                        @endforeach
                                    </optgroup>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-9 pl-0">
                            <div class="form-group app-label mt-2">
                                <div class="form-button">
                                    @if(!empty($user->phone))
                                        {!! Form::text('phone_no', explode("-",$user->phone_code)[1],   ['class' => "form-control r-0 light s-12 country-code-phone", 'placeholder' => trans('main.Your Phone Number'), 'id' => 'phoneNumber'])!!}
                                    @else 
                                        {!! Form::text('phone_no', '',   ['class' => "form-control r-0 light s-12 country-code-phone", 'placeholder' => trans('main.Your Phone Number'), 'id' => 'phoneNumber'])!!}
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <input id="phone" type="text" name="phone" hidden value>
                <script></script>
                <div class="offset-sm-3 col-sm-6 px-0">
                    <div class="col-lg-12 mt-2 px-0">
                        <div class="form-group app-label mt-2  px-0">
                            <a href="{{ url('interests') }}" class="btn back mt-2 btn-sm mb-3">{{trans('main.Back')}}</a>
                            {!! Form::submit(trans('main.Save And Continue'), ['class' => "btn btn-primary mt-2 btn-sm float-right mb-3 sign-save", 'name' => 'edit-general-info']) !!}
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
                
            
            {!! Form::hidden('_method', 'PUT') !!}
            {!! Form::close() !!}
        </div>
    </div>
</section>

@include('inc.home.foot')
@include('inc.home.scripts')

@php $code = explode("-",$user->phone_code)[0]  @endphp


<script>
    $(document).ready(function(){
        
    $("#countryCode").on('change', function() {
        $('#phone').attr('value',  $(this).val() + $('#phoneNumber').val());
    });
    
    $("#phoneNumber").on('change', function() {
        $('#phone').attr('value', $('#countryCode').val() + $(this).val()); 
    });
           
    // $("#country").on('change', function() {
    //     var id = $("#country option:selected").val();
    //     console.log();
    //     $.ajax({
    //         type: 'get',
    //         url: '{{url("get/cites/")}}/' + id,
    //         success: function (response) {
    //                 $('#city').empty();
    //                 $('#city_yes').empty();
                    
    //             $.each(response, function(k, v) {
    //                 $('#city').append($('<option>', {value:k, text:v}));
    //                 $('#city_yes').append($('<option>', {value:k, text:v}));
                    
    //             });
    //             $('#city').selectpicker('refresh');  
    //             $('#city_yes').selectpicker('refresh');
    //         }
    //     });
    // });
        

    }); //END document.ready
    // Date Picker 
    $(".date-picker").flatpickr(
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
    var code = '<?php echo $code?>';
    console.log(code);
    $('.countryCode option[value="'+ code +'"]').attr('selected', 'selected');

    Dropzone.options.dropzone =
        {
            maxFilesize: 12,
            renameFile: function(file) {
                var dt = new Date();
                var time = dt.getTime();
               return time+file.name;
            },
            acceptedFiles: ".jpeg,.jpg,.png,.gif",
            addRemoveLinks: true,
            timeout: 5000,
            success: function(file, response) 
            {
                console.log(response);
            },
            error: function(file, response)
            {
               return false;
            }
        };
</script>
</body>
</html>