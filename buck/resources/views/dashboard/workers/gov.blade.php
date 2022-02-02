@include('inc.header')


<div class="page  has-sidebar-left height-full company-list">
    <header class="blue accent-3 relative">
        <div class="container-fluid text-white">
            <div class="row p-t-b-10 ">
                <div class="col">
                    <h4>
                        <i class="icon-database"></i>
                        Government IDs
                    </h4>
                </div>
            </div>
            <div class="row justify-content-between">
                <ul class="nav nav-material nav-material-white responsive-tab" id="v-pills-tab" role="tablist">
                    <li>
                        <a class="nav-link active" id="v-pills-all-tab" data-toggle="pill" href="{{url('dashboard/govIDs')}}"
                           role="tab" aria-controls="v-pills-all"><i class="icon icon-home2"></i>Government IDs</a>
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
                                                <th>Nationality</th>
                                                <th>Gov ID</th>
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

                                                        <td>{{ Helper::nationalityByKey($user->nationality) }}</td>

                                                    <td><a class="btn btn-success btn-sm" data-toggle="modal" data-target="#gov_id-{{$user->id}}">Show</a> </td>

                                                        {{--<td>
                                                            
                                                            <a href="{{url('dashboard/workers/'. $user->id)}}" class="btn-fab btn-fab-sm btn-warning shadow text-white"><i class="icon-eye mr-3"></i></a>
                                                            <a href="{{url('dashboard/workers/'.$user->id.'/edit')}}" class="btn-fab btn-fab-sm btn-primary shadow text-white"><i class="icon-pencil"></i></a>
                                                            <!-- Button trigger modal -->
                                                            <button type="button" class="btn-fab btn-fab-sm btn-danger shadow text-white" data-toggle="modal" data-target="#exampleModal-{{$user->id}}">
                                                                <i class="icon-times"></i>
                                                            </button>
                                                        </td>--}}
                                                    </tr>
                                                    @endforeach
                                            </tbody>
                                        </table>
                                    </form>
                                </div>
                            </div>
                        @else
                            <div class="bg-white p-4 pb-5">
                                <span class="text-secondary p">
                                    No Pending IDs To Show!
                                </span>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
   
</div>

<!-- Modal -->
@if (count($workers) > 0)
    @foreach ($workers as $user)
      <!-- Governemt ID Veification Modal -->
    <div class="modal modal-view fade" id="gov_id-{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5>Government ID</h5>
                    </div>
                    <div class="modal-body">
                        <div class="form-group app-label mt-2">
                            {!! Form::open(['action'=> ['WorkerController@update', $user->id], 'method'=>'POST', 'enctype' =>'multipart/form-data' ])!!}
                            <div class="">
                                @if ($user->gov_id == 'verified')
                                    <i class="fal fa-badge-check"></i>
                                    Verified
                                @else 
                                    <img src="{{ asset('uploads/images/gov_id/'.$user->gov_id) }}" alt="" class="d-block m-auto">
                                @endif
                            </div>
                            <div class="row">
                                <div class="col-lg-12 mt-2">
                                    {!! Form::submit('Verify Worker', ['class' => "btn btn-primary mt-2 btn-sm", 'name' => 'verify-gov_id']) !!}
                                    {!! Form::submit('Reject', ['class' => "btn btn-danger mt-2 btn-sm", 'name' => 'reject-gov_id']) !!}
                                </div>
                            </div>
                            {!! Form::hidden('_method', 'PUT') !!}
                            {!! Form::close() !!}
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endif
@include('inc.foot')