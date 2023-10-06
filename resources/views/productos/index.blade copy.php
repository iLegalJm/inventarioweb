<x-app-layout>
    <div class="container py-8">
        <div class="grid sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($productos as $producto)
                <div
                    class="container relative flex w-96 flex-col rounded-xl bg-white bg-clip-border text-gray-700 shadow-md">
                    <a href="{{ route('productos.show', [$producto]) }}">
                        <div
                            class="relative mx-4 mt-4 h-96 overflow-hidden rounded-xl bg-white bg-clip-border text-gray-700">
                            <img src="@if ($producto->productofoto->toArray() != null) {{ Storage::url($producto->productofoto[0]->url) }} @else https://upload.wikimedia.org/wikipedia/commons/7/75/Falta_imagen.jpg @endif"
                                class="h-full w-full object-cover" />
                        </div>
                    </a>
                    <div class="p-6">
                        <div class="mb-2 flex items-center justify-between">
                            <p
                                class="block font-sans text-base font-medium leading-relaxed text-blue-gray-900 antialiased">
                                {{ $producto->nombre }}
                            </p>
                            <p
                                class="block font-sans text-base font-medium leading-relaxed text-blue-gray-900 antialiased">
                                S/.{{ $producto->precioventa }}
                            </p>
                        </div>
                        <p
                            class="block font-sans text-sm font-normal leading-normal text-gray-700 antialiased opacity-75">
                            Marca: {{ $producto->marca . ' Modelo: ' . $producto->modelo }}
                        </p>
                    </div>
                    <div class="p-6 pt-0">
                        <button
                            class="block w-full select-none rounded-lg bg-blue-gray-900/10 py-3 px-6 text-center align-middle font-sans text-xs font-bold uppercase text-blue-gray-900 transition-all hover:scale-105 focus:scale-105 focus:opacity-[0.85] active:scale-100 active:opacity-[0.85] disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                            type="button">
                            Agregar al carrito
                        </button>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
