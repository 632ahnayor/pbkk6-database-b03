<?php

namespace App\Http\Controllers;

use App\Models\Proposal;
use Illuminate\View\View;

class AdminController extends Controller
{
    public function __invoke(): View
    {
        return view('admin.index', [
            'proposals' => Proposal::with('user')->latest()->get(),
        ]);
    }
}
