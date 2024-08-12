<x-app-layout>
    <x-chosen></x-chosen>
    <x-slot:title>
        Editar Libro Compra
    </x-slot>
    <x-slot:subtitle>
    </x-slot>



    <div class="col-md-12">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('iva.libro_compras.index') }}">Libro Compra</a></li>
            <li class="breadcrumb-item active" aria-current="page">Editar</li>
        </ol>
    </div>
    <div class="col-md-12">
        <x-alert></x-alert>
    </div>

    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('iva.libro_compras.update', $libroCompra) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-12">
                            <h6><strong>GENERALIDADES</strong></h6>
                        </div>
                        <div class="col-md-4 mt-2 mb-12">
                            <label for="fecha_emision" class="form-label"> <strong>Fecha Emisión</strong> </label>
                            <input type="date" class="form-control" id="fecha_emision" name="fecha_emision"
                                value="{{ $libroCompra->fecha_emision ? \Carbon\Carbon::parse($libroCompra->fecha_emision)->format('Y-m-d') : '' }}"
                                max="{{ date('Y-m-d') }}" required>
                        </div>
                        <div class="col-md-4 mt-2 mb-12">
                            <label for="fecha_emision_en_pdf" class="form-label"> <strong>Fecha Emisión PDF</strong> </label>
                            <input type="date" class="form-control" id="fecha_emision_en_pdf" name="fecha_emision_en_pdf"
                                value="{{ $libroCompra->fecha_emision_en_pdf ? \Carbon\Carbon::parse($libroCompra->fecha_emision_en_pdf)->format('Y-m-d') : '' }}"
                                max="{{ date('Y-m-d') }}" required>
                        </div>
                        <div class="col-md-4 mt-2 mb-12">
                            <label for="documento" class="form-label"> <strong>Documento</strong></label>
                            <input type="text" class="form-control" id="documento" name="documento" value="{{ $libroCompra->documento }}" placeholder="Ingresar" required>
                        </div>
                        <div class="col-md-6 mt-2 mb-12">
                            <label for="proveedor_id" class="form-label"> <strong>Proveedor</strong> </label>
                            <select class="form-control" id="proveedor_id" name="proveedor_id">
                                <option value="">Seleccione un proveedor</option>
                                @foreach ($proveedores as $proveedor)
                                    <option value="{{ $proveedor->id }}" {{ $libroCompra->proveedor_id == $proveedor->id ? 'selected' : '' }}>{{ $proveedor->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 mt-2 mb-12">
                            <label for="excentas_internas" class="form-label"> <strong>NIT</strong> </label>
                            <input type="number" step="1" class="form-control" id="nit" name="nit" value="{{ $libroCompra->nit }}" placeholder="Ingresar">
                        </div>
                        <div class="col-md-6 mt-2 mb-12">
                            <label for="excentas_importaciones" class="form-label"> <strong>DUI</strong>  </label>
                            <input type="number" step="1" class="form-control" id="dui" name="dui" value="{{ $libroCompra->dui }}" placeholder="Ingresar">
                        </div>
                        <div class="col-md-6 mt-2 mb-12">
                            <label for="gravadas_internas" class="form-label"> <strong>NRC</strong> </label>
                            <input type="number" step="1" class="form-control" id="nrc" name="nrc" value="{{ $libroCompra->nrc }}" placeholder="Ingresar">
                        </div>
                        <div class="col-md-12">
                            <hr>
                            <h6><strong>EXCENTAS</strong></h6>
                        </div>
                        <div class="col-md-6 mt-2 mb-12">
                            <label for="excentas_internas" class="form-label"><strong>Excentas Internas</strong></label>
                            <input type="number" step="0.01" class="form-control" id="excentas_internas" name="excentas_internas" value="{{ $libroCompra->excentas_internas }}">
                        </div>
                        <div class="col-md-6 mt-2 mb-12">
                            <label for="excentas_importaciones" class="form-label"><strong>Excentas Importaciones</strong></label>
                            <input type="number" step="0.01" class="form-control" id="excentas_importaciones" name="excentas_importaciones" value="{{ $libroCompra->excentas_importaciones }}">
                        </div>
                        <div class="col-md-12">
                            <hr>
                            <h6><strong>GRAVADAS</strong></h6>
                        </div>
                        <div class="col-md-6 mt-2 mb-12">
                            <label for="gravadas_internas" class="form-label"><strong>Gravadas Internas</strong></label>
                            <input type="number" step="0.01" class="form-control" id="gravadas_internas" name="gravadas_internas" value="{{ $libroCompra->gravadas_internas }}">
                        </div>
                        <div class="col-md-6 mt-2 mb-12">
                            <label for="gravadas_importaciones" class="form-label"><strong>Gravadas Importaciones</strong></label>
                            <input type="number" step="0.01" class="form-control" id="gravadas_importaciones" name="gravadas_importaciones" value="{{ $libroCompra->gravadas_importaciones }}">
                        </div>
                        <div class="col-md-12">
                            <hr>
                            <h6><strong>IVA Y OTROS</strong></h6>
                        </div>
                        <div class="col-md-6 mt-2 mb-12">
                            <label for="gravada_iva" class="form-label"><strong>Gravada IVA</strong></label>
                            <input type="number" step="0.01" class="form-control" id="gravada_iva" name="gravada_iva" value="{{ $libroCompra->gravada_iva }}">
                        </div>
                        <div class="col-md-6 mt-2 mb-12">
                            <label for="contribucion_especial" class="form-label"><strong>Contribución Especial</strong></label>
                            <input type="number" step="0.01" class="form-control" id="contribucion_especial" name="contribucion_especial" value="{{ $libroCompra->contribucion_especial }}">
                        </div>
                        <div class="col-md-6 mt-2 mb-12">
                            <label for="anticipo_iva_retenido" class="form-label"><strong>Anticipo IVA Retenido</strong></label>
                            <input type="number" step="0.01" class="form-control" id="anticipo_iva_retenido" name="anticipo_iva_retenido" value="{{ $libroCompra->anticipo_iva_retenido }}">
                        </div>
                        <div class="col-md-6 mt-2 mb-12">
                            <label for="anticipo_iva_recibido" class="form-label"><strong>Anticipo IVA Recibido</strong></label>
                            <input type="number" step="0.01" class="form-control" id="anticipo_iva_recibido" name="anticipo_iva_recibido" value="{{ $libroCompra->anticipo_iva_recibido }}">
                        </div>
                        <div class="col-md-6 mt-2 mb-12">
                            <label for="total_compra" class="form-label"><strong>Total Compra</strong></label>
                            <input type="number" class="form-control" id="total_compra" name="total_compra" value="{{ $libroCompra->total_compra }}">
                        </div>
                        <div class="col-md-6 mt-2 mb-12">
                            <label for="compras_excluidas" class="form-label"><strong>Compras Excluidas</strong></label>
                            <input type="number" step="0.01" class="form-control" id="compras_excluidas" name="compras_excluidas" value="{{ $libroCompra->compras_excluidas }}">
                        </div>
                        <div class="col-md-12">
                            <hr>
                           
                        </div>
                       
                        <div class="col-md-6 mt-2 mb-12">
                            <label for="detalle_id" class="form-label"><strong>Mostrar</strong></label>
                            <select class="form-control" name="mostrar" id="mostrar">
                                <option value="0" {{ $libroCompra->mostrar == 0 ? 'selected' : '' }}>NO</option>
                                <option value="1" {{ $libroCompra->mostrar == 1 ? 'selected' : '' }}>SI</option>
                            </select>
                        </div>
                        {{-- Obtencion de la empresa --}}
                        <input type="hidden" name="empresa_id" value="{{ Help::empresa() }}">
                        <div class="col-md-12 mt-4 mb-1">
                            <button type="submit" class="btn btn-success">Guardar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
