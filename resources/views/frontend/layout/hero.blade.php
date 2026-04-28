<section id="hero">
    <div class="container position-relative">

        <div class="row d-block d-lg-none">
            <div class="col-7 mx-auto">
                <div class="search2">
                    <form action="{{ route('search') }}" method="GET">
                        @csrf
                        <input type="text" class="form-control" name="keywords" placeholder="Search here" />
                        <button type="submit" class="btn btn-primary rounded-circle">
                            <i class="fas fa-search"></i>
                        </button>

                    </form>
                </div>
            </div>
        </div>

        @if (request()->routeIs('index'))
            <div class="row">
                <div class="col-md-4 mx-auto justify-content-center align-items-center text-center">
                    <div class="image">
                        <a href="{{ route('index') }}">
                            <img src="{{ asset('assets/frontend/images/hero/logo1.png') }}" style="height: 215px"
                                alt="Logo1">
                        </a>
                    </div>
                </div>
            </div>
        @endif

        <div class="row">
            <div class="col-md-7 mx-auto">
                <div class="hero-text">
                    <h1>{{ $pageTitle->title ?? 'Honoring Our Smallest Friends' }}</h1>
                    <h2>{{ $pageTitle->subtitle ?? 'An oasis for remembering and celebrating the joy brought by our smallest companions.' }}
                    </h2>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-lg-9 col-xxl-8 mx-auto d-none d-lg-block">
                <nav class="navbar navbar-expand-lg navbar-light bg-light navbarMain mx-auto">
                    <div class="container">
                        <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
                            <ul class="navbar-nav">

                                <li class="nav-item">
                                    <a class="nav-link {{ request()->route()->getName() === 'index' ? 'active' : '' }}"
                                        href="{{ route('index') }}">
                                        <img src="{{ asset('assets/frontend/images/hero/home.png') }}" alt="icon">
                                        <span class="ms-1 d-block">Home</span>
                                    </a>
                                </li>
                                @foreach ($categories as $category)
                                    <li class="nav-item ">
                                        <a class="nav-link {{ request()->path() === "category/$category->id/$category->slug" ? 'active' : '' }}"
                                            href="{{ route('category', [$category->id, $category->slug]) }}">
                                            <img src="{{ asset('assets/frontend/images/hero/pet.png') }}"
                                                alt="icon">
                                            <span class="ms-1 d-block">{{ Str::before($category->name, ' ') }}</span>
                                        </a>
                                    </li>
                                @endforeach
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->route()->getName() === 'blog.posts.view' ? 'active' : '' }}"
                                        href="{{ route('blog.posts.view') }}">
                                        <img src="{{ asset('assets/frontend/images/hero/blog-text.png') }}"
                                            style="opacity: .6;" alt="icon">
                                        <span class="ms-1 d-block">Blog</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
            </div>
        </div>

        @auth

            <div class="row d-block d-lg-none">
                <div class="col-md-6 mx-auto d-flex justify-content-center">
                    <a class="add-memory" href="{{ route('insert.obituary') }}">
                        <i class="fas fa-plus"></i>
                        <span class="ms-1">Add a Memory</span>
                    </a>
                </div>
            </div>

        @endauth

        <!-- Shape -->
        <div class="shape">
            <img src="{{ asset('assets/frontend/images/hero/2.png') }}" alt="Background" class="bg1 plant">
            <img src="{{ asset('assets/frontend/images/hero/3.png') }}" alt="Background" class="bg2 plant">
            <img src="{{ asset('assets/frontend/images/hero/4.png') }}" alt="Background" class="bg3 plant">
            <img src="{{ asset('assets/frontend/images/hero/1.png') }}" alt="Background" class="bg4 star">
            <img src="{{ asset('assets/frontend/images/hero/1.png') }}" alt="Background" class="bg5 star">
            <img src="{{ asset('assets/frontend/images/hero/1.png') }}" alt="Background" class="bg6 star">
            <img src="{{ asset('assets/frontend/images/hero/1.png') }}" alt="Background" class="bg7 star">
        </div>
    </div>
</section>
