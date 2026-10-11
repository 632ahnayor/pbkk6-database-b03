<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">Input Nilai Proposal</h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl space-y-4 sm:px-6 lg:px-8">
            @if (session('status'))
                <p class="rounded-md bg-green-100 p-4 text-green-800" role="status">{{ session('status') }}</p>
            @endif
            @forelse ($proposals as $proposal)
                <article class="flex flex-wrap items-center justify-between gap-4 rounded-lg bg-white p-6 shadow-sm">
                    <div>
                        <h3 class="font-semibold text-gray-900">{{ $proposal->title }}</h3>
                        <p class="mt-1 text-sm text-gray-600">{{ $proposal->user->name }} · Nilai saat ini: {{ $proposal->grade ?? 'Belum dinilai' }}</p>
                    </div>
                    @can('kelola-nilai')
                        <form method="POST" action="{{ route('admin.grades.update', $proposal) }}" class="flex items-end gap-3">
                            @csrf
                            @method('PATCH')
                            <div>
                                <label for="grade-{{ $proposal->id }}" class="block text-sm font-medium text-gray-700">Nilai (0–100)</label>
                                <input id="grade-{{ $proposal->id }}" name="grade" type="number" min="0" max="100" step="0.01" value="{{ old('grade', $proposal->grade) }}" required class="mt-1 w-32 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            </div>
                            <x-primary-button>Simpan</x-primary-button>
                        </form>
                    @endcan
                </article>
            @empty
                <p class="rounded-lg bg-white p-6 text-gray-600 shadow-sm">Belum ada proposal untuk dinilai.</p>
            @endforelse
        </div>
    </div>
</x-app-layout>
