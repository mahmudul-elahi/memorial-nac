@extends('frontend.master')

@section('content')
    <section id="contact_form">


        @if (session('failed'))
            <div id="floating-alert" class="alert alert-success text-dark alert-dismissible fade show" role="alert">
                {{ session('failed') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <form action="{{ route('contact.submit') }}" method="POST" class="contact-form">
            @csrf
            <div class="container">

                <div class="row">
                    <div class="col-md-11 mx-auto">
                        <div class="card" style="padding: 30px;">
                            <div class="row">

                                <div class="col-md-4">
                                    <div class="image rounded overflow-hidden">
                                        <img src="{{ asset('assets/frontend/images/memorial1.png') }}" alt=""
                                            style="height: 100%; width: auto; object-fit: cover; object-position: center;">
                                    </div>
                                </div>

                                <div class="col-md-8">
                                    <div class="row">
                                        <div class="col-md-12 text-center">
                                            <div class="text pb-4">
                                                <h1 class="display-5">Contact Us</h1>
                                                <i>Get in touch with us – we’d love to hear from you!</i>
                                            </div>
                                        </div>

                                        <!-- Name Field -->
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <input type="text" class="form-control" name="name"
                                                    placeholder="Name" />
                                                @error('name')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>

                                        <!-- Email Field -->
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <input type="text" class="form-control" name="email"
                                                    placeholder="E-mail" />
                                                @error('email')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>

                                        <!-- Subject Field -->
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <input type="text" class="form-control" name="subject"
                                                    placeholder="Subject" />
                                                @error('subject')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>

                                        <!-- Message Field -->
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <textarea class="form-control" name="message" rows="6" placeholder="Message"></textarea>
                                                @error('message')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>

                                        <!-- Submit Button -->
                                        <div class="col-md-3">
                                            <div class="d-grid">
                                                <button type="submit" class="btn btn-primary custom-btn">Send
                                                    Message</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </form>
    </section>
@endsection
