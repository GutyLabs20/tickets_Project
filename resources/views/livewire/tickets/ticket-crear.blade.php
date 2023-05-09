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
            <div class="col-span-6 sm:col-span-4 mt-4 mb-2" wire:ignore>
                <x-jet-label for="compania" value="{{ __('Company') }}" />
                <select
                    wire:model="compania"
                    name="compania" id="select2"
                    class="js-example-basic-single" style="width: 100%;"
                    {{-- class="form-select-sm appearance-none  px-2 py-1 text-sm block w-full font-normal text-gray-700 bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" style="width: 100%;" --}}
                    >
                    <option selected>Seleccione empresa</option>
                    @foreach ($companias as $key => $nombre)
                        <option value="{{ $key }}">{{ $nombre }}</option>
                    @endforeach
                </select>
                <x-jet-input-error for="compania" class="mt-2" />

            </div>

            <div class="col-span-6 sm:col-span-4 mt-4 mb-2">
                <x-jet-label for="contacto" value="{{ __('Contacto') }}" />

                <select
                    wire:model="contacto" name="contacto" id="contacto"
                    class="form-select-sm appearance-none  px-2 py-1 text-sm block w-full font-normal text-gray-700 bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" style="width: 100%;">
                    <option value="seleccione" selected>Seleccione contacto</option>
                    @foreach ($contactos as $key => $nombre)
                        <option value="{{ $key }}">{{ $nombre }}</option>
                    @endforeach
                </select>
                <x-jet-input-error for="contacto" class="mt-2" />
            </div>

            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="ticket_titulo_registro" value="{{ __('Titulo del Ticket') }}" />
                <x-jet-input wire:model="ticket_titulo_registro" type="text" class="mt-1 block w-full" />
                <x-jet-input-error for="ticket_titulo_registro" class="mt-2" />
            </div>
            <div class="col-span-6 sm:col-span-4 mt-4 mb-2" wire:ignore>
                <x-jet-label for="ticket_descripcion_registro" value="{{ __('Descripción') }}" />
                <textarea
                    name="ticket_descripcion_registro"
                    wire:model="ticket_descripcion_registro"
                    id="editor" cols="30" rows="10"
                    class="px-3  py-1.5 min-h-fit h-48 mt-1 block w-full"></textarea>
                {{-- <x-jet-input wire:model="ticket_descripcion_registro" type="text" class="mt-1 block w-full" /> --}}
                <x-jet-input-error for="ticket_descripcion_registro" class="mt-2" />
            </div>

        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="closeModal()" wire:loading.attr="disabled" id="cerrar">
                {{ __('Cancel') }}
            </x-jet-secondary-button>

            <x-jet-danger-button wire:click.prevent="save" wire:loading.attr="disabled" class="ml-2">
                {{ __('Save') }}
            </x-jet-danger-button>
        </x-slot>
    </x-jet-dialog-modal>

    @push('js')
        <script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

        <script>
            ClassicEditor
                .create( document.querySelector( '#editor' ) )
                .then(function(editor){
                    editor.model.document.on('change:data', () => {
                        @this.set('ticket_descripcion_registro', editor.getData());
                    })
                })
                .catch( error => {
                    console.error( error );
                } );


            // $(document).ready(function() {
            //     $('#select2').select2();
            //     $('#select2').on('change', function (e) {
            //         let valor = $('#select2').select2("val");//seleccionamos el value
            //         let texto = $('#select2 option:selected').text();
            //         @this.set('compania', valor);
            //         // @this.set('seleccionado', texto);
            //     });
            // });

            document.addEventListener('livewire:load', function() {
                $('#select2').select2();
                $('#select2').on('change', function (e) {
                    let valor = $('#select2').select2("val");//seleccionamos el value
                    let texto = $('#select2 option:selected').text();
                    @this.set('compania', valor);
                    // @this.set('seleccionado', texto);
                });
            });

        </script>

    @endpush

</div>



