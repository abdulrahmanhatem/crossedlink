@include('inc.header')


<div class="page has-sidebar-left  height-full company-crete">
    <header class="blue accent-3 relative">
        <div class="container-fluid text-white">
            <div class="row p-t-b-10 ">
                <div class="col">
                    <h4>
                        <i class="icon-database"></i>
                        Categories
                    </h4>
                </div>
            </div>
            <div class="row justify-content-between">
                <ul class="nav nav-material nav-material-white responsive-tab" id="v-pills-tab" role="tablist">
                    <li>
                        <a class="nav-link"  href="{{url('dashboard/categories')}}"><i class="icon icon-home2"></i>All Categories</a>
                    </li>
                    <li>
                        <a class="nav-link active"  href="{{url('dashboard/categories/create')}}" ><i class="icon icon-plus-circle"></i> Add New Category</a>
                    </li>
                </ul>
            </div>
        </div>
    </header>
    <div class="container-fluid animatedParent animateOnce">
        <div class="animated fadeInUpShort">
            <div class="row my-3">
                <div class="col-md-7  offset-md-2">
                    {!! Form::open(['action'=>'CategoryController@store', 'method'=>'POST', 'enctype' =>'multipart/form-data', ' novalidate', 'class' => 'needs-validation'])!!}
                        <div class="card no-b  no-r">
                            <div class="card-body">
                                <div class="form-row">
                                    <div class="col-md-12">
                                        <h5 class="card-title">About Category</h5>

                                        <div class="form-row mt-1">
                                            {{--<div class="form-group col-3 m-0">
                                                {!! Form::label('number', 'Number', ['class' => 'col-form-label s-12']) !!}
                                                {!! Form::text('number', '',  ['class' => "form-control r-0 light s-12", 'placeholder' => 'Category Number'])!!}
                                                <div class="valid-feedback">
                                                    Looks Good
                                                </div>
                                                <div class="invalid-feedback">
                                                    Please Provide a Valid Number
                                                </div>
                                            </div>--}}
                                            <div class="form-group col-4 m-0">
                                                {!! Form::label('name', 'Category Name', ['class' => 'col-form-label s-12']) !!}
                                                {!! Form::text('name', '',  ['class' => "form-control r-0 light s-12", 'placeholder' => 'Category Name'])!!}
                                                <div class="valid-feedback">
                                                    Looks Good
                                                </div>
                                                <div class="invalid-feedback">
                                                    Please Provide a Valid Name
                                                </div>
                                            </div>
                                            <div class="form-group col-4 m-0">
                                                {!! Form::label('name_ar', 'Category Arbic Name', ['class' => 'col-form-label s-12']) !!}
                                                {!! Form::text('name_ar', '',  ['class' => "form-control r-0 light s-12", 'placeholder' => 'Category Arbic Name'])!!}
                                                <div class="valid-feedback">
                                                    Looks Good
                                                </div>
                                                <div class="invalid-feedback">
                                                    Please Provide a Valid Name
                                                </div>
                                            </div>
                                            <div class="form-group col-4 m-0">
                                                {!! Form::label('role', 'Role', ['class' => 'col-form-label s-12'], false) !!}
                                                {!! Form::select('role', [2 => 'Companies', 1 => 'Personal', 3 => 'Both'], '',  ['class' => "form-control r-0 light s-12", 'placeholder' => 'Role', 'id' => 'country'])!!}
                                            </div>
                                            {{--<div class="form-group col-4 m-0">
                                                {!! Form::label('icon', 'Icon', ['class' => 'col-form-label s-12'], false) !!}
                                                {!! Form::select('icon', Helper::MDI(), '',  ['class' => "form-control r-0 light s-12", 'placeholder' => 'Icon', 'id' => 'Icon'])!!}
                                            </div>--}}
                                            
                                        </div>     
                                    </div>
                                    <div class="col-md-12 mt-2">
                                        <p>
                                          <a class="btn btn-primary" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                                            Icon
                                          </a>
                                        </p>
                                        <div class="collapse form-group col-12 m-0" id="collapseExample">
                                            {!! Form::label('icon', 'Icon', ['class' => 'col-form-label s-12'], false) !!}
                                                <div class="row icons-index">
                                                @foreach (Helper::fontAwesome() as $key => $value)
                                                
                                                    <div class="col-md-3 icon-container">
                                                        <input type="radio" id="value-{{$value}}" name="icon" class="custom-control-input" value ="{{ $value }}" hidden>
                                                    <label class="custom-control-label ml-1 text-muted" for="value-{{$value}}"><i class="fa fa-{{$value}}"></i><span>{{$value}}</span></label>
                                                    </div>
                                                @endforeach 
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