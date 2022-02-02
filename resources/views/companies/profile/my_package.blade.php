@include('inc.home.head', ['title' => trans('main.The Package')]))

<section class="section p-150">
    <div class="container">
     <a href="{{ url('/') }}" class="text-muted">{{trans('main.Home')}}</a> / <a href="{{ url('myPackage') }}" class="text-primary">{{trans('main.The Package')}}</a>
    </div>
</section>

    <div class="worker-profile my-package">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-12 my-4">
                    <div class="left-sidebar ">
                        <ul class="nav nav-pills nav nav-pills bg-white rounded" id="pills-tab" role="tablist">
                            <li class="nav-item d-block col-12">
                                <a class="nav-link" id="general-tab"  href="{{ url('profiles/'.$user->id.'/edit') }}">{{trans('main.General Information')}}</a>
                            </li>
                            @if (auth()->user()->role == 2)
                                <li class="nav-item d-block col-12">
                                    <a class="nav-link" id="branch-tab"  href="{{ url('profiles/'.$user->id.'/edit/branch') }}">{{trans('main.Branches')}}</a>
                                </li>
                            @endif
                            <li class="nav-item d-block col-12">
                                <a class="nav-link active" id="package-tab" href="{{ url('myPackage') }}">{{trans('main.Subscribed Package')}}</a>
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
                                @if(count(Helper::myPackage()) > 0)
                                    <h5 class="text-muted mt-5">{{trans('main.Packages')}}</h5>
                                    @foreach (Helper::myPackage() as $package)
                                        <table class="table package-table">
                                            <thead>
                                            <tr>
                                                <th scope="col">{{trans('main.Name')}}</th>
                                                <th scope="col">{{trans('main.Price')}}</th>
                                                <th scope="col">{{trans('main.Unblock Profiles')}}</th>
                                                <th scope="col">{{trans('main.Jobs')}}</th>
                                                <th scope="col">{{trans('main.Start Date')}}</th>
                                                <th scope="col">{{trans('main.Expired Date')}}</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td>{{ $package->name }}</td> 
                                                <td>{{ $package->price }}</td>
                                                <td><span class="text-primary font-weight-bold d-inline-block ">{{ $package->profiles - $pricing->profiles  }}</span>/{{ $package->profiles }}</td>
                                                <td><span class="text-primary font-weight-bold d-inline-block ">{{ $package->ads - $pricing->ads  }}</span>/{{ $package->ads }}</td>
                                                <td>{{ $pricing->start_date }}</td>
                                                <td>{{ $pricing->expired_date }}</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    @endforeach
                                @else  
                                    <h6 class="my-5 text-center w-100 ">{{trans('main.No Subscribed Package! Take a look On Our')}} <a href= "{{ url('packages') }}">{{trans('main.Packages')}}</a></h6>
                                @endif

                            </div>

                            <div class="row">
                                <div class="col-sm-12">
                                    @if(count($myExtentions) > 0)
                                        @foreach ($myExtentions as $ex)
                                        @if(count(Helper::myExtentions()) > 0)
                                            @foreach (Helper::myExtentions() as $package)
                                                @if ($package->id == $ex->package_id)
                                                    @if ($ex->role == 4)
                                                        <h5 class="text-muted my-4">{{trans('main.Profile Addons')}}</h5>
                                                    @elseif($ex->role == 3)
                                                        <h5 class="text-muted my-4">{{trans('main.Job Addons')}}</h5>
                                                    @endif
                                                    <table class="table package-table">
                                                        <thead>
                                                        <tr>
                                                            <th scope="col">{{trans('main.Name')}}</th>
                                                            <th scope="col">{{trans('main.Price')}}</th>
                                                            @if ($ex->role == 4)
                                                                <th scope="col">{{trans('main.Unblock Profiles')}}</th>
                                                            @endif
                                                            @if ($ex->role == 3)
                                                                <th scope="col">{{trans('main.Jobs')}}</th>
                                                            @endif
                                                            <th scope="col">{{trans('main.Start Date')}}</th>
                                                            <th scope="col">{{trans('main.Expired Date')}}</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <tr>
                                                            <td>{{ $package->name }}</td> 
                                                            <td>{{ $package->price }}</td>
                                                            @if ($ex->role == 4)
                                                                <td><span class="text-primary font-weight-bold d-inline-block ">{{ $package->profiles - $ex->profiles  }}</span>/{{ $package->profiles }}</td>
                                                            @endif
                                                            @if ($ex->role == 3)
                                                                <td><span class="text-primary font-weight-bold d-inline-block ">{{ $package->ads - $ex->ads  }}</span>/{{ $package->ads }}</td>
                                                            @endif
                                                            <td>{{ $pricing->start_date }}</td>
                                                            <td>{{ $pricing->expired_date }}</td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                @endif
                                                
                                            @endforeach
                                        @else  
                                            <h6 class="my-5 text-center w-100 ">{{trans('main.No Added Addons! Take a look On Our')}} <a href= "{{ url('packages') }}">{{trans('main.Addons')}}</a></h6>
                                        @endif
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>   
        </div>
    </div>

    <!-- POST A JOB START -->
    
    <!-- POST A JOB END -->


    @include('inc.home.foot')
    @include('inc.home.scripts')
    <script>
        // Date Picker 
        $("#date-picker").flatpickr();
    </script>
</body>
</html>