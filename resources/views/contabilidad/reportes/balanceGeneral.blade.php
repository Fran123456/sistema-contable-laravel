<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Balance General</title>
</head>
<body>
    <table border="1" width="100%" cellpadding="4" cellspacing="0">
        <thead>
            <tr>
                <th colspan="3" style="font-size:20px; text-align:center;">{{ $nombreEmpresa }}</th>
            </tr>
            <tr>
                <th colspan="3" style="font-size:16px; text-align:center;">{{ $fechaReporte }}</th>
            </tr>
            <tr>
                <th colspan="3" style="font-size:14px; text-align:center;">(EXPRESADO EN DÓLARES DE LOS ESTADOS UNIDOS DE AMÉRICA)</th>
            </tr>
        </thead>
    </table>
<div style="display:flex; justify-content:space-between;">
    {{-- Activos --}}
    <table border="1" width="48" cellpadding="4" cellspacing="0">
        <thead>
            <tr>
                <th colspan="3"></th>
            </tr>
        </thead>
        <tbody>
            @php $totalAc = 0; @endphp
            @foreach ($rubrosActivo as $rubroAct)
                @php
                    $rubroAct->calcular($rubroAct->id, $fechaInicial, $fechaFinal);
                    $rubroAct->refresh();
                    $totalAc += $rubroAct->saldo;
                @endphp
                <tr>
                    <td colspan="3" style="font-weight:bold; text-align:center;">{{ Str::upper($rubroAct->rubro) }}</td>
                </tr>
                @foreach ($rubroAct->grupos as $grupoAct)
                    <tr>
                        <td width="50" style="font-weight:bold;">{{ Str::upper($grupoAct->grupo) }}</td>
                        <td width="20"></td>
                        <td width="30" align="right">{{ number_format($grupoAct->saldo,2) }}</td>
                    </tr>

                    @foreach ($grupoAct->cuentas as $cuentaAct)
                        <tr>
                            <td width="50">&nbsp;&nbsp;&nbsp;{{ Str::upper($cuentaAct->cuenta?->nombre_cuenta) }}</td>
                            <td width="20"></td>
                            <td width="30" align="right">{{ number_format($cuentaAct->saldo,2) }}</td>
                        </tr>
                    @endforeach
                @endforeach
            @endforeach
            <tr>
                <td colspan="2" style="font-weight:bold; text-align:right;">TOTAL ACTIVOS</td>
                <td style="text-align:right;">{{ number_format($totalAc,2) }}</td>
            </tr>
        </tbody>
    </table>

    {{-- Pasivos --}}
    <table border="1" width="48" cellpadding="4" cellspacing="0">
        <thead>
            <tr>
                <th colspan="3" style=""></th>
            </tr>
        </thead>
        <tbody>
            @php $totalPa = 0; @endphp
            @foreach ($rubrosPasivo as $rubroPa)
                @php
                    $rubroPa->calcular($rubroPa->id, $fechaInicial, $fechaFinal);
                    $rubroPa->refresh();
                    $totalPa += $rubroPa->saldo;
                @endphp
                <tr>
                    <td colspan="3" style="font-weight:bold; text-align:center;">{{ Str::upper($rubroPa->rubro) }}</td>
                </tr>
                @foreach ($rubroPa->grupos as $grupoPa)
                    <tr>
                        <td width="50" style="font-weight:bold;">{{ Str::upper($grupoPa->grupo) }}</td>
                        <td width="20"></td>
                        <td width="30" align="right">{{ number_format($grupoPa->saldo,2) }}</td>
                    </tr>
                    @foreach ($grupoPa->cuentas as $cuentaPa)
                        <tr>
                            <td width="50">&nbsp;&nbsp;&nbsp;{{ Str::upper($cuentaPa->cuenta?->nombre_cuenta) }}</td>
                            <td width="20"></td>
                            <td width="30" align="right">{{ number_format($cuentaPa->saldo,2) }}</td>
                        </tr>
                    @endforeach
                @endforeach
            @endforeach
            <tr>
                <td colspan="2" style="font-weight:bold; text-align:right;">TOTAL PASIVOS</td>
                <td style="text-align:right;">{{ number_format($totalPa,2) }}</td>
            </tr>
        </tbody>
    </table>
</div>

    
</body>
</html>