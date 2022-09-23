<!DOCTYPE html>
<html>
<head>
	<title>Laporan Pengajuan Siswa - {{ $username }}</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
	<style type="text/css">
		table tr td,
		table tr th{
			font-size: 9pt;
		}
	</style>
	<center>
		<h5>Laporan Pengajuan Siswa Program Indonesia Pintar - {{ $username }}</h4>
		<h6><a target="_blank" href="https://www.smkinsanmandiri-kbb.sch.id/">www.smkinsanmandiri-kbb.sch.id</a></h5>
	</center>
 
	<table class='table table-bordered'>
		<thead>
			<tr>
				<th>No</th>
				<th>No Pendaftaran</th>
				<th>NISN</th>
				<th>Nama Lengkap</th>
				<th>Alamat</th>
				<th>Tempat, Tanggal Lahir</th>
				<th>Jenis Kelamin</th>
				<th>Catatan</th>
				<th>Keterangan</th>
			</tr>
		</thead>
		<tbody>
			@php $i=1 @endphp
			<tr>
				<td>{{ $i++ }}</td>
				<td>{{$pip->no_pendaftaran}}</td>
				<td>{{$pip->get_user->get_siswa->nisn}}</td>
				<td>{{$pip->get_user->get_siswa->nama_lengkap}}</td>
				<td>{{$pip->get_user->get_siswa->alamat}}</td>
				<td>{{$pip->get_user->get_siswa->tempat_lahir}}, {{$pip->get_user->get_siswa->date}}</td>
				<td>{{$pip->get_user->get_siswa->jenis_kelamin}}</td>
				<td>{{$pip->catatan}}</td>
				<td>{{$pip->keterangan}}</td>
			</tr>
		</tbody>
	</table>

    <div class="">
        <h5>Bukti Kartu Indonesia Pintar</h5>
        <img src="{{ public_path('uploads/'.$pip->foto_kip) }}" style="width: 300px;/>
    </div>
 
</body>
</html>