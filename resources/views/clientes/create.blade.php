<x-app-layout>

<div class="py-6">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

        <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6">

            <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-100 mb-6">
                Registrar Cliente
            </h2>

            

            <form id="formClientes"  action="{{ route('clientes.store') }}" method="POST">
                @csrf

                <div class="mb-4">
                    <label class="block text-gray-700 dark:text-gray-200 font-semibold mb-2">
                        Nombre Completo
                    </label>
                    <input type="text" name="nombre_completo" pattern="[A-Za-z\s]+" value="{{ old('nombre_completo') }}"
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
                        Carnet
                    </label>
                    <input type="number" name="carnet" value="{{ old('carnet') }}"
                        class="w-full rounded border-gray-300 dark:border-gray-600
                               dark:bg-gray-700 dark:text-white focus:ring focus:ring-blue-300"
                        >
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
                    <a href="{{ route('clientes.index') }}"
                       class="px-4 py-2 rounded bg-gray-500 text-white hover:bg-gray-600 transition">
                        Cancelar
                    </a>

                    <button type="submit"
                        class="px-4 py-2 rounded bg-blue-600 text-white hover:bg-blue-700 transition">
                        Guardar Cliente
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>




<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
document.getElementById("formClientes").addEventListener("submit", function(e) {
    e.preventDefault();

    const nombre = document.querySelector('input[name="nombre_completo"]').value.trim();
    const telefono = document.querySelector('input[name="telefono"]').value.trim();
    const correo = document.querySelector('input[name="correo"]').value.trim();
    const carnet = document.querySelector('input[name="carnet"]').value.trim();

    //  Validar TODOS los campos vacíos
    if (nombre === "" || telefono === "" || correo === ""  || carnet === "" ) {
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
        title: "¿Guardar Cliente?",
        text: "Se registrará un nuevo Cliente .",
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