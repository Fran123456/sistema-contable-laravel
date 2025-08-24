@extends('layouts.app')

@section('content')
<h2>Bitácora de Accesos</h2>
<table>
    <thead>
        <tr>
            <th>Usuario</th>
            <th>IP</th>
            <th>Módulo</th>
            <th>Acción</th>
            <th>Fecha</th>
        </tr>
    </thead>
    <tbody>
        @foreach($bitacora as $b)
        <tr>
            <td>{{ $b->usuario->nombre_completo ?? 'N/A' }}</td>
            <td>{{ $b->ip }}</td>
            <td>{{ $b->modulo }}</td>
            <td>{{ $b->accion }}</td>
            <td>{{ $b->fecha_acceso }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
