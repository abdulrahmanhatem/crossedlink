@include('inc.header')


<div class="page has-sidebar-left  height-full company-crete">
    <header class="blue accent-3 relative">
        <div class="container-fluid text-white">
            <div class="row p-t-b-10 ">
                <div class="col">
                    <h4>
                        <i class="icon-database"></i>
                        cobones
                    </h4>
                </div>
            </div>
            <div class="row justify-content-between">
                <ul class="nav nav-material nav-material-white responsive-tab" id="v-pills-tab" role="tablist">
                    <li>
                        <a class="nav-link active"  href="{{url('dashboard/cobones')}}"
                           role="tab" aria-controls="v-pills-all"><i class="icon icon-home2"></i>All cobones</a>
                    </li>
                    <li class="float-right">
                        <a class="nav-link"  href="{{url('dashboard/cobones/create')}}" ><i class="icon icon-plus-circle"></i> Add New Cobone</a>
                    </li>
                </ul>
            </div>
        </div>
    </header>
    <div class="container-fluid animatedParent animateOnce">
        <div class="animated fadeInUpShort">
            <div class="row my-3">
                <div class="col-md-7  offset-md-2">
                    {!! Form::open(['action'=> ['CoboneController@update', $cobone->id], 'method'=>'POST', 'enctype' =>'multipart/form-data' ])!!}
                        <div class="card no-b  no-r">
                            <div class="card-body">
                                <div class="form-row">
                                    <div class="col-md-12">
                                        <h5 class="card-title">About cobone</h5>
                                        <div class="form-row mt-1">
                                            <div class="form-group col-4 m-0">
                                                {!! Form::label('code', 'Cobone Code', ['class' => 'col-form-label s-12']) !!}
                                                {!! Form::text('code', $cobone->code, ['class' => "form-control r-0 light s-12", 'placeholder' => 'Cobone code'])!!}
                                                <div class="valid-feedback">
                                                    Looks Good
                                                </div>
                                                <div class="invalid-feedback">
                                                    Please Provide a Valid Name
                                                </div>
                                            </div>
                                            <div class="form-group col-4 m-0">
                                                {!! Form::label('percentage', 'percentage', ['class' => 'col-form-label s-12']) !!}
                                                {!! Form::text('percentage',$cobone->percentage, ['class' => "form-control r-0 light s-12", 'placeholder' => 'percentage', 'id' => 'percentage'])!!}
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