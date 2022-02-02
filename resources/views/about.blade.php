@include('inc.home.head_cover',['title' => trans('main.About Us')])
    
    <!-- Start home -->
    <section class="bg-half page-next-level"> 
        <div class="bg-overlay"></div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="text-center text-white">
                        <h4 class="text-uppercase title mb-4">{{trans('main.About Us')}}</h4>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end home -->

    <!-- ABOUT US START -->
    <section class="section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-5 col-md-4">
                    <img src="{{asset('assets/images/about.JPG')}}" class="img-fluid rounded shadow" alt="">
                </div>

                <div class="col-lg-7 col-md-8 about-text">
                    <div class="about-desc ml-lg-4">
                        
                        <h4 class="text-dark">{{trans('main.About Us')}}</h4>
                        <p class="text-muted">{{trans('main.Crossedlink')}} {{trans('main.aboutText')}}</p>
                        @if(auth()->check())
                        @else 
                            <a href="{{url('/register')}}" class="btn btn-primary">{{trans('main.Apply Now')}}</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ABOUT US END -->
    <!-- COUNTER START -->
    <section class="section bg-light d-none">
        <div class="container">
            <div class="blog-post-counter">
                <div class="row" id="counter">
                    <div class="col-md-3 col-6 border-right">
                        <div class="p-4">
                            <div class="blog-post counter-content text-center">
                                <h1 class="counter-value font-weight-light text-dark mb-2" data-count="{{count(Helper::JobsNames())}}">{{count(Helper::JobsNames())}}</h1>
                                <p class="counter-name text-muted f-15 text-uppercase mb-2">Jobs</p>
                                <i class="mdi mdi-account-multiple h3 text-muted"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-6 border-right">
                        <div class="p-4">
                            <div class="blog-post counter-content text-center">
                                <h1 class="counter-value font-weight-light text-dark mb-2" data-count="{{count(Helper::jobRequestsAll())}}">{{count(Helper::jobRequestsAll())}}</h1>
                                <p class="counter-name text-muted f-15 text-uppercase mb-2">Applications</p>
                                <i class="mdi mdi-file h3 text-muted"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-6 border-right">
                        <div class="p-4">
                            <div class="blog-post counter-content text-center">
                                <h1 class="counter-value font-weight-light text-dark mb-2" data-count="{{count(Helper::companies())}}">{{count(Helper::companies())}}</h1>
                                <p class="counter-name text-muted f-15 text-uppercase mb-2">Companies</p>
                                <i class="mdi mdi-bank h3 text-muted"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-6">
                        <div class="p-4">
                            <div class="blog-post counter-content text-center">
                                <h1 class="counter-value font-weight-light text-dark mb-2" data-count="{{count(Helper::employers())}}">{{count(Helper::employers())}}</h1>
                                <p class="counter-name text-muted f-15 text-uppercase mb-2">Employers</p>
                                <i class="mdi mdi-account-group h3 text-muted"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- COUNTER END -->
    <!-- COMPANY TESTIMONIAL START -->
    <section class="section d-none">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-5">
                    <h4 class="text-dark font-weight-">Company Testimonial</h4>
                    <div class="blog-post-border mt-3 mb-3"></div>
                    <h5 class="text-muted mb-1">International Compony</h5>
                    <p class="mb-4 f-16"><a href="" class="text-muted"><i class="mdi mdi-earth mr-2"></i>CrossLink.co.in</a></p>
                    <p class="text-muted f-14">Maecenas tempus tellus et condimentum that as rhoncus sem quam semper adipiscing sem neque sed ipsum Nam quam nunc blandit at luctus at id lorem maecenas nec odio et ante tincidunt tempus Donec vitae venenatis faucibus quis ante.</p>
                    <div class="job-details-desc-item">
                        <div class="float-left mr-3">
                            <i class="mdi mdi-minus text-muted f-16"></i>
                        </div>
                        <p class="text-muted f-14 mb-1">Aenean leo ligula porttitor eu consequat eleifend enim.</p>
                    </div>
                    <div class="job-details-desc-item">
                        <div class="float-left mr-3">
                            <i class="mdi mdi-minus text-muted f-16"></i>
                        </div>
                        <p class="text-muted f-14 mb-1">Quisque rutrum Aenean imperdiet nisi vel augue.</p>
                    </div>
                    <div class="job-details-desc-item mb-4">
                        <div class="float-left mr-3">
                            <i class="mdi mdi-minus text-muted f-16"></i>
                        </div>
                        <p class="text-muted f-14 mb-1">Maecenas tempus tellus sem semper libero.</p>
                    </div>
                    <ul class="list-inline pt-4 border-top mb-4">
                        <li class="list-inline-item">
                            <a href="#" class="btn btn-primary-outline">Learn More</a>
                        </li>
                        <li class="list-inline-item float-right mt-2">
                            <ul class="list-inline bolg-post-icon mb-0">
                                <li class="list-inline-item f-20"><a href="" class=""><i class="mdi mdi-facebook"></i></a></li>
                                <li class="list-inline-item f-20"><a href="" class=""><i class="mdi mdi-twitter"></i></a></li>
                                <li class="list-inline-item f-20"><a href="" class=""><i class="mdi mdi-whatsapp"></i></a></li>
                                <li class="list-inline-item f-20"><a href="" class=""><i class="mdi mdi-instagram"></i></a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
                
            </div>
        </div>
    </section>
    <!-- COMPANY TESTIMONIAL START -->
    <!-- DOWNLOAD APP START -->
    <section class="section pb-0 d-none" style="background: url('{{asset('assets/images/about.jpg')}}') top center;background-size: 100% 120%;">
        <div class="bg-overlay"></div>
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 order-md-1 order-2">
                    <div class="job-about-app-img mt-40">
                        <img src="{{asset('assets/images/app-download-img.png')}}" alt="" class="img-fluid mx-auto d-block">
                    </div>
                </div>
                <div class="col-md-6 order-md-2 order-1">
                    <div class="app-about-content">
                        <div class="app-about-desc text-white">
                            <h4 class="text-white mb-3">Get Job App For Your Mobile</h4>
                            <p class="font-weight-light text-white-50">Etiam ultricies nisi vel that augue Curabitur ullamcorper ultricies adipiscing Nam at Etiam rhoncus Maecenas tempus tellus rhoncus ultricies eget condimentum rhoncus massa Sed cursus semquam.</p>
                            <ul class="list-unstyled mb-0">
                                <li class="list-inline-item"><a href="javascript:void(0)"><img src="{{asset('assets/images/apple.png')}}" class="mt-2" height="60" alt=""></a></li>
                                <li class="list-inline-item"><a href="javascript:void(0)"><img src="{{asset('assets/images/google.png')}}" class="mt-2" height="60" alt=""></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- DOWNLOAD APP END -->
    <!-- ABOUT CLIENTS START -->
    <section class="section d-none">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="section-title text-center mb-4 pb-2">
                        <h4 class="title title-line pb-5">Our Client's</h4>
                        <p class="text-muted para-desc mx-auto mb-1">Post a job to tell us about your project. We'll quickly match you with the right artisans.</p>
                    </div>
                </div>
            </div>
            <div class="row align-items-center">
                <div class="col-lg-2 col-md-4 col-6 mt-4 pt-2 text-center">
                    <img src="{{asset('assets/images/clients/1.png')}}" height="50" alt="">
                </div><!--end col-->
                <div class="col-lg-2 col-md-4 col-6 mt-4 pt-2 text-center">
                    <img src="{{asset('assets/images/clients/2.png')}}" height="50" alt="">
                </div><!--end col-->
                <div class="col-lg-2 col-md-4 col-6 mt-4 pt-2 text-center">
                    <img src="{{asset('assets/images/clients/3.png')}}" height="50" alt="">
                </div><!--end col-->
                <div class="col-lg-2 col-md-4 col-6 mt-4 pt-2 text-center">
                    <img src="{{asset('assets/images/clients/4.png')}}" height="50" alt="">
                </div><!--end col-->
                <div class="col-lg-2 col-md-4 col-6 mt-4 pt-2 text-center">
                    <img src="{{asset('assets/images/clients/1.png')}}" height="50" alt="">
                </div><!--end col-->
                <div class="col-lg-2 col-md-4 col-6 mt-4 pt-2 text-center">
                    <img src="{{asset('assets/images/clients/2.png')}}" height="50" alt="">
                </div><!--end col-->
            </div>
        </div>
    </section>
    <!-- ABOUT CLIENTS END -->
    @include('inc.home.foot')
    @include('inc.home.scripts')
    <script src="{{asset('assets/js/counter.int.js')}}"></script>
    </body>
    </html>