<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">Tinjau Proposal</h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl space-y-4 sm:px-6 lg:px-8">
            @forelse ($proposals as $proposal)
                <article class="rounded-lg bg-white p-6 shadow-sm">
                    <div class="flex flex-wrap items-start justify-between gap-4">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900">{{ $proposal->title }}</h3>
                            <p class="mt-1 text-sm text-gray-600">Diajukan oleh {{ $proposal->user->name }}</p>
                        </div>
                        @can('kelola-nilai')
                            <a class="text-sm text-indigo-700 underline" href="{{ route('admin.grades.index') }}">Input Nilai</a>
                        @endcan
                    </div>
                    @if ($proposal->description)
                        <p class="mt-4 whitespace-pre-line text-gray-700">{{ $proposal->description }}</p>
                    @endif
                    <p class="mt-3 text-sm text-gray-600">
                        Nilai: {{ $proposal->grade === null ? 'Belum dinilai' : $proposal->grade }}
                    </p>
                </article>
            @empty
                <p class="rounded-lg bg-white p-6 text-gray-600 shadow-sm">Belum ada proposal yang diajukan.</p>
            @endforelse
        </div>
    </div>
</x-app-layout>
