@include('inc.header')


<div class="page has-sidebar-left  height-full company-crete">
    <header class="blue accent-3 relative">
        <div class="container-fluid text-white">
            <div class="row p-t-b-10 ">
                <div class="col">
                    <h4>
                        <i class="icon-database"></i>
                        workers
                    </h4>
                </div>
            </div>
            <div class="row justify-content-between">
                <ul class="nav nav-material nav-material-white responsive-tab" id="v-pills-tab" role="tablist">
                    <li>
                        <a class="nav-link"  href="{{url('dashboard/workers')}}"><i class="icon icon-home2"></i>All workers</a>
                    </li>
                    <li>
                        <a class="nav-link active"  href="{{url('dashboard/workers/'. $worker->id .'/edit')}}" ><i class="icon icon-plus-circle"></i> Edit workers</a>
                    </li>
                </ul>
            </div>
        </div>
    </header>
    <div class="container-fluid animatedParent animateOnce">
        <div class="animated fadeInUpShort">
            <div class="row my-3">
                <div class="col-md-7  offset-md-2">
                    {!! Form::open(['action'=> ['WorkerController@update', $worker->id], 'method'=>'POST', 'enctype' =>'multipart/form-data' ])!!}
                        <div class="card no-b  no-r">
                            <div class="card-body">
                                <div class="form-row profile-container">
                                    <div class="col-md-8">
                                        <h5 class="card-title">Contact Informations</h5>
                                        <div class="form-row mt-1">
                                            <div class="form-group col-6 m-0">
                                                {!! Form::label('first_name', 'First Name', ['class' => 'col-form-label s-12']) !!}
                                                {!! Form::text('first_name', $worker->first_name,  ['class' => "form-control r-0 light s-12", 'placeholder' => 'First Name'])!!}
                                                <div class="valid-feedback">
                                                    Looks Good
                                                </div>
                                                <div class="invalid-feedback">
                                                    Please Provide a Valid Name
                                                </div>
                                            </div>
                                            <div class="form-group col-6 m-0">
                                                {!! Form::label('middle_name', 'Last Name', ['class' => 'col-form-label s-12']) !!}
                                                {!! Form::text('middle_name', $worker->middle_name,  ['id' => 'middle_name', 'class' => "form-control r-0 light s-12", 'placeholder' => 'Last Name'])!!}
                                                <div class="valid-feedback">
                                                    Looks Good
                                                </div>
                                                <div class="invalid-feedback">
                                                    Please Provide a Your Name
                                                </div>
                                            </div>
                                        </div>     
                                        <div class="form-row">
                                            <div class="form-group col-md-4 col-sm-12 m-0">
                                                {!! Form::label('password', 'Password', ['class' => 'col-form-label s-12']) !!}
                                                {!! Form::password('password', ['class' => "form-control r-0 light s-12", 'placeholder' => 'Password', 'id' => 'password'])!!}
                                            </div>
                                            <div class="form-group col-4 m-0">
                                                {!! Form::label('country', 'Country', ['class' => 'col-form-label s-12'], false) !!}
                                                {!! Form::select('country', Helper::countries(), !empty($user_country) ? $user_country->code : 0, [ 'class' => 'form-control r-0 light s-12','id'=>'country', 'placeholder' => 'Country'])!!}

                                            </div>
                                             <div class="form-group col-sm-4 m-0">
                                                {!! Form::label('city', 'City', ['class' => 'col-form-label s-12'], false) !!}
                                                {!! Form::text('city', $worker->city,  ['id' => 'city', 'class' => "form-control r-0 light s-12", 'placeholder' => trans('main.City')])!!}
                                                <!--<select name='city' class="form-control r-0 light s-12 " id="city" placeholder = '{{trans('main.City')}}' data-live-search="true"> -->
                                                <!--    @foreach($user_city as $key => $value)-->
                                                <!--        <option name='Kabul' value="{{$key}}" {{auth()->user()->city == $key ? 'selected="selected"':''}} country_code=''>{{$value}} </option>-->
                                                <!--    @endforeach-->
                                                <!--</select>-->
                                            </div>
                                            <div class="form-group col-4 m-0">
                                                    <label>Nationality <span class="text-danger">*</span></label>
                                                    {!! Form::select('nationality', Helper::nationalities(), $worker->nationality, [ 'class' => 'form-control r-0 light s-12', 'placeholder' => 'Nationality'])!!}
                                            </div>
                                        </div>
                                        <h5 class="card-title mt-4">Personal Informations</h5>
                                        <div class="form-row mt-1">
                                            <div class="form-group col-6 m-0">
                                                {!! Form::label('email', '<i class="icon-envelope-o mr-2"></i>Email', ['class' => 'col-form-label s-12'], false) !!}
                                                {!! Form::text('email', $worker->email,  ['class' => "form-control r-0 light s-12", 'placeholder' => 'worker@email.com', 'id' => 'email', 'required'])!!}
                                                <div class="valid-feedback">
                                                    Looks Good
                                                </div>
                                                <div class="invalid-feedback">
                                                    Please Provide a Valid Email
                                                </div>
                                            </div>
        
                                            <div class="form-group col-6 m-0">
                                                {!! Form::label('phone', '<i class="icon-phone mr-2"></i>Phone', ['class' => 'col-form-label s-12'], false) !!}
                                                {!! Form::text('phone', $worker->phone,  ['class' => "form-control r-0 light s-12", 'placeholder' => '05112345678', 'id' => 'phone'])!!}
                                            </div>
                                            <div class="form-group col-sm-12 m-0">
                                                {!! Form::label('address', 'Worker Address', ['class' => 'col-form-label s-12'], false) !!}
                                                {!! Form::text('address', $worker->address,  ['class' => "form-control r-0 light s-12", 'placeholder' => 'Enter Address', 'id' => 'address'])!!}
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-sm-4 m-0">
                                                {!! Form::label('birth', 'Birth', ['class' => 'col-form-label s-12'], false) !!}
                                                    <input type="text" class="date-time-picker form-control r-0 light s-12 calender" name="birth" placeholder ="Birth Date" id = 'calender' value="{{ $worker->birth}}"
                                                       data-options='{
                                                       "format":"Y.m.d",
                                                       "timepicker": false
                                                       }'/>

                                                       <script>
                                                           jQuery(function(){
                                                                jQuery('#date_timepicker_start').datetimepicker({
                                                                    format:'Y/m/d',
                                                                    onShow:function( ct ){
                                                                        this.setOptions({
                                                                            maxDate:jQuery('#date_timepicker_end').val()?jQuery('#date_timepicker_end').val():false
                                                                        })
                                                                    },
                                                                        timepicker:false
                                                                    });
                                                                    jQuery('#date_timepicker_end').datetimepicker({
                                                                        format:'Y/m/d',
                                                                        onShow:function( ct ){
                                                                            this.setOptions({
                                                                                minDate:jQuery('#date_timepicker_start').val()?jQuery('#date_timepicker_start').val():false
                                                                            })
                                                                        },
                                                                        timepicker:false
                                                                    });

                                                                    var calendar = new CalendarPopup('#calender', {
                                                                        timepicker: false
                                                                    });
                                                                });
                                                       </script>
                                            </div>
                                            <div class="form-group col-sm-4 m-0">
                                                {!! Form::label('gender', 'Gender', ['class' => 'col-form-label s-12'], false) !!}
                                                {!! Form::select('gender', [0 => 'Male', 1 => 'Female', 3 => 'Other'],  $worker->gender,['class' => "form-control r-0 light s-12", 'id' => 'gender'])!!}
                                            </div>
                                            <div class="form-group col-sm-4 m-0">
                                                {!! Form::label('married', 'married', ['class' => 'col-form-label s-12'], false) !!}
                                                {!! Form::select('married', [0 => 'Married', 1 => 'Single'], $worker->married,  ['class' => "form-control r-0 light s-12", 'placeholder' => 'Married', 'id' => 'married'])!!}
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-sm-4 m-0">
                                                {!! Form::label('legal', 'Legal Situation', ['class' => 'col-form-label s-12'], false) !!}
                                                {!! Form::select('legal', Helper::legal() ,$worker->legal,  ['class' => "form-control r-0 light s-12", 'placeholder' => 'Legal Situation', 'id' => 'legal'])!!}
                                            </div>
                                            <div class="form-group col-sm-4 m-0">
                                                {!! Form::label('average_salary', 'Monthly Salary(SAR)', ['class' => 'col-form-label s-12'], false) !!}
                                                {!! Form::text('average_salary', $worker->minimum_salary,  ['class' => "form-control r-0 light s-12", 'placeholder' => 'Monthly Salary', 'id' => 'minimum_salary'])!!}
                                            </div>
                                           
                                            {{--<div class="form-group col-sm-4 m-0">
                                                {!! Form::label('city', 'City', ['class' => 'col-form-label s-12'], false) !!}
                                                {!! Form::select('city', Helper::cities() ,$worker->city,  ['class' => "form-control r-0 light s-12", 'placeholder' => 'City', 'id' => 'Enter city'])!!}
                                            </div>--}}
                                        </div>
                                        <h5 class="card-title mt-4">Overview & Experience</h5>
                                        <div class="form-row">
                                            <div class="form-row">
                                                <div class="form-group col-sm-12 m-0">
                                                    {!! Form::label('about', 'About', ['class' => 'col-form-label s-12'], false) !!}
                                                    {!! Form::textarea('about', $worker->about,  ['class' => "form-control r-0 light s-12", 'placeholder' => 'About Worker', 'id' => 'about'])!!}
                                                </div>
                                                <div class="form-group col-sm-6 m-0">
                                                    {!! Form::label('experience', 'Experience Years', ['class' => 'col-form-label s-12'], false) !!}
                                                    {!! Form::select('experience', Helper::experience(), $worker->experience,  ['id' => 'experience', 'class' => "form-control r-0 light s-12", 'placeholder' => 'Enter Experience'])!!}
                                                </div>
                                                <div class="form-group col-sm-6 m-0">
                                                    {!! Form::label('category_id', 'Category', ['class' => 'col-form-label s-12'], false) !!}
                                                    {!! Form::select('category_id', Helper::categoriesNames(), $worker->category_id, [ 'class' => 'form-control r-0 light s-12', 'placeholder' => 'Job Role'])!!}
                                                </div>
                                            </div>
                                        </div>     
                                    </div>
                                    <div class="col-md-3 offset-md-1">
                                        {!! Form::file('profile_image', [ 'hidden', 'id' => 'profile_image'])!!}
                                        <label for="profile_image" class="club_avatar">
                                            @if(empty($worker->profile_image))
                                                <img class=" no-b no-p" src="{{url('uploads/images/profile_images/default.jpg')}}" alt="worker Avatar" id="preview_image">
                                            @else
                                                <img class=" no-b no-p" src="{{Helper::checkImg('profile_images/'. $worker->profile_image )}}" alt="worker Avatar" id="preview_image">
                                            @endif
                                        </label>
                                        <script>
                                            const inputFile = document.getElementById('profile_image');
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
                                        {!! Form::file('cv', [ 'hidden', 'id' => 'cv'])!!}
                                        <label for="profile_image" class="club_avatar">
                                            @if(empty($worker->profile_image))
                                                <img class=" no-b no-p" src="{{asset('uploads/files/cv/cv.png')}}" alt="CV">
                                            @else
                                            <img class=" no-b no-p" src="{{asset('uploads/files/cv/cv.png')}}" alt="CV">
                                                You want change CV?
                                            @endif
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="card-body">
                                @csrf
                                {!! Form::hidden('_method', 'PUT') !!}
                                {!! Form::submit('Save', ['class' => "btn btn-primary btn-lg"]) !!}
                            </div>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@include('inc.foot')
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

//                 $.each(response, function(k, v) {
//                     $('#city').append($('<option>', {value:k, text:v}));

//                 });
               
//             }
//         });
//     });
}); //END document.ready
</script>