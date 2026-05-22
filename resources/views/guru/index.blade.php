<!DOCTYPE html>
<html>
<head>
    <title>Data Guru</title>
</head>
<body>

<h1>Data Guru</h1>

<a href="{{ route('guru.create') }}">
    Tambah Guru
</a>

<table> border="1">

<tr>
    <th>Nama</th>
    <th>NIP</th>
    <th>Email</th>
</tr>

@foreach($gurus as $guru)

<tr>
    <td>{{ $guru->nama }}</td>
    <td>{{ $guru->nip }}</td>
    <td>{{ $guru->email }}</td>
</tr>

@endforeach
</table>

</body>
</html>