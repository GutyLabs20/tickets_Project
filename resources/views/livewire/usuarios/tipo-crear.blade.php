<x-jet-dialog-modal wire:model="modal">
    <x-slot name="title">
        {{ 'Crear tipo de usuario' }}
        {{-- {{ isset($this->tipo->id) ? 'Editar tipo de usuario' : 'Crear tipo de usuario' }} --}}
    </x-slot>

    <x-slot name="content">
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="name" value="{{ __('Type_User') }}" />
            <x-jet-input id="article.name" type="text" class="mt-1 block w-full"
                />
            <x-jet-input-error for="article.name" class="mt-2" />
        </div>
        <div class="col-span-6 sm:col-span-4 mt-4">
            <x-jet-label for="price" value="{{ __('Description') }}" />
            <x-jet-input id="article.price" type="text" class="mt-1 block w-full"
                />
            <x-jet-input-error for="article.price" class="mt-2" />
        </div>

    </x-slot>

    <x-slot name="footer">
        <x-jet-secondary-button wire:click="cerrarModal()">
            {{ __('Cancel') }}
        </x-jet-secondary-button>

        <x-jet-danger-button class="ml-2">
            {{ __('Save') }}
        </x-jet-danger-button>
    </x-slot>
</x-jet-dialog-modal>
