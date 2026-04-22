<x-app-layout>


    <!-- Header Section -->
    <div class="px-6 py-2 border-b border-gray-100 dark:border-gray-700">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between">
            <div>
                <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-100">
                    <span class="inline-flex items-center">
                        <i class="fas fa-users mr-3 text-purple-500"></i>
                        Registro de Clientes
                    </span>
                </h2>
                <p class="mt-1 text-xs md:text-sm text-gray-500 dark:text-gray-400">
                    Administra y organiza los clientes registrados
                </p>
            </div>

            <!-- Breadcrumb -->
            <nav class="mt-4 md:mt-0" aria-label="Breadcrumb">
                <ol class="flex items-center space-x-2 text-sm">
                    <li>
                        <a href="{{ route('dashboard') }}"
                            class="flex items-center text-purple-600 hover:text-purple-700 dark:text-purple-400 dark:hover:text-purple-300 transition-colors">
                            <i class="fas fa-home mr-2"></i>
                            Panel
                        </a>
                    </li>
                    <li class="flex items-center">
                        <i class="fas fa-chevron-right text-gray-400 mx-2 text-xs"></i>
                        <span class="text-gray-500 dark:text-gray-400">Clientes</span>
                    </li>
                    <li class="flex items-center">
                        <i class="fas fa-chevron-right text-gray-400 mx-2 text-xs"></i>
                        <span class="font-medium text-gray-700 dark:text-gray-300">Listado</span>
                    </li>
                </ol>
            </nav>
        </div>
    </div>

    {{-- Mensaje de éxito --}}
    @if (session('success'))
        <div
            class="mx-6 mt-4 px-4 py-3 rounded border 
                    bg-green-100 text-green-800 border-green-400
                    dark:bg-black dark:text-white dark:border-green-500">
            {{ session('success') }}
        </div>
    @endif

    {{-- Card Container --}}
    <div class="w-full overflow-hidden rounded-lg shadow-xs mt-3 px-6">
        <div class="w-full overflow-x-auto">
            <div class="bg-white rounded-lg shadow-md dark:bg-gray-800">

                {{-- Card Header --}}
                <div class="flex items-center justify-between p-4 border-b dark:border-gray-700">

                    <div class="flex items-center text-gray-700 dark:text-gray-300">
                        <i class="fas fa-table mr-2"></i>
                        <span>Registros</span>
                    </div>

                    {{-- Botón Nuevo Cliente --}}
                    <a href="{{ route('clientes.create') }}"
                        class="flex items-center justify-center p-3 bg-purple-600 hover:bg-purple-700 text-white rounded-full 
                        shadow-lg transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800">
                        <i class="fas fa-plus"></i>
                    </a>

                </div>

                {{-- Tabla de Clientes --}}
                <div class="p-4">
                    <div class="w-full overflow-hidden rounded-lg shadow-xs">
                        <div class="w-full overflow-x-auto">

                            <table class="w-full whitespace-no-wrap">
                                <thead>
                                    <tr
                                        class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b
                                        dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">

                                        <th class="px-4 py-3">Nombre</th>
                                        <th class="px-4 py-3">Teléfono</th>
                                        <th class="px-4 py-3">Correo</th>
                                        <th class="px-4 py-3">Carnet</th>
                                        <th class="px-4 py-3">Estado</th>
                                        <th class="px-5 py-3  align-middle">
                                            <i class="fa-solid fa-wrench"></i>
                                        </th>
                                    </tr>
                                </thead>

                                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                                    @forelse ($clientes as $cliente)
                                        <tr
                                            class="text-gray-700 dark:text-gray-300 
                                             hover:text-gray-900
                                             dark:hover:bg-gray-900 dark:hover:text-white
                                            transition">

                                            <td class="px-4 py-2">
                                                <strong class="text-gray-900 dark:text-gray-200">
                                                    {{ $cliente->nombre_completo }}
                                                </strong>
                                            </td>

                                            <td class="px-4 py-2">
                                                <i class="fa-solid fa-phone mr-2"></i>
                                                {{ $cliente->telefono ?? '---' }}
                                            </td>

                                            <td class="px-4 py-2">
                                                <i class="fa-regular fa-envelope mr-2"></i>
                                                {{ $cliente->correo ?? '---' }}
                                            </td>

                                            <td class="px-4 py-2">
                                                <i class="fa-regular fa-id-card mr-2"></i>
                                                {{ $cliente->carnet }}
                                            </td>

                                            <td class="px-4 py-2">
                                                @if ($cliente->estado == 1)
                                                    <span
                                                        class="px-2 py-1 rounded text-xs 
                                                                bg-green-200 text-green-900
                                                                dark:bg-black dark:text-white dark:border dark:border-green-500">
                                                        Activo
                                                    </span>
                                                @else
                                                    <span
                                                        class="px-2 py-1 rounded text-xs 
                                                                bg-red-200 text-red-900
                                                                dark:bg-black dark:text-white dark:border dark:border-red-500">
                                                        Inactivo
                                                    </span>
                                                @endif
                                            </td>

                                            <td class=" py-2 text-center flex gap-5 ">

                                                {{-- Editar --}}
                                                <a href="{{ route('clientes.edit', $cliente->id) }}"
                                                    class="p-2 text-blue-400 rounded-lg hover:bg-blue-50 dark:hover:bg-gray-700">
                                                    <i class="fa-regular fa-pen-to-square "></i>
                                                </a>

                                                {{-- Eliminar --}}
                                                <form action="{{ route('clientes.destroy', $cliente->id) }}"
                                                    method="POST"
                                                    onsubmit="return confirm('¿Seguro que deseas eliminar este cliente?')">
                                                    @csrf
                                                    @method('DELETE')

                                                    <button type="submit"
                                                        class="p-2 text-red-500 rounded-lg hover:bg-red-50 dark:hover:bg-gray-700">
                                                        <i class="fa-regular fa-trash-can"></i>
                                                    </button>
                                                </form>

                                            </td>

                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6"
                                                class="text-center px-4 py-6 text-gray-600 dark:text-gray-300">
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
        </div>
    </div>


</x-app-layout>
