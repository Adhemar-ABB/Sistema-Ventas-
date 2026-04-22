<x-app-layout>
    @section('title', 'Productos')

    <!-- Estilos Rápidos para asegurar el Look Dark -->
    <style>
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
                        <th class="px-6 py-4">Nombre / Categoría</th>
                        <th class="px-6 py-4 text-center">Precio Venta</th>
                        <th class="px-6 py-4 text-center">Estado</th>
                        <th class="px-6 py-4 text-center"><i class="fas fa-wrench"></i></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-800">
                    @forelse ($productos as $producto)
                        <tr class="hover:bg-gray-800/50">
                            <td class="px-6 py-4">
                                <div class="font-bold text-white">{{ $producto->nombre }}</div>
                                <div class="text-xs text-purple-400">{{ $producto->categoria->nombre ?? 'Sin categoría' }}</div>
                            </td>
                            <td class="px-6 py-4 text-center text-green-400 font-bold">
                                ${{ number_format($producto->precio_venta, 2) }}
                            </td>
                            <td class="px-6 py-4 text-center">
                                <span class="px-2 py-1 text-xs rounded-full bg-green-900/30 text-green-400 border border-green-800">Activo</span>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <button class="text-blue-400 hover:text-blue-300"><i class="fas fa-edit"></i></button>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="4" class="p-10 text-center text-gray-500">No hay productos aún.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

<!-- MODAL ULTRA COMPACTO -->
<div id="crearProductoModal" class="hidden fixed inset-0 z-[100] flex items-center justify-center bg-black/80 backdrop-blur-sm p-4">
    
    <!-- Contenedor con ancho fijo forzado (max-width: 400px) -->
    <div class="relative w-full shadow-2xl rounded-2xl overflow-hidden border border-gray-700" style="max-width: 400px; background-color: #1f2937;">
        
        <!-- Header -->
        <div class="flex items-center justify-between p-4 border-b border-gray-700 bg-[#374151]/30">
            <h3 class="text-sm font-bold text-white uppercase tracking-widest">Nuevo Producto</h3>
            <button type="button" onclick="cerrarModal()" class="text-gray-400 hover:text-white transition-colors">
                <i class="fas fa-times text-lg"></i>
            </button>
        </div>

        <!-- Formulario -->
        <form action="{{ route('productos.store') }}" method="POST" class="p-6 space-y-4">
            @csrf
            
            <div>
                <label class="block text-[10px] font-bold text-gray-400 uppercase mb-1">Nombre del Producto</label>
                <input type="text" name="nombre" required 
                    style="background-color: #111827; border: 1px solid #374151; color: white;"
                    class="w-full rounded-xl p-3 text-sm focus:border-purple-500 outline-none" placeholder="Escribe el nombre...">
            </div>

            <div>
                <label class="block text-[10px] font-bold text-gray-400 uppercase mb-1">Categoría</label>
                <select name="categoria_id" required 
                    style="background-color: #111827; border: 1px solid #374151; color: white;"
                    class="w-full rounded-xl p-3 text-sm focus:border-purple-500 outline-none">
                    <option value="">Seleccionar...</option>
                    @foreach($categorias as $categoria)
                        <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                    @endforeach
                </select>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-[10px] font-bold text-purple-400 uppercase mb-1">Costo</label>
                    <input type="number" step="0.01" name="precio_compra" required 
                        style="background-color: #111827; border: 1px solid #4c1d95; color: white;"
                        class="w-full rounded-xl p-3 text-sm outline-none" placeholder="0.00">
                </div>
                <div>
                    <label class="block text-[10px] font-bold text-green-400 uppercase mb-1">Venta</label>
                    <input type="number" step="0.01" name="precio_venta" required 
                        style="background-color: #111827; border: 1px solid #064e3b; color: white;"
                        class="w-full rounded-xl p-3 text-sm outline-none" placeholder="0.00">
                </div>
            </div>

            <div>
                <label class="block text-[10px] font-bold text-gray-400 uppercase mb-1">Stock Mínimo</label>
                <input type="number" name="stock_minimo" value="5" 
                    style="background-color: #111827; border: 1px solid #374151; color: white;"
                    class="w-full rounded-xl p-3 text-sm outline-none">
            </div>

            <div class="pt-4">
                <button type="submit" class="w-full bg-purple-600 hover:bg-purple-700 text-white font-bold py-4 rounded-2xl text-xs uppercase tracking-widest transition-all shadow-lg shadow-purple-900/40">
                    <i class="fas fa-save mr-2"></i> Guardar Registro
                </button>
            </div>
        </form>
    </div>
</div>




    <script>
        const modal = document.getElementById('crearProductoModal');
        const btnAbrir = document.getElementById('btnAbrirModal');

        btnAbrir.addEventListener('click', () => { modal.classList.remove('hidden'); });
        function cerrarModal() { modal.classList.add('hidden'); }
        window.onclick = (e) => { if (e.target == modal) cerrarModal(); }
    </script>
</x-app-layout>
