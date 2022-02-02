@include('inc.head')
@include('inc.sidebar')
<div class="page has-sidebar-left">
    @include('inc.searchBar')
    <div class="navbar navbar-expand d-flex navbar-dark justify-content-between bd-navbar blue accent-3 shadow">
        <div class="relative">
            <div class="d-flex">
                <div>
                    <a href="#" data-toggle="push-menu" class="paper-nav-toggle pp-nav-toggle">
                        <i></i>
                    </a>
                </div>
                <div class="d-none d-md-block">
                    <h1 class="nav-title text-white">Dashboard</h1>
                </div>
            </div>
        </div>
        @include('inc.navbar')
    </div>
    <div class="container-fluid animatedParent animateOnce my-3">
        <div class="animated fadeInUpShort">
            <div class="row">
                <div class="col-md-3">
                    <div class="white">
                        <div class="card">
                            <div class="card-body no-p">
                                <div class="tab-content">
                                    <div class="tab-pane animated fadeIn show active" id="v-pills-tab1" role="tabpanel" aria-labelledby="v-pills-tab1">
                                        <div class="bg-primary text-white lighten-2">
                                            <div class="pt-5 pb-2 pl-5 pr-5">
                                                <h5 class="font-weight-normal s-14">Admins</h5>
                                                <span class="s-48 font-weight-lighter text-primary">
                                                <small></small>{{count(Helper::admins())}}</span>
                                                <div class="float-right">
                                                    <span class="icon icon-globe s-48"></span>
                                                </div>
                                            </div>
                                            <canvas width="378" height="94" data-chart="spark" data-chart-type="line" data-dataset="[[28,530,200,430]]" data-labels="['a','b','c','d']"
                                                    data-dataset-options="[
                                    { borderColor:  'rgba(54, 162, 235, 1)', backgroundColor: 'rgba(54, 162, 235,1)'},
                                    ]">
                                            </canvas>
                                        </div>
                                        <div class="b-b">
                                        </div>
                                    </div>
                                    <div class="tab-pane animated fadeIn" id="v-pills-tab2" role="tabpanel" aria-labelledby="v-pills-tab2">
                                        <div class="bg-primary text-white lighten-2">
                                            <div class="pt-5 pb-2 pl-5 pr-5">
                                                <h5 class="font-weight-normal s-14"></h5>
                                                <span class="s-48 font-weight-lighter text-primary">
                                    <small></small></span>
                                                <div class="float-right">
                                                    <span class="icon icon-money-bag s-48"></span>
                                                </div>
                                            </div>
                                            <canvas width="378" height="94" data-chart="spark" data-chart-type="line" data-dataset="[[620,20,700,50]]" data-labels="['a','b','c','d']"
                                                    data-dataset-options="[
                                    { borderColor:  'rgba(54, 162, 235, 1)', backgroundColor: 'rgba(54, 162, 235,1)'},
                                    ]">
                                            </canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="white">
                        <div class="card">
                            <div class="card-body no-p">
                                <div class="tab-content">
                                    <div class="tab-pane animated fadeIn show active" id="v-pills-tab1" role="tabpanel" aria-labelledby="v-pills-tab1">
                                        <div class="bg-success text-white lighten-2">
                                            <div class="pt-5 pb-2 pl-5 pr-5">
                                                <h5 class="font-weight-normal s-14">Companies</h5>
                                                <span class="s-48 font-weight-lighter text-primary">
                                                <small></small>{{count(Helper::companies())}}</span>
                                                <div class="float-right">
                                                    <span class="icon icon-building s-48"></span>
                                                </div>
                                            </div>
                                            <canvas width="378" height="94" data-chart="spark" data-chart-type="line" data-dataset="[[28,530,200,430]]" data-labels="['a','b','c','d']"
                                                    data-dataset-options="[
                                    { borderColor:  '#69bc3d', backgroundColor: '#69bc3d'},
                                    ]">
                                            </canvas>
                                        </div>
                                        <div class="b-b" >
                                            <div class="table-responsive">
                                                
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane animated fadeIn" id="v-pills-tab2" role="tabpanel" aria-labelledby="v-pills-tab2">
                                        <div class="bg-primary text-white lighten-2">
                                            <div class="pt-5 pb-2 pl-5 pr-5">
                                                <h5 class="font-weight-normal s-14">Yesterday's Income</h5>
                                                <span class="s-48 font-weight-lighter text-primary">
                                    <small>$</small>1100</span>
                                                <div class="float-right">
                                                    <span class="icon icon-id-card s-48"></span>
                                                </div>
                                            </div>
                                            <canvas width="378" height="94" data-chart="spark" data-chart-type="line" data-dataset="[[620,20,700,50]]" data-labels="['a','b','c','d']"
                                                    data-dataset-options="[
                                    { borderColor:  'rgba(54, 162, 235, 1)', backgroundColor: 'rgba(54, 162, 235,1)'},
                                    ]">
                                            </canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="white">
                        <div class="card">
                            <div class="card-body no-p">
                                <div class="tab-content">
                                    <div class="tab-pane animated fadeIn show active" id="v-pills-tab1" role="tabpanel" aria-labelledby="v-pills-tab1">
                                        <div class="bg-yellow text-white lighten-2">
                                            <div class="pt-5 pb-2 pl-5 pr-5">
                                                <h5 class="font-weight-normal s-14">Persons</h5>
                                                <span class="s-48 font-weight-lighter text-primary">
                                                <small></small>{{count(Helper::persons())}}</span>
                                                <div class="float-right">
                                                    <span class="icon icon-user s-48"></span>
                                                </div>
                                            </div>
                                            <canvas width="378" height="94" data-chart="spark" data-chart-type="line" data-dataset="[[28,530,200,430]]" data-labels="['a','b','c','d']"
                                                    data-dataset-options="[
                                    { borderColor:  '#eeb61a', backgroundColor: '#eeb61a'},
                                    ]">
                                            </canvas>
                                        </div>
                                        <div class="b-b" >
                                            <div class="table-responsive">
                                                
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane animated fadeIn" id="v-pills-tab2" role="tabpanel" aria-labelledby="v-pills-tab2">
                                        <div class="bg-primary text-white lighten-2">
                                            <div class="pt-5 pb-2 pl-5 pr-5">
                                                <h5 class="font-weight-normal s-14">Yesterday's Income</h5>
                                                <span class="s-48 font-weight-lighter text-primary">
                                    <small>$</small>1100</span>
                                                <div class="float-right">
                                                    <span class="icon icon-id-card s-48"></span>
                                                </div>
                                            </div>
                                            <canvas width="378" height="94" data-chart="spark" data-chart-type="line" data-dataset="[[620,20,700,50]]" data-labels="['a','b','c','d']"
                                                    data-dataset-options="[
                                    { borderColor:  'rgba(54, 162, 235, 1)', backgroundColor: 'rgba(54, 162, 235,1)'},
                                    ]">
                                            </canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="white">
                        <div class="card">
                            <div class="card-body no-p">
                                <div class="tab-content">
                                    <div class="tab-pane animated fadeIn show active" id="v-pills-tab1" role="tabpanel" aria-labelledby="v-pills-tab1">
                                        <div class="bg-danger text-white lighten-2">
                                            <div class="pt-5 pb-2 pl-5 pr-5">
                                                <h5 class="font-weight-normal s-14">Workers</h5>
                                                <span class="s-48 font-weight-lighter text-primary">
                                                <small></small>{{count(Helper::workers())}}</span>
                                                <div class="float-right">
                                                    <span class="icon icon-id-card s-48"></span>
                                                </div>
                                            </div>
                                            <canvas width="378" height="94" data-chart="spark" data-chart-type="line" data-dataset="[[28,530,200,430]]" data-labels="['a','b','c','d']"
                                                    data-dataset-options="[
                                    { borderColor:  '#dd4655', backgroundColor: '#dd4655'},
                                    ]">
                                            </canvas>
                                        </div>
                                        <div class="b-b" >
                                            <div class="table-responsive">
                                                
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane animated fadeIn" id="v-pills-tab2" role="tabpanel" aria-labelledby="v-pills-tab2">
                                        <div class="bg-primary text-white lighten-2">
                                            <div class="pt-5 pb-2 pl-5 pr-5">
                                                <h5 class="font-weight-normal s-14">Yesterday's Income</h5>
                                                <span class="s-48 font-weight-lighter text-primary">
                                    <small>$</small>1100</span>
                                                <div class="float-right">
                                                    <span class="icon icon-money-bag s-48"></span>
                                                </div>
                                            </div>
                                            <canvas width="378" height="94" data-chart="spark" data-chart-type="line" data-dataset="[[620,20,700,50]]" data-labels="['a','b','c','d']"
                                                    data-dataset-options="[
                                    { borderColor:  'rgba(54, 162, 235, 1)', backgroundColor: 'rgba(54, 162, 235,1)'},
                                    ]">
                                            </canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('inc.foot')

