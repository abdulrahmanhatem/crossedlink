@include('inc.header')


<div class="page has-sidebar-left  height-full job-crete">
    <header class="blue accent-3 relative">
        <div class="container-fluid text-white">
            <div class="row p-t-b-10 ">
                <div class="col">
                    <h4>
                        <i class="icon-database"></i>
                        Jobs
                    </h4>
                </div>
            </div>
            <div class="row justify-content-between">
                <ul class="nav nav-material nav-material-white responsive-tab" id="v-pills-tab" role="tablist">
                    <li>
                        <a class="nav-link"  href="{{url('dashboard/jobs')}}"><i class="icon icon-home2"></i>All Jobs</a>
                    </li>
                    <li>
                        <a class="nav-link active"  href="{{url('dashboard/jobs/create')}}" ><i class="icon icon-plus-circle"></i> Add New Job</a>
                    </li>
                </ul>
            </div>
        </div>
    </header>
    <div class="container-fluid animatedParent animateOnce">
        <div class="animated fadeInUpShort">
            <div class="row my-3">
                <div class="col-md-7  offset-md-2">
                    {!! Form::open(['action'=>'JobController@store', 'method'=>'POST', 'enctype' =>'multipart/form-data', ' novalidate', 'class' => 'needs-validation'])!!}
                        <div class="card no-b  no-r">
                            <div class="card-body">
                                <h5 class="card-title">Job Informations</h5>
                                <div class="form-row">
                                    <div class="col-md-8">
                                        <div class="form-group m-0">
                                            <div class="form-row mt-1">
                                                <div class="form-group col-12 m-0">
                                                    {!! Form::label('employer_id', 'Employer', ['class' => 'col-form-label s-12']) !!}
                                                    {!! Form::select('employer_id', Helper::employersNames(), '',  ['id' => 'job_name', 'class' => "form-control r-0 light s-12", 'placeholder' => 'Employer', 'id' => 'employer_id'])!!}
                                                    <div class="valid-feedback">
                                                        Looks Good
                                                    </div>
                                                    <div class="invalid-feedback">
                                                        Please Provide a Valid Name
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row mt-1">
                                            <div class="form-group col-6 m-0">
                                                {!! Form::label('category_id', 'Category', ['class' => 'col-form-label s-12']) !!}
                                                {!! Form::select('category_id', Helper::categoriesNames(),'',  ['id' => 'category_id', 'class' => "form-control r-0 light s-12", 'placeholder' => 'Category'])!!}
                                                <div class="valid-feedback">
                                                    Looks Good
                                                </div>
                                                <div class="invalid-feedback">
                                                    Please Provide a Valid Name
                                                </div>
                                            </div>
                                            <div class="form-group col-6 m-0">
                                                {!! Form::label('title', 'Job Title', ['class' => 'col-form-label s-12']) !!}
                                                {!! Form::text('title', '',  ['id' => 'title', 'class' => "form-control r-0 light s-12", 'placeholder' => 'Job Title'])!!}
                                                <div class="valid-feedback">
                                                    Looks Good
                                                </div>
                                                <div class="invalid-feedback">
                                                    Please Provide a Valid Name
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="form-row mt-1">
                                            <div class="form-group col-4 m-0">
                                                {!! Form::label('country', 'Country', ['class' => 'col-form-label s-12'], false) !!}
                                                {!! Form::select('country',  Helper::countries(),'',  ['class' => "form-control r-0 light s-12", 'placeholder' => 'Enter Country', 'id' => 'country', 'required'])!!}
                                                <div class="valid-feedback">
                                                    Looks Good
                                                </div>
                                                <div class="invalid-feedback">
                                                    Please Provide a Valid Email
                                                </div>
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
        
                                            <div class="form-group col-4 m-0">
                                                {!! Form::label('address', 'Address', ['class' => 'col-form-label s-12'], false) !!}
                                                {!! Form::text('address', '',  ['class' => "form-control r-0 light s-12", 'placeholder' => 'Enter Address', 'id' => 'address'])!!}
                                            </div>
                                        </div>
                                        

                                        <h5 class="card-title mt-4">Overview & Services</h5>

                                        <div class="form-row">
                                            <div class="form-row">
                                                <div class="form-group col-sm-6 m-0 overview">
                                                    {!! Form::label('overview', 'Job Overview', ['class' => 'col-form-label s-12'], false) !!}
                                                    {!! Form::textarea('overview', '',  ['id' => 'experience', 'class' => "form-control r-0 light s-12", 'placeholder' => 'Job Overview'])!!}
                                                </div>
                                                <div class="form-group col-sm-6 m-0">
                                                    {!! Form::label('desc', 'Job Description', ['class' => 'col-form-label s-12'], false) !!}
                                                    {!! Form::textarea('desc', '',  ['class' => "form-control r-0 light s-12", 'placeholder' => 'Job Description', 'id' => 'desc'])!!}
                                                </div>
                                                <div class="form-group col-sm-6 m-0 overview">
                                                    {!! Form::label('qual', 'Job Qualifications', ['class' => 'col-form-label s-12'], false) !!}
                                                    {!! Form::textarea('qual', '',  ['id' => 'qual', 'class' => "form-control r-0 light s-12", 'placeholder' => 'Job Qualifications'])!!}
                                                </div>
                                                <div class="form-group col-sm-6 m-0">
                                                    {!! Form::label('resp', 'Job Responsibilities', ['class' => 'col-form-label s-12'], false) !!}
                                                    {!! Form::textarea('resp', '',  ['class' => "form-control r-0 light s-12", 'placeholder' => 'Job Responsibilities', 'id' => 'resp'])!!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 offset-md-1">
                                        {!! Form::file('docs', [ 'hidden', 'id' => 'docs-file'])!!}
                                        <label for="docs-file" class="club_avatar">
                                            <img class=" no-b no-p" src="{{asset('uploads/files/job_docs/doc.png')}}" alt="Job Document">
                                        </label>

                                        <h5 class="card-title mt-4">Salary(SAR)</h5>
                                        <div class="form-row">
                                            {{--<div class="form-group col-sm-12 m-0">
                                                {!! Form::label('min_salary', 'Minimum(SAR)', ['class' => 'col-form-label s-12'], false) !!}
                                                {!! Form::text('min_salary', '',  ['class' => "form-control r-0 light s-12", 'placeholder' => 'Minimum', 'id' => 'min_salary'])!!}
                                            </div>
                                            <div class="form-group col-sm-12 m-0">
                                                {!! Form::label('max_salary', 'Maximum(SAR)', ['class' => 'col-form-label s-12'], false) !!}
                                                {!! Form::text('max_salary', '',  ['id' => 'max_salary', 'class' => "form-control r-0 light s-12", 'placeholder' => 'Maximum'])!!}
                                            </div>--}}
                                            <div class="form-group col-sm-12 m-0">
                                                {!! Form::label('salary', 'Offered Salary (SAR)', ['class' => 'col-form-label s-12'], false) !!}
                                                {!! Form::select('salary', Helper::minimalSalary(),'',  ['id' => 'salary', 'class' => "form-control r-0 light s-12", 'placeholder' => 'Salary'])!!}
                                            </div>
                                        </div>

                                        <h5 class="card-title mt-4">Deatails</h5>
                                        <div class="form-row">
                                            <div class="form-group col-sm-12 m-0">
                                                {!! Form::label('gender', 'Gender', ['class' => 'col-form-label s-12'], false) !!}
                                                {!! Form::select('gender', [0 => 'Male', 1 => 'Female', 3 => 'Other'] ,'',  ['class' => "form-control r-0 light s-12", 'placeholder' => 'Gender', 'id' => 'gender'])!!}
                                            </div>
                                            <div class="form-group col-sm-12 m-0">
                                                {!! Form::label('experience', 'Experience', ['class' => 'col-form-label s-12'], false) !!}
                                                {!! Form::select('experience', [0 => '1 Year', 1 => '2 Yaers', 3 => '3 Years', 4 => '4 Year', 5 => '5 Yaers', 6 => '6 Years', 7 => '7 Years', 8 => '8 Year', 9 => '9 Yaers', 10 => '10 Years & More'], '', ['class' => "form-control r-0 light s-12", 'placeholder' => 'Experience', 'id' => 'experience'])!!}
                                            </div>
                                            <div class="form-group col-sm-12 m-0">
                                                {!! Form::label('type', 'Job Type', ['class' => 'col-form-label s-12'], false) !!}
                                                {!! Form::select('type', [0 => 'Full Time' , 1 => 'Part Time'], '', ['class' => "form-control r-0 light s-12", 'placeholder' => 'Job Type', 'id' => 'type'])!!}
                                            </div>
                                            <div class="form-group col-sm-12 m-0">
                                                {!! Form::label('sponsored', 'Job Type', ['class' => 'col-form-label s-12'], false) !!}
                                                {!! Form::select('sponsored', [0 => 'Non Sponsored' , 1 => 'Sponsored'], '', ['class' => "form-control r-0 light s-12", 'placeholder' => 'sponsorship', 'id' => 'sponsored'])!!}
                                            </div>
                                        </div>
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

@include('inc.right-sidebar')
</div>
<script src={{asset("js/select2.min.js")}}></script>
<script src={{asset("js/app.js")}}></script>
<script>


    // Example starter JavaScript for disabling form submissions if there are invalid fields
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

<script>
//     $(document).ready(function(){
//     $("#country").on('change', function() {
//         var id = $("#country option:selected").val();
//         console.log(id);
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
</script>
</body>
</html>