
<x-app-layout>




<div class="py-6">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

        <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6">

            <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-100 mb-6">
                Editar categoria
                
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

         <form action="{{ route('categorias.update', $categoria->id) }}" method="POST">
    @csrf
    @method('PUT')

    <input type="hidden" id="categoria-id" name="id">

                <div class="mb-4">
                    <label class="block text-gray-700 dark:text-gray-200 font-semibold mb-2">
                        Nombre 
                    </label>
                    <input type="text" name="nombre"
                        value="{{ old('nombre', $categoria->nombre) }}"
                        class="w-full rounded border-gray-300 dark:border-gray-600
                               dark:bg-gray-700 dark:text-white focus:ring focus:ring-blue-300"
                        required>
                </div>

   <div class="mb-4">
    <label class="block text-gray-700 dark:text-gray-200 font-semibold mb-2">
        Descripción
    </label>

    <textarea name="descripcion"
        class="w-full rounded border-gray-300 dark:border-gray-600
               dark:bg-gray-700 dark:text-white focus:ring focus:ring-blue-300"
        rows="3">{{ old('descripcion', $categoria->descripcion) }}</textarea>
</div>


                <div class="mb-4">
                    <label class="block text-gray-700 dark:text-gray-200 font-semibold mb-2">
                        Estado
                    </label>
                    <select name="estado"
                        class="w-full rounded border-gray-300 dark:border-gray-600
                               dark:bg-gray-700 dark:text-white">
                        <option value="1" {{ old('estado', $categoria->estado) == 1 ? 'selected' : '' }}>
                            Activo
                        </option>
                        <option value="0" {{ old('estado', $categoria->estado) == 0 ? 'selected' : '' }}>
                            Inactivo
                        </option>
                    </select>
                </div>


    <div class="flex justify-center pt-4 border-t border-gray-200 dark:border-gray-700">
        <button type="submit"
            class="flex items-center px-5 py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg text-sm">
            <i class="far fa-floppy-disk mr-2"></i>
            Guardar Cambios
        </button>
    </div>
</form>
        </div>
    </div>
</div>




</x-app-layout>

