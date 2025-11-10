<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Reporte de Clientes</title>
  <style>
    body { font-family: DejaVu Sans, sans-serif; font-size: 12px; color: #222; }
    h1 { text-align: center; color: #2b6cb0; margin-bottom: 20px; }
    table { width: 100%; border-collapse: collapse; margin-top: 10px; }
    th, td { border: 1px solid #999; padding: 6px 8px; text-align: left; }
    th { background-color: #e2e8f0; }
    tr:nth-child(even) { background-color: #f8fafc; }
  </style>
</head>
<body>
  <h1>Listado de Clientes</h1>

  <table>
    <thead>
      <tr>
        <th>#</th>
        <th>Nombre</th>
        <th>Correo</th>
        <th>Teléfono</th>
        <th>Dirección</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($clientes as $i => $cli)
      <tr>
        <td>{{ $i + 1 }}</td>
        <td>{{ $cli->nombre }}</td>
        <td>{{ $cli->correo }}</td>
        <td>{{ $cli->telefono }}</td>
        <td>{{ $cli->direccion }}</td>
      </tr>
      @endforeach
    </tbody>
  </table>

  <p style="margin-top: 20px; text-align: right;">
    Generado el {{ now()->format('d/m/Y H:i') }}
  </p>
</body>
</html>
