<x-app-layout>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6">

                <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-100 mb-6">
                    Editar Proveedor
                </h2>

             
                <form id="formEditarProveedor"   action="{{ route('proveedores.update', $proveedor->id) }}" method="POST">
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


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
document.getElementById('formEditarProveedor').addEventListener('submit', function(e) {
    e.preventDefault();

    const nombre = document.querySelector('input[name="nombre"]').value.trim();
    const telefono = document.querySelector('input[name="telefono"]').value.trim();
    const correo = document.querySelector('input[name="correo"]').value.trim();
    
    const estado = document.querySelector('select[name="estado"]').value;

    // Validación: campos obligatorios
    if (!nombre ||  !telefono || !correo || estado === '') {
        Swal.fire({
            icon: 'warning',
            title: 'Campos incompletos',
            text: 'Todos los campos deben estar llenos'
        });
        return;
    }

    // Confirmación antes de guardar
    Swal.fire({
        title: '¿Guardar cambios?',
        text: "Se actualizará la información del Proveedor",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#2563eb',
        cancelButtonColor: '#6b7280',
        confirmButtonText: 'Sí, actualizar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {

           
            // enviar formulario después del mensaje
            setTimeout(() => {
                e.target.submit();
            }, 1200);
        }
    });
});
</script>



</x-app-layout>