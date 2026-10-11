<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">Ajukan Proposal Proyek AI</h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-3xl sm:px-6 lg:px-8">
            <form method="POST" action="{{ route('proposals.store') }}" class="space-y-6 rounded-lg bg-white p-6 shadow-sm">
                @csrf
                <div>
                    <x-input-label for="title" value="Judul proposal" />
                    <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" :value="old('title')" required autofocus maxlength="255" />
                    <x-input-error :messages="$errors->get('title')" class="mt-2" />
                </div>
                <div>
                    <x-input-label for="description" value="Deskripsi (opsional)" />
                    <textarea id="description" name="description" rows="5" maxlength="3000" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('description') }}</textarea>
                    <x-input-error :messages="$errors->get('description')" class="mt-2" />
                </div>
                <div class="flex items-center gap-4">
                    <x-primary-button>Simpan proposal</x-primary-button>
                    <a class="text-sm text-gray-600 underline" href="{{ route('dashboard') }}">Kembali</a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
