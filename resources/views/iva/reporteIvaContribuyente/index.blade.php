<x-app-layout>
    <x-slot:title>
        Reporte Libro Compra
    </x-slot>
    <x-slot:subtitle>
    </x-slot>

    <div class="col-md-12">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Dasboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Reporte Libro IVA contribuyente</li>
        </ol>
    </div>
    <div class="col-md-12">
        <x-alert></x-alert>
    </div>

    <div class="col-md-12">
    </div>

    <div class="col-md-12">

        <h5 class="my-4">Opciones de reporte de libro IVA contribuyente</h5>

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif


        <form  method="get" target="_blank">
            <div class="row">
                <div class="col-12 col-md-6">
                    <div class="form-floating">
                        <select class="form-select" name="month" id="selectedMonth">
                            <!-- Opciones de meses  -->
                        </select>
                        <label for="selectMonth">Seleccione el mes</label>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="form-floating mb-3">
                        <input type="number" class="form-control" name="year" id="selectedYear"
                            value="{{ date('Y') }}">
                        <label for="selectedYear">Año</label>
                    </div>
                </div>
                <div class="col-12 text-center">
                    <button type="submit" class="btn btn-danger text-white" name="pdf" value="pdf">
                        <i class="fa-regular fa-file-pdf fa-lg"></i> Generar Reporte PDF
                    </button>
                    <button type="submit" class="btn btn-success" name="excel" value="excel">
                        <i class="fa-regular fa-file-excel fa-lg"></i> Generar Reporte Excel
                    </button>

                </div>

            </div>
        </form>

    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const months = [{
                    value: '01',
                    content: 'Enero'
                },
                {
                    value: '02',
                    content: 'Febrero'
                },
                {
                    value: '03',
                    content: 'Marzo'
                },
                {
                    value: '04',
                    content: 'Abril'
                },
                {
                    value: '05',
                    content: 'Mayo'
                },
                {
                    value: '06',
                    content: 'Junio'
                },
                {
                    value: '07',
                    content: 'Julio'
                },
                {
                    value: '08',
                    content: 'Agosto'
                },
                {
                    value: '09',
                    content: 'Septiembre'
                },
                {
                    value: '10',
                    content: 'Octubre'
                },
                {
                    value: '11',
                    content: 'Noviembre'
                },
                {
                    value: '12',
                    content: 'Diciembre'
                }
            ];

            const selectMonth = document.getElementById('selectedMonth');

            months.forEach(month => {
                const option = document.createElement('option');
                option.value = month.value;
                option.textContent = month.content;
                selectMonth.appendChild(option);
            });
        });
    </script>

</x-app-layout>
