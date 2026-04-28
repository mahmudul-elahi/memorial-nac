<header class="navbar navbar-expand-md navbar-dark d-print-none" style="background: {{ $settings->find('app_color')->value }}">
    <div class="container-xl">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu">
            <span class="navbar-toggler-icon"></span>
        </button>

        <form class="d-none d-md-block" action="{{ route('search') }}" method="GET">
            @csrf
            <div class="input-icon">
                <span class="input-icon-addon">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><circle cx="10" cy="10" r="7"></circle><line x1="21" y1="21" x2="15" y2="15"></line></svg>
                </span>
                <input type="search" class="form-control @error('keywords') is-invalid @enderror" name="keywords" placeholder="{{__('app.search_placeholder')}}">
            </div>
        </form>

        <h1 class="navbar-brand d-none-navbar-horizontal pe-0 ps-md-4 ps-lg-5 ms-md-5">
            <a class="ps-3" href="{{ route('index') }}">
                <img srcset="{{ asset($settings->getLogo()) }}" alt="" class="navbar-brand-image">
            </a>
        </h1>

        <div class="navbar-nav flex-row order-md-last">
            @guest
            <li class="nav-item">
                <a class="nav-link" href="{{ route('login') }}">
                    <span class="nav-link-icon d-lg-none">
	                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><rect x="5" y="11" width="14" height="10" rx="2" /><circle cx="12" cy="16" r="1" /><path d="M8 11v-5a4 4 0 0 1 8 0" /></svg>
                    </span>
                    <span class="nav-link-title font-weight-bold d-none d-sm-inline-block">
                        {{__('app.login')}}
                    </span>
                </a>
            </li>

            <li class="nav-item me-3">
                <a class="nav-link d-none d-md-inline-block" href="{{ route('register') }}">
                    <span class="nav-link-title">
                        {{__('app.register')}}
                    </span>
                </a>
            </li>
            @endguest

            @auth
            <div class="nav-item dropdown">
                <a href="#" class="nav-link d-flex lh-1 text-reset p-0 me-3" data-bs-toggle="dropdown" aria-label="Open user menu">
                    <span class="avatar avatar-sm" style="background-image: url({{ asset(Auth::user()->getAvatar()) }})"></span>
                    <div class="d-none d-xl-block ps-2 text-truncate">
                        <div>{{ Auth::user()->name }}</div>
                        <div class="mt-1 small text-muted">
                            {{ Str::limit(Auth::user()->email, 15) }}
                        </div>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <a href="{{ route('profile', [Auth::id(), Auth::user()->name]) }}" class="dropdown-item">
	                    <svg xmlns="http://www.w3.org/2000/svg" class="icon me-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 8v-2a2 2 0 0 1 2 -2h2" /><path d="M4 16v2a2 2 0 0 0 2 2h2" /><path d="M16 4h2a2 2 0 0 1 2 2v2" /><path d="M16 20h2a2 2 0 0 0 2 -2v-2" /><line x1="9" y1="10" x2="9.01" y2="10" /><line x1="15" y1="10" x2="15.01" y2="10" /><path d="M9.5 15a3.5 3.5 0 0 0 5 0" /></svg>
                        {{__('app.profile')}}
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="{{ route('account') }}" class="dropdown-item">
	                    <svg xmlns="http://www.w3.org/2000/svg" class="icon me-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10.325 4.317c.426 -1.756 2.924 -1.756 3.35 0a1.724 1.724 0 0 0 2.573 1.066c1.543 -.94 3.31 .826 2.37 2.37a1.724 1.724 0 0 0 1.065 2.572c1.756 .426 1.756 2.924 0 3.35a1.724 1.724 0 0 0 -1.066 2.573c.94 1.543 -.826 3.31 -2.37 2.37a1.724 1.724 0 0 0 -2.572 1.065c-.426 1.756 -2.924 1.756 -3.35 0a1.724 1.724 0 0 0 -2.573 -1.066c-1.543 .94 -3.31 -.826 -2.37 -2.37a1.724 1.724 0 0 0 -1.065 -2.572c-1.756 -.426 -1.756 -2.924 0 -3.35a1.724 1.724 0 0 0 1.066 -2.573c-.94 -1.543 .826 -3.31 2.37 -2.37c1 .608 2.296 .07 2.572 -1.065z" /><circle cx="12" cy="12" r="3" /></svg>
                        {{__('app.settings')}}
                    </a>
                    @hasrole('admin')
                    <a href="{{ route('admin.dashboard') }}" class="dropdown-item">
	                    <svg xmlns="http://www.w3.org/2000/svg" class="icon me-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 3a12 12 0 0 0 8.5 3a12 12 0 0 1 -8.5 15a12 12 0 0 1 -8.5 -15a12 12 0 0 0 8.5 -3" /><circle cx="12" cy="11" r="1" /><line x1="12" y1="12" x2="12" y2="14.5" /></svg>
                        {{__('app.administration')}}
                    </a>
                    @endhasrole
                    <a href="{{ route('logout') }}" class="dropdown-item" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon me-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7 6a7.75 7.75 0 1 0 10 0" /><line x1="12" y1="4" x2="12" y2="12" /></svg>
                        {{__('app.logout')}}
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST">
                        @csrf
                    </form>
                </div>
            </div>
            @endauth

            <div class="nav-item d-none d-md-flex me-2">
                <div class="btn-list">
                    <a href="{{ route('insert.obituary') }}" class="btn btn-dark d-none d-sm-inline-block font-weight-bold">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                        {{__('app.send_button')}}
                    </a>
                </div>
            </div>



        </div>
    </div>
