<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\PengaduanStoreRequest;
use App\Services\ChatService;
use App\Services\PengaduanService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
            $pengaduan = $this->pengaduan->Query()->where('user_id', Auth::user()->id);
            if (\request()->search) {
                $pengaduan->where('prihal', 'like', '%' . \request()->search . '%');
            }
            $data['table'] = $pengaduan->orderBy('created_at', 'DESC')->paginate();
            return view('user.pengaduan._data_pengaduan', $data);
        }

        return view('user.pengaduan.index');
    }

    public function show($id)
    {
        $data = $this->pengaduan->show($id);
        if ($data->status == 'diproses') {
            $chats = $this->chat->Query()
                ->where('pengaduan_id', $data->id)
                ->where('user_id', Auth::user()->id)
                ->get();
            return view('user.pengaduan.show', compact('data', 'chats'));
        }
        return view('user.pengaduan.show', compact('data'));
    }

    public function pending()
    {
        if (request()->ajax()) {
            $pengaduan = $this->pengaduan->Query()
                ->where('status', 'pending')
                ->where('user_id', Auth::user()->id);
            if (\request()->search) {
                $pengaduan->where('prihal', 'like', '%' . \request()->search . '%');
            }
            $data['table'] = $pengaduan->orderBy('created_at', 'DESC')->paginate();
            return view('user.pengaduan.status._data_pengaduan', $data);
        }

        return view('user.pengaduan.status.index');
    }
    public function diterima()
    {
        if (request()->ajax()) {
            $pengaduan = $this->pengaduan->Query()
                ->where('status', 'diterima')
                ->where('user_id', Auth::user()->id);
            if (\request()->search) {
                $pengaduan->where('prihal', 'like', '%' . \request()->search . '%');
            }
            $data['table'] = $pengaduan->orderBy('created_at', 'DESC')->paginate();
            return view('user.pengaduan.status._data_pengaduan', $data);
        }

        return view('user.pengaduan.status.index');
    }
    public function diproses()
    {
        if (request()->ajax()) {
            $pengaduan = $this->pengaduan->Query()
                ->where('status', 'diproses')
                ->where('user_id', Auth::user()->id);
            if (\request()->search) {
                $pengaduan->where('prihal', 'like', '%' . \request()->search . '%');
            }
            $data['table'] = $pengaduan->orderBy('created_at', 'DESC')->paginate();
            return view('user.pengaduan.status._data_pengaduan', $data);
        }

        return view('user.pengaduan.status.index');
    }
    public function close()
    {
        if (request()->ajax()) {
            $pengaduan = $this->pengaduan->Query()
                ->where('status', 'selesai')
                ->where('user_id', Auth::user()->id);
            if (\request()->search) {
                $pengaduan->where('prihal', 'like', '%' . \request()->search . '%');
            }
            $data['table'] = $pengaduan->orderBy('created_at', 'DESC')->paginate();
            return view('user.pengaduan.status._data_pengaduan', $data);
        }

        return view('user.pengaduan.status.index');
    }
    public function create()
    {
        return view('user.pengaduan.create');
    }

    public function store(PengaduanStoreRequest $request)
    {
        try {
            $file = $request->file('file');
            $filename = $file->hashName();
            $file->storeAs('bukti', $filename, 's3');
            $validatedData = $request->validated();
            $validatedData['file'] = $filename;
            $this->pengaduan->store($validatedData);
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
        return redirect()->route('user.pengaduan.pending')->with('message', 'Data berhasil ditambahkan.');
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
}
