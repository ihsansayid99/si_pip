@extends('layouts.dashboard')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Pengajuan /</span> Program Indonesia Pintar</h4>
    
    <div class="row">
        <div class="col-xl">
            @if(Session::has('success'))
                <div class="alert alert-success" role="alert">{{ session('success') }}</div>
            @endif
            @if(Session::has('errors'))
                <div class="alert alert-danger" role="alert">Ups, Ada Yang tidak benar!</div>
            @endif
            @if(Session::has('errors_custom'))
                <div class="alert alert-danger" role="alert">{{ session('errors_custom') }}</div>
            @endif
            
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Isi Formulir Pengajuan</h5>
                <small class="text-muted float-end">* Wajib diisi!</small>
                </div>
                <div class="card-body">
                <form action="{{ route('siswa.pengajuan.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    {{-- <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">No Pendaftaran</label>
                    <input type="text" class="form-control" id="basic-default-fullname" name="no_pendaftaran" value="PIP202209001" readonly />
                    </div> --}}
                    <div class="mb-3">
                    <label class="form-label" for="basic-default-company">Upload Foto KIP (Kartu Indonesia Pintar)</label>
                    <div class="input-group">
                        <input type="file" class="form-control  @error('foto_kip') is-invalid @enderror" id="foto_kip" name="foto_kip" accept="image/*" />
                        <label class="input-group-text" for="foto_kip">Upload</label>
                        @error('foto_kip')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    </div>
                    <div class="mb-3">
                    <label class="form-label" for="keterangan">Keterangan</label>
                    <input
                        type="text"
                        id="keterangan"
                        name="keterangan"
                        class="form-control phone-mask  @error('keterangan') is-invalid @enderror"
                        placeholder=""
                        value="{{ old('keterangan') }}"
                    />
                        @error('keterangan')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="catatan">Catatan</label>
                        <input
                        type="text"
                        id="catatan"
                        name="catatan"
                        class="form-control phone-mask @error('catatan') is-invalid @enderror"
                        placeholder=""
                        value="{{ old('catatan') }}"
                        />
                        @error('catatan')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="tahun_akademik" class="form-label">Tahun Akademik</label>
                        <select class="form-select  @error('tahun_akademik') is-invalid @enderror" id="tahun_akademik" name="tahun_akademik" aria-label="Tahun Akademik">
                        <option selected value="">-- Pilih Tahun Akademik --</option>
                        <option value="2022/2023">2022/2023</option>
                        <option value="2023/2024">2023/2024</option>
                        <option value="2024/2025">2024/2025</option>
                        <option value="2025/2026">2025/2026</option>
                        <option value="2026/2027">2026/2027</option>
                        <option value="2027/2028">2027/2028</option>
                        <option value="2028/2029">2028/2029</option>
                        <option value="2029/2030">2029/2030</option>
                        </select>
                        @error('tahun_akademik')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Kirim Pengajuan</button>
                </form>
                </div>
            </div>

            <div>
                <h3>Data Pengajuan</h3>
                <div class="row">
                    <div class="col-md-12 my-2">
                        <a class="btn btn-primary float-end" href="{{ route('siswa.print.all') }}">Print All Data</a>
                    </div>
                </div>
                <div class="row">
                    @foreach ($pengajuan as $item)
                        @if($item->status == 'pending')
                        <div class="col-md-6 col-lg-4">
                            <div class="card text-center mb-3">
                            <div class="card-body">
                                <h5 class="card-title">INFORMASI PENTING!</h5>
                                <p class="card-text">Data Pengajuan Program Indonesia Pintar Anda Tahun Akademik <b>{{ $item->tahun_akademik }}</b> Sedang dalam Proses pengecheckan oleh Admin, Silahkan tunggu konfirmasi berikutnya pada Sistem Informasi Ini.</p>
                                <a href="javascript:void(0)" class="btn btn-warning disabled">PENDING</a>
                            </div>
                            </div>
                        </div>
                        @endif

                        @if($item->status == 'failed')
                        <div class="col-md-6 col-lg-4">
                            <div class="card text-center mb-3">
                            <div class="card-body">
                                <h5 class="card-title">INFORMASI PENTING!</h5>
                                <p class="card-text">Data Pengajuan Program Indonesia Pintar Anda Tahun Akademik <b>{{ $item->tahun_akademik }}</b> DITOLAK, Lakukan pengajuan lagi tahun akademik Selanjutnya.</p>
                                <a href="{{route('siswa.print.detail', $item->id)}}" class="btn btn-danger">DITOLAK</a>
                            </div>
                            </div>
                        </div>
                        @endif

                        @if($item->status == 'success')
                        <div class="col-md-6 col-lg-4">
                            <div class="card text-center mb-3">
                            <div class="card-body">
                                <h5 class="card-title">INFORMASI PENTING!</h5>
                                <p class="card-text">Data Pengajuan Program Indonesia Pintar Anda Tahun Akademik <b>{{ $item->tahun_akademik }}</b> DITERIMA, Lakukan pengajuan lagi tahun akademik Selanjutnya.</p>
                                <a href="{{route('siswa.print.detail', $item->id)}}" class="btn btn-success">DITERIMA</a>
                            </div>
                            </div>
                        </div>
                        @endif
                    @endforeach
                </div>
            </div>

            

        </div>
      </div>
  </div>
@endsection