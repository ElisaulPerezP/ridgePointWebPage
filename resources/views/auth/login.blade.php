<x-app-layout>
    @slot('slotHead')
        <section id="loginMessage" class="info">
            <div class="col-lg-6 text-center">
                <div class="subtitle" data-aos="fade-left">
                    Sign in to our application
                </div>
            </div>

        </section>
    @endslot
    @slot('slotMain')
        <section id="editForm" class="get-started section-bg">
            <div class="container" data-aos="fade-up">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                    <!-- Session Status -->
                    <x-auth-session-status class="mb-4" :status="session('status')"/>

                    <form method="POST" action="{{ route('login') }}" class="php-email-form">
                        @csrf
                        <div class="flex items-center justify-center mt-4">
                            <a href="{{ route('google.login') }}">
                                <img src="https://developers.google.com/identity/images/btn_google_signin_dark_normal_web.png" alt="Log in with Google" class="ml-2" data-aos="fade-left">
                            </a>
                        </div>
                        <!-- Email Address -->
                        <div class="php-email-form">
                            <x-input-label for="email" :value="__('Email')"/>
                            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email"
                                          :value="old('email')"
                                          required autofocus autocomplete="username"/>
                            <x-input-error :messages="$errors->get('email')" class="mt-2"/>
                        </div>

                        <!-- Password -->
                        <div class="php-email-form">
                            <x-input-label for="password" :value="__('Password')"/>

                            <x-text-input id="password" class="block mt-1 w-full"
                                          type="password"
                                          name="password"
                                          required autocomplete="current-password"/>

                            <x-input-error :messages="$errors->get('password')" class="mt-2"/>
                        </div>

                        <!-- Remember Me -->
                        <div class="php-email-form">
                            <label for="remember_me" class="inline-flex items-center">
                                <input id="remember_me" type="checkbox"
                                       class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"
                                       name="remember">
                                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                            </label>
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            @if (Route::has('password.request'))
                                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                                   href="{{ route('password.request') }}">
                                    {{ __('Forgot your password?') }}
                                </a>
                            @endif

                            <x-primary-button class="ms-3">
                                {{ __('Log in') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    @endslot
</x-app-layout>>
