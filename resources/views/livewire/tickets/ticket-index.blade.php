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

                <x-jet-input wire:model.debounce.500ms="q" type="search" class="w-1/2 m-0 text-sm"
                    placeholder="{{ __('Search') }} {{ __('Tickets') }}" />

                <div>

                    @livewire('tickets.ticket-crear')

                </div>
            </div>


            @if ($tickets->count())
                <table class="w-full">
                    <thead class="bg-gray-50 border-b-2 border-gray-200">
                        <tr>
                            <th class="p-3 text-sm font-semibold tracking-wide text-left">{{ __('Code') }}</th>
                            <th class="p-3 text-sm font-semibold tracking-wide text-left">{{ __('Registrado el:') }}
                            </th>
                            <th class="p-3 text-sm font-semibold tracking-wide text-left">{{ __('Company') }}</th>
                            <th class="p-3 text-sm font-semibold tracking-wide text-left">{{ __('Prioridad') }}</th>
                            <th class="p-3 text-sm font-semibold tracking-wide text-left">{{ __('Clasificación') }}</th>
                            <th class="p-3 text-sm font-semibold tracking-wide text-center">{{ __('Iniciado el:') }}
                            </th>
                            <th class="p-3 text-sm font-semibold tracking-wide text-center">{{ __('Finalizado el:') }}
                            </th>
                            <th class="p-3 text-sm font-semibold tracking-wide text-center">{{ __('Status') }}</th>
                            <th class="w-24 p-3 text-sm font-semibold tracking-wide text-center">{{ __('Action') }}
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach ($tickets as $ticket)
                            <tr class="bg-white">
                                <td class="p-3 text-sm text-gray-700 whitespace-nowrap">
                                    <a class="font-bold text-blue-500 hover:underline">
                                        {{ $ticket->codigo_ticket }}
                                    </a>
                                </td>
                                <td class="p-3 text-sm text-gray-700 whitespace-nowrap font-bold">
                                    {{ date('d-m-Y', strtotime($ticket->fecha_registro)) }}
                                </td>
                                <td class="p-3 text-sm text-gray-700 whitespace-nowrap font-bold">
                                    @isset($ticket->companiaTicket->nombre)
                                        <div class="text-xs">RUC: {{ $ticket->companiaTicket->nro_doc }}</div>
                                        <div class="text-gray-500">{{ $ticket->companiaTicket->nombre }}</div>
                                    @else
                                        {{ '-' }}
                                    @endisset
                                </td>
                                <td class="p-3 text-sm text-gray-700 whitespace-nowrap">
                                    @isset($ticket->prioridadTicket->nombre)
                                        {{ $ticket->prioridadTicket->nombre }}
                                    @else
                                        {{ '-' }}
                                    @endisset
                                </td>
                                <td class="p-3 text-sm text-gray-700 whitespace-nowrap">
                                    @isset($ticket->clasificacionTicket->nombre)
                                        {{ $ticket->clasificacionTicket->nombre }}
                                    @else
                                        {{ '-' }}
                                    @endisset
                                </td>
                                <td class="p-3 text-sm text-gray-700 whitespace-nowrap">
                                    @isset($incidente->fecha_inicio_ticket)
                                        {{ date('d-m-Y', strtotime($ticket->fecha_inicio_ticket)) }}
                                    @else
                                        {{ '-' }}
                                    @endisset
                                </td>
                                <td class="p-3 text-sm text-gray-700 whitespace-nowrap">
                                    @isset($incidente->fecha_fin_ticket)
                                        {{ date('d-m-Y', strtotime($ticket->fecha_fin_ticket)) }}
                                    @else
                                        {{ '-' }}
                                    @endisset
                                </td>
                                <td class="p-3 text-sm text-gray-700 whitespace-nowrap">
                                    <div class="flex items-center justify-center">
                                        <div class="inline-flex focus:shadow-lg">

                                            @if ($ticket->estado_id === 1)
                                                <span
                                                    class="toggle-checkbox p-1.5 text-xs font-medium uppercase tracking-wider bg-orange-200 text-orange-800 rounded-lg bg-opacity-50">
                                                    {{ $ticket->estadoTicket->nombre }}
                                                </span>
                                            @endif
                                            @if ($ticket->estado_id === 2)
                                                <span
                                                    class="toggle-checkbox p-1.5 text-xs font-medium uppercase tracking-wider bg-yellow-200 text-yellow-800 rounded-lg bg-opacity-50">
                                                    {{ $ticket->estadoTicket->nombre }}
                                                </span>
                                            @endif
                                            @if ($ticket->estado_id === 3)
                                                <span
                                                    class="toggle-checkbox p-1.5 text-xs font-medium uppercase tracking-wider text-indigo-800 bg-indigo-200 rounded-lg bg-opacity-50">
                                                    {{ $ticket->estadoTicket->nombre }}
                                                </span>
                                            @endif
                                            @if ($ticket->estado_id === 4)
                                                <span
                                                    class="toggle-checkbox p-1.5 text-xs font-medium uppercase tracking-wider text-green-800 bg-green-200 rounded-lg bg-opacity-50">
                                                    {{ $ticket->estadoTicket->nombre }}
                                                </span>
                                            @endif
                                            @if ($ticket->estado_id === 5)
                                                <span
                                                    class="toggle-checkbox p-1.5 text-xs font-medium uppercase tracking-wider text-red-800 bg-red-200 rounded-lg bg-opacity-50">
                                                    {{ $ticket->estadoTicket->nombre }}
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td class="p-3 text-sm text-gray-700 whitespace-nowrap">
                                    <div class="flex items-center justify-center">
                                        <div class="inline-flex shadow-md hover:shadow-lg focus:shadow-lg"
                                            role="group">

                                            {{-- @if ($ticket->activo == 1)
                                                <button type="button" title="{{ __('Show') }}"
                                                    class="rounded-l inline-block px-4 py-1.5 bg-green-500 text-white font-medium text-xs leading-tight uppercase hover:bg-green-600 focus:bg-green-600 focus:outline-none focus:ring-0 active:bg-green-700 transition duration-150 ease-in-out">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                                <button type="button" wire:click="editar( {{ $ticket }} )" title="{{ __('Edit') }}"
                                                    class="inline-block px-4 py-1.5 bg-yellow-500 text-white font-medium text-xs leading-tight uppercase hover:bg-yellow-600 focus:bg-yellow-600 focus:outline-none focus:ring-0 active:bg-yellow-700 transition duration-150 ease-in-out">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <button type="button" wire:click="delete( {{ $ticket }} )" title="{{ __('Delete') }}"
                                                    class="rounded-r inline-block px-4 py-1.5 bg-red-600 text-white font-medium text-xs leading-tight uppercase hover:bg-red-700 focus:bg-red-700 focus:outline-none focus:ring-0 active:bg-red-800 transition duration-150 ease-in-out">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            @endif --}}
                                            {{-- @if ($ticket->estado_id == 1) --}}
                                            <button type="button" title="{{ __('Show') }}"
                                                wire:click="mostrarTicket( {{ $ticket->id }} )"
                                                class="rounded inline-block px-4 py-1.5 bg-indigo-500 text-white font-medium text-xs leading-tight uppercase hover:bg-indigo-600 focus:bg-indigo-600 focus:outline-none focus:ring-0 active:bg-indigo-700 transition duration-150 ease-in-out">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            {{-- @endif --}}
                                        </div>

                                        <div class="inline-flex shadow-md hover:shadow-lg focus:shadow-lg"
                                            role="group">
                                            <button type="button" title="{{ __('Ver Timeline Ticket') }}"
                                                class="rounded inline-block ml-2 px-4 py-1.5 bg-purple-500 text-white font-medium text-xs leading-tight uppercase hover:bg-purple-600 focus:bg-purple-600 focus:outline-none focus:ring-0 active:bg-purple-700 transition duration-150 ease-in-out">
                                                <i class="fas fa-tasks"></i>
                                            </button>
                                        </div>

                                        @if ($ticket->asignado == false)
                                            <div class="inline-flex shadow-md hover:shadow-lg focus:shadow-lg"
                                                role="group">

                                                <button type="button" title="{{ __('Asignar Ticket') }}"
                                                    wire:click="detalleTicket( {{ $ticket->id }} )"
                                                    class="rounded inline-block ml-2 px-4 py-1.5 bg-amber-500 text-white font-medium text-xs leading-tight uppercase hover:bg-amber-600 focus:bg-amber-600 focus:outline-none focus:ring-0 active:bg-amber-700 transition duration-150 ease-in-out">
                                                    <i class="fas fa-tags"></i>
                                                </button>

                                            </div>
                                        @endif


                                        @if ($ticket->asignado == true)
                                            <div class="inline-flex shadow-md hover:shadow-lg focus:shadow-lg"
                                                role="group">

                                                <button type="button" title="{{ __('Atender Ticket') }}"
                                                    wire:click="atenderTicket( {{ $ticket->id }} )"
                                                    class="rounded inline-block ml-2 px-4 py-1.5 bg-orange-500 text-white font-medium text-xs leading-tight uppercase hover:bg-orange-600 focus:bg-orange-600 focus:outline-none focus:ring-0 active:bg-orange-700 transition duration-150 ease-in-out">
                                                    <i class="fas fa-play-circle"></i>
                                                </button>

                                            </div>
                                        @endif

                                    </div>

                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>

                <div class="px-3 py-3">
                    {{ $tickets->links() }}
                </div>
            @else
                <div class="text-sm text-gray-700 px-3 py-3">
                    {{ __('No Results Found') }}
                </div>
            @endif

        </div>

    </div>

    {{-- Modal Ver Ticket --}}
    <x-jet-dialog-modal wire:model="modal_ver">
        <x-slot name="title">
            <div class="grid grid-cols-1 gap-x-8 gap-y-6 sm:grid-cols-2">
                <div>
                    <label for="first-name" class="block text-sm font-semibold leading-6 text-gray-900">
                        {{ __('Ticket N°: ') }}
                        <span href="#"
                            class="font-bold text-blue-500 hover:underline">{{ $codigo_ticket }}</span>
                    </label>
                </div>
                <div>
                    <label for="last-name" class="block text-sm font-semibold leading-6 text-gray-900">
                        {{ __('Status') }}{{ ':' }}
                        <span
                            class="toggle-checkbox p-1.5 text-xs font-medium uppercase tracking-wider bg-{{ $color }}-200 text-{{ $color }}-800 rounded-lg bg-opacity-50">
                            {{ $estado }}
                        </span>
                    </label>
                </div>

            </div>
        </x-slot>

        <x-slot name="content" class="border-t border-gray-200">
            <div class="overflow-hidden bg-white shadow sm:rounded-lg">
                <div class="mx-auto max-w-7xl px-6 lg:px-8">
                    <div class="mx-auto max-w-2xl lg:mx-0 text-center">
                        <h3 class="text-1xl my-2 font-bold tracking-tight text-gray-900 sm:text-2xl">
                            {{ $compania }}</h3>
                    </div>
                </div>
                <div class="border-t border-gray-200">
                    <dl>
                        <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">{{ __('Register Date') }}</dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">{{ $fecha_registro }}</dd>
                        </div>
                        <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">{{ __('Registró Ticket') }}</dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">{{ $usuario_registro }}</dd>
                        </div>
                        <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">{{ __('Contacto') }}</dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">{{ $contacto }}</dd>
                        </div>
                        <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">{{ __('Título del ticket') }}</dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">{{ $titulo }}</dd>
                        </div>
                        <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">{{ __('Description') }}</dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
                                {!! $descripcion !!}
                            </dd>
                        </div>

                        @if ($asignado == true)
                            <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-sm font-medium text-gray-500">{{ __('Priority') }}</dt>
                                <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">{{ $prioridad }}</dd>
                            </div>
                            {{-- <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-sm font-medium text-gray-500">{{ __('Impact') }}</dt>
                                <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">{{ $impacto }}</dd>
                            </div> --}}
                            <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-sm font-medium text-gray-500">{{ __('Category') }}</dt>
                                <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">{{ $clasificacion }}</dd>
                            </div>
                            <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-sm font-medium text-gray-500">{{ __('Classification') }}</dt>
                                <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">{{ $categoria }}</dd>
                            </div>
                            <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-sm font-medium text-gray-500">{{ __('Category') }}</dt>
                                <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">{{ $tecnicoAsignado }}</dd>
                            </div>
                            {{-- <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-sm font-medium text-gray-500">{{ __('Técnico Asignado') }}</dt>
                                <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">{{ $tecnicoAsignado }}
                                </dd>
                            </div> --}}
                        @endif


                    </dl>
                </div>
            </div>

        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:loading.attr="disabled" wire:click="$set('modal_ver', false)">
                {{ __('Close') }}
            </x-jet-secondary-button>
        </x-slot>
    </x-jet-dialog-modal>

    {{-- Modal Asignar Ticket --}}
    <x-jet-dialog-modal wire:model="modal_asignar">
        <x-slot name="title">
            <div class="grid grid-cols-1 gap-x-8 gap-y-6 sm:grid-cols-2">
                <div>
                    <label for="first-name" class="block text-sm font-semibold leading-6 text-gray-900">
                        {{ __('Ticket N°: ') }}
                        <span href="#"
                            class="font-bold text-blue-500 hover:underline">{{ $codigo_ticket }}</span>
                    </label>
                </div>
                <div>
                    <label for="last-name" class="block text-sm font-semibold leading-6 text-gray-900">
                        {{ __('Status') }}{{ ':' }}
                        <span
                            class="toggle-checkbox p-1.5 text-xs font-medium uppercase tracking-wider bg-{{ $color }}-200 text-{{ $color }}-800 rounded-lg bg-opacity-50">
                            {{ $estado }}
                        </span>
                    </label>
                </div>

            </div>
        </x-slot>

        <x-slot name="content" class="border-t border-gray-200">
            <div class="overflow-hidden bg-white shadow sm:rounded-lg">
                <div class="mx-auto max-w-7xl px-6 lg:px-8">
                    <div class="mx-auto max-w-2xl lg:mx-0 text-center">
                        <h3 class="text-1xl my-2 font-bold tracking-tight text-gray-900 sm:text-2xl">
                            {{ $titulo }}</h3>
                    </div>
                </div>
                <div class="border-t border-gray-200">
                    <dl>
                        <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">{{ __('Description') }}</dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
                                {!! $descripcion !!}
                            </dd>
                        </div>
                        <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">{{ __('Business') }}</dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">{{ $compania }}</dd>
                        </div>
                        <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">{{ __('Register Date') }}</dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">{{ $fecha_registro }}</dd>
                        </div>
                    </dl>
                </div>
            </div>

            <div class="overflow-hidden bg-white shadow sm:rounded-lg mt-2">
                <div class="mx-auto max-w-7xl px-6 lg:px-8">
                    <div class="mx-auto max-w-2xl lg:mx-0 text-center">
                        <h6 class="text-1xl my-2 font-bold tracking-tight text-gray-900 sm:text-2xl">
                            {{ __('Definir Ticket') }}</h6>
                    </div>
                </div>
                <div class="border-t border-gray-200">
                    <dl>
                        <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">{{ __('Priority') }}</dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">

                                <select wire:model.defer="prioridad" name="prioridad" id="prioridad"
                                    class="form-select-sm appearance-none  px-2 py-1 text-sm block w-full font-normal text-gray-700 bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                                    style="width: 100%;">
                                    <option selected>Seleccione prioridad</option>
                                    @foreach ($listaPrioridades as $key => $prioridad)
                                        <option value="{{ $key }}">
                                            {{ $prioridad }}
                                        </option>
                                    @endforeach
                                </select>
                                <x-jet-input-error for="prioridad" class="mt-2" />

                            </dd>
                        </div>
                        {{-- <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">{{ __('Impact') }}</dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">

                                <select wire:model.defer="impacto" name="impacto" id="impacto"
                                    class="form-select-sm appearance-none  px-2 py-1 text-sm block w-full font-normal text-gray-700 bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                                    style="width: 100%;">
                                    <option selected>Seleccione impacto</option>
                                    @foreach ($listaImpactos as $key => $impacto)
                                        <option value="{{ $key }}">
                                            {{ $impacto }}
                                        </option>
                                    @endforeach
                                </select>
                                <x-jet-input-error for="impacto" class="mt-2" />

                            </dd>
                        </div> --}}
                        <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">{{ __('Classification') }}</dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">

                                <select wire:model.defer="categoria" name="categoria" id="categoria"
                                    class="form-select-sm appearance-none  px-2 py-1 text-sm block w-full font-normal text-gray-700 bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                                    style="width: 100%;">
                                    <option selected>Seleccione clasificación</option>
                                    @foreach ($listaClasificaciones as $key => $clasificacion)
                                        <option value="{{ $key }}">
                                            {{ $clasificacion }}
                                        </option>
                                    @endforeach
                                </select>
                                <x-jet-input-error for="categoria" class="mt-2" />

                            </dd>
                        </div>
                        <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">{{ __('Category') }}</dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">

                                <select wire:model.defer="clasificacion" name="clasificacion"
                                    id="clasificacion"
                                    class="form-select-sm appearance-none  px-2 py-1 text-sm block w-full font-normal text-gray-700 bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                                    style="width: 100%;">
                                    <option selected>Seleccione categoría</option>
                                    @foreach ($listeaCategorias as $key => $categoria)
                                        <option value="{{ $key }}">
                                            {{ $categoria }}
                                        </option>
                                    @endforeach
                                </select>
                                <x-jet-input-error for="clasificacion" class="mt-2" />

                            </dd>
                        </div>
                        <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">{{ __('Técnico Responsable') }}</dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">

                                <select wire:model.defer="tecnicoAsignado" name="tecnicoAsignado"
                                    id="tecnicoAsignado"
                                    class="form-select-sm appearance-none  px-2 py-1 text-sm block w-full font-normal text-gray-700 bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                                    style="width: 100%;">
                                    <option selected>Seleccione técnico</option>
                                    @foreach ($listaTecnicos as $key => $tecnico)
                                        <option value="{{ $key }}">
                                            {{ $tecnico }}
                                        </option>
                                    @endforeach
                                </select>
                                <x-jet-input-error for="tecnicoAsignado" class="mt-2" />

                            </dd>
                        </div>
                    </dl>
                </div>
            </div>

        </x-slot>


        <x-slot name="footer">
            <x-jet-secondary-button wire:loading.attr="disabled" wire:click="$set('modal_asignar', false)">
                {{ __('Cancel') }}
            </x-jet-secondary-button>
            <x-jet-danger-button wire:click="asignarTicket" wire:loading.attr="disabled" class="ml-2">
                {{ __('Save') }}
            </x-jet-danger-button>
        </x-slot>
    </x-jet-dialog-modal>


    {{-- Modal Ver para atender Ticket --}}
    <x-jet-dialog-modal wire:model="modal_atencion">
        <x-slot name="title">
            <div class="grid grid-cols-1 gap-x-8 gap-y-6 sm:grid-cols-2">
                <div>
                    <label for="codigo_ticket" class="block text-sm font-semibold leading-6 text-gray-900">
                        {{ __('Ticket N°: ') }}
                        <span href="#"
                            class="font-bold text-blue-500 hover:underline">{{ $codigo_ticket }}</span>
                    </label>
                </div>
                <div>
                    <label for="estado" class="block text-sm font-semibold leading-6 text-gray-900">
                        {{ __('Status') }}{{ ':' }}
                        <span
                            class="toggle-checkbox p-1.5 text-xs font-medium uppercase tracking-wider bg-{{ $color }}-200 text-{{ $color }}-800 rounded-lg bg-opacity-50">
                            {{ $estado }}
                        </span>
                    </label>
                </div>

            </div>
        </x-slot>

        <x-slot name="content" class="border-t border-gray-200">

            <div class="overflow-hidden bg-white shadow sm:rounded-lg">
                <div class="mx-auto max-w-7xl px-6 lg:px-8">
                    <div class="mx-auto max-w-2xl lg:mx-0 text-center">
                        <h3 class="text-1xl my-2 font-bold tracking-tight text-gray-900 sm:text-2xl">
                            {{ $compania }}</h3>
                    </div>
                </div>
                <div class="border-t border-gray-200">
                    <article class="flex max-w-xl flex-col items-start m-2 justify-between">
                        <div class="flex items-center gap-x-4 text-xs">
                            <label class="text-gray-500">{{ $fecha_registro }}</label>
                            {{'|'}}
                            <label class="text-gray-500">{{ __('Priority') }}</label>
                            <a
                                class="relative z-10 rounded-full bg-{{ $colorPrioridad }}-50 px-3 py-1 font-medium text-{{ $colorPrioridad }}-600 hover:bg-{{ $colorPrioridad }}-100">
                                {{ $prioAtencion }}
                            </a>

                        </div>
                        <div class="group relative">
                            <h3 class="mt-3 text-lg font-semibold leading-6 text-gray-900 group-hover:text-gray-600">
                                <a>
                                    <span class="absolute inset-0"></span>
                                    {{ $titulo }}
                                </a>
                            </h3>
                            <p class="mt-5 line-clamp-3 text-sm leading-6 text-gray-600">
                                {!! $descripcion !!}
                            </p>
                        </div>
                        <div class="relative mt-8 flex items-center gap-x-4">
                            <img src="https://www.nicepng.com/png/detail/128-1280406_view-user-icon-png-user-circle-icon-png.png"
                                alt="" class="h-10 w-10 rounded-full bg-gray-50" />
                            <div class="text-sm leading-6">
                                <p class="font-semibold text-gray-900">
                                    <a>
                                        <span class="absolute inset-0"></span>
                                        {{ $contacto }}
                                    </a>
                                </p>
                                <p class="text-gray-600">{{ $rolcontacto }}</p>
                            </div>
                        </div>

                        <div class="flex items-center gap-x-4 text-xs mt-2">

                            <label class="text-gray-500">{{ __('Tags') }}: </label>
                            <a
                                class="relative z-10 rounded-full bg-slate-50 px-3 py-1 font-medium text-slate-600 hover:bg-slate-100">
                                {{ $clasificacionAtencion }}
                            </a>
                            <a
                                class="relative z-10 rounded-full bg-slate-50 px-3 py-1 font-medium text-slate-600 hover:bg-slate-100">
                                {{ $categoriaAtencion }}
                            </a>
                        </div>
                    </article>
                </div>
            </div>

            <div class="overflow-hidden bg-white shadow sm:rounded-lg mt-2">
                <div class="mx-auto max-w-7xl px-6 lg:px-8">
                    <div class="mx-auto max-w-2xl lg:mx-0 text-center">
                        <p class="text-1xl my-2 font-bold tracking-tight text-gray-900 sm:text-1xl">
                            {{ __('Definir Ticket') }}
                        </p>
                    </div>
                </div>
                <div class="border-t border-gray-200">

                </div>
            </div>

        </x-slot>


        <x-slot name="footer">
            <x-jet-secondary-button wire:loading.attr="disabled" wire:click="$set('modal_atencion', false)">
                {{ __('Cancel') }}
            </x-jet-secondary-button>
            <x-jet-danger-button wire:click="asignarTicket" wire:loading.attr="disabled" class="ml-2">
                {{ __('Save') }}
            </x-jet-danger-button>
        </x-slot>
    </x-jet-dialog-modal>

</div>
