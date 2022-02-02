@include('inc.header')


<div class="page has-sidebar-left  height-full company-crete">
    <header class="blue accent-3 relative">
        <div class="container-fluid text-white">
            <div class="row p-t-b-10 ">
                <div class="col">
                    <h4>
                        <i class="icon-database"></i>
                        Social Media
                    </h4>
                </div>
            </div>
            <div class="row justify-content-between">
                <ul class="nav nav-material nav-material-white responsive-tab" id="v-pills-tab" role="tablist">
                    <li>
                        <a class="nav-link"  href="{{url('dashboard/socials')}}"><i class="icon icon-home2"></i>All Social Media</a>
                    </li>
                    <li>
                        <a class="nav-link active"  href="{{url('dashboard/socials/create')}}" ><i class="icon icon-plus-circle"></i> Add New Social Media</a>
                    </li>
                </ul>
            </div>
        </div>
    </header>
    <div class="container-fluid animatedParent animateOnce">
        <div class="animated fadeInUpShort">
            <div class="row my-3">
                <div class="col-md-7  offset-md-2">
                    {!! Form::open(['action'=>'SocialController@store', 'method'=>'POST', 'enctype' =>'multipart/form-data', ' novalidate', 'class' => 'needs-validation'])!!}
                        <div class="card no-b  no-r">
                            <div class="card-body">
                                <div class="form-row">
                                    <div class="col-md-12">
                                        <h5 class="card-title">About Social Media</h5>
                                        <div class="form-row mt-1">
                                            <div class="form-group col-12 m-0">
                                                {!! Form::label('user_id', 'User Name', ['class' => 'col-form-label s-12']) !!}
                                                {!! Form::select('user_id', Helper::usersNames() ,'', ['class' => "form-control r-0 light s-12", 'placeholder' => 'User Name', 'id' => 'user_id'])!!}
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
                                                {!! Form::label('facebook', 'Facebook', ['class' => 'col-form-label s-12']) !!}
                                                {!! Form::text('facebook', '', ['class' => "form-control r-0 light s-12", 'placeholder' => 'Facebook', 'id' => 'facebook'])!!}
                                                <div class="valid-feedback">
                                                    Looks Good
                                                </div>
                                                <div class="invalid-feedback">
                                                    Please Provide a Valid Name
                                                </div>
                                            </div>
                                            <div class="form-group col-4 m-0">
                                                {!! Form::label('twitter', 'Twitter', ['class' => 'col-form-label s-12']) !!}
                                                {!! Form::text('twitter', '', ['class' => "form-control r-0 light s-12", 'placeholder' => 'Twitter', 'id' => 'twitter'])!!}
                                                <div class="valid-feedback">
                                                    Looks Good
                                                </div>
                                                <div class="invalid-feedback">
                                                    Please Provide a Valid Name
                                                </div>
                                            </div>
                                            <div class="form-group col-4 m-0">
                                                {!! Form::label('google_plus', 'Google Plus', ['class' => 'col-form-label s-12']) !!}
                                                {!! Form::text('google_plus', '', ['class' => "form-control r-0 light s-12", 'placeholder' => 'Google Plus', 'id' => 'google_plus'])!!}
                                                <div class="valid-feedback">
                                                    Looks Good
                                                </div>
                                                <div class="invalid-feedback">
                                                    Please Provide a Valid Name
                                                </div>
                                            </div>
                                            <div class="form-group col-4 m-0">
                                                {!! Form::label('linkedin', 'Linkedin', ['class' => 'col-form-label s-12']) !!}
                                                {!! Form::text('linkedin', '', ['class' => "form-control r-0 light s-12", 'placeholder' => 'Linkedin', 'id' => 'linkedin'])!!}
                                                <div class="valid-feedback">
                                                    Looks Good
                                                </div>
                                                <div class="invalid-feedback">
                                                    Please Provide a Valid Name
                                                </div>
                                            </div>
                                            <div class="form-group col-4 m-0">
                                                {!! Form::label('pinterest', 'Pinterest', ['class' => 'col-form-label s-12']) !!}
                                                {!! Form::text('pinterest', '', ['class' => "form-control r-0 light s-12", 'placeholder' => 'Pinterest', 'id' => 'pinterest'])!!}
                                                <div class="valid-feedback">
                                                    Looks Good
                                                </div>
                                                <div class="invalid-feedback">
                                                    Please Provide a Valid Name
                                                </div>
                                            </div>
                                            <div class="form-group col-4 m-0">
                                                {!! Form::label('instagram', 'Instagram', ['class' => 'col-form-label s-12']) !!}
                                                {!! Form::text('instagram', '', ['class' => "form-control r-0 light s-12", 'placeholder' => 'Instagram', 'id' => 'instagram'])!!}
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
@include('inc.foot')