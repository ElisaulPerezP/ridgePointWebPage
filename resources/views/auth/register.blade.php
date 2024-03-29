<x-app-layout>
@slot('slotHead')
        <section id="RegistrationMessage" class="info">
            <div class="col-lg-6 text-center">
                <div class="subtitle" data-aos="fade-left">
                    Sign in to our application
                </div>
            </div>

        </section>
    @endslot
    @slot('slotMain')
        <section id="registrationForm" class="get-started section-bg">
        <div class="container" data-aos="fade-up">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        <form method="POST" action="{{ route('register') }}"  class="php-email-form">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
    <div class="flex items-center justify-center mt-4">
                            <a href="{{ route('google.login') }}">
                                <img src="https://developers.google.com/identity/images/btn_google_signin_dark_normal_web.png" alt="Log in with Google" class="ml-2" data-aos="fade-left">
                            </a>
                        </div>
@endslot
</x-app-layout>>
  