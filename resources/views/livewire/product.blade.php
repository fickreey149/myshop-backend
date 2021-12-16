<div class="p-6">
    <div class="flex items-center px-4 py-3 text-right sm:px-6">
        <x-jet-button wire:click="showModal">
            {{ __('Add Product') }}
        </x-jet-button>
    </div>

    <!-- Datatables -->
    <div class="flex flex-col">
        <div class="my-2 overflow-x-auto sm:mx-6 lg:mx-8">
            <div class="py-2 align-middle inline-block w-full sm:px-6 lg:px-8">
                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                    <table class="w-full divide-y divide-gray-200">
                        <thead>
                            <tr>
                                <th class="px-6 py-3 bg-gray-100 text-center text-sm leading-4 font-medium text-gray-500 upercase tracking-wider">Name</th>
                                <th class="px-6 py-3 bg-gray-100 text-center text-sm leading-4 font-medium text-gray-500 upercase tracking-wider">Category</th>
                                <th class="px-6 py-3 bg-gray-100 text-center text-sm leading-4 font-medium text-gray-500 upercase tracking-wider">Price</th>
                                <th class="px-6 py-3 bg-gray-100 text-center text-sm leading-4 font-medium text-gray-500 upercase tracking-wider">Description</th>
                                <th class="px-6 py-3 bg-gray-100 text-center text-sm leading-4 font-medium text-gray-500 upercase tracking-wider">Tags</th>
                                <th class="px-6 py-3 bg-gray-100 text-center text-sm leading-4 font-medium text-gray-500 upercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @if ($data->count())
                            @foreach ($data as $item)
                            <tr>
                                <td class="px-6 py-4 text-center text-base whitespace-no-wrap">{{ $item->name }}</td>
                                <td class="px-6 py-4 text-center text-base whitespace-no-wrap">{{ $item->category->name }}</td>
                                <td class="px-6 py-4 text-center text-base whitespace-no-wrap">{{ $item->price }}</td>
                                <td class="px-6 py-4 text-center text-base whitespace-no-wrap">{{ $item->description }}</td>
                                <td class="px-6 py-4 text-center text-base whitespace-no-wrap">{{ $item->tags }}</td>
                                <td class="px-6 py-4 text-center text-base">
                                    <x-jet-button wire:click="showUpdateModal({{ $item->id }})">
                                        {{ __('Update') }}
                                    </x-jet-button>

                                    <x-jet-danger-button class="ml-2" wire:click="showDeleteModal({{ $item->id }})" wire:loading.attr="disabled">
                                        {{ __('Delete') }}
                                    </x-jet-danger-button>
                                </td>
                            </tr>
                            @endforeach
                            @else
                            <tr>
                                <td class="px-6 py-4 text-center text-base whitespace-no-wrap" colspan="4">No Result Found</td>
                            </tr>
                            @endif

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <br />

    {{ $data->links() }}

    <!-- Show Modal -->
    <x-jet-dialog-modal wire:model="visibleModalForm">
        <x-slot name="title">
            {{ __('Form Add Product') }}
        </x-slot>

        <x-slot name="content">
            <div class="mt-4">
                <x-jet-label for="name" value="{{ __('Product Name') }}" />
                <x-jet-input type="text" class="mt-1 block w-3/4" placeholder="{{ __('Product Name') }}" wire:model.defer="name" />
                <x-jet-input-error for="name" class="mt-2" />
            </div>
            <div class="mt-4">
                <x-jet-label for="price" value="{{ __('Price') }}" />
                <x-jet-input type="text" class="mt-1 block w-3/4" placeholder="{{ __('Price') }}" wire:model.defer="price" />
                <x-jet-input-error for="price" class="mt-2" />
            </div>
            <div class="mt-4">
                <x-jet-label for="categories_id" value="{{ __('Category') }}" />
                <select wire:model.defer="categories_id" class="js-example-basic-single mt-1 block w-3/4 form-control border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" name="categories_id">
                    <option disabled>Choice Categories</option>
                    @if($categories)
                    @foreach($categories as $cat)
                    <option value={{ $cat->id }}>{{ $cat->name }}</option>
                    @endforeach
                    @endif
                </select>
                <x-jet-input-error for="categories_id" class="mt-2" />
            </div>
            <div class="mt-4">
                <x-jet-label for="description" value="{{ __('Description') }}" />
                <textarea wire:model.defer="description" placeholder="Description" class="mt-1 block w-3/4 form-control border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                </textarea>
                <x-jet-input-error for="description" class="mt-2" />
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$toggle('visibleModalForm')">
                {{ __('Cancel') }}
            </x-jet-secondary-button>

            @if ($modelId)
            <x-jet-danger-button class="ml-2" wire:click="createOrUpdate" wire:loading.attr="disabled">
                {{ __('Update Product') }}
            </x-jet-danger-button>
            @else
            <x-jet-danger-button class="ml-2" wire:click="createOrUpdate" wire:loading.attr="disabled">
                {{ __('Add Product') }}
            </x-jet-danger-button>
            @endif

        </x-slot>
    </x-jet-dialog-modal>

    <!-- Show Delete Modal -->
    <x-jet-dialog-modal wire:model="confirmDeleteModal">
        <x-slot name="title">
            {{ __('Delete Product') }}
        </x-slot>

        <x-slot name="content">
            {{ __('Are you sure you want to delete this Product data ? Once your data is deleted, all of its resources and data will be permanently deleted.') }}
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$toggle('confirmDeleteModal')">
                {{ __('Cancel') }}
            </x-jet-secondary-button>

            <x-jet-danger-button class="ml-2" wire:click="delete" wire:loading.attr="disabled">
                {{ __('Delete') }}
            </x-jet-danger-button>

        </x-slot>
    </x-jet-dialog-modal>
</div>