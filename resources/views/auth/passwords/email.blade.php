@include('inc.home.head_cover', ['title' => trans('main.Email')])

<!-- Start home -->
    <section class="bg-half page-next-level p-150"> 
        <div class="bg-overlay"></div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="text-center text-white">
                        <h4 class="text-uppercase title mb-4">{{trans('main.Email')}}</h4>
                        <!--<ul class="page-next d-inline-block mb-0">
                            <li>
                                <a href="about.html" class="text-uppercase font-weight-bold">About</a>
                            </li>
                        </ul>-->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end home -->
 
    <section class="section  bread-crumbs">
        <div class="container">
        <a href="{{ url('/') }}" class="text-muted">{{trans('main.Home')}}</a> / <a href="{{ url('password/reset') }}" class="text-primary">{{trans('main.Email')}}</a>
        </div>
    </section>
<section class="container pb-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ trans('main.Reset Password') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ trans('main.Email') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row my-3">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ trans('main.Reset Password') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@include('inc.home.foot')
@include('inc.home.scripts')
</body>
</html>
