<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <span class="brand-text font-weight-light">{{$siteInfo->com_name}}</span>
    </a>
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="info">
                <a href="javascript:void(0)" class="d-block">{{session()->get('admin_name')}}</a>
            </div>
        </div>
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                        with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="{{url('admin/dashboard')}}" class="nav-link {{(Request::path() == 'admin/dashboard')? 'active':''}}">
                        <i class="nav-icon fas fa-home"></i>
                        <p> Dashboard </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{url('admin/bookings')}}" class="nav-link {{(Request::path() == 'admin/bookings')? 'active':''}}">
                        <i class="nav-icon fas fa-book"></i>
                        <p> Bookings </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{url('admin/category')}}" class="nav-link {{(Request::path() == 'admin/category')? 'active':''}}">
                        <i class="nav-icon fas fa-list"></i>
                        <p>Category</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{url('admin/services')}}" class="nav-link {{(Request::path() == 'admin/services')? 'active':''}}">
                        <i class="nav-icon fas fa-bullhorn"></i>
                        <p>Services</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{url('admin/providers')}}" class="nav-link {{(Request::path() == 'admin/providers')? 'active':''}}">
                        <i class="nav-icon fas fa-user"></i>
                        <p>Providers</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{url('admin/payouts')}}" class="nav-link {{(Request::path() == 'admin/payouts')? 'active':''}}">
                        <i class="nav-icon fas fa-money-bill-wave"></i>
                        <p>Payout Request</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{url('admin/city')}}" class="nav-link {{(Request::path() == 'admin/city')? 'active bg-primary':''}}">
                        <i class="nav-icon fas fa-city"></i>
                        <p>Cities</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{url('admin/pages')}}" class="nav-link {{(Request::path() == 'admin/pages')? 'active':''}}">
                        <i class="nav-icon fas fa-pager"></i>
                        <p>Pages</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{url('admin/users')}}" class="nav-link {{(Request::path() == 'admin/users')? 'active':''}}">
                        <i class="nav-icon fas fa-users"></i>
                        <p>Users</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{url('admin/contact-queries')}}" class="nav-link {{(Request::path() == 'admin/contact-queries')? 'active':''}}">
                        <i class="nav-icon fas fa-users"></i>
                        <p>Contact Queries</p>
                    </a>
                </li>
                <li class="nav-item has-treeview {{(Request::path() == 'admin/transactions' || Request::path() == 'admin/payment_methods')? 'menu-open':''}}">
                    <a href="javascript:void(0)" class="nav-link">
                        <i class="nav-icon fa fa-money-bill"></i>
                        <p> Payments <i class="fas fa-angle-left right"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{url('admin/transactions')}}" class="nav-link {{(Request::path() == 'admin/transactions')? 'active bg-primary':''}}">
                                <i class="nav-icon fa fa-cube"></i>
                                <p>Transactions</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{url('admin/payment_methods')}}" class="nav-link {{(Request::path() == 'admin/payment_methods')? 'active bg-primary':''}}">
                                <i class="nav-icon fa fa-cube"></i>
                                <p>Payment Methods</p>
                            </a>
                        </li>
                    </ul> 
                </li>
                <li class="nav-item has-treeview {{(Request::path() == 'admin/general-settings' || Request::path() == 'admin/profile-settings'|| Request::path() == 'admin/social-settings' || Request::path() == 'admin/banner')? 'menu-open':''}}">
                    <a href="javascript:void(0)" class="nav-link">
                        <i class="nav-icon fa fa-wrench"></i>
                        <p> Settings <i class="fas fa-angle-left right"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{url('admin/banner')}}" class="nav-link {{(Request::path() == 'admin/banner')? 'active bg-primary':''}}">
                                <i class="nav-icon far fa-plus-square"></i>
                                <p>Banner</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{url('admin/commission')}}" class="nav-link {{(Request::path() == 'admin/commission')? 'active bg-primary':''}}">
                                <i class="nav-icon far fa-plus-square"></i>
                                <p>Commission</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{url('admin/general-settings')}}" class="nav-link {{(Request::path() == 'admin/general-settings')? 'active bg-primary':''}}">
                                <i class="fas fa-cogs nav-icon"></i>
                                <p>General Setting</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{url('admin/profile-settings')}}" class="nav-link {{(Request::path() == 'admin/profile-settings')? 'active bg-primary':''}}">
                                <i class="nav-icon fa fa-user"></i>
                                <p>Profile Setting</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{url('admin/social-settings')}}" class="nav-link {{(Request::path() == 'admin/social-settings')? 'active bg-primary':''}}">
                                <i class="nav-icon fa fa-list"></i>
                                <p>Social Setting</p>
                            </a>
                        </li> 
                    </ul> 
                </li>
            </ul>
        </nav>
    <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
<!-- Control Sidebar -->