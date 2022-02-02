@include('inc.home.head', ['title' => trans('main.Chat')])
<section class="section p-150 bread-crumbs chat-page">
    <div class="container">
        <a href="{{ url('/') }}" class="text-muted">{{trans('main.Home')}}</a> / <a href="{{ url('chat') }}" class="text-primary">{{trans('main.Chat')}}</a>
    </div>
</section>
    <div class="worker-profile pt-4 chat-page">
        <div class="container">
            @if (count($chats) > 0)
                @foreach ($chats as $chat)
               
                    @if ($loop->index < 1)
                        <div class="row chat-whole">
                            <div class="col-lg-3 col-md-3 user-list">
                                <div class="left-sidebar ">
                                    <ul class="nav nav-pills nav nav-pills bg-white rounded mb-3" id="pills-tab" role="tablist">
                                        @if(count(Helper::chatList()) > 0)
                                            @foreach(Helper::chatList() as $user)
                                                <li class="nav-item d-block col-12">
                                                    @if ($loop->index < 1)
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
                                        @endif
                                    </ul>
                                </div>
                            </div>
                            
                            <div class="col-lg-9 col-md-9 chat-container">
                                
                                <div class="row">
                                    <div class="col-lg-7 col-md-12 px-0 chat-middle-container">
                                        
                                        @if (Helper::chatUserbyChat($chat->id))
                                            <div class="row other-name">
                                                @if(count(Helper::userByID(Helper::chatUserbyChat($chat->id))) > 0)
                                                    @foreach(Helper::userByID(Helper::chatUserbyChat($chat->id)) as $user)
                                                            @if(!empty($user->company_name))
                                                                {{ucwords($user->company_name)}}
                                                            @else
                                                                {{ucwords($user->name)}}
                                                            @endif
                                                    @endforeach
                                                @else
                                                    <div class="row other-name">
                                                           Crossedlink User
                                                    </div>
                                                @endif
                                            </div>
                                        @else 
                                         
                                        @endif
                                        <div class="chat-middle" id="chat-middle">
                                            @if (Helper::chatUserbyChat($chat->id))
                                                <div class="chat-inbox">
                                                    
                                                    @foreach (Helper::chatbyUser(Helper::chatUserbyChat($chat->id)) as $msg)
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
                                                                        {{Helper::since($msg->created_at) }}
                                                                        
                                                                    </small>
                                                                </span>
                                                            </div>
                                                        @endif

                                                        @if($msg->reciever_id == auth()->user()->id)
                                                            
                                                            <div class="another-msg">
                                                                @foreach(Helper::userByID(Helper::chatUserbyChat($chat->id)) as $user)
                                                                    @if($user->role == 2 || $user->role == 1)
                                                                        @if(!empty($user->profile_image))
                                                                            <img src="{{ asset('uploads/images/profile_images/'.$user->profile_image ) }}" alt="" class="d-block mx-auto shadow rounded-pill mb-4 worker-avatar">
                                                                        @else 
                                                                            <img src="{{ asset('uploads/images/profile_images/default_company.jpg') }}" alt="" class="d-block mx-auto shadow rounded-pill mb-4 worker-avatar">
                                                                        @endif
                                                                    @else 
                                                                        @if(!empty($user->profile_image))
                                                                            <img src="{{ asset('uploads/images/profile_images/'.$user->profile_image ) }}" alt="" class="d-block mx-auto shadow rounded-pill mb-4 worker-avatar">
                                                                        @else 
                                                                            <img src="{{ asset('uploads/images/profile_images/default.jpg') }}" alt="" class="d-block mx-auto shadow rounded-pill mb-4 worker-avatar">
                                                                        @endif
                                                                    @endif
                                                                @endforeach
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
                                                        
                                                        
                                                    @endforeach
                                                </div>
                                                
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
                                                                {!! Form::text('reciever_id', Helper::chatUserbyChat($chat->id), ['hidden']) !!}
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
                                        @if(count(Helper::userByID(Helper::chatUserbyChat($chat->id))) > 0)
                                            @if (Helper::chatUserbyChat($chat->id))
                                                
                                                    <div class="row">
                                                        @foreach(Helper::userByID(Helper::chatUserbyChat($chat->id)) as $user)
                                                        <a href="{{url('profiles/' . $user->id)}}">
                                                            @if($user->role == 2 || $user->role == 1 )
                                                                @if(!empty($user->profile_image))
                                                                    <img src="{{ asset('uploads/images/profile_images/'.$user->profile_image ) }}" alt="" class="d-block mx-auto shadow rounded-pill mb-4 worker-avatar">
                                                                @else 
                                                                    <img src="{{ asset('uploads/images/profile_images/default_company.jpg') }}" alt="" class="d-block mx-auto shadow rounded-pill mb-4 worker-avatar">
                                                                @endif
    
                                                                @if(!empty($user->company_name))
                                                                    <h3>{{ucwords($user->company_name)}}</h3>
                                                                @else
                                                                    <h3>{{ucwords($user->name)}}</h3>
                                                                @endif
    
                                                                @if(!empty($user->website))
                                                                    <p>{{ucwords($user->website)}}</p>
                                                                @endif
                                                                @if (!empty($user->country))
                                                                <span>
                                                                    <i class="fal fa-globe mr-1"></i>
                                                                    {{ Helper::getCountryBykey($user->country) }}
                                                                </span>
                                                                @endif
                                                                @if (!empty($user->address))
                                                                    <div>
                                                                        <span>
                                                                            <i class="fal fa-map-marker-alt mr-1"></i>
                                                                            {{ $user->address }}
                                                                        </span>
                                                                    </div>
                                                                @endif
                                                            @endif
                                                            @if($user->role == 0)
                                                                @if(!empty($user->profile_image))
                                                                <img src="{{ asset('uploads/images/profile_images/'.$user->profile_image ) }}" alt="" class="d-block mx-auto shadow rounded-pill mb-4 worker-avatar">
                                                                @else 
                                                                    <img src="{{ asset('uploads/images/profile_images/default.jpg') }}" alt="" class="d-block mx-auto shadow rounded-pill mb-4 worker-avatar">
                                                                @endif
    
                                                                
                                                                <h3>{{ucwords($user->name)}}</h3>
    
                                                                @if (!empty($user->category_id))
                                                                    @foreach(Helper::userCats($user->category_id) as $key => $value)
                                                                        @if($loop->index < 4)
                                                                            <span class="category">
                                                                                {{ Helper::getCategoryName($value) }}
                                                                            </span>
                                                                        @endif
                                                                    @endforeach
                                                                @endif
    
                                                                <div class="country text-center">
                                                                    @if (!empty($user->city))
                                                                        <span>
                                                                            {{ Helper::getCityByID($user->city) }}
                                                                        </span>
                                                                    @endif
                                                                    @if (!empty($user->country))
                                                                        <span>
                                                                            {{ Helper::getCountryByKey($user->country) }}
                                                                        </span>
                                                                    @endif
                                                                </div>
    
    
    
                                                                <div class="email">
                                                                    <i class="fal fa-envelope mr-1"></i>
                                                                    <span>
                                                                        
                                                                        {{ $user->email }}
                                                                    </span>
                                                                </div>
                                                                <div class="phone">
                                                                    <i class="fal fa-phone-alt"></i>
                                                                    @if (!empty($user->phone))
                                                                        <span>
                                                                            {{ $user->phone }}
                                                                        </span>
                                                                    @endif
                                                                </div>
                                                                
                                                                @if (count(Helper::galleryByUser($user->id)) > 0)
                                                                    <div class="gallery pt-2">
                                                                        @foreach(Helper::galleryByUser($user->id ) as $image)
                                                                            <div class="image-box">
                                                                                <img src="{{ asset('uploads/images/gallery_images/'.$image->gallery_image) }}" alt="" class="img-fluid gallery_image" id ="preview_image" data-toggle="modal" data-target="#gallery-{{$image->id}}">
                                                                                    @if (auth()->user()->id == $user->id)
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
                                                        </a>
                                                        @endforeach
                                                    </div>
                                                
                                            @endif
                                        @else
                                            <div class="row other-name">
                                                   Crossedlink User
                                            </div>
                                        @endif
                                            
                                    </div>
                                </div>
                            </div>
                        </div> 
                    @endif
                @endforeach
            @else 
                <div class="empty-box">
                    {{trans('main.No Messeges To Show')}}
                </div>
            @endif
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