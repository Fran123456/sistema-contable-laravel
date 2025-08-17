<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Reporte de Pasivo Laboral</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px;}
        th, td { border: 1px solid #000; padding: 5px; text-align: left;}
        th { background: #eee; }
    </style>
</head>
<body>
    <h2>Reporte de Pasivo Laboral (Provisiones Acumuladas)</h2>
    <table>
        <thead>
            <tr>
                <th>Empresa</th>
                <th>Empleado</th>
                <th>Tipo Provisión</th>
                <th>Mes</th>
                <th>Monto</th>
            </tr>
        </thead>
        <tbody>
            @foreach($provisiones as $prov)
            <tr>
                <td>{{ $prov->empresa->nombre ?? '-' }}</td>
                <td>{{ $prov->empleado->nombre ?? '-' }}</td>
                <td>{{ $prov->tipo_provision }}</td>
                <td>{{ \Carbon\Carbon::parse($prov->mes)->format('Y-m') }}</td>
                <td>{{ number_format($prov->monto,2) }}</td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th colspan="4">Total Pasivo Laboral</th>
                <th>{{ number_format($total,2) }}</th>
            </tr>
        </tfoot>
    </table>
</body>
</html>
