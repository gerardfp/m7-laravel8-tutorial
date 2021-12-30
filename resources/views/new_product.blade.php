<x-app-layout>
<h1>Crear Productos</h1>
<div class="card">
    <div class="card-body">
        <form id="filterForm" method="post" action={{ route('saveProduct') }} enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="name">Name</label>
                <input id="name" type="text" name="name" value="" class="form-control">
                @error('name')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="price">Precio</label>
                <input id="price" type="number" name="price" value="" class="form-control">
                @error('price')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="desc">Descripcion</label>
                <input id="desc" type="text" name="desc" value="" class="form-control">
            </div>
            <div class="form-group">
                <label for="desc">Categoria</label>
                <select class="form-control" id="category" name="category">
                @foreach ($categories as $cat)
                    <option value="{{$cat->id}}">{{$cat->name}}</option>
                @endforeach
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
</x-app-layout>