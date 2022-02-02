@include('inc.home.head', ['title' => trans('main.Jobs')])
<div class="not">
<div class="bg-white-header"></div>

    <section class="section p-150 bread-crumbs search-jobs">
        <div class="container">
            <a href="{{ url('/') }}" class="text-muted">{{trans('main.Home')}}</a>  / <a href="{{ url('/search/jobs') }}" class="text-primary">{{trans('main.Jobs')}}</a>
        </div>
    </section>

    <section class="section search-jobs">
        <div class="container">
            {!! Form::open(['action'=>'SearchJobController@store', 'method'=>'POST'])!!}
            <div class="row align-items-center">
                <div class="col-lg-12">
                    <div class="show-results mt-4">
                        <div class="float-left">
                            <h5 class="text-dark mb-0 pt-2">{{trans('main.Showing')}} ( {{ count($jobs) }} {{trans('main.Jobs & Vacancies')}} )</h5>
                        </div>
                        <div class="sort-button float-right no-mobile">
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-3 pt-2">
                    <div class="left-sidebar">
                        
                        <div class="accordion" id="accordionExample">
                            <div class="card rounded mt-4">
                                <a data-toggle="collapse" href="#collapseOne" class="job-list collapsed" aria-expanded="false" aria-controls="collapseOne">
                                    <div class="card-header" id="headingOne">
                                        <h6 class="mb-0 text-dark f-18">{{trans('main.Date Posted')}}</h6>
                                    </div>
                                </a>
                                <div id="collapseOne" class="collapse show" aria-labelledby="headingOne">
                                    <div class="card-body p-0">
                                        @foreach(Helper::postedDate() as $key => $date)
                                            <div class="custom-control custom-radio">
                                                @if(!empty($selceted_period) && $selceted_period == $key)
                                                    <input type="radio" id="date-{{$key}}" name="updated_at" class="custom-control-input" value ="{{ $key }}" checked>
                                                @else
                                                    <input type="radio" id="date-{{$key}}"   v-model="updated_at"  v-on:change="searchjobs($event)" name="updated_at" class="custom-control-input" value ="{{ $key }}">
                                                @endif
                                                <label class="custom-control-label ml-1 text-muted" for="date-{{$key}}">{{$date}}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <!-- collapse one end -->
                            {{--<div class="card rounded mt-4">
                                <a data-toggle="collapse" href="#collapsetwo" class="job-list" aria-expanded="true" aria-controls="collapsetwo">
                                    <div class="card-header" id="headingtwo">
                                        <h6 class="mb-0 text-dark f-18">Countries</h6>
                                    </div>
                                </a>
                                <div id="collapsetwo" class="collapse show" aria-labelledby="headingtwo">
                                    <div class="card-body p-0">
                                        
                                        @if(count(Helper::Countries()) > 0)
                                            @foreach(Helper::Countries() as $key => $country)
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" id="country-{{ $key}}" name="country[]" class="custom-control-input" value ="{{ $country }}">
                                                    {{--@if(!empty($selceted_country) && in_array($key , $selceted_country))
                                                        <input type="checkbox" id="country-{{ $key}}" name="country[]" class="custom-control-input" value ="{{ $country }}" checked>
                                                    @else
                                                        <input type="checkbox" id="country-{{ $key}}" name="country[]" class="custom-control-input" value ="{{ $country }}">
                                                    @endif
                                                    <label class="custom-control-label ml-1 text-muted" for="country-{{ $key }}">{{ Helper::getCountryByKey($key) }}</label>
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>--}}
                            <!-- collapse one end -->
                            <div class="card rounded mt-4">
                                <a data-toggle="collapse" href="#collapsethree" class="job-list collapsed" aria-expanded="true" aria-controls="collapsethree">
                                    <div class="card-header" id="headingthree">
                                        <h6 class="mb-0 text-dark f-18">{{trans('main.Experience')}}</h6>
                                    </div>
                                </a>
                                <div id="collapsethree" class="collapse show" aria-labelledby="headingthree">
                                    <div class="card-body p-0">
                                        @if(count(Helper::experienceRange()) > 0)
                                            @foreach(Helper::experienceRange() as $key => $experience)
                                                <div class="custom-control custom-checkbox">
                                                    @if(!empty($selceted_experience) && in_array($key , $selceted_experience))
                                                        <input type="checkbox" id="experience-{{$experience}}" name="experience[]" class="custom-control-input" value ="{{ $key}}" checked>
                                                    @else
                                                        <input type="checkbox"  v-model="expJob"   v-on:change="searchjobs($event)" id="experience-{{$experience}}" name="experience[]" class="custom-control-input" value ="{{ $key}}">
                                                    @endif
                                                    <label class="custom-control-label ml-1 text-muted" for="experience-{{$experience}}">{{$experience}}</label>
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <!-- collapse one end -->
                            
                            <div class="card rounded mt-4">
                                <a data-toggle="collapse" href="#collapsefour" class="job-list collapsed" aria-expanded="true" aria-controls="collapsefour">
                                    <div class="card-header" id="headingfour">
                                        <h6 class="mb-0 text-dark f-18">{{trans('main.Gender')}}</h6>
                                    </div>
                                </a>
                                <div id="collapsefour" class="collapse show" aria-labelledby="headingfour">
                                    <div class="card-body p-0">
                                        @if(count(Helper::gender()) > 0)
                                            @foreach(Helper::gender() as $key => $gender)
                                                @if($key > 0)
                                                    <div class="custom-control custom-checkbox">
                                                        @if(!empty($selceted_gender) && in_array($key , $selceted_gender))
                                                            <input type="checkbox" id="gender-{{$gender}}" name="gender[]" class="custom-control-input" value ="{{ $key}}" checked>
                                                        @else   
                                                            <input type="checkbox" id="gender-{{$gender}}"  v-model="gender"  v-on:change="searchjobs($event)" name="gender[]" class="custom-control-input" value ="{{ $key}}">
                                                        @endif
                                                        <label class="custom-control-label ml-1 text-muted" for="gender-{{$gender}}">{{$gender}}</label>
                                                    </div>
                                                @endif
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <!-- collapse one end -->

                            <div class="card rounded mt-4">
                                <a data-toggle="collapse" href="#collapsefive" class="job-list collapsed" aria-expanded="true" aria-controls="collapsefive">
                                    <div class="card-header" id="headingfive">
                                        <h6 class="mb-0 text-dark f-18">{{trans('main.Required Salary')}}</h6>
                                    </div>
                                </a>
                                <div id="collapsefive" class="collapse show" aria-labelledby="headingfive">
                                    <div class="card-body p-0">
                                        @if(count(Helper::salaryRange()) > 0)
                                            @foreach(Helper::salaryRange() as $key => $salary)
                                                <div class="custom-control custom-checkbox">
                                                    @if(!empty($selceted_salary) && in_array($key , $selceted_salary))
                                                        <input type="checkbox" id="salary-{{$key}}" name="salary[]" class="custom-control-input" value="{{$key}}" checked>
                                                    @else
                                                        <input type="checkbox" id="salary-{{$key}}"  v-model="salary"  v-on:change="searchjobs($event)" name="salary[]" class="custom-control-input" value="{{$key}}">
                                                    @endif
                                                    <label class="custom-control-label ml-1 text-muted" for="salary-{{$key}}">{{$salary}}</label>
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <!-- collapse one end -->

                            <div class="card rounded mt-4">
                                <a data-toggle="collapse" href="#collapsesix" class="job-list collapsed" aria-expanded="true" aria-controls="collapsesix">
                                    <div class="card-header" id="headingsix">
                                        <h6 class="mb-0 text-dark f-18">{{trans('main.Job Type')}}</h6>
                                    </div>
                                </a>
                                <div id="collapsesix" class="collapse show" aria-labelledby="headingsix">
                                    <div class="card-body p-0">
                                        @if(count(Helper::job_type()) > 0)
                                            @foreach(Helper::job_type() as $key => $type)
                                                <div class="custom-control custom-checkbox">
                                                    {!! Form::open(['action'=>'SearchJobController@store', 'method'=>'POST'])!!}
                                                        @if(!empty($selected_type) && in_array($key , $selected_type))
                                                            <input type="checkbox" id="type-{{$key}}" name="type[]" class="custom-control-input" value ="{{ $key}}" checked>
                                                        @else
                                                            <input type="checkbox" id="type-{{$key}}"   v-model="type"  v-on:change="searchjobs($event)" name="type[]" class="custom-control-input" value ="{{ $key}}">
                                                        @endif
                                                    <label class="custom-control-label ml-1 text-muted" for="type-{{$key}}">{{$type}}</label>
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <!-- collapse one end -->
                        </div>
                        <div class="sort-button float-right no-large-screen">
                            {!! Form::submit(trans('main.Filter'), ['class' => "btn btn-primary btn-sm mt-3", 'name' => 'filter']) !!}
                        </div>
                            
                    </div>
                </div>
                {!! Form::close()!!}
                
                <div class="col-lg-9 jobs-grid">
                        @if (count($jobs) > 0)
                          @if(app()->getLocale() == 'ar')
                            <search-job-ar :role="{{auth()->user()->role}}" :complete="{{json_encode(Helper::completeProfile())}}" :id="{{auth()->user()->id}}" :jobs="jobs"></search-job-ar>
                               <nav class="filter pagination mb-5">
                                    <pagination :data="paginate_job" @pagination-change-page="searchjobs"></pagination>
                                </nav>
                            @else 
                                <search-job :role="{{auth()->user()->role}}" :complete="{{json_encode(Helper::completeProfile())}}" :id="{{auth()->user()->id}}" :jobs="jobs"></search-job>
                                <nav class="filter pagination mb-5">
                                    <pagination :data="paginate_job" @pagination-change-page="searchjobs"></pagination>
                                </nav>
                            @endif
                        @else
                            <span class="m-5 empty-to-show box w-100">{{trans('main.No Jobs To Show!')}}
                                @if(auth()->user()->role == 1 || auth()->user()->role == 2)
                                    <a href= "{{ url('post/job') }}">{{trans('main.Post Job')}}</a>
                                @endif
                            </span> 
                        @endif  
            
                </div>

                
                
            </div>

            <div class="row">
                <div class="col-lg-12 mt-4 pt-2">
                    <nav class="filter pagination">
                        {{ $jobs->links() }}
                        {{--  <ul class="pagination job-pagination mb-0 justify-content-center">
                            <li class="page-item disabled">
                                <a class="page-link" href="#" tabindex="-1" aria-disabled="true"></a>
                                    <i class="mdi mdi-chevron-double-left f-15"></i>
                                </a>
                            </li>
                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item"><a class="page-link" href="#">4</a></li>
                            <li class="page-item">
                                <a class="page-link" href="#">
                                    <i class="mdi mdi-chevron-double-right f-15"></i>
                                </a>
                            </li>
                        </ul> --}}
                    </nav>
                </div>
            </div>
        </div>
    </section>
@if(auth()->check())
    @if (auth()->user()->role == 0)
        @if(count(Helper::categoriesJobs(auth()->user()->category_id)) > 0)
            @foreach (Helper::categoriesJobs(auth()->user()->category_id) as $job)
            <!-- Un Apply Modal -->
            <div class="modal fade" id="unapply-{{ $job->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">{{trans('main.Unapply Job')}}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            {{trans('main.Are You Sure To Unapply This Job?')}}
                        </div>
                        <div class="modal-footer">
                            {!! Form::open(['action'=> ['ProfileController@update', auth()->user()->id], 'method'=>'POST', 'enctype' =>'multipart/form-data', 'class' => 'w-100'])!!}
                            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">{{trans('main.Close')}}</button>
                            {!! Form::submit(trans('main.Unapply'), ['class' => "text-danger btn btn-secondary btn-sm", 'name' => 'unapply-job']) !!}
                            {!! Form::text('job_id', $job->id, ['hidden'])!!}
                            {!! Form::hidden('_method', 'PUT') !!}
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
            <!-- Un Save Modal -->
                @if(count(auth()->user()->savedJobs) > 0)
                    @foreach(auth()->user()->savedJobs as $saved)
                        <!-- Delete Modal -->
                        <div class="modal fade" id="saved-{{ $job->id }}-delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">{{trans('main.Unsave Job')}}</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        {{trans('main.Are You Sure To Un Save This Job?')}}
                                    </div>
                                    <div class="modal-footer">
                                        {!! Form::open(['action'=> ['ProfileController@update', auth()->user()->id], 'method'=>'POST', 'enctype' =>'multipart/form-data', 'class' => 'w-100'])!!}
                                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">{{trans('main.Close')}}</button>
                                        {!! Form::submit(trans('main.Un Save'), ['class' => "text-danger btn btn-secondary btn-sm", 'name' => 'delete-saved-job']) !!}
                                        {!! Form::text('job_id', $saved->job_id, ['hidden'])!!}
                                        {!! Form::text('saved_id', $saved->id, ['hidden']) !!}
                                        {!! Form::hidden('_method', 'PUT') !!}
                                        {!! Form::close() !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            @endforeach
        @endif
    @endif
@endif
</div>
    @include('inc.home.foot')
    @include('inc.home.scripts')
    <script>
        @auth
        function favourite(id){
            $(id).on('submit', function(e) {
              e.preventDefault();
            if($(id).hasClass('dislike')){
                console.log($(this).serialize());
                  $.ajax({
                      type: "POST",
                      url: "{{url('/profiles/'.auth()->user()->id)}}",
                      data: $(this).serialize()+"&_method=PUT&delete-saved-job=''",
                      success: (response)=>{
                  
                          $(this).removeClass('dislike').addClass('like');
                          $('.toast').fadeIn().removeClass('hide').addClass('show');
                          $('.toast').find(".message").text('Deleted From Saved Jobs !');
                          $(this).find("i").removeClass('active');
                          setTimeout(function () {
                            $('.toast').fadeOut().removeClass('show').addClass('hide');
                        }, 5000);
                      }
                  });
              }else{
              $.ajax({
                  type: "POST",
                  url: "{{url('/profiles')}}",
                  data: $(this).serialize()+"&create-saved-job=''",
                  success: (response)=>{
                                      console.log($(this).serialize());

                    $(this).removeClass('like').addClass('dislike');
                      $('.toast').fadeIn().removeClass('hide').addClass('show');
                      $('.toast').find(".message").text('Add To Saved Jobs !');
                      $(this).find("i").addClass('active');
    
                      setTimeout(function () {
                        $('.toast').fadeOut().removeClass('show').addClass('hide');
                    }, 5000);
                  }
              });
            }
         });
        }
        
    @endauth
    </script>
</body>
</html>