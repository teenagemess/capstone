<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Daftar Siswa') }}
        </h2>
    </x-slot>

    <div class="sm:py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white dark:bg-gray-800 sm:shadow-sm sm:rounded-lg">
                <div class="p-6 text-xl text-gray-900 dark:text-gray-100">
                    <div class="flex items-center justify-between">
                        <div>
                            <x-create-button href="{{ route('siswa.create') }}" />
                        </div>
                        <form action="{{ route('siswa.index') }}" method="GET" class="flex items-center">
                            <input type="text" name="search" placeholder="Cari siswa..."
                                class="w-full p-2 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                value="{{ request('search') }}">
                            <button type="submit"
                                class="px-4 py-2 ml-2 text-white bg-blue-500 rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                Cari
                            </button>
                        </form>
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
                    </div>
                </div>

                <div class="relative overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    Nama Siswa
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Tanggal Lahir
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    No. HP
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Email
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Tanggal Masuk
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Tanggal Keluar
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($siswas as $siswa)
                            <tr class="odd:bg-white odd:dark:bg-gray-800 even:bg-gray-50 even:dark:bg-gray-700">
                                <td scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                                    <a href="{{ route('siswa.edit', $siswa) }}" class="hover:underline">
                                        {{$siswa->nama_siswa}}
                                    </a>
                                </td>
                                <td class="px-6 py-4">
                                    {{ \Carbon\Carbon::parse($siswa->tanggal_lahir)->format('d-m-Y') }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $siswa->no_hp }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $siswa->email }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ \Carbon\Carbon::parse($siswa->tanggal_masuk)->format('d-m-Y') }}
                                </td>
                                <td class="px-6 py-4">
                                    @if ($siswa->tanggal_keluar)
                                        {{ \Carbon\Carbon::parse($siswa->tanggal_keluar)->format('d-m-Y') }}
                                    @else
                                        <span class="text-gray-500">Masih aktif</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex space-x-3">
                                        <form action="{{ route('siswa.destroy', $siswa) }}" method="POST">
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
                                <td colspan="7" class="px-6 py-4 font-medium text-center text-gray-900 dark:text-white">
                                    No data available
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
