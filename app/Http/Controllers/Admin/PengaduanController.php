<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\ChatService;
use App\Services\PengaduanService;
use Illuminate\Http\Request;

class PengaduanController extends Controller
{
    protected $pengaduan;
    protected $chat;
    public function __construct(PengaduanService $pengaduanService, ChatService $chatService)
    {
        $this->pengaduan = $pengaduanService;
        $this->chat = $chatService;
    }
    public function index()
    {
        if (request()->ajax()) {
            $pengaduan = $this->pengaduan->Query();
            if (\request()->search) {
                $pengaduan->where('prihal', 'like', '%' . \request()->search . '%');
            }
            $data['table'] = $pengaduan->orderBy('created_at', 'DESC')->paginate();
            return view('admin.pengaduan._data_pengaduan', $data);
        }

        return view('admin.pengaduan.index');
    }

    public function show($id)
    {
        $data = $this->pengaduan->show($id);
        if ($data->status == 'diproses') {
            $chats = $this->chat->Query()
                ->where('pengaduan_id', $data->id)
                ->get();
            return view('admin.pengaduan.show', compact('data', 'chats'));
        }
        return view('admin.pengaduan.show', compact('data'));
    }

    public function pending()
    {
        if (request()->ajax()) {
            $pengaduan = $this->pengaduan->Query()->where('status', 'pending');
            if (\request()->search) {
                $pengaduan->where('prihal', 'like', '%' . \request()->search . '%');
            }
            $data['table'] = $pengaduan->orderBy('created_at', 'DESC')->paginate();
            return view('admin.pengaduan.status._data_pengaduan', $data);
        }

        return view('admin.pengaduan.status.index');
    }
    public function diterima()
    {
        if (request()->ajax()) {
            $pengaduan = $this->pengaduan->Query()->where('status', 'diterima');
            if (\request()->search) {
                $pengaduan->where('prihal', 'like', '%' . \request()->search . '%');
            }
            $data['table'] = $pengaduan->orderBy('created_at', 'DESC')->paginate();
            return view('admin.pengaduan.status._data_pengaduan', $data);
        }

        return view('admin.pengaduan.status.index');
    }
    public function diproses()
    {
        if (request()->ajax()) {
            $pengaduan = $this->pengaduan->Query()->where('status', 'diproses');
            if (\request()->search) {
                $pengaduan->where('prihal', 'like', '%' . \request()->search . '%');
            }
            $data['table'] = $pengaduan->orderBy('created_at', 'DESC')->paginate();
            return view('admin.pengaduan.status._data_pengaduan', $data);
        }

        return view('admin.pengaduan.status.index');
    }
    public function close()
    {
        if (request()->ajax()) {
            $pengaduan = $this->pengaduan->Query()->where('status', 'selesai');
            if (\request()->search) {
                $pengaduan->where('prihal', 'like', '%' . \request()->search . '%');
            }
            $data['table'] = $pengaduan->orderBy('created_at', 'DESC')->paginate();
            return view('admin.pengaduan.status._data_pengaduan', $data);
        }

        return view('admin.pengaduan.status.index');
    }
    public function create()
    {
        return view('admin.pengaduan.create');
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
        return redirect()->route('admin.pengaduan.pending')->with('message', 'Data berhasil ditambahkan.');
    }

    public function destroy(Request $request)
    {
        try {
            $this->pengaduan->destroy($request->id);
        } catch (\Throwable $th) {
            return $this->error($th->getMessage());
        }
        return $this->success('OK', 'Data berhasil dihapus');
    }

    public function update(Request $request)
    {
        $data['status'] = $request->input('status');
        try {
            $this->pengaduan->update($request->input('id'), $data);
        } catch (\Throwable $th) {
            return $this->error($th->getMessage());
        }
        return redirect()->back();
    }
}
