<div>
    <button wire:click="create()" type="button"
        class="inline-block px-6 py-2.5 bg-green-500 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-green-600 hover:shadow-lg focus:bg-green-600 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-green-700 active:shadow-lg transition duration-150 ease-in-out">
        {{ __('Add') }} {{ __('New') }}
    </button>

    <x-jet-dialog-modal wire:model="open">
        <x-slot name="title">
            {{ __('Create') }} {{ __('Area') }}
        </x-slot>

        <x-slot name="content">

            <div class="col-span-6 sm:col-span-4 mt-4">
                <x-jet-label for="nombre" value="{{ __('Area') }}" />
                <x-jet-input id="nombre" wire:model="nombre" type="text" class="mt-1 block w-full" />
                <x-jet-input-error for="nombre" class="mt-2" />
            </div>

            <div class="col-span-6 sm:col-span-4 mt-4">
                <x-jet-label for="descripcion" value="{{ __('Description') }}" />
                <x-jet-input id="descripcion" wire:model="descripcion" type="text" class="mt-1 block w-full" />
                <x-jet-input-error for="descripcion" class="mt-2" />
            </div>

            <input type="hidden" name="entidad_id" id="entidad_id" wire:model="{{$entidad_id}}" />
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
