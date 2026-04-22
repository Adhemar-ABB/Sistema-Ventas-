




<x-app-layout>

<div class="py-6">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

        <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6">

            <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-100 mb-6">
                Registrar categorias
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

           <form action="{{ route('categorias.store') }}" method="POST">
    @csrf

    <div class="mb-5">
        <label for="nombre" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
            Nombre <span class="text-red-500">*</span>
        </label>

        <input type="text" name="nombre" id="nombre" value="{{ old('nombre') }}" required
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-purple-500
            focus:border-purple-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
    </div>

    <div class="mb-5">
        <label for="descripcion" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
            Descripción
        </label>

        <textarea name="descripcion" id="descripcion" rows="3"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-purple-500
            focus:border-purple-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white">{{ old('descripcion') }}</textarea>
    </div>

    <div class="flex justify-center pt-4 border-t border-gray-200 dark:border-gray-700">
        <button type="submit"
            class="flex items-center px-5 py-2.5 bg-purple-600 hover:bg-purple-700 text-white font-medium rounded-lg text-sm">
            <i class="far fa-floppy-disk mr-2"></i>
            Guardar Categoría
        </button>
    </div>
</form>
        </div>
    </div>
</div>


</x-app-layout>