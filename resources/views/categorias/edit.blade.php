
<x-app-layout>




<div class="py-6">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

        <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6">

            <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-100 mb-6">
                Editar categoria
                
            </h2>

          

         <form id="formEditarCategoria" action="{{ route('categorias.update', $categoria->id) }}" method="POST">
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
                        >
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



<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.getElementById("formEditarCategoria").addEventListener("submit", function(e) {
        e.preventDefault();

        const nombre = document.querySelector('input[name="nombre"]').value.trim();
        const descripcion = document.querySelector('textarea[name="descripcion"]').value.trim();
        const estado = document.querySelector('select[name="estado"]').value;

        // Validar campos vacíos
        if (nombre === "" || descripcion === "" || estado === "") {
            Swal.fire({
                icon: 'warning',
                title: 'Campos incompletos',
                text: 'Por favor completa todos los campos antes de guardar.',
                confirmButtonColor: '#7c3aed'
            });
            return;
        }

        // Confirmación
        Swal.fire({
            title: "¿Guardar cambios?",
            text: "Se actualizará la categoría.",
            icon: "question",
            showCancelButton: true,
            confirmButtonColor: "#7c3aed",
            cancelButtonColor: "#dc2626",
            confirmButtonText: "Sí, guardar",
            cancelButtonText: "Cancelar"
        }).then((result) => {
            if (result.isConfirmed) {
                this.submit();
            }
        });
    });
</script>



</x-app-layout>

