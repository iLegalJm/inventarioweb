<div>
    <div class="container">
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3 bg-gray-50 dark:bg-gray-800">
                            Producto
                        </th>
                        <th scope="col" class="px-6 py-3 bg-gray-50 dark:bg-gray-800">
                            Cantidad
                        </th>
                        <th scope="col" class="px-6 py-3 bg-gray-50 dark:bg-gray-800">
                            Precio
                        </th>
                        <th scope="col" class="px-6 py-3 bg-gray-50 dark:bg-gray-800">
                            SubTotal
                        </th>
                        <th scope="col" class="px-6 py-3 bg-gray-50 dark:bg-gray-800">
                            Acciones
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cart_items as $item)
                        <tr>
                            <td class="px-6 py-4">
                                {{ $item->rowId }}
                            </td>
                            <td class="px-6 py-4">
                                <input type="number" id="v{{ $item->id }}"
                                    wire:change="update_quantity('{{ $item->rowId }}', $event.target.value)"
                                    value="{{ $item->qty }}">
                            </td>
                            <td class="px-6 py-4">
                                {{ $item->price }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $item->subtotal }}
                            </td>
                            <td>
                                <x-danger-button
                                    wire:click="delete_item('{{ $item->rowId }}')">Eliminar</x-danger-button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td class="px-6 py-4"></td>
                        <td class="px-6 py-4"></td>
                        <td class="px-6 py-4">Total</td>
                        <td class="px-6 py-4">{{ Cart::subtotal() }}</td>
                    </tr>
                </tfoot>
            </table>
        </div>
        <a href="{{ route('productos.checkout') }}"
            class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">Ordenar</a>
    </div>
</div>
