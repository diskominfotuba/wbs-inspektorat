@extends('layouts.main')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="{{ $data->status == 'diproses' ? 'col-md-4' : 'col-md-12' }}">
                <div class="card">
                    <div class="card-body">
                        <h6 class="fw-bold mb-0 mt-2">Status</h6>
                        <span>{{ $data->status }}</span>
                        <button onclick="$('#exampleModalEdit').modal('show');" class="btn btn-sm btn-warning" type="button"
                            data-bs-target="#exampleModalEdit">
                            Edit
                        </button>

                        <h6 class="fw-bold mb-0 mt-2">Prihal</h6>
                        <p>{{ $data->prihal }}</p>
                        <h6 class="fw-bold mb-0 mt-2">Jenis Pelanggaran</h6>
                        <p>{{ $data->jenis }}</p>
                        <h6 class="fw-bold mb-0 mt-2">Alamat Kejadian</h6>
                        <p>{{ $data->alamat }}</p>
                        <h6 class="fw-bold mb-0 mt-2"> Unit Satuan Kerja/OPD Kejadian </h6>
                        <p>{{ $data->opd }}</p>
                        <h6 class="fw-bold mb-0 mt-2"> Perkiraan Waktu Kejadian </h6>
                        <p>{{ $data->tanggal }}</p>
                        <h6 class="fw-bold mb-0 mt-2">Uraian</h6>
                        <p>{{ $data->uraian }}</p>

                        <span class="fw-bold mb-0 mt-2">Bukti</span>
                        <a href="{{ asset('storage/file/' . $data->file) }}" class="btn btn-primary btn-sm">Lihat</a>

                    </div>
                </div>
            </div>

            <!-- Modal Edit -->
            <div class="modal fade" id="exampleModalEdit" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form action="{{ route('admin.pengaduan.update') }}" method="POST">
                            @csrf
                            <div class="modal-body">
                                <div class="row">
                                    <span id="notifEdit"></span>
                                    <input name="id" hidden value="{{ $data->id }}" />
                                    <div class="col-md-12">
                                        <label for="status" class="form-label">Status</label>
                                        <select name="status" class="form-control form-select">
                                            <option value="pending">pending</option>
                                            <option value="diterima">diterima</option>
                                            <option value="diproses">diproses</option>
                                            <option value="selesai">selesai</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                @include('layouts._button')
                                <button id="btn_submit" type="submit" class="btn btn-warning">Perbarui</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- End Modal Edit -->

            @if ($data->status == 'diproses')
                <div class="col-md-8">
                    <div class="app-chat card overflow-hidden">
                        <div class="row g-0">
                            <!-- Chat History -->
                            <div class="col app-chat-history">
                                <div class="chat-history-wrapper">
                                    <div class="chat-history-header border-bottom">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="d-flex overflow-hidden align-items-center">
                                                <i class="bx bx-menu bx-lg cursor-pointer d-lg-none d-block me-4"
                                                    data-bs-toggle="sidebar" data-overlay
                                                    data-target="#app-chat-contacts"></i>
                                                <div class="flex-shrink-0 avatar avatar-online">
                                                    <img src="{{ url('assets/img/avatar-1.png') }}" alt="Avatar"
                                                        class="rounded-circle" data-bs-toggle="sidebar" data-overlay
                                                        data-target="#app-chat-sidebar-right">
                                                </div>
                                                <div class="chat-contact-info flex-grow-1 ms-4">
                                                    <h6 class="m-0 fw-normal">Pengguna</h6>
                                                    <small class="user-status text-body">Anomin</small>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="chat-history-body">
                                        <ul class="list-unstyled chat-history">
                                            @foreach ($chats as $chat)
                                                @if ($chat->user_id == Auth::user()->id)
                                                    <li class="chat-message chat-message-right">
                                                        <div class="d-flex overflow-hidden">
                                                            <div class="chat-message-wrapper flex-grow-1">
                                                                <div class="chat-message-text text-black">
                                                                    <p class="mb-0">{{ $chat->chat }}
                                                                    </p>
                                                                </div>
                                                                <div class="text-end text-muted mt-1">
                                                                    <i
                                                                        class='bx bx-check-double bx-16px text-success me-1'></i>
                                                                    {{-- <small>{{ $chat->created_at->format('H:i d-m-Y') }}</small> --}}
                                                                </div>
                                                            </div>
                                                            <div class="user-avatar flex-shrink-0 ms-4">
                                                                <div class="avatar avatar-sm">
                                                                    <img src="{{ url('assets/img/avatar-1.png') }}"
                                                                        alt="Avatar" class="rounded-circle">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                @else
                                                    <li class="chat-message">
                                                        <div class="d-flex overflow-hidden">
                                                            <div class="user-avatar flex-shrink-0 me-4">
                                                                <div class="avatar avatar-sm">
                                                                    <img src="{{ url('assets/img/avatar-1.png') }}"
                                                                        alt="Avatar" class="rounded-circle">
                                                                </div>
                                                            </div>
                                                            <div class="chat-message-wrapper flex-grow-1">
                                                                <div class="chat-message-text text-black">
                                                                    <p class="mb-0">{{ $chat->chat }}</p>
                                                                </div>
                                                                <div class="text-muted mt-1">
                                                                    {{-- <small>{{ $chat->created_at->format('H:i d-m-Y') }}</small> --}}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                @endif
                                            @endforeach
                                        </ul>
                                    </div>
                                    <!-- Chat message form -->
                                    <div class="chat-history-footer shadow-xs">
                                        <form method="POST" action="{{ route('admin.chat.store') }}"
                                            class="form-send-message d-flex justify-content-between align-items-center ">
                                            @csrf
                                            <input type="text" hidden value="{{ $data->id }}" name="pengaduan_id">
                                            <input name="chat"
                                                class="form-control message-input border-0 me-4 ps-3 shadow-none"
                                                placeholder="Type your message here...">
                                            <div class="message-actions d-flex align-items-center">
                                                <button class="btn btn-primary d-flex send-msg-btn">
                                                    <span class="align-middle d-md-inline-block d-none">Send</span>
                                                    <i class="bx bx-paper-plane bx-sm ms-md-2 ms-0"></i>
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- /Chat History -->

                            <div class="app-overlay"></div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
@push('css')
    <link rel="stylesheet" href="{{ asset('vendor') }}/libs/perfect-scrollbar/perfect-scrollbar.css" />
    <link rel="stylesheet" href="{{ asset('vendor') }}/css/pages/page-chat.css" />
@endpush

@push('js')
    <script src="{{ asset('vendor') }}/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="{{ asset('vendor') }}/js/chat.js"></script>
@endpush
