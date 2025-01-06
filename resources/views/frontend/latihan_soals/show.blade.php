<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Latihan Soal for Category: ') }} {{ $category->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            @if ($latihanSoals->isEmpty())
                <p class="text-center text-gray-500 dark:text-gray-400">
                    No latihan soal found for this category.
                </p>
            @else
                <div class="space-y-6">
                    @foreach ($latihanSoals as $latihanSoal)
                    <div class="flex w-full overflow-hidden transition duration-300 transform bg-white rounded-lg shadow-lg dark:bg-gray-800 hover:scale-105 hover:shadow-xl" onclick="window.location='{{ route('frontend.latihan_soals.detail', $latihanSoal) }}';" style="cursor: pointer;">
                        <!-- Thumbnail -->
                        <div class="flex-shrink-0 w-1/3">
                            @if ($latihanSoal->image_path)
                            <img class="object-cover w-full h-48" src="{{ Storage::url($latihanSoal->image_path) }}" alt="Thumbnail">
                            @else
                            <div class="flex items-center justify-center w-full h-48 bg-gray-200 dark:bg-gray-700">
                                <span class="text-gray-500 dark:text-gray-400">No Thumbnail</span>
                            </div>
                            @endif
                        </div>

                        <!-- Card Content -->
                        <div class="flex flex-col justify-between w-2/3 p-6">
                            <!-- Title -->
                            <h3 class="text-lg font-bold text-gray-800 dark:text-gray-100 hover:underline">
                                {{ $latihanSoal->title }}
                            </h3>

                            <!-- Category -->
                            <p class="mt-2 text-sm text-gray-600 dark:text-gray-300">
                                Category: <span class="font-medium text-gray-800 dark:text-gray-100">{{ $latihanSoal->category->title ?? 'N/A' }}</span>
                            </p>

                            <!-- Jenjang Category -->
                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-300">
                                Jenjang: <span class="font-medium text-gray-800 dark:text-gray-100">{{ $latihanSoal->jenjangCategory->title ?? 'N/A' }}</span>
                            </p>

                            <div class="flex items-center justify-between mt-4 text-sm text-gray-500">
                                <span class="font-semibold text-gray-700 dark:text-gray-300">
                                    Completed: {{ $latihanSoal->is_complete ? 'Yes' : 'No' }}
                                </span>
                                <span>Created: {{ \Carbon\Carbon::parse($latihanSoal->created_at)->format('d M Y') }}</span>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
