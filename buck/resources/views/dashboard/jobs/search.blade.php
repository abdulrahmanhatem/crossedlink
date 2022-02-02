@include('inc.header')


<div class="page  has-sidebar-left height-full job-list">
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
                        <a class="nav-link active" href="{{url('dashboard/jobs')}}"
                           role="tab" aria-controls="v-pills-all"><i class="icon icon-home2"></i>All Jobs</a>
                    </li>
                    <li class="float-right">
                        <a class="nav-link"  href="{{url('dashboard/jobs/create')}}" ><i class="icon icon-plus-circle"></i> Add New job</a>
                    </li>
                    <li class="float-right search-li">
                        {!! Form::open(['action'=>'JobController@search', 'method'=>'POST', 'enctype' =>'multipart/form-data', ' novalidate', 'class' => 'needs-validation d-block'])!!}
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
                        
                        @if (count($jobs) > 0)
                            <div class="card r-0 shadow">
                                <div class="table-responsive">
                                    <form>
                                        <table class="table table-striped table-hover r-0">
                                            <thead>
                                            <tr class="no-b">
                                                <th>Job Title</th>
                                                <th>Employer</th>
                                                <th>Country</th>
                                                <th>City</th>
                                                <th>sponsored</th>
                                                <th>State</th>
                                                <th>Settings</th>
                                            </tr>
                                            </thead>

                                            <tbody>
                                                    @foreach ($jobs as $job)
                                                    <tr>
                                                        <td>{{$job->title}}</td>
                                                        <td>
                                                            <div class="avatar avatar-md mr-3 mt-1 float-left">
                                                                @if(empty($job->employer->profile_image))
                                                                    <img class="user_avatar no-b no-p" src="{{url('uploads/images/profile_images/default.jpg')}}" alt="User Image">
                                                                @else
                                                                    <img class="user_avatar no-b no-p" src="{{url('uploads/images/profile_images/'.$job->employer->profile_image)}}" alt="User Image">
                                                                @endif
                                                            </div>
                                                            <div>
                                                                <div>
                                                                    @foreach (Helper::userByID($job->employer_id) as $user )
                                                                        @if (empty($user->company_name))
                                                                            <strong>{{$user->name}}</strong>
                                                                        @else
                                                                            <strong>{{$user->company_name}}</strong>
                                                                        @endif
                                                                    @endforeach
                                                                </div>
                                                                <small> {{$job->category->name}}</small>
                                                                
                                                            </div>
                                                        </td>

                                                        
                                                        <td>{{Helper::getCountryByKey($job->country)}}</td>
                                                        <td><span class="s-12 mr-2"></span> {{$job->city}}</td>

                                                    
                                                        @if($job->sponsored == 1)
                                                            <td><span class="r-3 badge badge-success ">Sponsored</span></td>
                                                        @elseif($job->sponsored == 0)   
                                                            <td><span class="r-3 badge badge-warning ">None Sponsored</span></td> 
                                                        @endif

                                                        @if($job->state == 0)
                                                            <td><span class="r-3 badge badge-success ">Opened</span></td>
                                                        @elseif($job->state == 1)   
                                                            <td><span class="r-3 badge badge-secondary">Closed</span></td> 
                                                        @endif
                                                        <td>
                                                            
                                                            {{--<a href="{{url('dashboard/jobs/'. $job->id)}}" class="btn-fab btn-fab-sm btn-warning shadow text-white"><i class="icon-eye mr-3"></i></a>--}}
                                                            <a href="{{url('dashboard/jobs/'.$job->id.'/edit')}}" class="btn-fab btn-fab-sm btn-primary shadow text-white"><i class="icon-pencil"></i></a>
                                                            <!-- Button trigger modal -->
                                                            <button type="button" class="btn-fab btn-fab-sm btn-danger shadow text-white" data-toggle="modal" data-target="#exampleModal-{{$job->id}}">
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
                                    No Jobs To Show!
                                </span>
                                <a href="{{url('dashboard/jobs/create')}}">Add Job</a>   
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Add New Message Fab Button-->
    <a href="{{url('dashboard/jobs/create')}}" class="btn-fab btn-fab-md fab-right fab-right-bottom-fixed shadow btn-primary">
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
                <h5 class="modal-title" id="exampleModalLabel">Delete Job</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    Are You Sure To Delete All Data about job {{$job->name}}
                </div>
                <div class="modal-footer">
                    {!! Form::open(['action'=>['JobController@destroy', $job->id], 'method'=>'POST'])!!}
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