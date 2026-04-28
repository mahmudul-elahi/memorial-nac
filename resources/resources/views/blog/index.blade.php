@extends('layouts.app')
@section('content')

<div class="page-body">
    <div class="container">
        <div class="row row-cards">
            <div class="col-lg-12">
                <div class="row row-cards">
                    @forelse($posts as $post)
                    <div class="col-lg-3">
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
        </div>
    </div>
</div>

@endsection
