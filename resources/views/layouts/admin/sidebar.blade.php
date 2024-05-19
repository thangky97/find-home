<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">Main</li>

                <li>
                    <a href="{{ route('route_BackEnd_Dashboard') }}" class="waves-effect">
                        <i class="ti-home"></i><span class="badge rounded-pill bg-primary float-end">1</span>
                        <span>Dashboard</span>
                    </a>
                </li>

                <li class="menu-title">Người dùng</li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="fas fa-user-cog"></i>
                        <span>Quản trị viên</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('route_BackEnd_Users_List') }}">Danh sách quản trị viên</a></li>
                        <li><a href="{{ route('route_BackEnd_Users_Create') }}">Tạo mới</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="fas fa-user-md"></i>
                        <span>Khách hàng</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('route_BackEnd_Customers_List') }}">Danh sách khách hàng</a></li>
                        <li><a href="{{ route('route_BackEnd_Customers_Create') }}">Tạo mới</a></li>
                    </ul>
                </li>

                <li class="menu-title">Sản phẩm</li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="fab fa-shopify"></i>
                        <span>Sản phẩm</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('route_BackEnd_Products_List') }}">Danh sách sản phẩm</a></li>
                        <li><a href="{{ route('route_BackEnd_Products_Create') }}">Tạo mới</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="fas fa-space-shuttle"></i>
                        <span>Thuộc tính</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('route_BackEnd_Attribute_List') }}">Danh sách thuộc tính
                            </a></li>
                        <li><a href="{{ route('route_BackEnd_Attribute_Create') }}">Tạo mới</a></li>
                    </ul>
                </li>

                <li class="menu-title">Tin tức</li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ti-archive"></i>
                        <span>Bài viết</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('route_BackEnd_News_List') }}">Danh sách bài viết</a></li>
                        <li><a href="{{ route('route_BackEnd_News_Create') }}">Tạo mới</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ti-archive"></i>
                        <span>Danh mục bài viết</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('route_BackEnd_Category_News_List') }}">Danh mục bài viết</a></li>
                        <li><a href="{{ route('route_BackEnd_Category_News_Create') }}">Tạo mới</a></li>
                    </ul>
                </li>

            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
