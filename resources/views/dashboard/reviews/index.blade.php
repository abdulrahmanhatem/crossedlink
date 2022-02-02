@include('inc.header')


<div class="page  has-sidebar-left height-full company-list">
    <header class="blue accent-3 relative">
        <div class="container-fluid text-white">
            <div class="row p-t-b-10 ">
                <div class="col">
                    <h4>
                        <i class="icon-database"></i>
                        Reviews
                    </h4>
                </div>
            </div>
            <div class="row justify-content-between">
                <ul class="nav nav-material nav-material-white responsive-tab" id="v-pills-tab" role="tablist">
                    <li>
                        <a class="nav-link active"  href="{{url('dashboard/reviews')}}"
                           role="tab" aria-controls="v-pills-all"><i class="icon icon-home2"></i>All Reviews </a>
                    </li>
                    <li class="float-right">
                        <a class="nav-link"  href="{{url('dashboard/reviews/create')}}" ><i class="icon icon-plus-circle"></i> Add New Review </a>
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
                        @if (count($reviews) > 0)
                            <div class="card r-0 shadow">
                                <div class="table-responsive">
                                    <form>
                                        <table class="table table-striped table-hover r-0">
                                            <thead>
                                            <tr class="no-b">
                                                <th>From</th>
                                                <th>To</th>
                                                <th>Ratings</th>
                                                <th>Settings</th>
                                            </tr>
                                            </thead>

                                            <tbody>
                                                    @foreach ($reviews as $review)
                                                    <tr>
                                                        <td>
                                                            @foreach ( Helper::userByID($review->from_id) as $worker)
                                                                {{ $worker->name }}
                                                            @endforeach
                                                            </td>
                                                        <td>
                                                            @foreach ( Helper::userByID($review->to_id) as $employer)
                                                                @if (empty($employer->company_name))
                                                                    {{ $employer->name }}
                                                                @else
                                                                    {{ $employer->company_name }}
                                                                @endif
                                                            @endforeach
                                                        </td>

                                                        <td>{{Helper::ratingByKey($review->rating)}}</td>

                                                        <td>
                                                            {{--<a href="{{url('dashboard/reviews/'. $review->id)}}" class="btn-fab btn-fab-sm btn-warning shadow text-white"><i class="icon-eye mr-3"></i></a>--}}
                                                            <a href="{{url('dashboard/reviews/'.$review->id.'/edit')}}" class="btn-fab btn-fab-sm btn-primary shadow text-white"><i class="icon-pencil"></i></a>
                                                            <button type="button" class="btn-fab btn-fab-sm btn-danger shadow text-white" data-toggle="modal" data-target="#exampleModal-{{$review->id}}">
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
                                No Reviews To Show!
                            </span>
                            <a href="{{url('dashboard/reviews/create')}}">Add Review</a>   
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Add New Message Fab Button-->
    <a href="{{url('dashboard/reviews/create')}}" class="btn-fab btn-fab-md fab-right fab-right-bottom-fixed shadow btn-primary">
        <i class="icon-add">
        </i>
    </a>
</div>

<!-- Modal -->
@if (count($reviews) > 0)
    @foreach ($reviews as $review)
        <div class="modal fade" id="exampleModal-{{$review->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Delete Review</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    Are You Sure To Delete All Data about review {{$review->name}}
                </div>
                <div class="modal-footer">
                    {!! Form::open(['action'=>['ReviewController@destroy', $review->id], 'method'=>'POST'])!!}
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