<?php

namespace App\Http\Controllers;

use App\Models\Persyaratan;
use Illuminate\Http\Request;

class PersyaratanController extends Controller
{
    // Display list of persyaratan
   // Display list of persyaratan
public function index()
{
    $persyaratan = Persyaratan::paginate(10); // Adjust the number per page as needed
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
            'jenis_file' => 'required|string|max:255',
            'ukuran' => 'required|integer|min:0',
        ], [
            'nama_persyaratan.required' => 'Nama Persyaratan harus diisi.',
            'nama_persyaratan.string' => 'Nama Persyaratan harus berupa teks.',
            'nama_persyaratan.max' => 'Nama Persyaratan tidak boleh lebih dari 255 karakter.',
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
            'jenis_file' => 'required|string|max:255',
            'ukuran' => 'required|integer|min:0',
        ]);

        $persyaratan = Persyaratan::find($id);
        $persyaratan->update($request->all());

        return redirect()->route('persyaratan.index')->with('success', 'Persyaratan updated successfully.');
    }

    // Delete a persyaratan
    public function destroy($id)
    {
        Persyaratan::find($id)->delete();
        return redirect()->route('persyaratan.index')->with('success', 'Persyaratan deleted successfully.');
    }
}
