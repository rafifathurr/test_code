<div class="main-header">
    <!-- Logo Header -->
    <div class="logo-header" style="padding-left:0 !important" data-background-color="blue">
        <div class="logo my-auto" style="margin:auto !important">
            <img src="{{ asset('img/servvo.png') }}" width="135" alt="navbar brand" class="navbar-brand">
        </div>
        <button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse"
            data-target="collapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon">
                <i class="icon-menu" style="color:black;"></i>
            </span>
        </button>
        {{-- <button class="topbar-toggler more"><i class="icon-options-vertical"></i></button> --}}
        <div class="nav-toggle">
            <button class="btn btn-toggle toggle-sidebar">
                <i class="icon-menu" style="color:black;"></i>
            </button>
        </div>
    </div>
    <!-- End Logo Header -->
    <!-- Navbar Header -->
    <nav class="navbar navbar-header navbar-expand-lg" data-background-color="blue2">
    </nav>
    <!-- End Navbar -->
</div>
<!-- Sidebar -->
<div class="sidebar sidebar-style-2">
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <div class="user">
                <div class="avatar-sm float-left mr-2">
                    @if (Auth::guard('admin')->check())
                        <img src="{{ asset('img/admin.png') }}" alt="..." class="avatar-img rounded-circle">
                    @else
                        <img src="{{ asset('img/user.png') }}" alt="..." class="avatar-img rounded-circle">
                    @endif
                </div>
                <div class="info">
                    <a data-toggle="collapse" href="#collapseExample" aria-expanded="true">
                        <span>
                            {{ Auth::user()->name }}
                            <span class="user-level">{{ Auth::user()->role->role }}</span>
                        </span>
                    </a>

                </div>
            </div>
            <ul class="nav nav-primary">
                @if (Auth::guard('admin')->check())
                    <li class="nav-item {{ $title === 'Dashboard' ? 'active' : '' }}">
                        <a href="{{ route('admin.dashboard.index') }}" aria-expanded="false">
                            <i class="fas fa-home"></i>
                            <p>Home</p>
                        </a>
                    </li>
                    <li
                        class="nav-item {{ $title === 'List Order' || $title === 'Add Order' || $title === 'Edit Order' || $title === 'Detail Order' ? 'active' : '' }}">
                        <a href="{{ route('admin.order.index') }}" aria-expanded="false">
                            <i class="fas fa-clipboard-list"></i>
                            <p>Order</p>
                        </a>
                    </li>
                    <li
                        class="nav-item {{ $title === 'List Products' || $title === 'Add Products' || $title === 'Edit Products' || $title === 'Detail Products' ? 'active' : '' }}">
                        <a href="{{ route('admin.product.index') }}" class="collapsed" aria-expanded="false">
                            <i class="fas fa-boxes"></i>
                            <p>Products</p>
                        </a>
                    </li>
                    <li
                        class="nav-item {{ $title === 'List Category Product' || $title === 'Add Category Product' || $title === 'Edit Category Product' || $title === 'Detail Category Product' ? 'active' : '' }}">
                        <a href="{{ route('admin.category.index') }}" class="collapsed" aria-expanded="false">
                            <i class="fas fa-th"></i>
                            <p>Category Product</p>
                        </a>
                    </li>
                    <li
                        class="nav-item {{ $title === 'List User' || $title === 'Add User' || $title === 'Edit User' || $title === 'Detail User' ? 'active' : '' }}">
                        <a href="{{ route('admin.users.index') }}" class="collapsed" aria-expanded="false">
                            <i class="fa fa-user-plus"></i>
                            <p>Create User Profile</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a onclick="logout()" href="#" class="collapsed" aria-expanded="false">
                            <i class="fa fa-sign-out-alt"></i>
                            <p>Log Out</p>
                        </a>
                    </li>
                @else
                    <li
                        class="nav-item {{ $title === 'List Order' || $title === 'Add Order' || $title === 'Edit Order' || $title === 'Detail Order' ? 'active' : '' }}">
                        <a href="{{ route('user.order.index') }}" aria-expanded="false">
                            <i class="fas fa-clipboard-list"></i>
                            <p>Order</p>
                        </a>
                    </li>
                    <li
                        class="nav-item {{ $title === 'List Products' || $title === 'Add Products' || $title === 'Edit Products' || $title === 'Detail Products' ? 'active' : '' }}">
                        <a href="{{ route('user.product.index') }}" class="collapsed" aria-expanded="false">
                            <i class="fas fa-boxes"></i>
                            <p>Product</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a onclick="logout()" href="#" class="collapsed" aria-expanded="false">
                            <i class="fa fa-sign-out-alt"></i>
                            <p>Log Out</p>
                        </a>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</div>
<script>
    function logout() {
        var token = $('meta[name="csrf-token"]').attr('content');

        $.post("{{ route('login.logout') }}", {
                _token: token
            },
            function(data) {
                location.reload();
            })
    }
</script>
<!-- End Sidebar -->
