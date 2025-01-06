<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Latihan Soal Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            <div class="p-6 bg-white rounded-lg shadow-lg dark:bg-gray-800">
                <!-- Thumbnail -->
                @if ($latihanSoal->image_path)
                    <img src="{{ Storage::url($latihanSoal->image_path) }}" alt="Thumbnail" class="w-full h-auto rounded-lg">
                @else
                    <div class="w-full h-64 bg-gray-300 rounded-lg"></div>
                @endif

                <div class="mt-6">
                    <!-- Title and Description -->
                    <h3 class="text-2xl font-semibold text-gray-800 dark:text-gray-200">
                        {{ $latihanSoal->title }}
                    </h3>
                    <p class="mt-2 text-gray-600 dark:text-gray-400">
                        {{ $latihanSoal->description }}
                    </p>

                    <!-- PDF Viewer -->
                    @if ($latihanSoal->file_path)
                        <div class="mt-6">
                            <h4 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Modul Pembelajaran</h4>
                            <iframe class="w-full rounded-lg h-96"
                                    src="{{ Storage::url($latihanSoal->file_path) }}"
                                    frameborder="0">
                            </iframe>
                        </div>
                    @endif

                    <!-- Additional Details -->
                    <div class="mt-4 text-sm text-gray-500 dark:text-gray-400">
                        <p>Kategori: {{ $latihanSoal->category->title ?? 'N/A' }}</p>
                        <p>Jenjang: {{ $latihanSoal->jenjangCategory->title ?? 'N/A' }}</p>
                        <p>Created On: {{ \Carbon\Carbon::parse($latihanSoal->created_at)->format('d M Y') }}</p>
                    </div>

                    <!-- Tombol Back dengan JavaScript -->
                    <div class="mt-2">
                        <button onclick="window.history.back();" class="inline-block px-4 py-2 text-white bg-blue-500 rounded-lg hover:bg-blue-600">
                            {{ __('Back to Previous Page') }}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
