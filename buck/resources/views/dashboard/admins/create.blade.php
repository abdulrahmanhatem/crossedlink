@include('inc.header')

<div class="page has-sidebar-left  height-full admin-crete">
    <header class="blue accent-3 relative">
        <div class="container-fluid text-white">
            <div class="row p-t-b-10 ">
                <div class="col">
                    <h4>
                        <i class="icon-database"></i>
                        Admins
                    </h4>
                </div>
            </div>
            <div class="row justify-content-between">
                <ul class="nav nav-material nav-material-white responsive-tab" id="v-pills-tab" role="tablist">
                    <li>
                        <a class="nav-link"  href="{{url('dashboard/admins')}}"><i class="icon icon-home2"></i>All Admins</a>
                    </li>
                    <li>
                        <a class="nav-link active"  href="{{url('dashboard/admins/create')}}" ><i class="icon icon-plus-circle"></i> Add New Admin</a>
                    </li>
                </ul>
            </div>
        </div>
    </header>
    <div class="container-fluid animatedParent animateOnce">
        <div class="animated fadeInUpShort">
            <div class="row my-3">
                <div class="col-md-7  offset-md-2">
                    {!! Form::open(['action'=>'AdminController@store', 'method'=>'POST', 'enctype' =>'multipart/form-data', ' novalidate', 'class' => 'needs-validation'])!!}
                        <div class="card no-b  no-r">
                            <div class="card-body">
                                <h5 class="card-title">Add Admin</h5>
                                <div class="form-row profile-container">
                                    <div class="col-md-8">
                                        <div class="form-group m-0">
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
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-12 col-sm-12 m-0">
                                                {!! Form::label('password', 'Password', ['class' => 'col-form-label s-12']) !!}
                                                {!! Form::password('password', ['class' => "form-control r-0 light s-12", 'placeholder' => 'Password', 'id' => 'password'])!!}
                                            </div>
                                        </div>
                                        <div class="form-row mt-1">
                                            <div class="form-group col-6 m-0">
                                                {!! Form::label('email', '<i class="icon-envelope-o mr-2"></i>Email', ['class' => 'col-form-label s-12'], false) !!}
                                                {!! Form::text('email', '',  ['class' => "form-control r-0 light s-12", 'placeholder' => 'user@email.com', 'id' => 'email', 'required'])!!}
                                                <div class="valid-feedback">
                                                    Looks Good
                                                </div>
                                                <div class="invalid-feedback">
                                                    Please Provide a Valid Email
                                                </div>
                                            </div>
        
                                            <div class="form-group col-6 m-0">
                                                {!! Form::label('phone', '<i class="icon-phone mr-2"></i>Phone', ['class' => 'col-form-label s-12'], false) !!}
                                                {!! Form::text('phone', '',  ['class' => "form-control r-0 light s-12", 'placeholder' => '05112345678', 'id' => 'phone'])!!}
                                            </div>
                                            
        
                                        </div>
                                    </div>
                                    <div class="col-md-3 offset-md-1">
                                        {!! Form::file('profile_image', [ 'hidden', 'id' => 'profile_image'])!!}
                                        <label for="profile_image" class="club_avatar">
                                            <img class=" no-b no-p" src="{{Helper::checkImg('profile_images/default.jpg')}}" alt="Team Logo" id="preview_image">
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
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="form-row">
                                    <div class="form-group col-5 m-0">
                                    </div>
                                    <div class="form-group col-5 m-0">
                                        {!! Form::text('company_name', '',  [ 'hidden', 'class' => "form-control r-0 light s-12", 'placeholder' => 'Company Name', 'id' => 'company_name'])!!}
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