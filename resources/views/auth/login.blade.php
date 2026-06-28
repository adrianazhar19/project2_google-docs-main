```blade
<x-guest-layout>

    <div class="text-center mb-8">

        <h2 class="text-3xl font-bold text-gray-800">
            Welcome Back 👋
        </h2>

        <p class="text-gray-500 mt-2">
            Login untuk mengakses dokumen Anda
        </p>

    </div>

    <!-- Session Status -->
    <x-auth-session-status
        class="mb-4"
        :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email -->
        <div class="mb-5">

            <x-input-label
                for="email"
                :value="__('Email')" />

            <x-text-input
                id="email"
                class="block mt-2 w-full rounded-xl border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                type="email"
                name="email"
                :value="old('email')"
                required
                autofocus
                autocomplete="username" />

            <x-input-error
                :messages="$errors->get('email')"
                class="mt-2" />

        </div>

        <!-- Password -->
        <div class="mb-5">

            <x-input-label
                for="password"
                :value="__('Password')" />

            <x-text-input
                id="password"
                class="block mt-2 w-full rounded-xl border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                type="password"
                name="password"
                required
                autocomplete="current-password" />

            <x-input-error
                :messages="$errors->get('password')"
                class="mt-2" />

        </div>

        <!-- Remember -->
        <div class="flex items-center justify-between mb-6">

            <label class="flex items-center">

                <input
                    id="remember_me"
                    type="checkbox"
                    class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500"
                    name="remember">

                <span class="ml-2 text-sm text-gray-600">
                    Remember Me
                </span>

            </label>

            @if (Route::has('password.request'))

                <a href="{{ route('password.request') }}"
                    class="text-sm text-blue-600 hover:underline">

                    Forgot Password?

                </a>

            @endif

        </div>

        <!-- Login Button -->
        <button
            type="submit"
            class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 rounded-xl transition duration-300 shadow-lg">

            Login

        </button>

        <!-- Register -->
        <div class="text-center mt-6">

            <span class="text-gray-500">
                Belum punya akun?
            </span>

            <a href="{{ route('register') }}"
                class="text-blue-600 font-semibold hover:underline">

                Register

            </a>

        </div>

    </form>

</x-guest-layout>
```
