<div>
    <a href="{{ route('productos.carrito') }}">
        <div class="absolute text-xs rounded-full -mt-1 -mr-2 px-1 font-bold top-0 right-0 bg-red-700 text-white">
            {{ Cart::count() }}</div>
    </a>
</div>
