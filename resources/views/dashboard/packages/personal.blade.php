@include('inc.header')


<div class="page  has-sidebar-left height-full company-list">
    <header class="blue accent-3 relative">
        <div class="container-fluid text-white">
            <div class="row p-t-b-10 ">
                <div class="col">
                    <h4>
                        <i class="icon-database"></i>
                        Packages
                    </h4>
                </div>
            </div>
            <div class="row justify-content-between">
                <ul class="nav nav-material nav-material-white responsive-tab" id="v-pills-tab" role="tablist">
                    <li>
                        <a class="nav-link"  href="{{url('dashboard/packages')}}"
                           role="tab" aria-controls="v-pills-all"><i class="icon icon-home2"></i>All Packages</a>
                    </li>
                    <li>
                        <a class="nav-link" href="{{url('dashboard/packages/companies')}}"
                           role="tab" aria-controls="v-pills-all"><i class="icon icon-home2"></i>Companies Packages</a>
                    </li>
                    <li>
                        <a class="nav-link active" href="{{url('dashboard/packages/personal')}}"
                           role="tab" aria-controls="v-pills-all"><i class="icon icon-home2"></i>Personal Packages</a>
                    </li>
                    <li class="float-right">
                        <a class="nav-link"  href="{{url('dashboard/packages/create')}}" ><i class="icon icon-plus-circle"></i> Add New Package</a>
                    </li>
                    <li class="float-right">
                        <a class="nav-link"  href="{{url('dashboard/packages/create/extention')}}" ><i class="icon icon-plus-circle"></i> Add New Addon</a>
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
                                            <th>Package Name</th>
                                            <th>Role</th>
                                            <th>Price</th>
                                            <th>Profiles package</th>
                                            <th>Ads package</th>
                                            <th>Period</th>
                                            <th>Settings</th>
                                        </tr>
                                        </thead>

                                        <tbody>
                                            @if (count($packages) > 0)
                                                @foreach ($packages as $package)
                                                <tr>
                                                    
        
                                                    <td>{{$package->name}}</td>

                                                    @if($package->role == 0)
                                                        <td><span class="r-3 badge badge-success ">Company</span></td>
                                                    @elseif($package->role == 1)   
                                                        <td><span class="r-3 badge badge-warning ">Personal</span></td>
                                                    @endif

                                                    <td>{{$package->price}}</td>
                                                    <td>{{$package->profiles}}</td>
                                                    <td>{{$package->ads}}</td>

                                                 

                                                    <td>{{$package->period}}</td>

                                                    <td>
                                                        <a href="{{url('dashboard/packages/'.$package->id.'/edit')}}" class="btn-fab btn-fab-sm btn-primary shadow text-white"><i class="icon-pencil"></i></a>
                                                        <button type="button" class="btn-fab btn-fab-sm btn-danger shadow text-white" data-toggle="modal" data-target="#exampleModal-{{$package->id}}">
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
    <a href="{{url('dashboard/packages/create')}}" class="btn-fab btn-fab-md fab-right fab-right-bottom-fixed shadow btn-primary">
        <i class="icon-add">
        </i>
    </a>
</div>

<!-- Modal -->
@if (count($packages) > 0)
    @foreach ($packages as $package)
        <div class="modal fade" id="exampleModal-{{$package->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Delete Package</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    Are You Sure To Delete All Data about package {{$package->name}}
                </div>
                <div class="modal-footer">
                    {!! Form::open(['action'=>['PackageController@destroy', $package->id], 'method'=>'POST'])!!}
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