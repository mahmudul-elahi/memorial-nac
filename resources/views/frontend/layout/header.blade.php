<header id="header" class="d-none d-lg-block">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="d-flex align-items-center gap-3">
                    <div class="logo">
                        <a href="{{ route('index') }}">
                            <img style="height: 21px;" src="{{ asset('assets/frontend/images/logo.png') }}"
                                alt="">
                        </a>
                    </div>

                    <div class="search">
                        <form action="{{ route('search') }}" method="GET">
                            @csrf
                            <input type="text" class="form-control @error('keywords') border border-danger @enderror"
                                name="keywords" placeholder="Search here" />
                            <button type="submit" class="btn btn-primary rounded-circle">
                                <i class="fas fa-search"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <nav class="navbar navbar-expand-lg navbar-light bg-light navbarTop">
                    <div class="container">
                        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                            <ul class="navbar-nav align-items-center">
                                @guest
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('login') }}">Login</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link add-memory" href="{{ route('register') }}">Register</a>
                                    </li>
                                @endguest
                                @auth
                                    <li class="nav-item">
                                        <a class="nav-link add-memory" href="{{ route('insert.obituary') }}">
                                            <i class="fas fa-plus"></i>
                                            <span class="ms-1">Add a Memory</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <div class="dropdown authenticated d-flex align-items-center">
                                            <button class="ms-3 authenticated-btn" type="button" data-bs-toggle="dropdown"
                                                aria-expanded="false">
                                                <img src="{{ asset(Auth::user()->getAvatar()) }}" alt="Profile">
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item"
                                                        href="{{ route('profile', [Auth::id(), Auth::user()->name]) }}"><i
                                                            class="fas fa-user me-2"></i> Profile</a>
                                                </li>
                                                <li><a class="dropdown-item" href="{{ route('account') }}"><i
                                                            class="fas fa-cog me-2"></i> Account</a></li>
                                                @hasrole('admin')
                                                    <li><a class="dropdown-item" href="{{ route('admin.dashboard') }}"><i
                                                                class="fas fa-user-shield me-2"></i> Administration</a></li>
                                                @endhasrole
                                                <li>
                                                    <form action="{{ route('logout') }}" method="POST">
                                                        @csrf
                                                        <button class="dropdown-item" type="submit"><i
                                                                class="fas fa-sign-out-alt me-2"></i> Logout</button>
                                                    </form>
                                                </li>
                                            </ul>
                                        </div>
                                    </li>
                                @endauth
                            </ul>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </div>
</header>
