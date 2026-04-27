<x-guest-layout>
    <div class="flex items-center min-h-screen p-6 bg-gray-50 dark:bg-gray-900">
        <div class="flex-1 h-full max-w-4xl mx-auto overflow-hidden bg-white rounded-lg shadow-xl dark:bg-gray-800">
            <div class="flex flex-col overflow-y-auto md:flex-row">

                <!-- Imagen -->
                <div class="h-32 md:h-auto md:w-1/2">
                    <img
                        aria-hidden="true"
                        class="object-cover w-full h-full dark:hidden"
                        src="https://images.unsplash.com/photo-1521737604893-d14cc237f11d?auto=format&fit=crop&w=1200&q=80"
                        alt="Office"
                    />

                    <img
                        aria-hidden="true"
                        class="hidden object-cover w-full h-full dark:block"
                        src="https://images.unsplash.com/photo-1520607162513-77705c0f0d4a?auto=format&fit=crop&w=1200&q=80"
                        alt="Office"
                    />
                </div>

                <!-- Formulario -->
                <div class="flex items-center justify-center p-6 sm:p-12 md:w-1/2">
                    <div class="w-full">

                        <h1 class="mb-4 text-xl font-semibold text-gray-700 dark:text-gray-200">
                            INICIAR SESION
                        </h1>

                        <!-- Session Status -->
                        <x-auth-session-status class="mb-4" :status="session('status')" />

                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <!-- Email -->
                            <div>
                                <x-input-label for="email" :value="__('Correo Electronico')" class="text-gray-700 dark:text-gray-400" />

                                <x-text-input
                                    id="email"
                                    class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 focus:border-purple-400 focus:outline-none focus:ring-purple-400"
                                    type="email"
                                    name="email"
                                    :value="old('email')"
                                    required
                                    autofocus
                                    autocomplete="username"
                                    placeholder="ingrese su correo electronico"
                                />

                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            </div>

                            <!-- Password -->
                            <div class="mt-4">
                                <x-input-label for="password" :value="__('Contraseña')" class="text-gray-700 dark:text-gray-400" />

                                <x-text-input
                                    id="password"
                                    class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 focus:border-purple-400 focus:outline-none focus:ring-purple-400"
                                    type="password"
                                    name="password"
                                    required
                                    autocomplete="current-password"
                                    placeholder="Ingrese su contraseña"
                                />

                                <x-input-error :messages="$errors->get('password')" class="mt-2" />
                            </div>

                            <!-- Remember Me -->
                            <div class="block mt-4">
                                <label for="remember_me" class="inline-flex items-center">
                                    <input
                                        id="remember_me"
                                        type="checkbox"
                                        class="rounded border-gray-300 text-purple-600 shadow-sm focus:ring-purple-500 dark:bg-gray-900 dark:border-gray-700 dark:focus:ring-purple-600 dark:focus:ring-offset-gray-800"
                                        name="remember"
                                    >
                                    <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">
                                        {{ __('Recordar los datos') }}
                                    </span>
                                </label>
                            </div>

                            <!-- Botón Login -->
                            <button
                                type="submit"
                                class="block w-full px-4 py-2 mt-4 text-sm font-medium leading-5 text-center text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:ring focus:ring-purple-300"
                            >
                                {{ __('iniciar Sesion') }}
                            </button>

                            <hr class="my-8" />

                            <!-- Forgot Password -->
                            @if (Route::has('password.request'))
                                <p class="mt-4">
                                    <a
                                        class="text-sm font-medium text-purple-600 dark:text-purple-400 hover:underline"
                                        href="{{ route('password.request') }}"
                                    >
                                        {{ __('¿Olvidaste de tu contraseña?') }}
                                    </a>
                                </p>
                            @endif

                            <!-- Register -->
                            @if (Route::has('register'))
                                <p class="mt-1">
                                    <a
                                        class="text-sm font-medium text-purple-600 dark:text-purple-400 hover:underline"
                                        href="{{ route('register') }}"
                                    >
                                        {{ __('Crear Cuenta') }}
                                    </a>
                                </p>
                            @endif

                        </form>

                    </div>
                </div>

            </div>
        </div>
    </div>
</x-guest-layout>