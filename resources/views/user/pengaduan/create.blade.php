<!DOCTYPE html>
<html lang="en" class="light-style customizer-hide" dir="ltr" data-theme="theme-default"
    data-assets-path="../assets/" data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>{{ config('app.name') }}</title>

    <meta name="description" content="" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('img') }}/favicon/favicon.png" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet" />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="{{ asset('vendor') }}/fonts/boxicons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('vendor') }}/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('vendor') }}/css/theme-default.css" class="template-customizer-theme-css" />
    @stack('css')
    <script src="{{ asset('vendor') }}/js/helpers.js"></script>

    <script src="{{ asset('js') }}/config.js"></script>
</head>

<body>
    <!-- Content -->
    <div class="container col-lg-6 col-md-12 col-sm-12">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner">
                <!-- Register -->
                <form action="{{ route('user.pengaduan.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <img src="{{ asset('assets/img/bg.jpg') }}" class="rounded w-100" alt="">
                    <div class="card mt-2">
                        <div class="card-body">
                            <h3 class="mb-2 fw-bold">Selamat Datang di WBS Inspektorat Kabupaten Tulang Bawang</h3>
                            <p class="">Laporkan segala kegiatan yang berindikasi pelanggaran di lingkungan
                                Pemerintah
                                Kabupaten Tulang Bawang. Bentuk materi pelanggaran yang dilaporkan:</p>
                            <ol>
                                <li>Pelanggaran Disiplin Pegawai</li>
                                <li>Penyalahgunaan Wewenang, Mal Administrasi dan Pemerasan/Penganiayaan</li>
                                <li>Perilaku Amoral/Perselingkuhan dan Kekerasan dalam Rumah Tangga</li>
                                <li>Korupsi</li>
                                <li>Pengadaan Barang dan Jasa</li>
                                <li>Pungutan Liar, Percaloan, dan Pengurusan Dokumen</li>
                                <li>Narkoba</li>
                                <li>Pelayanan Publik</li>
                            </ol>

                            <div class="mb-3">
                                <label for="prihal" class="form-label">Prihal</label>
                                <input type="text" class="form-control" id="prihal" name="prihal"
                                    placeholder="Masukkan Prihal" autofocus autocomplete="off"
                                    value="{{ old('prihal') }}" />
                                @error('prihal')
                                    <small class="mt-1 d-block text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="jenis" class="form-label">Jenis Pelanggaran</label>
                                <select name="jenis" id="jenis" class="form-select" value="{{ old('jenis') }}">
                                    <option value="Pelanggaran Disiplin Pegawai">Pelanggaran Disiplin Pegawai</option>
                                    <option
                                        value="Penyalahgunaan Wewenang, Mal Administrasi dan
                                        Pemerasan/Penganiayaan">
                                        Penyalahgunaan Wewenang, Mal Administrasi dan
                                        Pemerasan/Penganiayaan</option>
                                    <option
                                        value="Perilaku Amoral/Perselingkuhan dan Kekerasan dalam Rumah
                                        Tangga">
                                        Perilaku Amoral/Perselingkuhan dan Kekerasan dalam Rumah
                                        Tangga</option>
                                    <option value="Korupsi">Korupsi</option>
                                    <option value="Pengadaan Barang dan Jasa">Pengadaan Barang dan Jasa</option>
                                    <option value="Opsi Pungutan Liar, Percaloan, dan Pengurusan Dokumen">Opsi Pungutan
                                        Liar, Percaloan, dan Pengurusan Dokumen
                                    </option>
                                    <option value="Narkoba">Narkoba</option>
                                    <option value="Pelayanan Publik">Pelayanan Publik</option>
                                    <option value="Lainnya">Lainnya</option>
                                </select>
                                @error('jenis')
                                    <small class="mt-1 d-block text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="alamat" class="form-label">Alamat Kejadian</label>
                                <textarea name="alamat" id="alamat" class="form-control" id="" cols="30" rows="3"
                                    placeholder="Jl Lintas Sumatera ... ">{{ old('alamat') }}</textarea>
                                @error('alamat')
                                    <small class="mt-1 d-block text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="opd" class="form-label">Unit Satuan Kerja/OPD Kejadian</label>
                                <input type="text" class="form-control" id="opd" name="opd"
                                    placeholder="Inspektorat" autofocus autocomplete="off"
                                    value="{{ old('opd') }}" />
                                @error('opd')
                                    <small class="mt-1 d-block text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="tanggal" class="form-label">Perkiraan Waktu Kejadian</label>
                                <input type="date" class="form-control" id="tanggal" name="tanggal"
                                    placeholder="Inspektorat" autofocus autocomplete="off"
                                    value="{{ old('tanggal') }}" />
                                @error('tanggal')
                                    <small class="mt-1 d-block text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="uraian" class="form-label">Uraian (Uraian Pengaduan Sebaiknya Mengandung
                                    Unsur 4W+1H)</label>
                                <textarea name="uraian" id="uraian" class="form-control" id="" cols="30" rows="3"
                                    placeholder="Terjadi pemerasaan terhadap ...">{{ old('uraian') }}</textarea>
                                @error('uraian')
                                    <small class="mt-1 d-block text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="file" class="form-label">Lampiran (Bukti/Evidence)</label>
                                <input type="file" class="form-control" id="file" name="file" />
                                @error('file')
                                    <small class="mt-1 d-block text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                        </div>
                    </div>
                    <div class="mt-3 d-flex w-100 gap-2">
                        <button type="submit" id="btn_login" class="btn btn-primary d-grid"
                            type="submit">Submit</button>
                        <a href="{{ route('user.dashboard') }}" class="btn btn-outline-primary">Kembali</a>
                    </div>
                </form>
                <!-- /Register -->
            </div>
        </div>
    </div>
</body>

</html>
