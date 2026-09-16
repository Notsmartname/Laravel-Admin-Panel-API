<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('View Page') }}
            </h2>

            <a
                href="{{ route('admin.pages.edit', $page->id) }}"
                class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150"
            >
                {{ __('Edit') }}
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">

                <!-- Title -->
                <div>
                    <x-input-label :value="__('Title')" />

                    <div class="mt-1 block w-full px-4 py-2 bg-gray-100 border border-gray-300 rounded-md">
                        {{ $page->title }}
                    </div>
                </div>

                <!-- Short Description -->
                <div class="mt-4">
                    <x-input-label :value="__('Short Description')" />

                    <div class="mt-1 block w-full px-4 py-2 bg-gray-100 border border-gray-300 rounded-md">
                        {{ $page->short_description ?: __('No description') }}
                    </div>
                </div>

                <!-- Long Description -->
                <div class="mt-4">
                    <x-input-label :value="__('Long Description')" />

                    <div class="mt-1 w-full min-h-32 px-4 py-2 bg-gray-100 border border-gray-300 rounded-md whitespace-pre-line">
                        {{ $page->description ?: __('No description') }}
                    </div>
                </div>

                <div class="mt-6">
                    <a
                        href="{{ route('admin.pages.index') }}"
                        class="text-sm text-gray-600 hover:text-gray-900 underline"
                    >
                        {{ __('Back to Pages') }}
                    </a>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
