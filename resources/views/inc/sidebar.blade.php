<aside class="main-sidebar fixed offcanvas shadow" data-toggle='offcanvas'>
    <section class="sidebar">
        <div class="logo">
            <a href="{{url('/')}}">
                <img src="{{asset("img/basic/logo.png")}}" alt="">
            </a>
        </div>
        
        <ul class="sidebar-menu">
            <li class="header"><strong>MAIN NAVIGATION</strong></li>
            @if(auth()->check())
                @if(auth()->user()->role > 0)
                    <li class="treeview">
                        <a href="{{url('/dashboard')}}">
                            <i class="fal fa-columns s-18"></i> 
                            <span>Dashboard</span> 
                        </a>
                    </li>
                    <li class="treeview">
                        <a href="#">
                            <i class="fas fa-user-shield  s-18"></i>
                            <span>Admins</span>
                            <span class="badge r-3 badge-primary pull-right">{{--{{count(Helper::admins())}}--}}</span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="{{url('dashboard/admins')}}"><i class="icon icon-circle-o">
                                </i>Admins <span class="text-secondary">{{--{{count(Helper::admins())}}--}}</span></a>
                            </li>
                            <li><a href="{{url('dashboard/admins/create')}}"><i class="icon icon-add">
                                </i>Add New Admin</a>
                            </li>
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#">
                            <i class="fad fa-building s-18"></i>
                            <span>Employers</span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="{{url('dashboard/companies')}}"><i class="icon icon-circle-o"></i>All Companies <span class="text-secondary">{{--count(Helper::companies())--}}</span></a>
                            </li>
                            <li><a href="{{url('dashboard/personal')}}"><i class="icon icon-circle-o"></i>All Personal <span class="text-secondary">{{--count(Helper::persons())--}}</span></a>
                            </li>
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#">
                            <i class="fas fa-user-hard-hat  s-18"></i>
                            <span>Workers</span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="{{url('dashboard/workers')}}"><i class="icon icon-circle-o"></i>All Workers <span class="text-secondary">{{--count(Helper::workers())--}}</span></a>
                            </li>
                            <li><a href="{{url('dashboard/workers/create')}}"><i class="icon icon-add"></i>Add Worker</a>
                            </li>
                        </ul>
                    </li>
                    <li class="treeview no-b">
                        <a href="#">
                            <i class="fal fa-stream  s-18"></i>
                            <span>Categories</span>
                            <span class="badge r-3 badge-success pull-right">{{--count(Helper::categories())--}}</span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="{{url('dashboard/categories')}}"><i class="icon icon-circle-o"></i>All Categories <span class="text-secondary">{{--count(Helper::categories())--}}</span></a></li>
                            <li><a href="{{url('dashboard/categories/companies')}}"><i class="icon icon-circle-o"></i>Companies Categories <span class="text-secondary">{{--count(Helper::companies_categories())--}}</span></a></li>
                            <li><a href="{{url('dashboard/categories/personal')}}"><i class="icon icon-circle-o"></i>Personal Categories <span class="text-secondary">{{--count(Helper::personal_categories())--}}</span></a></li>
                        </ul>
                    </li>
                    <li class="treeview no-b">
                        <a href="{{url('dashboard/pricing')}}">
                            <i class="fad fa-box-open s-18"></i>
                            <span>Packages</span>
                            <span class="badge r-3 badge-success pull-right">{{--count(Helper::packages())--}}</span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="{{url('dashboard/packages')}}"><i class="icon icon-circle-o"></i>All Packages <span class="text-secondary">{{--count(Helper::packages())--}}</span></a></li>
                            <li><a href="{{url('dashboard/packages/companies')}}"><i class="icon icon-circle-o"></i>Companies Packages <span class="text-secondary">{{--count(Helper::companies_packages())--}}</span></a></li>
                            <li><a href="{{url('dashboard/packages/personal')}}"><i class="icon icon-circle-o"></i>Personal Packages <span class="text-secondary">{{--count(Helper::personal_packages())--}}</span></a></li>
                        </ul>
                    </li>
                    <li class="treeview no-b">
                        <a href="#">
                            <i class="fas fa-user-md  s-18"></i>
                            <span>Jobs</span>
                            <span class="badge r-3 badge-success pull-right">{{--count(Helper::jobs())--}}</span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="{{url('dashboard/jobs')}}"><i class="icon icon-circle-o"></i>All Jobs <span class="text-secondary">{{--count(Helper::jobs())--}}</span></a>
                            </li>
                            <li><a href="{{url('dashboard/job/requests')}}"><i class="icon icon-circle-o"></i>All Job Requests <span class="text-secondary">{{--count(Helper::jobRequestsAll())--}}</span></a>
                            </li>
                        </ul>
                    </li>
                    <li class="treeview"><a href="{{url('dashboard/pricing/requests')}}"><i class="fal fa-list-ul"></i></i>Subscription Requests <span class="text-secondary">
                        @if(count(Helper::PricingRequesPending()) > 0)
                            {{
                                count(Helper::PricingRequesPending())
                            }}
                        @endif
                    
                    </span></a></li>

                    <li class="treeview"><a href="{{url('dashboard/govIDs')}}"><i class="fad fa-passport"></i></i>Governent IDs <span class="text-secondary">
                        @if(count(Helper::pendingGov()) > 0)
                            {{
                                count(Helper::pendingGov())
                            }}
                        @endif
                    
                    </span></a></li>
                    
                    <li class="treeview no-b">
                        <a href="#">
                            <i class="fad fa-globe  s-18"></i>
                            <span>Countries</span>
                            <span class="badge r-3 badge-success pull-right">{{--count(Helper::countriesNames())--}}</span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="{{url('dashboard/countries')}}"><i class="icon icon-circle-o"></i>All Countries <span class="text-secondary">{{--count(Helper::countriesNames())--}}</span></a></li>
                       </ul>
                    </li>
                    <li class="treeview no-b">
                        <a href="#">
                            </i><i class="fad fa-car-building"></i>
                            <span>Cities</span>
                            <span class="badge r-3 badge-success pull-right">{{--count(Helper::cities())--}}</span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="{{url('dashboard/cities')}}"><i class="icon icon-circle-o"></i>All Cities <span class="text-secondary">{{--count(Helper::cities())--}}</span></a></li>
                        </ul>
                    </li>
                    <li class="treeview no-b">
                        <a href="#">
                            <i class="fad fa-mail-bulk  s-18"></i>
                            <span>Email Notification</span>
                            {{--<!-- <span class="badge r-3 badge-success pull-right">{{count(Helper::emailtemplates())}}</span> -->--}}
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="{{url('dashboard/email-templates')}}"><i class="icon icon-circle-o"></i>Email Templates <!-- (<span class="text-secondary">{{count(Helper::emailtemplates())}}</span>) --></a></li>
                            <li><a href="{{url('dashboard/email-offer-notification')}}"><i class="icon icon-circle-o"></i>Send Email Notification </a></li>
                        </ul>
                    </li>
                @endif
            @endif 
        </ul>
    </section>
</aside>
<!--Sidebar End-->