<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::with('parentRole')->get();
        return view('roles.index', compact('roles'));
    }

    public function create()
    {
        $roles = Role::all();
        return view('roles.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string',
            'no_hp' => 'required|string',
            'email' => 'required|email|unique:roles,email',
            'role_id' => 'required|exists:roles,id'
        ]);

        Role::create($request->all());
        return redirect()->route('roles.index')->with('success', 'Role berhasil ditambahkan');
    }
}
