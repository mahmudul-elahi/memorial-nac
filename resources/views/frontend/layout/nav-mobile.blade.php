<nav class="navbar navbar-expand-lg navbar-light bg-light d-lg-none mobileNavbar">
    <div class="container">
        <div class="position-relative">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mobileNavbar"
                aria-controls="mobileNavbar" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <a class="navbar-brand ms-3" href="{{ route('index') }}">
                <img style="height: 20px;" src="{{ asset('assets/frontend/images/logo.png') }}" alt="">
            </a>

            <div class="collapse navbar-collapse" id="mobileNavbar">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('index') }}"><img
                                src="{{ asset('assets/frontend/images/hero/home.png') }}"
                                style="width: 18px; margin-right: 2px;" alt="icon"> Home</a>
                    </li>
                    @foreach ($categories as $category)
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('category', [$category->id, $category->slug]) }}"><img
                                    src="{{ asset('assets/frontend/images/hero/pet.png') }}"
                                    style="width: 18px; margin-right: 2px;" alt="icon">
                                {{ Str::before($category->name, ' ') }}</a>
                        </li>
                    @endforeach
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('blog.posts.view') }}"><img
                                src="{{ asset('assets/frontend/images/hero/blog-text.png') }}"
                                style="width: 18px; opacity: .6; margin-right: 2px;" alt="icon"> Blogs</a>
                    </li>
                </ul>
            </div>
        </div>

        @guest
            <div class="d-flex ms-auto button-container">
                <a href="{{ route('login') }}" class="btn btn-primary btn-sm">Login</a>
                <a href="{{ route('register') }}" class="btn btn-outline-primary btn-sm me-2 active">Register</a>
            </div>
        @endguest

        @auth
            <div class="d-flex ms-auto button-container-bottom">
                <div class="d-flex ms-auto">
                    <div class="dropdown  authenticated d-flex align-items-center">
                        <button class="ms-3 authenticated-btn" type="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <img src="{{ asset(Auth::user()->getAvatar()) }}" alt="Profile">
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="{{ route('profile', [Auth::id(), Auth::user()->name]) }}"><i
                                        class="fas fa-user me-2"></i> Profile</a>
                            </li>
                            <li><a class="dropdown-item" href="{{ route('account') }}"><i class="fas fa-cog me-2"></i>
                                    Account</a></li>
                            @hasrole('admin')
                                <li><a class="dropdown-item" href="{{ route('admin.dashboard') }}"><i
                                            class="fas fa-user-shield me-2"></i>
                                        Administration</a></li>
                            @endhasrole
                            <li>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button class="dropdown-item" type="submit"><i class="fas fa-sign-out-alt me-2"></i>
                                        Logout</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        @endauth
    </div>
</nav>
