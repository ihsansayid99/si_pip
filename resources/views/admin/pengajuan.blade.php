@extends('layouts.dashboard')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Data Master /</span> Data Pengajuan</h4>
    <div class="row">
        <div class="col-md-12 my-2">
            <a class="btn btn-primary float-end" href="{{ route('admin.print.all') }}">Print All Data</a>
        </div>
    </div>
    <div class="row">
        @foreach ($pengajuan as $item)
            <div class="col-md-6 col-lg-4 mb-3">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title">#{{ $item->no_pendaftaran }}</h5>
                        <h6 class="card-subtitle text-muted">Tahun Akademik {{ $item->tahun_akademik }}</h6>
                        @if($item->status == 'success')
                            <span class="badge rounded-pill bg-success my-2">Diterima</span>
                        @elseif($item->status == 'pending')
                            <span class="badge rounded-pill bg-warning my-2">Pending</span>
                        @else
                            <span class="badge rounded-pill bg-danger my-2">Ditolak</span>
                        @endif
                        <img
                            class="img-fluid d-flex mx-auto my-4"
                            src="{{ asset('uploads/'. $item->foto_kip) }}"
                            alt="Card image cap"
                        />
                        <div class="row my-2">
                            <div class="card-body">
                                <small class="text-light fw-semibold">Data Diri:</small>
                                <ul class="list-unstyled mt-2">
                                <li>{{$item->get_user->get_siswa->nama_lengkap}}</li>
                                <li>{{$item->get_user->get_siswa->nisn}}</li>
                                <li>
                                    {{$item->get_user->get_siswa->alamat}}
                                </li>
                                <li>{{$item->get_user->get_siswa->tempat_lahir}}, {{$item->get_user->get_siswa->date}}</li>
                                </ul>
                            </div>
                        </div>
                        <div class="row my-2">
                            <label for="">Keterangan:</label>
                            <p class="card-text">{{$item->keterangan}}</p>
                        </div>
                        <div class="row my-2">
                            <label for="">Catatan:</label>
                            <p class="card-text">{{$item->catatan}}</p>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <small class="text-light fw-semibold">YouTube Video</small>
                            <div class="mt-3">
                              <button
                                type="button"
                                class="btn btn-primary"
                                data-bs-toggle="modal"
                                data-bs-target="#kipModal-{{$item->id}}"
                                data-theVideo="{{asset('uploads/'.$item->foto_kip)}}"
                              >
                                Lihat Detail foto KIP
                              </button>
      
                              <!-- Modal -->
                              <div class="modal fade" id="kipModal-{{$item->id}}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-xl" role="document">
                                  <div class="modal-content">
                                    <iframe height="550" src="{{asset('uploads/'.$item->foto_kip)}}"></iframe>
                                  </div>
                                </div>
                              </div>
                            </div>
                        </div>
                        <div class="row my-2">
                                <small class="text-light fw-semibold">Ubah Status Pengajuan</small>
                                <div class="demo-inline-spacing">
                                    <form action="{{ route('admin.pengajuan.success', $item->id) }}" method="POST">
                                        @csrf
                                        @method('put')
                                        <button type="submit" class="btn btn-sm btn-success">DITERIMA</button>
                                  </form>
                                  <form action="{{ route('admin.pengajuan.failed', $item->id) }}" method="POST">
                                    @csrf
                                    @method('put')
                                    <button type="submit" class="btn btn-sm btn-danger">DITOLAK</button>
                                  </form>
                                  <form action="{{ route('admin.pengajuan.pending', $item->id) }}" method="POST">
                                    @csrf
                                    @method('put')
                                    <button type="submit" class="btn btn-sm btn-warning">PENDING</button>
                                  </form>
                                  <a href="{{ route('admin.print.detail', $item->id) }}" class="btn btn-primary btn-sm">Print</a>
                                </div>
                        </div>
                        {{-- <a href="javascript:void(0);" class="card-link">Lihat Detail Foto KIP</a> --}}
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection