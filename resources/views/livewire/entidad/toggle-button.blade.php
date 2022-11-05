<div>
    <div class="relative inline-block w-10 mr-2 align-middle select-none transition duration-200 ease-in">
        <input wire:model="isActive" type="checkbox" name="toggle" id="toggle"
            class="focus:outline-none focus:ring toggle-checkbox absolute block w-6 h-6 rounded-full bg-white border-1 appearance-none cursor-pointer" />
        <label for="toggle"
            class="toggle-label block overflow-hidden h-6 rounded-full bg-gray-300 cursor-pointer">
        </label>
    </div>
</div>

<style>
    .toggle-checkbox:checked {
        @apply: right-0 border-green-400;
        right: 0px;
        border-color: #68d391;
    }

    .toggle-checkbox:checked + .toggle-label {
        @apply: bg-green-400;
        background-color: #68d391;
    }
</style>
