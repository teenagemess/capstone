<div>
    <!-- Simplicity is an acquired taste. - Katharine Gerould -->
</div>
<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Latihan Soal') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('latihan_soal.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-6">
                            <x-input-label for="title" :value="__('Judul Latihan Soal')" />
                            <x-text-input id="title" name="title" type="text" class="block w-full mt-1" required autofocus autocomplete="title" :value="old('title')" />
                            <x-input-error class="mt-2" :messages="$errors->get('title')" />
                        </div>

                        <div class="mb-6">
                            <x-input-label for="category_id" :value="__('Kategori Latihan Soal')" />
                            <x-select id="category_id" name="category_id" class="block w-full mt-1">
                                <option value="">-- Pilih Kategori --</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->title }}
                                    </option>
                                @endforeach
                            </x-select>
                            <x-input-error class="mt-2" :messages="$errors->get('category_id')" />
                        </div>

                        <!-- Input untuk deskripsi -->
                        <div class="mb-6">
                            <x-input-label for="description" :value="__('Deskripsi')" />
                            <x-textarea id="description" name="description" class="block w-full mt-1" rows="4" placeholder="Masukkan deskripsi latihan soal">{{ old('description') }}</x-textarea>
                            <x-input-error class="mt-2" :messages="$errors->get('description')" />
                        </div>

                        <div class="mb-6">
                            <x-text-input id="youtube_video_url" name="youtube_video_url" type="text" class="w-full" placeholder="YouTube Video URL" />
                        </div>

                        <div class="mb-6">
                            <x-input-label for="image_path" :value="__('Upload Thumbnail')" />
                            <x-text-input id="image_path" name="image_path" type="file" class="w-full" />
                            <x-input-error class="mt-2" :messages="$errors->get('file_path')" />
                        </div>

                        <div class="mb-6">
                            <x-input-label for="file_path" :value="__('Upload File (PDF hanya)')" />
                            <x-text-input id="file_path" name="file_path" type="file" class="block w-full mt-1" />
                            <x-input-error class="mt-2" :messages="$errors->get('file_path')" />
                        </div>

                        <div class="flex items-center gap-4">
                            <x-primary-button>{{ __('Simpan') }}</x-primary-button>
                            <x-cancel-button href="{{ route('latihan_soal.index') }}" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
