<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Formulario producto proveedor</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body class="container my-5 d-flex flex-column gap-3 justify-content-center ">
    <h2 class="text-center">Formulario para registro de Stock</h2>

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

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Codigo</th>
                            <th scope="col">Producto</th>
                            <th scope="col">Precio unitario</th>
                            <th scope="col">Stock</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                        @foreach ($productoProveedor as $key => $item)
                            <tr>
                                <form class="update-form" method="POST"
                                    action="{{ route('updateFormProveedor', $item->id) }}">
                                    @csrf
                                    @method('PUT')
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $item->codigo }}</td>
                                    <td>
                                        <span>{{ $item->producto }}</span>

                                        {{-- <select name="producto_id" id="producto"
                                            class="form-control input-editable d-none " required>

                                            <option value="">Selecciona una opción</option>
                                            @foreach ($productos as $producto)
                                                <option value="{{ $producto->id }}">{{ $producto->producto }}</option>
                                            @endforeach
                                        </select>
                                        @error('producto')
                                            {{ $message }}
                                        @enderror --}}
                                    </td>
                                    <td class="editable">
                                        <span>{{ $item->precio_unitario }}</span>
                                        <input class="form-control input-editable d-none" name="precio_unitario"
                                            value="{{ $item->precio_unitario }}">
                                        @error('precio_unitario')
                                            {{ $message }}
                                        @enderror
                                    </td>
                                    <td class="editable">
                                        <span>{{ $item->stock }}</span>
                                        <input class="form-control input-editable d-none" name="stock" type="number"
                                            value="{{ $item->stock }}">
                                        @error('stock')
                                            {{ $message }}
                                        @enderror
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-primary edit-btn">
                                            <i class='bx bxs-edit-alt'></i>Editar</button>
                                        <button type="submit" class="btn btn-success save-btn d-none">
                                            <i class='bx bx-save'></i>Guardar</button>
                                        <button type="button" class="btn btn-secondary cancel-btn d-none">
                                            <i class='bx bx-x'></i>Cancelar</button>
                                    </td>
                                </form>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const editButtons = document.querySelectorAll('.edit-btn');
            const saveButtons = document.querySelectorAll('.save-btn');
            const cancelButtons = document.querySelectorAll('.cancel-btn');

            editButtons.forEach((button, index) => {
                button.addEventListener('click', function() {
                    const row = this.closest('tr');
                    row.querySelectorAll('td.editable').forEach((cell) => {
                        cell.querySelector('span').classList.add('d-none');
                        cell.querySelector('.input-editable').classList.remove('d-none');
                    });
                    button.classList.add('d-none');
                    saveButtons[index].classList.remove('d-none');
                    cancelButtons[index].classList.remove('d-none');
                });
            });

            cancelButtons.forEach((button, index) => {
                button.addEventListener('click', function() {
                    const row = this.closest('tr');
                    row.querySelectorAll('td.editable').forEach((cell) => {
                        cell.querySelector('span').classList.remove('d-none');
                        cell.querySelector('.input-editable').classList.add('d-none');
                    });
                    button.classList.add('d-none');
                    saveButtons[index].classList.add('d-none');
                    editButtons[index].classList.remove('d-none');
                });
            });

        });
    </script>
</body>

</html>
