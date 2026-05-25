<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Nilai</title>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
</head>
<body>
    <h2>Tambah Data Nilai</h2>
    <p>Modul Nilai - Karina Hodiyah Ramadona</p>

    <form id="formNilai">
        <label>Guru</label><br>
        <select id="guru_id" required>
            <option value="">--Pilih Guru--</option>
        </select>
        
        <br><br>
        
        <label>KKM</label><br>
        <input type="number" id="kkm" min="0" max="100" required>
            <br><br>

            <label>Deskripsi Predikat A</label><br>
            <textarea id="deskripsi_a" required></textarea>

            <br><br>

            <label>Deskripsi Predikat B</label><br>
            <textarea id="deskripsi_b" required></textarea>

            <br><br>
            
            <label>Deskripsi Predikat C</label><br>
            <textarea id="deskripsi_c" required></textarea>

            <br><br>

            <label>Deskripsi Predikat D</label><br>
            <textarea id="deskripsi_d" required></textarea>

            <br><br>

            <button type="submit">Simpan</button>
            <a href="/nilai">Kembali</a>
        </form>

        <script>
            $(document).ready(function () {
                function loadGuru() {
                    $.ajax({
                        url: "/api/guru-list",
                        type: "GET",
                        success: function (response) {
                            let options = `<option value="">--Pilih Guru--</option>`;

                            $.each(response.data, function (index, guru) {
                                options += `<option value="${guru.id}">${guru.nama}</option>`;
                            });

                            $("#guru_id").html(options);
                        },
                        error: function () {
                            alert("Gagal Memuat Data Guru");
                        }
                    });
                }

                $("#formNilai").submit(function (e) {
                    e.preventDefault();

                    const dataNilai = {
                        guru_id: $("#guru_id").val(),
                        kkm: $("#kkm").val(),
                        deskripsi_a: $("#deskripsi_a").val(),
                        deskripsi_b: $("#deskripsi_b").val(),
                        deskripsi_c: $("#deskripsi_c").val(),
                        deskripsi_d: $("#deskripsi_d").val(),
                    };

                    $.ajax({
                        url: "/api/nilai",
                        type: "POST",
                        data: dataNilai,
                        success: function (response) {
                            alert("Data Nilai Berhasil Ditambahkan");
                            window.location.href = "/nilai";
                        },
                        error: function () {
                            alert("Gagal Menambahkan Data Nilai");
                        }
                    });
                });

                loadGuru();
            });
    </script>
</body>
</html>
