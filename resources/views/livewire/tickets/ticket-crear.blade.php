<div>
    <button wire:click="create()" type="button"
        class="inline-block px-6 py-2.5 bg-green-500 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-green-600 hover:shadow-lg focus:bg-green-600 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-green-700 active:shadow-lg transition duration-150 ease-in-out">
        {{ __('Add') }} {{ __('New') }}
    </button>

    <x-jet-dialog-modal wire:model="open">
        <x-slot name="title">
            {{ 'Crear Ticket' }}
        </x-slot>

        <x-slot name="content">
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="nombres" value="{{ __('FirstName') }}" />
                <x-jet-input wire:model="nombres" type="text" class="mt-1 block w-full" />
                <x-jet-input-error for="nombres" class="mt-2" />
            </div>
            <div class="col-span-6 sm:col-span-4 mt-4">
                <x-jet-label for="apellidos" value="{{ __('LastName') }}" />
                <x-jet-input wire:model="apellidos" type="text" class="mt-1 block w-full" />
                <x-jet-input-error for="apellidos" class="mt-2" />
            </div>
            <div class="col-span-6 sm:col-span-4 mt-4">
                <x-jet-label for="email" value="{{ __('E-mail') }}" />
                <x-jet-input wire:model="email" type="email" class="mt-1 block w-full" />
                <x-jet-input-error for="email" class="mt-2" />
            </div>
            {{-- <div class="col-span-6 sm:col-span-4 mt-4">
                <x-jet-label for="tipousuario_id" value="{{ __('Type_User') }}" />
                <select wire:model="tipousuario_id" name="tipousuario_id" id="tipousuario_id"
                    class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full">
                    <option value="" selected>Seleccione</option>
                    @foreach ($tipousuarios as $key => $nombre)
                        <option value="{{ $key }}">{{ $nombre }}</option>
                    @endforeach
                </select>
                <x-jet-input-error for="tipousuario_id" class="mt-2" />
            </div> --}}
            <div class="col-span-6 sm:col-span-4 mt-4">
                <x-jet-label for="password" value="{{ __('Password') }}" />
                <x-jet-input wire:model="password" type="password" class="mt-1 block w-full" />
                <x-jet-input-error for="password" class="mt-2" />
            </div>

        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="closeModal()" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-jet-secondary-button>

            <x-jet-danger-button wire:click.prevent="save" wire:loading.attr="disabled" class="ml-2">
                {{ __('Save') }}
            </x-jet-danger-button>
        </x-slot>
    </x-jet-dialog-modal>
</div>
