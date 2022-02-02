@include('inc.header')


<div class="page has-sidebar-left  height-full company-crete">
    <header class="blue accent-3 relative">
        <div class="container-fluid text-white">
            <div class="row p-t-b-10 ">
                <div class="col">
                    <h4>
                        <i class="icon-database"></i>
                        Personal
                    </h4>
                </div>
            </div>
            <div class="row justify-content-between">
                <ul class="nav nav-material nav-material-white responsive-tab" id="v-pills-tab" role="tablist">
                    <li>
                        <a class="nav-link"  href="{{url('dashboard/personal')}}"><i class="icon icon-home2"></i>All Personal</a>
                    </li>
                    <li>
                        <a class="nav-link active"  href="{{url('dashboard/personal/'. $person->id .'/edit')}}" ><i class="icon icon-plus-circle"></i> Edit Personal</a>
                    </li>
                </ul>
            </div>
        </div>
    </header>
    <div class="container-fluid animatedParent animateOnce">
        <div class="animated fadeInUpShort">
            <div class="row my-3">
                <div class="col-md-7  offset-md-2">
                    {!! Form::open(['action'=> ['PersonController@update', $person->id], 'method'=>'POST', 'enctype' =>'multipart/form-data' ])!!}
                        <div class="card no-b  no-r">
                            <div class="card-body">
                                <div class="form-row profile-container">
                                    <div class="col-md-8">
                                        <h5 class="card-title">Contact Informations</h5>
                                        <div class="form-row mt-1">
                                            <div class="form-group col-6 m-0">
                                                {!! Form::label('first_name', 'First Name', ['class' => 'col-form-label s-12']) !!}
                                                {!! Form::text('first_name', $person->first_name,  ['class' => "form-control r-0 light s-12", 'placeholder' => 'First Name'])!!}
                                                <div class="valid-feedback">
                                                    Looks Good
                                                </div>
                                                <div class="invalid-feedback">
                                                    Please Provide a Valid Name
                                                </div>
                                            </div>
                                            <div class="form-group col-6 m-0">
                                                {!! Form::label('middle_name', 'Last Name', ['class' => 'col-form-label s-12']) !!}
                                                {!! Form::text('middle_name',  $person->middle_name,  ['id' => 'middle_name', 'class' => "form-control r-0 light s-12", 'placeholder' => 'Last Name'])!!}
                                                <div class="valid-feedback">
                                                    Looks Good
                                                </div>
                                                <div class="invalid-feedback">
                                                    Please Provide a Your Name
                                                </div>
                                            </div>
                                        </div>     
                                        <div class="form-row">
                                            <div class="form-group col-md-6 col-sm-12 m-0">
                                                {!! Form::label('password', 'Password', ['class' => 'col-form-label s-12']) !!}
                                                {!! Form::password('password', ['class' => "form-control r-0 light s-12", 'placeholder' => 'Password', 'id' => 'password'])!!}
                                            </div>
                                            <div class="form-group col-6 m-0">
                                                {!! Form::label('country', 'Country', ['class' => 'col-form-label s-12'], false) !!}
                                                {!! Form::select('country', Helper::countries(),  $person->country,  ['class' => "form-control r-0 light s-12", 'placeholder' => 'Country', 'id' => 'country'])!!}
                                            </div>
                                        </div>
                                        <h5 class="card-title mt-4">Business Informations</h5>
                                        <div class="form-row mt-1">
                                            <div class="form-group col-6 m-0">
                                                {!! Form::label('email', '<i class="icon-envelope-o mr-2"></i>Business Email', ['class' => 'col-form-label s-12'], false) !!}
                                                {!! Form::text('email',  $person->email,  ['class' => "form-control r-0 light s-12", 'placeholder' => 'person@email.com', 'id' => 'email', 'required'])!!}
                                                <div class="valid-feedback">
                                                    Looks Good
                                                </div>
                                                <div class="invalid-feedback">
                                                    Please Provide a Valid Email
                                                </div>
                                            </div>
                                          
                                            <div class="form-group col-6 m-0">
                                                {!! Form::label('phone', '<i class="icon-phone mr-2"></i>Business Phone', ['class' => 'col-form-label s-12'], false) !!}
                                                {!! Form::text('phone', $person->phone,  ['class' => "form-control r-0 light s-12", 'placeholder' => '05112345678', 'id' => 'phone'])!!}
                                            </div>
                                           
                                            <div class="form-group col-sm-6 m-0">
                                                {!! Form::label('address', 'person Address', ['class' => 'col-form-label s-12'], false) !!}
                                                {!! Form::text('address',  $person->address,  ['class' => "form-control r-0 light s-12", 'placeholder' => 'Enter Address', 'id' => 'address'])!!}
                                            </div>
                                        </div>
                                        <h5 class="card-title mt-4">Overview & Services</h5>
                                        <div class="form-row">
                                            <div class="form-row">
                                                <div class="form-group col-sm-6 m-0 overview">
                                                    {!! Form::label('overview', 'person Overview', ['class' => 'col-form-label s-12'], false) !!}
                                                    {!! Form::textarea('overview',  $person->overview,  ['id' => 'experience', 'class' => "form-control r-0 light s-12", 'placeholder' => 'person Overview'])!!}
                                                </div>
                                                <div class="form-group col-sm-6 m-0">
                                                    {!! Form::label('services', 'Services', ['class' => 'col-form-label s-12'], false) !!}
                                                    {!! Form::textarea('services',  $person->services,  ['class' => "form-control r-0 light s-12", 'placeholder' => 'person Services', 'id' => 'services'])!!}
                                                </div>
                                            </div>
                                        </div>     
                                    </div>
                                    <div class="col-md-3 offset-md-1">
                                        {!! Form::file('profile_image', [ 'hidden', 'id' => 'profile_image'])!!}
                                        <label for="profile_image" class="club_avatar">
                                            @if (empty($person->profile_image))
                                                <img class=" no-b no-p" src="{{Helper::checkImg('profile_images/default.jpg')}}" alt="person Avatar" id="preview_image">
                                            @else 
                                                <img class=" no-b no-p" src="{{Helper::checkImg('profile_images/' .$person->profile_image)}}" alt="person Avatar" id="preview_image">
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

                                        {{--<h5 class="card-title mt-4">Work Houres</h5>
                                        <div class="form-row">  
                                            <div class="form-row">
                                               <div class="form-group col-sm-3 col-sm-6 m-0 o-hours">
                                                    {!! Form::label('sa', trans('main.Saturday'), ['class' => 'col-form-label s-12'], false) !!}
                                                    {!! Form::select('sa_from',  Helper::operatingHours() ,$person->sa_from,['id' => 'sa', 'class' => "form-control r-0 light s-12", 'placeholder' => trans('main.To'), 'type' => 'number'])!!}
                                                    {!! Form::select('sa_to',  Helper::operatingHours() ,$person->sa_to,['id' => 'sa', 'class' => "form-control r-0 light s-12", 'placeholder' => trans('main.From'), 'type' => 'number'])!!}
                                                </div>
                                                
                                               
                                                <div class="form-group col-sm-3 col-sm-6 m-0 o-hours">
                                                    {!! Form::label('su', trans('main.Sunday'), ['class' => 'col-form-label s-12'], false) !!}
                                                    {!! Form::select('sa_from',  Helper::operatingHours() ,$person->sa_from,['id' => 'sa', 'class' => "form-control r-0 light s-12", 'placeholder' =>  trans('main.To'), 'type' => 'number'])!!}
                                                    {!! Form::select('su_to',  Helper::operatingHours() ,$person->su_to,  ['id' => 'su', 'class' => "form-control r-0 light s-12", 'placeholder' => trans('main.From'), 'type' => 'number'])!!}
                                                </div>
                                               
                                                <div class="form-group col-sm-3 col-sm-6 m-0 o-hours">
                                                    {!! Form::label('mo', trans('main.Monday'), ['class' => 'col-form-label s-12'], false) !!}
                                                    {!! Form::select('mo_from',  Helper::operatingHours() ,$person->mo_from,  ['id' => 'mo', 'class' => "form-control r-0 light s-12", 'placeholder' =>  trans('main.To'), 'type' => 'number'])!!}
                                                    {!! Form::select('mo_to',  Helper::operatingHours() ,$person->mo_to,  ['id' => 'mo', 'class' => "form-control r-0 light s-12", 'placeholder' => trans('main.From'), 'type' => 'number'])!!}
                                                </div>
                                           
                                                <div class="form-group col-sm-3 col-sm-6 m-0 o-hours">
                                                    {!! Form::label('tu', trans('main.Tuesday'), ['class' => 'col-form-label s-12'], false) !!}
                                                    {!! Form::select('tu_from',  Helper::operatingHours() ,$person->tu_from,  ['id' => 'tu', 'class' => "form-control r-0 light s-12", 'placeholder' =>  trans('main.To'), 'type' => 'number'])!!}
                                                    {!! Form::select('tu_to',  Helper::operatingHours() ,$person->tu_to,  ['id' => 'tu', 'class' => "form-control r-0 light s-12", 'placeholder' => trans('main.From'), 'type' => 'number'])!!}
                                                </div>
                                          
                                                <div class="form-group col-sm-3 col-sm-6 m-0 o-hours">
                                                    {!! Form::label('we', trans('main.Wednesday'), ['class' => 'col-form-label s-12'], false) !!}
                                                    {!! Form::select('we_from',  Helper::operatingHours() ,$person->we_from,  ['id' => 'we', 'class' => "form-control r-0 light s-12", 'placeholder' =>  trans('main.To'), 'type' => 'number'])!!}
                                                    {!! Form::select('we_to',  Helper::operatingHours() ,$person->we_to,  ['id' => 'we', 'class' => "form-control r-0 light s-12", 'placeholder' => trans('main.From'), 'type' => 'number'])!!}
                                                </div>
                                             
                                                <div class="form-group col-sm-3 col-sm-6 m-0 o-hours">
                                                    {!! Form::label('th', trans('main.Thursday'), ['class' => 'col-form-label s-12'], false) !!}
                                                    {!! Form::select('th_from',  Helper::operatingHours() ,$person->th_from,  ['id' => 'th', 'class' => "form-control r-0 light s-12", 'placeholder' =>  trans('main.To'), 'type' => 'number'])!!}
                                                    {!! Form::select('th_to',  Helper::operatingHours() ,$person->th_to,  ['id' => 'th', 'class' => "form-control r-0 light s-12", 'placeholder' => trans('main.From'), 'type' => 'number'])!!}
                                                </div>
                                               
                                                <div class="form-group col-sm-3 col-sm-6 m-0 o-hours">
                                                    {!! Form::label('fr', trans('main.Friday'), ['class' => 'col-form-label s-12'], false) !!}
                                                    {!! Form::select('fr_from',  Helper::operatingHours() ,$person->fr_from,  ['id' => 'fr', 'class' => "form-control r-0 light s-12", 'placeholder' =>  trans('main.To'), 'type' => 'number'])!!}
                                                    {!! Form::select('fr_to',  Helper::operatingHours() , $person->fr_to,  ['id' => 'fr', 'class' => "form-control r-0 light s-12", 'placeholder' => trans('main.From'), 'type' => 'number'])!!}
                                                </div>
                                            </div>--}}
                                            
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