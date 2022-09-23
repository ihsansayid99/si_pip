@extends('layouts.dashboard')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Data Master /</span> Data Siswa</h4>
    <div class="row">
        <div class="col-md-12 my-2">
            <a class="btn btn-primary float-end" href="{{ route('admin.print.siswa') }}">Print All Data</a>
        </div>
    </div>
    <div class="card">
        <h5 class="card-header">Siswa Table</h5>
        <div class="table-responsive text-nowrap">
            <table class="table table-sm">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>NISN</th>
                        <th>Nama Lengkap</th>
                        <th>Email</th>
                        <th>Alamat</th>
                        <th>Jenis Kelamin</th>
                        <th>Tempat, Tgl Lahir</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach($data as $key => $item)
                        <tr>
                            <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{ $key + 1 }}</strong></td>
                            <td>{{ $item->get_siswa->nisn }}</td>
                            <td>
                                {{ $item->get_siswa->nama_lengkap }}
                            </td>
                            <td>
                                {{ $item->email }}
                            </td>
                            <td>
                                {{ $item->get_siswa->alamat }}
                            </td>
                            <td><span class="badge bg-label-primary me-1"> {{ $item->get_siswa->jenis_kelamin }}</span></td>
                            <td>
                                {{ $item->get_siswa->tempat_lahir }}, {{ $item->get_siswa->date }}
                            </td>
                        </tr>                        
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection