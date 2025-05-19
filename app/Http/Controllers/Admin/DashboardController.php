<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\PengaduanService;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    protected $pengaduan;
    public function __construct(PengaduanService $pengaduanService)
    {
        $this->pengaduan = $pengaduanService;
    }
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $totalPending = $this->pengaduan->Query()
            ->where('status', 'pending')
            ->count();
        $totalDiterima = $this->pengaduan->Query()
            ->where('status', 'diterima')
            ->count();
        $totalDiproses = $this->pengaduan->Query()
            ->where('status', 'diproses')
            ->count();
        $totalClose = $this->pengaduan->Query()
            ->where('status', 'selesai')
            ->count();
        return view('admin.dashboard.index', compact('totalPending', 'totalDiterima', 'totalDiproses', 'totalClose'));
    }
}
