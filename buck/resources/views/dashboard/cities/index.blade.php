@include('inc.header')


<div class="page  has-sidebar-left height-full company-list">
    <header class="blue accent-3 relative">
        <div class="container-fluid text-white">
            <div class="row p-t-b-10 ">
                <div class="col">
                    <h4>
                        <i class="icon-database"></i>
                        Cities
                    </h4>
                </div>
            </div>
            <div class="row justify-content-between">
                <ul class="nav nav-material nav-material-white responsive-tab" id="v-pills-tab" role="tablist">
                    <li>
                        <a class="nav-link active"  href="{{url('dashboard/cities')}}"
                           role="tab" aria-controls="v-pills-all"><i class="icon icon-home2"></i>All Cities</a>
                    </li>
                    <li class="float-right">
                        <a class="nav-link"  href="{{url('dashboard/cities/create')}}" ><i class="icon icon-plus-circle"></i> Add New city</a>
                    </li>
                    <li class="float-right search-li">
                        {!! Form::open(['action'=>'CityController@search', 'method'=>'GET', 'enctype' =>'multipart/form-data', ' novalidate', 'class' => 'needs-validation d-block'])!!}
                        {!! Form::text('search', $search,  ['class' => "form-control r-0 light s-12 d-inline-block w-50", 'placeholder' => 'Serach ...'])!!}
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
                        @if (count($cities) > 0)
                            <div class="card r-0 shadow">
                                <div class="table-responsive">
                                    <form>
                                    
                                        <table class="table table-striped table-hover r-0">
                                            <thead>
                                            <tr class="no-b">
                                                <th>City Name</th>
                                                <th>Country Name</th>
                                                <!--<th>Role</th>-->
                                                <th>Settings</th>
                                            </tr>
                                            </thead>
                                            
                                            <tbody>
                                                
                                                    @foreach ($cities as $city)
                                                    <tr>
                                                        <td>
                                                            <a href="{{url('dashboard/cities/'.$city->id.'/edit')}}">
                                                                {{ $city->name}}
                                                            </a>
                                                        </td>
                                                    <td>{{ Helper::getCountryByID($city->country_id)}}</td>

                                                       

                                                        <td>
                                                            {{--<a href="{{url('dashboard/cities/'. $city->id)}}" class="btn-fab btn-fab-sm btn-warning shadow text-white"><i class="icon-eye mr-3"></i></a>--}}
                                                            <a href="{{url('dashboard/cities/'.$city->id.'/edit')}}" class="btn-fab btn-fab-sm btn-primary shadow text-white"><i class="icon-pencil"></i></a>
                                                            <button type="button" class="btn-fab btn-fab-sm btn-danger shadow text-white" data-toggle="modal" data-target="#exampleModal-{{$city->id}}">
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
                                        {{ $cities->links() }}
                                    </nav>
                                </div>
                            </div>
                        @else 
                            <div class="bg-white p-4">
                                <span class="text-secondary">
                                    No Cities To Show!
                                </span>
                                <a href="{{url('dashboard/cities/create')}}">Add City</a>   
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Add New Message Fab Button-->
    <a href="{{url('dashboard/cities/create')}}" class="btn-fab btn-fab-md fab-right fab-right-bottom-fixed shadow btn-primary">
        <i class="icon-add">
        </i>
    </a>
</div>

<!-- Modal -->
@if (count($cities) > 0)
    @foreach ($cities as $city)
        <div class="modal fade" id="exampleModal-{{$city->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Delete City</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    Are You Sure To Delete All Data about  {{$city->name}} city
                </div>
                <div class="modal-footer">
                    {!! Form::open(['action'=>['CityController@destroy', $city->id], 'method'=>'POST'])!!}
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