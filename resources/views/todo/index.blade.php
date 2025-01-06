<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Modul Pembelajaran') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
                <div class="p-6 text-xl text-gray-900 dark:text-gray-100">
                    <div class="flex items-center justify-between">
                        <div>
                            <x-create-button href="{{ route('todo.create') }}" />
                        </div>



                        <div>
                            @if (session('success'))
                            <p x-data="{ show: true }" x-show="show" x-transition
                                x-init="setTimeout(() => show = false, 5000)"
                                class="text-sm text-green-600 dark:text-green-400">{{ session('success') }}
                            </p>
                            @endif
                            @if (session('danger'))
                            <p x-data="{ show: true }" x-show="show" x-transition
                                x-init="setTimeout(() => show = false, 5000)"
                                class="text-sm text-red-600 dark:text-red-400">{{ session('danger') }}
                            </p>
                            @endif
                        </div>

                        <!-- Form Pencarian -->
                        <form action="{{ route('todo.index') }}" method="GET" class="flex items-center gap-2 ml-2">
                            <x-text-input id="search" name="search" type="text" class="w-full"
                                placeholder="Search by title" value="{{ request('search') }}" autofocus />
                            <x-primary-button type="submit">
                                {{ __('Search') }}
                            </x-primary-button>
                        </form>
                    </div>
                </div>
                <div class="relative overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    Judul
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Mata Pelajaran
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Jenjang
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Description
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Thumbnail
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    File
                                </th>
                                <th scope="col" class="px-6 py-3 text-center">
                                    Video Modul
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($todos as $todo)
                            <tr class="odd:bg-white odd:dark:bg-gray-800 even:bg-gray-50 even:dark:bg-gray-700">
                                <td scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                                    <a href="{{ route('todo.edit', $todo) }}" class="hover:underline">{{ $todo->title }}</a>
                                </td>
                                <td scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                                    @if ($todo->category_id)
                                    {{ $todo->category->title }}
                                    @endif
                                </td>
                                <td scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                                    @if ($todo->jenjang_category_id)
                                    {{ $todo->jenjangCategory->title }}
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    {{ $todo->description ?? 'No description' }}
                                </td>
                                <td class="px-6 py-4">
                                    @if ($todo->image_path)
                                        <img src="{{ Storage::url($todo->image_path) }}" alt="Image" class="object-cover w-20 h-20">
                                    @else
                                        No Thumbnail
                                    @endif
                                </td>

                                <td class="px-6 py-4">
                                    @if ($todo->file_path)
                                    <a href="{{ Storage::url($todo->file_path) }}" class="text-blue-600 dark:text-blue-400" target="_blank">
                                        View File
                                    </a>
                                    @else
                                    No file
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    @if ($todo->youtube_video_url)
                                        @php
                                            // Parsing video ID dari URL YouTube
                                            $youtubeId = null;
                                            if (preg_match('/(?:youtube\.com\/(?:[^\/\n\s]*v=|(?:[^\/\n\s]*\/\S*\?v=))([^"&?\/\s]{11})|youtu\.be\/([^"&?\/\s]{11}))/i', $todo->youtube_video_url, $matches)) {
                                                $youtubeId = $matches[1] ?? $matches[2];
                                            }
                                        @endphp

                                        @if ($youtubeId)
                                            <div class="aspect-w-16 aspect-h-9">
                                                <iframe class="w-full h-full"
                                                        src="https://www.youtube.com/embed/{{ $youtubeId }}"
                                                        frameborder="0"
                                                        allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                                                        allowfullscreen>
                                                </iframe>
                                            </div>
                                        @else
                                            <p class="text-red-600">Invalid YouTube URL</p>
                                        @endif
                                    @else
                                        No video
                                    @endif
                                </td>


                                <td class="px-6 py-4">
                                    <div class="flex space-x-3">
                                        <form action="{{ route('todo.destroy', $todo) }}" method="Post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 dark:text-red-400">
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr class="bg-white dark:bg-gray-800">
                                <td scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white" colspan="6">
                                    Empty
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                {{-- @if ($todosCompleted > 1)
                <div class="p-6 text-xl text-gray-900 dark:text-gray-100">
                    <form action="{{ route('todo.deleteallcompleted') }}" method="Post">
                        @csrf
                        @method('delete')
                        <x-primary-button>
                            Delete All Completed Task
                        </x-primary-button>
                    </form>
                </div>
                @endif --}}
            </div>
        </div>
    </div>
</x-app-layout>
