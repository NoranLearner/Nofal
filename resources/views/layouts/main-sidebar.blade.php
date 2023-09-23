<div id="dw-s1" class="bmd-layout-drawer bg-faded">

    <div class="container-fluid side-bar-container">

        <header class="pb-0">
            <a class="navbar-brand" href="{{ route('home') }}">
                {{-- <object class="side-logo" data="./svg/logo-8.svg" type="image/svg+xml">
                </object> --}}
                <img src="{{ URL::asset('assets/svg/logo-8.svg') }}" alt="Nozha" srcset="" width="80%">
            </a>
        </header>

        <p class="side-comment">Products</p>

        <li class="side a-collapse short">
            @can('product-list')
                <a href="{{ url('products') }}" class="side-item">
                    <i class="fa fa-shopping-basket"></i> Products
                </a>
            @endcan
        </li>

        <p class="side-comment">Users</p>

        <li class="side a-collapse short">
            @can('user-list')
                <a href="{{ url('users') }}" class="side-item">
                    <i class="fa fa-solid fa-users"></i> User Menu
                </a>
            @endcan
        </li>

        <li class="side a-collapse short">
            @can('role-list')
                <a href="{{ url('roles') }}" class="side-item">
                    <i class="fa fa-solid fa-user-shield"></i> User Role
                </a>
            @endcan
        </li>

        {{-- <p class="side-comment">Logout</p>

        <li class="side a-collapse short pb-5">
            <a href="{{ route('logout') }}" class="side-item" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                <i class="fas fa-sign-out-alt"></i> Logout
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </li> --}}

    </div>

</div>
