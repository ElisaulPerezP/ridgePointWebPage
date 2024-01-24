<x-app-layout>
    @slot('slotHead')
        <section id="editProfile" class="info">
            <div class="col-lg-6 text-center">
                <div class="subtitle" data-aos="fade-down">
                    Editing profile for: {{ auth()->user()->name }}
                </div>
            </div>
        </section><!-- END edit section -->
    @endslot
    @slot('slotMain')
        <section id="editForm" class="get-started section-bg">
            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6" >
                    <div class="php-email-form" data-aos="fade-up">
                        <div class="max-w-xl">
                            @include('profile.partials.update-profile-information-form')
                        </div>
                    </div>

                    <div class="php-email-form" data-aos="fade-up">
                        <div class="max-w-xl">
                            @include('profile.partials.update-password-form')
                        </div>
                    </div>

                    <div class="php-email-form" data-aos="fade-up">
                        <div class="max-w-xl">
                            @include('profile.partials.delete-user-form')
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endslot
</x-app-layout>
