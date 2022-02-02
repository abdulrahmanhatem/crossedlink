@include('inc.header')


<div class="page has-sidebar-left  height-full company-crete">
    <header class="blue accent-3 relative">
        <div class="container-fluid text-white">
            <div class="row p-t-b-10 ">
                <div class="col">
                    <h4>
                        <i class="icon-database"></i>
                        Reviews
                    </h4>
                </div>
            </div>
            <div class="row justify-content-between">
                <ul class="nav nav-material nav-material-white responsive-tab" id="v-pills-tab" role="tablist">
                    <li>
                        <a class="nav-link"  href="{{url('dashboard/reviews')}}"><i class="icon icon-home2"></i>All Reviews</a>
                    </li>
                    <li>
                        <a class="nav-link active"  href="{{url('dashboard/reviews/create')}}" ><i class="icon icon-plus-circle"></i> Add New Review</a>
                    </li>
                </ul>
            </div>
        </div>
    </header>
    <div class="container-fluid animatedParent animateOnce">
        <div class="animated fadeInUpShort">
            <div class="row my-3">
                <div class="col-md-7  offset-md-2">
                    {!! Form::open(['action'=>'ReviewController@store', 'method'=>'POST', 'enctype' =>'multipart/form-data', ' novalidate', 'class' => 'needs-validation'])!!}
                        <div class="card no-b  no-r">
                            <div class="card-body">
                                <div class="form-row">
                                    <div class="col-md-12">
                                        <h5 class="card-title">About review</h5>
                                        <div class="form-row mt-1">
                                            <div class="form-group col-4 m-0">
                                                {!! Form::label('from_id', 'Worker Name', ['class' => 'col-form-label s-12']) !!}
                                                {!! Form::select('from_id', Helper::workersNames() ,'', ['class' => "form-control r-0 light s-12", 'placeholder' => 'Worker Name', 'id' => 'from_id'])!!}
                                                <div class="valid-feedback">
                                                    Looks Good
                                                </div>
                                                <div class="invalid-feedback">
                                                    Please Provide a Valid Name
                                                </div>
                                            </div>
                                            <div class="form-group col-4 m-0">
                                                {!! Form::label('to_id', 'Employer Name', ['class' => 'col-form-label s-12']) !!}
                                                {!! Form::select('to_id', Helper::employersNames(), '', ['class' => "form-control r-0 light s-12", 'placeholder' => 'Employer Name', 'id' => 'to_id'])!!}
                                                <div class="valid-feedback">
                                                    Looks Good
                                                </div>
                                                <div class="invalid-feedback">
                                                    Please Provide a Valid Name
                                                </div>
                                            </div>
                                            <div class="form-group col-4 m-0">
                                                {!! Form::label('rating', 'Rating', ['class' => 'col-form-label s-12']) !!}
                                                {!! Form::select('rating', [0 => 'Very Bad', 1 => 'Bad', 2 => 'Not Bad', 3 => 'Good', 4 => 'Very Good', 5 => 'Excllent' ], '', ['class' => "form-control r-0 light s-12", 'placeholder' => 'Rating', 'id' => 'percentage'])!!}
                                                <div class="valid-feedback">
                                                    Looks Good
                                                </div>
                                                <div class="invalid-feedback">
                                                    Please Provide a Valid Name
                                                </div>
                                            </div>
                                            <div class="form-group col-12 m-0">
                                                {!! Form::label('text', 'Review Text', ['class' => 'col-form-label s-12']) !!}
                                                {!! Form::textarea('text', '', ['class' => "form-control r-0 light s-12", 'placeholder' => 'Review Text', 'id' => 'text'])!!}
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