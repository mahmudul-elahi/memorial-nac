@extends('frontend.master')

@section('content')
    <section id="memorial_post">
        <div class="container">

            <div class="row">
                <div class="col-md-7 mx-auto">
                    <div class="memorial-text">
                        <h3>Search Result</h3>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 mx-auto">
                    <div class="row">
                        @forelse ($items as $item)
                            <div class="col-md-4">
                                <div class="memorial-post-card">
                                    <div class="card-image">
                                        <a class="w-100 h-100"
                                            href="{{ route('show.obituary', [$item->id, $item->slug]) }}">
                                            <img src="{{ asset($item->getThumb()) }}" class="img-fluid" alt="card-image1">
                                        </a>
                                    </div>
                                    <div class="card-text">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <h6 class="aminal-name mb-0">{{ Str::limit($item->title, 10) }}</h6>
                                            <p class="aminal-type mb-0">{{ $item->category->name }}</p>
                                        </div>

                                        <div class="date d-flex">
                                            <img style="width: 20px;" src="{{ asset('assets/frontend/images/grave.svg') }}"
                                                alt="">
                                            <span>
                                                {{ Carbon\Carbon::create($item->details->death_date)->format('d M, Y') }}</span>
                                        </div>

                                        <div class="d-grid">
                                            <a href="{{ route('show.obituary', [$item->id, $item->slug]) }}"
                                                class="btn btn-primary" type="button">View Memorial</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <p>No data found</p>
                        @endforelse
                    </div>
                    <div class="pagination-container">
                        {{ $items->links() }}
                    </div>
                </div>
            </div>


            <div class="row d-block d-lg-none">
                <div class="col-md-10 mx-auto">
                    <div class="d-grid see-more">
                        <a href="#" class="btn">Show More</a>
                    </div>
                </div>
            </div>

        </div>
    </section>


    <section id="static_image">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="image-container">
                        <img src="{{ asset('assets/frontend/images/memorial1.png') }}" class="w-100" alt="">
                        <p class="overlay-text">“Forever in our hearts, never truly gone.”</p>
                    </div>
                </div>

                <div class="col-md-8">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="image-container">
                                <img src="{{ asset('assets/frontend/images/memorial2.png') }}" class="w-100"
                                    alt="">
                                <p class="overlay-text">“Every paw print on our hearts tells a story.”</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="image-container">
                                <img src="{{ asset('assets/frontend/images/memorial4.png') }}" class="w-100"
                                    alt="">
                                <p class="overlay-text">“In every beat of our hearts, they live on.”</p>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mt-4 image-container">
                                <img src="{{ asset('assets/frontend/images/memorial3.png') }}" class="w-100"
                                    alt="">
                                <p class="overlay-text">“Loved and remembered, today and always.”</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
