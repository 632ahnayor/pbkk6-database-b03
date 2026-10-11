<?php

namespace App\Http\Controllers;

use App\Models\Proposal;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;

class GradeController extends Controller
{
    public function index(): View
    {
        Gate::authorize('kelola-nilai');

        return view('admin.grades', [
            'proposals' => Proposal::with('user')->latest()->get(),
        ]);
    }

    public function update(Request $request, Proposal $proposal): RedirectResponse
    {
        Gate::authorize('kelola-nilai');

        $validated = $request->validate([
            'grade' => ['required', 'numeric', 'between:0,100'],
        ]);

        $proposal->update($validated);

        return redirect()->route('admin.grades.index')->with('status', 'Nilai proposal berhasil disimpan.');
    }
}
