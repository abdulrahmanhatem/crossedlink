@include('inc.header')


<div class="page has-sidebar-left  height-full company-crete">
    <header class="blue accent-3 relative">
        <div class="container-fluid text-white">
            <div class="row p-t-b-10 ">
                <div class="col">
                    <h4>
                        <i class="icon-database"></i>
                        Countries
                    </h4>
                </div>
            </div>
            <div class="row justify-content-between">
                <ul class="nav nav-material nav-material-white responsive-tab" id="v-pills-tab" role="tablist">
                    <li>
                        <a class="nav-link active"  href="{{url('dashboard/countries')}}"
                           role="tab" aria-controls="v-pills-all"><i class="icon icon-home2"></i>All Countries</a>
                    </li>
                    <li class="float-right">
                        <a class="nav-link"  href="{{url('dashboard/countries/create')}}" ><i class="icon icon-plus-circle"></i> Add New country</a>
                    </li>
                </ul>
            </div>
        </div>
    </header>
    <div class="container-fluid animatedParent animateOnce">
        <div class="animated fadeInUpShort">
            <div class="row my-3">
                <div class="col-md-7  offset-md-2">
                    {!! Form::open(['action'=> ['CountryController@update', $country->id], 'method'=>'POST', 'enctype' =>'multipart/form-data' ])!!}
                        <div class="card no-b  no-r">
                            <div class="card-body">
                                <div class="form-row">
                                    <div class="col-md-12">
                                        <h5 class="card-title">About country</h5>
                                        <div class="form-row mt-1">
                                            <div class="form-group col-4 m-0">
                                                {!! Form::label('name', 'Country name', ['class' => 'col-form-label s-12']) !!}
                                                {!! Form::text('name', $country->name , ['class' => "form-control r-0 light s-12", 'placeholder' => 'Country Name'])!!}
                                                <div class="valid-feedback">
                                                    Looks Good
                                                </div>
                                                <div class="invalid-feedback">
                                                    Please Provide a Valid Name
                                                </div>
                                            </div>
                                            <div class="form-group col-4 m-0">
                                                {!! Form::label('code', 'Country Code(iso2)', ['class' => 'col-form-label s-12'], false) !!}
                                                {!! Form::text('code', $country->code,  ['class' => "form-control r-0 light s-12", 'placeholder' => 'Country Code(iso2)', 'id' => 'country'])!!}
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