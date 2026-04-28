@extends('frontend.master')

@section('content')
    <section id="memorial_post">
        <div class="container">

            {{-- <div class="row">
                <div class="col-md-7 mx-auto">
                    <div class="memorial-text">
                        <h3>Memorials</h3>
                        <p>Remembering our cherished companions who left paw prints on our hearts. Today, we honor their
                            memories
                        </p>
                    </div>
                </div>
            </div> --}}

            <div class="row">
                <div class="col-md-12 mx-auto">
                    <div class="memorial_post">
                        <div class="row">
                            @forelse ($items as $item)
                                <div class="col-md-4">
                                    <div class="memorial-post-card">
                                        <div class="card-image">
                                            <a class="w-100 h-100"
                                                href="{{ route('show.obituary', [$item->id, $item->slug]) }}">
                                                <img src="{{ asset($item->getThumb()) }}" class="h-100 w-100"
                                                    alt="card-image1">
                                            </a>
                                        </div>
                                        <div class="card-text">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <h6 class="aminal-name mb-0">{{ Str::limit($item->title, 10) }}</h6>
                                                <p class="aminal-type mb-0">{{ $item->category->name }}</p>
                                            </div>

                                            <div class="date d-flex">
                                                <img style="width: 20px;"
                                                    src="{{ asset('assets/frontend/images/grave.svg') }}" alt="">
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
                                <p>There is no posts</p>
                            @endforelse

                        </div>
                        <div class="pagination-container">
                            {{ $items->links() }}
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <section id="static_image">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="image-container" style="height: 536px;">
                        <img src="{{ asset($pageImages[0]->image_url) }}" alt="">
                        <p class="overlay-text">{{ $pageImages[0]->text ?? '“Forever in our hearts, never truly gone.”' }}
                        </p>
                    </div>
                </div>

                <div class="col-md-8">
                    <div>
                        <div class="row gy-4">
                            <div class="col-md-6">
                                <div class="image-container" style="height: 256px;">
                                    <img src="{{ asset($pageImages[1]->image_url) }}" alt="">
                                    <p class="overlay-text">
                                        {{ $pageImages[1]->text ?? '“Every paw print on our hearts tells a story.”' }}</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="image-container" style="height: 256px;">
                                    <img src="{{ asset($pageImages[2]->image_url) }}" alt="">
                                    <p class="overlay-text">
                                        {{ $pageImages[2]->text ?? '“In every beat of our hearts, they live on.”' }}</p>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="image-container" style="height: 256px;">
                                    <img src="{{ asset($pageImages[3]->image_url) }}" alt="">
                                    <p class="overlay-text">
                                        {{ $pageImages[3]->text ?? '“Loved and remembered, today and always.”' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>


        </div>
    </section>
@endsection
