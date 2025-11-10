<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Gestor de Proyectos</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    /* Fondo animado oscuro tipo olas RGB */
    body {
      background: linear-gradient(-45deg, #0f172a, #1e1b4b, #3b0764, #450a0a);
      background-size: 400% 400%;
      animation: gradientShift 12s ease infinite;
      min-height: 100vh;
      font-family: 'Inter', system-ui, sans-serif;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: flex-start;
      padding: 40px 16px;
      color: #f8fafc;
    }

    @keyframes gradientShift {
      0% { background-position: 0% 50%; }
      50% { background-position: 100% 50%; }
      100% { background-position: 0% 50%; }
    }

    /* Brillo suave al pasar el cursor */
    .hover-glow:hover {
      box-shadow: 0 0 20px rgba(139, 92, 246, 0.4);
      transform: translateY(-2px);
    }
  </style>
</head>

<body>

  <!-- Contenedor principal -->
  <div class="bg-white/10 backdrop-blur-xl rounded-3xl shadow-2xl p-8 w-[95%] md:w-[90%] max-w-5xl border border-white/20 transition-all duration-300">

    <!-- Título -->
    <h1 class="text-4xl font-extrabold text-center mb-8 drop-shadow-lg">
      📝 Registro de <span class="text-violet-400">Proyectos</span>
    </h1>

    <!-- Botón volver al menú -->
    <div class="flex justify-end mb-6">
      <a href="{{ url('/') }}" 
         class="inline-flex items-center bg-gradient-to-r from-violet-600 to-indigo-500 hover:from-indigo-500 hover:to-violet-600 text-white font-semibold py-2 px-5 rounded-lg shadow-md transition duration-300 transform hover:-translate-y-1 hover-glow"
         title="Volver al menú"
         role="button">
         🔙 Menú
      </a>
    </div>

    <!-- Tabla de proyectos -->
    <div class="overflow-x-auto rounded-2xl shadow-lg bg-white/5 backdrop-blur-md p-4 border border-white/10">
      <table class="min-w-full text-left text-gray-100">
        <thead>
          <tr class="bg-gradient-to-r from-indigo-700 to-violet-700 text-white uppercase text-sm">
            <th class="p-4 rounded-tl-xl">Cliente</th>
            <th class="p-4">Proyecto</th>
            <th class="p-4">Descripción</th>
            <th class="p-4">Score Final</th>
            <th class="p-4 rounded-tr-xl">Ver</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($proyectos as $proyecto)
            <tr class="hover:bg-white/10 transition duration-200">
              <!-- Cliente -->
              <td class="py-3 px-4 border-b border-white/10">
                {{ $proyecto->cliente->nombre }}
              </td>

              <!-- Nombre del proyecto -->
              <td class="py-3 px-4 border-b border-white/10">
                {{ $proyecto->nombre_proyecto }}
              </td>

              <!-- Descripción -->
              <td class="py-3 px-4 border-b border-white/10">
                {{ $proyecto->descripcion }}
              </td>

              <!-- Score final -->
              <td class="py-3 px-4 border-b border-white/10 font-semibold text-violet-300">
                {{ $proyecto->score_final ?? 'Pendiente' }}
              </td>

              <!-- Botón Ver -->
              <td class="py-3 px-4 border-b border-white/10 text-center">
                <a href="{{ route('proyectos.show', $proyecto->id) }}" 
                   class="bg-gradient-to-r from-cyan-500 to-blue-600 hover:from-blue-600 hover:to-cyan-500 text-white font-semibold py-2 px-4 rounded-lg transition duration-200 shadow-md hover-glow">
                  Ver
                </a>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>

    <!-- Pie de página -->
    <p class="text-center text-sm text-white/60 mt-6">
      © {{ date('Y') }} Gestor de Proyectos — Registro
    </p>
  </div>

</body>
</html>
