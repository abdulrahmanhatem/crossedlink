@include('inc.header')


<div class="page has-sidebar-left  height-full company-crete">
    <header class="blue accent-3 relative">
        <div class="container-fluid text-white">
            <div class="row p-t-b-10 ">
                <div class="col">
                    <h4>
                        <i class="icon-database"></i>
                        Packages
                    </h4>
                </div>
            </div>
            <div class="row justify-content-between">
                <ul class="nav nav-material nav-material-white responsive-tab" id="v-pills-tab" role="tablist">
                    <li>
                        <a class="nav-link"  href="{{url('dashboard/packages')}}"><i class="icon icon-home2"></i>All Packages</a>
                    </li>
                    <li>
                        <a class="nav-link"  href="{{url('dashboard/packages/create')}}" ><i class="icon icon-plus-circle"></i> Add New Package</a>
                    </li>
                    <li>
                        <a class="nav-link active"  href="{{url('dashboard/packages/create/extention')}}" ><i class="icon icon-plus-circle"></i> Add Addon</a>
                    </li>
                </ul>
            </div>
        </div>
    </header>
    <div class="container-fluid animatedParent animateOnce">
        <div class="animated fadeInUpShort">
            <div class="row my-3">
                <div class="col-md-7  offset-md-2">
                    {!! Form::open(['action'=>'PackageController@store', 'method'=>'POST', 'enctype' =>'multipart/form-data', ' novalidate', 'class' => 'needs-validation'])!!}
                        <div class="card no-b  no-r">
                            <div class="card-body">
                                <div class="form-row">
                                    <div class="col-md-12">
                                        <h5 class="card-title">Add Ads Addon</h5>
                                        <div class="form-row mt-1">
                                            <div class="form-group col-4 m-0">
                                                {!! Form::label('name', 'Addon name', ['class' => 'col-form-label s-12']) !!}
                                                {!! Form::text('name', '', ['class' => "form-control r-0 light s-12", 'placeholder' => 'Addon Name'])!!}
                                                <div class="valid-feedback">
                                                    Looks Good
                                                </div>
                                                <div class="invalid-feedback">
                                                    Please Provide a Valid Name
                                                </div>
                                            </div>
                                                {!! Form::text('role', 3, ['hidden'])!!}
                                                {!! Form::text('profiles', 0,  ['hidden'])!!}
                                            <div class="form-group col-4 m-0">
                                                {!! Form::label('price', 'Price(SAR)', ['class' => 'col-form-label s-12'], false) !!}
                                                {!! Form::text('price', '',  ['class' => "form-control r-0 light s-12", 'placeholder' => 'Price', 'id' => 'price'])!!}
                                            </div>
                                            <div class="form-group col-4 m-0">
                                                {!! Form::label('period', 'Package Period(Days)', ['class' => 'col-form-label s-12'], false) !!}
                                                {!! Form::text('period', '',  ['class' => "form-control r-0 light s-12", 'placeholder' => 'Package Period(Days)', 'id' => 'period'])!!}
                                            </div>
                                        </div>   
                                        <div class="form-row mt-1">
                                                
                                            
                                            
                                            <div class="form-group col-4 m-0">
                                                {!! Form::label('ads', 'Ads Package', ['class' => 'col-form-label s-12'], false) !!}
                                                {!! Form::text('ads', '',  ['class' => "form-control r-0 light s-12", 'placeholder' => 'Ads Package', 'id' => 'ads'])!!}
                                            </div>
                                            <div class="form-group col-4 m-0">
                                                {!! Form::label('sponsored', 'Price', ['class' => 'col-form-label s-12'], false) !!}
                                                {!! Form::select('sponsored', [0 => 'Non Sponsored', 1 => 'Sponsored'], '',  ['class' => "form-control r-0 light s-12", 'placeholder' => 'Sponsorship', 'id' => 'sponsored'])!!}
                                            </div>
                                        </div>  
                                    </div>
                                </div>
                            </div>
                        <hr>
                        <div class="card-body">
                            {!! Form::submit('Create', ['class' => "btn btn-primary btn-lg", 'name' => 'create-extention']) !!}
                        </div>
                    </div>
                {!! Form::close() !!}
                </div>
                <div class="col-md-7  offset-md-2">
                    {!! Form::open(['action'=>'PackageController@store', 'method'=>'POST', 'enctype' =>'multipart/form-data', ' novalidate', 'class' => 'needs-validation'])!!}
                        <div class="card no-b  no-r">
                            <div class="card-body">
                                <div class="form-row">
                                    <div class="col-md-12">
                                        <h5 class="card-title">Add Profiles Addon</h5>
                                        <div class="form-row mt-1">
                                            <div class="form-group col-4 m-0">
                                                {!! Form::label('name', 'Addon name', ['class' => 'col-form-label s-12']) !!}
                                                {!! Form::text('name', '', ['class' => "form-control r-0 light s-12", 'placeholder' => 'Addon Name'])!!}
                                                <div class="valid-feedback">
                                                    Looks Good
                                                </div>
                                                <div class="invalid-feedback">
                                                    Please Provide a Valid Name
                                                </div>
                                            </div>
                                                {!! Form::text('role', 4, ['hidden'])!!}
                                            <div class="form-group col-4 m-0">
                                                {!! Form::label('price', 'Price(SAR)', ['class' => 'col-form-label s-12'], false) !!}
                                                {!! Form::text('price', '',  ['class' => "form-control r-0 light s-12", 'placeholder' => 'Price', 'id' => 'price'])!!}
                                            </div>
                                            <div class="form-group col-4 m-0">
                                                {!! Form::label('period', 'Package Period(Days)', ['class' => 'col-form-label s-12'], false) !!}
                                                {!! Form::text('period', '',  ['class' => "form-control r-0 light s-12", 'placeholder' => 'Package Period(Days)', 'id' => 'period'])!!}
                                            </div>
                                        </div>   
                                        <div class="form-row mt-1">
                                            <div class="form-group col-4 m-0">
                                                {!! Form::label('profiles', 'Profiles Package', ['class' => 'col-form-label s-12']) !!}
                                                {!! Form::text('profiles', '',  ['class' => "form-control r-0 light s-12", 'placeholder' => 'profiles Package', 'id' => 'profiles'])!!}
                                            </div>
                                            <div class="form-group col-4 m-0">
                                                {!! Form::label('sponsored', 'Price', ['class' => 'col-form-label s-12'], false) !!}
                                                {!! Form::select('sponsored', [0 => 'Non Sponsored', 1 => 'Sponsored'], '',  ['class' => "form-control r-0 light s-12", 'placeholder' => 'Sponsorship', 'id' => 'sponsored'])!!}
                                            </div>
                                            
                                                {!! Form::text('ads', 0,  ['hidden'])!!}
                                        </div>  
                                    </div>
                                </div>
                            </div>
                        <hr>
                        <div class="card-body">
                            {!! Form::submit('Create', ['class' => "btn btn-primary btn-lg", 'name' => 'create-extention']) !!}
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