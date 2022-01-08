<x-guest-layout>
    <h1>Lista de Productos</h1>
    <div class="row">
        @forelse ($productos as $prod)
        <div class="col-lg-4 text-center mb-4">
            <img width="140" class="rounded-circle" src="{{ ($prod->imagen)?$prod->imagen:asset('img/Imagen-no-disponible.png') }}">
            <h2>{{ $prod->name }}</h2>
            <p>{{ $prod->desc }}</p>
            <h3>{{ $prod->price }} €</h3>
            <p>{{ $prod->category }}</p>
            <form method="post" action={{ route('addToChart') }}>
                {{ csrf_field() }}
                <input type="hidden" name="productid" value="{{$prod->id}}">
                <input type="hidden" name="productname" value="{{$prod->name}}">
                <input type="submit" value="Add product to shipping »" class="btn btn-secondary">
            </form>
        </div>
        @empty
        <p>No products</p>
        @endforelse
    </div>
    <!--Excluimos el menu en caso de que sea peticion AJAX-->
    @if(!Request::ajax())
    <div class="container">
        <div class="card gx-5">
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
</x-guest-layout>