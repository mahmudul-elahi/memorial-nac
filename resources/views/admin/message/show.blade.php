@extends('admin.layouts.app')
@section('content')
    <!-- Show Contact Message -->
    <div class="container-xl">
        <!-- Page title -->
        <div class="page-header d-print-none">
            <div class="row align-items-center">
                <div class="col">
                    <div class="page-title text-muted">
                        {{ __('View Message') }}
                    </div>
                    <span class="card-subtitle">
                        {{ __('Detailed view of the message.') }}
                    </span>
                </div>
                <!-- Page title actions -->
                <div class="col-auto ms-auto d-print-none">
                    <div class="btn-list">
                        <a href="{{ route('admin.message') }}" class="btn btn-secondary">
                            {{ __('Back to Messages') }}
                        </a>
                        <form action="{{ route('admin.message.destroy', $message->id) }}" method="GET"
                            class="d-inline-block" onsubmit="return confirm('Are you sure?')">
                            @csrf
                            <button type="submit" class="btn btn-danger">{{ __('Delete') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="page-body">
        <div class="container-xl">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title mb-4">{{ __('Message Details') }}</h3>

                    <div class="mb-3">
                        <strong>{{ __('Name:') }}</strong>
                        <p class="text-muted">{{ $message->name }}</p>
                    </div>

                    <div class="mb-3">
                        <strong>{{ __('Email:') }}</strong>
                        <p class="text-muted">
                            <a href="mailto:{{ $message->email }}">{{ $message->email }}</a>
                        </p>
                    </div>

                    <div class="mb-3">
                        <strong>{{ __('Subject:') }}</strong>
                        <p class="text-muted">{{ $message->subject }}</p>
                    </div>

                    <div class="mb-3">
                        <strong>{{ __('Message:') }}</strong>
                        <p class="text-muted">{{ $message->message }}</p>
                    </div>

                    <div class="mb-3">
                        <strong>{{ __('Received on:') }}</strong>
                        <p class="text-muted">{{ $message->created_at }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
