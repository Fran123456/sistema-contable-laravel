<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        *, ::after, ::before {
            box-sizing: border-box;
        }
        html{
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
            font-family: -apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol";
            font-size: 0.9rem;
            font-weight: 400;
            line-height: 1.5;
            color: #212529;
            text-align: left;
            background-color: #fff;
        }
        th{
            /* border-bottom: 2px solid black;  */
            /* background: red; */
            font-size: 12px;
            text-align: left;
        }
        .container{
            padding: 10px;
        }
        .header1{
            font-size: 13px;
            font-weight: bolder;
        }
        .legend{
            font-size: 11px;
        }
        .header{
            text-align: center;
            margin-bottom: 1.2rem;
        }
        .header p{
            margin-top: 0;
            padding-top: 0;
            margin-bottom: 0;
            padding-bottom: 0;
        }
        table{
            font-size: 10px;
            padding: 0.8rem;
            /* background: blue; */
        }
        .td_separator{
            width: 2cm;
        }
        td{
            /* background: orangered; */
        }
        .cols{
            width: 3.5cm;
        }
        .money{
            text-align: right;
            width: 3.5cm;
        }
        .money::before{
            content: "$";
            float: left;
        }
        .total{
            border-bottom: 3px double black;
            border-top: 1px solid black;
        }
        .firma{
            border-top: 1px solid black;
            text-align: center;
            padding: 0 !important;
            margin: 0 !important;
        }
        .separador{
            height: 1.5cm !important;
        }
        .bolder{
            font-weight: bolder;
            text-transform: uppercase;
        }
        .border-b{
            border-bottom: 1px solid black;
        }
        .border-d{
            border-bottom: 3px double black;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <p class="header1">AGENTES PORTUARIOS DEL PACIFICO, S.A. DE C.V.</p>
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
                    <th style="text-align: center;" width="60"></th>
                </tr>
            </thead>
            <tbody>

            @for ($i = 0; $i<count($data); $i++ )
                @if ( $data[$i]->mayor != 2 )
                <tr>
                    <td class=" @if($data[$i]->bold ==1) bolder @endif ">{{   strtoupper($data[$i]->grupo)}}  {{ $data[$i]->cuenta }}</td>
                    <td></td>
                    <td class="money @if($data[$i]->bold ==1) bolder @endif  @if($data[$i]->underline ==1 )border-b  @endif">{{ number_format($data[$i]->saldo, 2)}} </td>
                    <td></td>
                </tr>
                @endif
                @for ($ii = 0; $ii < count($data[$i]->data); $ii++)
                  @if ($data[$i]->data[$ii]->cuenta !="21050101")
                  <tr>
                    <td class="@if($data[$i]->data[$ii]->bold ==1) bolder @endif">{{ $data[$i]->data[$ii]->nombre_cuenta??strtoupper($data[$i]->grupo)}} {{ $data[$i]->data[$ii]->cuenta }}</td>

                    @if ($data[$i]->data[$ii]->mayor == 0)
                    <td class="money  @if($data[$i]->data[$ii]->bold ==1) bolder @endif   @if($data[$i]->data[$ii]->underline ==1 )border-b  @endif ">{{ number_format($data[$i]->data[$ii]->saldo,2)  }}</td>
                    <td></td>
                    @endif

                    @if ($data[$i]->data[$ii]->mayor ==2)
                    <td></td>
                    <td class="money @if($data[$i]->data[$ii]->bold ==1) bolder @endif  @if($data[$i]->data[$ii]->underline ==1 )border-b  @endif ">{{ number_format($data[$i]->data[$ii]->saldo,2) }} </td>
                    @endif


                    <td></td>
                </tr>
                  @endif
                @endfor

                @if ($data[$i]->espacio == 1)
                <tr>
                    <td>&nbsp;</td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                @endif


            @endfor

             <!--   <tr>
                    <td class="bolder">INGRESOS POR SERVICIOS</td>
                    <td></td>
                    <td class="money bolder"> 1,769,178.03</td>
                    <td></td>
                </tr>
                <tr>
                    <td>Servicios Locales </th>
                    <td class="money">1,653,272.51</td>
                    <td></td>
                    <td></td>
                </tr>
                <tr >
                    <td>Servicios de Exportación </th>
                    <td class=" money">115,905.52</td>
                    <td></td>
                    <td></td>
                </tr>

                <tr>
                    <td>&nbsp;</th>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>

                <tr>
                    <td class="bolder">COSTOS DE OPERACIÓN </th>
                    <td></td>
                    <td class=" money bolder">115,905.52</td>
                    <td></td>
                </tr>

                <tr>
                    <td>&nbsp;</th>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>


                <tr>
                    <td class="bolder">UTILIDAD BRUTA</td>
                    <td ></td>
                    <td class="money bolder">354,575.36</td>
                    <td></td>
                </tr>

                <tr>
                    <td>&nbsp;</th>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>


                <tr>
                    <td class="bolder">GASTOS DE OPERACIÓN</td>
                    <td></td>
                    <td class="money bolder">279,293.61</td>
                    <td ></td>
                </tr>
                <tr>
                    <td>Gastos de venta</th>
                    <td class="money">62,928.25</td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>Gastos de administración</th>
                    <td class="money">216,365.36</td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>Gastos financieros</th>
                    <td class=" money">256,365.36</td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>&nbsp;</th>
                    <td class="cols"></td>
                    <td></td>
                    <td></td>
                </tr>



                <tr>
                    <td class="bolder">UTILIDAD DE LA OPERACIÓN</td>
                    <td ></td>
                    <td class="money border-d bolder"> 75,281.75</td>
                    <td ></td>
                </tr>
                <tr>
                    <td>&nbsp;</th>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>

                <tr>
                    <td>Otros gastos (ingresos) - Netos</th>

                    <td></td><td class=" money">256,365.36</td>
                    <td></td>
                </tr>

                <tr>
                    <td>Otros Ingresos no operacionales</th>

                    <td></td><td class=" money">10,661.26</td>
                    <td></td>
                </tr>

                <tr>
                    <td>&nbsp;</th>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>

                <tr>
                    <td class="bolder"> UTILIDAD DE OPERACION ANTES DE IMPUESTO SOBRE LA RENTA</td>
                    <td ></td>
                    <td class="money  bolder"> 82,938.56</td>
                    <td ></td>
                </tr>


                <tr>
                    <td>&nbsp;</th>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>

                <tr>
                    <td> IMPUESTO SOBRE LARENTA</th>

                    <td></td><td class=" money">10,661.26</td>
                    <td></td>
                </tr>

                <tr>
                    <td>&nbsp;</th>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>

                <tr>
                    <td class="bolder"> UTILIDAD NETA</th>

                    <td></td><td class=" money border-d bolder ">57,008.55</td>
                    <td></td>
                </tr>-->

            </tbody>
        </table>
        <table style="width: 100%; margin-top:125px;text-align:center;">
            <tbody>
                <tr>
                    @foreach ($firmas as $item)
                    <td style="border-top: 2px solid black;"> {{ $item->nombre }}</td>
                    <td></td>
                    @endforeach

                </tr>
                <tr>
                    @foreach ($firmas as $item)
                    <td>{{ $item->cargo }}</td>
                    <td></td>
                    @endforeach

                </tr>
            </tbody>
        </table>
    </div>
</body>
</html>
