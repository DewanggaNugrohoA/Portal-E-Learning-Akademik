<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Nilai</title>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
</head>
<body>
    <h2>Edit Data Nilai</h2>
    <p> Modul Nilai - Karina Hodiyah Ramadona</p>

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

        <button type="submit">Update</button>
        <a href="/nilai">Kembali</a>
    </form>

    <script>
        $(document).ready(function() {
            const id = "{{ $id }}";

            function loadGuru(selectedGuruId) {
                $.ajax({
                    url: "/api/guru",
                    type: "GET",
                    success: function(response) {
                        let options = "<option value=''>--Pilih Guru--</option>";

                        $.each(response.data, function(index, guru) {
                            const selected = guru.id == selectedGuruId ? "selected" : "";
                            options += `<option value="${guru.id}" ${selected}>${guru.nama}</option>`;
                        });

                        $("#guru_id").html(options);
                    },
                    error: function() {
                        alert("Gagal Memuat Data Guru");
                    }
                });
            }

            function loadDetailNilai() {
                $.ajax({
                    url: `/api/nilai/${id}`,
                    type: "GET",
                    success: function(response) {
                        const nilai = response.data;
                        
                        $("#kkm").val(nilai.kkm);
                        $("#deskripsi_a").val(nilai.deskripsi_a);
                        $("#deskripsi_b").val(nilai.deskripsi_b);
                        $("#deskripsi_c").val(nilai.deskripsi_c);
                        $("#deskripsi_d").val(nilai.deskripsi_d);

                        loadGuru(nilai.guru_id);
                    },
                    error: function() {
                        alert("Data Nilai Tidak Ditemukan");
                        window.location.href = "/nilai";
                    }
                });
            }

            $("#formNilai").submit(function(e) {
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
                    url: `/api/nilai/${id}`,
                    type: "PUT",
                    data: dataNilai,
                    success: function(response) {
                        alert(response.message);
                        window.location.href = "/nilai";
                    },
                    error: function() {
                        alert("Gagal Memperbarui Data Nilai");
                    }
                });
            });

            loadDetailNilai();
        });
    </script>
</body>
</html>