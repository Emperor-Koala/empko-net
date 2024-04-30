<x-guest-layout>

    <div class="absolute inset-0 flex items-center h-full justify-center">

        <form class="w-80 border-1 rounded-md p-4 bg-neutral-100 dark:bg-neutral-700 shadow-md" method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" :value="__('Password')" />

                <x-text-input id="password" class="block mt-1 w-full"
                type="password"
                name="password"
                required autocomplete="current-password" />

                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Remember Me -->
            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" class="rounded dark:bg-neutral-800 border-neutral-300 dark:border-neutral-700 text-primary shadow-sm focus:ring-primary dark:focus:ring-offset-neutral-800" name="remember">
                    <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">Remember Me</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-hex-button class="w-24 h-8 text-white !text-base" type="submit">
                    Log In
                </x-hex-button>
            </div>
        </form>
    </div>
</x-guest-layout>
