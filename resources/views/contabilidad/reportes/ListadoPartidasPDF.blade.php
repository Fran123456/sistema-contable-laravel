<html>

<head>
    <style>
        html {
            font-family: sans-serif;
            line-height: 1.15;
            -webkit-text-size-adjust: 100%;
            -ms-text-size-adjust: 100%;
            -ms-overflow-style: scrollbar;
            -webkit-tap-highlight-color: transparent;
        } p {
            font-size: 13px;
            margin-top: -5px;
        }

        @page {
            margin: 0cm;
            padding: 0.0cm;
            /* background-image:url('/img/fac.png'); */
        }
        body {
            font-family: sans-serif;
        }

        @page {
            margin: 160px 40px;
        }

        header {
            position: fixed;
            left: 0px;
            top: -100px;
            right: 0px;
            height: 50px;
            background-color: #white;
            text-align: center;
        }

        header h1 {
            margin: 10px 0;
        }

        .header p {
            margin-top: 0;
            padding-top: 0;
            margin-bottom: 0;
            padding-bottom: 0;
        }

        header h2 {
            margin: 0 0 10px 0;
        }

        .header1 {
            font-size: 16px;
            font-weight: bolder;
        }

        .legend {
            font-size: 12px;
        }

        .header {
            text-align: center;
            margin-bottom: 2rem;
        }


        footer {
            position: fixed;
            left: 0px;
            bottom: -80px;
            right: 0px;
            height: 10px;
            border-bottom: 2px solid rgb(70, 70, 70);
        }

        footer .page:after {
            content: counter(page);
        }

        footer table {
            width: 100%;
        }

        footer p {
            text-align: right;
        }

        footer .izq {
            text-align: left;
        }
        table {
            font-size: 12px;
            padding: 1rem;
            width: 100%;
            /* background: blue; */
        }

        .td_separator {
            width: 2cm;
        }

        td {
            /* background: orangered; */
        }

        .money {
            text-align: right;
            width: 2.5cm;
        }

        .money:before {
            content: "$";
            float: left;
        }

        .money:empty::before {
            color: white;
        }

        .total {
            border-bottom: 2px solid black;
            /* border-top: 1px solid black; */
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

        td {
            padding: 0 3px;
        }

        th {
            border-bottom: 1px solid black;
        }
    </style>

<body>
    <header>
        <p class="header1">{{ strtoupper(auth()->user()->empresa->empresa) }}</p>
        <p>LISTADO DE PARTIDAS CONTABLES</p>
        <p>Del {{ Help::date($fechai) }}  al  {{ Help::date($fechaf) }} </p>
    </header>
    <footer>
        <table style="magin-top:10px">
            <tr>
                <td>
                    <p class="izq">
                        {{ strtoupper(auth()->user()->empresa->empresa) }}
                    </p>
                </td>
                <td>
                    <p class="page">
                        Página
                    </p>
                </td>
            </tr>
        </table>
    </footer>
    <div id="content">
        <div class="">
            <table class="table">
                <thead>
                    <tr>
                        <td>#</td>
                        <th>Partida</th>
                        <th>Concepto</th>
                        <th>Debe</th>
                        <th>Haber</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($partida as $key => $item)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ Help::codigoPartida($item) }}</td>
                            <td>{{ $item->concepto}} </td>
                            <td class="money"> {{ number_format($item->debe, 2) }}</td>
                            <td class="money">{{ number_format($item->haber, 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            
            <table>
                <tbody>
                    <!--<tr>
                        <td style="width:4cm;border-bottom:1px solid black;">&nbsp;</td>
                        <td style="width: 1cm;">&nbsp;</td>
                        <td style="width:4cm;border-bottom:1px solid black;">&nbsp;</td>
                        <td style="width: 1cm;">&nbsp;</td>
                        <td style="width:4cm;border-bottom:1px solid black;">&nbsp;</td>
                    </tr>-->
                    <!-- <tr>
                        <td style="text-align: center;">Elaborado</td>
                        <td style="text-align: center;"></td>
                        <td style="text-align: center;">Revisado</td>
                        <td style="text-align: center;"></td>
                        <td style="text-align: center;">Autorizado</td>
                    </tr>-->
                </tbody>
            </table>
        </div>



    </div>
</body>

</html>
