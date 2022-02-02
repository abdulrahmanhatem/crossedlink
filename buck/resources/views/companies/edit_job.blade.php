@include('inc.home.head', ['title' => $job->title .' '.  trans('main.Job')])

<section class="section p-150 bread-crumbs">
    <div class="container">
    <a href="{{ url('/') }}" class="text-muted">{{trans('main.Home')}}</a> / <a href="{{ url('workers') }}" class="text-primary">{{trans('main.My Jobs')}}</a>
    </div>
</section>
    <!-- POST A JOB START -->
    <section class="section pt-3">
        <div class="container">
            <div class="row justify-content-center">
                @if($errors)
                    @foreach ($errors->all() as $error)
                        <div class="text-danger">{{ $error }}</div>
                    @endforeach
                @endif
                <div class="col-lg-10">
                    <div class="rounded shadow bg-white p-4 mb-3">
                        <div class="custom-form">
                            <div id="message3"></div>
                            {!! Form::open(['action'=>['EmployerClientController@updateJob', $job->id], 'method'=>'POST', 'enctype' =>'multipart/form-data', ' novalidate', 'class' => 'needs-validation', 'id' => 'contact-form3'])!!}
                            {!! Form::text('employer_id', auth()->user()->id ,  ['hidden'])!!}
                             
                                
                            <h4 class="text-dark mb-3">{{trans('main.Edit Job')}}:</h4>
                           
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group app-label mt-2">
                                            <label class="text-muted">{{trans('main.Job Title Post')}}<span class="valid-star">*</span></label>
                                            {!! Form::text('title', $job->title,  ['id' => 'title', 'class' => "form-control resume", 'placeholder' => trans('main.Job Title Post')])!!}
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group app-label mt-2">
                                            <label class="text-muted">{{trans('main.Job Category')}}</label>
                                            <div class="form-button">
                                                @if (auth()->user()->role == 2)
                                                    {!! Form::select('category_id', Helper::companies_categories(), $job->category_id,  ['id' => 'category_id', 'class' => "form-control rounded selectpicker", 'placeholder' => trans('main.Category'), 'data-live-search' =>"true"])!!}
                                                @elseif(auth()->user()->role == 1)
                                                    {!! Form::select('category_id', Helper::personal_categories(), $job->category_id,  ['id' => 'category_id', 'class' => "form-control rounded selectpicker", 'placeholder' => trans('main.Category'), 'data-live-search' =>"true"])!!}
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group app-label mt-2">
                                            <label class="text-muted">{{trans('main.Job Type')}}</label>
                                            <div class="form-button">
                                                {!! Form::select('type', [0 => 'Full Time' , 1 => 'Part Time'], $job->type, ['class' => "nice-select rounded", 'placeholder' => trans('main.Job Type'), 'id' => 'type'])!!}
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group app-label mt-2">
                                            <label class="text-muted">{{trans('main.Country')}}<span class="valid-star">*</span></label>
                                            {!! Form::select('country',  Helper::countries(), $job->country,  ['class' => "form-control resume selectpicker", 'placeholder' => trans('main.Enter Country'), 'id' => 'country', 'required', 'data-live-search' =>"true"])!!}
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group app-label mt-2">
                                            <label class="text-muted">{{trans('main.City')}}<span class="valid-star">*</span></label>
                                                {!! Form::text('city', $job->city,  ['id' => 'city', 'class' => "form-control r-0 light s-12", 'placeholder' => trans('main.City')])!!}
                                                <!--@if (!empty(auth()->user()->city))-->
                                                <!--    <select name='city' class="form-control r-0 light s-12" id="city_" placeholder = 'City' data-live-search="true"> -->
                                                <!--        @foreach($job_city as $key => $value)-->
                                                <!--            <option name='Kabul' value="{{$key}}" {{$job->city == $key ? 'selected="selected"':''}} country_code=''>{{$value}} </option>-->
                                                <!--        @endforeach-->
                                                <!--    </select>-->
                                                <!--@else -->
                                                <!--    <select name='city' class="form-control r-0 light s-12 " id="city" placeholder = 'City' data-live-search="true"> -->
                                                <!--        @foreach($job_city as $key => $value)-->
                                                <!--            <option name='Kabul' value="{{$key}}" {{$job->city == $key ? 'selected="selected"':''}} country_code=''>{{$value}} </option>-->
                                                <!--        @endforeach-->
                                                <!--    </select>-->
                                                <!--@endif-->
                                                
                                            {{--{!! Form::text('city', $job->city,  ['class' => "form-control resume", 'placeholder' => trans('main.Enter City'), 'id' => 'city', 'required'])!!}--}}
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group app-label mt-2">
                                            <label class="text-muted">{{trans('main.Address')}}</label>
                                            {!! Form::text('address', $job->address,  ['class' => "form-control resume", 'placeholder' => trans('main.Enter Address'), 'id' => 'address'])!!}
                                        </div>
                                    </div>


                                </div>

                                <div class="row">
                                    {{--<div class="col-md-6">
                                        <div class="form-group app-label mt-2">
                                            <label class="text-muted">Minimum Salary(SAR)</label>
                                            {!! Form::text('min_salary', '',  ['class' => "form-control resume", 'placeholder' => '1500', 'id' => 'min_salary'])!!}
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group app-label mt-2">
                                            <label class="text-muted">Maximum Salary</label>
                                            {!! Form::text('max_salary', '',  ['id' => 'max_salary', 'class' => "form-control resume", 'placeholder' => '3000'])!!}
                                        </div>
                                    </div>--}}
                                    <div class="form-group col-sm-12 m-0">
                                        {!! Form::label('salary', trans('main.Salary(SAR)').'<span class="valid-star">*</span>', ['class' => 'text-muted'], false) !!}
                                        {!! Form::select('salary', Helper::salaryRange(), $job->salary,  ['id' => 'salary', 'class' => "form-control r-0 light s-12", 'placeholder' => trans('main.Salary')])!!}
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group app-label mt-2">
                                            <label class="text-muted">{{trans('main.Year of Experience')}}</label>
                                            <div class="form-button">
                                                {!! Form::select('experience', Helper::experience(), $job->experience, ['class' => "nice-select rounded", 'placeholder' => trans('main.Experience'), 'id' => 'experience'])!!}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group app-label mt-2">
                                            <label class="text-muted">{{trans('main.Gender')}}</label>
                                            <div class="form-button">
                                                {!! Form::select('gender', [0 => 'Male', 1 => 'Female', 3 => 'Other'] , $job->gender,  ['class' => "nice-select rounded", 'placeholder' => trans('main.Gender'), 'id' => 'gender'])!!}
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group app-label mt-2">
                                            <label class="text-muted">{{trans('main.Job Description')}}</label>
                                            {!! Form::textarea('desc', $job->desc,  ['class' => "form-control resume", 'placeholder' => trans('main.Job Description'), 'id' => 'desc'])!!}
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group app-label mt-2">
                                            <label class="text-muted">{{trans('main.Job Overview')}}</label>
                                            {!! Form::textarea('overview', $job->overview,  ['class' => "form-control resume", 'placeholder' => trans('main.Job Overview'), 'id' => 'overview'])!!}
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group app-label mt-2">
                                            <label class="text-muted">{{trans('main.Job Qualification')}}</label>
                                            {!! Form::textarea('qual', $job->qual,  ['class' => "form-control resume", 'placeholder' => trans('main.Job Qualification'), 'id' => 'qual'])!!}
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group app-label mt-2">
                                            <label class="text-muted">{{trans('main.Job Responsabilities')}}</label>
                                            {!! Form::textarea('resp', $job->resp,  ['class' => "form-control resume", 'placeholder' => trans('main.Job Responsabilities'), 'id' => 'resp'])!!}
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <ul class="list-inline mb-0">
                                            <li class="list-inline-item">
                                                <div class="input-group mt-2 mb-2">
                                                    <div class="custom-file">
                                                        <input type="file" name ="docs" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
                                                        <label class="custom-file-label rounded"><i class="mdi mdi-cloud-upload mr-1"></i> {{trans('main.Upload Files')}}</label>
                                                    </div>
                                                </div>
                                            </li>

                                            <li class="list-inline-item">
                                                <h6 class="text-muted mb-0">{{trans('main.Upload Images Or Documents.')}}</h6>
                                            </li>
                                            <span class="val-tip muted-text text-left">{{trans('main.Document Type Has To Be An Image(jpeg,png,jpg,gif,svg) Or PDF with Max Size: 3MB')}}</span>
                                        </ul>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-12 mt-2">
                                        {!! Form::submit(trans('main.Edit Job'), ['class' => "btn btn-primary"]) !!}
                                        {!! Form::hidden('_method', 'PUT') !!}
                                    </div>
                                </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- POST A JOB END -->

    @include('inc.home.foot')
    @include('inc.home.scripts')
    <script>
        $(document).ready(function(){
           
           
           /* $("#city").on('change', function() {
                var id = $("#country option:selected").val();
                console.log();
                $.ajax({
                    type: 'get',
                    url: '{{url("get/cites/")}}/' + id,
                    success: function (response) {
                            // $('#city').removeClass('selectpicker');
                            $('#city').empty();
                            
                        $.each(response, function(k, v) {
                            $('#city').append($('<option>', {value:k, text:v}));
                        });
                        $('#city').selectpicker('render'); 
                            // $('#city').addClass('selectpicker');
                    }
                });
            });*/

            // $("#country").on('change', function() {
            // var id = $("#country option:selected").val();
            // console.log();
            // $.ajax({
            //     type: 'get',
            //     url: '{{url("get/cites/")}}/' + id,
            //     success: function (response) {
            //             $('#city').removeClass('selectpicker');
            //             $('#city').empty();
            //             $('#city_yes').removeClass('selectpicker');
            //             $('#city_yes').empty();
                        
            //         $.each(response, function(k, v) {
            //             $('#city').append($('<option>', {value:k, text:v}));
            //                 $('#city_yes').append($('<option>', {value:k, text:v}));
                        
            //         });
            //         $('#city').selectpicker('render');  
            //         $('#city_yes').selectpicker('render');  
            //     }
            // });
        });
    }); //END document.ready
    </script>
</body>
</html>