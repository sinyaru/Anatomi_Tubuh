<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class PenggunaController extends Controller
{
    // GET semua user
    public function index()
    {
        return response()->json([
            'status' => true,
            'data' => User::all()
        ]);
    }

    // POST tambah user
    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'role'     => 'required',
            'password' => 'required|min:6'
        ]);

        $user = User::create([
            'name'   => $request->name,
            'email'  => $request->email,
            'role'   => $request->role,
            'status' => $request->status ?? 'aktif',
            'password' => Hash::make($request->password)
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Pengguna berhasil ditambahkan',
            'data' => $user
        ]);
    }

    // GET detail user
    public function show($id)
    {
        $user = User::find($id);

        if (!$user) return response()->json(['status' => false, 'message' => 'User tidak ditemukan'], 404);

        return response()->json(['status' => true, 'data' => $user]);
    }

    // PUT update user
    public function update(Request $request, $id)
    {
        $user = User::find($id);

        if (!$user) return response()->json(['status' => false, 'message' => 'User tidak ditemukan'], 404);

        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'role'  => 'required'
        ]);

        $data = [
            'name'  => $request->name,
            'email' => $request->email,
            'role'  => $request->role
        ];

        if ($request->password) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return response()->json([
            'status' => true,
            'message' => 'Pengguna berhasil diperbarui',
            'data' => $user
        ]);
    }

    // DELETE user
    public function destroy($id)
    {
        $user = User::find($id);

        if (!$user) return response()->json(['status' => false, 'message' => 'User tidak ditemukan'], 404);

        $user->delete();

        return response()->json([
            'status' => true,
            'message' => 'Pengguna berhasil dihapus'
        ]);
    }

    // UPDATE PASSWORD user
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password'     => 'required|min:6|confirmed',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return response()->json([
                'status' => false,
                'message' => 'Password lama tidak cocok'
            ], 400);
        }

        $user->update([
            'password' => Hash::make($request->new_password)
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Password berhasil diperbarui'
        ]);
    }
}
