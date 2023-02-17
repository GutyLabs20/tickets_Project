<div class="p-5 h-screen bg-gray-100">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

        <div class="overflow-auto rounded-lg shadow hidden md:block">
            <div class="flex space-x-2 justify-between ml-2 mr-2 mt-2 mb-2">
                {{-- <h1 class="text-xl mb-2">{{ $title }}</h1> --}}
                <h1 class="text-xl">
                    <ol class="list-reset flex">
                        <li class="text-gray-500">&nbsp;{{ $title }}</li>
                    </ol>
                </h1>

                <x-jet-input wire:model.debounce.500ms="q" type="search" class="w-1/2 m-0 text-sm" placeholder="{{ __('Search') }} {{ __('Company') }}" />

                <div>

                    @livewire('entidad.entidad-create')

                </div>
            </div>

        {{-- <div class="overflow-auto rounded-lg shadow hidden md:block"> --}}
            @if ($entidades->count())
                <table class="w-full">
                    <thead class="bg-gray-50 border-b-2 border-gray-200">
                        <tr>
                            <th class="p-3 text-sm font-semibold tracking-wide text-left">{{ __('Code') }}</th>
                            <th class="p-3 text-sm font-semibold tracking-wide text-left">{{ __('Tipo Doc.') }}</th>
                            <th class="p-3 text-sm font-semibold tracking-wide text-left">{{ __('Nro. Doc') }}</th>
                            <th class="p-3 text-sm font-semibold tracking-wide text-left">{{ __('Company') }}</th>
                            <th class="p-3 text-sm font-semibold tracking-wide text-left">{{ __('Phone') }}</th>
                            <th class="p-3 text-sm font-semibold tracking-wide text-left">{{ __('E-Mail') }}</th>
                            <th class="p-3 text-sm font-semibold tracking-wide text-center">{{ __('Structure') }}</th>
                            <th class="p-3 text-sm font-semibold tracking-wide text-center">{{ __('Status') }}</th>
                            <th class="w-24 p-3 text-sm font-semibold tracking-wide text-center">{{ __('Action') }}</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach ($entidades as $entidad)
                            <tr class="bg-white">
                                <td class="p-3 text-sm text-gray-700 whitespace-nowrap">
                                    <a href="#" class="font-bold text-blue-500 hover:underline">
                                        {{ $entidad->id }}
                                    </a>
                                </td>
                                <td class="p-3 text-sm text-gray-700 whitespace-nowrap font-bold">
                                    {{ $entidad->tipo_doc }}
                                </td>
                                <td class="p-3 text-sm text-gray-700 whitespace-nowrap font-bold">
                                    {{ $entidad->nro_doc }}
                                </td>
                                <td class="p-3 text-sm text-gray-700 whitespace-nowrap">
                                    {{ $entidad->nombre }}
                                </td>
                                <td class="p-3 text-sm text-gray-700 whitespace-nowrap">
                                    {{ $entidad->telefono }}
                                </td>
                                <td class="p-3 text-sm text-gray-700 whitespace-nowrap">
                                    {{ $entidad->email }}
                                </td>
                                <td class="p-3 text-sm text-gray-700 whitespace-nowrap">
                                    <div class="flex items-center justify-center">
                                        <div class="inline-flex shadow-md hover:shadow-lg focus:shadow-lg" role="group">
                                            <a  href="{{ route('cliente.colaboradores_entidad', ['id' => $entidad->nro_doc]) }}" title="{{__('Employees')}}"
                                                class="rounded inline-block px-4 py-1.5 bg-cyan-600 text-white font-medium text-xs leading-tight uppercase hover:bg-cyan-700 focus:bg-cyan-700 focus:outline-none focus:ring-0 active:bg-cyan-800 transition duration-150 ease-in-out">
                                                <i class="fas fa-users"></i>
                                            </a>
                                        </div>
                                    </div>
                                </td>
                                <td class="p-3 text-sm text-gray-700 whitespace-nowrap">
                                    <div class="flex items-center justify-center">
                                        <div class="inline-flex focus:shadow-lg">
                                            @if ($entidad->activo == 1)
                                                <span
                                                    class="toggle-checkbox p-1.5 text-xs font-medium uppercase tracking-wider text-green-800 bg-green-200 rounded-lg bg-opacity-50">
                                                    {{ 'Activo' }}
                                                </span>
                                            @else
                                                <span
                                                    class="toggle-checkbox p-1.5 text-xs font-medium uppercase tracking-wider text-red-800 bg-red-200 rounded-lg bg-opacity-50">
                                                    {{ 'Inactivo' }}
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td class="p-3 text-sm text-gray-700 whitespace-nowrap">
                                    <div class="flex items-center justify-center">
                                        <div class="inline-flex shadow-md hover:shadow-lg focus:shadow-lg"
                                            role="group">

                                            @if ($entidad->activo == 1)
                                                <button type="button" title="{{ __('Show') }}"
                                                    class="rounded-l inline-block px-4 py-1.5 bg-green-500 text-white font-medium text-xs leading-tight uppercase hover:bg-green-600 focus:bg-green-600 focus:outline-none focus:ring-0 active:bg-green-700 transition duration-150 ease-in-out">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                                <button type="button" wire:click="editar( {{ $entidad }} )" title="{{ __('Edit') }}"
                                                    class="inline-block px-4 py-1.5 bg-yellow-500 text-white font-medium text-xs leading-tight uppercase hover:bg-yellow-600 focus:bg-yellow-600 focus:outline-none focus:ring-0 active:bg-yellow-700 transition duration-150 ease-in-out">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <button type="button" wire:click="delete( {{ $entidad }} )" title="{{ __('Delete') }}"
                                                    class="rounded-r inline-block px-4 py-1.5 bg-red-600 text-white font-medium text-xs leading-tight uppercase hover:bg-red-700 focus:bg-red-700 focus:outline-none focus:ring-0 active:bg-red-800 transition duration-150 ease-in-out">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            @endif
                                            @if ($entidad->activo == 0)
                                                <button type="button" wire:click="enable( {{ $entidad }} )" title="{{ __('Enable') }}"
                                                    class="rounded-l rounded-r inline-block px-4 py-1.5 bg-orange-600 text-white font-medium text-xs leading-tight uppercase hover:bg-orange-700 focus:bg-orange-700 focus:outline-none focus:ring-0 active:bg-orange-800 transition duration-150 ease-in-out">
                                                    <i class="fas fa-check" title="{{ __('Enable') }}"></i>
                                                </button>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>

                <div class="px-3 py-3">
                    {{ $entidades->links() }}
                </div>
            @else
                <div class="text-sm text-gray-700 px-3 py-3">
                    {{ __('No Results Found') }}
                </div>
            @endif

        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 md:hidden">
            <div class="justify-between">
                {{-- <h1 class="text-xl mb-2">{{ $title }}</h1> --}}
                <h1 class="justify-between mb-2 text-xl">
                    <ol class="list-reset flex">
                        <li class="text-gray-500">&nbsp;{{ $title }}</li>
                    </ol>
                </h1>

                <x-jet-input wire:model.debounce.500ms="q" type="search" class="w-full mb-2 text-sm" placeholder="{{ __('Search') }} {{ __('Company') }}" />

                <div>

                    @livewire('entidad.entidad-create')

                </div>
            </div>

            @if ($entidades->count())
                @foreach ($entidades as $entidad)
                    <div class="bg-white space-y-3 p-4 rounded-lg shadow">
                        <div class="flex justify-between space-x-2 text-sm">
                            <div>
                                <a href="#"
                                    class="text-blue-500 font-bold hover:underline">{{ $entidad->id }}</a>
                            </div>
                            <div class="text-gray-500 font-bold">{{ $entidad->tipo_doc }}: {{ $entidad->nro_doc }}</div>
                            <div>
                                @if ($entidad->activo == 1)
                                    <span
                                        class="p-1.5 text-xs font-medium uppercase tracking-wider text-green-800 bg-green-200 rounded-lg bg-opacity-50">
                                        {{ 'Activo' }}
                                    </span>
                                @else
                                    <span
                                        class="p-1.5 text-xs font-medium uppercase tracking-wider text-red-800 bg-red-200 rounded-lg bg-opacity-50">
                                        {{ 'Inactivo' }}
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="text-xl text-gray-700 text-center font-bold">
                            <h2>{{ $entidad->nombre }}</h2>
                        </div>
                        <div class="text-sm text-gray-700">
                            <i class="fas fa-phone-square-alt"></i>&nbsp; {{ $entidad->telefono }}
                        </div>
                        <div class="text-sm text-gray-700">
                            <i class="fas fa-at"></i>&nbsp; {{ $entidad->email }}
                        </div>
                        <div class="text-sm text-gray-700">
                            <div class="flex items-center justify-center">
                                <div class="inline-flex shadow-md hover:shadow-lg focus:shadow-lg" role="group">
                                    <a  href="{{ route('cliente.colaboradores_entidad', ['id' => $entidad->nro_doc]) }}" title="{{__('Employees')}}"
                                        class="rounded inline-block px-4 py-1.5 bg-cyan-600 text-white font-medium text-xs leading-tight uppercase hover:bg-cyan-700 focus:bg-cyan-700 focus:outline-none focus:ring-0 active:bg-cyan-800 transition duration-150 ease-in-out">
                                        <i class="fas fa-users"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="text-sm font-medium text-black">
                            <div class="flex items-center justify-center">
                                <div class="inline-flex shadow-md hover:shadow-lg focus:shadow-lg" role="group">
                                    @if ($entidad->activo == 1)
                                        <button type="button" title="{{ __('Show') }}"
                                            class="rounded-l inline-block px-4 py-1.5 bg-green-500 text-white font-medium text-xs leading-tight uppercase hover:bg-green-600 focus:bg-green-600 focus:outline-none focus:ring-0 active:bg-green-700 transition duration-150 ease-in-out">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button type="button" wire:click="editar( {{ $entidad }} )" title="{{ __('Edit') }}"
                                            class="inline-block px-4 py-1.5 bg-yellow-500 text-white font-medium text-xs leading-tight uppercase hover:bg-yellow-600 focus:bg-yellow-600 focus:outline-none focus:ring-0 active:bg-yellow-700 transition duration-150 ease-in-out">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button type="button" wire:click="delete( {{ $entidad }} )" title="{{ __('Delete') }}"
                                            class="rounded-r inline-block px-4 py-1.5 bg-red-600 text-white font-medium text-xs leading-tight uppercase hover:bg-red-700 focus:bg-red-700 focus:outline-none focus:ring-0 active:bg-red-800 transition duration-150 ease-in-out">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    @endif

                                    @if ($entidad->activo == 0)
                                        <button type="button" wire:click="enable( {{ $entidad }} )" title="{{ __('Enable') }}"
                                            class="rounded-l rounded-r inline-block px-4 py-1.5 bg-orange-600 text-white font-medium text-xs leading-tight uppercase hover:bg-orange-700 focus:bg-orange-700 focus:outline-none focus:ring-0 active:bg-orange-800 transition duration-150 ease-in-out">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

                @if ($entidades->hasPages())
                    <div class="px-3 py-3">
                        {{ $entidades->links() }}
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
            {{ __('Edit') }} {{ __('Company') }}
        </x-slot>

        <x-slot name="content">

            <div class="col-span-6 sm:col-span-4 mt-4">
                <x-jet-label for="tipo_doc" value="{{ __('Document Type') }}" />
                {{-- wire:model="tipo_doc" --}}
                <select wire:model.defer="entidad.tipo_doc" name="tipo_doc" id="tipo_doc"
                    class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full">
                    @foreach ($tipodocumento as $key => $nombre)
                        <option value="{{ $nombre }}" selected>{{ $nombre }}</option>
                    @endforeach
                </select>
                <x-jet-input-error for="tipo_doc" class="mt-2" />
            </div>
            <div class="col-span-6 sm:col-span-4 mt-4">
                <x-jet-label for="nro_doc" value="{{ __('N° Doc') }}" />
                <x-jet-input id="nro_doc" wire:model.defer="entidad.nro_doc" type="text"
                    class="mt-1 block w-full"
                    maxlength="11"
                />
                <x-jet-input-error for="entidad.nro_doc" class="mt-2" />
            </div>
            <div class="col-span-6 sm:col-span-4 mt-4">
                <x-jet-label for="nombre" value="{{ __('Company') }}" />
                <x-jet-input wire:model.defer="entidad.nombre" type="text" class="mt-1 block w-full"/>
                <x-jet-input-error for="entidad.nombre" class="mt-2" />
            </div>
            <div class="col-span-6 sm:col-span-4 mt-4">
                <x-jet-label for="descripcion" value="{{ __('Description') }}" />
                <x-jet-input wire:model.defer="entidad.descripcion" type="text" class="mt-1 block w-full" />
                <x-jet-input-error for="entidad.descripcion" class="mt-2" />
            </div>

            <div class="col-span-6 sm:col-span-4 mt-4">
                <x-jet-label for="telefono" value="{{ __('Phone') }}" />
                <x-jet-input id="telefono" wire:model.defer="entidad.telefono" type="text"
                    class="mt-1 block w-full"
                    maxlength="11"
                />
                <x-jet-input-error for="telefono" class="mt-2" />
            </div>
            <div class="col-span-6 sm:col-span-4 mt-4">
                <x-jet-label for="email" value="{{ __('E-Mail') }}" />
                <x-jet-input id="email" wire:model.defer="entidad.email" type="email" class="mt-1 block w-full" />
                <x-jet-input-error for="email" class="mt-2" />
            </div>

            <div class="col-span-6 sm:col-span-4 mt-4">
                <x-jet-label for="atencion_id" value="{{ __('Categorization') }}" />
                <select wire:model.defer="entidad.atencion_id" name="atencion_id" id="atencion_id"
                    class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full">
                    <option value="">Seleccione</option>
                    @foreach ($categorizaciones as $nombre => $key)
                        <option value="{{ $key }}">{{ $nombre }}</option>
                    @endforeach
                </select>
                <x-jet-input-error for="entidad.atencion_id" class="mt-2" />
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

    <x-jet-dialog-modal wire:model="modal_delete">
        <x-slot name="title">
            {{ __('Are you sure you want to delete') }} {{ __('Company') }} {{ '?' }}
        </x-slot>

        <x-slot name="content">
            <div class="col-span-6 sm:col-span-4 mt-4">
                <x-jet-input wire:model.defer="entidad.nombre" type="text" class="mt-1 block w-full" disabled/>
            </div>
            <x-jet-input wire:model.defer="entidad.activo" type="hidden" />
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$set('modal_delete', false)" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-jet-secondary-button>
            <x-jet-danger-button wire:click="eliminar" wire:loading.attr="disabled" class="ml-2">
                {{ __('Delete') }}
            </x-jet-danger-button>
        </x-slot>
    </x-jet-dialog-modal>

    <x-jet-dialog-modal wire:model="modal_enable">
        <x-slot name="title">
            {{ __('You want to enable the') }} {{ __('Company') }} {{ '?' }}
        </x-slot>

        <x-slot name="content">
            <div class="col-span-6 sm:col-span-4 mt-4">
                <x-jet-input wire:model.defer="entidad.nombre" type="text" class="mt-1 block w-full" disabled/>
            </div>
            <x-jet-input wire:model.defer="entidad.activo" type="hidden" />
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$set('modal_enable', false)" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-jet-secondary-button>
            <x-jet-danger-button wire:click="habilitar" wire:loading.attr="disabled" class="ml-2">
                {{ __('Enable') }}
            </x-jet-danger-button>
        </x-slot>
    </x-jet-dialog-modal>
</div>

