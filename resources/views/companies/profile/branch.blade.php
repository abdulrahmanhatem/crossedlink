@include('inc.home.head', ['title' => trans('main.Branches')]))

<section class="section p-150">
    <div class="container">
     <a href="{{ url('/') }}" class="text-muted">{{trans('main.Home')}}</a> / <a href="{{ url('myPackage') }}" class="text-primary">{{trans('main.Branches')}}</a>
    </div>
</section>

    <div class="worker-profile">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-12 my-4">
                    <div class="left-sidebar ">
                        <ul class="nav nav-pills nav nav-pills bg-white rounded" id="pills-tab" role="tablist">
                            <li class="nav-item d-block col-12">
                                <a class="nav-link" id="general-tab"  href="{{ url('profiles/'.$user->id.'/edit') }}">{{trans('main.General Information')}}</a>
                            </li>
                            <li class="nav-item d-block col-12">
                                <a class="nav-link active" id="branch-tab"  href="{{ url('profiles/'.$user->id.'/edit/branch') }}">{{trans('main.Branches')}}</a>
                            </li>
                            <li class="nav-item d-block col-12">
                                <a class="nav-link " id="package-tab" href="{{ url('myPackage') }}">{{trans('main.Subscribed Package')}}</a>
                            </li>
                            <li class="nav-item d-block col-12">
                                <a class="nav-link" id="unblock-tab"  href="{{ url('unlock') }}" >{{trans('main.Unblock List')}}({{ count(Helper::unblockList(auth()->user()->id)) }})</a>
                            </li>
                            <li class="nav-item d-block col-12">
                                <a class="nav-link" id="unblock-tab"  href="{{ url('favorite') }}" >{{trans('main.Saved List')}}({{ count(Helper::favList(auth()->user()->id)) }})</a>
                            </li>
                            <li class="nav-item d-block col-12 ">
                                <a class="nav-link"  href="{{ url('chat') }}">{{trans('main.Chat')}}</a>
                            </li>
                        </ul>
                    </div>
                </div>
        
                <div class="col-lg-9 col-md-12 profile-edit no-shadow">
                    <div class="tab-content mt-2" id="pills-tabContent">
                        <div class="tab-pane fade show active general">
                            <div class="row">
                                @if (count($user->branches) > 0)
                            
                                @foreach ($user->branches as $branch)
                                    <div class="text-left text-muted position-relative w-50 d-inline-block branch-view">
                                        <div class="dropdown position-absolute options-dropdown" style="top:0">
                                            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="far fa-ellipsis-v"></i>
                                            </a>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                              <a class="dropdown-item text-muted" data-toggle="modal" data-target="#branch-{{ $branch->id }}">{{trans('main.Edit')}}</a>
                                              <a class="dropdown-item text-muted" data-toggle="modal" data-target="#branch-{{ $branch->id }}-delete">{{trans('main.Delete')}}</a>
                                            </div>
                                        </div>
                                        <span class="mb-0 degree text-dark"><h6 class="mb-0">{{ $branch->name }} at {{ $branch->address }}</h6></span>
                                        
                                        
                                    </div>
                                    <div class="modal fade" id="branch-{{ $branch->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">{{$branch->job_title}} {{trans('main.Branch')}}</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                                </div>
                                                {!! Form::open(['action'=> ['ProfileController@update', $user->id], 'method'=>'POST', 'enctype' =>'multipart/form-data', 'class' => 'w-100'])!!}
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="row mt-1">
                                                                    <div class="form-group col-6 m-0">
                                                                        {!! Form::label('name', trans('main.Branch Name') . '<span class="valid-star">*</span>', ['class' => 'col-form-label s-12'], false) !!}
                                                                        {!! Form::text('name', $branch->name,  ['class' => "form-control r-0 light s-12", 'placeholder' => trans('main.Branch Name'), 'id' => 'name'])!!}
                                                                        <div class="valid-feedback">
                                                                            {{trans('main.Looks Good')}}
                                                                        </div>
                                                                        <div class="invalid-feedback">
                                                                            {{trans('main.Please Provide a Valid Input')}}
                                                                        </div>
                                                                    </div>
                                                                    <div class="group col-6 m-0">
                                                                        {!! Form::label('address', trans('main.Branch Address') . '<span class="valid-star">*</span>', ['class' => 'col-form-label s-12'], false) !!}
                                                                        {!! Form::text('address', $branch->address,  ['id' => 'middle_name', 'class' => "form-control r-0 light s-12", 'placeholder' => trans('main.Branch Address'), 'id' => 'address'])!!}
                                                                        <div class="valid-feedback">
                                                                            {{trans('main.Looks Good')}}
                                                                        </div>
                                                                        <div class="invalid-feedback">
                                                                            {{trans('main.Please Provide a Valid Input')}}
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{trans('main.Close')}}</button>
                                                        {!! Form::submit(trans('main.Edit'), ['class' => "btn btn-primary", 'name' => 'edit-branch']) !!}
                                                        {!! Form::text('branch_id', $branch->id, ['hidden']) !!}
                                                        {!! Form::hidden('_method', 'PUT') !!}
                                                    </div>
                                                {!! Form::close() !!}
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Delete Modal -->
                                    <div class="modal fade" id="branch-{{ $branch->id }}-delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">{{trans('main.Delete Branch')}}</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            {!! Form::open(['action'=> ['ProfileController@update', $user->id], 'method'=>'POST', 'enctype' =>'multipart/form-data', 'class' => 'w-100'])!!}
                                                <div class="modal-body">
                                                    {{trans('main.Are You Sure About Deleting')}} {{ $branch->name }} {{trans('main.Branch')}}?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{trans('main.Close')}}</button>
                                                    {!! Form::submit(trans('main.Delete'), ['class' => "btn btn-primary", 'name' => 'delete-branch']) !!}
                                                </div>
                                            {!! Form::text('branch_id', $branch->id, ['hidden']) !!}
                                            {!! Form::hidden('_method', 'PUT') !!}
                                            {!! Form::close() !!}
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif

                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    {!! Form::open(['action'=> 'ProfileController@store', 'method'=>'POST', 'enctype' =>'multipart/form-data', 'class' => 'w-100'])!!}
                                    <h5 class="mt-4">{{trans('main.New Branch')}}</h5>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="row mt-1">
                                                <div class="form-group col-4 m-0">
                                                    {!! Form::label('name', trans('main.Branch Name') . '<span class="valid-star">*</span>',['class' => 'col-form-label s-12'], false) !!}
                                                    {!! Form::text('name', '',  ['class' => "form-control r-0 light s-12", 'placeholder' => trans('main.Branch Name'), 'id' => 'name'])!!}
                                                    <div class="valid-feedback">
                                                        {{trans('main.Looks Good')}}
                                                    </div>
                                                    <div class="invalid-feedback">
                                                        {{trans('main.Please Provide a Valid Input')}}
                                                    </div>
                                                </div>
                                                <div class="group col-4 m-0">
                                                    {!! Form::label('address', trans('main.Branch Address') . '<span class="valid-star">*</span>', ['class' => 'col-form-label s-12'], false) !!}
                                                    {!! Form::text('address', '',  ['id' => 'middle_name', 'class' => "form-control r-0 light s-12", 'placeholder' => trans('main.Branch Address') , 'id' => 'address'])!!}
                                                    <div class="valid-feedback">
                                                        {{trans('main.Looks Good')}}
                                                    </div>
                                                    <div class="invalid-feedback">
                                                        {{trans('main.Please Provide a Valid Input')}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                {!! Form::submit(trans('main.Add'), ['class' => "btn btn-primary mt-2 btn-sm", 'name' => 'create-branch']) !!}
                                {!! Form::close() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>   
        </div>
    </div>

    @include('inc.home.foot')
    @include('inc.home.scripts')
    <script>
        // Date Picker 
        $("#date-picker").flatpickr();
    </script>
</body>
</html>