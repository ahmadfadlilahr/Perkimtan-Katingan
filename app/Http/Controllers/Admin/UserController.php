<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\Rule; // <-- 1. TAMBAHKAN 'use' STATEMENT INI

class UserController extends Controller
{
    public function index()
    {
        $users = User::latest()->paginate(10);
        return view('admin.pengguna.index', [
            'users' => $users
        ]);
    }

    public function create()
    {
        $roles = Role::pluck('name', 'name');
        return view('admin.pengguna.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => ['required', 'string', 'exists:roles,name'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $user->assignRole($request->role);

        return redirect()->route('dashboard.pengguna.index')->with('success', 'Pengguna baru berhasil ditambahkan!');
    }

    public function show(User $pengguna)
    {
        //
    }

    public function edit(User $pengguna)
    {
        $roles = Role::pluck('name', 'name');
        return view('admin.pengguna.edit', [
            'user' => $pengguna,
            'roles' => $roles
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $pengguna)
    {
        // 2. KODE VALIDASI INI TELAH DIPERBAIKI
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique(User::class)->ignore($pengguna->id)],
            'password' => ['nullable', 'confirmed', Rules\Password::defaults()],
            'role' => ['required', 'string', 'exists:roles,name'],
        ]);

        $pengguna->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        if ($request->filled('password')) {
            $pengguna->update(['password' => Hash::make($request->password)]);
        }

        $pengguna->syncRoles($request->role);

        return redirect()->route('dashboard.pengguna.index')->with('success', 'Data pengguna berhasil diperbarui!');
    }

    public function destroy(User $pengguna)
    {
        if ($pengguna->hasRole('super-admin')) {
            return back()->with('error', 'Tidak dapat menghapus Super Admin.');
        }

        $pengguna->delete();
        return redirect()->route('dashboard.pengguna.index')->with('success', 'Pengguna berhasil dihapus!');
    }

    public function __construct()
{
    $this->middleware('can:kelola pengguna');
}
}
