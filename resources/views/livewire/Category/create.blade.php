<div>
    <x-jet-dialog-modal wire:model="isOpen">
        <x-slot name="title">
            {{ __('Create Kategori Produk') }}
        </x-slot>

        <x-slot name="content">
            <div class="mt-4">
                <!-- <x-jet-input type="password" class="mt-1 block w-3/4" placeholder="{{ __('Password') }}" x-ref="password" wire:model.defer="password" wire:keydown.enter="deleteUser" />
                <x-jet-input-error for="password" class="mt-2" /> -->
                <x-jet-input type="hidden" class="mt-1 block w-full" placeholder="{{ __('Id') }}" x-ref="id" wire:model.defer="categoryId" />

                <x-jet-input type="text" class="mt-1 block w-full" placeholder="{{ __('Nama Kategori') }}" x-ref="name" wire:model.defer="name" />
                <x-jet-input-error for="name" class="mt-2" />
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="hideModal()" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-jet-secondary-button>

            <x-jet-danger-button class="ml-2" wire:click.prevent="store()" wire:loading.attr="disabled">
                {{ __('Submit') }}
            </x-jet-danger-button>
        </x-slot>
    </x-jet-dialog-modal>
</div>