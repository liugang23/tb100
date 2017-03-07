<!-- Aside Start-->
<aside class="left-panel">
    <!-- brand -->
    <div class="logo">
        <a href="index.html" class="logo-expanded">
            <i class="ion-social-buffer"></i>
            <span class="nav-label">Velonic</span>
        </a>
    </div>
    <!-- / brand -->
        
    <!-- Navbar Start -->
    <nav class="navigation">
        <ul class="list-unstyled">
            <li class="active">
                <a href="{{ url('/') }}"><i class="zmdi zmdi-view-dashboard"></i> <span class="nav-label">仪表盘</span>
                </a>
            </li>
            <li class="has-submenu">
                <a href="#"><i class="zmdi zmdi-format-underlined"></i> <span class="nav-label">产品管理</span><span class="menu-arrow"></span></a>
                <ul class="list-unstyled">
                    <li><a href="{{ url('/category') }}">分类管理</a></li>
                    <li><a href="{{ url('/category/pater=0&path=0,') }}">添加一级分类</a></li>
                </ul>
            </li>
            <li class="has-submenu"><a href="#"><i class="zmdi  zmdi-local-offer"></i> <span class="nav-label">商品管理</span><span class="menu-arrow"></span></a>
                <ul class="list-unstyled">
                    <li><a href="{{ url('/goods') }}">商品列表</a></li>
                    <li><a href="{{ url('/goods/create') }}">添加商品</a></li>
                </ul>
            </li>
            <li class="has-submenu"><a href="#"><i class="zmdi zmdi-collection-text"></i> <span class="nav-label">订单管理</span><span class="menu-arrow"></span></a>
                <ul class="list-unstyled">
                    <li><a href="{{ url('/order') }}">订单列表</a></li>
                    <li><a href="">Form Validation</a></li>
                    <li><a href="form-advanced.html">Advanced Form</a></li>
                </ul>
            </li>
            <li class="has-submenu"><a href="#"><i class="zmdi zmdi-pin-account"></i> <span class="nav-label">会员管理</span><span class="menu-arrow"></span></a>
                <ul class="list-unstyled">
                    <li><a href="{{ asset('/users') }}">用户列表</a></li>
                    <li><a href="{{ asset('/users/create') }}">添加用户</a></li>
                    <li><a href="tables-editable.html">Editable Table</a></li>
                    <li><a href="tables-responsive.html">Responsive Table</a></li>
                </ul>
            </li>
            <li class="has-submenu"><a href="#"><i class="ion-android-contacts"></i> <span class="nav-label">用户管理</span><span class="menu-arrow"></span></a>
                <ul class="list-unstyled">
                    <li><a href="{{ asset('/member') }}">管理员列表</a></li>
                    <li><a href="{{ asset('/member/create') }}">添加用户</a></li>
                    <li><a href="admin_roles.php">角色管理</a></li>
                    <li><a href="admin_nodes.php">权限管理</a></li>
                </ul>
            </li>

            <li class="has-submenu"><a href="#"><i class="zmdi zmdi-email"></i> <span class="nav-label">Mail</span><span class="badge bg-success">7</span></a>
                <ul class="list-unstyled">
                    <li><a href="email-inbox.html">Inbox</a></li>
                    <li><a href="email-compose.html">Compose Mail</a></li>
                    <li><a href="email-read.html">View Mail</a></li>
                    <li><a href="email-templates.html">Email Templates</a></li>
                </ul>
            </li>

            <li class="has-submenu"><a href="#"><i class="zmdi zmdi-map"></i> <span class="nav-label">Maps</span><span class="menu-arrow"></span></a>
                <ul class="list-unstyled">
                    <li><a href="maps-google.html"> Google Map</a></li>
                    <li><a href="maps-vector.html"> Vector Map</a></li>
                </ul>
            </li>
            <li class="has-submenu"><a href="#"><i class="zmdi zmdi-collection-item"></i> <span class="nav-label">Pages</span><span class="menu-arrow"></span></a>
                <ul class="list-unstyled">
                    <li><a href="pages-profile.html">Profile</a></li>
                    <li><a href="pages-timeline.html">Timeline</a></li>
                    <li><a href="pages-invoice.html">Invoice</a></li>
                    <li><a href="pages-contact.html">Contact-list</a></li>
                    <li><a href="pages-login.html">Login</a></li>
                    <li><a href="pages-register.html">Register</a></li>
                    <li><a href="pages-recoverpw.html">Recover Password</a></li>
                    <li><a href="pages-lock-screen.html">Lock Screen</a></li>
                    <li><a href="pages-blank.html">Blank Page</a></li>
                    <li><a href="pages-404.html">404 Error</a></li>
                    <li><a href="pages-404_alt.html">404 alt</a></li>
                    <li><a href="pages-500.html">500 Error</a></li>
                </ul>
            </li>
        </ul>
    </nav>            
</aside>
<!-- Aside Ends-->