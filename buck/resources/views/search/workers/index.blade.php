@include('inc.home.head', ['title' => trans('main.Candidates')])
<div class="not">
    
<div class="bg-white-header"></div>

<section class="section p-150 bread-crumbs candidate-search">
    <div class="container">
        <a href="{{ url('/') }}" class="text-muted">{{trans('main.Home')}}</a> / <a href="{{ url('search/workers') }}" class="text-primary">{{trans('main.Candidates')}}</a> 
    </div>
</section>
<section class="section candidate-search">

    <form action='#' class="candidate-form grand-form" id="candidate-form"@submit.prevent="submit">
    <div class="container">
  
          
       
        <div class="home-form-position">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="home-registration-form job-list-reg-form bg-light shadow p-4">
                        <div class="row">
                            
                            
                            <div class="col-lg-4 col-md-4 col-sm-6">
                                <div class="registration-form-box">
                                    <i class="fa fa-list-alt"></i>
                                   
                                    @if(!empty($selceted_category))
                                        @if(auth()->user()->role == 2 )
                                            {!! Form::select('category', Helper::companies_categories(), $selceted_category, ['id' => 'select-category', 'class' => '', 'placeholder' => trans('main.Category')]) !!}
                                            <input type="hidden" id="request_cat" value="{{$selceted_category}}">
                                        @elseif(auth()->user()->role == 1)
                                            {!! Form::select('category', Helper::personal_categories(), $selceted_category, ['id' => 'select-category', 'class' => '', 'placeholder' => trans('main.Category')])!!}
                                            <input type="hidden" id="request_cat" value="{{$selceted_category}}">
                                        @elseif(auth()->user()->role == 3)
                                            {!! Form::select('category', Helper::categoriesNames(), $selceted_category, ['id' => 'select-category', 'class' => '', 'placeholder' => trans('main.Category')])!!}
                                            <input type="hidden" id="request_cat" value="{{$selceted_category}}">
                                        @endif

                                    @else 
                                        @if(auth()->user()->role == 2)
                                            <select name="category" id="select-category" v-on:change="getexp($event)" v-model="category" placeholder="{{trans('main.Category')}}" style="cursor:pointer;background: transparent!important;display: block;width: 100%;text-align: left;padding: 5px 14px;color: #8492a6;overflow-x: hidden;outline: aliceblue;border-radius: 10px;text-align: right;border: 1px solid #d9dee2;" >
                                                
                                                
                                                <option value="0" selected>{{trans('main.Category')}}</option>
                                                @foreach(Helper::companies_categories() as $index=>$cat)
                                                    <option value="{{$index}}">
                                                        {{$cat}}
                                                    </option>
                                                @endforeach
                                            </select>
                                        <input type="hidden" name="category"  id="select">
                                        <input type="hidden" id="request_cat" value="{{$selceted_category}}">
                                        @elseif(auth()->user()->role == 1)
                                            {!! Form::select('category', Helper::personal_categories(), '', ['id' => 'select-category', 'class' => '', 'placeholder' => trans('main.Category')])!!}
                                            @elseif(auth()->user()->role == 3)
                                            {!! Form::select('category', Helper::categoriesNames(), '', ['id' => 'select-category', 'class' => '', 'placeholder' => trans('main.Category')])!!}
                                        @endif
                                    @endif
                                    
                                </div>
                            </div>
                            @if ($selceted_country)
                              <input type="hidden" id="request_country" value="{{json_encode($selceted_country)}}">
                            @endif

                            <div class="col-lg-4 col-md-4 col-sm-12">
                                <div class="registration-form-box">
                                    <!--<i class="fa fa-location-arrow"></i>-->
                                    @if ($selceted_country)
                                       <select class="form-control resume" id="countries" multiple="multiple" name="country[]" size="4" value="" placeholder="Country">
                                            @foreach (Helper::countries() as $key => $country)
                                                @if (in_array($key,$selceted_country))
                                                    <option value="{{$key}}" selected>{{$country}}</option>
                                                @else 
                                                    <option value="{{$key}}">{{$country}}</option>
                                                @endif
                                            @endforeach
                                        <input type="hidden" name="data" id="push">

                                    @else 
                                        <input type="hidden" name="data" id="push">
                                        <select class="form-control resume"    id="countries" multiple="multiple" name="country[]" size="4" placeholder="Country">

                                        @foreach (Helper::countries() as $key => $country)
                                            <option value="{{$key}}">{{$country}}</option>
                                        @endforeach
                                    </select>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-6">
                                <div class="registration-form-box">
                                <input type="submit" id="submit" name="send" class="submitBnt btn btn-primary btn-block" value="{{trans('main.Submit')}}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end home -->

