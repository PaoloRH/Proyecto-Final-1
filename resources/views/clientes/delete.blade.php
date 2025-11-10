<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar Cliente</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 text-white min-h-screen flex flex-col items-center justify-center">

    <h1 class="text-3xl font-bold mb-6">Eliminar Cliente</h1>

    <form action="{{ route('clientes.destroy', $cliente) }}" method="POST" 
          class="bg-white/10 shadow-md rounded px-8 pt-6 pb-8 mb-4 w-[90%] md:w-[500px]">
        
        @csrf
        @method('DELETE')

        <!-- Nombre -->
        <div class="mb-4">
            <label class="block text-white/90 text-sm font-bold mb-2">Nombre</label>
            <input type="text" name="nombre" value="{{ $cliente->nombre }}" readonly
                class="w-full px-3 py-2 rounded-lg bg-white/20 border border-white/30 text-white cursor-not-allowed">
        </div>

        <!-- Correo -->
        <div class="mb-4">
            <label class="block text-white/90 text-sm font-bold mb-2">Correo electrónico</label>
            <input type="email" name="correo" value="{{ $cliente->correo }}" readonly
                class="w-full px-3 py-2 rounded-lg bg-white/20 border border-white/30 text-white cursor-not-allowed">
        </div>

        <!-- Teléfono -->
        <div class="mb-4">
            <label class="block text-white/90 text-sm font-bold mb-2">Teléfono</label>
            <input type="text" name="telefono" value="{{ $cliente->telefono }}" readonly
                class="w-full px-3 py-2 rounded-lg bg-white/20 border border-white/30 text-white cursor-not-allowed">
        </div>

        <!-- Dirección -->
        <div class="mb-6">
            <label class="block text-white/90 text-sm font-bold mb-2">Dirección</label>
            <input type="text" name="direccion" value="{{ $cliente->direccion }}" readonly
                class="w-full px-3 py-2 rounded-lg bg-white/20 border border-white/30 text-white cursor-not-allowed">
        </div>

        <!-- Botón eliminar -->
        <div class="flex justify-center">
            <button type="submit"
                class="bg-red-600 hover:bg-red-800 text-white font-bold py-3 px-8 rounded-xl shadow-md hover:shadow-red-400/40 transition-all duration-200">
                🗑️ Eliminar
            </button>
        </div>
    </form>

    <a href="{{ route('clientes.index') }}"
        class="text-yellow-300 mt-4 hover:underline">
        ⬅ Volver a la lista de clientes
    </a>

</body>
</html>
