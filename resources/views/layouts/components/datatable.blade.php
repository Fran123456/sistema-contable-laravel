
<link rel="stylesheet" href="{!! asset('datatable/datatables.min.css') !!}">
<script src="{!! asset('datatable/datatables.min.js') !!} "></script>
<style>
    .dropdown-menu .dropdown-item.active,
    .dropdown-menu .dropdown-item:active {
        background: #0c09098a;
    }
</style>

@php
    //BOTON DE COPIAR FILAS
    $copyTitle = Help::getConfigByKey('datatable', 'copyTitle');
    $copyTitleShow = Help::getConfigByKey('datatable', 'copyTitleShow');
    //BOTON DE COPIAR FILAS

    //BOTON DE CSV
    $csvShow = Help::getConfigByKey('datatable', 'csvShow');
    //BOTON DE CSV

    //BOTON DE Excel
    $excelShow = Help::getConfigByKey('datatable', 'excelShow');
    //BOTON DE Excel

    //BOTON DE PDF
    $pdfShow = Help::getConfigByKey('datatable', 'pdfShow');
    //BOTON DE PDF

    //BOTON DE IMPRESION
    $printShow = Help::getConfigByKey('datatable', 'printShow');
    //BOTON DE IMPRESION

    //BOTON DE VISIBILIDAD
    $visibilityShow = Help::getConfigByKey('datatable', 'visibilityShow');
    //BOTON DE VISIBILIDAD

    //SELECCIONAR VARIAS FILAS
    $select = Help::getConfigByKey('datatable', 'select');
    //SELECCIONAR VARIAS FILAS
@endphp

<script type="text/javascript">

    //BOTON DE COPIAR FILAS
    let copyTitle = {!! "'" . $copyTitle?->value . "'" !!}
    let objCopyTile = null;
    if ({{ $copyTitleShow?->value }} == 1) {
        objCopyTile = {
            extend: 'copyHtml5',
            text: ' <i class="fas fa-copy fa-2x"></i>',
            titleAttr: 'Copiar',
            exportOptions: {
                columns: ':visible'
            }
        }
    }
    //BOTON DE COPIAR FILAS

    //BOTON DE CSV
    let csvShow = null;
    if ({{ $csvShow?->value }} == 1) {
        csvShow = {
            extend: 'csvHtml5',
            text: '<i class="fas fa-file-csv fa-2x"></i>',
            titleAttr: 'CSV',
            exportOptions: {
                columns: ':visible'
            }
        }
    }
    //BOTON DE CSV

    //BOTON DE Excel
    let excelShow = null;
    if ({{ $excelShow?->value }} == 1) {
        excelShow = {
            extend: 'excelHtml5',
            text: '<i class="fas fa-file-excel fa-2x"></i>',
            title: 'Data export', //titulo del archivo,
            autoFilter: true,
            sheetName: 'Exported data',
            titleAttr: 'Excel',
            exportOptions: {
                columns: ':visible'
            }
            // split: [ 'excelHtml5', 'csvHtml5'],
        }
    }
    //BOTON DE Excel

    //BOTON DE PDF
    let pdfShow = null;
    if ({{ $pdfShow?->value }} == 1) {
        pdfShow = {
            extend: 'pdfHtml5',
            title: "{{ $title ?? 'Sistema contable' }}", //titulo del archivo,
            messageTop: "{{ $subtitle ??'' }}",
            download: 'open',
            titleAttr: 'PDF',
            text: '<i class="fas fa-file-pdf fa-2x"></i>',
            exportOptions: {
                columns: ':visible'
            }

        }
    }
    //BOTON DE PDF

    //BOTON DE IMPRESION
    let printShow = null;
    if ({{ $printShow?->value }} == 1) {
        printShow = {
            extend: 'print',
            autoPrint: false,
            text: '<i class="fas fa-print fa-2x"></i>',
            exportOptions: {
                columns: ':visible',
            }
        }
    }
    //BOTON DE IMPRESION

    //BOTON DE VISIBILIDAD
    let visibilityShow = null;
    if ({{ $visibilityShow?->value }} == 1) {
        visibilityShow = {
            extend: 'colvis',
            columns: ':not(.noVis)',
            collectionLayout: 'fixed columns',
            collectionTitle: 'Visibilidad de las columnas'
        }
    }
    //BOTON DE VISIBILIDAD

    //VISIBILIDAD DE FILAS

    let select = false;
    if ({{ $select?->value }} == 1) {
        select = true;
    }
    //VISIBILIDAD DE FILAS

    let buttons = [];
    if (objCopyTile != null) buttons.push(objCopyTile);
    if (csvShow != null) buttons.push(csvShow);
    if (excelShow != null) buttons.push(excelShow);
    if (pdfShow != null) buttons.push(pdfShow);
    if (printShow != null) buttons.push(printShow);
    if (visibilityShow != null) buttons.push(visibilityShow);

    $(document).ready(function() {
        $.noConflict();
        $('#datatable-responsive').DataTable({
            ///fixedColumns: true,
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json",
                buttons: {
                    copyTitle: copyTitle,
                    copyKeys: 'Appuyez sur <i>ctrl</i> ou <i>\u2318</i> + <i>C</i> ',
                    copySuccess: {
                        _: '%d lineas copiadas',
                        1: '1 linea copiada'
                    },
                    colvis: 'Visibilidad'
                }
            },
            dom: 'Bfrtip',
            buttons: buttons,
            select: select,
            columnDefs: [{
                visible: false
            }]
        });
    });
</script>
