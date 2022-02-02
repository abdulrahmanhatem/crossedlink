@include('inc.home.head_cover',['title' => trans('main.Services')])

    <!-- SERVICE START -->
    <section class="section py-4">
        <div class="container">
            <div class="section-title text-center mb-4 pb-2">
                <h4 class="title title-line pb-5">{{trans('main.Services')}}</h4>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-6 mb-4 pb-2">
                    <div class="services-box">
                        <div class="service-icon mb-3">
                            <i class="mdi mdi-account-multiple h1"></i>
                        </div>
                        <div class="services-desc">
                            <h5 class="mb-2"><a  class="text-dark">{{trans('main.Safe Communication')}}</a></h5>
                            <p class="text-muted mb-0">{{trans('main.Communicate safely with potential matches knowing that your identity is protected through our system.')}}</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 mb-4 pb-2">
                    <div class="services-box">
                        <div class="service-icon mb-3">
                            <i class="mdi mdi-image-filter-tilt-shift h1"></i>
                        </div>
                        <div class="services-desc">
                            <h5 class="mb-2"><a  class="text-dark">{{trans('main.Organize your candidates')}}</a></h5>
                            <p class="text-muted mb-0">{{trans('main.View and sort resumes, send messages, and schedule interviews—all on CrossedLink.')}}</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 mb-4 pb-2">
                    <div class="services-box">
                        <div class="service-icon mb-3">
                            <i class="mdi mdi-account-network h1"></i>
                        </div>
                        <div class="services-desc">
                            <h5 class="mb-2"><a class="text-dark">{{trans('main.Find quality applicants')}}</a></h5>
                            <p class="text-muted mb-0">{{trans('main.List your required experience for the job so relevant candidates apply.')}}</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 mb-4 pb-2">
                    <div class="services-box">
                        <div class="service-icon mb-3">
                            <i class="mdi mdi-invert-colors h1"></i>
                        </div>
                        <div class="services-desc">
                            <h5 class="mb-2"><a  class="text-dark">{{trans('main.Get more visibility')}}</a></h5>
                            <p class="text-muted mb-0">{{trans('main.Sponsor your job to ensure it gets seen by the right people, and To Be seen First.')}}</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 mb-4 pb-2">
                    <div class="services-box">
                        <div class="service-icon mb-3">
                            <i class="mdi mdi-check h1"></i>
                        </div>
                        <div class="services-desc">
                            <h5 class="mb-2"><a  class="text-dark">{{trans('main.Applying Fast')}}</a></h5>
                            <p class="text-muted mb-0">{{trans('main.Once You Complete your profile you can apply to your dream job fast through our amazing filter')}}</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 mb-4 pb-2">
                    <div class="services-box">
                        <div class="service-icon mb-3">
                            <i class="mdi mdi-image-filter-center-focus h1"></i>
                        </div>
                        <div class="services-desc">
                            <h5 class="mb-2"><a  class="text-dark">{{trans('main.Verify their abilities')}}</a></h5>
                            <p class="text-muted mb-0">{{trans('main.You Can verify their experiences and education by visiting a reference.')}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- SERVICE END -->

    <!-- SERVICE INFORMATION START -->
    <section class="section bg-light py-4">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="section-title text-center mb-4 pb-2">
                        <h4 class="title title-line pb-5">{{trans('main.Service Information')}}</h4>
                        <p class="text-muted para-desc mx-auto mb-1">{{trans('main.Post a job to tell us about your project. We will quickly match you with the right artisans.')}}</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="row">
                        <div class="col-md-6 mt-4 pt-2">
                            <a >
                                <div class="service-info-img position-relative d-block overflow-hidden">
                                    <img src="{{asset('assets/images/services/1.jpg')}}" alt="" class="img-fluid mx-auto d-block rounded">
                                    <div class="service-overlay">
                                        <div class="service-info text-center">
                                            <h6 class="mb-0 text-white shadow title">{{trans('main.Barista')}}</h6>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-6 mt-4 pt-2">
                            <a >
                                <div class="service-info-img position-relative d-block overflow-hidden">
                                    <img src="{{asset('assets/images/header-2.jpg')}}" alt="" class="img-fluid mx-auto d-block rounded">
                                    <div class="service-overlay">
                                        <div class="service-info text-center">
                                            <h6 class="mb-0 text-white shadow title">{{trans('main.House Keeper')}}</h6>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mt-4 pt-2">
                            <a >
                                <div class="service-info-img position-relative d-block overflow-hidden">
                                    <img src="{{asset('assets/images/header-3.jpg')}}" alt="" class="img-fluid mx-auto d-block rounded">
                                    <div class="service-overlay">
                                        <div class="service-info text-center">
                                            <h6 class="mb-0 text-white shadow title">{{trans('main.Waiter')}}</h6>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-6 mt-4 pt-2">
                            <a >
                                <div class="service-info-img position-relative d-block overflow-hidden">
                                    <img src="{{asset('assets/images/services/4.jpg')}}" alt="" class="img-fluid mx-auto d-block rounded">
                                    <div class="service-overlay">
                                        <div class="service-info text-center">
                                            <h6 class="mb-0 text-white shadow title">{{trans('main.Technician')}}</h6>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 mt-4 pt-2 service-text">
                    <p class="text-muted mb-2">{{trans('main.CrossedLink provide all the support you need to find, hire and pay people safely and securely. It takes the hassle and cost out of hiring. Leaving you to focus on more important matters.')}}</p>
                </div>
            </div>
        </div>
    </section>
    <!-- SERVICE INFORMATION END -->

    @include('inc.home.foot')
    @include('inc.home.scripts')
    </body>
</html>