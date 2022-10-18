<div class="p-5 h-screen bg-gray-100">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        {{-- <h1 class="text-xl mb-2">{{ $title }}</h1> --}}
        {{-- wire:click="crear()" --}}
        <div class="flex space-x-2 justify-between mb-2">
            <h1 class="text-xl mb-2">{{ $title }}</h1>
            <div>
                <button wire:click="crear()" type="button"
                    class="inline-block px-6 py-2.5 bg-green-500 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-green-600 hover:shadow-lg focus:bg-green-600 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-green-700 active:shadow-lg transition duration-150 ease-in-out">
                    {{ __('Add') }} {{ __('New') }}
                </button>
                @if ($modal)
                    @include('livewire.usuarios.tipo-crear')
                @endif
            </div>
        </div>

        <div class="overflow-auto rounded-lg shadow hidden md:block">
            <table class="w-full">
                <thead class="bg-gray-50 border-b-2 border-gray-200">
                    <tr>
                        <th class="w-20 p-3 text-sm font-semibold tracking-wide text-left">{{ __('Code') }}</th>
                        <th class="p-3 text-sm font-semibold tracking-wide text-left">{{ __('Type_User') }}</th>
                        <th class="p-3 text-sm font-semibold tracking-wide text-left">{{ __('Description') }}</th>
                        <th class="w-24 p-3 text-sm font-semibold tracking-wide text-left">{{ __('Status') }}</th>
                        <th class="w-24 p-3 text-sm font-semibold tracking-wide text-left">{{ __('Action') }}</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach ($tipos as $item)
                        <tr class="bg-white">
                            <td class="p-3 text-sm text-gray-700 whitespace-nowrap">
                                <a href="#" class="font-bold text-blue-500 hover:underline">
                                    {{ $item->id }}
                                </a>
                            </td>
                            <td class="p-3 text-sm text-gray-700 whitespace-nowrap">
                                {{ $item->nombre }}
                            </td>
                            <td class="p-3 text-sm text-gray-700 whitespace-nowrap">
                                {{ $item->descripcion }}
                            </td>
                            <td class="p-3 text-sm text-gray-700 whitespace-nowrap">
                                <span
                                    class="p-1.5 text-xs font-medium uppercase tracking-wider rounded-lg bg-opacity-50">
                                    {{ $item->activo == 1 ? 'Habilitado' : 'Deshabilitado' }}
                                </span>
                            </td>
                            <td class="p-3 text-sm text-gray-700 whitespace-nowrap">
                                <div class="flex items-center justify-center">
                                    <div class="inline-flex shadow-md hover:shadow-lg focus:shadow-lg" role="group">
                                        <button type="button"
                                            class="rounded-l inline-block px-4 py-1.5 bg-green-500 text-white font-medium text-xs leading-tight uppercase hover:bg-green-600 focus:bg-green-600 focus:outline-none focus:ring-0 active:bg-green-700 transition duration-150 ease-in-out">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button type="button" wire:click="editar( {{ $item }} )"
                                            class="inline-block px-4 py-1.5 bg-yellow-500 text-white font-medium text-xs leading-tight uppercase hover:bg-yellow-600 focus:bg-yellow-600 focus:outline-none focus:ring-0 active:bg-yellow-700 transition duration-150 ease-in-out">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button type="button"
                                            class="rounded-r inline-block px-4 py-1.5 bg-red-600 text-white font-medium text-xs leading-tight uppercase hover:bg-red-700 focus:bg-red-700 focus:outline-none focus:ring-0 active:bg-red-800 transition duration-150 ease-in-out">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach

                    {{-- <tr class="bg-gray-50">
                        <td class="p-3 text-sm text-gray-700 whitespace-nowrap">
                            <a href="#" class="font-bold text-blue-500 hover:underline">10002</a>
                        </td>
                        <td class="p-3 text-sm text-gray-700 whitespace-nowrap">Kring New Fit office chair, mesh + PU,
                            black</td>
                        <td class="p-3 text-sm text-gray-700 whitespace-nowrap">16/10/2021</td>
                        <td class="p-3 text-sm text-gray-700 whitespace-nowrap">
                            <span
                                class="p-1.5 text-xs font-medium uppercase tracking-wider text-yellow-800 bg-yellow-200 rounded-lg bg-opacity-50">Shipped</span>
                        </td>
                        <td class="p-3 text-sm text-gray-700 whitespace-nowrap">
                            <div class="flex items-center justify-center">
                                <div class="inline-flex shadow-md hover:shadow-lg focus:shadow-lg" role="group">
                                    <button type="button"
                                        class="rounded-l inline-block px-4 py-1.5 bg-green-500 text-white font-medium text-xs leading-tight uppercase hover:bg-green-600 focus:bg-green-600 focus:outline-none focus:ring-0 active:bg-green-700 transition duration-150 ease-in-out">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button type="button"
                                        class="inline-block px-4 py-1.5 bg-yellow-500 text-white font-medium text-xs leading-tight uppercase hover:bg-yellow-600 focus:bg-yellow-600 focus:outline-none focus:ring-0 active:bg-yellow-700 transition duration-150 ease-in-out">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button type="button"
                                        class="rounded-r inline-block px-4 py-1.5 bg-red-600 text-white font-medium text-xs leading-tight uppercase hover:bg-red-700 focus:bg-red-700 focus:outline-none focus:ring-0 active:bg-red-800 transition duration-150 ease-in-out">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr class="bg-white">
                        <td class="p-3 text-sm text-gray-700 whitespace-nowrap">
                            <a href="#" class="font-bold text-blue-500 hover:underline">10002</a>
                        </td>
                        <td class="p-3 text-sm text-gray-700 whitespace-nowrap">Kring New Fit office chair, mesh + PU,
                            black</td>
                        <td class="p-3 text-sm text-gray-700 whitespace-nowrap">16/10/2021</td>
                        <td class="p-3 text-sm text-gray-700 whitespace-nowrap">
                            <span
                                class="p-1.5 text-xs font-medium uppercase tracking-wider text-gray-800 bg-gray-200 rounded-lg bg-opacity-50">Cancelled</span>
                        </td>
                        <td class="p-3 text-sm text-gray-700 whitespace-nowrap">
                            <div class="flex items-center justify-center">
                                <div class="inline-flex shadow-md hover:shadow-lg focus:shadow-lg" role="group">
                                    <button type="button"
                                        class="rounded-l inline-block px-4 py-1.5 bg-green-500 text-white font-medium text-xs leading-tight uppercase hover:bg-green-600 focus:bg-green-600 focus:outline-none focus:ring-0 active:bg-green-700 transition duration-150 ease-in-out">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button type="button"
                                        class="inline-block px-4 py-1.5 bg-yellow-500 text-white font-medium text-xs leading-tight uppercase hover:bg-yellow-600 focus:bg-yellow-600 focus:outline-none focus:ring-0 active:bg-yellow-700 transition duration-150 ease-in-out">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button type="button"
                                        class="rounded-r inline-block px-4 py-1.5 bg-red-600 text-white font-medium text-xs leading-tight uppercase hover:bg-red-700 focus:bg-red-700 focus:outline-none focus:ring-0 active:bg-red-800 transition duration-150 ease-in-out">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </div>
                            </div>
                        </td>
                    </tr> --}}
                </tbody>
            </table>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 md:hidden">
            @foreach ($tipos as $item)
                <div class="bg-white space-y-3 p-4 rounded-lg shadow">
                    <div class="flex justify-between space-x-2 text-sm">
                        <div>
                            <a href="#" class="text-blue-500 font-bold hover:underline">{{ $item->id }}</a>
                        </div>
                        <div class="text-gray-500">{{ $item->nombre }}</div>
                        <div>
                            <span
                                class="p-1.5 text-xs font-medium uppercase tracking-wider text-green-800 bg-green-200 rounded-lg bg-opacity-50">
                                {{ $item->activo == 1 ? 'Habilitado' : 'Deshabilitado' }}
                            </span>
                        </div>
                    </div>
                    <div class="text-sm text-gray-700">
                        {{ $item->descripcion }}
                    </div>
                    <div class="text-sm font-medium text-black">
                        <div class="flex items-center justify-center">
                            <div class="inline-flex shadow-md hover:shadow-lg focus:shadow-lg" role="group">
                                <button type="button"
                                    class="rounded-l inline-block px-4 py-1.5 bg-green-500 text-white font-medium text-xs leading-tight uppercase hover:bg-green-600 focus:bg-green-600 focus:outline-none focus:ring-0 active:bg-green-700 transition duration-150 ease-in-out">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button type="button" wire:click="editar( {{ $item }} )"
                                    class="inline-block px-4 py-1.5 bg-yellow-500 text-white font-medium text-xs leading-tight uppercase hover:bg-yellow-600 focus:bg-yellow-600 focus:outline-none focus:ring-0 active:bg-yellow-700 transition duration-150 ease-in-out">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button type="button"
                                    class="rounded-r inline-block px-4 py-1.5 bg-red-600 text-white font-medium text-xs leading-tight uppercase hover:bg-red-700 focus:bg-red-700 focus:outline-none focus:ring-0 active:bg-red-800 transition duration-150 ease-in-out">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            {{-- <div class="bg-white space-y-3 p-4 rounded-lg shadow">
                <div class="flex items-center space-x-2 text-sm">
                    <div>
                        <a href="#" class="text-blue-500 font-bold hover:underline">#1001</a>
                    </div>
                    <div class="text-gray-500">10/10/2021</div>
                    <div>
                        <span
                            class="p-1.5 text-xs font-medium uppercase tracking-wider text-yellow-800 bg-yellow-200 rounded-lg bg-opacity-50">Shipped</span>
                    </div>
                </div>
                <div class="text-sm text-gray-700">
                    Kring New Fit office chair, mesh + PU, black
                </div>
                <div class="text-sm font-medium text-black">
                    <div class="flex items-center justify-center">
                        <div class="inline-flex shadow-md hover:shadow-lg focus:shadow-lg" role="group">
                            <button type="button"
                                class="rounded-l inline-block px-4 py-1.5 bg-green-500 text-white font-medium text-xs leading-tight uppercase hover:bg-green-600 focus:bg-green-600 focus:outline-none focus:ring-0 active:bg-green-700 transition duration-150 ease-in-out">
                                <i class="fas fa-eye"></i>
                            </button>
                            <button type="button"
                                class="inline-block px-4 py-1.5 bg-yellow-500 text-white font-medium text-xs leading-tight uppercase hover:bg-yellow-600 focus:bg-yellow-600 focus:outline-none focus:ring-0 active:bg-yellow-700 transition duration-150 ease-in-out">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button type="button"
                                class="rounded-r inline-block px-4 py-1.5 bg-red-600 text-white font-medium text-xs leading-tight uppercase hover:bg-red-700 focus:bg-red-700 focus:outline-none focus:ring-0 active:bg-red-800 transition duration-150 ease-in-out">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-white space-y-3 p-4 rounded-lg shadow">
                <div class="flex items-center space-x-2 text-sm">
                    <div>
                        <a href="#" class="text-blue-500 font-bold hover:underline">#1002</a>
                    </div>
                    <div class="text-gray-500">10/10/2021</div>
                    <div>
                        <span
                            class="p-1.5 text-xs font-medium uppercase tracking-wider text-gray-800 bg-gray-200 rounded-lg bg-opacity-50">Canceled</span>
                    </div>
                </div>
                <div class="text-sm text-gray-700">
                    Kring New Fit office chair, mesh + PU, black
                </div>
                <div class="text-sm font-medium text-black">
                    <div class="flex items-center justify-center">
                        <div class="inline-flex shadow-md hover:shadow-lg focus:shadow-lg" role="group">
                            <button type="button"
                                class="rounded-l inline-block px-4 py-1.5 bg-green-500 text-white font-medium text-xs leading-tight uppercase hover:bg-green-600 focus:bg-green-600 focus:outline-none focus:ring-0 active:bg-green-700 transition duration-150 ease-in-out">
                                <i class="fas fa-eye"></i>
                            </button>
                            <button type="button"
                                class="inline-block px-4 py-1.5 bg-yellow-500 text-white font-medium text-xs leading-tight uppercase hover:bg-yellow-600 focus:bg-yellow-600 focus:outline-none focus:ring-0 active:bg-yellow-700 transition duration-150 ease-in-out">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button type="button"
                                class="rounded-r inline-block px-4 py-1.5 bg-red-600 text-white font-medium text-xs leading-tight uppercase hover:bg-red-700 focus:bg-red-700 focus:outline-none focus:ring-0 active:bg-red-800 transition duration-150 ease-in-out">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div> --}}
        </div>
    </div>

    <x-jet-dialog-modal wire:model="modal_edit">
        <x-slot name="title">
            {{ 'Editar tipo de usuario' }}
            {{-- {{ isset($this->tipo->id) ? 'Editar tipo de usuario' : 'Crear tipo de usuario' }} --}}
        </x-slot>

        <x-slot name="content">
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="nombre" value="{{ __('Type_User') }}" />
                <x-jet-input wire:model="tipo.nombre" type="text" class="mt-1 block w-full"
                    />
                <x-jet-input-error for="tipo.nombre" class="mt-2" />
            </div>
            <div class="col-span-6 sm:col-span-4 mt-4">
                <x-jet-label for="descripcion" value="{{ __('Description') }}" />
                <x-jet-input wire:model="tipo.descripcion" type="text" class="mt-1 block w-full"
                    />
                <x-jet-input-error for="tipo.descripcion" class="mt-2" />
            </div>

        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$set('modal_edit', false)" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-jet-secondary-button>

            <x-jet-danger-button class="ml-2">
                {{ __('Save') }}
            </x-jet-danger-button>
        </x-slot>
    </x-jet-dialog-modal>
</div>


