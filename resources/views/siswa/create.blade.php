<x-app-layout>

    <head>
            <!-- Flatpickr CSS -->
        <link href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css" rel="stylesheet">

        <!-- Flatpickr JS -->
        <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    </head>

    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Create Siswa') }}
        </h2>
    </x-slot>

    <div class="sm:py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white dark:bg-gray-800 sm:shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="post" action="{{ route('siswa.store') }}" class="">
                        @csrf
                        @method('post')

                        <div class="mb-6">
                            <x-input-label for="nama_siswa" :value="__('Nama Siswa')" />
                            <x-text-input id="nama_siswa" name="nama_siswa" type="text" class="block w-full mt-1" required
                                autofocus autocomplete="nama_siswa" :value="old('nama_siswa')" />
                            <x-input-error class="mt-2" :messages="$errors->get('nama_siswa')" />
                        </div>

                        <div class="mb-6">
                            <x-input-label for="tanggal_lahir" :value="__('Tanggal Lahir')" />
                            <x-text-input id="tanggal_lahir" name="tanggal_lahir" type="text" class="block w-full mt-1 datepicker" required
                                :value="old('tanggal_lahir')" />
                            <x-input-error class="mt-2" :messages="$errors->get('tanggal_lahir')" />
                        </div>

                        <div class="mb-6">
                            <x-input-label for="alamat" :value="__('Alamat')" />
                            <x-text-input id="alamat" name="alamat" type="text" class="block w-full mt-1" required
                                :value="old('alamat')" />
                            <x-input-error class="mt-2" :messages="$errors->get('alamat')" />
                        </div>

                        <div class="mb-6">
                            <x-input-label for="no_hp" :value="__('No. HP')" />
                            <x-text-input id="no_hp" name="no_hp" type="text" class="block w-full mt-1" required
                                :value="old('no_hp')" />
                            <x-input-error class="mt-2" :messages="$errors->get('no_hp')" />
                        </div>

                        <div class="mb-6">
                            <x-input-label for="email" :value="__('Email')" />
                            <x-text-input id="email" name="email" type="email" class="block w-full mt-1" required
                                :value="old('email')" />
                            <x-input-error class="mt-2" :messages="$errors->get('email')" />
                        </div>

                        <div class="mb-6">
                            <x-input-label for="tanggal_masuk" :value="__('Tanggal Masuk')" />
                            <x-text-input id="tanggal_masuk" name="tanggal_masuk" type="text" class="block w-full mt-1 datepicker" required
                                :value="old('tanggal_masuk')" />
                            <x-input-error class="mt-2" :messages="$errors->get('tanggal_masuk')" />
                        </div>

                        <div class="mb-6">
                            <x-input-label for="tanggal_keluar" :value="__('Tanggal Keluar')" />
                            <x-text-input id="tanggal_keluar" name="tanggal_keluar" type="text" class="block w-full mt-1 datepicker"
                                :value="old('tanggal_keluar')" />
                            <x-input-error class="mt-2" :messages="$errors->get('tanggal_keluar')" />
                        </div>

                        <div class="flex items-center gap-4">
                            <x-primary-button>{{ __('Save') }}</x-primary-button>
                            <x-cancel-button href="{{ route('siswa.index') }}" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Initialize flatpickr
        flatpickr(".datepicker", {
            dateFormat: "Y-m-d", // Format tanggal
        });
    </script>
</x-app-layout>
