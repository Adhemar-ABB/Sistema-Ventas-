


<x-app-layout>

<div class="py-6">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

        <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6">

            <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-100 mb-6">
                Registrar marcas
            </h2>

         

           <form  id="formCrearMarca" action="{{ route('marcas.store') }}" method="POST">
    @csrf

    <div class="mb-5">
        <label for="nombre" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
            Nombre <span class="text-red-500">*</span>
        </label>

        <input type="text" name="nombre" id="nombre" value="{{ old('nombre') }}" 
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
            Guardar marca
        </button>
    </div>
</form>
        </div>
    </div>
</div>



<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<script>
    document.getElementById("formCrearMarca").addEventListener("submit", function(e) {
        e.preventDefault();

        const nombre = document.getElementById("nombre").value.trim();
        const descripcion = document.getElementById("descripcion").value.trim();

        // Validación: Nombre obligatorio
        if (nombre === "") {
            Swal.fire({
                icon: "warning",
                title: "Campo vacío",
                text: "El campo Nombre es obligatorio.",
                confirmButtonColor: "#7c3aed"
            });
            return;
        }

        // Confirmación
        Swal.fire({
            title: "¿Guardar marca?",
            text: "Se registrará una nueva marca.",
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