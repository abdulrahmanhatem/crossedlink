@include('inc.header')


<div class="page  has-sidebar-left height-full company-list">
    <header class="blue accent-3 relative">
        <div class="container-fluid text-white">
            <div class="row p-t-b-10 ">
                <div class="col">
                    <h4>
                        <i class="icon-database"></i>
                        Saved Jobs
                    </h4>
                </div>
            </div>
            <div class="row justify-content-between">
                <ul class="nav nav-material nav-material-white responsive-tab" id="v-pills-tab" role="tablist">
                    <li>
                        <a class="nav-link active"  href="{{url('dashboard/saved/jobs')}}"
                           role="tab" aria-controls="v-pills-all"><i class="icon icon-home2"></i>All Saved Jobs </a>
                    </li>
                    <li class="float-right">
                        <a class="nav-link"  href="{{url('dashboard/saved/jobs/create')}}" ><i class="icon icon-plus-circle"></i> Add New Saved Job </a>
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
                        @if (count($saveds) > 0)
                            <div class="card r-0 shadow">
                                <div class="table-responsive">
                                    <form>
                                        <table class="table table-striped table-hover r-0">
                                            <thead>
                                            <tr class="no-b">
                                                <th>Worker</th>
                                                <th>Saved Job</th>
                                                <th>Employer</th>
                                                <th>Settings</th>
                                            </tr>
                                            </thead>

                                            <tbody>
                                                    @foreach ($saveds as $saved)
                                                    <tr>
                                                        <td>
                                                            @foreach ( Helper::userByID($saved->user_id) as $user)
                                                                    {{ $user->name }}
                                                            @endforeach
                                                            </td>
                                                        <td>
                                                            @foreach ( Helper::jobByID($saved->job_id) as $job)
                                                                {{ $job->title }}
                                                            @endforeach
                                                        </td>

                                                        <td>
                                                            @foreach ( Helper::jobByID($saved->job_id) as $job)
                                                                @foreach ( Helper::userByID($job->employer_id) as $user)
                                                                
                                                                    @if ($user->role == 1)
                                                                        {{ $user->name }}
                                                                    @else 
                                                                        {{ $user->company_name }}
                                                                    @endif
                                                                @endforeach
                                                            @endforeach
                                                        </td>




                                                        <td>
                                                            {{--<a href="{{url('dashboard/saved/jobs/'. $saved->id)}}" class="btn-fab btn-fab-sm btn-warning shadow text-white"><i class="icon-eye mr-3"></i></a>--}}
                                                            <a href="{{url('dashboard/saved/jobs/'.$saved->id.'/edit')}}" class="btn-fab btn-fab-sm btn-primary shadow text-white"><i class="icon-pencil"></i></a>
                                                            <button type="button" class="btn-fab btn-fab-sm btn-danger shadow text-white" data-toggle="modal" data-target="#exampleModal-{{$saved->id}}">
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
                                    No saved Jobs To Show!
                                </span>
                                <a href="{{url('dashboard/saved/jobs/create')}}">Add saved Job</a>   
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Add New Message Fab Button-->
    <a href="{{url('dashboard/saveds/create')}}" class="btn-fab btn-fab-md fab-right fab-right-bottom-fixed shadow btn-primary">
        <i class="icon-add">
        </i>
    </a>
</div>

<!-- Modal -->
@if (count($saveds) > 0)
    @foreach ($saveds as $saved)
        <div class="modal fade" id="exampleModal-{{$saved->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Delete Saved Job</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    Are You Sure To Delete All Data about saved {{$saved->name}}
                </div>
                <div class="modal-footer">
                    {!! Form::open(['action'=>['SavedJobController@destroy', $saved->id], 'method'=>'POST'])!!}
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