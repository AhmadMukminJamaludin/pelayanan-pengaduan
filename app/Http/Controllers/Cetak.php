<?php

namespace App\Http\Controllers;

use App\Models\Aduan;
use Illuminate\Http\Request;

class Cetak extends Controller
{
    public function index(Request $request)
    {
        return view('cetak', [
            'aduan' => Aduan::query()
                ->with('responLatest')
                ->when($request->no_tracking, fn ($q) => $q->where('no_tracking', $request->no_tracking))
                ->when($request->nama, fn ($q) => $q->whereHas('createdBy', fn ($que) => $que->where('name', 'LIKE', ["%$request->nama%"])))
                ->latest()
                ->get(),
        ]);
    }
}
