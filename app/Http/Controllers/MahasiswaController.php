<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa; // Pastikan model diimport
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    public function index(request $request)
    {
        $search = $request->input('search');
        if ($search) {
            $mahasiswa = Mahasiswa::where('nama', 'LIKE', "%{$search}%")
                ->orWhere('nim', 'LIKE', "%{$search}%")
                ->orWhere('email', 'LIKE', "%{$search}%")
                ->orWhere('jurusan', 'LIKE', "%{$search}%")
                ->get();
        } else {
            $mahasiswa = Mahasiswa::all();
        }

        return view('mahasiswa.index', compact('mahasiswa'));
    }

    public function create()
    {
        return view('mahasiswa.create'); // Menampilkan form untuk menambah mahasiswa
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nim' => 'required|numeric|digits_between:1,20|unique:mahasiswa,nim',
            'email' => 'required|string|email|max:255|unique:mahasiswa,email',
            'jurusan' => 'required|string|max:255',
        ],
        [
            'nim.numeric' => 'NIM harus menggunakan angka',
            'nim.digits_between' => 'Panjang NIM tidak boleh lebih dari 20 karakter',
            'nim.unique' => 'NIM sudah ada',
            'email.unique' => 'Email sudah ada',

        ]);

        Mahasiswa::create($request->all());
        return redirect()->route('mahasiswa.index')->with('success', 'Mahasiswa berhasil ditambahkan!');
    }

    public function show($id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        return view('mahasiswa.show', compact('mahasiswa'));
    }

    public function edit($id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        return view('mahasiswa.edit', compact('mahasiswa'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nim' => 'required|numeric|digits_between:1,20|unique:mahasiswa,nim,'.$id,
            'email' => 'required|string|email|max:255|unique:mahasiswa,email,'.$id,
            'jurusan' => 'required|string|max:255',
        ],
        [
            'nim.numeric' => 'NIM harus menggunakan angka',
            'nim.digits_between' => 'Panjang NIM tidak boleh lebih dari 20 karakter',
            'nim.unique' => 'NIM sudah ada',
            'email.unique' => 'Email sudah ada',

        ]);

        $mahasiswa = Mahasiswa::findOrFail($id);
        $mahasiswa->update($request->all());
        return redirect()->route('mahasiswa.index')->with('success', 'Mahasiswa berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        $mahasiswa->delete();
        return redirect()->route('mahasiswa.index')->with('success', 'Mahasiswa berhasil dihapus!');
    }
}
