@extends('admin.layouts.app')

@section('content')
    <div class="container-xl">
        <!-- Page title -->
        <div class="page-header d-print-none">
            <div class="row align-items-center">
                <div class="col">
                    <div class="page-title text-muted">
                        {{ __('Page Titles') }}
                    </div>
                    <span class="card-subtitle">
                        {{ __('Manage the titles and subtitles for your web pages.') }}
                    </span>
                </div>
                <!-- Page title actions -->
                <div class="col-auto ms-auto d-print-none">
                    <div class="btn-list">

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="page-body">
        <div class="container-xl">
            <div class="card table-responsive">
                <div class="card-header">
                    <h2 class="card-title">
                        {{ __('Manage Page Titles') }}
                    </h2>
                </div>

                <table class="table card-table table-vcenter">
                    <thead>
                        <tr>
                            <th class="w-1">{{ __('ID') }}</th>
                            <th>{{ __('Page Identifier') }}</th>
                            <th>{{ __('Title') }}</th>
                            <th>{{ __('Subtitle') }}</th>
                            <th>{{ __('Created') }}</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pageTitles as $pageTitle)
                            <tr id="page-title-{{ $pageTitle->id }}">
                                {{-- ID --}}
                                <td class="text-muted">
                                    {{ $pageTitle->id }}
                                </td>
                                {{-- Page Identifier --}}
                                <td>
                                    {{ ucfirst($pageTitle->page_identifier) }}

                                </td>
                                {{-- Title --}}
                                <td>
                                    {{ $pageTitle->title }}
                                </td>
                                {{-- Subtitle --}}
                                <td>
                                    {{ Str::limit($pageTitle->subtitle, 40) }}
                                </td>
                                {{-- Created At --}}
                                <td>
                                    {{ $pageTitle->created_at->format('Y-m-d H:i:s') }}
                                </td>
                                <td class="text-end">
                                    <span class="dropdown">
                                        <button class="btn dropdown-toggle align-text-top" data-bs-boundary="viewport"
                                            data-bs-toggle="dropdown">Actions</button>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <a class="dropdown-item"
                                                href="{{ route('admin.page_titles.edit', $pageTitle->id) }}">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon me-2" width="24"
                                                    height="24" viewBox="0 0 24 24" stroke-width="2"
                                                    stroke="currentColor" fill="none" stroke-linecap="round"
                                                    stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path d="M9 7h-3a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-3" />
                                                    <path d="M9 15h3l8.5 -8.5a1.5 1.5 0 0 0 -3 -3l-8.5 8.5v3" />
                                                    <line x1="16" y1="5" x2="19" y2="8" />
                                                </svg>
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
            {{ $pageTitles->links() }}
        </div>
    </div>
@endsection
