@extends('layouts.app')
@section('content')

<div class="page-body">
    <div class="container-xl">
        <div class="row row-cards">
            {{-- Blog posts --}}
            <div class="col-lg-9 order-0">
                <div class="row row-cards">
                    @forelse($posts as $post)
                    <div class="col-lg-4">
                        @include('blog.card.index')
                    </div>
                    @empty
                    {{__('app.no_results')}}
                    @endforelse

                    <div class="">
                        {{ $posts->links() }}
                    </div>
                </div>
            </div>
            <!-- Sidebar -->
            <div class="col-lg-3 order-1">

                <!-- Condolences Card -->
                <div class="card mb-3">
                    <div class="card-header">
                        <h2 class="card-title">
                            {{__('app.categories')}} ({{ $totalCategories }})
                        </h2>
                    </div>
                    <div class="card-body">
                        <div class="divide-y">
                            @forelse($blogCategories as $category)
                            <div class="d-flex justify-content-between">
                                <a href="{{ route("blog.categories.show", $category->slug) }}">
                                    {{ $category->name }}
                                </a>
                                <span class="badge bg-cyan-lt"> {{ $category->posts_count }}</span>
                            </div>
                            @empty
                            {{__('app.no_categories_found')}}
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
