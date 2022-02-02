@include('inc.header')


<div class="page has-sidebar-left  height-full company-crete">
    <header class="blue accent-3 relative">
        <div class="container-fluid text-white">
            <div class="row p-t-b-10 ">
                <div class="col">
                    <h4>
                        <i class="icon-database"></i>
                        Educations
                    </h4>
                </div>
            </div>
            <div class="row justify-content-between">
                <ul class="nav nav-material nav-material-white responsive-tab" id="v-pills-tab" role="tablist">
                    <li>
                        <a class="nav-link"  href="{{url('dashboard/educations')}}"><i class="icon icon-home2"></i>All Educations</a>
                    </li>
                    <li>
                        <a class="nav-link active"  href="{{url('dashboard/educations/'. $education->id .'/edit')}}" ><i class="icon icon-plus-circle"></i> Edit Educations</a>
                    </li>
                </ul>
            </div>
        </div>
    </header>
    <div class="container-fluid animatedParent animateOnce">
        <div class="animated fadeInUpShort">
            <div class="row my-3">
                <div class="col-md-7  offset-md-2">
                    {!! Form::open(['action'=> ['EducationController@update', $education->id], 'method'=>'POST', 'enctype' =>'multipart/form-data' ])!!}
                        <div class="card no-b  no-r">
                            <div class="card-body">
                                <div class="form-row">
                                    <div class="col-md-12">
                                        <h5 class="card-title">About Education</h5>
                                        <div class="form-row mt-1">
                                            <div class="form-group col-12 m-0">
                                                {!! Form::label('user_id', 'Worker Name', ['class' => 'col-form-label s-12']) !!}
                                                {!! Form::select('user_id', Helper::workersNames() , $education->user_id, ['class' => "form-control r-0 light s-12", 'placeholder' => 'Worker Name', 'id' => 'user_id'])!!}
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
                                                {!! Form::label('title', 'Education Title', ['class' => 'col-form-label s-12']) !!}
                                                {!! Form::text('title', $education->title, ['class' => "form-control r-0 light s-12", 'placeholder' => 'education Name', 'id' => 'title'])!!}
                                                <div class="valid-feedback">
                                                    Looks Good
                                                </div>
                                                <div class="invalid-feedback">
                                                    Please Provide a Valid Name
                                                </div>
                                            </div>
                                            <div class="form-group col-6 m-0">
                                                {!! Form::label('level', 'Level', ['class' => 'col-form-label s-12']) !!}
                                                {!! Form::select('level', Helper::educationalLevel(), $education->level, ['class' => "form-control r-0 light s-12", 'placeholder' => 'Level', 'id' => 'level'])!!}
                                                <div class="valid-feedback">
                                                    Looks Good
                                                </div>
                                                <div class="invalid-feedback">
                                                    Please Provide a Valid Name
                                                </div>
                                            </div>
                                            <div class="form-group col-4 m-0">
                                                {!! Form::label('school', 'School', ['class' => 'col-form-label s-12']) !!}
                                                {!! Form::text('school', $education->school, ['class' => "form-control r-0 light s-12", 'placeholder' => 'School', 'id' => 'school'])!!}
                                                <div class="valid-feedback">
                                                    Looks Good
                                                </div>
                                                <div class="invalid-feedback">
                                                    Please Provide a Valid Name
                                                </div>
                                            </div>
                                            <div class="form-group col-4 m-0">
                                                {!! Form::label('degree', 'Certificate Title', ['class' => 'col-form-label s-12']) !!}
                                                {!! Form::text('degree', $education->degree, ['class' => "form-control r-0 light s-12", 'placeholder' => 'Certificate Title', 'id' => 'degree'])!!}
                                                <div class="valid-feedback">
                                                    Looks Good
                                                </div>
                                                <div class="invalid-feedback">
                                                    Please Provide a Valid Name
                                                </div>
                                            </div>
                                            {{--<div class="form-group col-4 m-0">
                                                {!! Form::label('grade', 'Garde', ['class' => 'col-form-label s-12']) !!}
                                                {!! Form::select('grade', Helper::educationaGrade() , $education->grade, ['class' => "form-control r-0 light s-12", 'placeholder' => 'Garde', 'id' => 'grade'])!!}
                                                <div class="valid-feedback">
                                                    Looks Good
                                                </div>
                                                <div class="invalid-feedback">
                                                    Please Provide a Valid Name
                                                </div>
                                            </div>--}}
                                            <div class="form-group col-6 m-0">
                                                {!! Form::label('from', 'Started Date', ['class' => 'col-form-label s-12']) !!}
                                                {!! Form::text('from', $education->from, ['class' => "form-control r-0 light s-12", 'placeholder' => 'Started Date', 'id' => 'from'])!!}
                                                <div class="valid-feedback">
                                                    Looks Good
                                                </div>
                                                <div class="invalid-feedback">
                                                    Please Provide a Valid Name
                                                </div>
                                            </div>
                                            <div class="form-group col-6 m-0">
                                                {!! Form::label('to', 'Finished Date', ['class' => 'col-form-label s-12']) !!}
                                                {!! Form::text('to', $education->to, ['class' => "form-control r-0 light s-12", 'placeholder' => 'Finished Date', 'id' => 'to'])!!}
                                                <div class="valid-feedback">
                                                    Looks Good
                                                </div>
                                                <div class="invalid-feedback">
                                                    Please Provide a Valid Name
                                                </div>
                                            </div>
                                            <div class="form-group col-12 m-0">
                                                {!! Form::label('brief', 'Brief', ['class' => 'col-form-label s-12']) !!}
                                                {!! Form::textarea('brief', $education->brief, ['class' => "form-control r-0 light s-12", 'placeholder' => 'Write Brief', 'id' => 'brief'])!!}
                                                <div class="valid-feedback">
                                                    Looks Good
                                                </div>
                                                <div class="invalid-feedback">
                                                    Please Provide a Valid Name
                                                </div>
                                            </div>
                                        </div>   
                                       
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