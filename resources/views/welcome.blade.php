<x-app-layout>
    <!-- ======= Hero Section ======= -->
    @slot('welcomeCarousel')
    <section id="hero" class="hero">

        <div class="info d-flex align-items-center">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-6 text-center">
                        <h2 data-aos="fade-down">Welcome to <span>RidgePoint Construction</span></h2>
                        <p data-aos="fade-up">We are a family owned business based in Bloomington, Indiana serving our local
                            communities.</p>
                        <a data-aos="fade-up" data-aos-delay="200" href="#get-started" class="btn-get-started">Get
                            Started</a>
                    </div>
                </div>
            </div>
        </div>
        @csrf
        <div id="hero-carousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="5000">
            <div class="carousel-item active" style="background-image: url('{{ $carousels->shift()->getFirstMediaUrl('carousel_images') }}');"></div>
            @foreach ($carousels as $carousel)
                    @if ($carousel->hasMedia('carousel_images'))
                    <div class="carousel-item" style="background-image: url('{{ $carousel->getFirstMediaUrl('carousel_images') }}');"></div>
                    @else
                        <p class="mt-4">No Image</p>
                    @endif
            @endforeach

            <a class="carousel-control-prev" href="#hero-carousel" role="button" data-bs-slide="prev">
                <span class="carousel-control-prev-icon bi bi-chevron-left" aria-hidden="true"></span>
            </a>

            <a class="carousel-control-next" href="#hero-carousel" role="button" data-bs-slide="next">
                <span class="carousel-control-next-icon bi bi-chevron-right" aria-hidden="true"></span>
            </a>

        </div>

    </section><!-- End Hero Section -->
    @endslot
    @slot('contactForm')
        <section id="get-started" class="get-started section-bg">
            <div class="container">

                <div class="row justify-content-between gy-4">

                    <div class="col-lg-6 d-flex align-items-center" data-aos="fade-up">
                        <div class="content">
                            <h3>Allow us to help you get an approximate idea of the price for your project.</h3>
                            <p>This application will allow you to obtain a quote in record time. To do so, you must follow the steps. Start by filling out the form displayed below.</p>
                        </div>
                    </div>

                    <div class="col-lg-5" data-aos="fade">
                        <form action="{{ route('quotes.store') }}" class="php-email-form" method="POST" enctype="multipart/form-data">
                            @csrf
                            <h3>Get a quote</h3>
                            <p>Please fill out the following form, and we will contact you shortly.</p>
                            <div class="row gy-3">

                                <div class="col-md-12">
                                    <input type="text" name="name" class="form-control" placeholder="Name" required>
                                </div>

                                <div class="col-md-12 ">
                                    <input type="email" class="form-control" name="email" placeholder="Email" required>
                                </div>

                                <div class="col-md-12">
                                    <input type="text" class="form-control" name="phone" placeholder="Phone" required>
                                </div>

                                <div class="col-md-12">
                                    <textarea class="form-control" name="message" rows="6" placeholder="Message" required></textarea>
                                </div>

                                <div class="col-md-12 text-center">
                                    <div class="loading">Loading</div>
                                    <div class="error-message"></div>
                                    <div class="sent-message">Your quote request has been sent successfully. Thank you!</div>

                                    <button type="submit">Get a quote</button>
                                </div>

                            </div>
                        </form>
                    </div><!-- End Quote Form -->

                </div>

            </div>
        </section><!-- End Get Started Section -->
    @endslot
</x-app-layout>

