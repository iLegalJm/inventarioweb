<x-app-layout>
    <div class="container py-8">
        <div class="grid grid-cols-2 justify-items-center gap-4">
            @foreach ($almacenes as $almacen)
                <a href="{{ route('admin.almacen', [$almacen]) }}">
                    <div class="max-w-sm rounded overflow-hidden shadow-lg">
                        <img class="w-full"
                            src="https://media.istockphoto.com/id/1304746031/es/foto/tomar-un-mejor-control-con-la-tecnolog%C3%ADa.jpg?s=612x612&w=0&k=20&c=2YvlQEBXoVnXg3r2B8SxVdbkidP5y_-USXt7eDkDRmU="
                            alt="Sunset in the mountains">
                        <div class="px-6 py-4">
                            <div class="font-bold text-xl mb-2">{{ $almacen->nombre }}</div>
                            <p class="text-gray-700 text-base">
                                Ubicacion exacta
                            </p>
                        </div>
                        <div class="px-6 pt-4 pb-2">
                            <span
                                class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">Relllenar</span>
                            <span
                                class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">Rellenar</span>
                            <span
                                class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">Rellenar</span>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</x-app-layout>
