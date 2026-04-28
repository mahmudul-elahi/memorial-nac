<section id="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="footer">
                    <div class="logo">
                        <a href="{{ route('index') }}">
                            <img style="height: 120px; width: auto;"
                                src="{{ asset('assets/frontend/images/hero/logo1.png') }}" alt="footer">
                        </a>
                    </div>

                    <div class="text">
                        <p><a href="{{ route('index') }}">nac.memorial</a>
                            {{ $settings->find('app_description')->value }}</p>
                    </div>

                    <div class="social">
                        @foreach ($socialLinks as $link)
                            <a href="{{ $link->url }}" target="_blank">
                                <i class="{{ $link->icon }}"></i>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>


            <div class="col-md-2 pt-5 d-none d-lg-block">
                <h5>Categories</h5>
                <ul class="list-unstyled">
                    @foreach ($categories as $category)
                        <li><a href="{{ route('category', [$category->id, $category->slug]) }}"
                                class="text-light">{{ Str::before($category->name, ' ') }}</a></li>
                    @endforeach
                </ul>
            </div>

            <div class="col-md-2 pt-5 d-none d-lg-block">
                <h5>Pages</h5>
                <ul class="list-unstyled">
                    @foreach ($pages as $page)
                        <li><a href="{{ route('page.show', [$page->id, $page->slug]) }}"
                                class="text-light">{{ Str::limit($page->title, 15) }}</a></li>
                    @endforeach
                </ul>
            </div>

            <div class="col-md-2 pt-5">
                <h5>Links</h5>
                <ul class="list-unstyled">
                    <li><a href="{{ route('about') }}" class="text-light">About</a></li>
                    <li><a href="{{ route('terms') }}" class="text-light">Terms & Condition</a></li>
                    <li><a href="{{ route('contact') }}" class="text-light">Contacts</a></li>
                </ul>
            </div>

            <div class="col-md-2 pt-5">
                <h5>Contact us</h5>
                <ul class="list-unstyled">
                    <li>
                        <p>205 Helga Spring Rd, Crawford, TN 38752</p>
                    </li>
                    <li>
                        <p>Call Us: +1 23456789</p>
                    </li>
                    <li>
                        <p>my@company.com</p>
                    </li>
                </ul>
            </div>


        </div>
    </div>
</section>
