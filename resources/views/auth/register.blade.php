```blade
<x-guest-layout>

    <div class="text-center mb-8">

        <h2 class="text-3xl font-bold text-gray-800">
            Create Account 🚀
        </h2>

        <p class="text-gray-500 mt-2">
            Daftar untuk mulai menggunakan Google Docs System
        </p>

    </div>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Nama -->
        <div class="mb-5">

            <x-input-label
                for="name"
                :value="__('Nama Lengkap')" />

            <x-text-input
                id="name"
                class="block mt-2 w-full rounded-xl border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                type="text"
                name="name"
                :value="old('name')"
                required
                autofocus
                autocomplete="name" />

            <x-input-error
                :messages="$errors->get('name')"
                class="mt-2" />

        </div>

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
                autocomplete="new-password" />

            <x-input-error
                :messages="$errors->get('password')"
                class="mt-2" />

        </div>

        <!-- Konfirmasi Password -->
        <div class="mb-6">

            <x-input-label
                for="password_confirmation"
                :value="__('Konfirmasi Password')" />

            <x-text-input
                id="password_confirmation"
                class="block mt-2 w-full rounded-xl border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                type="password"
                name="password_confirmation"
                required
                autocomplete="new-password" />

            <x-input-error
                :messages="$errors->get('password_confirmation')"
                class="mt-2" />

        </div>

        <!-- Tombol Register -->
        <button
            type="submit"
            class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 rounded-xl shadow-lg transition duration-300">

            Register

        </button>

        <!-- Login -->
        <div class="text-center mt-6">

            <span class="text-gray-500">
                Sudah punya akun?
            </span>

            <a href="{{ route('login') }}"
               class="text-blue-600 font-semibold hover:underline">

                Login

            </a>

        </div>

    </form>

</x-guest-layout>
```
