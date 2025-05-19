<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Http\Requests\PengaduanStoreRequest;
use App\Http\Resources\PengaduanResource;
use App\Services\PengaduanService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PengaduanController extends BaseController
{
    protected $pengaduan;
    public function __construct(PengaduanService $pengaduanService)
    {
        $this->pengaduan = $pengaduanService;
    }

    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        $pengaduan = $this->pengaduan->Query()->where('user_id', Auth::user()->id)->paginate();
        return new PengaduanResource(true, 'List data Pengaduan', $pengaduan);

    }


    public function store(PengaduanStoreRequest $request)
    {
        try {
            $file = $request->file('file');
            $filename = $file->hashName();
            $file->storeAs('public/file', $filename);
            $validatedData = $request->validated();
            $validatedData['file'] = $filename;
            $this->pengaduan->store($validatedData);
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
        return new PengaduanResource(true, 'Data Pengaduan Berhasil Diajukan!', $validatedData);
    }
}
