<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Reporte de {{ $cliente->nombre }}</title>
  <style>
    body { font-family: DejaVu Sans, sans-serif; font-size: 12px; color: #222; margin: 30px; }
    h1 { text-align: center; color: #2b6cb0; margin-bottom: 20px; }
    h2 { color: #2d3748; border-bottom: 2px solid #cbd5e0; padding-bottom: 4px; margin-top: 25px; }
    table { width: 100%; border-collapse: collapse; margin-top: 10px; }
    th, td { border: 1px solid #999; padding: 6px 8px; text-align: left; }
    th { background-color: #e2e8f0; }
    tr:nth-child(even) { background-color: #f8fafc; }
    .no-proyectos { color: #777; font-style: italic; margin-top: 5px; }
    footer { text-align: right; font-size: 11px; color: #555; margin-top: 20px; }
    .resumen { margin-top: 30px; border-top: 2px solid #ccc; padding-top: 10px; }
    .resumen table { width: 50%; margin-top: 10px; }
    .resumen th { background-color: #cfe2ff; text-align: left; }
  </style>
</head>
<body>
  <h1>📄 Reporte del Cliente: {{ $cliente->nombre }}</h1>

  <p><strong>📧 Correo:</strong> {{ $cliente->correo ?? '—' }}</p>
  <p><strong>📞 Teléfono:</strong> {{ $cliente->telefono ?? '—' }}</p>
  <p><strong>🏠 Dirección:</strong> {{ $cliente->direccion ?? '—' }}</p>

  <h2>📋 Proyectos Asociados</h2>

  @if ($cliente->proyectos && $cliente->proyectos->count() > 0)
    @php
      $totalPresupuesto = $cliente->proyectos->sum('presupuesto');
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
        @foreach ($cliente->proyectos as $i => $proy)
          <tr>
            <td>{{ $i + 1 }}</td>
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

    {{-- 🔹 Resumen del cliente --}}
    <div class="resumen">
      <h2>📊 Resumen del Cliente</h2>
      <table>
        <tr>
          <th>Total de Proyectos</th>
          <td>{{ $cliente->proyectos->count() }}</td>
        </tr>
        <tr>
          <th>Suma Total de Presupuestos (S/.)</th>
          <td>{{ number_format($totalPresupuesto, 2) }}</td>
        </tr>
      </table>
    </div>

  @else
    <p class="no-proyectos">Este cliente no tiene proyectos registrados.</p>
  @endif

  <footer>
    Generado el {{ now()->format('d/m/Y H:i') }}
  </footer>
</body>
</html>
