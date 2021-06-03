@extends('layouts.app')

@section('content')
    <div class="card uper">
        <div class="card-header">
            <h4>Añadir artículo</h4>
        </div>
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            <button type="button" class="close" data-dismiss="alert"
                                    aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        @endforeach
                    </ul>
                </div><br/>
            @endif
            <form method="post" enctype="multipart/form-data" action="{{ route('articulos.store') }}">
                @csrf
                <div class="form-group">
                    <label for="nombre">Nombre del artículo:</label>
                    <input type="text" class="form-control" name="nombre"/>
                </div>
                <div class="form-group">
                    <label for="imagen">Imagen del artículo:</label>
                    <input type="file" class="form-control" name="imagen">
                </div>
                <div class="form-group">
                    <label for="descripcion">Descripción del artículo:</label>
                    <input type="text" class="form-control" name="descripcion"/>
                </div>
                <div class="form-group">
                    <label for="precio">Precio del artículo:</label>
                    <input type="text" class="form-control" name="precio"/>
                </div>
                <div class="form-group">
                    <label for="cantidad">Cantidad en inventario:</label>
                    <input type="text" class="form-control" name="cantidad"/>
                </div>
                <button type="submit" class="btn btn-primary">Añadir</button>
                <a href="{{ route('articulos.index') }}" class="btn btn-outline-primary">Regresar</a>
            </form>
        </div>
    </div>
@endsection
