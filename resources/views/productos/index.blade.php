<x-app-layout>
    <div class="container py-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($productos as $producto)
                <article class="w-full h-80 bg-cover bg-center"
                    style="background: url(@if ($producto->productofoto->toArray() != null) {{ Storage::url($producto->productofoto[0]->url) }} @else https://upload.wikimedia.org/wikipedia/commons/7/75/Falta_imagen.jpg @endif);">
                    <h1 class="text-4xl text-white leading-8 font-bold">
                        {{ $producto->nombre }}
                    </h1>
                    <a href="{{ route('productos.show', [$producto]) }}">
                        <button
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 border border-blue-700 rounded">
                            Ver Producto
                        </button>
                    </a>
                </article>
            @endforeach
        </div>
    </div>
</x-app-layout>
