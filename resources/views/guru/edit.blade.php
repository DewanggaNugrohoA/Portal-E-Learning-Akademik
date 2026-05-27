<!DOCTYPE html>
<html>
    <head>
        <title>Edit Guru</title>
    </head>
    <body>
        <h1>Edit Guru</h1>
        <form action="{{ route('guru.update', $guru->id) }}" method="POST">
            @csrf
            @method('PUT')

            <label>Nama</label>
            <br>
            <input type="text" name="nama" value="{{ $guru->nama }}">
            <br><br>

            <label>NIP</label>
            <br>
            <input type="text" name="nip" value="{{ $guru->nip }}">
            <br><br>

            <label>Email</label>
            <br>
            <input type="email" name="email" value="{{ $guru->email }}">
            <br><br>

            <label>No HP</label>
            <br>
            <input type="text" name="no_hp" value="{{ $guru->no_hp }}">
            <br><br>

            <label>Alamat</label>
            <br>
            <input type="alamat">{{ $guru->alamat }}</textarea>
            <br><br>

            <label>Mata Pelajaran</label>
            <br>
            <input type="text" name="mata_pelajaran" value="{{ $guru->mata_pelajaran }}">
            <br><br>

            <button type="submit">
                Update
            </button>


        </form>
        
    </body>
</html>