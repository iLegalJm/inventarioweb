<div class="container mx-auto my-5">
    <div class="grid 2xl:grid-cols-5 xl:grid-cols-4 lg:grid-cols-3 md:grid-cols-2 grid-cols-1 justify-items-center items-center gap-5 place-content-center">
        @foreach ($detalleproductos as $detalleproducto)
            @php
                $producto = $detalleproducto->producto;
                $productofotos = $producto->productofoto;
            @endphp
            <div
                class="group border-gray-100/30 flex w-full max-w-xs flex-col self-center overflow-hidden rounded-lg border bg-gray-700 shadow-md">
                <a class="relative mx-3 mt-3 flex h-60 overflow-hidden rounded-xl"
                    href="{{ route('productos.show', [$producto]) }}">
                    <img class="peer absolute top-0 right-0 h-full w-full object-cover"
                        src="@if (isset($productofotos[0])) {{ Storage::url($productofotos[0]->url) }}@else https://upload.wikimedia.org/wikipedia/commons/7/75/Falta_imagen.jpg @endif"
                        alt="product image" />
                    <img class="peer peer-hover:right-0 absolute top-0 -right-96 h-full w-full object-cover transition-all delay-100 duration-1000 hover:right-0"
                        src="@if (isset($productofotos[1])) {{ Storage::url($productofotos[1]->url) }} @else https://upload.wikimedia.org/wikipedia/commons/7/75/Falta_imagen.jpg @endif"
                        alt="product image" />
                    <svg class="group-hover:animate-ping group-hover:opacity-30 peer-hover:opacity-0 pointer-events-none absolute inset-x-0 bottom-5 mx-auto text-3xl text-white transition-opacity"
                        xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="img" width="1em"
                        height="1em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 32 32">
                        <path fill="currentColor"
                            d="M2 10a4 4 0 0 1 4-4h20a4 4 0 0 1 4 4v10a4 4 0 0 1-2.328 3.635a2.996 2.996 0 0 0-.55-.756l-8-8A3 3 0 0 0 14 17v7H6a4 4 0 0 1-4-4V10Zm14 19a1 1 0 0 0 1.8.6l2.7-3.6H25a1 1 0 0 0 .707-1.707l-8-8A1 1 0 0 0 16 17v12Z" />
                    </svg>
                    <span
                        class="absolute top-0 left-0 m-2 rounded-full bg-black px-2 text-center text-sm font-medium text-white">39%
                        OFF</span>
                </a>
                <div class="mt-4 px-5 pb-5">
                    <a href="#">
                        @foreach (Cart::content() as $row)
                            <h5 class="text-xl tracking-tight text-white">{{ $row->Producto }}</h5>
                        @endforeach
                    </a>
                    <div class="mt-2 mb-5 flex items-center justify-between">
                        <p>
                            <span class="text-3xl font-bold text-white">S/.{{ $producto->precioventa }}</span>
                            <span class="text-sm text-white line-through">S/.{{ $producto->precioventa * 1.7 }}</span>
                        </p>
                    </div>


                    <button type="button" wire:click="add_to_cart({{ $producto }})"
                        class="w-full hover:border-white/40 flex items-center justify-center rounded-md border border-transparent bg-blue-600 px-5 py-2.5 text-center text-sm font-medium text-white focus:outline-none focus:ring-4 focus:ring-blue-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                        Agregar al carrito</button>
                </div>
            </div>
        @endforeach
    </div>
</div>
