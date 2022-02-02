@include('inc.home.head', ['title' => 'Education'])

<section class="section p-150 bread-crumbs">
    <div class="container">
        <a href="{{ url('/') }}" class="text-muted">{{trans('main.Address')}}Home</a> / <a href="{{ url('profiles/'.auth()->user()->id.'/edit/education') }}" class="text-primary">{{trans('main.Address')}}Education</a>
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
                                <a class="nav-link" href="{{ url('profiles/'. auth()->user()->id. '/edit/experience') }}">{{trans('main.Experiences')}}</a>
                            </li>
                            <li class="nav-item d-block col-12">
                                <a class="nav-link active"  href="{{ url('profiles/'. auth()->user()->id. '/edit/education') }}">{{trans('main.Education')}}</a>
                            </li>
                            <li class="nav-item d-block col-12">
                                <a class="nav-link"  href="{{ url('profiles/'. auth()->user()->id. '/edit/skills') }}">{{trans('main.Skills')}}</a>
                            </li>
                            <li class="nav-item d-block col-12">
                                <a class="nav-link"  href="{{ url('profiles/'. auth()->user()->id. '/edit/languages') }}">{{trans('main.Languages')}}</a>
                            </li>
                            <li class="nav-item d-block col-12">
                                <a class="nav-link"  href="{{ url('profiles/'. auth()->user()->id. '/edit/social') }}">{{trans('main.Online Presence')}} </a>
                            </li>
                            <li class="nav-item d-block col-12 ">
                                <a class="nav-link"  href="{{ url('profiles/'. auth()->user()->id. '/edit/gallery') }}">{{trans('main.Portfolio')}}</a>
                            </li>
                        </ul>
                    </div>
                </div>
        
                <div class="col-lg-9 col-md-12 profile-edit">
                    <div class="tab-content mt-2" id="pills-tabContent">
                        <div class="tab-pane fade general" id="general" role="tabpanel" aria-labelledby="general-tab">
                            
                        </div>
                        <div class="tab-pane fade experiences" id="experiences" role="tabpanel" aria-labelledby="experiences-tab">
                       
                        </div>
                        
                        <div class="tab-pane fade education  show active" id="education" role="tabpanel" aria-labelledby="education-tab">
                            @if (!empty($user->educations))
                            <div class="row">
                                
                                @foreach ($user->educations as $education)
                                <div class="text-left text-muted position-relative d-inline-block experience-view education-view">
                                    <div class="dropdown position-absolute options-dropdown">
                                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="far fa-ellipsis-v"></i>
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                          <a class="dropdown-item text-muted" data-toggle="modal" data-target="#education-{{ $education->id }}">{{trans('main.Edit')}}</a>
                                          <a class="dropdown-item text-muted" data-toggle="modal" data-target="#education-{{ $education->id }}-delete">{{trans('main.Delete')}}</a>
                                        </div>
                                    </div>
                                    <span class="mb-0 degree text-dark">
                                        <h6 class="mb-0">
                                            @if($education->level == 0)
                                                <i class="mdi mdi-36px mdi-school"></i>
                                            @elseif($education->level == 1)
                                                <i class="mdi mdi-36px mdi-library"></i>
                                            @else
                                                <i class="mdi mdi-36px mdi-briefcase-check"></i>
                                            @endif
                                            @if(!empty($education->ref))
                                                <a class="f-17 school text-muted ref" href="{{$education->ref}}">{{ $education->school }}</a>
                                            @else 
                                                <p class="f-17 school text-muted ">{{ $education->school }}</p>
                                            @endif
                                        </h6>
                                    </span>
                                    
                                    <p class="date">{{ Helper::getMonthNameYear($education->from) }} - {{ Helper::getMonthNameYear($education->to) }}</p>
                                    <p class="mb-0">{{ $education->degree }}</p>
                                    <p class="pb-2 border-bottom mb-0 brief">{{ Str::limit( $education->brief , 90)}}</p>
                                    
                                </div>
                                    
                                    <!-- Edit Modal -->
                                    <div class="modal fade" id="education-{{ $education->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">{{trans('main.Edit Education')}}</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                                </div>
                                                {!! Form::open(['action'=>['ProfileController@update', $user->id ], 'method'=>'POST', 'enctype' =>'multipart/form-data', ' novalidate', 'class' => 'needs-validation'])!!}
                                                <div class="modal-body">
                                                    <div class="row mt-1">
                                                        <div class="form-group col-md-6 col-sm-12 m-0">
                                                            {!! Form::label('title', trans('main.Title'), ['class' => 'col-form-label s-12']) !!}
                                                            {!! Form::text('title', $education->title, ['class' => "form-control r-0 light s-12", 'placeholder' => trans('main.Title'), 'id' => 'title'])!!}
                                                            <div class="valid-feedback">
                                                                {{trans('main.Looks Good')}}
                                                            </div>
                                                            <div class="invalid-feedback">
                                                                {{trans('main.Please Provide a Valid Input')}}
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-md-6 col-sm-12 m-0">
                                                            {!! Form::label('level', trans('main.Level') . '<span class="valid-star">*</span>', ['class' => 'col-form-label s-12'], false) !!}
                                                            {!! Form::select('level', Helper::educationalLevel(), $education->level, ['class' => "form-control r-0 light s-12", 'placeholder' => trans('main.Level'), 'id' => 'level'])!!}
                                                            <div class="valid-feedback">
                                                                {{trans('main.Looks Good')}}
                                                            </div>
                                                            <div class="invalid-feedback">
                                                                {{trans('main.Please Provide a Valid Input')}}
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-md-6 col-sm-12 m-0">
                                                            {!! Form::label('school', trans('main.School') . '<span class="valid-star">*</span>', ['class' => 'col-form-label s-12'], false) !!}
                                                            {!! Form::text('school', $education->school, ['class' => "form-control r-0 light s-12", 'placeholder' => trans('main.School'), 'id' => 'school'])!!}
                                                            <div class="valid-feedback">
                                                                {{trans('main.Looks Good')}}
                                                            </div>
                                                            <div class="invalid-feedback">
                                                                {{trans('main.Address')}}
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-md-6 col-sm-12 m-0">
                                                            {!! Form::label('degree', trans('main.Certificate Title') . '<span class="valid-star">*</span>', ['class' => 'col-form-label s-12'], false) !!}
                                                            {!! Form::text('degree', $education->degree, ['class' => "form-control r-0 light s-12", 'placeholder' => trans('main.Certificate Title'), 'id' => 'degree'])!!}
                                                            <div class="valid-feedback">
                                                                {{trans('main.Looks Good')}}
                                                            </div>
                                                            <div class="invalid-feedback">
                                                                {{trans('main.Please Provide a Valid Input')}}
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-md-6 col-sm-12 m-0">
                                                            {!! Form::label('ref', trans('main.Reference Link') . '<span class="valid-star">*</span>', ['class' => 'col-form-label s-12'], false) !!}
                                                            {!! Form::text('ref', $education->ref, ['class' => "form-control r-0 light s-12", 'placeholder' => trans('main.Reference Link'), 'id' => 'ref'])!!}
                                                            <div class="valid-feedback">
                                                                {{trans('main.Looks Good')}}
                                                            </div>
                                                            <div class="invalid-feedback">
                                                                
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="form-group col-6 m-0">
                                                            {!! Form::label('from', trans('main.Started Date') . '<span class="valid-star">*</span>', ['class' => 'col-form-label s-12'], false) !!}
                                                            {!! Form::text('from', $education->from, ['class' => "form-control r-0 light s-12 date-picker", 'placeholder' => trans('main.Started Date'), 'id' => 'from'])!!}
                                                            <div class="valid-feedback">
                                                                {{trans('main.Looks Good')}}
                                                            </div>
                                                            <div class="invalid-feedback">
                                                                {{trans('main.Please Provide a Valid Input')}}
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-6 m-0">
                                                            {!! Form::label('to', trans('main.Finished Date') . '<span class="valid-star">*</span>', ['class' => 'col-form-label s-12'], false) !!}
                                                            {!! Form::text('to', $education->to, ['class' => "form-control r-0 light s-12 date-picker", 'placeholder' => trans('main.Finished Date'), 'id' => 'to'])!!}
                                                            <div class="valid-feedback">
                                                                
                                                            </div>
                                                            <div class="invalid-feedback">
                                                                {{trans('main.Please Provide a Valid Input')}}
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-12 m-0">
                                                            {!! Form::label('brief', trans('main.Brief') , ['class' => 'col-form-label s-12']) !!}
                                                            {!! Form::textarea('brief', $education->brief, ['class' => "form-control r-0 light s-12", 'placeholder' => trans('main.Write Brief'), 'id' => 'brief'])!!}
                                                            <div class="valid-feedback">
                                                                {{trans('main.Looks Good')}}
                                                            </div>
                                                            <div class="invalid-feedback">
                                                                {{trans('main.Please Provide a Valid Input')}}
                                                            </div>
                                                        </div>
                                                    </div>   
                                                
                                                    
                                                    
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">{{trans('main.Close')}}</button>
                                                    {!! Form::submit(trans('main.Edit'), ['class' => "btn btn-primary btn-sm", 'name' => 'edit-education']) !!}
                                                </div>
                                                @csrf
                                                {!! Form::text('education_id', $education->id, ['hidden']) !!}
                                                {!! Form::hidden('_method', 'PUT') !!}
                                                {!! Form::close() !!}
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Delete Modal -->
                                    <div class="modal fade" id="education-{{ $education->id }}-delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">{{trans('main.Delete Education')}}</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            {!! Form::open(['action'=> ['ProfileController@update', $user->id], 'method'=>'POST', 'enctype' =>'multipart/form-data', 'class' => 'w-100'])!!}
                                                    <div class="modal-body">
                                                        {{trans('main.Are You Sure About Deleting')}} {{ $education->job_title }} {{trans('main.Education')}}?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">{{trans('main.Close')}}</button>
                                                        {!! Form::submit(trans('main.Delete'), ['class' => "btn btn-primary btn-sm", 'name' => 'delete-education']) !!}
                                                    </div>
                                                {!! Form::text('education_id', $education->id, ['hidden']) !!}
                                                {!! Form::hidden('_method', 'PUT') !!}
                                                {!! Form::close() !!}
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                
                            </div>
                            @endif
                            <div class="container-fluid animatedParent animateOnce">
                                <div class="animated fadeInUpShort">
                                    <div class="row mt-3">
                                        <div class="col-md-12">
                                            {!! Form::open(['action'=>'ProfileController@store', 'method'=>'POST', 'enctype' =>'multipart/form-data', ' novalidate', 'class' => 'needs-validation'], false)!!}
                                                <div class="no-b  no-r">
                                                    <div class="">
                                                        <div class="form-row">
                                                            <div class="col-md-12">
                                                                <h5 class="card-title">{{trans('main.New Education')}}</h5>
                                                                <div class="form-row mt-1">
                                                                    <div class="form-group col-md-6 col-sm-12 m-0">
                                                                        {!! Form::label('level', trans('main.Level') . '<span class="valid-star">*</span>', ['class' => 'col-form-label s-12'], false) !!}
                                                                        {!! Form::select('level', Helper::educationalLevel(), '', ['class' => "form-control r-0 light s-12", 'placeholder' => trans('main.Level'), 'id' => 'level'])!!}
                                                                        <div class="valid-feedback">
                                                                            {{trans('main.Looks Good')}}
                                                                        </div>
                                                                        <div class="invalid-feedback">
                                                                            {{trans('main.Please Provide a Valid Input')}}
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group col-md-6 col-sm-12 m-0">
                                                                        {!! Form::label('school', trans('main.School') . '<span class="valid-star">*</span>', ['class' => 'col-form-label s-12'], false) !!}
                                                                        {!! Form::text('school', '', ['class' => "form-control r-0 light s-12", 'placeholder' => trans('main.School'), 'id' => 'school'])!!}
                                                                        <div class="valid-feedback">
                                                                            {{trans('main.Looks Good')}}
                                                                        </div>
                                                                        <div class="invalid-feedback">
                                                                            {{trans('main.Please Provide a Valid Input')}}
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group col-md-6 col-sm-12 m-0">
                                                                        {!! Form::label('degree', trans('main.Certificate Title') . '<span class="valid-star">*</span>', ['class' => 'col-form-label s-12'], false) !!}
                                                                        {!! Form::text('degree', '', ['class' => "form-control r-0 light s-12", 'placeholder' => trans('main.Certificate Title'), 'id' => 'degree'])!!}
                                                                        <div class="valid-feedback">
                                                                            {{trans('main.Looks Good')}}
                                                                        </div>
                                                                        <div class="invalid-feedback">
                                                                            {{trans('main.Please Provide a Valid Input')}}
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group col-md-6 col-sm-12 m-0">
                                                                        {!! Form::label('from', trans('main.Started Date') . '<span class="valid-star">*</span>', ['class' => 'col-form-label s-12'], false) !!}
                                                                        {!! Form::text('from', '', ['class' => "form-control r-0 light s-12 date-picker", 'placeholder' => trans('main.Started Date'), 'id' => 'from'])!!}
                                                                        <div class="valid-feedback">
                                                                            {{trans('main.Looks Good')}}
                                                                        </div>
                                                                        <div class="invalid-feedback">
                                                                            {{trans('main.Please Provide a Valid Input')}}
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group col-md-6 col-sm-12 m-0">
                                                                        {!! Form::label('to',  trans('main.Finished Date') . '<span class="valid-star">*</span>', ['class' => 'col-form-label s-12'], false) !!}
                                                                        {!! Form::text('to', '', ['class' => "form-control r-0 light s-12 date-picker", 'placeholder' => trans('main.Finished Date'), 'id' => 'to'])!!}
                                                                        <div class="valid-feedback">
                                                                            {{trans('main.Looks Good')}}
                                                                        </div>
                                                                        <div class="invalid-feedback">
                                                                            {{trans('main.Please Provide a Valid Input')}}
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group col-md-6 col-sm-12 m-0">
                                                                        {!! Form::label('ref', trans('main.Reference Link') . '<span class="valid-star">*</span>', ['class' => 'col-form-label s-12'], false) !!}
                                                                        {!! Form::text('ref', '', ['class' => "form-control r-0 light s-12", 'placeholder' => trans('main.Reference Link'), 'id' => 'ref'])!!}
                                                                        <div class="valid-feedback">
                                                                            {{trans('main.Looks Good')}}
                                                                        </div>
                                                                        <div class="invalid-feedback">
                                                                            {{trans('main.Please Provide a Valid Input')}}
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group col-12 m-0">
                                                                        {!! Form::label('brief', trans('main.Brief'), ['class' => 'col-form-label s-12']) !!}
                                                                        {!! Form::textarea('brief', '', ['class' => "form-control r-0 light s-12", 'placeholder' => trans('main.Write Brief'), 'id' => 'brief'])!!}
                                                                        <div class="valid-feedback">
                                                                            {{trans('main.Looks Good')}}
                                                                        </div>
                                                                        <div class="invalid-feedback">
                                                                            {{trans('main.Please Provide a Valid Input')}}
                                                                        </div>
                                                                    </div>
                                                                    
                                                                </div>   
                                                               
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="">
                                                    {!! Form::submit(trans('main.Add'), ['class' => "btn btn-primary mt-2 btn-sm", 'name' => 'create-education']) !!}
                                                </div>
                                            {!! Form::close() !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
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


<!-- footer start -->
@include('inc.home.foot')
  

@include('inc.home.scripts')
<script>
    $(".date-picker").flatpickr();
</script>
</body>
</html>