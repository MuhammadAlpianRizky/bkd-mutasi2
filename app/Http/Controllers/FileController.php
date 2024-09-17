<?php

namespace App\Http\Controllers;

use App\Models\Mutasi;
use App\Models\Validasi;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;

class FileController extends Controller
{
    /**
     * Show or download a file.
     *
     * @param  int  $id
     * @param  string  $filename
     * @param  string  $action
     * @return \Illuminate\Http\Response
     */
    public function show($id, $filename, $action = 'view')
    {
        $mutasi = Mutasi::findOrFail($id);

        // Tentukan direktori file berdasarkan field yang sesuai
        $fileFields = [
            'sk_cpns',
            'sk_pns',
            'sk_pangkat_terakhir',
            'sk_jabatan_struktural',
            'sk_jabatan_fungsional'
        ];

        $fileField = null;

        foreach ($fileFields as $field) {
            if (basename($mutasi->$field) === $filename) {
                $fileField = $field;
                break;
            }
        }
        
        if (!$fileField) {
            abort(404, 'File not found.');
        }

        // Ambil path file dari disk 'public'
        $path = 'uploads/' . $fileField . '/' . $filename;

        if (!Storage::disk('public')->exists($path)) {
            abort(404, 'File not found.');
        }

        $fullPath = Storage::disk('public')->path($path);

        if ($action === 'download') {
            return response()->download($fullPath);
        }

        return response()->file($fullPath, [
            'Content-Disposition' => 'inline; filename="' . $filename . '"'
        ]);
    }

    public function cancel(Request $request,$id)
    {
        $mutasi = Mutasi::findOrFail($id);

        // Update status verified
        $mutasi->update([
            'verified' => false,
            'verified_at' => null,
            'is_final' => false,
            'cancellation_reason' => $request->input('cancellation_reason')
        ]);

        return redirect()->route('mutasi.list')->with('status', 'Validasi berhasil dibatalkan.');
    }

    public function validate($id)
    {
        $mutasi = Mutasi::findOrFail($id);
        return view('mutasi.validate', compact('mutasi'));
    }

    // Handle validation action with file validation
    public function updateValidation(Request $request, $id)
{
    // Find the mutasi record by ID
    $mutasi = Mutasi::findOrFail($id);

    if ($request->input('action') === 'validate') {
        // Update the mutasi record
        $mutasi->update([
            'verified' => true,
            'verified_at' => now(),
            'cancellation_reason' => null,
        ]);

        // Update or create a validasi record
        Validasi::updateOrCreate(
            ['mutasi_id' => $id],
            [
                'sk_cpns_verified' => $request->has('sk_cpns_check'),
                'sk_pns_verified' => $request->has('sk_pns_check'),
                'sk_pangkat_terakhir_verified' => $request->has('sk_pangkat_terakhir_check'),
                'sk_jabatan_struktural_verified' => $request->has('sk_jabatan_struktural_check'),
                'sk_jabatan_fungsional_verified' => $request->has('sk_jabatan_fungsional_check'),
            ]
        );

        return redirect()->route('mutasi.list')->with('status', 'Mutasi berhasil divalidasi.');
    }

    return redirect()->route('mutasi.list')->with('error', 'Terjadi kesalahan dalam proses validasi.');
}


    public function list(Request $request)
    {
        $query = Mutasi::query();

        if ($search = $request->input('search')) {
            $query->where('no_registrasi', 'like', "%{$search}%")
                ->orWhere('nama', 'like', "%{$search}%")
                ->orWhere('nip', 'like', "%{$search}%");
        }

        $mutasis = $query->orderBy('verified', 'asc')->orderBy('id', 'desc')->paginate(5);

        return view('mutasi.list', compact('mutasis'));
    }
}
