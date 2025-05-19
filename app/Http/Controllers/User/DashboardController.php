<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Services\PengaduanService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
            ->where('user_id', Auth::user()->id)
            ->where('status', 'pending')
            ->count();
        $totalDiterima = $this->pengaduan->Query()
            ->where('user_id', Auth::user()->id)
            ->where('status', 'diterima')
            ->count();
        $totalDiproses = $this->pengaduan->Query()
            ->where('user_id', Auth::user()->id)
            ->where('status', 'diproses')
            ->count();
        $totalClose = $this->pengaduan->Query()
            ->where('user_id', Auth::user()->id)
            ->where('status', 'selesai')
            ->count();
        return view('user.dashboard.index', compact('totalPending', 'totalDiterima', 'totalDiproses', 'totalClose'));
    }
}
