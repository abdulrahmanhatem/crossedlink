@include('inc.head-rtl')
@include('inc.sidebar-rtl')
<div class="has-sidebar-right">
    @include('inc.searchBar-rtl')
    <div class="sticky">
        <div class="navbar navbar-expand navbar-dark d-flex justify-content-between bd-navbar blue accent-3">
            <div class="relative">
                <a href="#" data-toggle="push-menu" class="paper-nav-toggle pp-nav-toggle">
                    <i></i>
                </a>
            </div>
            @include('inc.navbar-rtl')
        </div>
    </div>
</div>