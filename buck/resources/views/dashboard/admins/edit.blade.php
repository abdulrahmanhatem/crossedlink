@include('inc.header')


<div class="page has-sidebar-left  height-full admin-crete">
    <header class="blue accent-3 relative">
        <div class="container-fluid text-white">
            <div class="row p-t-b-10 ">
                <div class="col">
                    <h4>
                        <i class="icon-database"></i>
                        Users
                    </h4>
                </div>
            </div>
            <div class="row justify-content-between">
                <ul class="nav nav-material nav-material-white responsive-tab" id="v-pills-tab" role="tablist">
                    <li>
                        <a class="nav-link"  href="{{url('dashboard/admins')}}"><i class="icon icon-home2"></i>All Admins</a>
                    </li>
                    <li>
                        <a class="nav-link active"  href="{{url('dashboard/admins/'. $admin->id .'/edit')}}" ><i class="icon icon-plus-circle"></i> Edit Admin</a>
                    </li>
                </ul>
            </div>
        </div>
    </header>
    <div class="container-fluid animatedParent animateOnce">
        <div class="animated fadeInUpShort">
            <div class="row my-3">
                <div class="col-md-7  offset-md-2">
                    {!! Form::open(['action'=> ['AdminController@update', $admin->id], 'method'=>'POST', 'enctype' =>'multipart/form-data' ])!!}
                        <div class="card no-b  no-r">
                            <div class="card-body">
                                <h5 class="card-title">Edit Admin</h5>
                                <div class="form-row profile-container">
                                    <div class="col-md-8">
                                        <div class="form-row mt-1">
                                            <div class="form-group col-6  m-0">
                                                {!! Form::label('first_name', 'First Name', ['class' => 'col-form-label s-12']) !!}
                                                {!! Form::text('first_name', $admin->first_name,  ['class' => "form-control r-0 light s-12", 'placeholder' => 'Enter First Name'])!!}
                                            </div>
                                            <div class="form-group col-6  m-0">
                                                {!! Form::label('middle_name', 'Last Name', ['class' => 'col-form-label s-12']) !!}
                                                {!! Form::text('middle_name', $admin->middle_name,  ['class' => "form-control r-0 light s-12", 'placeholder' => 'Enter Last Name'])!!}
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
                                                {!! Form::text('email', $admin->email,  ['class' => "form-control r-0 light s-12", 'placeholder' => 'user@email.com', 'id' => 'email'])!!}
                                            </div>
        
                                            <div class="form-group col-6 m-0">
                                                {!! Form::label('phone', '<i class="icon-phone mr-2"></i>Phone', ['class' => 'col-form-label s-12'], false) !!}
                                                {!! Form::text('phone', $admin->phone,  ['class' => "form-control r-0 light s-12", 'placeholder' => '05112345678', 'id' => 'phone'])!!}
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