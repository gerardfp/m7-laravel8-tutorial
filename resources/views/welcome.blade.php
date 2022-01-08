<x-guest-layout>
    <div class="content">
        <div class="title m-b-md">
            Laravel Demo
        </div>

        <div class="links">
            <a href={{ route('productList') }}>Products Filter</a>
            <a href="{{ url('/products/?axios=true') }}">Fiter Axios</a>
            <a href="{{ url('/products/new') }}">New Product</a>
        </div>
    </div>
</x-guest-layout>