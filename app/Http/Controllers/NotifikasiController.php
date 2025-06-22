<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notifikasi;
use App\Models\User;

class NotifikasiController extends Controller
{
    public function index()
    {
        $notifikasi = Notifikasi::with('user')
            ->where('user_id', auth()->user()->id)
            ->latest()
            ->get();

        return view('notifikasi.index', compact('notifikasi'));
    }
}
