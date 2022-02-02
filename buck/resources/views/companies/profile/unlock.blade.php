@include('inc.home.head', ['title' => trans('main.Unlock List')])
    <section class="section p-150 bread-crumbs">
        <div class="container">
            <a href="{{ url('/') }}" class="text-muted">{{trans('main.Home')}}</a> / <a href="{{ url('unlock') }}" class="text-primary">{{trans('main.Unlock List')}}</a>
        </div>
    </section>
    <div class="worker-profile ">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-12  my-4">
                    <div class="left-sidebar ">
                        <ul class="nav nav-pills nav nav-pills bg-white rounded" id="pills-tab" role="tablist">
                            <li class="nav-item d-block col-12">
                            <a class="nav-link" id="general-tab"  href="{{ url('profiles/'.$user->id.'/edit') }}">{{trans('main.General Information')}}</a>
                            </li>
                            @if (auth()->user()->role == 2)
                                <li class="nav-item d-block col-12">
                                    <a class="nav-link" id="branch-tab"  href="{{ url('profiles/'.$user->id.'/edit/branch') }}">{{trans('main.Branches')}}</a>
                                </li>
                            @endif
                            <li class="nav-item d-block col-12">
                                <a class="nav-link" id="package-tab" href="{{ url('myPackage') }}">{{trans('main.Subscribed Package')}}</a>
                            </li>
                            <li class="nav-item d-block col-12">
                                <a class="nav-link active" id="unblock-tab"  href="{{ url('unlock') }}" >{{trans('main.Unblock List')}}({{ count(Helper::unblockList(auth()->user()->id)) }})</a>
                            </li>
                            <li class="nav-item d-block col-12">
                                <a class="nav-link" id="unblock-tab"  href="{{ url('favorite') }}" >{{trans('main.Saved List')}}(<span class="count">{{ count(Helper::favList(auth()->user()->id)) }}</span>)</a>
                            </li>
                            <li class="nav-item d-block col-12 ">
                                <a class="nav-link"  href="{{ url('chat') }}">{{trans('main.Chat')}}</a>
                            </li>
                        </ul>
                    </div>
                </div>
        
                <div class="col-lg-9 col-md-12 profile-edit no-shadow">
                    <div class="tab-content mt-2 mb-4">
                        <div class="tab-pane fade show active general">
                            <div class="row">
                                @if (count($workers) > 0)
                                @foreach ($workers as $worker)
                                {{--@if (!empty($worker->category_id) )--}}
                                
                                    <div class="col-12 mt-4 p-3 card-view  experience-view candidates-listing-item">
                                        <div class="dropdown position-absolute options-dropdown">
                                            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="far fa-ellipsis-v"></i>
                                            </a>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                              <a class="dropdown-item text-muted" data-toggle="modal" data-target="#unlock-{{ $worker->id }}-delete">{{trans('main.Delete')}}</a>
                                            </div>
                                        </div>
                                        <div class="row position-relative">
                                            @if (Helper::unlockCheck($worker->id))
                                                @foreach ($unlock as $req)
                                                    @if ($worker->id == $req->worker_id)
                                                        <span class="unlocked-badge">{{trans('main.Unlocked')}}</span>
                                                    @endif
                                                @endforeach
                                            @endif
                                            <div class="col-md-9">
                                                <a href="{{ url('profiles/'.$worker->id) }}">
                                                    <div class="float-left mr-4 img-cont">
                                                        @if (!empty($worker->profile_image))
                                                            <img src="{{ asset('uploads/images/profile_images/'.$worker->profile_image) }}" alt="" class="d-block rounded" height="90" width="92">
                                                        @else 
                                                            <img src="{{ asset('uploads/images/profile_images/default.jpg') }}" alt="" class="d-block rounded" height="90" width="92">
                                                        @endif
                                                    </div>
                                                    <div class="candidates-list-desc overflow-hidden job-single-meta  pt-2">
                                                        @if (Helper::unlockCheck($worker->id))
                                                            <h5 class="mb-2 name text-dark">{{ucwords($worker->name) }}</h5>
                                                        @else
                                                            <h5 class="mb-2 name text-dark">{{ ucwords(Helper::hashString($worker->name)) }}</h5>
                                                        @endif
                                                        <ul class="list-unstyled">
                                                            @if (!empty(Helper::categotyByID($worker->category_id)))
                                                                <li class="text-muted"><i class="mdi mdi-account mr-1"></i>
                                                                {{Helper::categotyByID($worker->category_id)->name}}
                                                            @endif 
                                                            @if (!empty($worker->city) || !empty($worker->country))
                                                                <li class="text-muted"><i class="mdi mdi-map-marker mr-1"></i>
                                                                    @if(!empty($worker->city))
                                                                            {{ Helper::getCityByID($worker->city)}} ,  
                                                                    @endif
                                                                    @if(!empty($worker->country))
                                                                            {{ Helper::getCountryByKey($worker->country)}}
                                                                    @endif
                                                                </li>    
                                                            @endif  
                                                            @foreach(Helper::salaryRange() as $key => $salary)
                                                                @if (!empty($worker->average_salary))
                                                                    @if ($worker->average_salary == $key)
                                                                        <li class="text-muted"><i class="mdi mdi-currency-usd mr-1"></i>{{ $salary }}/month</li>
                                                                    @endif
                                                                @endif
                                                            @endforeach
                                                            @foreach (Helper::experience() as $key => $experience)
                                                                @if ($worker->experience == $key)
                                                                    <li class="text-muted"><i class="far fa-briefcase mr-1"></i>{{ $experience }}</li>
                                                                @endif
                                                            @endforeach
                                                            @if ($worker->about)
                                                                <li class="text-muted about">{{ $worker->about }}</li>
                                                            @endif
                                                        </ul>
                                                        @if (count($worker->skills) > 0)
                                                            <span class="text-muted">Skills:</span>
                                                                @foreach ($worker->skills as $skill)
                                                                    @foreach (Helper::getSkills($skill->name) as $s)
                                                                    <span class="skill">{{ $s }}</span>
                                                                    @endforeach
                                                                @endforeach
                                                        @endif
                                                        
                                                    </div>
                                                </a>
                                            </div>
        
                                            <div class="col-md-3">
                                                <div class="candidates-list-fav-btn text-right">
                                                    <div class="fav-icon">
                                                        @if (Helper::favCheck($worker->id))
                                                           <form action="#" id="favourite{{$worker->id}}" class="dislike" >
                                                           {!! Form::text('worker_id', $worker->id, ['hidden'])!!}
                                                         
                                                            @csrf
                                                            <button class="non-button saved-btn" onclick="favourite('#favourite{{$worker->id}}')"><i class="fas fa-star fav-saved fav-{{ $worker->id }}-delete"></i></button>
                                                            </form>
                                                        @else
                                                            <form action="#"   id="favourite{{$worker->id}}" class="like" >
                                                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                                                                <input type="hidden" name="worker_id" value="{{$worker->id}}">   
                                                                 
                                                                <button name="create-fav" class="non-button feo" onclick="favourite('#favourite{{$worker->id}}')" ><i class="fas fa-star"></i></button>
                                                            </form>
                                                        @endif
                                                    </div>
                                                
                                                    @if(auth()->user()->role == 2 || auth()->user()->role == 1)
                                                        <div class="candidates-listing-btn mt-1">
                                                            @if (Helper::unlockCheck($worker->id))
                                                            <a href="{{url('profiles/'.$worker->id)}}" class="btn btn-sm text-green btn-card-option">{{trans('main.View')}}</a>
                                                            @else 
                                                            <a href="{{url('profiles/'.$worker->id)}}" class="btn btn-sm mb-1 text-green btn-card-option with-unlock">{{trans('main.View')}}</a>
                                                                {!! Form::open(['action'=> 'ProfileController@store', 'method'=>'POST', 'enctype' =>'multipart/form-data', 'class' => 'w-100'])!!}
                                                                {!! Form::submit(trans('main.Unlock'), ['class' => "btn text-red btn-sm btn-card-option", 'name' => 'create-unlock']) !!}
                                                                {!! Form::text('worker_id', $worker->id, ['hidden'])!!}
                                                                {!! Form::close() !!}
                                                            @endif
                                                        </div>
                                                    @endif
                                                    <!-- Button trigger modal -->
                                                    <div class="modal fade" id="fav-{{ $worker->id }}-delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">{{trans('main.Delete Worker')}}</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            {!! Form::open(['action'=> ['ProfileController@update', auth()->user()->id], 'method'=>'POST', 'enctype' =>'multipart/form-data', 'class' => 'w-100'])!!}
                                                                <div class="modal-body">
                                                                    {{trans('main.Are You Sure to Delete worker From Favorite List?')}}
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{trans('main.Close')}}</button>
                                                                    {!! Form::submit(trans('main.Delete'), ['class' => "btn btn-primary", 'name' => 'delete-fav']) !!}
                                                                    {!! Form::text('worker_id', $worker->id, ['hidden'])!!}
                                                                </div>
                                                            {!! Form::hidden('_method', 'PUT') !!}
                                                            {!! Form::close() !!}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <!-- Delete Modal -->
                                    <div class="modal fade" id="unlock-{{ $worker->id }}-delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">{{trans('main.Delete Worker')}}</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            {!! Form::open(['action'=> ['ProfileController@update', $user->id], 'method'=>'POST', 'enctype' =>'multipart/form-data', 'class' => 'w-100'])!!}
                                                <div class="modal-body">
                                                    {{trans('main.Are You Sure About Deleting')}} {{ $worker->name }} {{trans('main.From Your List?')}}
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">{{trans('main.Close')}}</button>
                                                    {!! Form::submit(trans('main.Delete'), ['class' => "btn btn-primary btn-sm", 'name' => 'delete-unlock']) !!}
                                                </div>
                                            {!! Form::text('worker_id', $worker->id, ['hidden']) !!}
                                            {!! Form::hidden('_method', 'PUT') !!}
                                            {!! Form::close() !!}
                                            </div>
                                        </div>
                                    </div>
        
                                    </div>
                                {{--@endif--}}
                            @endforeach
                                @else
                                        
                                        <h6 class="my-5 text-center w-100 ">{{trans('main.Unblock Some')}}<a href= "{{ url('search/workers') }}"> {{trans('main.Candidate Profiles!')}}</a></h6>
                                @endif
                            </div>
                            <div class="row">
                                <div class="col-lg-12 mt-4 pt-2">
                                    <nav class="filter pagination">
                                        {{ $workers->links() }}
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>   
        </div>
    </div>

    <!-- POST A JOB START -->
    
    <!-- POST A JOB END -->
<script>
    // Date Picker 
    $("#date-picker").flatpickr();
</script>

@include('inc.home.foot')
@include('inc.home.scripts')
@if(app()->getLocale() == "ar") 
<script>
    function favourite(id){
        if($(id).hasClass('dislike')){
              $('.count').html(parseInt($('.count').html()) - 1);
        }else{
            
            $('.count').html(parseInt($('.count').html()) + 1);
        }
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
                      $('.toast').find(".message").text('تم حذف الحرفي من المفضلة');
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
                  $('.toast').find(".message").text('تم إضافة الحرفي إلى المفضلة');
                  $(this).find("i").addClass('fav-saved');
                  setTimeout(function () {
                    $('.toast').fadeOut().removeClass('show').addClass('hide');
                }, 5000);
              }
          });
        }
     });
    }  
   </script> 
    @else 
    <script>
    function favourite(id){
        if($(id).hasClass('dislike')){
              $('.count').html(parseInt($('.count').html()) - 1);
        }else{
            
            $('.count').html(parseInt($('.count').html()) + 1);
        }
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
     })
     </script>
     @endif
</body>
</html>