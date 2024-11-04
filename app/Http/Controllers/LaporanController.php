<?php
namespace App\Http\Controllers;

use PDF;
use Excel;
use App\Models\Mutasi;
use App\Models\Persyaratan;
use Illuminate\Http\Request;
use App\Exports\LaporanMutasiExport;
use App\Exports\LaporanMutasi2Export;

class LaporanController extends Controller
{
    public function preview($id)
    {
        // Ambil mutasi berdasarkan ID
        $mutasi = Mutasi::with('uploads', 'persyaratan')->find($id);
    
        if (!$mutasi) {
            return redirect()->route('laporan.perorangan')->with('error', 'Mutasi tidak ditemukan.');
        }
    
        // Ambil semua persyaratan dan uploads untuk mutasi ini
        $persyaratan = Persyaratan::all(); // Ambil semua persyaratan
        $uploads = $mutasi->uploads; // Ambil uploads dari mutasi
    
        return view('laporan.preview', compact('mutasi', 'persyaratan', 'uploads'));
    }
    




    public function exportPDF($id)
{
    $mutasi = Mutasi::with(['uploads', 'persyaratan'])->findOrFail($id);
    $persyaratan = Persyaratan::all(); // Get all persyaratan
    $uploads = $mutasi->uploads; // Get uploads from the mutasi

    $pdf = PDF::loadView('laporan.preview2', compact('mutasi', 'persyaratan', 'uploads')); // Pass all variables

    return $pdf->download('laporan-mutasi-'.$mutasi->nama.'-'.$mutasi->id.'.pdf');
}



public function exportExcel($id)
{
    $mutasi = Mutasi::with(['uploads', 'persyaratan'])->findOrFail($id);
    $persyaratan = Persyaratan::all(); // Get all persyaratan
    $uploads = $mutasi->uploads; // Get uploads from the mutasi

    return Excel::download(new LaporanMutasiExport($mutasi, $persyaratan, $uploads), 'mutasi_laporan_'.$id.'.xlsx');
}

public function laporanPerorangan(Request $request)
{
    $mutasiList = Mutasi::all();
    $mutasi = null;

    // Cek apakah ada 'mutasi_id' dalam request, dan cari data Mutasi yang sesuai
    if ($request->has('mutasi_id')) {
        $mutasi = Mutasi::find($request->input('mutasi_id'));
    }

    // Kirim `mutasi_id` yang dipilih ke view untuk tetap menampilkan pilihan yang dipilih
    return view('laporan.perorangan', compact('mutasiList', 'mutasi'))
        ->with('selectedMutasiId', $request->input('mutasi_id'));
}

public function laporanBulanan(Request $request)
{
    $bulan = $request->input('bulan', date('Y-m')); // Default bulan saat ini
    $mutasi = Mutasi::whereYear('updated_at', substr($bulan, 0, 4))
                    ->whereMonth('updated_at', substr($bulan, 5, 2))
                    ->get();

    return view('laporan.bulanan', compact('mutasi', 'bulan'));
}
public function preview2(Request $request)
{
    $bulan = $request->input('bulan', date('Y-m')); // Ambil bulan dari request
    $mutasi = Mutasi::whereYear('updated_at', substr($bulan, 0, 4))
                    ->whereMonth('updated_at', substr($bulan, 5, 2))
                    ->with(['uploads', 'persyaratan'])
                    ->get();

    // Jika tidak ada data mutasi, redirect dengan pesan error
    if ($mutasi->isEmpty()) {
        return redirect()->route('laporan.bulanan')->with('error', 'Tidak ada mutasi untuk bulan ini.');
    }

    return view('laporan.bulanan_preview', compact('mutasi', 'bulan'));
}
public function exportPDF2(Request $request)
{
    $bulan = $request->input('bulan', date('Y-m')); // Ambil bulan dari request
    $mutasi = Mutasi::whereYear('updated_at', substr($bulan, 0, 4))
                    ->whereMonth('updated_at', substr($bulan, 5, 2))
                    ->with(['uploads', 'persyaratan'])
                    ->get();

    // Menggunakan view yang berbeda untuk laporan bulanan
    $pdf = PDF::loadView('laporan.bulanan_pdf', compact('mutasi', 'bulan'));

    return $pdf->download('laporan_bulanan_' . $bulan . '.pdf');
}

public function exportExcel2(Request $request)
{
    $bulan = $request->input('bulan', date('Y-m')); // Ambil bulan dari request
    $mutasi = Mutasi::whereYear('updated_at', substr($bulan, 0, 4))
                    ->whereMonth('updated_at', substr($bulan, 5, 2))
                    ->with(['uploads', 'persyaratan']) // Jika Anda memerlukan relasi ini
                    ->get();

    return Excel::download(new LaporanMutasi2Export($mutasi), 'laporan_bulanan_' . $bulan . '.xlsx');
}


}
