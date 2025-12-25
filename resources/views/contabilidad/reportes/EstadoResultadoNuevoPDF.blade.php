<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        *,
        ::after,
        ::before {
            box-sizing: border-box;
        }

        html {
            font-family: sans-serif;
            line-height: 1.15;
            -webkit-text-size-adjust: 100%;
            -ms-text-size-adjust: 100%;
            -ms-overflow-style: scrollbar;
            -webkit-tap-highlight-color: transparent;
        }

        @page {
            margin: 1cm;
            padding: 1cm;
            /* background-image:url('/img/fac.png'); */
        }

        body {
            margin: 0px;
            padding: 0px;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol";
            font-size: 0.9rem;
            font-weight: 400;
            line-height: 1.5;
            color: #212529;
            text-align: left;
            background-color: #fff;
        }

        th {
            /* border-bottom: 2px solid black;  */
            /* background: red; */
            font-size: 12px;
            text-align: left;
        }

        .container {
            padding: 10px;
        }

        .header1 {
            font-size: 13px;
            font-weight: bolder;
        }

        .legend {
            font-size: 11px;
        }

        .header {
            text-align: center;
            margin-bottom: 1.2rem;
        }

        .header p {
            margin-top: 0;
            padding-top: 0;
            margin-bottom: 0;
            padding-bottom: 0;
        }

        table {
            font-size: 10px;
            padding: 0.8rem;
            /* background: blue; */
        }

        .td_separator {
            width: 2cm;
        }

        td {
            /* background: orangered; */
        }

        .cols {
            width: 3.5cm;
        }

        .money {
            text-align: right;
            width: 3.5cm;
        }

        .money::before {
            content: "$";
            float: left;
        }

        .total {
            border-bottom: 3px double black;
            border-top: 1px solid black;
        }

        .firma {
            border-top: 1px solid black;
            text-align: center;
            padding: 0 !important;
            margin: 0 !important;
        }

        .separador {
            height: 1.5cm !important;
        }

        .bolder {
            font-weight: bolder;
            text-transform: uppercase;
        }

        .border-b {
            border-bottom: 1px solid black;
        }

        .border-d {
            border-bottom: 3px double black;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <p class="header1">{{ Auth::user()->empresa->empresa }}</p>
            <p class="legend">ESTADO DE RESULTADOS</p>
            <p class="legend"> {{ $fechaReporte }}</p>
            <p class="legend">(EXPRESADO EN DÓLARES DE LOS ESTADOS UNIDOS DE AMÉRICA)</p>
        </div>
        <table style="width: 100%" >
            <thead class="">
                <tr>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th style="text-align: center;" width="120"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($utilidades as $utilidad)
                    @php
                        $utilidad->calcularSaldos($fechaInicio, $fechaFin, $utilidad->id, $empresaId);
                        $utilidad->refresh();
                    @endphp
                    @foreach ($utilidad->grupos as $grupo)
                        @php
                            $saldoGrupo = $grupo->saldo >= 0 ? $grupo->saldo : ($grupo->saldo * -1);
                        @endphp
                        <tr colspan="1">
                            <td style="padding-top:10px"><strong>{{ $grupo->grupo }}</strong></td>
                            <td ></td>
                            <td ></td>
                            <td style="text-align: right">
                               $ {{ number_format($saldoGrupo,2) }}
                            </td>
                        </tr>

                        @foreach ($grupo->subGrupos as $subGrupo)
                            @php
                                $saldoSubGrupo = $subGrupo->saldo >= 0 ? $subGrupo->saldo : ($subGrupo->saldo * -1);
                            @endphp
                            <tr >
                                <td style="padding-top:5px; padding-left:25px;">
                                    {{ $subGrupo->sub_grupo }} </td>
                                <td ></td>
                                <td style="text-align:right; padding-right:25px;">
                                       $ {{ number_format($saldoSubGrupo,2) }}
                                </td>
                            </tr>

                            @foreach ($subGrupo->cuentas as $cuenta)
                                @php
                                    $saldoCuenta = $cuenta->saldo >= 0 ? $cuenta->saldo : ($cuenta->saldo * -1);
                                @endphp
                                <tr>
                                    <td style="padding-top:5px; padding-left:25px;">{{ $cuenta->cuenta->codigo }} - {{ $cuenta->cuenta->nombre_cuenta }}</td>
                                    <td style="text-align:right; padding-right:25px;">$ {{ number_format($saldoCuenta,2) }}</td>
                                </tr>
                            @endforeach
                        @endforeach

                    @endforeach
                    @php
                        $saldoUtilidad = $utilidad->calcularSaldoUtilidad($utilidad->id);
                    @endphp
                    <tr style="padding-top:5px;padding-bottom:30px" >
                        <td style="padding-top:10px"></td>
                        
                        <td style="text-align: right; border-top: 2px solid; padding-bottom:30px">
                            <strong> {{ $utilidad->utilidad }}</strong>
                        </td>
                        <td></td>
                        <td style="text-align: right; border-top: 2px solid; padding-bottom:30px">
                           <strong> $ {{ number_format($saldoUtilidad,2) }}</strong>
                              
                        </td>
                    </tr>

                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                    
                @endforeach

                @php
                    foreach($utilidades as $key => $uti){
                        $uti::where('saldo', '!=', null)->update(['saldo' => 0]);
                    }
                @endphp

            </tbody>
        </table>

    </div>
</body>

</html>