<!-- Dependiendo de si es Ajax o no, cargamos un layout con head y body o no-->
@extends((Request::ajax()) ? 'layouts.ajax' : 'layouts.app')

@section('content')
<div id="content">
    <h1>Lista de Productos</h1>
    <ul id="productsList" class="list-group">
        @forelse ($productos as $prod)
        <li class="list-group-item">
            <img width="100px" src="{{ ($prod->imagen)?$prod->imagen:asset('img/Imagen-no-disponible.png') }}"> ({{ $prod->type }}) - {{ $prod->price }}€ -{{ $prod->category }}
            <div class="form-group">
                <form method="post" action={{ route('addToChart') }}>
                    {{ csrf_field() }}
                    <input type="hidden" name="productid" value="{{$prod->id}}">
                    <input type="hidden" name="productname" value="{{$prod->name}}">
                    <input type="submit" value="Add product" class="btn btn-primary">
                </form>
            </div>
        </li>
        @empty
        <p>No products</p>
        @endforelse
    </ul>
    <br><br>
</div>

<!--Excluimos el menu en caso de que sea peticion AJAX-->
@if(!Request::ajax())
<div class="card">
    <div class="card-body">
        <h3>Filtrar Productos</h3>
        <form id="filterForm" method="post" action={{ url('/products/') }}>
            {{ csrf_field() }}
            <div class="form-group">
                <label for="priceMin">Precio Min</label>
                <input id="priceMin" type="text" name="priceMin" value="{{ old('priceMin') }}" class="form-control">
            </div>

            <div class="form-group">
                <label for="priceMax">Precio Max</label>
                <input id="priceMax" type="text" name="priceMax" value="{{ old('priceMax') }}" class="form-control">
            </div>
            <div class="form-group">
                <label for="name">Name</label>
                <input id="name" type="text" name="name" value="{{ old('name') }}" class="form-control">
            </div>
            <div class="form-group">
                <label for="name">Type</label>
                <input id="type" type="text" name="type" value="{{ old('type') }}" class="form-control">
            </div>
            <div class="form-check">
                <input type="checkbox" class="form-check-input" id="axios" name="axios" {{ (old('axios'))?'checked':'' }}>
                <label class="form-check-label" for="axios">Filter by Axios</label>
            </div>
            <input type="submit" value="Filter" class="btn btn-primary">
        </form>
    </div>
</div>

<script>
    $('#filterForm').submit(function(e) {
        //Si la opcion de Axios (async) esta activada, realizaremos un submit asincrono con este script
        if ($('#axios').is(':checked')) {
            e.preventDefault()
            //Datos del formulario lo guardamos como json en data
            var data = $("#filterForm").serialize()
            axios.post('products', data)
                .then(response => {
                    console.log(response)
                    //La respuesta obtenida de la petición Ajax la pegamos en nuestra web
                    //substituyendo el content actual (no el menu de filtros)
                    $('#content').replaceWith(response.data)
                })
        }
    })
</script>
@endif
@endsection