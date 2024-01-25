<x-app-layout>
    @slot('slotHead')
        <section id="forgotPassowrd" class="info">
            <div class="col-lg-6 text-center">
                <div class="subtitle" data-aos="fade-left">
                    Forgot password
                </div>
            </div>
        </section>
    @endslot
    @slot('slotMain')
        <section id="forgot" class="get-started section-bg">
            <div class="py-12 container" data-aos="fade-up">
                <h2 class="mb-4 text-sm text-gray-600">
                    {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
                </h2>

                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')"/>

                <form method="POST" action="{{ route('password.email') }}" class="php-email-form">
                    @csrf

                    <!-- Email Address -->
                    <div>
                        <x-input-label for="email" :value="__('Email')"/>
                        <x-text-input id="email" class="block mt-1 w-full" type="email" name="email"
                                      :value="old('email')"
                                      required autofocus/>
                        <x-input-error :messages="$errors->get('email')" class="mt-2"/>
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <x-primary-button>
                            {{ __('Email Password Reset Link') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </section>
    @endslot
</x-app-layout>
