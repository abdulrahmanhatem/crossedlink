@include('inc.header')


<div class="page  has-sidebar-left height-full company-list">
    <header class="blue accent-3 relative">
        <div class="container-fluid text-white">
            <div class="row p-t-b-10 ">
                <div class="col">
                    <h4>
                        <i class="icon-database"></i>
                        Workers
                    </h4>
                </div>
            </div>
            <div class="row justify-content-between">
                <ul class="nav nav-material nav-material-white responsive-tab" id="v-pills-tab" role="tablist">
                    <li>
                        <a class="nav-link active" href="{{url('dashboard/workers')}}"
                           role="tab" aria-controls="v-pills-all"><i class="icon icon-home2"></i>All Workers</a>
                    </li>
                    <li class="float-right">
                        <a class="nav-link"  href="{{url('dashboard/workers/create')}}" ><i class="icon icon-plus-circle"></i> Add New Workers</a>
                    </li>
                    <li class="float-right search-li">
                        {!! Form::open(['action'=>'WorkerController@search', 'method'=>'POST', 'enctype' =>'multipart/form-data', ' novalidate', 'class' => 'needs-validation d-block'])!!}
                        {!! Form::text('search', '',  ['class' => "form-control r-0 light s-12 d-inline-block w-50", 'placeholder' => 'Serach ...'])!!}
                        {!! Form::submit('Search', ['class' => "btn btn-primary btn-sm d-inline-block w-25"]) !!}
                        {!! Form::close() !!}
                    </li>
                </ul>
            </div>
        </div>
    </header>
    <div class="container-fluid animatedParent animateOnce">
        <div class="tab-content my-3" id="v-pills-tabContent">
            <div class="tab-pane animated fadeInUpShort show active" id="v-pills-all" role="tabpanel" aria-labelledby="v-pills-all-tab">
                <div class="row my-3">
                    <div class="col-md-12">
                        @if (count($workers) > 0)
                            <div class="card r-0 shadow">
                                <div class="table-responsive">
                                    <form>
                                        <table class="table table-striped table-hover r-0">
                                            <thead>
                                            <tr class="no-b">
                                                <th>Worker NAME</th>
                                                <th>PHONE</th>
                                                <th>Category</th>
                                                {{--<th>Role</th>--}}
                                                <th>Nationality</th>
                                                <th>Last Seen</th>
                                                <th>Settings</th>
                                            </tr>
                                            </thead>

                                            <tbody>
                                                    @foreach ($workers as $user)
                                                    <tr>

                                                        <td>
                                                            <div class="avatar avatar-md mr-3 mt-1 float-left">
                                                                @if(empty($user->profile_image))
                                                                    <img class="user_avatar no-b no-p" src="{{url('uploads/images/profile_images/default.jpg')}}" alt="User Image">
                                                                @else
                                                                    <img class="user_avatar no-b no-p" src="{{url('uploads/images/profile_images/'.$user->profile_image)}}" alt="User Image">
                                                                @endif
                                                            </div>
                                                            <div>
                                                                <div>
                                                                    <strong>{{$user->name}}</strong>
                                                                </div>
                                                                <small> {{$user->email}}</small>
                                                            </div>
                                                        </td>

                                                        <td>
                                                            @if (!empty($user->phone))
                                                                {{$user->phone}}
                                                            @endif
                                                        </td>
                                                        

                                                        <td><span class="s-12 mr-2"></span> 
                                                            @if (!empty($user->category_id))
                                                                @foreach(Helper::userCats($user->category_id) as $key => $value)
                                                                    @if($loop->index < 4)
                                                                        <span class="category badge badge-successful">
                                                                            {{ Helper::getCategoryName($value) }}
                                                                        </span>
                                                                    @endif
                                                                @endforeach
                                                            @endif
                                                        </td>

                                                    
                                                        {{--@if($user->role == 2)
                                                            <td><span class="r-3 badge badge-success ">Company</span></td>
                                                        @elseif($user->role == 1)   
                                                        <td><span class="r-3 badge badge-success ">Personal</span></td>
                                                        @elseif($user->role == 0)   
                                                            <td><span class="r-3 badge badge-warning ">Worker</span></td> 
                                                        @endif--}}

                                                        <td>{{ Helper::nationalityByKey($user->nationality) }}</td>
                                                        <td>{{ $user->last_seen }}</td>

                                                        <td>
                                                            
                                                            <a href="{{url('dashboard/workers/'. $user->id)}}" class="btn-fab btn-fab-sm btn-warning shadow text-white"><i class="icon-eye mr-3"></i></a>
                                                            <a href="{{url('dashboard/workers/'.$user->id.'/edit')}}" class="btn-fab btn-fab-sm btn-primary shadow text-white"><i class="icon-pencil"></i></a>
                                                            <!-- Button trigger modal -->
                                                            <button type="button" class="btn-fab btn-fab-sm btn-danger shadow text-white" data-toggle="modal" data-target="#exampleModal-{{$user->id}}">
                                                                <i class="icon-times"></i>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                            </tbody>
                                        </table>
                                    </form>
                                </div>
                            </div>
                        @else
                            <div class="bg-white p-4">
                                <span class="text-secondary">
                                    No Workers To Show!
                                </span>
                                <a href="{{url('dashboard/workers/create')}}">Add Worker </a>   
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Add New Message Fab Button-->
    <a href="{{url('dashboard/workers/create')}}" class="btn-fab btn-fab-md fab-right fab-right-bottom-fixed shadow btn-primary">
        <i class="icon-add">
        </i>
    </a>
</div>

<!-- Modal -->
@if (count($workers) > 0)
    @foreach ($workers as $user)
        <div class="modal fade" id="exampleModal-{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Delete Worker</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    Are You Sure To Delete All Data about worker {{$user->name}}
                </div>
                <div class="modal-footer">
                    {!! Form::open(['action'=>['WorkerController@destroy', $user->id], 'method'=>'POST'])!!}
                    {!! Form::button('Delete', ['type' => 'submit','class' => "btn btn-danger"], false)!!}
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    {{Form::hidden('_method', 'DELETE')}}
                    {!! Form::close() !!}
                </div>
            </div>
            </div>
        </div>
    @endforeach
@endif
@include('inc.foot')