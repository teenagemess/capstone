<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ $category->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                    <div class="mb-6">
            <form method="GET" action="{{ route('frontend.categories.show', $category) }}">
                <div class="flex items-center">
                    <input
                        type="text"
                        name="search"
                        placeholder="Search by title..."
                        value="{{ request('search') }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-800 dark:text-gray-200 dark:border-gray-700"
                    >
                    <button type="submit" class="px-4 py-2 ml-2 text-white bg-blue-600 rounded-md hover:bg-blue-700">
                        Search
                    </button>
                </div>
            </form>
        </div>
            <!-- Menampilkan Pesan Jika Tidak Ada Todos -->
            @if ($todos->isEmpty())
                <p class="text-center text-gray-500 dark:text-gray-400">
                    No Modul Pembelajaran found.
                </p>
            @else
                <div class="space-y-6">
                    @foreach ($todos as $todo)
                    <div class="flex w-full overflow-hidden transition duration-300 transform bg-white rounded-lg shadow-lg dark:bg-gray-800 hover:scale-105 hover:shadow-xl" onclick="window.location='{{ route('todo.frontend.detail', $todo) }}';" style="cursor: pointer;">
                        <!-- Thumbnail -->
                        <div class="flex-shrink-0 w-1/3">
                            @if ($todo->image_path)
                            <img class="object-cover w-full h-72" src="{{ Storage::url($todo->image_path) }}" alt="Thumbnail">
                            @else
                            <div class="flex items-center justify-center w-full h-48 bg-gray-200 dark:bg-gray-700">
                                <span class="text-gray-500 dark:text-gray-400">No Thumbnail</span>
                            </div>
                            @endif
                        </div>

                        <!-- Card Content -->
                        <div class="flex flex-col justify-between w-2/3 p-6">

                            <p class="mt-2 text-sm">
                                <span class="inline-block px-4 py-2 text-sm font-bold text-blue-600 border rounded-lg bg-blue-50">
                                    {{ $todo->category->title ?? 'N/A' }}
                                </span>
                                <span class="inline-block px-4 py-2 text-sm font-bold text-green-600 border rounded-lg bg-green-50">
                                    {{ $todo->jenjangCategory->title ?? 'N/A' }}
                                </span>
                            </p>
                            <!-- Title -->

                            <h3 class="text-lg font-bold text-gray-800 dark:text-gray-100 hover:underline">
                                {{ $todo->title }}
                            </h3>

                            <p class="text-gray-600 line-clamp-3 text-ellipsis">{!! $todo->description !!}</p>
                            <!-- Category -->
                            <div class="flex items-center justify-between mt-4 text-sm text-gray-500">
                                <span>Due: {{ \Carbon\Carbon::parse($todo->due_date)->format('d M Y') }}</span>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
