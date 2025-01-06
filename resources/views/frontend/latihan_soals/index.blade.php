<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Pilih Kategori Latihan Soal') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
                @foreach ($categories as $category)
                <a href="{{ route('frontend.latihan_soals.show', $category) }}"
                   class="block p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                        {{ $category->title }}
                    </h5>
                    <p class="text-sm text-gray-600 dark:text-gray-400">
                        {{ $category->description }} <!-- Optional description -->
                    </p>
                </a>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
