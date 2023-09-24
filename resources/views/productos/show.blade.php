<x-app-layout>
    <div class="container py-8">

        <div class="max-w-sm w-full lg:max-w-full lg:flex">
            <div
                class="h-48 lg:h-auto flex-none bg-cover rounded-t lg:rounded-t-none lg:rounded-l text-center overflow-hidden">
                <img class="h-48 lg:h-auto flex-none bg-cover rounded-t lg:rounded-t-none lg:rounded-l text-center overflow-hidden"
                    src='{{ Storage::url($producto->productofoto[0]->url) }}' title="{{ $producto->nombre }}">
            </div>

            <div
                class="border-r border-b border-l border-gray-400 lg:border-l-0 lg:border-t lg:border-gray-400 bg-white rounded-b lg:rounded-b-none lg:rounded-r p-4 flex flex-col justify-between leading-normal">
                <div class="mb-8">
                    <p class="text-sm text-gray-600 flex items-center">Código:
                        {{ $producto->codigo }}
                    </p>
                    <div class="text-gray-900 font-bold text-xl mb-2">{{ $producto->nombre }}</div>
                    <p class="text-gray-700 text-base">Marca: {{ $producto->marca }}</p>
                    <p class="text-gray-700 text-base">Modelo: {{ $producto->modelo }}</p>
                    <p class="text-gray-700 text-base">Tamaño: {{ $producto->tamaño }}</p>
                    <p class="text-gray-700 text-base">Stock: {{ $producto->stock }}</p>


                </div>
                <div class="flex items-center">
                    {{-- ! IMAGEN CARRITO --}}
                    {{-- <img class="w-10 h-10 rounded-full mr-4" src="#" alt="Avatar of Jonathan Reinink"> --}}
                    <div class="text-sm">
                        {{-- <p class="text-gray-900 leading-none">Jonathan Reinink</p>
                        <p class="text-gray-600">Aug 18</p> --}}
                        <button
                            class="mt-5 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 border border-blue-700 rounded">
                            Agregar al carrito
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
