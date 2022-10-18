<x-jet-dialog-modal wire:model="modal_edit">
    <x-slot name="title">
        {{-- {{ 'Editar tipo de usuario' }} --}}
        {{ isset($this->tipo->id) ? 'Editar tipo de usuario' : 'Crear tipo de usuario' }}
    </x-slot>

    <x-slot name="content">
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="nombre" value="{{ __('Type_User') }}" />
            <x-jet-input wire:model.defer="tipo.nombre" type="text" class="mt-1 block w-full" />
            <x-jet-input-error for="tipo.nombre" class="mt-2" />
        </div>
        <div class="col-span-6 sm:col-span-4 mt-4">
            <x-jet-label for="descripcion" value="{{ __('Description') }}" />
            <x-jet-input wire:model.defer="tipo.descripcion" type="text" class="mt-1 block w-full" />
            <x-jet-input-error for="tipo.descripcion" class="mt-2" />
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
