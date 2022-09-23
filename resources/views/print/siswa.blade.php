<!DOCTYPE html>
<html>
<head>
	<title>Laporan Pendaftaran Siswa</title>
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
		<h5>Laporan Pendaftaran Siswa Program Indonesia Pintar</h4>
		<h6><a target="_blank" href="https://www.smkn11.bandung.sch.id">www.smkn11.bandung.sch.id</a></h5>
	</center>
 
	<table class='table table-bordered'>
		<thead>
			<tr>
				<th>No</th>
				<th>Email</th>
				<th>NISN</th>
				<th>Nama Lengkap</th>
				<th>Alamat</th>
				<th>Tempat, Tanggal Lahir</th>
				<th>Jenis Kelamin</th>
				<th>Username</th>
			</tr>
		</thead>
		<tbody>
			@php $i=1 @endphp
			@foreach($siswa as $p)
			<tr>
				<td>{{ $i++ }}</td>
				<td>{{$p->email}}</td>
				<td>{{$p->get_siswa->nisn}}</td>
				<td>{{$p->get_siswa->nama_lengkap}}</td>
				<td>{{$p->get_siswa->alamat}}</td>
				<td>{{$p->get_siswa->tempat_lahir}}, {{$p->get_siswa->date}}</td>
				<td>{{$p->get_siswa->jenis_kelamin}}</td>
				<td>{{$p->username}}</td>
			</tr>
			@endforeach
		</tbody>
	</table>
 
</body>
</html>