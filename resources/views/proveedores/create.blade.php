<x-app-layout>

<div class="py-6">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

        <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6">

            <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-100 mb-6">
                Registrar Cliente
            </h2>

        

            <form  id="formProveedor"  action="{{ route('proveedores.store') }}" method="POST">
                @csrf

                <div class="mb-4">
                    <label class="block text-gray-700 dark:text-gray-200 font-semibold mb-2">
                        Nombre Completo
                    </label>
                    <input type="text" name="nombre" value="{{ old('nombre') }}"
                        class="w-full rounded border-gray-300 dark:border-gray-600
                               dark:bg-gray-700 dark:text-white focus:ring focus:ring-blue-300"
                        >
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 dark:text-gray-200 font-semibold mb-2">
                        Teléfono
                    </label>
                    <input type="number" name="telefono" value="{{ old('telefono') }}"
                        class="w-full rounded border-gray-300 dark:border-gray-600
                               dark:bg-gray-700 dark:text-white focus:ring focus:ring-blue-300">
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 dark:text-gray-200 font-semibold mb-2">
                        Correo
                    </label>
                    <input type="email" name="correo" value="{{ old('correo') }}"
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
                        <option value="1" {{ old('estado') == 1 ? 'selected' : '' }}>Activo</option>
                        <option value="0" {{ old('estado') == 0 ? 'selected' : '' }}>Inactivo</option>
                    </select>
                </div>

                <div class="flex justify-between">
                    <a href="{{ route('proveedores.index') }}"
                       class="px-4 py-2 rounded bg-gray-500 text-white hover:bg-gray-600 transition">
                        Cancelar
                    </a>

                    <button type="submit"
                        class="px-4 py-2 rounded bg-blue-600 text-white hover:bg-blue-700 transition">
                        Guardar Proveedor
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>





<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
document.getElementById("formProveedor").addEventListener("submit", function(e) {
    e.preventDefault();

    const nombre = document.querySelector('input[name="nombre"]').value.trim();
    const telefono = document.querySelector('input[name="telefono"]').value.trim();
    const correo = document.querySelector('input[name="correo"]').value.trim();

    //  Validar TODOS los campos vacíos
    if (nombre === "" || telefono === "" || correo === "") {
        Swal.fire({
            icon: "warning",
            title: "Campos incompletos",
            text: "Todos los campos son obligatorios.",
            confirmButtonColor: "#7c3aed"
        });
        return;
    }

    // Validar correo formato básico
    if (!correo.includes("@")) {
        Swal.fire({
            icon: "error",
            title: "Correo inválido",
            text: "Ingrese un correo electrónico válido.",
            confirmButtonColor: "#7c3aed"
        });
        return;
    }

    // Confirmación guardar
    Swal.fire({
        title: "¿Guardar Proveedor?",
        text: "Se registrará un nuevo Proveedor.",
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