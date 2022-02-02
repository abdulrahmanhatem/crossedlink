@include('inc.header')


<div class="page has-sidebar-left  height-full company-crete">
    <header class="blue accent-3 relative">
        <div class="container-fluid text-white">
            <div class="row p-t-b-10 ">
                <div class="col">
                    <h4>
                        <i class="icon-database"></i>
                        Workers
                    </h4>
                </div>
            </div>
            <div class="row justify-content-between">
                <ul class="nav nav-material nav-material-white responsive-tab" id="v-pills-tab" role="tablist">
                    <li>
                        <a class="nav-link"  href="{{url('dashboard/workers')}}"><i class="icon icon-home2"></i>All Workers</a>
                    </li>
                    <li>
                        <a class="nav-link active"  href="{{url('dashboard/workers/create')}}" ><i class="icon icon-plus-circle"></i> Add New Workers</a>
                    </li>
                </ul>
            </div>
        </div>
    </header>
    <div class="container-fluid animatedParent animateOnce">
        <div class="animated fadeInUpShort">
            <div class="row my-3">
                <div class="col-md-7  offset-md-2">
                    {!! Form::open(['action'=>'WorkerController@store', 'method'=>'POST', 'enctype' =>'multipart/form-data', ' novalidate', 'class' => 'needs-validation'])!!}
                        <div class="card no-b  no-r">
                            <div class="card-body">
                                <div class="form-row profile-container">
                                    <div class="col-md-8">
                                        <h5 class="card-title">Contact Informations</h5>
                                        <div class="form-row mt-1">
                                            <div class="form-group col-6 m-0">
                                                {!! Form::label('first_name', 'First Name', ['class' => 'col-form-label s-12']) !!}
                                                {!! Form::text('first_name', '',  ['class' => "form-control r-0 light s-12", 'placeholder' => 'First Name'])!!}
                                                <div class="valid-feedback">
                                                    Looks Good
                                                </div>
                                                <div class="invalid-feedback">
                                                    Please Provide a Valid Name
                                                </div>
                                            </div>
                                            <div class="form-group col-6 m-0">
                                                {!! Form::label('middle_name', 'Last Name', ['class' => 'col-form-label s-12']) !!}
                                                {!! Form::text('middle_name', '',  ['id' => 'middle_name', 'class' => "form-control r-0 light s-12", 'placeholder' => 'Last Name'])!!}
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
                                                    <label>Nationality <span class="text-danger">*</span></label>
                                                    {!! Form::select('nationality', Helper::nationalities(), '', [ 'class' => 'form-control r-0 light s-12', 'placeholder' => 'Nationality'])!!}
                                            </div>
                                        </div>
                                        <h5 class="card-title mt-4">Personal Informations</h5>
                                        <div class="form-row mt-1">
                                            <div class="form-group col-6 m-0">
                                                {!! Form::label('email', '<i class="icon-envelope-o mr-2"></i>Email', ['class' => 'col-form-label s-12'], false) !!}
                                                {!! Form::text('email', '',  ['class' => "form-control r-0 light s-12", 'placeholder' => 'worker@email.com', 'id' => 'email', 'required'])!!}
                                                <div class="valid-feedback">
                                                    Looks Good
                                                </div>
                                                <div class="invalid-feedback">
                                                    Please Provide a Valid Email
                                                </div>
                                            </div>
        
                                            <div class="form-group col-6 m-0">
                                                {!! Form::label('phone', '<i class="icon-phone mr-2"></i>Phone', ['class' => 'col-form-label s-12'], false) !!}
                                                {!! Form::text('phone', '',  ['class' => "form-control r-0 light s-12", 'placeholder' => '+9665112345678', 'id' => 'phone'])!!}
                                            </div>
                                           
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-sm-12 m-0">
                                                {!! Form::label('address', 'Worker Address', ['class' => 'col-form-label s-12'], false) !!}
                                                {!! Form::text('address', '',  ['class' => "form-control r-0 light s-12", 'placeholder' => 'Enter Address', 'id' => 'address'])!!}
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-sm-4 m-0">
                                                {!! Form::label('birth', 'Birth Day', ['class' => 'col-form-label s-12'], false) !!}
                                                    <input type="text" class="date-time-picker form-control r-0 light s-12 calender" name="birth" placeholder ="Birth Date" id = 'calender'
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
                                                {!! Form::select('gender', [0 => 'Male', 1 => 'Female', 3 => 'Other'],  '',['class' => "form-control r-0 light s-12", 'id' => 'gender'])!!}
                                            </div>
                                            <div class="form-group col-sm-4 m-0">
                                                {!! Form::label('married', 'married', ['class' => 'col-form-label s-12'], false) !!}
                                                {!! Form::select('married', [0 => 'Married', 1 => 'Single'], '',  ['class' => "form-control r-0 light s-12", 'placeholder' => 'Married', 'id' => 'married'])!!}
                                            </div>
                                            <div class="form-group col-sm-4 m-0">
                                                {!! Form::label('legal', 'Legal Situation', ['class' => 'col-form-label s-12'], false) !!}
                                                {!! Form::select('legal', Helper::legal() ,'',  ['class' => "form-control r-0 light s-12", 'placeholder' => 'Legal Situation', 'id' => 'legal'])!!}
                                            </div>
                                            <div class="form-group col-sm-4 m-0">
                                                {!! Form::label('average_salary', 'Monthly Salary(SAR)', ['class' => 'col-form-label s-12'], false) !!}
                                                {!! Form::select('average_salary', Helper::minimalSalary(), '',  ['class' => "form-control r-0 light s-12", 'placeholder' => 'Monthly Salary(SAR', 'id' => 'maximum_salary'])!!}
                                            </div>
                                            <div class="form-group col-4 m-0">
                                                {!! Form::label('country', 'Country', ['class' => 'col-form-label s-12'], false) !!}
                                                {!! Form::select('country', Helper::countries(), '', [ 'class' => 'form-control r-0 light s-12','id' => 'country', 'placeholder' => 'Country'])!!}

                                            </div>
                                            <div class="form-group col-sm-4 m-0">
                                                {!! Form::label('city', 'City', ['class' => 'col-form-label s-12'], false) !!}
                                                {!! Form::text('city', '',  ['id' => 'city', 'class' => "form-control r-0 light s-12", 'placeholder' => 'City'])!!}
                                                <!--<select name='city' class="form-control r-0 light s-12 " id="city" placeholder = '{{trans('main.City')}}' data-live-search="true"> -->
                                                <!--    @foreach($user_city as $key => $value)-->
                                                <!--        <option name='Kabul' value="{{$key}}" {{auth()->user()->city == $key ? 'selected="selected"':''}} country_code=''>{{$value}} </option>-->
                                                <!--    @endforeach-->
                                                <!--</select>-->
                                            </div>
                                        </div>
                                        <h5 class="card-title mt-4">Overview & Experience</h5>
                                        <div class="form-row">
                                            <div class="form-row">
                                                <div class="form-group col-sm-12 m-0">
                                                    {!! Form::label('about', 'About', ['class' => 'col-form-label s-12'], false) !!}
                                                    {!! Form::textarea('about', '',  ['class' => "form-control r-0 light s-12", 'placeholder' => 'About Worker', 'id' => 'about'])!!}
                                                </div>
                                                <div class="form-group col-sm-6 m-0">
                                                    {!! Form::label('experience', 'Experience Yesrs', ['class' => 'col-form-label s-12'], false) !!}
                                                    {!! Form::select('experience', Helper::experience(), '',  ['id' => 'experience', 'class' => "form-control r-0 light s-12", 'placeholder' => 'Enter Experience'])!!}
                                                </div>
                                                <div class="form-group col-sm-6 m-0">
                                                    {!! Form::label('category_id', 'Category', ['class' => 'col-form-label s-12'], false) !!}
                                                    {!! Form::select('category_id', Helper::categoriesNames(), '', [ 'class' => 'form-control r-0 light s-12', 'placeholder' => 'Job Role'])!!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 offset-md-1">
                                        {!! Form::file('profile_image', [ 'hidden', 'id' => 'profile_image'])!!}
                                        <label for="profile_image" class="club_avatar">
                                            <img class=" no-b no-p" src="{{Helper::checkImg('profile_images/default.jpg')}}" alt="worker Avatar" id="preview_image">
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
                                        <label for="cv" class="club_avatar  mt-4 w-50">
                                            <img class=" no-b no-p" src="{{asset('uploads/files/cv/cv.png')}}" alt="worker Avatar w-50 mt-4">
                                        </label>
                                    </div>
                                </div>
                            </div>
                        <hr>
                        <div class="card-body">
                            {!! Form::submit('Create', ['class' => "btn btn-primary btn-lg"]) !!}
                        </div>
                    </div>
                {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    // Example starter JavaScript for disabling form submissions if there are invalid fields
   
</script>





@include('inc.right-sidebar')
</div>
<script src={{asset("js/select2.min.js")}}></script>
<script src={{asset("js/app.js")}}></script>
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
// }); //END document.ready

 (function() {
        'use strict';
        window.addEventListener('load', function() {
            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.getElementsByClassName('needs-validation');
            // Loop over them and prevent submission
            var validation = Array.prototype.filter.call(forms, function(form) {
                form.addEventListener('submit', function(event) {
                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        }, false);
    })();
</script>
</body>
</html>
