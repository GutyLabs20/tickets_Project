<div>
    <button wire:click="create()" type="button"
        class="inline-block px-6 py-2.5 bg-green-500 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-green-600 hover:shadow-lg focus:bg-green-600 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-green-700 active:shadow-lg transition duration-150 ease-in-out">
        {{ __('Add') }} {{ __('New') }}
    </button>

    <x-jet-dialog-modal wire:model="open">
        <x-slot name="title">
            {{ __('Create') }} {{ __('Employee') }}
        </x-slot>

        <x-slot name="content">

            <div class="col-span-6 sm:col-span-4 mt-4">
                <x-jet-label for="nombre" value="{{ __('FirstName') }}" />
                <x-jet-input id="nombre" wire:model="nombre" type="text" class="mt-1 block w-full" />
                <x-jet-input-error for="nombre" class="mt-2" />
            </div>
            <div class="col-span-6 sm:col-span-4 mt-4">
                <x-jet-label for="nombre" value="{{ __('LastName') }}" />
                <x-jet-input id="nombre" wire:model="nombre" type="text" class="mt-1 block w-full" />
                <x-jet-input-error for="nombre" class="mt-2" />
            </div>
            <div class="col-span-6 sm:col-span-4 mt-4">
                <x-jet-label for="nombre" value="{{ __('E-Mail') }}" />
                <x-jet-input id="nombre" wire:model="nombre" type="text" class="mt-1 block w-full" />
                <x-jet-input-error for="nombre" class="mt-2" />
            </div>
            <div class="col-span-6 sm:col-span-4 mt-4">
                <x-jet-label for="nombre" value="{{ __('Phone') }}" />
                <x-jet-input id="nombre" wire:model="nombre" type="text" class="mt-1 block w-full" />
                <x-jet-input-error for="nombre" class="mt-2" />
            </div>
            <div class="col-span-6 sm:col-span-4 mt-4">
                <x-jet-label for="area_id" value="{{ __('Area') }}" />
                <select wire:model="area_id" name="area_id" id="area_id"
                    class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full">
                    <option value="" selected>Seleccione</option>
                    @foreach ($areas as $key => $nombre)
                        <option value="{{ $key }}">{{ $nombre }}</option>
                    @endforeach
                </select>
                <x-jet-input-error for="tipousuario_id" class="mt-2" />
            </div>
            {{-- <input type="hidden" name="entidad_id" id="entidad_id" wire:model="{{$entidad_id}}" /> --}}
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
