<div class="hr text-muted"></div>
<footer class="footer footer-transparent py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 me-5 mb-3">
                <a class="d-inline-flex align-items-center mb-2 link-dark text-decoration-none" href="{{ route('index') }}" aria-label="Bootstrap">
                    <img srcset="{{ asset($settings->getLogo()) }}" width="170" height="40" alt="augustani.it" class="navbar-brand-image">
                </a>
        
                <ul class="list-unstyled small text-muted">
                    <li class="mb-2">&copy; {{ date('Y') }} {{ $settings->find('app_name')->value }}</li>
                    <li class="mb-2">{{ $settings->find('app_description')->value }}</li>
                </ul>
            </div>

            <div class="col-lg-3 mb-3">
                <h5>{{__('app.categories')}}</h5>
                <ul class="list-unstyled">
                    @foreach($categories as $cat)
                    <li class="mb-2">
                        <a href="{{ route('category', [$cat->id, $cat->slug]) }}">
                            {{ $cat->name }}
                        </a>
                    </li>
                    @endforeach
                </ul>
            </div>

            <div class="col-lg-3 mb-3">
                <h5>{{__('app.pages')}}</h5>
                <ul class="list-unstyled">
                    @foreach($pages as $page)
                    <li class="mb-2">
                        <a href="{{ route('page.show', [$page->id, $page->slug]) }}">
                            {{ $page->title }}
                        </a>
                    </li>
                    @endforeach
                </ul>
            </div>

            <div class="col-lg-2 mb-3">
                <h5>{{__('app.links')}}</h5>
                <ul class="list-unstyled">
                    <li class="mb-2">
                        <a href="{{ route('about') }}">
                            {{__('app.about_title')}}
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="{{ route('terms') }}">
                            {{__('app.terms_title')}}
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="mailto:{{ env('MAIL_FROM_ADDRESS') }}">
                            {{__('app.contacts')}}
                        </a>
                    </li>
                </ul>
            </div>

        </div>
    </div>
</footer>