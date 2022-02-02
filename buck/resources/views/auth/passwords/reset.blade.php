@include('inc.home.head_cover', ['title' => trans('main.Reset Password')])
 
    <!-- Start home -->
    <section class="bg-half page-next-level p-150"> 
        <div class="bg-overlay"></div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="text-center text-white">
                        <h4 class="text-uppercase title mb-4">{{trans('main.Reset Password')}}</h4>
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
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Reset Password') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf
                        <div class="form-group row my-2">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ trans('main.Email') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row my-2">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ trans('main.New Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row my-2">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ trans('main.Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0 my-2">
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
</div>
@include('inc.home.foot')
@include('inc.home.scripts')
</body>
</html>
