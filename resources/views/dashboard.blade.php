<x-app-layout>
    <!-- ======= Hero Section ======= -->
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
            <div class="carousel-item active" style="background-image: url('{{ asset('storage/img/hero-carousel/muestra5.jpg') }}');"></div>
            <div class="carousel-item" style="background-image: url('{{ asset('storage/img/hero-carousel/muestra4.jpg') }}');"></div>
            <div class="carousel-item" style="background-image: url('{{ asset('storage/img/hero-carousel/muestra3.jpg') }}');"></div>
            <div class="carousel-item" style="background-image: url('{{ asset('storage/img/hero-carousel/hero-carousel-4.jpg') }}');"></div>
            <div class="carousel-item" style="background-image: url('{{ asset('storage/img/hero-carousel/muestra2.jpg') }}');"></div>

            <a class="carousel-control-prev" href="#hero-carousel" role="button" data-bs-slide="prev">
                <span class="carousel-control-prev-icon bi bi-chevron-left" aria-hidden="true"></span>
            </a>

            <a class="carousel-control-next" href="#hero-carousel" role="button" data-bs-slide="next">
                <span class="carousel-control-next-icon bi bi-chevron-right" aria-hidden="true"></span>
            </a>

        </div>

    </section><!-- End Hero Section -->
</x-app-layout>
