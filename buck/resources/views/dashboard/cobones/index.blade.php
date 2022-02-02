@include('inc.header')


<div class="page  has-sidebar-left height-full company-list">
    <header class="blue accent-3 relative">
        <div class="container-fluid text-white">
            <div class="row p-t-b-10 ">
                <div class="col">
                    <h4>
                        <i class="icon-database"></i>
                        Cobones
                    </h4>
                </div>
            </div>
            <div class="row justify-content-between">
                <ul class="nav nav-material nav-material-white responsive-tab" id="v-pills-tab" role="tablist">
                    <li>
                        <a class="nav-link active"  href="{{url('dashboard/cobones')}}"
                           role="tab" aria-controls="v-pills-all"><i class="icon icon-home2"></i>All Cobones</a>
                    </li>
                    <li class="float-right">
                        <a class="nav-link"  href="{{url('dashboard/cobones/create')}}" ><i class="icon icon-plus-circle"></i> Add New cobone</a>
                    </li>
                </ul>
            </div>
        </div>
    </header>
    <div class="container-fluid animatedParent animateOnce">
        <div class="tab-content my-3" id="v-pills-tabContent">
            <div class="tab-pane animated fadeInUpShort show active" id="v-pills-all" role="tabpanel" aria-labelledby="v-pills-all-tab">
                <div class="row my-3">
                    <a class="btn btn-success m-3"  href="{{url('dashboard/cobones/generate')}}" >Generate Cobones</a>
                    <div class="col-md-12">
                        @if (count($cobones) > 0)
                            <div class="card r-0 shadow">
                                <div class="table-responsive">
                                    <form>
                                        <table class="table table-striped table-hover r-0">
                                            <thead>
                                            <tr class="no-b">
                                                <th>Cobone Code</th>
                                                <th>Deduction percentage</th>
                                                <th>State</th>
                                                <th>Settings</th>
                                            </tr>
                                            </thead>
                                            
                                            <tbody>
                                                    @foreach ($cobones as $cobone)
                                                    <tr>
                                                        <td>{{ $cobone->code}}</td>
            
                                                    <td>{{ $cobone->percentage }}%</td>

                                                       @if ($cobone->state == 0)
                                                       <td >
                                                           <span class="badge badge-successful">Available</span>
                                                        </td>
                                                       @else 
                                                       <td >
                                                            <span class="badge badge-warning">Used</span>
                                                        </td>
                                                       @endif

                                                        <td>
                                                            {{--<a href="{{url('dashboard/cobones/'. $cobone->id)}}" class="btn-fab btn-fab-sm btn-warning shadow text-white"><i class="icon-eye mr-3"></i></a>--}}
                                                            <a href="{{url('dashboard/cobones/'.$cobone->id.'/edit')}}" class="btn-fab btn-fab-sm btn-primary shadow text-white"><i class="icon-pencil"></i></a>
                                                            <button type="button" class="btn-fab btn-fab-sm btn-danger shadow text-white" data-toggle="modal" data-target="#exampleModal-{{$cobone->id}}">
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
                            <div class="row">
                                <div class="col-lg-12 mt-4 pt-2">
                                    <nav class="filter pagination">
                                        {{ $cobones->links() }}
                                    </nav>
                                </div>
                            </div>
                        @else 
                            <div class="bg-white p-4">
                                <span class="text-secondary">
                                    No Cobones To Show!
                                </span>
                                <a href="{{url('dashboard/cobones/create')}}">Add Cobone</a>   
                            </div>
                        @endif
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

<!-- Modal -->
@if (count($cobones) > 0)
    @foreach ($cobones as $cobone)
        <div class="modal fade" id="exampleModal-{{$cobone->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Delete Cobone</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    Are You Sure To Delete All Data about  {{$cobone->code}} cobone
                </div>
                <div class="modal-footer">
                    {!! Form::open(['action'=>['CoboneController@destroy', $cobone->id], 'method'=>'POST'])!!}
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