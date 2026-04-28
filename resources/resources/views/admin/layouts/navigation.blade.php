<aside class="navbar navbar-vertical navbar-expand-lg navbar-dark">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu">
            <span class="navbar-toggler-icon"></span>
        </button>
        <h1 class="navbar-brand">
            <a href="{{ url('admin') }}">
                <img srcset="{{ asset('adm/img/logo/labNetwork_logo.png') }}" width="180px" height="40px" alt=""
                    title="{{__('.labNetwork')}}" class="navbar-brand-image">
            </a>
        </h1>

        <div class="navbar-nav flex-row d-lg-none">
            <div class="nav-item dropdown">
                <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown"
                    aria-label="Open user menu" aria-expanded="false">
                    <span class="avatar avatar-sm"
                        style="background-image: url({{ asset(Auth::user()->getAvatar()) }})"></span>
                    <div class="d-none d-xl-block ps-2">
                        <div>{{ Str::limit(Auth::user()->name, 12) }}</div>
                        <div class="mt-1 small text-muted">{{ Str::limit(Auth::user()->email, 12) }}</div>
                    </div>
                </a>

                <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <a href="{{ route('logout') }}" class="dropdown-item" onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST">
                        @csrf
                    </form>
                </div>
            </div>
        </div>

        <div class="collapse navbar-collapse" id="navbar-menu">
            <ul class="navbar-nav pt-lg-3">

                <li class="nav-item {{ (request()->is('admin/dashboard')) ? 'active': '' }}">
                    <a class="nav-link" href="{{ route('admin.dashboard') }}">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <polyline points="5 12 3 12 12 3 21 12 19 12"></polyline>
                                <path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7"></path>
                                <path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6"></path>
                            </svg>
                        </span>
                        <span class="nav-link-title">
                            {{__('Dashboard')}}
                        </span>
                    </a>
                </li>

                <li class="nav-item {{ (request()->is('admin/users')) ? 'active': '' }}">
                    <a class="nav-link" href="{{ route('admin.users') }}">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <circle cx="9" cy="7" r="4" />
                                <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
                                <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                                <path d="M21 21v-2a4 4 0 0 0 -3 -3.85" />
                            </svg>
                        </span>
                        <span class="nav-link-title">
                            {{__('Users')}}
                        </span>
                    </a>
                </li>

                <li class="nav-item {{ (request()->is('admin/obituaries')) ? 'active': '' }}">
                    <a class="nav-link" href="{{ route('admin.obituaries') }}">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <line x1="3" y1="21" x2="21" y2="21" />
                                <path d="M10 21v-4a2 2 0 0 1 4 0v4" />
                                <line x1="10" y1="5" x2="14" y2="5" />
                                <line x1="12" y1="3" x2="12" y2="8" />
                                <path d="M6 21v-7m-2 2l8 -8l8 8m-2 -2v7" />
                            </svg>
                        </span>
                        <span class="nav-link-title">
                            {{__('Obituaries')}}
                        </span>
                    </a>
                </li>

                <li class="nav-item dropdown">
                    <div class="nav-link">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <svg fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512">
                                <!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                <path
                                    d="M64 464c-8.8 0-16-7.2-16-16L48 64c0-8.8 7.2-16 16-16l160 0 0 80c0 17.7 14.3 32 32 32l80 0 0 288c0 8.8-7.2 16-16 16L64 464zM64 0C28.7 0 0 28.7 0 64L0 448c0 35.3 28.7 64 64 64l256 0c35.3 0 64-28.7 64-64l0-293.5c0-17-6.7-33.3-18.7-45.3L274.7 18.7C262.7 6.7 246.5 0 229.5 0L64 0zm56 256c-13.3 0-24 10.7-24 24s10.7 24 24 24l144 0c13.3 0 24-10.7 24-24s-10.7-24-24-24l-144 0zm0 96c-13.3 0-24 10.7-24 24s10.7 24 24 24l144 0c13.3 0 24-10.7 24-24s-10.7-24-24-24l-144 0z" />
                            </svg>
                        </span>
                        <span class="nav-link-title">
                            {{__('Blog')}}
                        </span>
                    </div>
                    <div class="dropdown-menu show">
                        <div class="dropdown-menu-columns">
                            <div class="dropdown-menu-column">
                                <a class="dropdown-item d-flex align-items-center gap-2 {{ (request()->is('admin/blog/posts')) ? 'active': '' }}"
                                    href="{{ route('admin.blog.posts') }}">
                                    <svg fill="currentColor" width="15" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512">
                                        <!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                        <path
                                            d="M64 464c-8.8 0-16-7.2-16-16L48 64c0-8.8 7.2-16 16-16l160 0 0 80c0 17.7 14.3 32 32 32l80 0 0 288c0 8.8-7.2 16-16 16L64 464zM64 0C28.7 0 0 28.7 0 64L0 448c0 35.3 28.7 64 64 64l256 0c35.3 0 64-28.7 64-64l0-293.5c0-17-6.7-33.3-18.7-45.3L274.7 18.7C262.7 6.7 246.5 0 229.5 0L64 0zm56 256c-13.3 0-24 10.7-24 24s10.7 24 24 24l144 0c13.3 0 24-10.7 24-24s-10.7-24-24-24l-144 0zm0 96c-13.3 0-24 10.7-24 24s10.7 24 24 24l144 0c13.3 0 24-10.7 24-24s-10.7-24-24-24l-144 0z" />
                                    </svg>
                                    {{__('Posts')}}
                                </a>
                                <a class="dropdown-item d-flex align-items-center gap-2 {{ (request()->is('admin/blog/categories')) ? 'active': '' }}"
                                    href="{{ route('admin.blog.categories') }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path
                                            d="M9 4h3l2 2h5a2 2 0 0 1 2 2v7a2 2 0 0 1 -2 2h-10a2 2 0 0 1 -2 -2v-9a2 2 0 0 1 2 -2" />
                                        <path d="M17 17v2a2 2 0 0 1 -2 2h-10a2 2 0 0 1 -2 -2v-9a2 2 0 0 1 2 -2h2" />
                                    </svg>
                                    {{__('Categories')}}
                                </a>
                                <a class="dropdown-item d-flex align-items-center gap-2 {{ (request()->is('admin/blog/comments')) ? 'active': '' }}"
                                    href="{{ route('admin.blog.comments') }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M3 20l1.3 -3.9a9 8 0 1 1 3.4 2.9l-4.7 1" />
                                        <line x1="12" y1="12" x2="12" y2="12.01" />
                                        <line x1="8" y1="12" x2="8" y2="12.01" />
                                        <line x1="16" y1="12" x2="16" y2="12.01" />
                                    </svg>
                                    {{__('Comments')}}
                                </a>
                            </div>
                        </div>
                    </div>
                </li>

                <li class="nav-item {{ (request()->is('admin/categories')) ? 'active': '' }}">
                    <a class="nav-link" href="{{ route('admin.categories') }}">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path
                                    d="M9 4h3l2 2h5a2 2 0 0 1 2 2v7a2 2 0 0 1 -2 2h-10a2 2 0 0 1 -2 -2v-9a2 2 0 0 1 2 -2" />
                                <path d="M17 17v2a2 2 0 0 1 -2 2h-10a2 2 0 0 1 -2 -2v-9a2 2 0 0 1 2 -2h2" />
                            </svg>
                        </span>
                        <span class="nav-link-title">
                            {{__('Categories')}}
                        </span>
                    </a>
                </li>

                <li class="nav-item {{ (request()->is('admin/blog/comments')) ? 'active': '' }}">
                    <a class="nav-link" href="{{ route('admin.comments') }}">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M3 20l1.3 -3.9a9 8 0 1 1 3.4 2.9l-4.7 1" />
                                <line x1="12" y1="12" x2="12" y2="12.01" />
                                <line x1="8" y1="12" x2="8" y2="12.01" />
                                <line x1="16" y1="12" x2="16" y2="12.01" />
                            </svg>
                        </span>
                        <span class="nav-link-title">
                            {{__('Comments')}}
                        </span>
                    </a>
                </li>

                <li class="nav-item {{ (request()->is('admin/pages')) ? 'active': '' }}">
                    <a class="nav-link" href="{{ route('admin.pages') }}">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path
                                    d="M16 6h3a1 1 0 0 1 1 1v11a2 2 0 0 1 -4 0v-13a1 1 0 0 0 -1 -1h-10a1 1 0 0 0 -1 1v12a3 3 0 0 0 3 3h11">
                                </path>
                                <line x1="8" y1="8" x2="12" y2="8"></line>
                                <line x1="8" y1="12" x2="12" y2="12"></line>
                                <line x1="8" y1="16" x2="12" y2="16"></line>
                            </svg>
                        </span>
                        <span class="nav-link-title">
                            {{__('Pages')}}
                        </span>
                    </a>
                </li>

                <li class="nav-item {{ (request()->is('admin/settings')) ? 'active': '' }} dropdown">
                    <a class="nav-link" href="{{ route('admin.settings') }}">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path
                                    d="M10.325 4.317c.426 -1.756 2.924 -1.756 3.35 0a1.724 1.724 0 0 0 2.573 1.066c1.543 -.94 3.31 .826 2.37 2.37a1.724 1.724 0 0 0 1.065 2.572c1.756 .426 1.756 2.924 0 3.35a1.724 1.724 0 0 0 -1.066 2.573c.94 1.543 -.826 3.31 -2.37 2.37a1.724 1.724 0 0 0 -2.572 1.065c-.426 1.756 -2.924 1.756 -3.35 0a1.724 1.724 0 0 0 -2.573 -1.066c-1.543 .94 -3.31 -.826 -2.37 -2.37a1.724 1.724 0 0 0 -1.065 -2.572c-1.756 -.426 -1.756 -2.924 0 -3.35a1.724 1.724 0 0 0 1.066 -2.573c-.94 -1.543 .826 -3.31 2.37 -2.37c1 .608 2.296 .07 2.572 -1.065z" />
                                <circle cx="12" cy="12" r="3" />
                            </svg>
                        </span>
                        <span class="nav-link-title">
                            {{__('Settings')}}
                        </span>
                    </a>

                    <div class="dropdown-menu show">
                        <div class="dropdown-menu-columns">
                            <div class="dropdown-menu-column">
                                <a class="dropdown-item {{ (request()->is('admin/settings/logos')) ? 'active': '' }}"
                                    href="{{ route('admin.logos') }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon me-2" width="24" height="24"
                                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <circle cx="12" cy="13" r="3" />
                                        <path
                                            d="M5 7h2a2 2 0 0 0 2 -2a1 1 0 0 1 1 -1h2m9 7v7a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-9a2 2 0 0 1 2 -2" />
                                        <line x1="15" y1="6" x2="21" y2="6" />
                                        <line x1="18" y1="3" x2="18" y2="9" />
                                    </svg> {{__('Logo')}}
                                </a>
                                <a class="dropdown-item {{ (request()->is('admin/settings/about')) ? 'active': '' }}"
                                    href="{{ route('admin.about') }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon me-2" width="24" height="24"
                                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <line x1="4" y1="6" x2="20" y2="6" />
                                        <line x1="4" y1="12" x2="20" y2="12" />
                                        <line x1="4" y1="18" x2="16" y2="18" />
                                    </svg> {{__('About')}}
                                </a>
                                <a class="dropdown-item {{ (request()->is('admin/settings/terms')) ? 'active': '' }}"
                                    href="{{ route('admin.terms') }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon me-2" width="24" height="24"
                                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <circle cx="12" cy="12" r="9" />
                                        <path d="M10 16.5l2 -3l2 3m-2 -3v-2l3 -1m-6 0l3 1" />
                                        <circle cx="12" cy="7.5" r=".5" fill="currentColor" />
                                    </svg> {{__('Terms & Conditions')}}
                                </a>
                            </div>
                        </div>
                    </div>

                </li>

                <li class="nav-item">
                    <a class="nav-link bg-green-lt" href="{{ url('/') }}" target="_blank">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M9 11l-4 4l4 4m-4 -4h11a4 4 0 0 0 0 -8h-1" />
                            </svg>
                        </span>
                        <span class="nav-link-title strong">
                            {{__('Visit the site')}}
                        </span>
                    </a>
                </li>

            </ul>
        </div>
    </div>
</aside>

<header class="navbar navbar-expand-md navbar-light d-none d-lg-flex d-print-none">
    <div class="container-xl">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="navbar-nav flex-row order-md-last">
            <div class="nav-item dropdown">
                <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown"
                    aria-label="Open user menu" aria-expanded="false">
                    <span class="avatar avatar-sm"
                        style="background-image: url({{ asset(Auth::user()->getAvatar()) }})"></span>
                    <div class="d-none d-xl-block ps-2">
                        <div>{{ Str::limit(Auth::user()->name, 12) }}</div>
                        <div class="mt-1 small text-muted">{{ Str::limit(Auth::user()->email, 12) }}</div>
                    </div>
                </a>

                <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <a href="{{ route('logout') }}" class="dropdown-item" onclick="event.preventDefault();
                                document.getElementById('logout-form-1').submit();">{{ __('Logout') }}</a>
                    <form id="logout-form-1" action="{{ route('logout') }}" method="POST">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>
</header>
