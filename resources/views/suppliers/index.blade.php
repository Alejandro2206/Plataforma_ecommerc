@extends('adminlte::page')

@section('title', 'Proveedores')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1>Lista de Proveedores</h1>
        <a href="{{ route('suppliers.create') }}" class="btn btn-success">
            <i class="fas fa-plus"></i> Nuevo Proveedor
        </a>
    </div>
@stop

@section('content')
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card">
        <div class="card-header">
            <div class="card-tools">
                <form action="{{ route('suppliers.index') }}" method="get" class="input-group input-group-sm">
                    <input type="text" name="search" class="form-control" placeholder="Buscar por nombre">
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                    </div>
                </form>
            </div>
        </div>
        <!-- /.card-header -->

        <div class="card-body table-responsive">
            @if($suppliers->count() > 0)
                <table class="table table-bordered table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th>No°</th>
                            <th>Logo</th>
                            <th>Empresa</th>
                            <th>Número</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $i = ($suppliers->currentPage() - 1) * $suppliers->perPage(); @endphp
                        @foreach ($suppliers as $supplier)
                            <tr>
                                <td>{{ str_pad(++$i, 2, '0', STR_PAD_LEFT) }}</td>
                                <td><img src="{{ asset('assets/imgs/companys')}}/{{$supplier->image}}"
                                        alt="{{$supplier->company}}" width="60" /></td>

                                        <td><a href="{{ route('suppliers.show', ['supplier' => $supplier->id]) }}">
                                            {{ $supplier->company }}
                                        </a></td>
                                <td><span class="phone-number">{{ $supplier->number }}</span></td>
                                <td>
                                    <a href="{{ route('suppliers.edit', ['supplier' => $supplier->id]) }}"
                                        class="btn btn-primary btn-sm">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                            data-target="#confirmDelete{{ $supplier->id }}">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p class="text-left mt-3 alert alert-warning">No hay coincidencias.</p>
            @endif
        </div>
        <!-- /.card-body -->

        <div class="pagination justify-content-end">
            {{ $suppliers->appends(request()->query())->links('vendor.pagination.bootstrap-4') }}
        </div>
    </div>

    <!-- Modal de confirmación para eliminar -->
    @foreach ($suppliers as $supplier)
        <div class="modal fade" id="confirmDelete{{ $supplier->id }}" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalLabel">Confirmar eliminación</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        ¿Estás seguro de eliminar el proveedor "{{ $supplier->company }}"?
                    </div>
                    <div class="modal-footer">
                        <form action="{{ route('suppliers.destroy', ['supplier' => $supplier->id]) }}" method="post">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger">Eliminar</button>
                        </form>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    <!-- Fin del modal -->
@stop

@section('css')
@stop

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.6/jquery.inputmask.min.js"></script>
    <script>
        $(document).ready(function () {
            $('.phone-number').inputmask('(999) 999-9999');
        });
    </script>
@stop
