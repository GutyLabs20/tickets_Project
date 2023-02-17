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

                <x-jet-input wire:model.debounce.500ms="q" type="search" class="w-1/2 m-0 text-sm" placeholder="{{ __('Search') }} {{ __('Tickets') }}" />

                <div>

                    @livewire('tickets.ticket-crear')

                </div>
            </div>


            @if ($tickets->count())
                <table class="w-full">
                    <thead class="bg-gray-50 border-b-2 border-gray-200">
                        <tr>
                            <th class="p-3 text-sm font-semibold tracking-wide text-left">{{ __('Code') }}</th>
                            <th class="p-3 text-sm font-semibold tracking-wide text-left">{{ __('Registrado el:') }}</th>
                            <th class="p-3 text-sm font-semibold tracking-wide text-left">{{ __('RUC') }}</th>
                            <th class="p-3 text-sm font-semibold tracking-wide text-left">{{ __('Company') }}</th>
                            <th class="p-3 text-sm font-semibold tracking-wide text-left">{{ __('Prioridad') }}</th>
                            <th class="p-3 text-sm font-semibold tracking-wide text-left">{{ __('Clasificación') }}</th>
                            <th class="p-3 text-sm font-semibold tracking-wide text-center">{{ __('Iniciado el:') }}</th>
                            <th class="p-3 text-sm font-semibold tracking-wide text-center">{{ __('Finalizado el:') }}</th>
                            <th class="p-3 text-sm font-semibold tracking-wide text-center">{{ __('Status') }}</th>
                            <th class="w-24 p-3 text-sm font-semibold tracking-wide text-center">{{ __('Action') }}</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach ($tickets as $ticket)
                            <tr class="bg-white">
                                <td class="p-3 text-sm text-gray-700 whitespace-nowrap">
                                    <a href="#" class="font-bold text-blue-500 hover:underline">
                                        {{ $ticket->id }}
                                    </a>
                                </td>
                                <td class="p-3 text-sm text-gray-700 whitespace-nowrap font-bold">
                                    {{ $ticket->tipo_doc }}
                                </td>
                                <td class="p-3 text-sm text-gray-700 whitespace-nowrap font-bold">
                                    {{ $ticket->nro_doc }}
                                </td>
                                <td class="p-3 text-sm text-gray-700 whitespace-nowrap">
                                    {{ $ticket->nombre }}
                                </td>
                                <td class="p-3 text-sm text-gray-700 whitespace-nowrap">
                                    {{ $ticket->telefono }}
                                </td>
                                <td class="p-3 text-sm text-gray-700 whitespace-nowrap">
                                    {{ $ticket->email }}
                                </td>
                                <td class="p-3 text-sm text-gray-700 whitespace-nowrap">
                                    {{ $ticket->email }}
                                </td>
                                <td class="p-3 text-sm text-gray-700 whitespace-nowrap">
                                    {{ $ticket->email }}
                                </td>
                                <td class="p-3 text-sm text-gray-700 whitespace-nowrap">
                                    <div class="flex items-center justify-center">
                                        <div class="inline-flex focus:shadow-lg">
                                            @if ($ticket->activo == 1)
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

                                            @if ($ticket->activo == 1)
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
                                            @endif
                                            @if ($ticket->activo == 0)
                                                <button type="button" wire:click="enable( {{ $ticket }} )" title="{{ __('Enable') }}"
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
                    {{ $tickets->links() }}
                </div>
            @else
                <div class="text-sm text-gray-700 px-3 py-3">
                    {{ __('No Results Found') }}
                </div>
            @endif

        </div>

    </div>

</div>

