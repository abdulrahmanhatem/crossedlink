@include('inc.header')


<div class="page has-sidebar-left  height-full company-crete">
    <header class="blue accent-3 relative">
        <div class="container-fluid text-white">
            <div class="row p-t-b-10 ">
                <div class="col">
                    <h4>
                        <i class="icon-database"></i>
                        Email Templates
                    </h4>
                </div>
            </div>
            <div class="row justify-content-between">
                <ul class="nav nav-material nav-material-white responsive-tab" id="v-pills-tab" role="tablist">
                    <li>
                        <a class="nav-link"  href="{{url('dashboard/email-templates')}}"><i class="icon icon-home2"></i>All Email Templates</a>
                    </li>
                    <li>
                        <a class="nav-link"  href="{{url('dashboard/email-templates/'. $email->id .'/edit')}}" ><i class="icon icon-plus-circle"></i> Edit Email Template</a>
                    </li>
                </ul>
            </div>
        </div>
    </header>
    <div class="container-fluid animatedParent animateOnce">
        <div class="animated fadeInUpShort">
            <div class="row my-3">
                <div class="col-md-7  offset-md-2">
                        <div class="card no-b  no-r">
                            <div class="card-body">
                                <div class="form-row">
                                    <div class="col-md-12">
                                        <h5 class="card-title">About Email Template</h5>
                                        <div class="form-row mt-1">
                                            <div class="form-group col-12 m-0">
                                                {!! Form::label('title', 'Email Template Title', ['class' => 'col-form-label s-12']) !!}
                                                {!! Form::text('title', $email->title, ['class' => "form-control r-0 light s-12", 'placeholder' => 'Email Template Name', 'id' => 'title','readonly' => 'true'])!!}
                                                <div class="valid-feedback">
                                                    Looks Good
                                                </div>
                                                <div class="invalid-feedback">
                                                    Please Provide a Valid Name
                                                </div>
                                            </div>
                                            <div class="form-group col-12 m-0">
                                                {!! Form::label('subject', 'Email Subject', ['class' => 'col-form-label s-12']) !!}
                                                {!! Form::text('subject', $email->subject, ['class' => "form-control r-0 light s-12", 'placeholder' => 'Email Subject', 'id' => 'subject','readonly' => 'true'])!!}
                                                <div class="valid-feedback">
                                                    Looks Good
                                                </div>
                                                <div class="invalid-feedback">
                                                    Please Provide a Valid Name
                                                </div>
                                            </div>
                                            
                                            <div class="form-group col-12 m-0">
                                                {!! Form::label('message', 'Message', ['class' => 'col-form-label s-12']) !!}
                                                
                                                {!! $email->description !!}
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
                            
                        </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>

@include('inc.foot')