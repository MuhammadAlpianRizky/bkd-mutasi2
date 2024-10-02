<?php

namespace App\Http\Controllers;

use App\Models\Persyaratan;
use Illuminate\Http\Request;
use App\Models\UploadPersyaratan;

class PersyaratanController extends Controller
{
    // Display list of persyaratan
   // Display list of persyaratan
public function index()
{
       $persyaratan = Persyaratan::paginate(10); // Only show active persyaratan
    return view('admin.persyaratan.index', compact('persyaratan'));
}


    // Show form to create a new persyaratan
    public function create()
    {
        return view('admin.persyaratan.create');
    }

    // Store a new persyaratan
    public function store(Request $request)
    {
        $request->validate([
            'nama_persyaratan' => 'required|string|max:255',
            'kode_persyaratan'=> 'required',
            'jenis_file' => 'required|string|max:255',
            'ukuran' => 'required|integer|min:0',
        ], [
            'nama_persyaratan.required' => 'Nama Persyaratan harus diisi.',
            'nama_persyaratan.string' => 'Nama Persyaratan harus berupa teks.',
            'nama_persyaratan.max' => 'Nama Persyaratan tidak boleh lebih dari 255 karakter.',
            'kode_persyaratan.required' => 'Kode Persyaratan harus diisi.',
            'jenis_file.required' => 'Jenis File harus diisi.',
            'jenis_file.string' => 'Jenis File harus berupa teks.',
            'jenis_file.max' => 'Jenis File tidak boleh lebih dari 255 karakter.',
            'ukuran.required' => 'Ukuran harus diisi.',
            'ukuran.integer' => 'Ukuran harus berupa angka.',
            'ukuran.min' => 'Ukuran tidak boleh kurang dari 0.',
        ]);

        Persyaratan::create($request->all());

        return redirect()->route('persyaratan.index')->with('success', 'Persyaratan created successfully.');
    }

    // Show the form for editing an existing persyaratan
    public function edit($id)
    {
        $persyaratan = Persyaratan::find($id);
        return view('admin.persyaratan.edit', compact('persyaratan'));
    }

    // Update an existing persyaratan
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_persyaratan' => 'required|string|max:255',
            'kode_persyaratan'=> 'required',
            'jenis_file' => 'required|string|max:255',
            'ukuran' => 'required|integer|min:0',
            'status' => 'required|boolean',
        ]);

        $persyaratan = Persyaratan::find($id);
        $persyaratan->update($request->all());

        return redirect()->route('persyaratan.index')->with('success', 'Persyaratan updated successfully.');
    }

    // Delete a persyaratan
    public function destroy($id)
{
    // Find the persyaratan entry by ID
    $persyaratan = Persyaratan::findOrFail($id);

    // Check if the persyaratan is referenced in UploadPersyaratan
    if (UploadPersyaratan::where('persyaratan_id', $id)->exists()) {
        // Redirect with an error message if the persyaratan is referenced
        return redirect()->route('persyaratan.index')
            ->with('error', 'Persyaratan tidak dapat dihapus karena telah digunakan.');
    }

    // Proceed with deletion if no references exist
    $persyaratan->delete();

    // Redirect with a success message after deletion
    return redirect()->route('persyaratan.index')
        ->with('success', 'Persyaratan berhasil dihapus.');
}
}
