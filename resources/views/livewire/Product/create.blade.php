<!-- component -->
<div class="fixed z-10 top-0 flex justify-center w-11/12 sm:w-5/6 lg:w-1/2 max-w-2xl items-center bg-gray-200 rounded-tl-lg rounded-tr-lg antialiased">
    <div class="flex flex-col w-screen h-auto mx-auto rounded-lg border border-gray-300 shadow-xl">
        <div class="flex flex-row justify-between p-6 bg-white border-b border-gray-200 rounded-tl-lg rounded-tr-lg">
            <p class="font-semibold text-gray-800">Add a product</p>
            <svg wire:click="hideModal()" class="w-6 h-6 cursor-pointer" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </div>
        <div class="flex flex-col px-2 py-2 bg-gray-50">
            <div class="mt-2">
                <form action="submit">
                    <input type="hidden" wire:model.defer="productId" class="form-control border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                    <div class="px-2 py-2 bg-white sm:p-1">
                        <label class="block font-medium text-sm text-gray-700">
                            Nama Produk
                        </label>
                        <input type="text" wire:model.defer="name" class="form-control border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                    </div>
                    <div class="px-2 py-2 bg-white sm:p-1">
                        <label class="block font-medium text-sm text-gray-700">
                            Harga
                        </label>
                        <input type="text" wire:model.defer="price" class="form-control border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                    </div>
                    <div class="px-2 py-2 bg-white sm:p-1">
                        <label class="block font-medium text-sm text-gray-700">
                            Deskripsi
                        </label>
                        <textarea wire:model.defer="description" class="form-control border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                        </textarea>
                    </div>
                    <div class="px-2 py-2 bg-white sm:p-1">
                        <label class="block font-medium text-sm text-gray-700">
                            Category
                        </label>
                        <select wire:model.defer="category" class="js-example-basic-single form-control border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" name="category">
                            <option disabled>Pilih Kategori</option>
                            @foreach($categories as $cat)
                            <option value={{ $cat->id }}>{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </form>
            </div>
            <div class="flex flex-row items-center justify-between p-5 bg-white border-t border-gray-200 rounded-bl-lg rounded-br-lg">
                <p wire:click="hideModal()" class="font-semibold text-gray-600 cursor-pointer">Cancel</p>
                <button wire:click.prevent="store()" class="px-4 py-2 text-white font-semibold bg-blue-500 rounded">
                    Save
                </button>
            </div>
        </div>
    </div>