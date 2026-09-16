<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Category') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <form
                    method="POST"
                    action="{{ route('admin.categories.update', $category->id) }}"
                    enctype="multipart/form-data"
                >
                    @csrf
                    @method('PUT')

                    <!-- Name -->
                    <div>
                        <x-input-label
                            for="name"
                            :value="__('Name')"
                        />

                        <x-text-input
                            id="name"
                            class="block mt-1 w-full"
                            type="text"
                            name="name"
                            :value="old('name', $category->name)"
                            required
                            autofocus
                        />

                        <x-input-error
                            :messages="$errors->get('name')"
                            class="mt-2"
                        />
                    </div>
                    {{-- Image --}}
                    <div class="mt-4">
                        <x-input-label
                            for="image"
                            :value="__('Image')"
                        />

                        @if ($category->image)
                            <img
                                src="{{ asset('storage/' . $category->image) }}"
                                alt="{{ $category->name }}"
                                class="mt-2 w-32 h-20 object-cover rounded"
                            >
                        @endif

                        <input
                            id="image"
                            type="file"
                            name="image"
                            class="block mt-2 w-full text-sm text-gray-900 border border-gray-300 rounded-md cursor-pointer"
                        />

                        <x-input-error
                            :messages="$errors->get('image')"
                            class="mt-2"
                        />
                    </div>

                    <!-- Short Description -->
                    <div class="mt-4">
                        <x-input-label
                            for="short_description"
                            :value="__('Short Description')"
                        />

                        <x-text-input
                            id="short_description"
                            class="block mt-1 w-full"
                            type="text"
                            name="short_description"
                            :value="old('short_description', $category->short_description)"
                        />

                        <x-input-error
                            :messages="$errors->get('short_description')"
                            class="mt-2"
                        />
                    </div>

                    <!-- Long Description -->
                    <div class="mt-4">
                        <x-input-label
                            for="description"
                            :value="__('Long Description')"
                        />

                        <div id="description-editor" class="mt-1"></div>

                        <input
                            class="ql-editor"
                            type="hidden"
                            name="description"
                            id="description"
                            value="{{ old('description', $category->description ?? '') }}"
                        >

                        <x-input-error
                            :messages="$errors->get('description')"
                            class="mt-2"
                        />
                    </div>

                    <div class="flex items-center justify-between mt-4">
                        <a
                            href="{{ route('admin.categories.index') }}"
                            class="text-sm text-gray-600 hover:text-gray-900 underline"
                        >
                            {{ __('Cancel') }}
                        </a>

                        <x-primary-button class="ms-4">
                            {{ __('Update') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
