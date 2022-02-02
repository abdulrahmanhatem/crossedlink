@include('inc.home.head_cover',['title' => trans('main.Contact')])
    
    <!-- Start home -->
    <section class="bg-half page-next-level"> 
        <div class="bg-overlay"></div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="text-center text-white">
                    <h4 class="text-uppercase title mb-4">{{trans('main.Contact Us')}}</h4>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end home -->

    <!-- MAP START -->
    <section class="section py-2 bg-light">
        <div class="container-fluid d-none">
            <div class="row">
                <div class="col-lg-12 p-0">
                    <div class="map">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m10!1m8!1m3!1d6030.91876594061!2d-111.34563870463673!3d26.01036670629853!3m2!1i1024!2i768!4f13.1!5e0!3m2!1ses-419!2smx!4v1471908546569" style="border: 0" allowfullscreen></iframe>
                    </div>
                </div>
            </div>
        </div>
        <div class="container py-4 contact-bar">
            <div class="row align-items-center">
                <div class="col-lg-4">
                    <div class="contact-item mt-40">
                        <div class="float-left">
                            <div class="contact-icon d-inline-block border rounded-pill shadow text-primary mt-1 mr-4">
                                <i class="mdi mdi-earth"></i>
                            </div>
                        </div>
                        <div class="contact-details">
                            <h4 class="text-dark mb-1">{{trans('main.Website')}}</h4>
                            <p class="mb-0 text-muted">www.crossedlink.com</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="contact-item mt-40">
                        <div class="float-left">
                            <div class="contact-icon d-inline-block border rounded-pill shadow text-primary mt-1 mr-4">
                                <i class="mdi mdi-cellphone-iphone"></i>
                            </div>
                        </div>
                        <div class="contact-details">
                            <h4 class="text-dark mb-1">{{trans('main.Call Us')}}</h4>
                            <p class="mb-0 text-muted">0560123467</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="contact-item mt-40">
                        <div class="float-left">
                            <div class="contact-icon d-inline-block border rounded-pill shadow text-primary mt-1 mr-4">
                                <i class="mdi mdi-email"></i>
                            </div>
                        </div>
                        <div class="contact-details">
                            <h4 class="text-dark mb-1">{{trans('main.Email')}}</h4>
                            <p class="mb-0 text-muted">hello@crossedlink.com</p>
                            <p class="mb-0 text-muted">support@crossedlink.com</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- CONTACT END -->

    <!-- CONTACT FORM START -->
    <section class="section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h4 class="text-dark mb-0">{{trans('main.Get In Touch')}} :</h4>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8 col-md-7 mt-4 pt-2">
                    <div class="custom-form rounded border p-4">
                        <div id="message"></div>
                        {!! Form::open(['action'=>'VisitorController@contact', 'method'=>'POST', ' novalidate', 'class' => 'needs-validation'])!!}
                            <div class="row">
                                @if(auth()->check())
                                    <input name="name" value="{{auth()->user()->name}}" hidden>
                                    <input name="email" value="{{auth()->user()->email}}" hidden>
                                @else
                                    <div class="col-lg-6">
                                        <div class="form-group app-label">
                                            <label class="text-muted">{{trans('main.Name')}}</label>
                                            <input name="name" id="name2" type="text" class="form-control resume" placeholder="{{trans('main.Enter Name..')}}">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group app-label">
                                            <label class="text-muted">{{trans('main.Email address')}}</label>
                                            <input name="email" id="email1" type="email" class="form-control resume" placeholder="{{trans('main.Enter Email..')}}">
                                        </div>
                                    </div>
                                @endif
                                <div class="col-lg-12">
                                    <div class="form-group app-label">
                                        <label class="text-muted">{{trans('main.Subject')}}</label>
                                        <input name= 'subject' type="text" class="form-control resume" id="subject" placeholder="{{trans('main.Subject..')}}">
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group app-label">
                                        <label class="text-muted">{{trans('main.Message')}}</label>
                                        <textarea name="messege" id="comments" rows="5" class="form-control resume" placeholder="{{trans('main.Message..')}}"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                <input type="submit" id="submit" name="send" class="submitBnt btn btn-primary mt-2" value="{{trans('main.Send Message')}}">
                                    <div id="simple-msg"></div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-4 col-md-5 mt-4 pt-2">
                    <div class="border rounded text-center p-4">
                        <h5 class="text-dark pb-3">{{trans('main.Contact Info')}}</h5>
                        <div class="contact-location rounded mt-5 p-4">
                            <div class="contact-location-icon bg-white text-primary rounded-pill">
                                <i class="mdi mdi-email"></i>
                            </div>
                            <p class="text-muted pt-4 f-20 mb-0 text-center">info@crossedlink.com</p>
                        </div>
                        <h6 class="text-muted mt-4 mb-0">{{trans('main.Share')}}</h6>
                        <ul class="list-unstyled social-icon mt-3 mb-0">
                            <li class="list-inline-item"><a href="https://www.facebook.com/Crossedlink-104211824659145/" target= "_blank" class=""><i class="mdi mdi-facebook"></i></a></li>
                            <li class="list-inline-item"><a href="https://twitter.com/Crossedlink1" target= "_blank" class=""><i class="mdi mdi-twitter"></i></a></li>
                            <li class="list-inline-item"><a href="https://www.instagram.com/crossedlink" target= "_blank" class=""><i class="mdi mdi-instagram"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- CONTACT FORM END -->
    @include('inc.home.foot')
    @include('inc.home.scripts')
    <!-- Smartsupp Live Chat script -->
        <script type="text/javascript">
        var _smartsupp = _smartsupp || {};
        _smartsupp.key = '052ef1bc9a4c828cf72705ce223b756bca5d9934';
        window.smartsupp||(function(d) {
          var s,c,o=smartsupp=function(){ o._.push(arguments)};o._=[];
          s=d.getElementsByTagName('script')[0];c=d.createElement('script');
          c.type='text/javascript';c.charset='utf-8';c.async=true;
          c.src='https://www.smartsuppchat.com/loader.js?';s.parentNode.insertBefore(c,s);
        })(document);
        </script>
        
    </body>
</html>