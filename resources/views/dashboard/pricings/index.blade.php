@include('inc.header')
<div class="page  has-sidebar-left height-full company-list">
    <header class="blue accent-3 relative">
        <div class="container-fluid text-white">
            <div class="row p-t-b-10 ">
                <div class="col">
                    <h4>
                        <i class="icon-database"></i>
                        Pricing Requests
                    </h4>
                </div>
            </div>
            <div class="row justify-content-between">
                <ul class="nav nav-material nav-material-white responsive-tab" id="v-pills-tab" role="tablist">
                    <li>
                        <a class="nav-link active"  href="{{url('dashboard/pricing/requests')}}"
                           role="tab" aria-controls="v-pills-all"><i class="icon icon-home2"></i>All Pricing Requests</a>
                    </li>
                    <li class="float-right">
                        <a class="nav-link"  href="{{url('dashboard/pricing/requests/create')}}" ><i class="icon icon-plus-circle"></i> Add New Request</a>
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
                        @if (count($pricings) > 0)
                        <div class="card r-0 shadow">
                            <div class="table-responsive">
                                   
                                    <table class="table table-striped table-hover r-0">
                                        <thead>
                                        <tr class="no-b">
                                            <th>Employer</th>
                                            <th>Role</th>
                                            <th>Credit(SAR)</th>
                                            <th>Package</th>
                                            <th>State</th>
                                            <th>Start Date</th>
                                            <th>End Date</th>
                                            <th>Settings</th>
                                        </tr>
                                        </thead>
                                        
                                        <tbody>
                                                @foreach ($pricings as $pricing)
                                                    @if(Helper::checkUser($pricing->user_id))
                                                    <tr>
                                                        <td>
                                                            @if($pricing->user->role == 2)
                                                                <a href="{{url('dashboard/companies/'.$pricing->user->id)}}">
                                                            @elseif($pricing->user->role == 1)
                                                                <a href="{{url('dashboard/personal/'.$pricing->user->id)}}"> 
                                                            @endif
                                                                    <div class="avatar avatar-md mr-3 mt-1 float-left">
                                                                        @if(empty($pricing->user->profile_image))
                                                                            <img class="user_avatar no-b no-p" src="{{url('uploads/images/profile_images/default.jpg')}}" alt="User Image">
                                                                        @else
                                                                            <img class="user_avatar no-b no-p" src="{{url('uploads/images/profile_images/'. $pricing->user->profile_image)}}" alt="User Image">
                                                                        @endif
                                                                    </div>
                                                                    <div>
                                                                        @foreach (Helper::userByID($pricing->user_id) as $user )
                                                                            <div>
                                                                                @if($pricing->user->role == 2)
                                                                                    <strong>{{$user->company_name}}</strong>
                                                                                @elseif($pricing->user->role == 1)
                                                                                    <strong>{{$user->name}}</strong>
                                                                                @endif
                                                                                
                                                                            </div>
                                                                            <small> {{$user->email}}</small>
                                                                        @endforeach
                                                                    </div>
                                                                </a>
                                                           
                                                        </td>
                                                        <td>
                                                            @foreach (Helper::userByID($pricing->user_id) as $user )
                                                                @if($user->role == 1)
                                                                    <span class="r-3 badge badge-warning ">Personal</span>
                                                                @elseif($user->role == 2)   
                                                                    <span class="r-3 badge badge-success ">Company</span>
                                                                @endif
                                                            @endforeach
                                                            
                                                        </td>
                                                        <td>
                                                            @foreach (Helper::userByID($pricing->user_id) as $user )
                                                                {{$user->credit}} SAR
                                                            @endforeach
                                                        </td>
    
                                                       <td>{{$pricing->package->name}}</td>
                                                       <td>
                                                            @if($pricing->state == 0)
                                                                <span class="r-3 badge badge-warning ">Pending</span>
                                                            @elseif($pricing->state == 1)   
                                                                <span class="r-3 badge badge-success ">Started</span>
                                                            @elseif($pricing->state == 2)   
                                                                <span class="r-3 badge badge-danger ">Finished</span>  
                                                            @elseif($pricing->state == 3)   
                                                                <span class="r-3 badge badge-dark ">Deactivated</span>   
                                                            @endif
                                                        </td>
                                                        <td>{{$pricing->start_date}}</td>
                                                        <td>
                                                            {{$pricing->expired_date }}
                                                        </td>
                                                              
                                                                
                                                        <td>
                                                            @if($pricing->state == 0)
                                                                {!! Form::open(['action'=>['PricingRequestController@update', $pricing->id], 'method'=>'POST', 'class' => 'd-inline-block approve'])!!}
                                                                {!! Form::hidden('_method', 'PUT') !!}
                                                                {!! Form::hidden('pricing_id', $pricing->id) !!}
                                                                {!! Form::hidden('user_id', $pricing->user_id) !!}
                                                                {!! Form::hidden('profiles', $pricing->profiles) !!}
                                                                {!! Form::hidden('ads', $pricing->ads) !!}
                                                                {!! Form::button('<i class="icon-check mr-3"></i>', ['type' => 'submit','class' => "btn-fab btn-fab-sm btn-success shadow text-white", 'name' => 'approve', 'title' => 'Approve'], false)!!}
                                                                {!! Form::close() !!}
                                                            @endif
    
                                                           
                                                            
                                                            <a href="{{url('dashboard/pricing/requests/'.$pricing->id.'/edit')}}" class="btn-fab btn-fab-sm btn-primary shadow text-white" title="Edit"><i class="icon-pencil"></i></a>
                                                            @if($pricing->state != 2)
                                                                {!! Form::open(['action'=>['PricingRequestController@update', $pricing->id], 'method'=>'POST', 'class' => 'd-inline-block approve'])!!}
                                                                {!! Form::hidden('_method', 'PUT') !!}
                                                                {!! Form::hidden('pricing_id', $pricing->id) !!}
                                                                {!! Form::hidden('user_id', $pricing->user_id) !!}
                                                                {!! Form::hidden('profiles', $pricing->profiles) !!}
                                                                {!! Form::hidden('ads', $pricing->ads) !!}
                                                                {!! Form::button('<i class="fas fa-thumbs-down"></i>', ['type' => 'submit','class' => "btn-fab btn-fab-sm btn-warning shadow text-white", 'name' => 'deactivate', 'title' => 'Deactivate'], false)!!}
                                                                {!! Form::close() !!}
                                                            @endif
                                                            <button type="button" class="btn-fab btn-fab-sm btn-danger shadow text-white" data-toggle="modal" data-target="#exampleModal-{{$pricing->id}}" title="Remove">
                                                                <i class="icon-times"></i>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                    @endif
                                                @endforeach
                                        </tbody>
                                    </table>
                            </div>
                        </div>
                    @else 
                        <div class="bg-white p-4">
                            <span class="text-secondary">
                                No Pricing Requests To Show!
                            </span>
                            <a href="{{url('dashboard/pricing/requests/create')}}">Add Pricing Request</a>   
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!--Add New Message Fab Button-->
    <a href="{{url('dashboard/pricing/requests/create')}}" class="btn-fab btn-fab-md fab-right fab-right-bottom-fixed shadow btn-primary">
        <i class="icon-add">
        </i>
    </a>
</div>

<!-- Modal -->
@if (count($pricings) > 0)
    @foreach ($pricings as $pricing)
        <div class="modal fade" id="exampleModal-{{$pricing->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Delete Pricing Request</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    Are You Sure To Delete All Data about  {{$pricing->name}} pricing
                </div>
                <div class="modal-footer">
                    {!! Form::open(['action'=>['PricingRequestController@destroy', $pricing->id], 'method'=>'POST'])!!}
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