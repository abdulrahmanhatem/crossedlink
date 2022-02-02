
<!-- footer start -->
<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-12 mb-0 mb-md-4 pb-0 pb-md-2">
            <a href="{{url('/')}}" ><img src="{{asset('assets/images/logo-light.png')}}" height="40" alt=""></a>
            <p class="mt-4">{{trans('main.You can find CrossdLink Community on social media and share your ideas with us')}}</p>
                <ul class="social-icon social list-inline mb-0">
                    <li class="list-inline-item"><a href="https://www.facebook.com/Crossedlink-104211824659145/" target="_blank" class="rounded"><i class="mdi mdi-facebook"></i></a></li>
                    <li class="list-inline-item"><a href="https://twitter.com/Crossedlink1" target="_blank" class="rounded"><i class="mdi mdi-twitter"></i></a></li>
                    <li class="list-inline-item"><a href="https://www.instagram.com/crossedlink" target="_blank" class="rounded"><i class="mdi mdi-instagram"></i></a></li>
                </ul>
            </div>
            <div class="col-lg-3 col-md-4 col-6 mt-4 mt-sm-0 pt-2 pt-sm-0">
                <p class="text-white mb-4 footer-list-title">{{trans('main.The Company')}}</p>
                <ul class="list-unstyled footer-list">
                    <li><a href="{{url('about')}}" class="text-foot"><i class="mdi mdi-chevron-right"></i> {{trans('main.About Us')}}</a></li>
                    @if (Config::get('app.locale') == 'ar')
                        <li><a href="{{ url('/خدمة-معروفة')}}" class="text-foot"><i class="mdi mdi-chevron-right"></i> خدمة معروفة</a></li>
                    @endif
                    @if (auth()->check() )
                        @if (auth()->user()->role > 0)
                            <li><a href="{{url('packages')}}" class="text-foot"><i class="mdi mdi-chevron-right"></i> {{trans('main.Pricing')}}</a></li>
                        @endif
                    @endif
                </ul>
            </div>
            <div class="col-lg-3 col-md-4 col-6 mt-4 mt-sm-0 pt-2 pt-sm-0">
                <p class="text-white mb-4 footer-list-title">{{trans('main.Resources')}}</p>
                <ul class="list-unstyled footer-list">
                    <li><a href="{{url('policy')}}" class="text-foot"><i class="mdi mdi-chevron-right"></i> {{trans('main.Privacy Policy')}}</a></li>
                </ul>
            </div>
        
            <div class="col-lg-3 col-md-4 col-12 mt-4 mt-sm-0 pt-2 pt-sm-0">
                <p class="text-white mb-4 footer-list-title f-17">{{trans('main.Business Hours')}}</p>
                <ul class="list-unstyled text-foot mt-4 mb-0">
                    <li>{{trans('main.Saturday')}} - {{trans('main.Wednesday')}} : 9:00 {{trans('main.to')}} 18:00</li>
                    <li class="mt-2">{{trans('main.Thursday')}} : 10:00  {{trans('main.to')}}  15:00</li>
                    <li class="mt-2">{{trans('main.Friday')}} : {{trans('main.Day Off')}} ({{trans('main.Holiday')}})</li>
                </ul>
            </div>
        </div>
    </div>
</footer>
<!-- footer end -->
<hr>
<footer class="footer footer-bar">
    <div class="container text-center">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="">
                    <p class="mb-0">© 2020 - 2021 CrossedLink. Powered By CCIT</p>
                </div>
            </div>
        </div>
    </div><!--end container-->
</footer><!--end footer-->
<!-- Footer End -->

<!-- Back to top -->
<a href="#" class="back-to-top rounded text-center" id="back-to-top"> 
    <i class="mdi mdi-chevron-up d-block"> </i> 
</a>
<!-- Back to top -->

<!-- javascript -->

