<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index()
    {
        $admins = Admin::all();
        $totalAdmins = Admin::count();
        $activeAdmins = Admin::where('is_active', true)->count();
        
        return view('admin.kelola-admin', compact('admins', 'totalAdmins', 'activeAdmins'));
    }

    public function create()
    {
        return view('admin.create-admin');
    }

    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255|unique:admins',
            'password' => 'required|string|min:6',
            'email' => 'nullable|email|unique:admins',
            'full_name' => 'nullable|string|max:255',
        ]);

        Admin::create([
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'email' => $request->email,
            'full_name' => $request->full_name,
            'is_active' => true,
            'last_login' => null,
        ]);

        return redirect()->route('admin.kelola-admin')->with('success', 'Admin berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $admin = Admin::findOrFail($id);
        return view('admin.edit-admin', compact('admin'));
    }

    public function update(Request $request, $id)
    {
        $admin = Admin::findOrFail($id);
        
        $request->validate([
            'username' => 'required|string|max:255|unique:admins,username,' . $id,
            'email' => 'nullable|email|unique:admins,email,' . $id,
            'full_name' => 'nullable|string|max:255',
            'is_active' => 'boolean',
        ]);

        $updateData = [
            'username' => $request->username,
            'email' => $request->email,
            'full_name' => $request->full_name,
            'is_active' => $request->has('is_active'),
        ];

        if ($request->filled('password')) {
            $updateData['password'] = Hash::make($request->password);
        }

        $admin->update($updateData);

        return redirect()->route('admin.kelola-admin')->with('success', 'Admin berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $admin = Admin::findOrFail($id);
        
        // Jangan hapus admin yang sedang login
        if ($admin->id == Auth::guard('admin')->id()) {
            return redirect()->route('admin.kelola-admin')->with('error', 'Tidak dapat menghapus admin yang sedang login!');
        }

        $admin->delete();

        return redirect()->route('admin.kelola-admin')->with('success', 'Admin berhasil dihapus!');
    }

    public function toggleStatus($id)
    {
        $admin = Admin::findOrFail($id);
        
        // Jangan nonaktifkan admin yang sedang login
        if ($admin->id == Auth::guard('admin')->id()) {
            return redirect()->route('admin.kelola-admin')->with('error', 'Tidak dapat menonaktifkan admin yang sedang login!');
        }

        $admin->update(['is_active' => !$admin->is_active]);

        $status = $admin->is_active ? 'diaktifkan' : 'dinonaktifkan';
        return redirect()->route('admin.kelola-admin')->with('success', "Admin berhasil {$status}!");
    }
}