</header>

<div class="navbar-expand-md">
    <div class="navbar-collapse collapse" id="navbar-menu">
        <div class="navbar navbar-dark" style="background: {{ $settings->find('app_color')->value }}">
            <div class="container-xl justify-content-md-center">
                <ul class="navbar-nav">
                    <li class="nav-item {{ request()->route()->getName() === 'index' ? "active" : ''  }}">
                        <a class="nav-link" href="{{ route('index') }}">
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><polyline points="5 12 3 12 12 3 21 12 19 12"></polyline><path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7"></path><path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6"></path></svg>
                            </span>
                            <span class="nav-link-title">
                                {{__('app.home')}}
                            </span>
                        </a>
                    </li>
					@foreach($categories as $cat)
					<li class="nav-item {{ request()->path() === "category/$cat->id/$cat->slug" ? 'active' : ''  }}">
                        <a class="nav-link" href="{{ route('category', [$cat->id, $cat->slug]) }}">
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-paw">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M14.7 13.5c-1.1 -2 -1.441 -2.5 -2.7 -2.5c-1.259 0 -1.736 .755 -2.836 2.747c-.942 1.703 -2.846 1.845 -3.321 3.291c-.097 .265 -.145 .677 -.143 .962c0 1.176 .787 2 1.8 2c1.259 0 3 -1 4.5 -1s3.241 1 4.5 1c1.013 0 1.8 -.823 1.8 -2c0 -.285 -.049 -.697 -.146 -.962c-.475 -1.451 -2.512 -1.835 -3.454 -3.538z" />
                                    <path d="M20.188 8.082a1.039 1.039 0 0 0 -.406 -.082h-.015c-.735 .012 -1.56 .75 -1.993 1.866c-.519 1.335 -.28 2.7 .538 3.052c.129 .055 .267 .082 .406 .082c.739 0 1.575 -.742 2.011 -1.866c.516 -1.335 .273 -2.7 -.54 -3.052z" />
                                    <path d="M9.474 9c.055 0 .109 0 .163 -.011c.944 -.128 1.533 -1.346 1.32 -2.722c-.203 -1.297 -1.047 -2.267 -1.932 -2.267c-.055 0 -.109 0 -.163 .011c-.944 .128 -1.533 1.346 -1.32 2.722c.204 1.293 1.048 2.267 1.933 2.267z" />
                                    <path d="M16.456 6.733c.214 -1.376 -.375 -2.594 -1.32 -2.722a1.164 1.164 0 0 0 -.162 -.011c-.885 0 -1.728 .97 -1.93 2.267c-.214 1.376 .375 2.594 1.32 2.722c.054 .007 .108 .011 .162 .011c.885 0 1.73 -.974 1.93 -2.267z" />
                                    <path d="M5.69 12.918c.816 -.352 1.054 -1.719 .536 -3.052c-.436 -1.124 -1.271 -1.866 -2.009 -1.866c-.14 0 -.277 .027 -.407 .082c-.816 .352 -1.054 1.719 -.536 3.052c.436 1.124 1.271 1.866 2.009 1.866c.14 0 .277 -.027 .407 -.082z" />
                                </svg>
                            </span>
                            <span class="nav-link-title">
                                 {{ $cat->name }}
                            </span>
                        </a>
                    </li>
					@endforeach
                    <li class="nav-item {{ request()->route()->getName() === 'blog.posts.view' ? "active" : ''  }}">
                        <a class="nav-link" href="{{ route('blog.posts.view') }}">
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                                <svg fill="currentColor" width="15" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512">
                                    <!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                    <path
                                        d="M64 464c-8.8 0-16-7.2-16-16L48 64c0-8.8 7.2-16 16-16l160 0 0 80c0 17.7 14.3 32 32 32l80 0 0 288c0 8.8-7.2 16-16 16L64 464zM64 0C28.7 0 0 28.7 0 64L0 448c0 35.3 28.7 64 64 64l256 0c35.3 0 64-28.7 64-64l0-293.5c0-17-6.7-33.3-18.7-45.3L274.7 18.7C262.7 6.7 246.5 0 229.5 0L64 0zm56 256c-13.3 0-24 10.7-24 24s10.7 24 24 24l144 0c13.3 0 24-10.7 24-24s-10.7-24-24-24l-144 0zm0 96c-13.3 0-24 10.7-24 24s10.7 24 24 24l144 0c13.3 0 24-10.7 24-24s-10.7-24-24-24l-144 0z" />
                                </svg>
                            </span>
                            <span class="nav-link-title">
                                {{__('Blog')}}
                            </span>
                        </a>
                    </li>
                    <span class="d-md-none">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('insert.obituary') }}">
                                <span class="nav-link-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                                </span>
                                <span class="nav-link-title">
                                    {{__('app.send_button')}}
                                </span>
                            </a>
                        </li>
                    </span>
                </ul>
                <div class="d-md-none my-2 my-md-0 flex-grow-1 flex-md-grow-0 order-first order-md-last">
                    <form action="{{ route('search') }}" method="GET">
                        @csrf
                        <div class="input-icon">
                            <span class="input-icon-addon">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><circle cx="10" cy="10" r="7"></circle><line x1="21" y1="21" x2="15" y2="15"></line></svg>
                            </span>
                            <input type="search" class="form-control @error('keywords') is-invalid @enderror" name="keywords" placeholder="{{__('app.search_placeholder')}}">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
