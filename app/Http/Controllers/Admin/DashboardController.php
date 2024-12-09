<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Item;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index()
    {
        return Inertia::render('Admin/Item/Grid', [
            'items' => Item::orderByDesc('id')->get()->append('cover')->load(['vehicle', 'province'])
        ]);
    }
}
