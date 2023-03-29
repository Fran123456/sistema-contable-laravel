<!--<link rel="stylesheet" href="{--!! asset('datatable/css/lib/datatable/dataTables.bootstrap.min.css') !!}">
<script src="{--!! asset('datatable/js/lib/data-table/datatables.min.js') !!}"></script>
<script src="{--!! asset('datatable/js/lib/data-table/dataTables.bootstrap.min.js') !!}"></script>
<script src="{--!! asset('datatable/js/lib/data-table/dataTables.buttons.min.js') !!}"></script>
<script src="{--!! asset('datatable/js/init/datatables-init.js') !!} "></script>-->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<link rel="stylesheet" href="{!! asset('datatable/datatables.min.css') !!}">
<script src="{!! asset('datatable/datatables.min.js') !!} "></script>
<style>

.dropdown-menu .dropdown-item.active, .dropdown-menu .dropdown-item:active {
    background: #0c09098a;
}
</style>

<script type="text/javascript">
      $(document).ready(function() {
        $('#datatable-responsive').DataTable({
            ///fixedColumns: true,
            "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json",
              buttons: {
                copyTitle: 'Se ha copiado los registros correctamente',
                copyKeys: 'Appuyez sur <i>ctrl</i> ou <i>\u2318</i> + <i>C</i> ',
                copySuccess: {
                    _: '%d lineas copiadas',
                    1: '1 linea copiada'
                },
                colvis: 'Visibilidad'
            }
        },
        dom: 'Bfrtip',
        buttons: [
            {
               
                extend:'copyHtml5',
                text:' <i class="fas fa-copy fa-2x"></i>',
                titleAttr: 'CSV'
            },
            
            {
                extend:'csvHtml5',
                text:'<i class="fas fa-file-csv fa-2x"></i>',
                titleAttr: 'CSV'
            },
           

            {
                extend: 'excelHtml5',
                text:      '<i class="fas fa-file-excel fa-2x"></i>',
                title: 'Data export',//titulo del archivo,
                autoFilter: true,
                sheetName: 'Exported data',
                titleAttr: 'Excel'
               // split: [ 'excelHtml5', 'csvHtml5'],

            },
            {
                extend: 'pdfHtml5',
                title: 'Data export' ,//titulo del archivo,
                messageTop: 'PDF created by PDFMake with Buttons for DataTables.',
                download: 'open',
                titleAttr: 'PDF',
                text: '<i class="fas fa-file-pdf fa-2x"></i>',
                
            },
            {
                extend: 'print',
                autoPrint: false,
                text: '<i class="fas fa-print fa-2x"></i>',
                exportOptions: {
                    columns: ':visible',
                }
            },
            {
                extend: 'colvis',
                columns: ':not(.noVis)',
                collectionLayout: 'fixed columns',
                collectionTitle: 'Column visibility control'
            },
            

        ],
        select: true,
        columnDefs: [ {
            
            visible: false
        } ]
       
        
        });
    } );
</script>