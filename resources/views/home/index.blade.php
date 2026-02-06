@extends('layouts.main')
@section('content')
    <div>

        {{-- session alert --}}
        <x-session-alert/>

        <header class="header">
            <!-- hero -->
            <div class="hero pt-7">
                <div class="container-xl">
                    <div class="row">
                        <div class="col-md-6 my-auto">
                            <div class="image-container mb-5 px-4">
                                <img src="images/esp32.jpg" class="img-fluid rounded d-block w-100" alt="">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="text-container p-4 d-flex flex-column justify-content-center h-100 mb-5">
                                <h1 class="display-3 fw-bold">welcome To Blog Mastery</h1>
                                <p class="lead">
                                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Repudiandae non libero, nihil
                                    consequuntur
                                    cupiditate repellat optio nobis vero temporibus et quod? Voluptatibus accusamus error,
                                    iste quisquam ex
                                    blanditiis a inventore officia. Nesciunt magni in aliquam non saepe repellendus at
                                    dolorum?
                                </p>

                                <!-- Form -->
                                <div class="form-container text-center">
                                    <div class="d-grid">
                                        <a href="/login" class="btn btn-primary btn-lg text-white">Login</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <svg class="frame-decoration" data-name="Layer 2" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none"
                viewBox="0 0 1920 192.275">
                <defs>
                    <style>
                        .cls-1 {
                            fill: #f3f6f9;
                        }
                    </style>
                </defs>
                <title>frame-decoration</title>
                <path class="cls-1"
                    d="M0,158.755s63.9,52.163,179.472,50.736c121.494-1.5,185.839-49.738,305.984-49.733,109.21,0,181.491,51.733,300.537,50.233,123.941-1.562,225.214-50.126,390.43-50.374,123.821-.185,353.982,58.374,458.976,56.373,217.907-4.153,284.6-57.236,284.6-57.236V351.03H0V158.755Z"
                    transform="translate(0 -158.755)"></path>
            </svg>
        </header>

        <!-- Introduction -->
        <section id="introduction" class="intro py-6">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 offset-lg-2 text-center">
                        <h2>
                            Creating <span class="text-secondary">Inspiring</span> Office
                            Spaces
                        </h2>
                        <p class="fs-5">
                            At our company, designing office spaces is our passion. We take
                            pride in our completed projects that reflect our dedication and
                            expertise in creating functional and aesthetically pleasing work
                            environments.
                        </p>
                    </div>
                </div>
            </div>
        </section>


        <!-- Services -->
        <section id="services" class="services bg-light py-6">
            <div class="container">
                <div class="row">
                    <div class="col-lg-5">
                        <div class="text-container text-center text-lg-start">
                            <h2>
                                <span class="text-secondary">Services</span> that we offer
                            </h2>
                            <p>
                                At our company, we provide a wide range of services to meet all
                                your office design needs. With our expertise and attention to
                                detail, we ensure that every aspect of your office space is
                                carefully considered and executed.
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-7">
                        <div class="row mb-4">
                            <div class="col-md-4 d-flex flex-column align-items-center text-center">
                                <i class="fas fa-rocket fa-4x text-secondary mb-2"></i>
                                <p class="fs-5 fw-bold">Space Analysis & Planning</p>
                            </div>
                            <div class="col-md-4 d-flex flex-column align-items-center text-center">
                                <i class="fas fa-clock fa-4x text-secondary mb-2"></i>
                                <p class="fs-5 fw-bold">Design & Color Choosing</p>
                            </div>
                            <div class="col-md-4 d-flex flex-column align-items-center text-center">
                                <i class="fas fa-comments fa-4x text-secondary mb-2"></i>
                                <p class="fs-5 fw-bold">Materials & Delivery</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 d-flex flex-column align-items-center text-center">
                                <i class="fas fa-tools fa-4x text-secondary mb-2"></i>
                                <p class="fs-5 fw-bold">Execute The Concept</p>
                            </div>
                            <div class="col-md-4 d-flex flex-column align-items-center text-center">
                                <i class="fas fa-chart-pie fa-4x text-secondary mb-2"></i>
                                <p class="fs-5 fw-bold">Create A Great Atmosphere</p>
                            </div>
                            <div class="col-md-4 d-flex flex-column align-items-center text-center">
                                <i class="fas fa-chart-bar fa-4x text-secondary mb-2"></i>
                                <p class="fs-5 fw-bold">Evaluation & Reporting</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Contact Us -->
        <section id="contact" class="contact my-6 position-relative">
            <div class="container position-relative z-3">
                <div class="row">
                    <div class="col-lg-6 d-none d-md-block">
                        <div class="image-container">
                            <img src="images/contact.png" alt="" class="img-fluid" />
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="text-container">
                            <h2>Contact Us For A Quote</h2>
                            <form action="{{route('contacts.store')}}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <input name="name" id="name" type="text" class="form-control"
                                        placeholder="Enter name" />
                                </div>
                                <div class="mb-3">
                                    <input name="email" id="email" type="email" class="form-control"
                                        placeholder="Enter email" />
                                </div>
                                <div class="mb-3">
                                    <textarea name="message" id="message" class="form-control" placeholder="Enter message" rows="8"></textarea>
                                </div>
                                <div class="d-grid gap-2">
                                    <input type="submit" value="Send" class="btn btn-primary btn-block" />
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
