<div>
    <button wire:click="create()" type="button"
        class="inline-block px-6 py-2.5 bg-green-500 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-green-600 hover:shadow-lg focus:bg-green-600 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-green-700 active:shadow-lg transition duration-150 ease-in-out">
        {{ __('Add') }} {{ __('New') }}
    </button>

    <x-jet-dialog-modal wire:model="open">
        <x-slot name="title">
            {{ __('Create') }} {{ __('Company') }}
        </x-slot>

        <x-slot name="content">
            <div class="col-span-6 sm:col-span-4 mt-4">
                <x-jet-label for="tipo_doc" value="{{ __('Document Type') }}" />
                {{-- wire:model="tipo_doc" --}}
                <select wire:model="tipo_doc" name="tipo_doc" id="tipo_doc"
                    class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full">
                    <option value="" selected>Seleccione</option>
                    @foreach ($tipodocumento as $key => $nombre)
                        <option value="{{ $nombre }}">{{ $nombre }}</option>
                    @endforeach
                </select>
                <x-jet-input-error for="tipo_doc" class="mt-2" />
            </div>
            <div class="col-span-6 sm:col-span-4 mt-4">
                <x-jet-label for="nro_doc" value="{{ __('N° Doc') }}" />
                <x-jet-input
                    id="nro_doc" wire:model="nro_doc" type="number"
                    class="mt-1 block w-full"
                    maxlength="11"
                    oninput="javascript: if (this.value.maxLength > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                />
                <x-jet-input-error for="nro_doc" class="mt-2" />
            </div>

            <div class="col-span-6 sm:col-span-4 mt-4">
                <x-jet-label for="nombre" value="{{ __('Company') }}" />
                <x-jet-input id="nombre" wire:model="nombre" type="text" class="mt-1 block w-full" />
                <x-jet-input-error for="nombre" class="mt-2" />
            </div>
            <div class="col-span-6 sm:col-span-4 mt-4">
                <x-jet-label for="descripcion" value="{{ __('Description') }}" />
                <x-jet-input id="descripcion" wire:model="descripcion" type="text" class="mt-1 block w-full" />
                <x-jet-input-error for="descripcion" class="mt-2" />
            </div>

            <div class="col-span-6 sm:col-span-4 mt-4">
                <x-jet-label for="telefono" value="{{ __('Phone') }}" />
                <x-jet-input id="telefono" wire:model="telefono" type="text" class="mt-1 block w-full" maxlength="11"/>
                <x-jet-input-error for="telefono" class="mt-2" />
            </div>
            <div class="col-span-6 sm:col-span-4 mt-4">
                <x-jet-label for="email" value="{{ __('E-Mail') }}" />
                <x-jet-input id="email" wire:model="email" type="email" class="mt-1 block w-full" />
                <x-jet-input-error for="email" class="mt-2" />
            </div>
            <div class="col-span-6 sm:col-span-4 mt-4">
                <x-jet-label for="atencion_id" value="{{ __('Categorization') }}" />
                <select wire:model="atencion_id" name="atencion_id" id="atencion_id"
                    class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full">
                    <option value="" selected>Seleccione</option>
                    @foreach ($tipoatencion as $key => $nombre)
                        <option value="{{ $key }}">{{ $nombre }}</option>
                    @endforeach
                </select>
                <x-jet-input-error for="atencion_id" class="mt-2" />
            </div>
            {{-- <div class="col-span-6 sm:col-span-4 mt-4">
                <x-jet-label for="logotipo_path" value="{{ __('Logotype') }}" />
                <x-jet-input id="logotipo_path" wire:model="logotipo_path" type="file" class="mt-1 block w-full" />
                <x-jet-input-error for="logotipo_path" class="mt-2" />
            </div> --}}



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
