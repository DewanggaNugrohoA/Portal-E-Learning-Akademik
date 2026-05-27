<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Detail Nilai</title>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
</head>
<body>
    <h2>Detail Data Nilai</h2>
    <p>Modul Nilai - Karina Hodiyah Ramadona</p>

    <div id="detailNilai">Memuat Data....</div>

    <br>

    <a href="/nilai">Kembali</a>
    <a href="/nilai/{{ $id }}/edit">Edit</a>

    <script>
        $(document).ready(function () {
            const id = "{{ $id }}";

            $.ajax({
                url: `/api/nilai/${id}`,
                type: "GET",
                success: function (response) {
                    const nilai = response.data;

                    $("#detailNilai").html(`
                        <p><b>Nama Guru:</b> ${nilai.guru ? nilai.guru.nama : "-"}</p>
                        <p><b>KKM:</b> ${nilai.kkm}</p>
                        <p><b>Deskripsi Predikat A:</b> ${nilai.deskripsi_a}</p>
                        <p><b>Deskripsi Predikat B:</b> ${nilai.deskripsi_b}</p>
                        <p><b>Deskripsi Predikat C:</b> ${nilai.deskripsi_c}</p>
                        <p><b>Deskripsi Predikat D:</b> ${nilai.deskripsi_d}</p>
                    `);
                },
                error: function () {
                    $("#detailNilai").html("Gagal Memuat Detail Nilai");
                }
            });
        });
    </script>
</body>
</html>