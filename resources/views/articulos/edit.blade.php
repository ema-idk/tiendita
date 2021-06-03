@extends('layouts.app')

@section('content')
    <div class="card uper">
        <div class="card-header">
            <h4>Editar artículo</h4>
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
            <form method="post" enctype="multipart/form-data" action="{{ route('articulos.update', $articulo->id) }}">
                @csrf
                {{ method_field('PUT') }}
                <div class="form-group">
                    <label for="nombre">Nombre del artículo:</label>
                    <input type="text" name="nombre" value="{{ $articulo->nombre }}" class="form-control" placeholder="Ejemplo: Xiaomi Redmi Note 9">
                </div>
                <div class="form-group">
                    <label for="imagen">Imagen del artículo:</label>
                    <input type="file" class="form-control" name="imagen">
                    <img src="/imagen/{{ $articulo->imagen }}" width="100px">
                </div>
                <div class="form-group">
                    <label for="descripcion">Descripción del artículo:</label>
                    <textarea class="form-control" style="height:150px" name="descripcion" placeholder="Escriba una descripción...">{{ $articulo->descripcion }}</textarea>
                </div>
                <div class="form-group">
                    <label for="precio">Precio del artículo:</label>
                    <input type="text" name="precio" value="{{ $articulo->precio }}" class="form-control" placeholder="Ejemplo: 199.99">
                </div>
                <div class="form-group">
                    <label for="cantidad">Cantidad en inventario:</label>
                    <input type="text" name="cantidad" value="{{ $articulo->cantidad }}" class="form-control" placeholder="Ejemplo: 10">
                </div>
                <button type="submit" class="btn btn-primary">Actualizar</button>
                <a href="{{ route('articulos.index') }}" class="btn btn-outline-primary">Regresar</a>
            </form>
        </div>
    </div>
@endsection
