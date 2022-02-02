@include('inc.header')


<div class="page has-sidebar-left  height-full experience-crete">
    <header class="blue accent-3 relative">
        <div class="container-fluid text-white">
            <div class="row p-t-b-10 ">
                <div class="col">
                    <h4>
                        <i class="icon-database"></i>
                        Experiences
                    </h4>
                </div>
            </div>
            <div class="row justify-content-between">
                <ul class="nav nav-material nav-material-white responsive-tab" id="v-pills-tab" role="tablist">
                    <li>
                        <a class="nav-link"  href="{{url('dashboard/experiences')}}"><i class="icon icon-home2"></i>All Experiences</a>
                    </li>
                    <li>
                        <a class="nav-link active"  href="{{url('dashboard/experiences/'. $experience->id .'/edit')}}" ><i class="icon icon-plus-circle"></i> Edit Experience</a>
                    </li>
                </ul>
            </div>
        </div>
    </header>
    <div class="container-fluid animatedParent animateOnce">
        <div class="animated fadeInUpShort">
            <div class="row my-3">
                <div class="col-md-7  offset-md-2">
                    {!! Form::open(['action'=> ['ExperienceController@update', $experience->id], 'method'=>'POST', 'enctype' =>'multipart/form-data' ])!!}
                        <div class="card no-b  no-r">
                            <div class="card-body">
                                <h5 class="card-title">About Experience</h5>
                                <div class="form-row">
                                    <div class="col-md-8">
                                        <div class="form-group m-0">
                                            <div class="form-row mt-1">
                                                <div class="form-group col-12 m-0">
                                                    {!! Form::label('user_id', 'Worker Name', ['class' => 'col-form-label s-12']) !!}
                                                    {!! Form::select('user_id', Helper::workersNames() ,$experience->user_id, ['class' => "form-control r-0 light s-12", 'placeholder' => 'Worker Name', 'id' => 'user_id'])!!}
                                                    <div class="valid-feedback">
                                                        Looks Good
                                                    </div>
                                                    <div class="invalid-feedback">
                                                        Please Provide a Valid Name
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-row mt-1">
                                                <div class="form-group col-6 m-0">
                                                    {!! Form::label('job_title', 'Job Title', ['class' => 'col-form-label s-12']) !!}
                                                    {!! Form::text('job_title', $experience->job_title,  ['class' => "form-control r-0 light s-12", 'placeholder' => 'Job Title', 'id' => 'job_title'])!!}
                                                    <div class="valid-feedback">
                                                        Looks Good
                                                    </div>
                                                    <div class="invalid-feedback">
                                                        Please Provide a Valid Name
                                                    </div>
                                                </div>
                                                <div class="form-group col-6 m-0">
                                                    {!! Form::label('company_name', 'Company Name', ['class' => 'col-form-label s-12']) !!}
                                                    {!! Form::text('company_name', $experience->company_name,  ['id' => 'middle_name', 'class' => "form-control r-0 light s-12", 'placeholder' => 'Company Name', 'id' => 'job_title'])!!}
                                                    <div class="valid-feedback">
                                                        Looks Good
                                                    </div>
                                                    <div class="invalid-feedback">
                                                        Please Provide a Your Name
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row mt-1">
                                        <div class="form-row">
                                            <div class="form-group col-sm-4 m-0">
                                                {!! Form::label('from', 'From', ['class' => 'col-form-label s-12'], false) !!}
                                                <input type="text" class="date-time-picker form-control r-0 light s-12 calender" name="from" placeholder ="From Date" id = 'calender' value="{{$experience->from}}"
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
                                                {!! Form::label('to', 'To Date', ['class' => 'col-form-label s-12'], false) !!}
                                                <input type="text" class="date-time-picker form-control r-0 light s-12 calender" name="to" placeholder ="To Date" id = 'calender' value="{{$experience->to}}"
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
                                        </div>
                                    </div>
                                    <div class="col-md-3 offset-md-1">
                                        {!! Form::file('company_logo', [ 'hidden', 'id' => 'company_logo'])!!}
                                        <label for="company_logo" class="club_avatar">
                                            @if (empty($experience->company_logo))
                                                <img class=" no-b no-p" src="{{Helper::checkImg('profile_images/default_company.jpg')}}" alt="Team Logo">
                                            @else
                                                <img class=" no-b no-p" src="{{Helper::checkImg('profile_images/'. $experience->company_logo)}}" alt="Team Logo">
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