<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Contacto</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />

</head>

<body class="container my-5 d-flex flex-column gap-3 justify-content-center ">
    <h2 class="text-center">Formulario para registro de contacto</h2>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if (session('danger'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('danger') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card shadow">
        <div class="card-body">
            <form action="{{route('SaveformPublicContacto') }}" method="post" enctype="multipart/form-data" id="observacionForm">
                @csrf
                <div class="row">
                    <div class="col-md-6 mt-2 mb-12">
                        <label for="contacto_nombre"> <strong>Nombre</strong> </label>
                        <input type="text" name="nombre" class="form-control" required>
                        @error('nombre')
                            {{ $message }}
                        @enderror
                    </div>
                    <div class="col-md-6 mt-2 mb-12">
                        <label for="contacto_apellido"> <strong>Apellido</strong> </label>
                        <input type="text" name="apellido" class="form-control" required>
                        @error('apellido')
                            {{ $message }}
                        @enderror
                    </div>
                    <div class="col-md-6 mt-2 mb-12">
                        <label for="contacto_correo"> <strong>Correo electrónico</strong> </label>
                        <input type="text" name="correo" class="form-control">
                    </div>
                    <div class="col-md-6 mt-2 mb-12">
                        <label for="contacto_telefono"> <strong>Teléfono</strong> </label>
                        <input type="text" name="telefono" class="form-control" required>
                        @error('telefono')
                            {{ $message }}
                        @enderror
                    </div>
                    <div class="col-md-6 mt-2 mb-12">
                        <label for="medio_contacto"> <strong>Medio de contacto</strong> </label>
                        <input type="text" name="contactado_en" class="form-control">
                    </div>
                    <div class="col-md-6 mt-2 mb-12">
                        <label for="cargo"> <strong>Cargo</strong></label>
                        <select required id="cargo_id" name="cargo_id" class="form-select select2">
                            <option value="">Selecciona una opción</option>
                            @foreach ($cargos as $cargo)
                                <option value="{{ $cargo->id }}">{{ $cargo->cargo }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="col-md-6 mt-2 mb-6">
                        <label for="cv"><strong>CV</strong></label>
                        <input class="form-control" type="file" name="cv" id="cv"
                            accept="application/pdf">
                    </div>

                    <div class="col-md-6 mt-2 mb-12">
                        <label for="pais_id"> <strong>Pais</strong></label>
                        <select required id="pais_id" name="pais_id" class="form-select select2">
                            <option value="">Selecciona una opción</option>
                            @foreach ($paises as $pais)
                                <option value="{{ $pais->id }}">{{ $pais->pais }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-12 mt-2 mb-12">
                        <label for="portafolio"> <strong>Portafolio</strong> </label>
                        <input type="text" name="portafolio" class="form-control">
                        @error('portafolio')
                            {{ $message }}
                        @enderror
                    </div>



                    <div class="col-md-12 mt-2 mb-12">
                        <label for="medio_contacto"> <strong>Anexo</strong> </label>
                        <div id="editor" class="form-control"></div>
                        <input type="hidden" name="anexo" id="anexo">
                    </div>

                    <div>
                        <input type="hidden" name="empresa_id" value="{{ $empresa_id }}"
                            class="form-control">
                    </div>
                    <br>
                    <br>
                    <div class="col-md-12 mt-4 mb-1">
                        <button class="btn btn-success" style="color:aliceblue" type="submit">Guardar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.snow.css" rel="stylesheet">

    <script>
        $('.select2').each(function() {
            $(this).select2({
                theme: "bootstrap-5",
                dropdownParent: $(this).parent()
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            const quill = new Quill('#editor', {
                theme: 'snow'
            });

            document.querySelector('#observacionForm').onsubmit = function() {
                const content = quill.root.innerHTML;
                document.querySelector('#anexo').value = content;
            };
        });
    </script>
</body>

</html>
