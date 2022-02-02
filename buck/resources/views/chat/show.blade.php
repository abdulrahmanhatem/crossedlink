@include('inc.home.head', ['title' => trans('main.Chat')])
<section class="section p-150 bread-crumbs chat-page">
    <div class="container">
        <a href="{{ url('/') }}" class="text-muted">{{trans('main.Home')}}</a> / <a href="{{ url('chat') }}" class="text-primary">{{trans('main.Chat')}}</a>
    </div>
</section>
    <div class="worker-profile pt-4 chat-page chat-page-show">
        <div class="container">
            <div class="row chat-whole">
                <div class="col-lg-3 col-md-3 user-list">
                    <div class="left-sidebar ">
                        <ul class="nav nav-pills nav nav-pills bg-white rounded mb-3" id="pills-tab" role="tablist">
                            @if (count(Helper::chatList()) > 0)
                                @foreach(Helper::chatList() as $user)
                                    <li class="nav-item d-block col-12">
                                        @if ($user->id == $other->id)
                                            <a class="nav-link active" href="{{ url('chat/'. $user->id) }}"> 
                                        @else 
                                            <a class="nav-link" href="{{ url('chat/'. $user->id) }}"> 
                                        @endif

                                        {{ucwords($user->name)}}

                                        @foreach (Helper::chatbyUser($user->id) as $msg)
                                            @if ($loop->last)
                                                @if(!empty($msg->text))
                                                    <span>{{$msg->text}}</span>
                                                @endif
                                                @if(!empty($msg->file))
                                                    <span>{{trans('main.Attached File')}}</span>
                                                @endif
                                            @endif
                                        @endforeach
                                        </a>
                                    </li>
                                @endforeach
                            @else 
                                <li class="nav-item d-block col-12">
                                    <a class="nav-link active" href="{{ url('chat/'. $other->id) }}"> 
                                    {{ucwords($other->name)}}
                                    </a>
                                </li>
                            @endif
                          
                        </ul>
                    </div>
                </div>
        
                <div class="col-lg-9 col-md-9 chat-container">
                    
                    <div class="row">
                        <div class="col-lg-7 col-md-12 px-0 chat-middle-container">
                            @if (count(Helper::chatbyUser($other->id)) > 0)
                                <div class="row other-name">
                                    <a href="{{url('profiles/' . $other->id)}}">
                                        @if(!empty($other->company_name))
                                            {{ucwords($other->company_name)}}
                                        @else
                                            {{ucwords($other->name)}}
                                        @endif
                                    </a>
                                </div>
                            @endif
                            <div class="chat-middle" id="chat-middle">
                                @if (count(Helper::chatbyUser($other->id)) > 0)
                                    @foreach (Helper::chatbyUser($other->id) as $msg)
                                        <div class="chat-inbox">
                                            @if($msg->sender_id == auth()->user()->id)
                                                <div class="my-msg">
                                                    @if(auth()->user()->role == 2 || auth()->user()->role == 1)
                                                        @if(!empty(auth()->user()->profile_image))
                                                            <img src="{{ asset('uploads/images/profile_images/'.auth()->user()->profile_image ) }}" alt="" class="d-block mx-auto shadow rounded-pill mb-4 worker-avatar">
                                                        @else 
                                                            <img src="{{ asset('uploads/images/profile_images/default_company.jpg') }}" alt="" class="d-block mx-auto shadow rounded-pill mb-4 worker-avatar">
                                                        @endif
                                                    @else 
                                                        @if(!empty(auth()->user()->profile_image))
                                                            <img src="{{ asset('uploads/images/profile_images/'.auth()->user()->profile_image ) }}" alt="" class="d-block mx-auto shadow rounded-pill mb-4 worker-avatar">
                                                        @else 
                                                            <img src="{{ asset('uploads/images/profile_images/default.jpg') }}" alt="" class="d-block mx-auto shadow rounded-pill mb-4 worker-avatar">
                                                        @endif
                                                    @endif
                                                    
                                                    <span>
                                                        {{$msg->text}}
                                                        @if (!empty($msg->file))
                                                            <a class="" target="_blank" title="File" href= "{{url(asset('uploads/pdf/chat_pdf/'.$msg->file))}}"> <i class="fal fa-paperclip"></i>{{trans('main.Attached File')}}
                                                            </a>  
                                                        @endif
                                                        <small class="time">
                                                            {{Helper::since($msg->created_at)}}
                                                        </small>
                                                    </span>

                                                </div>
                                            @endif

                                            @if($msg->reciever_id == auth()->user()->id)
                                                
                                                <div class="another-msg">
                                                   
                                                    @if($other->role == 2 || $other->role == 1)
                                                        @if(!empty($other->profile_image))
                                                            <img src="{{ asset('uploads/images/profile_images/'.$other->profile_image ) }}" alt="" class="d-block mx-auto shadow rounded-pill mb-4 worker-avatar">
                                                        @else 
                                                            <img src="{{ asset('uploads/images/profile_images/default_company.jpg') }}" alt="" class="d-block mx-auto shadow rounded-pill mb-4 worker-avatar">
                                                        @endif
                                                    @else 
                                                        @if(!empty($other->profile_image))
                                                            <img src="{{ asset('uploads/images/profile_images/'.$other->profile_image ) }}" alt="" class="d-block mx-auto shadow rounded-pill mb-4 worker-avatar">
                                                        @else 
                                                            <img src="{{ asset('uploads/images/profile_images/default.jpg') }}" alt="" class="d-block mx-auto shadow rounded-pill mb-4 worker-avatar">
                                                        @endif
                                                    @endif
                                                    <span>
                                                        {{$msg->text}}
                                                        @if (!empty($msg->file))
                                                            <a class="" target="_blank" title="File" href= "{{url(asset('uploads/pdf/chat_pdf/'.$msg->file))}}"> <i class="fal fa-paperclip"></i>{{trans('main.Attached File')}}
                                                            </a>  
                                                        @endif
                                                        <small class="time">
                                                            {{Helper::since($msg->created_at)}}
                                                        </small>
                                                    </span>
                                                    
                                                </div>
                                            @endif
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                            <div class="row chat-form">
                                <div class="col-sm-12">
                                    {!! Form::open(['action'=> 'ChatController@store', 'method'=>'POST', 'enctype' =>'multipart/form-data', 'class' => 'w-100'])!!}
                                    
                                    <div class="row">
                                        <div class="col-md-12 chat-box">
                                            <div class="row mt-1 create-field">
                                                <div class="form-group col-md-12 col-sm-12 m-0">
                                                    {!! Form::text('text', '',  ['class' => "form-control r-0 light s-12 messege", 'placeholder' => trans('main.Messege'), 'id' => 'text'])!!}
                                                    <label  class="chat-attach" for="file">
                                                        <i class="fal fa-paperclip"></i>
                                                    </label>
                                                    {!! Form::file('file', [ 'hidden', 'id' => 'file'])!!}
                                                </div>
                                                <div class="chat-submit">
                                                    {!! Form::text('sender_id', auth()->user()->id, ['hidden']) !!}
                                                    {!! Form::text('reciever_id', $other->id, ['hidden']) !!}
                                                    {!! Form::button('<i class="mdi mdi-send text-primary"></i>', ['class' => "text-primary", 'name' => 'create-chat', 'type' =>'submit'], false) !!}
                                                    
                                                </div>
                                            </div>
                                            
                                        </div>
                                    </div>
                                    {!! Form::close() !!}
                                </div>
                            </div>
                            
                        </div>
                        <div class="col-lg-5 col-md-0  px-0 chat-profile">
                            <a href="{{url('profiles/' . $other->id)}}">
                            <div class="row">
                                    @if($other->role == 2 || $other->role == 1 )
                                        @if(!empty($other->profile_image))
                                            <img src="{{ asset('uploads/images/profile_images/'.$other->profile_image ) }}" alt="" class="d-block mx-auto shadow rounded-pill mb-4 worker-avatar">
                                        @else 
                                            <img src="{{ asset('uploads/images/profile_images/default_company.jpg') }}" alt="" class="d-block mx-auto shadow rounded-pill mb-4 worker-avatar">
                                        @endif

                                        <a href="{{url('profiles/' . $other->id)}}">
                                            @if(!empty($other->company_name))
                                                <h3>{{ucwords($other->company_name)}}</h3>
                                            @else
                                                <h3>{{ucwords($other->name)}}</h3>
                                            @endif
                                        </a>

                                       

                                        @if(!empty($other->website))
                                            <p>{{ucwords($other->website)}}</p>
                                        @endif
                                        @if (!empty($other->country))
                                        <span>
                                            <i class="fal fa-globe mr-1"></i>
                                            {{ Helper::getCountryBykey($other->country) }}
                                        </span>
                                        @endif
                                        @if (!empty($other->address))
                                            <div>
                                                <span>
                                                    <i class="fal fa-map-marker-alt mr-1"></i>
                                                    {{ $other->address }}
                                                </span>
                                            </div>
                                        @endif
                                    @endif
                                    @if($other->role == 0)
                                        @if(!empty($other->profile_image))
                                        <img src="{{ asset('uploads/images/profile_images/'.$other->profile_image ) }}" alt="" class="d-block mx-auto shadow rounded-pill mb-4 worker-avatar">
                                        @else 
                                            <img src="{{ asset('uploads/images/profile_images/default.jpg') }}" alt="" class="d-block mx-auto shadow rounded-pill mb-4 worker-avatar">
                                        @endif

                                        
                                       
                                        
                                                <h3>{{ucwords($other->name)}}</h3>
                                        

                                        @if (!empty($other->category_id))
                                            @foreach(Helper::userCats($other->category_id) as $key => $value)
                                                @if($loop->index < 4)
                                                    <span class="category">
                                                        {{ Helper::getCategoryName($value) }}
                                                    </span>
                                                @endif
                                            @endforeach
                                        @endif

                                        <div class="country text-center">
                                            @if (!empty($other->city))
                                                <span>
                                                    {{ Helper::getCityByID($other->city) }}
                                                </span>
                                            @endif
                                            @if (!empty($other->country))
                                                <span>
                                                    {{ Helper::getCountryByKey($other->country) }}
                                                </span>
                                            @endif
                                        </div>



                                        <div class="email">
                                            <i class="fal fa-envelope mr-1"></i>
                                            <span>
                                                
                                                {{ $other->email }}
                                            </span>
                                        </div>
                                        <div class="phone">
                                            
                                            @if (!empty($other->phone))
                                                <i class="fal fa-phone-alt"></i>
                                                <span>
                                                    {{ $other->phone }}
                                                </span>
                                            @endif
                                        </div>
                                        
                                        @if (count(Helper::galleryByUser($other->id)) > 0)
                                            <div class="gallery pt-2">
                                                @foreach(Helper::galleryByUser($other->id ) as $image)
                                                    <div class="image-box">
                                                        <img src="{{ asset('uploads/images/gallery_images/'.$image->gallery_image) }}" alt="" class="img-fluid gallery_image" id ="preview_image" data-toggle="modal" data-target="#gallery-{{$image->id}}">
                                                            @if (auth()->user()->id == $other->id)
                                                                <span class="delete-image" aria-hidden="true" data-toggle="modal" data-target="#gallery-{{ $image->id }}-delete">&times;</span>
                                                            @endif
                                                        </div>
                                                    <!-- View Modal -->
                                                    <div class="modal modal-view fade" id="gallery-{{$image->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-body">
                                                                <img src="{{ asset('uploads/images/gallery_images/'.$image->gallery_image) }}" alt="" class="img-fluid" id ="preview_image" data-toggle="modal" data-target="#gallery-{{$image->id}}">
                                                            </div>
                                                        </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                                <div class="clearfix"></div>
                                            </div>
                                        @endif
                                    @endif
                            </div>
                        </a>
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
        window.onload=function () {
            var objDiv = document.getElementById("chat-middle");
            objDiv.scrollTop = objDiv.scrollHeight;
        }
</script>
</body>
</html>