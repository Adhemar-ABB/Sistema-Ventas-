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
                        alt="Office Dark"
                    />
                </div>

                <!-- Formulario -->
                <div class="flex items-center justify-center p-6 sm:p-12 md:w-1/2">
                    <div class="w-full">

                        <h1 class="mb-4 text-xl font-semibold text-gray-700 dark:text-gray-200">
                            Crear Cuenta
                        </h1>

                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <!-- Name -->
                            <div>
                                <x-input-label for="name" :value="__('Nombre Completo')" class="text-gray-700 dark:text-gray-400" />

                                <x-text-input
                                    id="name"
                                    class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none dark:text-gray-300"
                                    type="text"
                                    name="name"
                                    :value="old('name')"
                                    required autofocus
                                    autocomplete="name"
                                    placeholder="Ingrese su nombre"
                                />

                                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                            </div>

                            <!-- Email -->
                            <div class="mt-4">
                                <x-input-label for="email" :value="__('Correo Electronico ')" class="text-gray-700 dark:text-gray-400" />

                                <x-text-input
                                    id="email"
                                    class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none dark:text-gray-300"
                                    type="email"
                                    name="email"
                                    :value="old('email')"
                                    required
                                    autocomplete="username"
                                    placeholder="Ingrese su correo electronico"
                                />

                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            </div>

                            <!-- Password -->
                            <div class="mt-4">
                                <x-input-label for="password" :value="__('Contraseña')" class="text-gray-700 dark:text-gray-400" />

                                <x-text-input
                                    id="password"
                                    class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none dark:text-gray-300"
                                    type="password"
                                    name="password"
                                    required
                                    autocomplete="new-password"
                                    placeholder="Ingrese su COntraseña"
                                />

                                <x-input-error :messages="$errors->get('password')" class="mt-2" />
                            </div>

                            <!-- Confirm Password -->
                            <div class="mt-4">
                                <x-input-label for="password_confirmation" :value="__('Confirmar Contraseña')" class="text-gray-700 dark:text-gray-400" />

                                <x-text-input
                                    id="password_confirmation"
                                    class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none dark:text-gray-300"
                                    type="password"
                                    name="password_confirmation"
                                    required
                                    autocomplete="new-password"
                                    placeholder="***************"
                                />

                                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                            </div>

                            <!-- Checkbox -->
                            <div class="flex mt-6 text-sm">
                                <label class="flex items-center dark:text-gray-400">
                                    <input
                                        type="checkbox"
                                        required
                                        class="text-purple-600 rounded focus:ring-purple-400 dark:bg-gray-700 dark:border-gray-600"
                                    />
                                    <span class="ml-2">
                                        Acepto la
                                        <span class="underline">politica de privacidad</span>
                                    </span>
                                </label>
                            </div>

                            <!-- Botón -->
                            <button
                                type="submit"
                                class="block w-full px-4 py-2 mt-4 text-sm font-medium leading-5 text-center text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:ring focus:ring-purple-300"
                            >
                                Crear Cuenta
                            </button>

                         

                     

                            <!-- Link login -->
                            <p class="mt-4">
                                <a
                                    class="text-sm font-medium text-purple-600 dark:text-purple-400 hover:underline"
                                    href="{{ route('login') }}"
                                >
                                    ¿Ya tienes una cuenta? Iniciar Sesion
                                </a>
                            </p>

                        </form>

                    </div>
                </div>

            </div>
        </div>
    </div>
</x-guest-layout>