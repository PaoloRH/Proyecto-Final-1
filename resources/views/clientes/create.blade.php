<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registrar Cliente</title>
  <script src="https://cdn.tailwindcss.com"></script>

  <style>
    body {
      background: linear-gradient(-45deg, #0f172a, #1e1b4b, #3b0764, #450a0a);
      background-size: 400% 400%;
      animation: gradientShift 12s ease infinite;
      min-height: 100vh;
      font-family: 'Inter', system-ui, sans-serif;
      color: #f8fafc;
    }

    @keyframes gradientShift {
      0% { background-position: 0% 50%; }
      50% { background-position: 100% 50%; }
      100% { background-position: 0% 50%; }
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(10px); }
      to { opacity: 1; transform: translateY(0); }
    }

    .animate-fadeIn {
      animation: fadeIn 0.8s ease-out;
    }

    .hover-glow:hover {
      box-shadow: 0 0 20px rgba(139, 92, 246, 0.4);
      transform: translateY(-2px);
    }
  </style>
</head>

<body class="flex flex-col font-sans">

  <!-- Encabezado -->
  <header class="flex items-center justify-between px-8 py-4 bg-white/10 backdrop-blur-lg border-b border-white/20 shadow-md">
    <h1 class="text-2xl font-extrabold tracking-wide text-yellow-300 drop-shadow-lg">
      🎓 Registrar Cliente
    </h1>

    <a href="{{ route('clientes.index') }}"
      class="bg-gradient-to-r from-violet-600 to-indigo-500 hover:from-indigo-500 hover:to-violet-600 text-white font-semibold px-5 py-2 rounded-xl shadow-md hover:shadow-violet-400/40 transition-all duration-200 flex items-center gap-2 hover-glow">
      ⬅ Volver
    </a>
  </header>

  <!-- Contenido principal -->
  <main class="flex-grow flex flex-col justify-center items-center px-4 py-10 animate-fadeIn">
    <form action="{{ route('clientes.store') }}" method="POST"
      class="bg-white/10 backdrop-blur-xl p-10 rounded-3xl shadow-2xl border border-white/20 w-[90%] md:w-[500px]">
      
      @csrf

      <h2 class="text-3xl font-bold text-center mb-8 text-yellow-300 drop-shadow-md">
        🧾 Formulario Cliente
      </h2>

      <!-- Nombre completo -->
      <div class="mb-6">
        <label class="block text-white/90 text-sm font-semibold mb-2">Nombre</label>
        <input type="text" name="nombre" autocomplete="off" required
          class="w-full px-3 py-2 rounded-lg bg-white/10 border border-white/30 text-white placeholder-white/50 focus:outline-none focus:ring-2 focus:ring-violet-500">
      </div>

      <!-- Correo -->
      <div class="mb-6">
        <label class="block text-white/90 text-sm font-semibold mb-2">Correo electrónico</label>
        <input type="email" name="correo" autocomplete="off"
          class="w-full px-3 py-2 rounded-lg bg-white/10 border border-white/30 text-white placeholder-white/50 focus:outline-none focus:ring-2 focus:ring-violet-500">
      </div>

      <!-- Teléfono -->
      <div class="mb-6">
        <label class="block text-white/90 text-sm font-semibold mb-2">Teléfono</label>
        <input type="text" name="telefono" autocomplete="off"
          class="w-full px-3 py-2 rounded-lg bg-white/10 border border-white/30 text-white placeholder-white/50 focus:outline-none focus:ring-2 focus:ring-violet-500">
      </div>

      <!-- Dirección -->
      <div class="mb-8">
        <label class="block text-white/90 text-sm font-semibold mb-2">Dirección</label>
        <input type="text" name="direccion" autocomplete="off"
          class="w-full px-3 py-2 rounded-lg bg-white/10 border border-white/30 text-white placeholder-white/50 focus:outline-none focus:ring-2 focus:ring-violet-500">
      </div>

      <!-- Botón guardar -->
      <div class="flex justify-center">
        <button type="submit"
          class="bg-gradient-to-r from-violet-600 to-indigo-500 hover:from-indigo-500 hover:to-violet-600 text-white font-bold py-3 px-8 rounded-xl shadow-md hover:shadow-violet-400/40 transition-all duration-200 transform hover:-translate-y-1 hover-glow">
          💾 Guardar
        </button>
      </div>
    </form>
  </main>
</body>
</html>
