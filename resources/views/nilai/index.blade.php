<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Nilai</title>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
</head>
<body>
    <h2>Data Nilai</h2>
    <p>Modul Nilai - Karina Hodiyah Ramadona</p>

    <a href="/nilai/create">Tambah Nilai</a>

    <br><br>

    <table border="1" cellpadding="8" cellspacing="0">
        <thead>
            <tr>
                <th>No</th>
                <th>Guru</th>
                <th>KKM</th>
                <th>Predikat A</th>
                <th>Predikat B</th>
                <th>Predikat C</th>
                <th>Predikat D</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody id="dataNilai">
            <tr>
                <td colspan="8">Memuat data...</td>
            </tr>
        </tbody>
    </table>

    <script>
        $(document).ready(function () {
            const apiUrl = "/api/nilai";

            function loadNilai() {
                $.ajax({
                    url: apiUrl,
                    type: "GET",
                    success: function (response) {
                        let rows = "";

                        if (response.data.length === 0) {
                            rows = `
                                <tr>
                                    <td colspan="8">Belum ada data nilai.</td>
                                </tr>
                            `;
                        } else {
                            $.each(response.data, function (index, nilai) {
                                rows += `
                                    <tr>
                                        <td>${index + 1}</td>
                                        <td>${nilai.guru ? nilai.guru.nama : "-"}</td>
                                        <td>${nilai.kkm}</td>
                                        <td>${nilai.deskripsi_a}</td>
                                        <td>${nilai.deskripsi_b}</td>
                                        <td>${nilai.deskripsi_c}</td>
                                        <td>${nilai.deskripsi_d}</td>
                                        <td>
                                            <a href="/nilai/${nilai.id}">Detail</a>
                                            <a href="/nilai/${nilai.id}/edit">Edit</a>
                                            <button class="btn-hapus" data-id="${nilai.id}">Hapus</button>
                                        </td>
                                    </tr>
                                `;
                            });
                        }

                        $("#dataNilai").html(rows);
                    },
                    error: function () {
                        $("#dataNilai").html(`
                            <tr>
                                <td colspan="8">Gagal memuat data nilai.</td>
                            </tr>
                        `);
                    }
                });
            }

            $("#dataNilai").on("click", ".btn-hapus", function () {
                const id = $(this).data("id");

                if (confirm("Yakin ingin menghapus data nilai ini?")) {
                    $.ajax({
                        url: `${apiUrl}/${id}`,
                        type: "DELETE",
                        success: function (response) {
                            alert(response.message);
                            loadNilai();
                        },
                        error: function () {
                            alert("Gagal menghapus data nilai.");
                        }
                    });
                }
            });

            loadNilai();
        });
    </script>
</body>
</html>