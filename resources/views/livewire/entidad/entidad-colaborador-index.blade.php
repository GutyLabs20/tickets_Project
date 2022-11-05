<div class="p-5 h-screen bg-gray-100">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

        <div class="flex space-x-2 justify-between mb-2">
            <h1 class="text-xl">
                <ol class="list-reset flex">
                    <li><a href="{{ route('cliente.empresas') }}" class="font-bold text-blue-500">{{ __('Company') }}</a>&nbsp;</li>
                    <li><span class="text-gray-500 mx-2">/</span></li>
                    <li class="text-gray-500">&nbsp;{{ $title }}</li>
                </ol>
            </h1>
            <x-jet-input wire:model.debounce.500ms="q" type="search" class="w-1/2 m-0 text-sm"
                placeholder="{{ __('Search') }} {{ __('Employees') }}" />

            <div>

                @livewire('entidad.entidad-colaborador-create')

            </div>
        </div>

        <div class="overflow-auto rounded-lg shadow hidden md:block">
            @if ($colaboradores->count())
                <table class="w-full">
                    <thead class="bg-gray-50 border-b-2 border-gray-200">
                        <tr>
                            <th class="p-3 text-sm font-semibold tracking-wide text-left">{{ __('#') }}</th>
                            <th class="p-3 text-sm font-semibold tracking-wide text-left">{{ __('Employee') }}</th>
                            <th class="p-3 text-sm font-semibold tracking-wide text-left">{{ __('E-Mail') }}</th>
                            <th class="p-3 text-sm font-semibold tracking-wide text-left">{{ __('Phone') }}</th>
                            <th class="p-3 text-sm font-semibold tracking-wide text-left">{{ __('Area') }}</th>
                            <th class="p-3 text-sm font-semibold tracking-wide text-left">{{ __('Position') }}</th>
                            <th class="w-24 p-3 text-sm font-semibold tracking-wide text-center">{{ __('Action') }}</th>
                            <th class="w-24 p-3 text-sm font-semibold tracking-wide text-left">{{ __('Status') }}</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach ($colaboradores as $colaborador)
                            <tr class="bg-white">
                                <td class="p-3 text-sm text-gray-700 whitespace-nowrap">
                                    <a href="#" class="font-bold text-blue-500 hover:underline">
                                        {{ $colaborador->id }}
                                    </a>
                                </td>
                                <td class="p-3 text-sm text-gray-700 whitespace-nowrap">
                                    {{ $colaborador->nombres }} {{ $colaborador->apellidos }}
                                </td>
                                <td class="p-3 text-sm text-gray-700 whitespace-nowrap">
                                    {{ $colaborador->email }}
                                </td>
                                <td class="p-3 text-sm text-gray-700 whitespace-nowrap">
                                    {{ $colaborador->telefono }}
                                </td>
                                <td class="p-3 text-sm text-gray-700 whitespace-nowrap">
                                    {{ $colaborador->colaborador_area->nombre }}
                                </td>
                                <td class="p-3 text-sm text-gray-700 whitespace-nowrap">
                                    @if ($colaborador->puesto == NULL)
                                        {{ '-' }}
                                    @else
                                        {{ $colaborador->puesto }}
                                    @endif
                                </td>

                                {{-- <td class="p-3 text-sm text-gray-700 whitespace-nowrap">
                                    <span
                                        class="p-1.5 text-xs font-medium uppercase tracking-wider text-green-800 bg-green-200 rounded-lg bg-opacity-50">
                                        {{ $colaborador->activo == 1 ? 'Activo' : 'Inactivo' }}
                                    </span>
                                </td> --}}
                                <td class="p-3 text-sm text-gray-700 whitespace-nowrap">
                                    <div class="flex items-center justify-center">
                                        <div class="inline-flex shadow-md hover:shadow-lg focus:shadow-lg"
                                            role="group">
                                            <button type="button"
                                                class="rounded-l inline-block px-4 py-1.5 bg-green-500 text-white font-medium text-xs leading-tight uppercase hover:bg-green-600 focus:bg-green-600 focus:outline-none focus:ring-0 active:bg-green-700 transition duration-150 ease-in-out">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <button type="button" wire:click="editar( {{ $colaborador }} )"
                                                class="rounded-r inline-block px-4 py-1.5 bg-yellow-500 text-white font-medium text-xs leading-tight uppercase hover:bg-yellow-600 focus:bg-yellow-600 focus:outline-none focus:ring-0 active:bg-yellow-700 transition duration-150 ease-in-out">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            {{-- <button type="button" wire:click="saveDelete( {{ $colaborador }} )"
                                                class="rounded-r inline-block px-4 py-1.5 bg-red-600 text-white font-medium text-xs leading-tight uppercase hover:bg-red-700 focus:bg-red-700 focus:outline-none focus:ring-0 active:bg-red-800 transition duration-150 ease-in-out">
                                                <i class="fas fa-trash-alt"></i>
                                            </button> --}}
                                        </div>
                                    </div>
                                </td>
                                <td class="p-3 text-sm text-gray-700 whitespace-nowrap">
                                    <div class="flex items-center justify-center">
                                        @livewire('entidad.toggle-button', [
                                            'model' => $colaborador,
                                            'field' => 'activo'
                                        ])
                                    </div>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>

                <div class="px-3 py-3">
                    {{ $colaboradores->links() }}
                </div>
            @else
                <div class="text-sm text-gray-700 px-3 py-3">
                    {{ __('No Results Found') }}
                </div>
            @endif

        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 md:hidden">
            @if ($colaboradores->count())
                @foreach ($colaboradores as $colaborador)
                    <div class="bg-white space-y-3 p-4 rounded-lg shadow">
                        <div class="flex justify-between space-x-2 text-sm">
                            <div>
                                <a href="#"
                                    class="text-blue-500 font-bold hover:underline">
                                    {{-- {{ $colaborador->id }} --}}
                                    <i class="fas fa-user"></i>
                                </a>
                            </div>
                            <div class="text-gray-500 font-bold">{{ $colaborador->nombres }} {{ $colaborador->apellidos }}</div>
                            <div>
                                <span
                                    class="p-1.5 text-xs font-medium uppercase tracking-wider text-green-800 bg-green-200 rounded-lg bg-opacity-50">
                                    {{ $colaborador->activo == 1 ? 'Activo' : 'Inactivo' }}
                                </span>
                            </div>
                        </div>
                        <div class="text-sm text-gray-700">
                            <i class="fas fa-at"></i>&nbsp; {{ $colaborador->email }}
                        </div>
                        <div class="text-sm text-gray-700">
                            <i class="fas fa-phone-square-alt"></i>&nbsp; {{ $colaborador->telefono }}
                        </div>
                        <div class="text-sm text-gray-700">
                            <i class="fas fa-sitemap"></i>&nbsp; {{ $colaborador->colaborador_area->nombre }}
                        </div>

                        <div class="text-sm font-medium text-black">
                            <div class="flex items-center justify-center">
                                <div class="inline-flex shadow-md hover:shadow-lg focus:shadow-lg" role="group">
                                    <button type="button"
                                        class="rounded-l inline-block px-4 py-1.5 bg-green-500 text-white font-medium text-xs leading-tight uppercase hover:bg-green-600 focus:bg-green-600 focus:outline-none focus:ring-0 active:bg-green-700 transition duration-150 ease-in-out">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button type="button" wire:click="editar( {{ $colaborador }} )"
                                        class="inline-block px-4 py-1.5 bg-yellow-500 text-white font-medium text-xs leading-tight uppercase hover:bg-yellow-600 focus:bg-yellow-600 focus:outline-none focus:ring-0 active:bg-yellow-700 transition duration-150 ease-in-out">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button type="button" wire:click="saveDelete( {{ $colaborador }} )"
                                        class="rounded-r inline-block px-4 py-1.5 bg-red-600 text-white font-medium text-xs leading-tight uppercase hover:bg-red-700 focus:bg-red-700 focus:outline-none focus:ring-0 active:bg-red-800 transition duration-150 ease-in-out">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

                @if ($colaboradores->hasPages())
                    <div class="px-3 py-3">
                        {{ $colaboradores->links() }}
                    </div>
                @endif
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
            {{ __('Edit') }} {{ __('Employee') }}
        </x-slot>

        <x-slot name="content">

            <div class="col-span-6 sm:col-span-4 mt-4">
                <x-jet-label for="nombres" value="{{ __('FirstName') }}" />
                <x-jet-input wire:model.defer="colaborador.nombres" type="text" class="mt-1 block w-full" />
                <x-jet-input-error for="colaborador.nombres" class="mt-2" />
            </div>
            <div class="col-span-6 sm:col-span-4 mt-4">
                <x-jet-label for="apellidos" value="{{ __('LastName') }}" />
                <x-jet-input wire:model.defer="colaborador.apellidos" type="text" class="mt-1 block w-full" />
                <x-jet-input-error for="colaborador.apellidos" class="mt-2" />
            </div>
            <div class="col-span-6 sm:col-span-4 mt-4">
                <x-jet-label for="email" value="{{ __('E-Mail') }}" />
                <x-jet-input wire:model.defer="colaborador.email" type="text" class="mt-1 block w-full" />
                <x-jet-input-error for="colaborador.email" class="mt-2" />
            </div>
            <div class="col-span-6 sm:col-span-4 mt-4">
                <x-jet-label for="telefono" value="{{ __('Phone') }}" />
                <x-jet-input wire:model.defer="colaborador.telefono" type="text" class="mt-1 block w-full" />
                <x-jet-input-error for="colaborador.telefono" class="mt-2" />
            </div>
            <div class="col-span-6 sm:col-span-4 mt-4">
                <x-jet-label for="area_id" value="{{ __('Area') }}" />
                <select wire:model="colaborador.area_id" name="area_id" id="area_id"
                    class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full">
                    <option value="" selected>Seleccione</option>
                    @foreach ($areas as $key => $nombre)
                        <option value="{{ $key }}">{{ $nombre }}</option>
                    @endforeach
                </select>
                <x-jet-input-error for="tipousuario_id" class="mt-2" />
            </div>
            <div class="col-span-6 sm:col-span-4 mt-4">
                <x-jet-label for="puesto" value="{{ __('Position') }} ({{ __('optional') }})" />
                <select wire:model="colaborador.puesto" name="puesto" id="puesto"
                    class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full">
                    <option value="" selected>Seleccione</option>
                    @foreach ($cargos as $key => $nombre)
                        <option value="{{ $nombre }}">{{ $nombre }}</option>
                    @endforeach
                </select>
                <x-jet-input-error for="colaborador.puesto" class="mt-2" />
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
