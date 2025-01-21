<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Latihan Soal Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            <div class="p-6 bg-white rounded-lg shadow-lg dark:bg-gray-800">
                <div class="mt-6">

                    <p class="mt-2 text-sm">
                        <span class="inline-block px-4 py-2 text-sm font-bold text-blue-600 border rounded-lg bg-blue-50">
                            {{ $latihanSoal->category->title ?? 'N/A' }}
                        </span>
                        <span class="inline-block px-4 py-2 text-sm font-bold text-green-600 border rounded-lg bg-green-50">
                            {{ $latihanSoal->jenjangCategory->title ?? 'N/A' }}
                        </span>
                    </p>

                    <!-- Title and Description -->
                    <h3 class="mt-2 mb-5 text-2xl font-semibold text-center text-gray-800 dark:text-gray-200">
                        {{ $latihanSoal->title }}
                    </h3>
                    <p class="mt-2 text-gray-600 dark:text-gray-400">
                        {{ $latihanSoal->description }}
                    </p>

                    @if ($latihanSoal->google_form_url)
                    <iframe src="{{ $latihanSoal->google_form_url }}"
                            frameborder="0"
                            class="w-full" style="height: 700px"></iframe>
                    @endif

                    <!-- PDF Viewer -->
                    @if ($latihanSoal->file_path)
                        <div class="mt-6">
                            <h4 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Modul Pembelajaran</h4>
                            <iframe class="w-full rounded-lg h-156"
                                    src="{{ Storage::url($latihanSoal->file_path) }}"
                                    frameborder="0">
                            </iframe>
                        </div>
                    @endif

                    <!-- Additional Details -->
                    <div class="mt-4 text-sm text-gray-500 dark:text-gray-400">
                        <p>Kategori: {{ $latihanSoal->category->title ?? 'N/A' }}</p>
                        <p>Jenjang: {{ $latihanSoal->jenjangCategory->title ?? 'N/A' }}</p>
                    </div>

                    <!-- Tombol Back dengan JavaScript -->
                    <div class="mt-2">
                        <button onclick="window.history.back();" class="inline-block px-4 py-2 text-white bg-blue-500 rounded-lg hover:bg-blue-600">
                            {{ __('Back to Previous Page') }}
                        </button>
                    </div>
                </div>
            </div>
        <!-- Form untuk menambah komentar -->
        <div class="p-4 mt-6 bg-white rounded-lg shadow-md dark:bg-gray-800">
            <h4 class="mb-4 text-xl font-semibold text-gray-800 dark:text-gray-200">Forum DIskusi</h4>
            <form action="{{ route('comments.store', $latihanSoal->id) }}" method="POST">
                @csrf
                <div class="mb-4">
                    <textarea name="content" rows="4" class="w-full p-3 border border-gray-300 rounded-lg dark:bg-gray-700 dark:text-white dark:border-gray-600" placeholder="Tulis diskusi..."></textarea>
                </div>
                <div class="flex justify-end">
                    <button type="submit" class="inline-block px-6 py-3 text-white transition duration-300 ease-in-out bg-blue-500 rounded-lg hover:bg-blue-600">
                        Kirim
                    </button>
                </div>
            </form>
        </div>

<!-- Menampilkan komentar-komentar -->
<div class="p-4 mt-6 bg-white rounded-lg shadow-md dark:bg-gray-800">
    <h4 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Diskusi</h4>
    @forelse($latihanSoal->comments as $comment)
        <div class="p-4 mt-4 rounded-lg shadow-sm bg-gray-50 dark:bg-gray-700">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <!-- Optional: Avatar -->
                    <img class="w-10 h-10 rounded-full" src="{{ $comment->user->avatar ?? 'https://via.placeholder.com/40' }}" alt="{{ $comment->user->name }}">
                </div>
                <div class="ml-4">
                    <p class="text-sm font-semibold text-gray-800 dark:text-gray-200">{{ $comment->user->name }}</p>
                    <p class="text-xs text-gray-500 dark:text-gray-400">{{ $comment->created_at->diffForHumans() }}</p>
                </div>
            </div>
            <p class="mt-2 text-gray-700 dark:text-gray-300">{{ $comment->content }}</p>

            <!-- Tombol Hapus Komentar -->
            @if ($comment->user_id === Auth::id() || Auth::user()->is_admin)
                <form action="{{ route('comments.destroy', $comment->id) }}" method="POST" class="mt-2">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-red-600 hover:text-red-800">
                        Hapus Komentar
                    </button>
                </form>
            @endif
        </div>
    @empty
        <p class="mt-4 text-gray-500 dark:text-gray-400">Belum ada komentar.</p>
    @endforelse
</div>




</x-app-layout>
