<?php

namespace App\Http\Controllers;

use App\Models\Proposal;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;

class ProposalController extends Controller
{
    public function create(): View
    {
        return view('proposals.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'min:3', 'max:255'],
            'description' => ['nullable', 'string', 'max:3000'],
        ]);

        $request->user()->proposals()->create($validated);

        return redirect()->route('dashboard')->with('status', 'Proposal berhasil disimpan.');
    }

    public function edit(Proposal $proposal): View
    {
        Gate::authorize('update', $proposal);

        return view('proposals.edit', compact('proposal'));
    }

    public function update(Request $request, Proposal $proposal): RedirectResponse
    {
        Gate::authorize('update', $proposal);

        $validated = $request->validate([
            'title' => ['required', 'string', 'min:3', 'max:255'],
        ]);

        $proposal->update($validated);

        return redirect()->route('dashboard')->with('status', 'Judul proposal berhasil diperbarui.');
    }
}
