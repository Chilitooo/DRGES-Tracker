<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Role Selection -->
        <div class="mt-4 mb-4">
            <label class="block font-medium text-sm text-gray-700 dark:text-gray-300">
                Login As
            </label>

            <select name="role" required
                class="block mt-1 w-full border-gray-300 dark:border-gray-700 
                dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 
                dark:focus:border-indigo-600 focus:ring-indigo-500 
                dark:focus:ring-indigo-600 rounded-md shadow-sm">

                <option value="">Select Role</option>
                <option value="admin">Admin</option>
                <option value="staff">Staff</option>

            </select>
            {{-- SHOW ROLE ERROR HERE --}}
            @if ($errors->has('role'))
                <div class="mt-2 p-2 bg-red-100 text-red-700 border border-red-400 rounded">
                    ⚠ {{ $errors->first('role') }}
                </div>
            @endif
        </div>
        
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
            <label for="remember_me" class="inline-flex text-center">
                <input id="remember_me" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" name="remember">
                <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me.') }}</span>

                @if (Route::has('register'))
                    <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none     focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800 ms-auto ml-6" href="{{ route('register') }}">
                        {{ __("Don't have an account? Register") }}
                    </a>
                @endif
            </label>
        </div>

        <div class="flex items-center mt-4">
            <div>
               
            </div>
            <div>
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif   
            </div>
            <div class="ms-auto">
                <x-primary-button class="ml-3">
                    {{ __('Log in') }}
                </x-primary-button>
            </div>
        </div>

        @if(session('success'))
            <div class="mb-4 text-green-600">
                {{ session('success') }}
            </div>
        @endif
        
    </form>
</x-guest-layout>
