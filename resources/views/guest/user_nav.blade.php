<nav>
    <div class="logo">
        <h3><a href="merlin.html" class="logo-name text-decoration-none">Merlin Fashion</a></h3>
    </div>

    <ul class="nav-links">
        <li><a href="{{ route('guest.create') }}"
                class="{{ request()->routeIs('guest.create') ? 'active': '' }} text-decoration-none">Home</a></li>

        <li><a href="{{ route('guest.products') }}"
                class="{{ request()->routeIs('guest.products') ?'active': '' }} text-decoration-none">Products</a></li>
        <li><a href="{{ route('guest.category') }}"
                class="{{ request()->routeIs('guest.category') ? 'active': '' }} text-decoration-none">Categories</a></li>
        <li><a href="{{ route('guest.contact') }}"
                class="{{ request()->routeIs('guest.contact')? 'active': ''  }} text-decoration-none">ContactUs</a></li>
        <li><a  href="{{ route('guest.login') }}" class="{{ request()->routeIs('guest.login')  ? 'active': '' }} text-decoration-none">Login</a></li>
    </ul>
    <div class="burger">
        <div class="line1"></div>
        <div class="line2"></div>
        <div class="line3"></div>
    </div>
</nav>

