<?php

namespace App\Http\Controllers;

use App\Models\Pengumuman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PengumumanController extends Controller
{
    public function index(){
        $pengumumans = Pengumuman::latest()->get();
        return view ('users.pengumuman', compact('pengumumans'));
    }

    public function index2(){
        $pengumumans = Pengumuman::paginate(10);
        return view ('admin.pengumuman.index', compact('pengumumans'));
    }

    public function create() {
        return view ('admin.pengumuman.create');
    }

    public function store(Request $request)
    {
        // Validasi input
        $validatedData = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'tanggal' => 'required|date',
            'file' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048', // Sesuaikan dengan jenis file dan ukuran
        ]);

        // Proses upload file
        if ($request->hasFile('file')) {
            $fileName = time() . '_' . $request->file->getClientOriginalName();
            $filePath = $request->file('file')->storeAs('pengumuman', $fileName, 'public');
        }

        // Simpan data ke database
        Pengumuman::create([
            'judul' => $validatedData['judul'],
            'deskripsi' => $validatedData['deskripsi'],
            'tanggal' => $validatedData['tanggal'],
            'file_path' => $filePath, // Simpan path file
        ]);

        return redirect()->route('pengumuman.index')->with('success', 'Pengumuman berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $pengumuman = Pengumuman::findOrFail($id);
        return view('admin.pengumuman.edit', compact('pengumuman'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'tanggal' => 'required|date',
            'file' => 'nullable|file|max:2048', // Sesuaikan batas ukuran file
        ]);

        $pengumuman = Pengumuman::findOrFail($id);
        $pengumuman->judul = $request->judul;
        $pengumuman->deskripsi = $request->deskripsi;
        $pengumuman->tanggal = $request->tanggal;

        // Jika ada file yang diupload
        if ($request->hasFile('file')) {
            // Hapus file lama jika perlu
            // $pengumuman->file_path dapat diganti sesuai dengan kolom yang Anda gunakan untuk menyimpan path file

            $path = $request->file('file')->store('uploads', 'public'); // Menyimpan file ke storage/app/public/uploads
            $pengumuman->file_path = $path; // Simpan path baru ke database
        }

        $pengumuman->save();

        return redirect()->route('pengumuman.index')->with('success', 'Pengumuman berhasil diperbarui.');
    }

    public function destroy($id)
    {
        // Cari pengumuman berdasarkan ID
        $pengumuman = Pengumuman::findOrFail($id);

        // Hapus file dari storage
        if ($pengumuman->file_path) {
            Storage::disk('public')->delete($pengumuman->file_path);
        }

        // Hapus pengumuman dari database
        $pengumuman->delete();

        return redirect()->route('pengumuman.index')->with('success', 'Pengumuman berhasil dihapus!');
    }



}
