<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Informasi;

class InformasiKontributorController extends Controller
{
    /**
     * Menampilkan halaman Tentang untuk public (tanpa login)
     */
    public function tentang()
    {
        $informasi = Informasi::orderBy('created_at', 'desc')->get();

        return view('tentang', compact('informasi'));
    }

    /**
     * Menampilkan daftar informasi.
     */
    public function index()
    {
        $informasi = Informasi::orderBy('created_at', 'desc')->get();

        // Cek role untuk menentukan view
        if (
            Auth::user()->role === 'kontributor'
        ) {
            return view('kontributor.informasi.index', compact('informasi'));
        } elseif (Auth::user()->role === 'kontributor') {
            return view('kontributor.informasi.index', compact('informasi'));
        }

        // Default ke admin view
        return view('kontributor.informasi.index', compact('informasi'));
    }

    /**
     * Menampilkan form tambah.
     */
    public function create()
    {
        // Cek role untuk menentukan view
        if (Auth::user()->role === 'kontributor') {
            return view('kontributor.informasi.create');
        } elseif (Auth::user()->role === 'kontributor') {
            return view('kontributor.informasi.create');
        }

        return view('kontributor.informasi.create');
    }

    /**
     * Menyimpan informasi baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'tanggal' => 'required|date',
            'email' => 'required|email',
            'nama' => 'required|string',
        ]);

        Informasi::create([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'tanggal' => $request->tanggal,
            'email' => $request->email,
            'nama' => $request->nama,

            // Ambil otomatis dari login
            'role' => Auth::user()->role,
        ]);

        // Redirect sesuai role
        if (Auth::user()->role === 'kontributor') {
            return redirect()->route('kontributor.informasi.index')
                ->with('success', 'Informasi berhasil ditambahkan.');
        } elseif (Auth::user()->role === 'kontributor') {
            return redirect()->route('kontributor.informasi.index')
                ->with('success', 'Informasi berhasil ditambahkan.');
        }

        return redirect()->route('kontributor.informasi.index')
            ->with('success', 'Informasi berhasil ditambahkan.');
    }

    /**
     * Menampilkan form edit.
     */
    public function edit($id)
    {
        $informasi = Informasi::findOrFail($id);

        // Cek role untuk menentukan view
        if (Auth::user()->role === 'kontributor') {
            return view('kontributor.informasi.edit', compact('informasi'));
        } elseif (Auth::user()->role === 'kontributor') {
            return view('kontributor.informasi.edit', compact('informasi'));
        }

        return view('kontributor.informasi.edit', compact('informasi'));
    }

    /**
     * Update data informasi.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'tanggal' => 'required|date',
            'email' => 'required|email',
            'nama' => 'required|string',
        ]);

        $informasi = Informasi::findOrFail($id);

        $informasi->update([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'tanggal' => $request->tanggal,
            'email' => $request->email,
            'nama' => $request->nama,

            // ✔ perbarui role otomatis sesuai login
            'role' => Auth::user()->role,
        ]);

        // Redirect sesuai role
        if (Auth::user()->role === 'kontributor') {
            return redirect()->route('kontributor.informasi.index')
                ->with('success', 'Informasi berhasil diupdate.');
        } elseif (Auth::user()->role === 'kontributor') {
            return redirect()->route('kontributor.kontributor.informasi.index')
                ->with('success', 'Informasi berhasil diupdate.');
        }

        return redirect()->route('kontributor.informasi.index')
            ->with('success', 'Informasi berhasil diupdate.');
    }

    /**
     * Hapus informasi.
     */
    public function destroy($id)
    {
        $informasi = Informasi::findOrFail($id);
        $informasi->delete();

        // Redirect sesuai role
        if (Auth::user()->role === 'kontributor') {
            return redirect()->route('kontributor.informasi.index')
                ->with('success', 'Informasi berhasil dihapus.');
        } elseif (Auth::user()->role === 'kontributor') {
            return redirect()->route('kontributor.informasi.index')
                ->with('success', 'Informasi berhasil dihapus.');
        }

        return redirect()->route('informasi.index')
            ->with('success', 'Informasi berhasil dihapus.');
    }
}
