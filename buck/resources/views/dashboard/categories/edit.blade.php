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
                        <a class="nav-link active"  href="{{url('dashboard/categories/'. $category->id .'/edit')}}" ><i class="icon icon-plus-circle"></i> Edit Category</a>
                    </li>
                </ul>
            </div>
        </div>
    </header>
    <div class="container-fluid animatedParent animateOnce">
        <div class="animated fadeInUpShort">
            <div class="row my-3">
                <div class="col-md-7  offset-md-2">
                    {!! Form::open(['action'=> ['CategoryController@update', $category->id], 'method'=>'POST', 'enctype' =>'multipart/form-data' ])!!}
                        <div class="card no-b  no-r">
                            <div class="card-body">
                                <div class="form-row">
                                    <div class="col-md-12">
                                        <h5 class="card-title">About Category</h5>
                                        <div class="form-row mt-1">
                                            {{--<div class="form-group col-3 m-0">
                                                {!! Form::label('number', 'Number', ['class' => 'col-form-label s-12']) !!}
                                                {!! Form::text('number', $category->number,  ['class' => "form-control r-0 light s-12", 'placeholder' => 'Category Number'])!!}
                                                <div class="valid-feedback">
                                                    Looks Good
                                                </div>
                                                <div class="invalid-feedback">
                                                    Please Provide a Valid Number
                                                </div>
                                            </div>--}}
                                            <div class="form-group col-3 m-0">
                                                {!! Form::label('name', 'Category Name', ['class' => 'col-form-label s-12']) !!}
                                                {!! Form::text('name', $category->name,  ['class' => "form-control r-0 light s-12", 'placeholder' => 'Category Name'])!!}
                                                <div class="valid-feedback">
                                                    Looks Good
                                                </div>
                                                <div class="invalid-feedback">
                                                    Please Provide a Valid Name
                                                </div>
                                            </div>
                                            <div class="form-group col-3 m-0">
                                                {!! Form::label('name_ar', 'Category Arbic Name', ['class' => 'col-form-label s-12']) !!}
                                                {!! Form::text('name_ar', $category->name_ar,  ['class' => "form-control r-0 light s-12", 'placeholder' => 'Category Arbic Name'])!!}
                                                <div class="valid-feedback">
                                                    Looks Good
                                                </div>
                                                <div class="invalid-feedback">
                                                    Please Provide a Valid Name
                                                </div>
                                            </div>
                                            <div class="form-group col-3 m-0">
                                                {!! Form::label('role', 'Role', ['class' => 'col-form-label s-12 d-block text-center'], false) !!}
                                                {!! Form::select('role', [2 => 'Companies', 1 => 'Personal', 3 => 'Both'], $category->role,  ['class' => "form-control r-0 light s-12", 'placeholder' => 'Role', 'id' => 'country'])!!}
                                            </div>
                                            <div class="form-group col-3 m-0">
                                                {!! Form::label('', '', ['class' => 'col-form-label s-12'], false) !!}
                                                <i class="fa fa-{{$category->icon}} text-success fa-2x d-block text-center mt-3"></i>
                                            </div>
                                        </div>     
                                    </div>
                                    <div class="col-md-12">
                                         <p>
                                          <a class="btn btn-primary mt-2" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                                            Icon
                                          </a>
                                        </p>
                                        <div class="collapse form-group col-12 m-0" id="collapseExample">
                                            {!! Form::label('icon', 'Change Icon ?', ['class' => 'col-form-label s-12'], false) !!}
                                                <div class="row icons-index m-0">
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