</section>
    <!-- CANDIDATES LISTING START -->
    <section class="section pt-0  candidate-search">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12 pb-0">
                    <div class="show-results">
                        <div class="float-left">
                            
                        </div>
                        <div class="sort-button text-center float-sm-right ">
                            <ul class="list-unstyled mb-0">
                                <li class="list-inline-item mb-0 mr-3">
                                   
                                        <select name="sorting" class="sorting" v-on:change="getexp($event)" v-model="key" style="height: auto;outline: aliceblue;padding: 10px 32px;background: #fff;box-shadow: 3px 3px 7px #dddddd70;border: 1px solid #dddddd50;">
                                            @foreach(Helper::sorting() as $key=>$data)
                                                <option value="{{$key}}" {{$key == '0' ?'selected':''}}>
                                                    {{$data}}
                                                </option>
                                            @endforeach
                                        </select>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-4 col-md-4">
                    <div class="left-sidebar">
                        <div class="accordion" id="accordionExample">

                            <div class="card">
                                <a data-toggle="collapse" href="#collapsefour" class="job-list" aria-expanded="true" aria-controls="collapsefour">
                                    <div class="card-header" id="headingfour">
                                        <h6 class="mb-0 text-dark">{{trans('main.Experience')}}</h6>
                                    </div>
                                </a>
                                <div id="collapsefour" class="collapse show border-top" aria-labelledby="headingfour">
                                    <div class="card-body p-0">
                                        @if(count(Helper::experienceRange()) > 0)
                                            @foreach(Helper::experienceRange() as $key => $experience)
                                                <div class="custom-control custom-checkbox">
                                                    @if(!empty($selceted_experience) && in_array($key , $selceted_experience))
                                                        <input type="checkbox" id="experience-{{$experience}}" name="experience[]" class="custom-control-input" value ="{{ $key}}" checked>
                                                    @else
                                                        <input type="checkbox" id="experience-{{$experience}}" v-model="check"  v-on:change="getexp($event)" name="experience[]" class="custom-control-input" value ="{{ $key}}">
                                                    @endif
                                                    <label class="custom-control-label ml-1 text-muted" for="experience-{{$experience}}">{{$experience}}</label>
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <!-- collapse one end -->

                            <div class="card mt-4">
                                <a data-toggle="collapse" href="#collapsefive" class="job-list" aria-expanded="true" aria-controls="collapsefive">
                                    <div class="card-header" id="headingfive">
                                        <h6 class="mb-0 text-dark">{{trans('main.Gender')}}</h6>
                                    </div>
                                </a>
                                <div id="collapsefive" class="collapse show border-top" aria-labelledby="headingfive">
                                    <div class="card-body p-0">
                                        @if(count(Helper::gender()) > 0)
                                            @foreach(Helper::gender() as $key => $gender)
                                                @if($key > 0)
                                                    <div class="custom-control custom-checkbox">
                                                        @if(!empty($selceted_gender) && in_array($key , $selceted_gender))
                                                            <input type="checkbox" id="gender-{{$gender}}" name="gender[]" class="custom-control-input" value ="{{ $key}}" checked>
                                                        @else   
                                                            <input type="checkbox" id="gender-{{$gender}}" v-model="gender"  v-on:change="getexp($event)" name="gender[]" class="custom-control-input" value ="{{ $key}}">
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

                            <div class="card mt-4">
                                <a data-toggle="collapse" href="#collapsesix" class="job-list collapsed" aria-expanded="false" aria-controls="collapsesix">
                                    <div class="card-header" id="headingsix">
                                        <h6 class="mb-0 text-dark">{{trans('main.Offerd Salary')}}</h6>
                                    </div>
                                </a>
                                <div id="collapsesix" class="collapse border-top" aria-labelledby="headingsix">
                                    <div class="card-body p-0">
                                        @if(count(Helper::salaryRange()) > 0)
                                            @foreach(Helper::salaryRange() as $key => $salary)
                                                <div class="custom-control custom-checkbox">
                                                    @if(!empty($selceted_salary) && in_array($key , $selceted_salary))
                                                        <input type="checkbox" id="salary-{{$key}}" name="salary[]" class="custom-control-input" value="{{$key}}" checked>
                                                    @else
                                                        <input type="checkbox" id="salary-{{$key}}" v-model="salary"  v-on:change="getexp($event)" name="salary[]" class="custom-control-input" value="{{$key}}">
                                                    @endif
                                                    <label class="custom-control-label ml-1 text-muted" for="salary-{{$key}}">{{$salary}}</label>
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <!-- collapse one end -->

                            <div class="card mt-4">
                                <a data-toggle="collapse" href="#collapsesevan" class="job-list collapsed" aria-expanded="false" aria-controls="collapsesevan">
                                    <div class="card-header border-bottom-0" id="headingsevan">
                                        <h6 class="mb-0 text-dark">{{trans('main.Qualification')}}</h6>
                                    </div>
                                </a>
                                <div id="collapsesevan" class="collapse border-top" aria-labelledby="headingsevan">
                                    <div class="card-body p-0">
                                        @if(count(Helper::educationalLevel()) > 0)
                                            @foreach(Helper::educationalLevel() as $key => $education)
                                                <div class="custom-control custom-checkbox">
                                                @if(!empty($selceted_education) && in_array($key , $selceted_education))
                                                    <input type="checkbox" id="education-{{$education}}" name="education[]" class="custom-control-input" value="{{ $key}}" checked>
                                                @else   
                                                    <input type="checkbox" id="education-{{$education}}" v-model="education"  v-on:change="getexp($event)" name="education[]" class="custom-control-input" value="{{ $key}}">
                                                @endif
                                                    <label class="custom-control-label ml-1 text-muted" for="education-{{$education}}">{{$education}}</label>
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {!! Form::close()!!}
                
                <!--working area-->
                <div class="col-lg-8 col-md-8 ">
                        <div class="candidates-listing-item append">
                            @if(app()->getLocale() == 'ar')
                                <search-worker-ar :workers="workers" :unlock="{{$unlock}}" :user_id="{{auth()->user()->id}}"  :role="{{auth()->user()->role}}"></search-worker-ar>
                                    <nav class="filter pagination mb-5" v-if="workers != null && workers != '' " >
                                        <pagination :data="paginate" @pagination-change-page="getexp"></pagination>
                                    </nav>
                            @else
                                <search-worker :workers="workers" :unlock="{{$unlock}}" :user_id="{{auth()->user()->id}}"  :role="{{auth()->user()->role}}"></search-worker>
                                    
                                    <nav class="filter pagination mb-5" v-if="workers != null && workers != '' " >
                                        <pagination :data="paginate" :limit="5" @pagination-change-page="getexp"></pagination>
                                    </nav>
                            @endif
                         
                        </div>
                </div
                
                <!--end working area-->
                
            </div>
            @if(count($workers) > 15)
            <div class="row">
                <div class="col-lg-12 mt-4 pt-2">
                    <nav class="filter pagination mb-5">
                        {{-- {{ $workers->links() }} --}}
                        {{-- <pagination :data="workers" @pagination-change-page="getexp"></pagination> --}}
                    </nav>
                </div>
            </div>
            @endif
        </div>
    </section>
