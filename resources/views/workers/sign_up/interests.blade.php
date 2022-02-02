@include('inc.home.head', ['title' => trans('main.Career Details')])

<section class="p-150 sign-up">
    <div class="container">
        <div class="row steps">
            <div class="col-md-4 col-sm-4 step active">
                <div>
                    <i class="fal fa-grip-lines"></i>
                <p>{{trans('main.Career Details')}}</p>
                </div>
            </div>
            <div class="col-md-4 col-sm-4 step">
                <div>
                    <i class="fal fa-id-card"></i>
                    <p>{{trans('main.General Info')}}</p>
                </div>
            </div>
            <div class="col-md-4 col-sm-4 step">
                <div>
                    <i class="fal fa-briefcase"></i>
                    <p>{{trans('main.professional Info')}}</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="offset-sm-3 col-sm-6 sign-up-panel">
                {!! Form::open(['action'=> ['ProfileController@update', $user->id], 'method'=>'POST', 'enctype' =>'multipart/form-data'])!!}
                    <div class="col-md-12">
                        <div class="form-group app-label mt-2">
                            <label class="text-muted">{{trans('main.What job role are you interested in?')}} <span class="valid-star">*</span></label>
                            <br>
                            @if (auth()->user()->category_id)
                                <select class="form-control resume" id="example-getting-started" multiple="multiple" name="category_id[]" size="4" value="{{auth()->user()->category_id}}">
                                
                                    @foreach (Helper::categoriesNames() as $key => $category)
                                    @if (auth()->user()->category_id)
                                        
                                        @if (Helper::userCatCheck(auth()->user()->category_id,$key ))
                                            <option value="{{$key}}" selected>{{$category}}</option>
                                        @else 
                                            <option value="{{$key}}">{{$category}}</option>
                                        @endif
                                    
                                    @endif
                                @endforeach
                            @else 
                                <select class="form-control resume" id="example-getting-started" multiple="multiple" name="category_id[]" size="4">
                                @foreach (Helper::categoriesNames() as $key => $category)
                                    <option value="{{$key}}">{{$category}}</option>
                                @endforeach
                            @endif
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group app-label mt-2">
                            <label class="text-muted"> {{trans('main.What is your current career Experience')}} <span class="valid-star">*</span></label>
                            {!! Form::select('experience', Helper::experience( ), $user->experience,  ['class' => "form-control resume", 'placeholder' => trans('main.Experience')])!!}
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group app-label mt-2">
                            <label class="text-muted"> {{trans('main.What is the salary range you would accept?')}} <span class="valid-star">*</span></label>
                            {!! Form::select('average_salary', Helper::minimalSalary( ),$user->average_salary,  ['class' => "form-control resume", 'placeholder' => trans('main.Salary')])!!}

                        @if ($user->salary_hide != 0)
                            <input type="checkbox" id="salary_hide" name="salary_hide" class="custom-control-input" value ="0" Checked>
                        @else 
                            <input type="checkbox" id="salary_hide" name="salary_hide" class="custom-control-input" value ="1" >
                        @endif
                        
                        <label class="custom-control-label ml-4 mt-3 text-muted salary" for="salary_hide">{{trans('main.Salary Confidential')}}</label>
                        </div>
                    </div>
                    <div class="col-lg-12 mt-2">
                        <div class="form-group app-label mt-2 ">
                            {!! Form::submit(trans('main.Save And Continue'), ['class' => "btn btn-primary mt-2 btn-sm float-right  sign-save", 'name' => 'edit-interest']) !!}
                        </div>
                        <div class="clearfix"></div>
                    </div>
                {!! Form::hidden('_method', 'PUT') !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</section>
    @include('inc.home.foot')
    @include('inc.home.scripts')
    
</body>
</html>