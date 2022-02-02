@include('inc.header')


<div class="page  has-sidebar-left height-full admin-list">
    <header class="blue accent-3 relative">
        <div class="container-fluid text-white">
            <div class="row p-t-b-10 ">
                <div class="col">
                    <h4>
                        <i class="icon-database"></i>
                        Admins
                    </h4>
                </div>
            </div>
            <div class="row justify-content-between">
                <ul class="nav nav-material nav-material-white responsive-tab" id="v-pills-tab" role="tablist">
                    <li>
                        <a class="nav-link active"  href="{{url('dashboard/admins')}}"
                           role="tab" aria-controls="v-pills-all"><i class="icon icon-home2"></i>All Admins</a>
                    </li>
                    <li class="float-right">
                        <a class="nav-link"  href="{{url('dashboard/admins/create')}}" ><i class="icon icon-plus-circle"></i> Add New Admin</a>
                    </li>
                    <li class="float-right search-li">
                        {!! Form::open(['action'=>'AdminController@search', 'method'=>'POST', 'enctype' =>'multipart/form-data', ' novalidate', 'class' => 'needs-validation d-block'])!!}
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
                        <div class="card r-0 shadow">
                            <div class="table-responsive">
                                <form>
                                    <table class="table table-striped table-hover r-0">
                                        <thead>
                                        <tr class="no-b">
                                            <th>Admin NAME</th>
                                            <!--<th>TICKETS</th>-->
                                            <th>PHONE</th>
                                            <th>Last Seen</th>
                                            {{--<th>STATUS</th>--}}
                                            <th>Settings</th>
                                            <th></th>
                                        </tr>
                                        </thead>

                                        <tbody>
                                            @if (count($admins) > 0)
                                                @foreach ($admins as $user)
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
        
                                                    <!--<td>2</td>-->
                                                    <td>
                                                        @if (!empty($user->phone))
                                                            {{$user->phone}}
                                                        @endif
                                                    </td>
                                                    {{--<td><span class="icon icon-circle s-12  mr-2 text-warning"></span> Inactive</td>--}}
                                                    <td>{{ $user->last_seen }}</td>
                                                    

                                                    <td>
                                                          
                                                        {{--<a href="{{url('dashboard/admins/'. $user->id)}}" class="btn-fab btn-fab-sm btn-warning shadow text-white"><i class="icon-eye mr-3"></i></a>--}}
                                                        <a href="{{url('dashboard/admins/'.$user->id.'/edit')}}" class="btn-fab btn-fab-sm btn-primary shadow text-white"><i class="icon-pencil"></i></a>
                                                        <!-- Button trigger modal -->
                                                        <button type="button" class="btn-fab btn-fab-sm btn-danger shadow text-white" data-toggle="modal" data-target="#exampleModal-{{$user->id}}">
                                                            <i class="icon-times"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            @endif
                                        </tbody>
                                    </table>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Add New Message Fab Button-->
    <a href="{{url('dashboard/admins/create')}}" class="btn-fab btn-fab-md fab-right fab-right-bottom-fixed shadow btn-primary">
        <i class="icon-add">
        </i>
    </a>
</div>

<!-- Modal -->
@if (count($admins) > 0)
    @foreach ($admins as $user)
        <div class="modal fade" id="exampleModal-{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Delete Admin</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    Are You Sure To Delete All Data about Admin {{$user->name}}
                </div>
                <div class="modal-footer">
                    {!! Form::open(['action'=>['AdminController@destroy', $user->id], 'method'=>'POST'])!!}
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