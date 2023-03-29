<div>
    <button wire:click="create()" type="button"
        class="inline-block px-6 py-2.5 bg-green-500 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-green-600 hover:shadow-lg focus:bg-green-600 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-green-700 active:shadow-lg transition duration-150 ease-in-out">
        {{ __('Add') }} {{ __('New') }}
    </button>

    <x-jet-dialog-modal wire:model="open">
        <x-slot name="title">
            {{ 'Crear usuario' }}
        </x-slot>

        <x-slot name="content">
            <div class="col-span-6 sm:col-span-4 mt-4 mb-2">
                <x-jet-label for="compania_id" value="{{ __('Company') }}" />
                <select wire:model="compania_id" name="compania_id" id="compania_id"
                    class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full mb-2">
                    <option value="" selected>Seleccione</option>
                    @foreach ($companias as $key => $nombre)
                        <option value="{{ $key }}">{{ $nombre }}</option>
                    @endforeach
                </select>
                <x-jet-input-error for="compania_id" class="mt-2" />
            </div>
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="ticket_titulo_registro" value="{{ __('Titulo del Ticket') }}" />
                <x-jet-input wire:model="ticket_titulo_registro" type="text" class="mt-1 block w-full" />
                <x-jet-input-error for="ticket_titulo_registro" class="mt-2" />
            </div>
            <div class="col-span-6 sm:col-span-4 mt-4">
                <x-jet-label for="ticket_descripcion_registro" value="{{ __('Descripción') }}" />
                <textarea wire:model="ticket_descripcion_registro" name=""
                    id="editor" cols="30" rows="10"
                    class="mt-1 block w-full"></textarea>
                {{-- <x-jet-input wire:model="ticket_descripcion_registro" type="text" class="mt-1 block w-full" /> --}}
                <x-jet-input-error for="ticket_descripcion_registro" class="mt-2" />
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

    @push('js')
        <script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js"></script>

        <script>
            ClassicEditor
                .create( document.querySelector( '#editor' ) )
                .then(function(editor){
                    editor.model.document.on('change:data', ()=>{
                        @this.set('ticket_descripcion_registro', editor.getData());
                    })
                })
                .catch( error => {
                    console.error( error );
                } );
        </script>

    @endpush

</div>



