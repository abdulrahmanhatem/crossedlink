@include('inc.header')


<div class="page  has-sidebar-left height-full company-list">
    <header class="blue accent-3 relative">
        <div class="container-fluid text-white">
            <div class="row p-t-b-10 ">
                <div class="col">
                    <h4>
                        <i class="icon-database"></i>
                        Social Media
                    </h4>
                </div>
            </div>
            <div class="row justify-content-between">
                <ul class="nav nav-material nav-material-white responsive-tab" id="v-pills-tab" role="tablist">
                    <li>
                        <a class="nav-link active"  href="{{url('dashboard/socials')}}"
                           role="tab" aria-controls="v-pills-all"><i class="icon icon-home2"></i>All Social Media</a>
                    </li>
                    <li class="float-right">
                        <a class="nav-link"  href="{{url('dashboard/socials/create')}}" ><i class="icon icon-plus-circle"></i> Add New Social Media</a>
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
                        @if (count($socials) > 0)
                            <div class="card r-0 shadow">
                                <div class="table-responsive">
                                    <form>
                                        <table class="table table-striped table-hover r-0">
                                            <thead>
                                            <tr class="no-b">
                                                <th>User Name</th>
                                                <th>Facebook</th>
                                                <th>Twitter</th>
                                                <th>google Plus</th>
                                                <th>Linkedin</th>
                                                <th>Pinterest</th>
                                                <th>instagram</th>
                                                <th>Settings</th>
                                            </tr>
                                            </thead>

                                            <tbody>
                                                    @foreach ($socials as $social)
                                                    <tr>
                                                        <td>
                                                            @foreach(Helper::userByID($social->user_id) as $user)
                                                            {{$user->name}}
                                                        
                                                            @endforeach
                                                        </td>
                                                        <td>
                                                            @if (!empty($social->facebook))
                                                                <span class="badge badge-success"><i class="fa fa-facebook"></i> Facebook</span>
                                                                
                                                            @else
                                                                Empty
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if (!empty($social->twitter))
                                                                <span class="badge badge-success"><i class="fa fa-facebook"></i>Twitter</span>
                                                                
                                                            @else
                                                                Empty
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if (!empty($social->google_plus))
                                                                <span class="badge badge-success"><i class="fa fa-facebook"></i> Google Plus</span>
                                                                
                                                            @else
                                                                Empty
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if (!empty($social->linkedin))
                                                                <span class="badge badge-success"><i class="fa fa-facebook"></i> Linkedin</span>
                                                            @else
                                                                Empty
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if (!empty($social->pinterest))
                                                                <span class="badge badge-success"><i class="fa fa-facebook"></i>Pinterest</span>
                                                            @else
                                                                Empty
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if (!empty($social->instagram))
                                                                <span class="badge badge-success"><i class="fa fa-facebook"></i> Instagram</span>
                                                            @else
                                                                Empty
                                                            @endif
                                                        </td>
                                                        

                                                        <td>
                                                            {{--<a href="{{url('dashboard/socials/'. $social->id)}}" class="btn-fab btn-fab-sm btn-warning shadow text-white"><i class="icon-eye mr-3"></i></a>--}}
                                                            <a href="{{url('dashboard/socials/'.$social->id.'/edit')}}" class="btn-fab btn-fab-sm btn-primary shadow text-white"><i class="icon-pencil"></i></a>
                                                            <button type="button" class="btn-fab btn-fab-sm btn-danger shadow text-white" data-toggle="modal" data-target="#exampleModal-{{$social->id}}">
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
                                    No Social Media To Show!
                                </span>
                                <a href="{{url('dashboard/socials/create')}}">Add Social Media</a>   
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Add New Message Fab Button-->
    <a href="{{url('dashboard/socials/create')}}" class="btn-fab btn-fab-md fab-right fab-right-bottom-fixed shadow btn-primary">
        <i class="icon-add">
        </i>
    </a>
</div>

<!-- Modal -->
@if (count($socials) > 0)
    @foreach ($socials as $social)
        <div class="modal fade" id="exampleModal-{{$social->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Delete Social</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    Are You Sure To Delete All Data about social {{$social->name}}
                </div>
                <div class="modal-footer">
                    {!! Form::open(['action'=>['SocialController@destroy', $social->id], 'method'=>'POST'])!!}
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