<!-- <div class="max-w-6xl mx-auto sm:px-6 lg:px-8 mt-10">
    <div class="container flex justify-center mx-auto">
        <div class="flex flex-col">
            <div class="w-full">
                <div class="border-b border-gray-200">
                    <x-jet-button wire:click="showModal()">
                        {{ __('Create') }}
                    </x-jet-button>
                    <br>
                    @if($isOpen)
                    @include('livewire.Category.create')
                    @endif

                    <table class="divide-y divide-gray-300 mt-2">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-2 text-base text-gray-500">
                                    No
                                </th>
                                <th class="px-6 py-2 text-base text-gray-500">
                                    Name
                                </th>
                                <th class="px-6 py-2 text-base text-gray-500">
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-300">
                            @foreach($category as $cat)
                            <tr class="whitespace-nowrap">
                                <td class="px-6 py-4 text-lg text-gray-500">
                                    {{ $cat->id }}
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-lg text-gray-900">
                                        {{ $cat->name }}
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <x-jet-button wire:click="edit( {{$cat->id}} )" wire:loading.attr="disabled">
                                        {{ __('Edit') }}
                                    </x-jet-button>
                                    <x-jet-danger-button wire:click="delete( {{$cat->id}} )" wire:loading.attr="disabled">
                                        {{ __('Delete') }}
                                    </x-jet-danger-button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{ $category->links() }}
            </div>
        </div>
    </div>


    <div class="flex justify-center mt-4 sm:items-center sm:justify-between">
        <div class="text-center text-sm text-gray-500 sm:text-left">
            <div class="flex items-center">
                <svg fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor" class="-mt-px w-5 h-5 text-gray-400">
                    <path d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                </svg>

                <a href="https://laravel.bigcartel.com" class="ml-1 underline">
                    Shop
                </a>

                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="ml-4 -mt-px w-5 h-5 text-gray-400">
                    <path d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                </svg>

                <a href="https://github.com/sponsors/taylorotwell" class="ml-1 underline">
                    Sponsor
                </a>
            </div>
        </div>

        <div class="ml-4 text-center text-sm text-gray-500 sm:text-right sm:ml-0">
            Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})
        </div>
    </div>
</div> -->
@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/1.9.2/tailwind.min.css" integrity="sha512-l7qZAq1JcXdHei6h2z8h8sMe3NbMrmowhOl+QkP3UhifPpCW2MC4M0i26Y8wYpbz1xD9t61MLT9L1N773dzlOA==" crossorigin="anonymous" />
@endpush
<div>
    <div class="card">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-2">
            <h1 class="h3 mb-0 ml-4 mt-3 text-gray-800">Data Kategori</h1>
            <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
        </div>

        <!-- Content Row -->
        <div class="card-body">
            <livewire:datatable model="App\Models\ProductCategory" searchable="name" include="name, created_at, updated_at" exportable />

        </div>
    </div>
</div>