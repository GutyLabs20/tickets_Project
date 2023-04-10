<div class="p-5 h-screen bg-gray-100">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

        <div class="flex space-x-2 justify-between mb-2">
            <h1 class="text-xl">
                <ol class="list-reset flex">
                    <li class="text-gray-500">&nbsp;{{ $title }}</li>
                </ol>
            </h1>
            <div>

                @livewire('utilitarios.estado-create')

            </div>
        </div>

        <div class="overflow-auto rounded-lg shadow hidden md:block">
            @if ($estados->count())
                <table class="w-full">
                    <thead class="bg-gray-50 border-b-2 border-gray-200">
                        <tr>
                            <th class="w-20 p-3 text-sm font-semibold tracking-wide text-left">{{ __('Code') }}</th>
                            <th class="p-3 text-sm font-semibold tracking-wide text-left">{{ __('Status') }}</th>
                            <th class="p-3 text-sm font-semibold tracking-wide text-left">{{ __('Description') }}</th>
                            <th class="p-3 text-sm font-semibold tracking-wide text-left">{{ __('Value') }} {{'%'}}</th>
                            <th class="w-24 p-3 text-sm font-semibold tracking-wide text-left">{{ __('Status') }}</th>
                            <th class="w-24 p-3 text-sm font-semibold tracking-wide text-left">{{ __('Action') }}</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach ($estados as $estado)
                            <tr class="bg-white">
                                <td class="p-3 text-sm text-gray-700 whitespace-nowrap">
                                    <a href="#" class="font-bold text-blue-500 hover:underline">
                                        {{ $estado->id }}
                                    </a>
                                </td>
                                <td class="p-3 text-sm text-gray-700 whitespace-nowrap">
                                    {{ $estado->nombre }}
                                </td>
                                <td class="p-3 text-sm text-gray-700 whitespace-nowrap">
                                    {{ $estado->descripcion }}
                                </td>
                                <td class="p-3 text-sm text-gray-700 whitespace-nowrap">
                                    {{ $estado->valor }}{{'%'}}
                                </td>
                                <td class="p-3 text-sm text-gray-700 whitespace-nowrap">
                                    @if ($estado->activo == 1)
                                        <span
                                            class="p-1.5 text-xs font-medium uppercase tracking-wider text-green-800 bg-green-200 rounded-lg bg-opacity-50">
                                            {{ 'Activo' }}
                                        </span>
                                    @endif
                                    @if ($estado->activo == 0)
                                        <span
                                            class="p-1.5 text-xs font-medium uppercase tracking-wider text-red-800 bg-red-200 rounded-lg bg-opacity-50">
                                            {{ 'Inactivo' }}
                                        </span>
                                    @endif
                                </td>
                                <td class="p-3 text-sm text-gray-700 whitespace-nowrap">
                                    <div class="flex items-center justify-center">
                                        <div class="inline-flex shadow-md hover:shadow-lg focus:shadow-lg" role="group">
                                            {{-- <button type="button"
                                                class="rounded-l inline-block px-4 py-1.5 bg-green-500 text-white font-medium text-xs leading-tight uppercase hover:bg-green-600 focus:bg-green-600 focus:outline-none focus:ring-0 active:bg-green-700 transition duration-150 ease-in-out">
                                                <i class="fas fa-eye"></i>
                                            </button> --}}
                                            <button type="button" wire:click="editar( {{ $estado }} )"
                                                class="rounded-l inline-block px-4 py-1.5 bg-yellow-500 text-white font-medium text-xs leading-tight uppercase hover:bg-yellow-600 focus:bg-yellow-600 focus:outline-none focus:ring-0 active:bg-yellow-700 transition duration-150 ease-in-out">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button type="button" wire:click="saveDelete( {{ $estado }} )"
                                                class="rounded-r inline-block px-4 py-1.5 bg-red-600 text-white font-medium text-xs leading-tight uppercase hover:bg-red-700 focus:bg-red-700 focus:outline-none focus:ring-0 active:bg-red-800 transition duration-150 ease-in-out">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>

                <div class="px-3 py-3">
                    {{$estados->links()}}
                </div>
            @else
                <div class="text-sm text-gray-700 px-3 py-3">
                    {{ __('No Results Found') }}
                </div>
            @endif

        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 md:hidden">
            @if ($estados->count())
                @foreach ($estados as $estado)
                    <div class="bg-white space-y-3 p-4 rounded-lg shadow">
                        <div class="flex justify-between space-x-2 text-sm">
                            <div>
                                <a href="#" class="text-blue-500 font-bold hover:underline">{{ $estado->id }}</a>
                            </div>
                            <div class="text-gray-500">{{ $estado->nombre }}</div>
                            <div class="text-gray-500">{{ $estado->valor }}{{'%'}}</div>
                            <div>
                                @if ($estado->activo == 1)
                                    <span
                                        class="p-1.5 text-xs font-medium uppercase tracking-wider text-green-800 bg-green-200 rounded-lg bg-opacity-50">
                                        {{ 'Activo' }}
                                    </span>
                                @endif
                                @if ($estado->activo == 0)
                                    <span
                                        class="p-1.5 text-xs font-medium uppercase tracking-wider text-red-800 bg-red-200 rounded-lg bg-opacity-50">
                                        {{ 'Inactivo' }}
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="text-sm text-gray-700">
                            {{ $estado->descripcion }}
                        </div>
                        <div class="text-sm font-medium text-black">
                            <div class="flex items-center justify-center">
                                <div class="inline-flex shadow-md hover:shadow-lg focus:shadow-lg" role="group">
                                    {{-- <button type="button"
                                        class="rounded-l inline-block px-4 py-1.5 bg-green-500 text-white font-medium text-xs leading-tight uppercase hover:bg-green-600 focus:bg-green-600 focus:outline-none focus:ring-0 active:bg-green-700 transition duration-150 ease-in-out">
                                        <i class="fas fa-eye"></i>
                                    </button> --}}
                                    <button type="button" wire:click="editar( {{ $estado }} )"
                                        class="rounded-l inline-block px-4 py-1.5 bg-yellow-500 text-white font-medium text-xs leading-tight uppercase hover:bg-yellow-600 focus:bg-yellow-600 focus:outline-none focus:ring-0 active:bg-yellow-700 transition duration-150 ease-in-out">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button type="button" wire:click="saveDelete( {{ $estado }} )"
                                        class="rounded-r inline-block px-4 py-1.5 bg-red-600 text-white font-medium text-xs leading-tight uppercase hover:bg-red-700 focus:bg-red-700 focus:outline-none focus:ring-0 active:bg-red-800 transition duration-150 ease-in-out">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

                <div class="px-3 py-3">
                    {{$estados->links()}}
                </div>
            @else
                <div class="bg-white space-y-3 p-4 rounded-lg shadow">

                    <div class="flex justify-between text-sm text-gray-700">
                        {{ __('No Results Found') }}
                    </div>

                </div>
            @endif

        </div>
    </div>

    <x-jet-dialog-modal wire:model="modal_edit">
        <x-slot name="title">
            {{ __('Edit') }} {{ __('Status') }}
        </x-slot>

        <x-slot name="content">
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="nombre" value="{{ __('Status') }}" />
                <x-jet-input wire:model.defer="estado.nombre" type="text" class="mt-1 block w-full"
                    />
                <x-jet-input-error for="estado.nombre" class="mt-2" />
            </div>
            <div class="col-span-6 sm:col-span-4 mt-4">
                <x-jet-label for="descripcion" value="{{ __('Description') }}" />
                <x-jet-input wire:model.defer="estado.descripcion" type="text" class="mt-1 block w-full"
                    />
                <x-jet-input-error for="estado.descripcion" class="mt-2" />
            </div>
            <div class="col-span-6 sm:col-span-4 mt-4">
                <x-jet-label for="valor" value="{{ __('Value') }}" />
                <x-jet-input wire:model.defer="estado.valor" type="number" class="mt-1 block w-full" maxlenght="3"
                    />
                <x-jet-input-error for="estado.valor" class="mt-2" />
            </div>

        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$set('modal_edit', false)" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-jet-secondary-button>

            <x-jet-danger-button wire:click="actualizar" wire:loading.attr="disabled" class="ml-2">
                {{ __('Save') }}
            </x-jet-danger-button>
        </x-slot>
    </x-jet-dialog-modal>
</div>


