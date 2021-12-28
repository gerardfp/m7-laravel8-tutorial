<!-- Dependiendo de si es Ajax o no, cargamos un layout con head y body o no-->
@extends((Request::ajax()) ? 'layouts.ajax' : 'layouts.app')
@section('content')
<h1>Crear Productos</h1>
<div class="card">
    <div class="card-body">
        <form id="filterForm" method="post" action={{ action('ProductController@save') }} enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="name">Name</label>
                <input id="name" type="text" name="name" value="" class="form-control">
            </div>
            <div class="form-group">
                <label for="price">Precio</label>
                <input id="price" type="text" name="price" value="" class="form-control">
            </div>
            <div class="form-group">
                <label for="desc">Descripcion</label>
                <input id="desc" type="text" name="desc" value="" class="form-control">
            </div>
            <div class="form-group">
                <select class="form-control" id="type" name="type">
                    <option values="frutas">Frutas</option>
                    <option value="verduras">Verduras</option>
                </select>
            </div>
            <div class="form-group">
                <label for="imagen">Imagen</label>
                <input type="file" name="imagen" />
            </div>
            <div class="form-group">
                <input type="submit" value="Guardar" class="btn btn-primary">
            </div>
        </form>
    </div>
</div>
@if(app('request')->has('success'))
@if (session('error'))
<div class="alert alert-danger">
    {{ session('error') }}
</div>
@else
<div class="alert alert-success">
    Producto guardado con exito
</div>
@endif
@endif
@endsection