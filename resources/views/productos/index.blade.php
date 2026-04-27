<x-app-layout>



    @section('title', 'Producto')

    <!-- Estilos Rápidos para asegurar el Look Dark -->
    <style>
      main, section, .flex-1 {
        z-index: auto !important;
        transform: none !important;
        filter: none !important;
    }

 
    #crearProductoModal, #editarProductoModal {
        z-index: 99999 !important;
        position: fixed !important;
    }


        .modal-dark { background-color: #1f2937; color: white; border: 1px solid #374151; }
        .input-dark { background-color: #111827; border: 1px solid #4b5563; color: white; border-radius: 0.75rem; padding: 0.75rem; width: 100%; }
        .input-dark:focus { border-color: #9333ea; outline: none; ring: 2px solid #9333ea; }
        .label-dark { display: block; font-size: 0.875rem; font-weight: 600; margin-bottom: 0.5rem; color: #9ca3af; }
    </style>

    <!-- Header Section -->
    <div class="px-6 py-4 border-b border-gray-800 bg-[#111827]">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-bold text-white flex items-center">
                    <i class="fas fa-box-open mr-3 text-purple-500"></i>
                    Gestión de Productos
                </h2>
            </div>
            <button id="btnAbrirModal" class="flex items-center justify-center w-12 h-12 bg-purple-600 hover:bg-purple-700 text-white rounded-full shadow-lg transition-transform hover:scale-110">
                <i class="fas fa-plus"></i>
            </button>
        </div>
    </div>

    <!-- Tabla (Listado) -->
    <div class="p-6 bg-[#111827] min-h-screen">
        <div class="overflow-hidden rounded-xl border border-gray-800 bg-[#1f2937]">
            <table class="w-full text-left text-gray-300">
                <thead class="bg-[#374151]/50 text-xs uppercase text-gray-400">
                    <tr>
                        <th class="px-6 py-6">Nombre</th>
                        <th class="px-6 py-6">Color</th>
                        <th class="px-6 py-6">Talla</th>
                        <th class="px-6 py-6 text-center">Precio Compra</th>
                        <th class="px-6 py-6 text-center">Precio Venta</th>
                        <th class="px-6 py-6 text-center">Stock</th>
                        <th class="px-6 py-6 text-center"><i class="fas fa-wrench"></i></th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                    @forelse ($productos as $producto)
                        <tr class="text-gray-700 dark:text-gray-300 hover:text-gray-900 dark:hover:bg-gray-900 dark:hover:text-white transition">
                            
                            <!-- nombre -->
                            <td class="px-4 py-2">
                                <div class="text-xs text-purple-400">{{ $producto->nombre }}</div>
                            </td>


                            <!-- Color -->
                            <td class="px-4 py-2">
                                <div class="text-xs text-purple-400">{{ $producto->color }}</div>
                            </td>

                            <!-- talla -->
                            <td class="px-4 py-2">
                                <div class="text-xs text-purple-400">{{ $producto->talla }}</div>
                            </td>

                             <!-- Precio Compra -->
                            <td class="px-4 py-2 text-center">
                                <span class="font-semibold text-green-500">
                                    ${{ number_format($producto->precio_compra, 2) }}
                                </span>
                            </td>

                            <!-- Precio Venta -->
                            <td class="px-4 py-2 text-center">
                                <span class="font-semibold text-green-500">
                                    ${{ number_format($producto->precio_venta, 2) }}
                                </span>
                            </td>

                        <!-- Stock -->
                            <td class="px-4 py-2 text-center">
                                <div class="text-xs font-bold {{ $producto->stock_minimo < 3 ? 'text-red-500' : 'text-purple-400' }}">
                                    {{ $producto->stock_minimo }}
                                </div>
                            </td>

                        <!-- Acciones Editar y Eliminar -->
                        <td class="px-4 py-2 text-center flex justify-center space-x-2">
                            <!-- Botón Editar -->
                            <button onclick="abrirModalEditar({{ json_encode($producto) }})" 
                                class="p-2 text-sm font-medium leading-5 text-purple-600 rounded-lg focus:outline-none hover:bg-gray-100" 
                                aria-label="Edit">
                                <i class="fas fa-pencil-alt"></i>
                            </button>

                            <!-- Botón Eliminar -->
                            <button onclick="confirmarEliminar(this)" 
                                    data-id="{{ $producto->id }}" 
                                    data-estado="{{ $producto->estado }}" 
                                    class="p-2 text-sm font-medium leading-5 text-red-600 rounded-lg focus:outline-none hover:bg-gray-100" 
                                    aria-label="Delete">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>


                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-4 py-8 text-center text-gray-500 dark:text-gray-400">
                                No hay productos registrados aún.
                            </td>
                        </tr>
                    @endforelse
                </tbody>

            </table>
        </div>
    </div>

<!-- MODAL AGREGAR -->
<div id="crearProductoModal" class="hidden fixed inset-0 z-[99999] flex items-center justify-center bg-black/80 backdrop-blur-sm p-4">
    
  
    <div class="relative w-full shadow-2xl rounded-2xl overflow-hidden border border-gray-700" 
         style="max-width: 600px; background-color: #1f2937;">
        
        <!-- Header -->
        <div class="flex items-center justify-between p-4 border-b border-gray-700 bg-[#374151]/30">
            <h3 class="text-sm font-bold text-white uppercase tracking-widest">Nuevo Producto</h3>
            <button type="button" onclick="cerrarModal()" class="text-gray-400 hover:text-white">
                <i class="fas fa-times text-lg"></i>
            </button>
        </div>

        <!-- Formulario -->
        <form action="{{ route('producto.store') }}" method="POST" class="p-6">
            @csrf
            
            <!-- CONTENEDOR GRID PRINCIPAL -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-4">
                
                <!-- Nombre:  -->
                <div class="md:col-span-2">
                    <label class="block text-[10px] font-bold text-gray-400 uppercase mb-1">Nombre del Producto</label>
                    <input type="text" name="nombre" required 
                        style="background-color: #111827; border: 1px solid #374151; color: white;"
                        class="w-full rounded-xl p-3 text-sm focus:border-purple-500 outline-none" placeholder="Ej: Camisa Polo">
                </div>

                <!-- Color (Columna 1) -->
                <div>
                    <label class="block text-[10px] font-bold text-gray-400 uppercase mb-1">Color</label>
                    <input type="text" name="color" required 
                        style="background-color: #111827; border: 1px solid #374151; color: white;"
                        class="w-full rounded-xl p-3 text-sm outline-none" placeholder="Rojo">
                </div>

                <!-- Talla (Columna 2) -->
                <div>
                    <label class="block text-[10px] font-bold text-gray-400 uppercase mb-1">Talla</label>
                    <input type="text" name="talla" required 
                        style="background-color: #111827; border: 1px solid #374151; color: white;"
                        class="w-full rounded-xl p-3 text-sm outline-none" placeholder="M">
                </div>

                <!-- Costo (Columna 1) -->
                <div>
                    <label class="block text-[10px] font-bold text-gray-400 uppercase mb-1">Costo (Compra)</label>
                    <input type="number" step="0.01" name="precio_compra" required 
                        style="background-color: #111827; border: 1px solid #374151; color: white;"
                        class="w-full rounded-xl p-3 text-sm outline-none" placeholder="0.00">
                </div>

                <!-- Venta (Columna 2) -->
                <div>
                    <label class="block text-[10px] font-bold text-gray-400 uppercase mb-1">Venta Publico</label>
                    <input type="number" step="0.01" name="precio_venta" required 
                        style="background-color: #111827; border: 1px solid #374151; color: white;"
                        class="w-full rounded-xl p-3 text-sm outline-none" placeholder="0.00">
                </div>

                <!-- Stock:  -->
                <div class="md:col-span-2">
                    <label class="block text-[10px] font-bold text-gray-400 uppercase mb-1">Stock Inicial</label>
                    <input type="number" name="stock_minimo" value="1" 
                        style="background-color: #111827; border: 1px solid #374151; color: white;"
                        class="w-full rounded-xl p-3 text-sm outline-none">
                </div>

                <!-- Botón:  -->
                <div class="md:col-span-2 pt-2">
                    <button type="submit" class="w-full bg-purple-600 hover:bg-purple-700 text-white font-bold py-4 rounded-2xl text-xs uppercase tracking-widest transition-all shadow-lg">
                        <i class="fas fa-save mr-2"></i> Guardar Registro
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>



<!-- MODAL EDITAR -->
<div id="editarProductoModal" class="hidden fixed inset-0 z-[99999] flex items-center justify-center bg-black/80 backdrop-blur-sm p-4">
    <div class="relative w-full shadow-2xl rounded-2xl overflow-hidden border border-gray-700" style="max-width: 600px; background-color: #1f2937;">
        <div class="flex items-center justify-between p-4 border-b border-gray-700 bg-[#374151]/30">
            <h3 class="text-sm font-bold text-white uppercase tracking-widest">Editar Producto</h3>
            <button type="button" onclick="cerrarModalEditar()" class="text-gray-400 hover:text-white">
                <i class="fas fa-times text-lg"></i>
            </button>
        </div>

        <form id="formEditar" method="POST" class="p-6">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-4">
                <div class="md:col-span-2">
                    <label class="label-dark">Nombre del Producto</label>
                    <input type="text" name="nombre" id="edit_nombre" required class="input-dark">
                </div>
                <div>
                    <label class="label-dark">Color</label>
                    <input type="text" name="color" id="edit_color" required class="input-dark">
                </div>
                <div>
                    <label class="label-dark">Talla</label>
                    <input type="text" name="talla" id="edit_talla" required class="input-dark">
                </div>
                <div>
                    <label class="label-dark">Costo (Compra)</label>
                    <input type="number" step="0.01" name="precio_compra" id="edit_precio_compra" required class="input-dark">
                </div>
                <div>
                    <label class="label-dark">Venta Público</label>
                    <input type="number" step="0.01" name="precio_venta" id="edit_precio_venta" required class="input-dark">
                </div>
                <div>
                    <label class="label-dark">Stock</label>
                    <input type="number" step="1" name="stock_minimo" id="edit_stock_minimo" required class="input-dark">
                </div>
                <div class="md:col-span-2 pt-2">
                    <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-4 rounded-2xl text-xs uppercase tracking-widest transition-all">
                        <i class="fas fa-sync-alt mr-2"></i> ACTUALIZAR PRODUCTO
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>



    <script>

 document.addEventListener('DOMContentLoaded', function () {
    @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: '¡Hecho!',
            text: "{{ session('success') }}",
            background: '#1f2937',
            color: '#fff',
            confirmButtonColor: '#9333ea',
            timer: 2500
        });
    @endif
});


        //boton Crear//
        const modal = document.getElementById('crearProductoModal');
        const btnAbrir = document.getElementById('btnAbrirModal');

        btnAbrir.addEventListener('click', () => { modal.classList.remove('hidden'); });
        function cerrarModal() { modal.classList.add('hidden'); }
        
        // boton editar
        const modalEditar = document.getElementById('editarProductoModal');
        const formEditar = document.getElementById('formEditar');

        function abrirModalEditar(producto) {
            // Llenamos los campos del modal con los datos del producto seleccionado
            document.getElementById('edit_nombre').value = producto.nombre;
            document.getElementById('edit_color').value = producto.color;
            document.getElementById('edit_talla').value = producto.talla;
            document.getElementById('edit_precio_compra').value = producto.precio_compra;
            document.getElementById('edit_precio_venta').value = producto.precio_venta;
            document.getElementById('edit_stock_minimo').value = producto.stock_minimo;

            // Cambiamos la URL del formulario para que apunte al ID correcto
            formEditar.action = `/producto/${producto.id}`;

            // Mostramos el modal de editar
            modalEditar.classList.remove('hidden');
        }

        function cerrarModalEditar() {
            modalEditar.classList.add('hidden');
        }

        window.addEventListener('click', function(e) {
            if (e.target == modal) cerrarModal();
            if (e.target == modalEditar) cerrarModalEditar();
        });

        // Función para confirmar la acción de eliminar
function confirmarEliminar(btn) {
    const id = btn.dataset.id; // Obtener el ID del producto

    // Mostrar el SweetAlert para confirmar la acción
    Swal.fire({
        title: '¿Estás seguro?',
        text: "Este producto será eliminado",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, Eliminar',
        cancelButtonText: 'Cancelar',
        background: '#1f2937',
        color: '#fff'
    }).then((result) => {
        if (result.isConfirmed) {
            // Si el usuario confirma, llamamos a la función para eliminar el producto
            eliminarProducto(id, btn);
        }
    });
}

// Función para eliminar el producto en la base de datos
function eliminarProducto(id, btn) {
    // Enviar una solicitud DELETE para cambiar el estado del producto
    fetch(`/producto/${id}`, {
        method: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Accept': 'application/json',
            'Content-Type': 'application/json'
        },
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Mostrar mensaje de éxito con SweetAlert
            Swal.fire({
                icon: 'success',
                title: '¡Hecho!',
                text: data.mensaje,
                timer: 1500,
                showConfirmButton: false
            }).then(() => {
                // Eliminar el producto de la tabla visualmente
                btn.closest('tr').style.display = 'none'; // Eliminar la fila de la tabla

                // Desactivar el botón de eliminar (si quieres mostrarlo de otra forma)
                btn.innerHTML = `<i class="fas fa-trash"></i> Producto inactivado`;
                btn.disabled = true; // Desactivar el botón de eliminar
            });
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: data.mensaje
            });
        }
    })
    .catch(error => {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Hubo un problema al eliminar el producto.'
        });
    });
}


    </script>

      <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</x-app-layout>
