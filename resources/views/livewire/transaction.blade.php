<div class="p-6">
    <!-- Datatables -->
    <div class="flex flex-col">
        <div class="my-2 overflow-x-auto sm:mx-6 lg:mx-8">
            <div class="py-2 align-middle inline-block w-full sm:px-6 lg:px-8">
                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                    <table class="w-full divide-y divide-gray-200">
                        <thead>
                            <tr>
                                <th class="px-6 py-3 bg-gray-100 text-center text-sm leading-4 font-medium text-gray-500 upercase tracking-wider">Customer</th>
                                <th class="px-6 py-3 bg-gray-100 text-center text-sm leading-4 font-medium text-gray-500 upercase tracking-wider">Address</th>
                                <th class="px-6 py-3 bg-gray-100 text-center text-sm leading-4 font-medium text-gray-500 upercase tracking-wider">Total Price</th>
                                <th class="px-6 py-3 bg-gray-100 text-center text-sm leading-4 font-medium text-gray-500 upercase tracking-wider">Shipping Price</th>
                                <th class="px-6 py-3 bg-gray-100 text-center text-sm leading-4 font-medium text-gray-500 upercase tracking-wider">Payment Method</th>
                                <th class="px-6 py-3 bg-gray-100 text-center text-sm leading-4 font-medium text-gray-500 upercase tracking-wider">Status</th>
                                <th class="px-6 py-3 bg-gray-100 text-center text-sm leading-4 font-medium text-gray-500 upercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="items-center bg-white divide-y divide-gray-200">
                            @if ($data->count())
                            @foreach ($data as $item)
                            <tr>
                                <td class="px-6 py-4 text-center text-base whitespace-no-wrap">{{ $item->user->name }}</td>
                                <td class="px-6 py-4 text-center text-base whitespace-no-wrap">{{ $item->address }}</td>
                                <td class="px-6 py-4 text-center text-base whitespace-no-wrap">{{ $item->total_price }}</td>
                                <td class="px-6 py-4 text-center text-base whitespace-no-wrap">{{ $item->shipping_price }}</td>
                                <td class="px-6 py-4 text-center text-base whitespace-no-wrap">{{ $item->payment }}</td>
                                <td class="px-6 py-4 text-center text-base whitespace-no-wrap">{{ $item->status }}</td>
                                <td class="flex px-6 py-5 text-center">
                                    <div class="flex ml-1 cursor-pointer" wire:click="showDetailModal({{ $item->id }})">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="text-blue-700 h-6 w-6" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                                            <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    @if($item->status != 'SHIPPED' && $item->status != 'CANCELLED')
                                    <div class="flex ml-1 cursor-pointer" wire:click="updateModal({{ $item->id }})">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="text-orange-400 h-6 w-6" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" />
                                            <path fill-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <div class="flex ml-1 cursor-pointer" wire:click="showCancelTransaction({{ $item->id }})" wire:loading.attr="disabled">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="text-red-600 h-6 w-6" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    @else
                                    <div class="flex ml-1" wire:click="">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="text-gray-700 h-6 w-6" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" />
                                            <path fill-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <div class="flex ml-1" wire:click="" wire:loading.attr="disabled">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="text-gray-700 h-6 w-6" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    @endif
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
    <x-jet-dialog-modal wire:model="detailModalForm">
        <x-slot name="title">
            {{ __('Detail Transaction') }}
        </x-slot>

        <x-slot name="content">
            <div class="flex" style="margin-left:-30px">
                <div class="flex items-center px-1 py-3 text-right sm:px-6">
                    <x-jet-label for="username" value="{{ __('Customer') }}" />
                    <x-jet-input type="text" class="mt-1 ml-3 block w-1/2" wire:model="username" readonly />
                </div>
                <div class="flex items-center px-1 py-3 text-right sm:px-6">
                    <x-jet-label for="address" value="{{ __('Address') }}" />
                    <x-jet-input type="text" class="mt-1 ml-3 block w-1/2" wire:model="address" readonly />
                </div>
            </div>
            <div class="flex" style="margin-left:-30px">
                <div class="flex items-center px-1 py-3 text-right sm:px-6">
                    <x-jet-label for="shippingPrice" value="{{ __('Shipping Price') }}" />
                    <x-jet-input type="text" class="mt-1 ml-3 block w-1/2" wire:model="shippingPrice" readonly />
                </div>
                <div class="flex items-center px-1 py-3 text-right sm:px-6">
                    <x-jet-label for="totalPrice" value="{{ __('Total Price') }}" />
                    <x-jet-input type="text" class="mt-1 ml-3 block w-1/2" wire:model="totalPrice" readonly />
                </div>
            </div>
            <div class="flex" style="margin-left:-30px">
                <div class="flex items-center px-1 py-3 text-right sm:px-6">
                    <x-jet-label for="payment" value="{{ __('Payment') }}" />
                    <x-jet-input type="text" class="mt-1 ml-3 block w-1/2" wire:model="payment" readonly />
                </div>
                <div class="flex items-center px-1 py-3 text-right sm:px-6">
                    <x-jet-label for="status" value="{{ __('Status') }}" />
                    <x-jet-input type="text" class="mt-1 ml-3 block w-1/2" wire:model="status" readonly />
                </div>
            </div>
            <div class="mt-4">
                <table class="w-full divide-y divide-gray-200">
                    <thead>
                        <tr>
                            <th class="px-6 py-3 bg-gray-100 text-center text-sm leading-4 font-medium text-gray-500 upercase tracking-wider">Products</th>
                            <th class="px-6 py-3 bg-gray-100 text-center text-sm leading-4 font-medium text-gray-500 upercase tracking-wider">Price</th>
                            <th class="px-6 py-3 bg-gray-100 text-center text-sm leading-4 font-medium text-gray-500 upercase tracking-wider">Quantity</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($items as $i)
                        <tr>
                            <td class="px-6 py-4 text-center text-base whitespace-no-wrap">{{ $i->product->name }}</td>
                            <td class="px-6 py-4 text-center text-base whitespace-no-wrap">{{ $i->product->price }}</td>
                            <td class="px-6 py-4 text-center text-base whitespace-no-wrap">{{ $i->quantity }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$toggle('detailModalForm')">
                {{ __('Cancel') }}
            </x-jet-secondary-button>
        </x-slot>
    </x-jet-dialog-modal>

    <!-- Update Status Transaction Modal -->
    <x-jet-dialog-modal wire:model="visibleModalStatus">
        <x-slot name="title">
            {{ __('Update Status Transaction') }}
        </x-slot>

        <x-slot name="content">
            {{ __('Are you sure you want to update status this Transaction ?') }}
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$toggle('visibleModalStatus')">
                {{ __('Cancel') }}
            </x-jet-secondary-button>
            <x-jet-danger-button class="ml-2" wire:click="createOrUpdate" wire:loading.attr="disabled">
                {{ __('Update Status') }}
            </x-jet-danger-button>

        </x-slot>
    </x-jet-dialog-modal>

    <!-- Show Delete Modal -->
    <x-jet-dialog-modal wire:model="confirmCancelTransaction">
        <x-slot name="title">
            {{ __('Delete Transaction') }}
        </x-slot>

        <x-slot name="content">
            {{ __('Are you sure you want to CANCEL this Transaction ?') }}
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$toggle('confirmCancelTransaction')">
                {{ __('Cancel') }}
            </x-jet-secondary-button>
            <x-jet-danger-button class="ml-2" wire:click="cancelTransaction" wire:loading.attr="disabled">
                {{ __('Cancel Transaction') }}
            </x-jet-danger-button>

        </x-slot>
    </x-jet-dialog-modal>
</div>