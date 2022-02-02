@include('inc.header')


<div class="page  has-sidebar-left height-full company-list">
    <header class="blue accent-3 relative">
        <div class="container-fluid text-white">
            <div class="row p-t-b-10 ">
                <div class="col">
                    <h4>
                        <i class="icon-database"></i>
                        Jobs
                    </h4>
                </div>
            </div>
            <div class="row justify-content-between">
                <ul class="nav nav-material nav-material-white responsive-tab" id="v-pills-tab" role="tablist">
                    <li>
                        <a class="nav-link active" href="{{url('dashboard/job/requests')}}"
                           role="tab" aria-controls="v-pills-all"><i class="icon icon-home2"></i>All Jobs</a>
                    </li>
                    <li class="float-right">
                        <a class="nav-link" href="{{url('dashboard/job/requests/create')}}" ><i class="icon icon-plus-circle"></i> Add New Job</a>
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
                        
                        @if (count($jobs) > 0)
                            <div class="card r-0 shadow">
                                <div class="table-responsive">
                                    <form>
                                        <table class="table table-striped table-hover r-0">
                                            <thead>
                                            <tr class="no-b">
                                                <th>Worker</th>
                                                <th>Job</th>
                                                <th>Employer</th>
                                                <th>State</th>
                                                <th>Settings</th>
                                            </tr>
                                            </thead>
                                            
                                            <tbody>
                                                    @foreach ($jobs as $job_request)
                                                    <tr>
                                                        <td>
                                                            <div class="avatar avatar-md mr-3 mt-1 float-left">
                                                                @if(empty($job_request->worker->profile_image))
                                                                    <img class="user_avatar no-b no-p" src="{{url('uploads/images/profile_images/default.jpg')}}" alt="User Image">
                                                                @else
                                                                    <img class="user_avatar no-b no-p" src="{{url('uploads/images/profile_images/'.$job_request->worker->profile_image)}}" alt="User Image">
                                                                @endif
                                                            </div>
                                                            <div>
                                                                <div>
                                                                    @if ($job_request->worker->role == 1)
                                                                        <strong>{{$job_request->worker->company_name}}</strong>
                                                                    @else 
                                                                        <strong>{{$job_request->worker->name}}</strong>
                                                                    @endif
                                                                </div>
                                                                <small>{{$job_request->worker->email}}</small>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            @foreach ( Helper::jobByID($job_request->job_id) as $job)
                                                                {{ $job->title }}
                                                            @endforeach
                                                        </td>
            
                                                        <td>
                                                            @foreach ( Helper::jobByID($job_request->job_id) as $job)
                                                                @if ($job->employer->role == 1)
                                                                    {{ $job->employer->name }}
                                                                @else 
                                                                    {{ $job->employer->company_name }}
                                                                @endif
                                                            @endforeach
                                                        </td>

                                                        <td>
                                                            @if ($job_request->state == 0)
                                                                <span class="badge badge-warning">Pending</span>
                                                            @elseif ($job_request->state == 1)
                                                                <span class="badge badge-success">Liked</span>
                                                            @elseif ($job_request->state == 2)
                                                                <span class="badge badge-success">Approved</span>
                                                            @elseif ($job_request->state == 3)
                                                                <span class="badge badge-success">Rejected</span>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            {{--<a href="{{url('dashboard/job/requests/'. $job_request->id)}}" class="btn-fab btn-fab-sm btn-warning shadow text-white"><i class="icon-eye mr-3"></i></a>--}}
                                                            <a href="{{url('dashboard/job/requests/'.$job_request->id.'/edit')}}" class="btn-fab btn-fab-sm btn-primary shadow text-white"><i class="icon-pencil"></i></a>
                                                            <button type="button" class="btn-fab btn-fab-sm btn-danger shadow text-white" data-toggle="modal" data-target="#exampleModal-{{$job_request->id}}">
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
                                    No Job Requests To Show!
                                </span>
                                <a href="{{url('dashboard/job/requests/create')}}">Add Job Requests</a>   
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Add New Message Fab Button-->
    <a href="{{url('dashboard/Jobs/create')}}" class="btn-fab btn-fab-md fab-right fab-right-bottom-fixed shadow btn-primary">
        <i class="icon-add">
        </i>
    </a>
</div>

<!-- Modal -->
@if (count($jobs) > 0)
    @foreach ($jobs as $job)
        <div class="modal fade" id="exampleModal-{{$job->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete Job Request</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body">
                        Are You Sure To Delete All Data about  {{$job->name}} Job
                    </div>
                    <div class="modal-footer">
                        {!! Form::open(['action'=>['JobRequestController@destroy', $job->id], 'method'=>'POST'])!!}
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