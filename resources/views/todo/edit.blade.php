<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Edit Todo') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('todo.update', $todo) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')

                        <!-- Title Field -->
                        <div class="mb-6">
                            <x-input-label for="title" :value="__('Judul Modul')" />
                            <x-text-input id="title" name="title" type="text" class="block w-full mt-1"
                                :value="old('title', $todo->title)" required autofocus autocomplete="title" />
                            <x-input-error class="mt-2" :messages="$errors->get('title')" />
                        </div>

                        <!-- Category Field -->
                        <div class="mb-6">
                            <x-input-label for="category_id" :value="__('Kategori Modul')" />
                            <x-select id="category_id" name="category_id" class="block w-full mt-1">
                                <option value="">-- Pilih Kategori --</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ old('category_id', $todo->category_id) == $category->id ? 'selected' : '' }}>
                                        {{ $category->title }}
                                    </option>
                                @endforeach
                            </x-select>
                            <x-input-error class="mt-2" :messages="$errors->get('category_id')" />
                        </div>

                        <!-- Jenjang Category Field -->
                        <div class="mb-6">
                            <x-input-label for="jenjang_category_id" :value="__('Jenjang Category')" />
                            <x-select name="jenjang_category_id" id="jenjang_category_id" class="block w-full mt-1" required>
                                <option value="">Select Jenjang Category</option>
                                @foreach($jenjangCategories as $jenjang_category)
                                    <option value="{{ $jenjang_category->id }}"
                                        {{ old('jenjang_category_id', $todo->jenjang_category_id) == $jenjang_category->id ? 'selected' : '' }}>
                                        {{ $jenjang_category->title }}
                                    </option>
                                @endforeach
                            </x-select>
                            <x-input-error class="mt-2" :messages="$errors->get('jenjang_category_id')" />
                        </div>

                        <!-- Description Field with Trix Editor -->
                        <div class="mb-6">
                            <x-input-label for="description" :value="__('Description')" />
                            <trix-toolbar id="my_toolbar" input="description" class="bg-gray-100 dark:bg-gray-100 border-gray-700 dark:border-gray-300 rounded-md;"></trix-toolbar>
                            <input id="description" type="hidden" name="description" value="{{ old('description', $todo->description) }}">
                            <trix-editor toolbar="my_toolbar" input="description" class="text-gray-900 dark:text-gray-900 bg-gray-100 dark:bg-gray-100 border-gray-700 dark:border-gray-300 rounded-md;"></trix-editor>
                            <x-input-error class="mt-2" :messages="$errors->get('description')" />
                        </div>

                        <!-- YouTube URL Field -->
                        <div class="mb-6">
                            <x-input-label for="youtube_video_url" :value="__('YouTube Video URL')" />
                            <x-text-input id="youtube_video_url" name="youtube_video_url" type="text" class="w-full"
                                :value="old('youtube_video_url', $todo->youtube_video_url)" />
                            <x-input-error class="mt-2" :messages="$errors->get('youtube_video_url')" />
                        </div>

                        <!-- Upload Thumbnail -->
                        <div class="mb-6">
                            <x-input-label for="image_path" :value="__('Upload Thumbnail')" />
                            <x-text-input id="image_path" name="image_path" type="file" class="w-full" />
                            <x-input-error class="mt-2" :messages="$errors->get('image_path')" />
                        </div>

                        <!-- Upload File (PDF only) -->
                        <div class="mb-6">
                            <x-input-label for="file_path" :value="__('Upload File (PDF only)')" />
                            <x-text-input id="file_path" name="file_path" type="file" class="block w-full mt-1" />
                            <x-input-error class="mt-2" :messages="$errors->get('file_path')" />
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex items-center gap-4">
                            <x-primary-button>{{ __('Save Changes') }}</x-primary-button>
                            <x-cancel-button href="{{ route('todo.index') }}" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("trix-before-initialize", () => {
            // Custom initialization code if needed
        });
    </script>
</x-app-layout>
