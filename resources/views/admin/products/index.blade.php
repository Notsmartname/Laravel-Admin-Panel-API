<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Products') }}
            </h2>

            <div class="flex items-center gap-4">
                <x-nav-link href="{{ route('dashboard') }}">
                    {{ __('Cancel') }}
                </x-nav-link>

                <a
                    href="{{ route('admin.products.create') }}"
                    class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150"
                >
                    {{ __('Create Product') }}
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <table class="table-auto w-full">
                    <thead>
                        <tr>
                            <th class="px-4 py-2 text-left">
                                {{ __('Name') }}
                            </th>
                            <th class="px-4 py-2 text-left">
                                {{ __('Actions') }}
                            </th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($products as $product)
                            <tr>
                                <td class="border px-4 py-2">
                                    <a
                                        href="{{ route('admin.products.show', $product->id) }}"
                                        class="text-blue-500 hover:underline"
                                    >
                                        {{ $product->name }}
                                    </a>
                                </td>

                                <td class="border px-4 py-2">
                                    <div class="flex gap-2">
                                        <a
                                            href="{{ route('admin.products.edit', $product->id) }}"
                                            class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150"
                                        >
                                            {{ __('Edit') }}
                                        </a>


                                    <x-danger-button x-data="" x-on:click.prevent="$dispatch('open-modal', 'confirm-product-deletion')" >{{ __('Delete Product') }}</x-danger-button>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td
                                    colspan="2"
                                    class="border px-4 py-6 text-center text-gray-500"
                                >
                                    {{ __('Products not found') }}
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<x-modal name="confirm-product-deletion" focusable>
    <form method="post" action="{{ route('admin.products.destroy', $product->id) }}" class="p-6">
        @csrf
        @method('delete')

        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Are you sure you want to delete this product?') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Once this product is deleted, all of its resources and data will be permanently deleted.') }}
        </p>

        <div class="mt-6 flex justify-end">
            <x-secondary-button x-on:click="$dispatch('close')">
                {{ __('Cancel') }}
            </x-secondary-button>

            <x-danger-button class="ms-3">
                {{ __('Delete Product') }}
            </x-danger-button>
        </div>
    </form>
</x-modal>

</x-app-layout>