</div>
    <!-- CANDIDATES LISTING END -->
    @include('inc.home.foot')
    @include('inc.home.scripts')
    <script>
        $(document).ready(function(){
            
            
            $(".custom-control-label").on('click', function() {
            });
         
            $('#select-category .selectize-input input').attr('autofocus')
           
            var map = [];
            if($('#request_country').length && $('#request_country').val() !== null&& $('#request_country').val() !== ''){
                        data = JSON.parse($('#request_country').val());
                        $('#push').val(data);
                }
            $('.checkbox').on('change',function(){
                console.log($(this).find('input').val());
                if($('#request_country').length && $('#request_country').val() !== null&& $('#request_country').val() !== ''){
                        map = JSON.parse($('#request_country').val());
                        $('#request_country').val('');                        
                    }
                if(map.includes($(this).find('input').val())){
                    var index = map.indexOf($(this).find('input').val());
                    map.splice(index, 1);
                }else{
                    map.push($(this).find('input').val());

                }
                $('#push').val(map);
              console.log(map);
              console.log(map);
              console.log(map);
              console.log(map);
            });
            var cat =[];
             $('.selectized').on('change',function(){
                if(cat.includes($(this).find('option').val())){
                    var index = cat.indexOf($(this).find('option').val());
                    cat.splice(index, 1);
                }else{
                    cat = $(this).find('option').val();
                }
                $('#select').val(cat);
              console.log(cat);
            });
        });
         @auth
        function favourite(id){
            $(id).on('submit', function(e) {
              e.preventDefault();
            if($(id).hasClass('dislike')){
                  $.ajax({
                      type: "POST",
                      url: "{{url('/profiles/'.auth()->user()->id)}}",
                      data: $(this).serialize()+"&_method=PUT&delete-fav=''",
                      success: (response)=>{
                          $(this).removeClass('dislike').addClass('like');
                          $('.toast').fadeIn().removeClass('hide').addClass('show');
                          $('.toast').find(".message").text('Worker deleted from favourite !');
                          $(this).find("i").removeClass('fav-saved');
                          setTimeout(function () {
                            $('.toast').fadeOut().removeClass('show').addClass('hide');
                        }, 5000);
                      }
                  });
              }else{
              $.ajax({
                  type: "POST",
                  url: "{{url('/profiles')}}",
                  data: $(this).serialize()+"&create-fav=''",
                  success: (response)=>{
                    $(this).removeClass('like').addClass('dislike');
                      $('.toast').fadeIn().removeClass('hide').addClass('show');
                      $('.toast').find(".message").text('Worker added to favourite !');
                      $(this).find("i").addClass('fav-saved');
    
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