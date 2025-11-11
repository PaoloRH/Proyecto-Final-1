<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Listado de Clientes y Proyectos</title>
  <style>
    body { font-family: DejaVu Sans, sans-serif; font-size: 12px; color: #222; margin: 30px; }
    h1 { text-align: center; color: #2b6cb0; margin-bottom: 20px; }
    h2 { color: #2d3748; border-bottom: 2px solid #cbd5e0; padding-bottom: 4px; margin-top: 25px; }
    table { width: 100%; border-collapse: collapse; margin-top: 10px; }
    th, td { border: 1px solid #999; padding: 6px 8px; text-align: left; }
    th { background-color: #e2e8f0; }
    tr:nth-child(even) { background-color: #f8fafc; }
    .cliente-info { margin-bottom: 10px; }
    .no-proyectos { color: #777; font-style: italic; margin-top: 5px; }
    footer { text-align: right; font-size: 11px; color: #555; margin-top: 20px; }
    .resumen { margin-top: 40px; border-top: 2px solid #ccc; padding-top: 10px; }
    .resumen table { width: 50%; margin-top: 10px; }
    .resumen th { background-color: #cfe2ff; text-align: left; }
  </style>
</head>
<body>
  <h1>📋 Listado General de Clientes y sus Proyectos</h1>

  @php
    $totalClientes = $clientes->count();
    $totalProyectos = 0;
    $totalPresupuesto = 0;
  @endphp

  @foreach ($clientes as $cli)
    <h2>{{ $cli->nombre }}</h2>
    <div class="cliente-info">
      📧 <strong>Correo:</strong> {{ $cli->correo ?? '—' }}<br>
      📞 <strong>Teléfono:</strong> {{ $cli->telefono ?? '—' }}<br>
      🏠 <strong>Dirección:</strong> {{ $cli->direccion ?? '—' }}
    </div>

    @if ($cli->proyectos && $cli->proyectos->count() > 0)
      @php
        $totalProyectos += $cli->proyectos->count();
        $totalPresupuesto += $cli->proyectos->sum('presupuesto');
      @endphp

      <table>
        <thead>
          <tr>
            <th>#</th>
            <th>Nombre del Proyecto</th>
            <th>Descripción</th>
            <th>Fecha Inicio</th>
            <th>Fecha Fin</th>
            <th>Presupuesto (S/.)</th>
            <th>Avance (%)</th>
            <th>Estado</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($cli->proyectos as $j => $proy)
            <tr>
              <td>{{ $j + 1 }}</td>
              <td>{{ $proy->nombre_proyecto }}</td>
              <td>{{ $proy->descripcion ?? '—' }}</td>
              <td>{{ $proy->fecha_inicio ?? '—' }}</td>
              <td>{{ $proy->fecha_fin ?? '—' }}</td>
              <td>{{ number_format($proy->presupuesto ?? 0, 2) }}</td>
              <td>{{ $proy->avance ?? 0 }}%</td>
              <td>{{ ucfirst($proy->estado ?? 'Pendiente') }}</td>
            </tr>
          @endforeach
        </tbody>
      </table>
    @else
      <p class="no-proyectos">No tiene proyectos registrados.</p>
    @endif
  @endforeach

  {{-- 🔹 Sección de resumen --}}
  <div class="resumen">
    <h2>📊 Resumen General</h2>
    <table>
      <tr>
        <th>Total de Clientes</th>
        <td>{{ $totalClientes }}</td>
      </tr>
      <tr>
        <th>Total de Proyectos</th>
        <td>{{ $totalProyectos }}</td>
      </tr>
      <tr>
        <th>Suma Total de Presupuestos (S/.)</th>
        <td>{{ number_format($totalPresupuesto, 2) }}</td>
      </tr>
    </table>
  </div>

  <footer>
    Generado el {{ now()->format('d/m/Y H:i') }}
  </footer>
</body>
</html>
