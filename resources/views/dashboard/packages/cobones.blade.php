@include('inc.header')


<div class="page  has-sidebar-left height-full company-list">
    <header class="blue accent-3 relative">
        <div class="container-fluid text-white">
            <div class="row p-t-b-10 ">
                <div class="col">
                    <h4>
                        <i class="icon-database"></i>
                        cobones
                    </h4>
                </div>
            </div>
            <div class="row justify-content-between">
                <ul class="nav nav-material nav-material-white responsive-tab" id="v-pills-tab" role="tablist">
                    <li>
                        <a class="nav-link active"  href="{{url('dashboard/cobones')}}"
                           role="tab" aria-controls="v-pills-all"><i class="icon icon-home2"></i>All cobones</a>
                    </li>
                    <li>
                        <a class="nav-link" href="{{url('dashboard/cobones/companies')}}"
                           role="tab" aria-controls="v-pills-all"><i class="icon icon-home2"></i>Companies cobones</a>
                    </li>
                    <li>
                        <a class="nav-link" href="{{url('dashboard/cobones/personal')}}"
                           role="tab" aria-controls="v-pills-all"><i class="icon icon-home2"></i>Personal cobones</a>
                    </li>
                    <li class="float-right">
                        <a class="nav-link"  href="{{url('dashboard/cobones/create')}}" ><i class="icon icon-plus-circle"></i> Add New cobone</a>
                    </li>
                    <li class="float-right">
                        <a class="nav-link"  href="{{url('dashboard/cobones/create/extention')}}" ><i class="icon icon-plus-circle"></i> Add New Extention</a>
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
                        @if (count($cobones) > 0)
                        <div class="card r-0 shadow">
                            <div class="table-responsive">
                                <form>
                                    <table class="table table-striped table-hover r-0">
                                        <thead>
                                        <tr class="no-b">
                                            <th>cobone NAME</th>
                                            <th>Role</th>
                                            <th>Price</th>
                                            <th>Profiles cobone</th>
                                            <th>Ads cobone</th>
                                            <th>Period</th>
                                            <th>Sponsored</th>
                                            <th>Settings</th>
                                        </tr>
                                        </thead>

                                        <tbody>
                                            @foreach ($cobones as $cobone)
                                                @if ($cobone->role == 0 || $cobone->role == 1)

                                                <tr>
                                                    
        
                                                    <td>{{$cobone->name}}</td>

                                                    @if($cobone->role == 0)
                                                        <td><span class="r-3 badge badge-success ">Company</span></td>
                                                    @elseif($cobone->role == 1)   
                                                        <td><span class="r-3 badge badge-warning ">Personal</span></td>
                                                    @endif

                                                    <td>{{$cobone->price}}</td>
                                                    <td>{{$cobone->profiles}}</td>
                                                    <td>{{$cobone->ads}}</td>

                                                    <td>{{$cobone->period}}</td>

                                                    @if($cobone->sponsored == 0)
                                                        <td><span class="r-3 badge badge-warning ">Not Sponsored</span></td>
                                                    @elseif($cobone->sponsored == 1)   
                                                        <td><span class="r-3 badge badge-success ">Sponsored</span></td>
                                                    @endif

                                                    

                                                    <td>
                                                        {{--<a href="{{url('dashboard/cobones/'. $cobone->id)}}" class="btn-fab btn-fab-sm btn-warning shadow text-white"><i class="icon-eye mr-3"></i></a>--}}
                                                        <a href="{{url('dashboard/cobones/'.$cobone->id.'/edit')}}" class="btn-fab btn-fab-sm btn-primary shadow text-white"><i class="icon-pencil"></i></a>
                                                        <button type="button" class="btn-fab btn-fab-sm btn-danger shadow text-white" data-toggle="modal" data-target="#exampleModal-{{$cobone->id}}">
                                                            <i class="icon-times"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                                @endif
                                            @endforeach
                                        </tbody>
                                    </table>
                                </form>
                            </div>
                        </div>
                        @else
                        <div class="bg-white p-4">
                            <span class="text-secondary">
                                No cobones To Show!
                            </span>
                            <a href="{{url('dashboard/cobones/create')}}">Add cobone</a>   
                        </div>
                        @endif
                    </div>
                </div>
                <div class="row my-5">
                    <div class="col-md-12">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Add New Message Fab Button-->
    <a href="{{url('dashboard/cobones/create')}}" class="btn-fab btn-fab-md fab-right fab-right-bottom-fixed shadow btn-primary">
        <i class="icon-add">
        </i>
    </a>
</div>
@include('inc.foot')