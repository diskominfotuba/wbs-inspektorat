<?php

namespace App\Services;

use App\Models\Pengaduan;

class PengaduanService
{
    protected $pengaduan;
    public function __construct(Pengaduan $pengaduan)
    {
        $this->pengaduan = $pengaduan;
    }

    public function getAll()
    {
        return $this->pengaduan->get();
    }

    public function store($data)
    {
        return $this->pengaduan->create($data);
    }

    public function Query()
    {
        return $this->pengaduan->query();
    }

    public function show($id)
    {
        $pengaduan = $this->pengaduan->find($id);
        return $pengaduan;
    }

    public function update($id, $data)
    {
        $pengaduan =  $this->pengaduan->where('id', $id)->update($data);
        return $pengaduan;
    }

    public function destroy($id)
    {
        $data = $this->pengaduan->find($id);
        if ($data['file'] !== null) {
            $filePath = storage_path('app/public/file/') . $data->file;
            unlink($filePath);
        }
        return $this->pengaduan->destroy($id);
    }
}
