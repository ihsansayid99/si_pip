@extends('layouts.dashboard')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Profile Saya /</span> Akun</h4>

    <div class="row">
      <div class="col-md-12">
        <ul class="nav nav-pills flex-column flex-md-row mb-3">
          <li class="nav-item">
            <a class="nav-link active" href="javascript:void(0);"><i class="bx bx-user me-1"></i> Akun</a>
          </li>
        </ul>
        <div class="card mb-4">
          <h5 class="card-header">Profile Detail</h5>
          <!-- Account -->
          <div class="card-body">
            <div class="d-flex align-items-start align-items-sm-center gap-4">
              <img
                src="https://lh4.googleusercontent.com/BxVctcd89WmpbbFbO8jZytEkCwNoMJReUalVcw-fR62wuup7xdJKOhIC2LrpVt3RSmGN5e7tc_Z-Xy8dGqn6Ujo=w16383"
                alt="user-avatar"
                class="d-block rounded"
                height="100"
                width="100"
                id="uploadedAvatar"
              />
              {{-- <div class="button-wrapper">
                <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
                  <span class="d-none d-sm-block">Upload new photo</span>
                  <i class="bx bx-upload d-block d-sm-none"></i>
                  <input
                    type="file"
                    id="upload"
                    class="account-file-input"
                    hidden
                    accept="image/png, image/jpeg"
                  />
                </label>
                <button type="button" class="btn btn-outline-secondary account-image-reset mb-4">
                  <i class="bx bx-reset d-block d-sm-none"></i>
                  <span class="d-none d-sm-block">Reset</span>
                </button>

                <p class="text-muted mb-0">Allowed JPG, GIF or PNG. Max size of 800K</p>
              </div> --}}
            </div>
          </div>
          <hr class="my-0" />
          <div class="card-body">
            <form id="formAccountSettings" method="POST" action="{{ route('siswa.profile.update', $profile->get_siswa->id) }}">
              @csrf
              <div class="row">
                <div class="mb-3 col-md-6">
                  <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                  <input
                    class="form-control  @error('nama_lengkap') is-invalid @enderror"
                    type="text"
                    id="nama_lengkap"
                    name="nama_lengkap"
                    value="{{ $profile->get_siswa->nama_lengkap }}"
                  />
                  @error('nama_lengkap')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
                </div>
                <div class="mb-3 col-md-6">
                  <label for="nisn" class="form-label">Nomor Induk Siswa Nasional</label>
                  <input class="form-control  @error('nisn') is-invalid @enderror" type="text" name="nisn" id="nisn" value="{{ $profile->get_siswa->nisn }}" />
                  @error('nisn')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
                  
                </div>
                <div class="mb-3 col-md-6">
                  <label for="email" class="form-label">E-mail</label>
                  <input
                    class="form-control  @error('email') is-invalid @enderror"
                    type="text"
                    id="email"
                    name="email"
                    value="{{ $profile->email }}"
                    placeholder="john.doe@example.com"
                  />
                  @error('email')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
                </div>
                <div class="mb-3 col-md-6">
                  <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                  <input
                    type="text"
                    class="form-control  @error('tempat_lahir') is-invalid @enderror"
                    id="tempat_lahir"
                    name="tempat_lahir"
                    value="{{$profile->get_siswa->tempat_lahir}}"
                  />
                  @error('tempat_lahir')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
                </div>
                <div class="mb-3 col-md-6">
                  <label class="form-label" for="date">Tanggal Lahir</label>
                  <input
                    type="date"
                    id="date"
                    name="date"
                    class="form-control  @error('date') is-invalid @enderror"
                    placeholder=""
                    value="{{ $profile->get_siswa->date }}"
                    />
                    @error('date')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="mb-3 col-md-6">
                  <label for="alamat" class="form-label">Alamat</label>
                  <input type="text" class="form-control  @error('alamat') is-invalid @enderror" id="alamat" name="alamat" placeholder="Alamat" value="{{ $profile->get_siswa->alamat }}" />
                  @error('alamat')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
                </div>
                <div class="mb-3 col-md-6">
                    <div class="col-md">
                        <small class="text-light fw-semibold d-block">Jenis Kelamin</small>
                        <div class="form-check form-check-inline mt-3">
                          <input
                            class="form-check-input"
                            type="radio"
                            name="jenis_kelamin"
                            id="inlineRadio1"
                            value="pria"
                            {{ ($profile->get_siswa->jenis_kelamin == 'pria' ? 'checked' : '') }}
                          />
                          <label class="form-check-label" for="inlineRadio1">Laki-Laki</label>
                        </div>
                        <div class="form-check form-check-inline">
                          <input
                            class="form-check-input"
                            type="radio"
                            name="jenis_kelamin"
                            id="inlineRadio2"
                            value="wanita"
                            {{ ($profile->get_siswa->jenis_kelamin == 'wanita' ? 'checked' : '') }}
                          />
                          <label class="form-check-label" for="inlineRadio2">Perempuan</label>
                        </div>
                      </div>
                      @error('jenis_kelamin')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="mb-3 col-md-6">
                  <label for="username" class="form-label">Username</label>
                  <input
                    type="text"
                    class="form-control"
                    id="username"
                    name="username"
                    placeholder="231465"
                    value="{{ $profile->username }}"
                    readonly
                  />
                  @error('username')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
                </div>
              <div class="mt-2">
                <button type="submit" class="btn btn-primary me-2">Ubah Data</button>
              </div>
            </form>
          </div>
          <!-- /Account -->
        </div>
      </div>
    </div>
  </div>
@endsection