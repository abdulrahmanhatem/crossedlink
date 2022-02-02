@include('inc.home.head', ['title' => trans('main.Experience')])
<section class="section p-150 bread-crumbs">
    <div class="container">
        <a href="{{ url('/') }}" class="text-muted">Home</a> / <a href="{{ url('profiles/'.auth()->user()->id.'/edit/experience') }}" class="text-primary">{{trans('main.Experiences')}}</a>
    </div>
</section>

    <div class="worker-profile pt-4">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-12">
                    <div class="left-sidebar ">
                        <ul class="nav nav-pills nav nav-pills bg-white rounded mb-3" id="pills-tab" role="tablist">
                            <li class="nav-item d-block col-12">
                                <a class="nav-link" href="{{ url('profiles/'. auth()->user()->id) }}">{{trans('main.General Information')}}</a>
                            </li>
                            <li class="nav-item d-block col-12">
                                <a class="nav-link active" href="{{ url('profiles/'. auth()->user()->id. '/edit/experience') }}">{{trans('main.Experiences')}}</a>
                            </li>
                            <li class="nav-item d-block col-12">
                                <a class="nav-link"  href="{{ url('profiles/'. auth()->user()->id. '/edit/education') }}">{{trans('main.Education')}}</a>
                            </li>
                            <li class="nav-item d-block col-12">
                                <a class="nav-link"  href="{{ url('profiles/'. auth()->user()->id. '/edit/skills') }}">{{trans('main.Skills')}}</a>
                            </li>
                            <li class="nav-item d-block col-12">
                                <a class="nav-link"  href="{{ url('profiles/'. auth()->user()->id. '/edit/languages') }}">{{trans('main.Languages')}}</a>
                            </li>
                            <li class="nav-item d-block col-12">
                                <a class="nav-link"  href="{{ url('profiles/'. auth()->user()->id. '/edit/social') }}">{{trans('main.Online Presence')}}</a>
                            </li>
                            <li class="nav-item d-block col-12 ">
                                <a class="nav-link"  href="{{ url('profiles/'. auth()->user()->id. '/edit/gallery') }}">{{trans('main.Portfolio')}}</a>
                            </li>
                            <li class="nav-item d-block col-12 ">
                                <a class="nav-link"  href="{{ url('chat') }}">{{trans('main.Chat')}}</a>
                            </li>
                        </ul>
                    </div>
                </div>
        
                <div class="col-lg-9 col-md-12 profile-edit">
                    <div class="tab-content mt-2" id="pills-tabContent">
                        <div class="tab-pane fade general" id="general" role="tabpanel" aria-labelledby="general-tab">
                            
                        </div>
                        <div class="tab-pane fade show active experiences" id="experiences" role="tabpanel" aria-labelledby="experiences-tab">
                            <div class="col-sm-12 px-0 ">
                            @if (count($user->experiences) > 0)
                            
                                @foreach ($user->experiences as $experience)
                                    <div class="text-left text-muted position-relative w-50 d-inline-block experience-view">
                                        <div class="dropdown position-absolute options-dropdown">
                                            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="far fa-ellipsis-v"></i>
                                            </a>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                              <a class="dropdown-item text-muted" data-toggle="modal" data-target="#experience-{{ $experience->id }}">edit</a>
                                              <a class="dropdown-item text-muted" data-toggle="modal" data-target="#experience-{{ $experience->id }}-delete">Delete</a>
                                            </div>
                                        </div>
                                        <span class="mb-0 degree text-dark">
                                            <h6 class="mb-0">{{ $experience->job_title }} 
                                                @if(!empty($experience->company_name))
                                                    {{trans('main.at')}} 
                                                    @if(!empty($experience->ref))
                                                        <a class="text-muted ref" href="{{$experience->ref}}">{{ $experience->company_name }}</a>
                                                    @else 
                                                        <span class="text-muted ref" >{{ $experience->company_name }}</span>
                                                    @endif
                                                @endif
                                                
                                            </h6>
                                        </span>
                                        
                                        <p class="date">{{ Helper::getMonthNameYear($experience->from) }} - {{ Helper::getMonthNameYear($experience->to) }}</p>
                                        
                                    </div>
                                    <div class="modal fade" id="experience-{{ $experience->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">{{$experience->job_title}}</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                                </div>
                                                {!! Form::open(['action'=> ['ProfileController@update', $user->id], 'method'=>'POST', 'enctype' =>'multipart/form-data', 'class' => 'w-100'])!!}
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="row mt-1 create-field">
                                                                    <div class="form-group  col-md-4 col-sm-12 m-0">
                                                                        {!! Form::label('job_title', trans('main.Job Title').'<span class="valid-star">*</span>', ['class' => 'col-form-label s-12'], false) !!}
                                                                        {!! Form::text('job_title', $experience->job_title,  ['class' => "form-control r-0 light s-12", 'placeholder' => trans('main.Job Title'), 'id' => 'job_title'])!!}
                                                                        <div class="valid-feedback">
                                                                            {{trans('main.Looks Good')}}
                                                                        </div>
                                                                        <div class="invalid-feedback">
                                                                            {{trans('main.Please Provide a Valid Input')}}
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group col-md-4 col-sm-12 m-0">
                                                                        {!! Form::label('company_name', trans('main.Company Name').'<span class="valid-star">*</span>', ['class' => 'col-form-label s-12'], false) !!}
                                                                        {!! Form::text('company_name', $experience->company_name,  ['id' => 'middle_name', 'class' => "form-control r-0 light s-12", 'placeholder' => trans('main.Company Name'), 'id' => 'job_title'])!!}
                                                                        <div class="valid-feedback">
                                                                            {{trans('main.Looks Good')}}
                                                                        </div>
                                                                        <div class="invalid-feedback">
                                                                            {{trans('main.Please Provide a Valid Input')}}
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group col-md-4 col-sm-12 m-0">
                                                                        {!! Form::label('ref', trans('main.Reference Link').'<span class="valid-star">*</span>', ['class' => 'col-form-label s-12'], false) !!}
                                                                        {!! Form::text('ref', $experience->ref, ['class' => "form-control r-0 light s-12", 'placeholder' => trans('main.Reference Link'), 'id' => 'ref'])!!}
                                                                        <div class="valid-feedback">
                                                                            {{trans('main.Looks Good')}}
                                                                        </div>
                                                                        <div class="invalid-feedback">
                                                                            {{trans('main.Please Provide a Valid Input')}}
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row mt-1">
                                                                    <div class="form-group col-md-6 m-0">
                                                                        {!! Form::label('from', trans('main.Started Date'), ['class' => 'col-form-label s-12'], false) !!}
                                                                        {!! Form::text('from', $experience->from,  ['class' => "form-control r-0 light s-12 date-picker w-100", 'placeholder' => trans('main.Started Date'), 'id' => 'from'])!!}
                                                                    </div>
                                
                                                                    <div class="form-group col-md-6  m-0">
                                                                        {!! Form::label('to',  trans('main.Finished Date'), ['class' => 'col-form-label s-12'], false) !!}
                                                                        {!! Form::text('to', $experience->to,  ['class' => "form-control r-0 light s-12 date-picker w-100", 'placeholder' => trans('main.Finished Date'), 'id' => 'to'])!!}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ trans('main.Close')}}</button>
                                                        {!! Form::submit(trans('main.Edit'), ['class' => "btn btn-primary", 'name' => 'edit-experience']) !!}
                                                        {!! Form::text('experience_id', $experience->id, ['hidden']) !!}
                                                        {!! Form::hidden('_method', 'PUT') !!}
                                                    </div>
                                                {!! Form::close() !!}
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Delete Modal -->
                                    <div class="modal fade" id="experience-{{ $experience->id }}-delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">{{trans('main.Delete Experience')}}</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            {!! Form::open(['action'=> ['ProfileController@update', $user->id], 'method'=>'POST', 'enctype' =>'multipart/form-data', 'class' => 'w-100'])!!}
                                                <div class="modal-body">
                                                    {{trans('main.Are You Sure About Deleting')}} {{ $experience->job_title }} {{trans('main.Experience')}}?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{trans('main.Close')}}</button>
                                                    {!! Form::submit(trans('main.Delete'), ['class' => "btn btn-primary", 'name' => 'delete-experience']) !!}

                                                    
                                                </div>
                                            {!! Form::text('experience_id', $experience->id, ['hidden']) !!}
                                            {!! Form::hidden('_method', 'PUT') !!}
                                            {!! Form::close() !!}
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif

                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    {!! Form::open(['action'=> 'ProfileController@store', 'method'=>'POST', 'enctype' =>'multipart/form-data', 'class' => 'w-100'])!!}
                                    <h5 class="mt-4">{{trans('main.New Experience')}}</h5>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="row mt-1 create-field">
                                                <div class="form-group col-md-4 col-sm-12 m-0">
                                                    {!! Form::label('job_title', trans('main.Job Title').'<span class="valid-star">*</span>', ['class' => 'col-form-label s-12'], false) !!}
                                                    {!! Form::text('job_title', '',  ['class' => "form-control r-0 light s-12", 'placeholder' => trans('main.Job Title'), 'id' => 'job_title'])!!}
                                                    <div class="valid-feedback">
                                                        {{trans('main.Looks Good')}}
                                                    </div>
                                                    <div class="invalid-feedback">
                                                        {{trans('main.Please Provide a Valid Input')}}
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-4 col-sm-12  m-0">
                                                    {!! Form::label('company_name', trans('main.Company Name').'<span class="valid-star">*</span>', ['class' => 'col-form-label s-12'], false) !!}
                                                    {!! Form::text('company_name', '',  ['id' => 'middle_name', 'class' => "form-control r-0 light s-12", 'placeholder' => trans('main.Company Name'), 'id' => 'job_title'])!!}
                                                    <div class="valid-feedback">
                                                        {{trans('main.Looks Good')}}
                                                    </div>
                                                    <div class="invalid-feedback">
                                                        {{trans('main.Please Provide a Valid Input')}}
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-4 col-sm-12  m-0">
                                                    {!! Form::label('ref', trans('main.Reference Link').'<span class="valid-star">*</span>', ['class' => 'col-form-label s-12'], false) !!}
                                                    {!! Form::text('ref', '', ['class' => "form-control r-0 light s-12", 'placeholder' => trans('main.Reference Link'), 'id' => 'ref'])!!}
                                                    <div class="valid-feedback">
                                                        {{trans('main.Looks Good')}}
                                                    </div>
                                                    <div class="invalid-feedback">
                                                        {{trans('main.Please Provide a Valid Input')}}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mt-1">
                                                <div class="form-group col-md-6 m-0">
                                                    {!! Form::label('from', trans('main.Started Date'), ['class' => 'col-form-label s-12'], false) !!}
                                                    {!! Form::text('from', '',  ['class' => "form-control r-0 light s-12 date-picker", 'placeholder' => trans('main.Started Date'), 'id' => 'from'])!!}
                                                </div>
            
                                                <div class="form-group col-md-6 m-0">
                                                    {!! Form::label('to', trans('main.Finished Date'), ['class' => 'col-form-label s-12'], false) !!}
                                                    {!! Form::text('to', '',  ['class' => "form-control r-0 light s-12 date-picker", 'placeholder' => trans('main.Finished Date'), 'id' => 'to'])!!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                {!! Form::submit(trans('main.Add'), ['class' => "btn btn-primary mt-2 btn-sm", 'name' => 'create-experience']) !!}
                                {!! Form::close() !!}
                                </div>
                            </div>
                        </div>
                        
                        <div class="tab-pane fade education" id="education" role="tabpanel" aria-labelledby="education-tab">
                        </div>

                        
                        <div class="tab-pane fade skills" id="skills" role="tabpanel" aria-labelledby="skills-tab">
                       
                              
                           
                        </div>
                        <div class="tab-pane fade languages" id="languages" role="tabpanel" aria-labelledby="languages-tab">
                            
                        </div>
                        
                        <div class="tab-pane fade social" id="social" role="tabpanel" aria-labelledby="social-tab">
                            
                        </div>
                    </div>
                </div>
            </div>   
        </div>
    </div>
<!-- subscribe end -->
@include('inc.home.foot')


@include('inc.home.scripts')
<script>
    // Date Picker 
    $(".date-picker").flatpickr();
</script>
</body>
</html>