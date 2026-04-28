@extends('admin.layouts.app')

@section('content')
    <div class="container-xl">
        <!-- Page title -->
        <div class="page-header d-print-none">
            <div class="row align-items-center">
                <div class="col">
                    <h2 class="page-title">
                        {{ __('Page Images') }}
                    </h2>
                    <span class="card-subtitle">
                        {{ __('Manage the images and overlay text displayed on the page.') }}
                    </span>
                </div>
            </div>
        </div>

        <div class="page-body">
            <div class="container-xl">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{ __('Images List') }}</h3>
                    </div>

                    <table class="table card-table table-vcenter">
                        <thead>
                            <tr>
                                <th class="w-1">{{ __('ID') }}</th>
                                <th>{{ __('Image') }}</th>
                                <th>{{ __('Overlay Text') }}</th>
                                <th class="text-end">{{ __('Actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pageImages as $pageImage)
                                <tr>
                                    <td class="text-muted">{{ $pageImage->id }}</td>

                                    <!-- Display Image as Background -->
                                    <td class="">
                                        <span class="avatar"
                                            style="background-image: url('{{ asset($pageImage->image_url) }}');"></span>
                                    </td>
                                    <!-- Display Overlay Text -->
                                    <td>
                                        <span class="text-muted">{{ $pageImage->text }}</span>
                                    </td>

                                    <!-- Action Buttons -->
                                    <td class="text-end">
                                        <span class="dropdown">
                                            <button class="btn dropdown-toggle align-text-top" data-bs-toggle="dropdown">
                                                {{ __('Actions') }}
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <a href="{{ route('admin.page_images.edit', $pageImage->id) }}"
                                                    class="dropdown-item">
                                                    {{ __('Edit') }}
                                                </a>
                                            </div>
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
