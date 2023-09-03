<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin.dashboard') }}">
                <i class="icon-grid menu-icon"></i>
                <span class="menu-title">Dashboard</span>

            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
                <i class="icon-layout menu-icon"></i>
                <span class="menu-title">Products</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-basic">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{ route('products.available') }}">Available
                            Products</a></li>
                    <li class="nav-item"><a href="{{ route('products.purchase') }}" class="nav-link">Purchased
                            Products</a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#form-elements" aria-expanded="false"
                aria-controls="form-elements">
                <i class="icon-columns menu-icon"></i>
                <span class="menu-title">Genders</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="form-elements">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"><a class="nav-link" href="{{ route('gender.male') }}">Male</a></li>
                    <li class="nav-item"><a href="{{ route('gender.female') }}" class="nav-link">Female</a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#charts" aria-expanded="false" aria-controls="charts">
                <i class="icon-bar-graph menu-icon"></i>
                <span class="menu-title">Pro Category</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="charts">

                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{ route('category.shoes') }}">Shoes</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{ route('category.jeans') }}">Jeans</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{ route('category.shirt') }}">Shirt</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{ route('category.hoodie') }}">Hoodie</a></li>

                    <li class="nav-item"><a href="{{ route('category.available') }}" class="nav-link">Product
                            Category</a></li>



                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#tables" aria-expanded="false" aria-controls="tables">
                <i class="icon-head menu-icon"></i>
                <span class="menu-title">Customers</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="tables">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link " href="{{ route('customers.details') }}">Customers
                            Detail</a></li>

                </ul>
            </div>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('rate') }}">
                <i class="icon-grid menu-icon"></i>
                <span class="menu-title">rating</span>

            </a>
        </li>


        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#mycoupen" aria-expanded="false" aria-controls="mycoupen">
                <i class="icon-layout menu-icon"></i>
                <span class="menu-title">Coupens</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="mycoupen">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{ route('coupen.add') }}">Coupens</a></li>
                    <li class="nav-item"><a href="{{ route('coupen.use') }}" class="nav-link">Used Coupen</a></li>
                </ul>
            </div>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('sizes.available') }}">
                <i class="icon-grid menu-icon"></i>
                <span class="menu-title">Sizes</span>

            </a>
        </li>
        </li>
    </ul>
</nav>
