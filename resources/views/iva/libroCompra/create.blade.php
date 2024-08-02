<x-app-layout>
    <x-slot:title>
        Crear Libro Compra
    </x-slot>
    <x-slot:subtitle>
    </x-slot>

    <div class="col-md-12">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('iva.libro_compras.index') }}">Libro Compra</a></li>
            <li class="breadcrumb-item active" aria-current="page">Crear</li>
        </ol>
    </div>
    <div class="col-md-12">
        <x-alert></x-alert>
    </div>

    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('iva.libro_compras.store') }}" method="post" id="observacionForm2">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mt-2 mb-12">
                            <label for="fecha_emision" class="form-label">Fecha Emisión</label>
                            <input type="datetime-local" class="form-control" id="fecha_emision" name="fecha_emision" required>
                        </div>
                        <div class="col-md-6 mt-2 mb-12">
                            <label for="fecha_emision_en_pdf" class="form-label">Fecha Emisión PDF</label>
                            <input type="datetime-local" class="form-control" id="fecha_emision_en_pdf" name="fecha_emision_en_pdf" required>
                        </div>
                        <div class="col-md-6 mt-2 mb-12">
                            <label for="documento" class="form-label">Documento</label>
                            <input type="text" class="form-control" id="documento" name="documento" required>
                        </div>
                        <div class="col-md-6 mt-2 mb-12">
                            <label for="excentas_internas" class="form-label">NIT</label>
                            <input type="number" step="1" class="form-control" id="nit" name="nit">
                        </div>
                        <div class="col-md-6 mt-2 mb-12">
                            <label for="excentas_importaciones" class="form-label">DUI</label>
                            <input type="number" step="1" class="form-control" id="dui" name="dui">
                        </div>
                        <div class="col-md-6 mt-2 mb-12">
                            <label for="gravadas_internas" class="form-label">NRC</label>
                            <input type="number" step="1" class="form-control" id="nrc" name="nrc">
                        </div>
                        <div class="col-md-6 mt-2 mb-12">
                            <label for="proveedor_id" class="form-label">Proveedor</label>
                            <select class="form-control" id="proveedor_id" name="proveedor_id">
                                <option value="">Seleccione un proveedor</option>
                                @foreach ($proveedores as $proveedor)
                                    <option value="{{ $proveedor->id }}">{{ $proveedor->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 mt-2 mb-12">
                            <label for="excentas_internas" class="form-label">Excentas Internas</label>
                            <input type="number" step="0.01" class="form-control" id="excentas_internas" name="excentas_internas">
                        </div>
                        <div class="col-md-6 mt-2 mb-12">
                            <label for="excentas_importaciones" class="form-label">Excentas Importaciones</label>
                            <input type="number" step="0.01" class="form-control" id="excentas_importaciones" name="excentas_importaciones">
                        </div>
                        <div class="col-md-6 mt-2 mb-12">
                            <label for="gravadas_internas" class="form-label">Gravadas Internas</label>
                            <input type="number" step="0.01" class="form-control" id="gravadas_internas" name="gravadas_internas">
                        </div>
                        <div class="col-md-6 mt-2 mb-12">
                            <label for="gravadas_importaciones" class="form-label">Gravadas Importaciones</label>
                            <input type="number" step="0.01" class="form-control" id="gravadas_importaciones" name="gravadas_importaciones">
                        </div>
                        <div class="col-md-6 mt-2 mb-12">
                            <label for="gravada_iva" class="form-label">Gravada IVA</label>
                            <input type="number" step="0.01" class="form-control" id="gravada_iva" name="gravada_iva">
                        </div>
                        <div class="col-md-6 mt-2 mb-12">
                            <label for="contribucion_especial" class="form-label">Contribución Especial</label>
                            <input type="number" step="0.01" class="form-control" id="contribucion_especial" name="contribucion_especial">
                        </div>
                        <div class="col-md-6 mt-2 mb-12">
                            <label for="anticipo_iva_retenido" class="form-label">Anticipo IVA Retenido</label>
                            <input type="number" step="0.01" class="form-control" id="anticipo_iva_retenido" name="anticipo_iva_retenido">
                        </div>
                        <div class="col-md-6 mt-2 mb-12">
                            <label for="anticipo_iva_recibido" class="form-label">Anticipo IVA Recibido</label>
                            <input type="number" step="0.01" class="form-control" id="anticipo_iva_recibido" name="anticipo_iva_recibido">
                        </div>
                        <div class="col-md-6 mt-2 mb-12">
                            <label for="total_compra" class="form-label">Total Compra</label>
                            <input type="number" step="0.01" class="form-control" id="total_compra" name="total_compra">
                        </div>
                        <div class="col-md-6 mt-2 mb-12">
                            <label for="compras_excluidas" class="form-label">Compras Excluidas</label>
                            <input type="number" step="0.01" class="form-control" id="compras_excluidas" name="compras_excluidas">
                        </div>
                        <div class="col-md-6 mt-2 mb-12 form-check">
                            <input type="checkbox" class="form-check-input" id="mostrar" name="mostrar">
                            <label class="form-check-label" for="mostrar">Mostrar</label>
                        </div>
                        <div class="col-md-12 mt-4 mb-1">
                            <button class="btn btn-success" type="submit">Guardar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.snow.css" rel="stylesheet">
    <script>
        document.addEventListener("DOMContentLoaded", function() {

            // Se inicializa el richText
            const quill = new Quill('#editor', {
                theme: 'snow'
            });

            // El contenido del richText se pasa a un input
            document.querySelector('#observacionForm2').onsubmit = function() {
                const content = quill.root.innerHTML;
                document.querySelector('#anexo').value = content;
            };
        });
    </script>
</x-app-layout>
