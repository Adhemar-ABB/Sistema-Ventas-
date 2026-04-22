<x-app-layout>


<div class="py-6">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

        {{-- Mensaje de éxito --}}
      @if (session('success'))
    <div class="mb-4 px-4 py-3 rounded border 
                bg-green-100 text-green-800 border-green-400
                dark:bg-black dark:text-white dark:border-green-500">
        {{ session('success') }}
    </div>
@endif

        <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6">

            {{-- Encabezado --}}
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-100">
                    Lista de Clientes
                </h2>

                <a href="{{ route('clientes.create') }}"
                   class="px-4 py-2 rounded bg-blue-600 text-white hover:bg-blue-700 transition
                          dark:bg-blue-500 dark:hover:bg-blue-600">
                    + Nuevo Cliente
                </a>
            </div>

            {{-- Tabla --}}
            <div class="overflow-x-auto">
                <table class="min-w-full border border-gray-200 dark:border-gray-700">
                    <thead>
                        <tr class="bg-gray-100 dark:bg-gray-700">
                            <th class="px-4 py-2 text-left text-gray-700 dark:text-gray-200">ID</th>
                            <th class="px-4 py-2 text-left text-gray-700 dark:text-gray-200">Nombre Completo</th>
                            <th class="px-4 py-2 text-left text-gray-700 dark:text-gray-200">Teléfono</th>
                            <th class="px-4 py-2 text-left text-gray-700 dark:text-gray-200">Correo</th>
                            <th class="px-4 py-2 text-left text-gray-700 dark:text-gray-200">Carnet</th>
                            <th class="px-4 py-2 text-left text-gray-700 dark:text-gray-200">Estado</th>
                            <th class="px-4 py-2 text-center text-gray-700 dark:text-gray-200">Acciones</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($clientes as $cliente)
                            <tr class="border-t border-gray-200 dark:border-gray-700
           hover:bg-gray-100 dark:hover:bg-gray-800 transition">

                                <td class="px-4 py-2 text-gray-800 dark:text-gray-100">
                                    {{ $cliente->id }}
                                </td>

                                <td class="px-4 py-2 text-gray-800 dark:text-gray-100">
                                    {{ $cliente->nombre_completo }}
                                </td>

                                <td class="px-4 py-2 text-gray-800 dark:text-gray-100">
                                    {{ $cliente->telefono ?? '---' }}
                                </td>

                                <td class="px-4 py-2 text-gray-800 dark:text-gray-100">
                                    {{ $cliente->correo ?? '---' }}
                                </td>

                                <td class="px-4 py-2 text-gray-800 dark:text-gray-100">
                                    {{ $cliente->carnet }}
                                </td>

        <td class="px-4 py-2">
    @if ($cliente->estado == 1)
        <span class="px-2 py-1 rounded text-sm 
                     bg-green-200 text-green-900
                     dark:bg-black dark:text-white dark:border dark:border-green-500">
            Activo
        </span>
    @else
        <span class="px-2 py-1 rounded text-sm 
                     bg-red-200 text-red-900
                     dark:bg-black dark:text-white dark:border dark:border-red-500">
            Inactivo
        </span>
    @endif
</td>

                                <td class="px-4 py-2 text-center flex gap-2 justify-center">

                                    <a href="{{ route('clientes.edit', $cliente->id) }}"
                                       class="px-3 py-1 rounded bg-yellow-500 text-white hover:bg-yellow-600 transition">
                                        Editar
                                    </a>

                                <form action="{{ route('clientes.destroy', $cliente->id) }}" method="POST"
      onsubmit="return confirm('¿Seguro que deseas eliminar este cliente?')">
    @csrf
    @method('DELETE')

    <button type="submit"
        class="px-3 py-1 rounded bg-red-600 text-white hover:bg-red-700 transition">
        Eliminar
    </button>
</form>

                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center px-4 py-6 text-gray-600 dark:text-gray-300">
                                    No hay clientes registrados.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>




</x-app-layout>
