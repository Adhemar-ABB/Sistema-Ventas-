<x-app-layout>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6">

                <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-100 mb-6">
                    Editar Proveedor
                </h2>

                {{-- Mostrar errores --}}
                @if ($errors->any())
                    <div class="mb-4 px-4 py-3 rounded bg-red-100 text-red-700 border border-red-400
                                dark:bg-red-900 dark:text-red-200 dark:border-red-700">
                        <ul class="list-disc pl-5">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('proveedores.update', $proveedor->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label class="block text-gray-700 dark:text-gray-200 font-semibold mb-2">
                            Nombre
                        </label>
                        <input type="text" name="nombre"
                            value="{{ old('nombre', $proveedor->nombre) }}"
                            class="w-full rounded border-gray-300 dark:border-gray-600
                                   dark:bg-gray-700 dark:text-white focus:ring focus:ring-blue-300"
                            required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 dark:text-gray-200 font-semibold mb-2">
                            Teléfono
                        </label>
                        <input type="text" name="telefono"
                            value="{{ old('telefono', $proveedor->telefono) }}"
                            class="w-full rounded border-gray-300 dark:border-gray-600
                                   dark:bg-gray-700 dark:text-white focus:ring focus:ring-blue-300">
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 dark:text-gray-200 font-semibold mb-2">
                            Correo
                        </label>
                        <input type="email" name="correo"
                            value="{{ old('correo', $proveedor->correo) }}"
                            class="w-full rounded border-gray-300 dark:border-gray-600
                                   dark:bg-gray-700 dark:text-white focus:ring focus:ring-blue-300">
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 dark:text-gray-200 font-semibold mb-2">
                            Estado
                        </label>
                        <select name="estado"
                            class="w-full rounded border-gray-300 dark:border-gray-600
                                   dark:bg-gray-700 dark:text-white">
                            <option value="1" {{ old('estado', $proveedor->estado) == 1 ? 'selected' : '' }}>
                                Activo
                            </option>
                            <option value="0" {{ old('estado', $proveedor->estado) == 0 ? 'selected' : '' }}>
                                Inactivo
                            </option>
                        </select>
                    </div>

                    <div class="flex justify-between">
                        <a href="{{ route('proveedores.index') }}"
                           class="px-4 py-2 rounded bg-gray-500 text-white hover:bg-gray-600 transition">
                            Volver
                        </a>

                        <button type="submit"
                            class="px-4 py-2 rounded bg-blue-600 text-white hover:bg-blue-700 transition">
                            Actualizar Proveedor
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>

</x-app-layout>