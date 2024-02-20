<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <div id="header" class="header d-flex align-items-center">
        <div class="container-fluid container-xl d-flex align-items-center justify-content-between">
            <div>
                <a href="{{ route('welcome') }}" class="logo d-flex align-items-center">
                    <!-- Uncomment the line below if you also wish to use an image logo -->
                    <!--h1 class=" mt-4" >Ridge-Point</h1-->
                    <img  data-aos="fade-right" src={{asset('storage/icons/welcomeIcon.svg')}} alt="no-logo">

                </a>
            </div>
            <div>
                <i class="mobile-nav-toggle mobile-nav-show bi bi-list"></i>
                <i class="mobile-nav-toggle mobile-nav-hide d-none bi bi-x"></i>
            </div>
            <div class="">
                <nav id="navbar" class="navbar">
                    <ul>
                    <li><a href="{{ route('welcome') }}" class="{{ request()->is('/') ? 'active' : '' }}">Home</a></li>

                        @can('viewAny', App\Models\Quote::class)
                            <li><a href="{{ route('quotes.index') }}" class="{{ request()->is('quotes*') ? 'active' : '' }}">My quotes</a></li>
                        @endcan

                                                
                        <li><a href="{{ route('welcome') }}">About</a></li>
                        <li><a href="{{ route('welcome') }}">Services</a></li>
                        <li><a href="{{ route('welcome') }}">Projects</a></li>
                        <li><a href="{{ route('welcome') }}">Blog</a></li>
                        <li><a href="{{ route('quotes.create') }}">Contact</a></li>
                        @role('admin')
                        <li class="dropdown"><a href="{{ route('pendingMatters.index') }}"><span>Management Panel</span> <i
                                        class="bi bi-chevron-down dropdown-indicator"></i></a>
                            <ul>
                                <li><a href="{{ route('pendingMatters.index') }}">Pending Matters</a></li>
                                <li><a href="{{ route('quotes.index') }}">Quotes</a></li>
                                <li><a href="{{ route('quotes.index') }}">Messages</a></li>
                                <li class="dropdown"><a href="{{ route('users.index') }}"><span>Users</span> <i
                                                class="bi bi-chevron-down dropdown-indicator"></i></a>
                                    <ul>
                                        <li><a href="{{ route('users.index') }}">Users</a></li>
                                        <li><a href="{{ route('roles.index') }}">Roles</a></li>

                                    </ul>
                                </li>
                                <li class="dropdown"><a href="{{ route('carousels.index') }}"><span>Front</span> <i
                                                class="bi bi-chevron-down dropdown-indicator"></i></a>
                                    <ul>
                                        <li><a href="{{ route('carousels.index') }}">Carousels</a></li>
                                        <li><a href="{{ route('welcome') }}">About</a></li>
                                        <li><a href="{{ route('welcome') }}">Services</a></li>
                                        <li><a href="{{ route('welcome') }}">Projects</a></li>
                                        <li><a href="{{ route('welcome') }}">Blog</a></li>
                                        <li><a href="{{ route('welcome') }}">Reviews</a></li>

                                    </ul>
                                </li>
                            </ul>
                        </li>
                        @endrole

                        @guest
                            <li><a href={{ route('login') }}>Login</a></li>
                        @else
                            <li class="dropdown">
                                <a href="#" id="profileDropdown">
                                    <span>Profile</span>
                                    <i class="bi bi-chevron-down dropdown-indicator"></i>
                                </a>
                                <ul id="profileDropdownMenu">
                                    <li><a href="{{ route('profile.edit') }}">Edit Profile</a></li>
                                    <li>
                                        <a href="#" id="logoutLink">Logout</a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                    </li>
                                </ul>
                            </li>

                        @endguest
                    </ul>
                </nav><!-- .navbar -->
            </div>
        </div>
    </div><!-- End Header -->
</nav>
