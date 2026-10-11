<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">Ubah Judul Proposal</h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-3xl sm:px-6 lg:px-8">
            <form method="POST" action="{{ route('proposals.update', $proposal) }}" class="space-y-6 rounded-lg bg-white p-6 shadow-sm">
                @csrf
                @method('PATCH')
                <div>
                    <x-input-label for="title" value="Judul proposal" />
                    <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" :value="old('title', $proposal->title)" required autofocus maxlength="255" />
                    <x-input-error :messages="$errors->get('title')" class="mt-2" />
                </div>
                <div class="flex items-center gap-4">
                    <x-primary-button>Simpan perubahan</x-primary-button>
                    <a class="text-sm text-gray-600 underline" href="{{ route('dashboard') }}">Batal</a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
