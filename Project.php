 <?php
$data = null;
$error = [];

$nama = "";
$nim = "";
$prodi = "";
$semester = "";
$email = "";

// Memproses data ketika tombol kirim ditekan
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Mengambil data dari formulir
    $nama = trim($_POST["nama"] ?? "");
    $nim = trim($_POST["nim"] ?? "");
    $prodi = trim($_POST["prodi"] ?? "");
    $semester = trim($_POST["semester"] ?? "");
    $email = trim($_POST["email"] ?? "");

    // Validasi nama
    if ($nama == "") {
        $error[] = "Nama wajib diisi.";
    }

    // Validasi NIM
    if ($nim == "") {
        $error[] = "NIM wajib diisi.";
    } elseif (!preg_match("/^[0-9]{10}$/", $nim)) {
        $error[] = "NIM harus terdiri dari 10 angka.";
    }

    // Validasi program studi
    if ($prodi == "") {
        $error[] = "Program studi wajib diisi.";
    }

    // Validasi semester
    if ($semester == "") {
        $error[] = "Semester wajib diisi.";
    } elseif (
        !filter_var($semester, FILTER_VALIDATE_INT) ||
        $semester < 1 ||
        $semester > 14
    ) {
        $error[] = "Semester harus berupa angka 1 sampai 14.";
    }

    // Validasi email
    if ($email == "") {
        $error[] = "Email wajib diisi.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error[] = "Format email tidak valid.";
    }

    // Jika tidak ada kesalahan, data dinyatakan valid
    if (empty($error)) {
        $data = [
            "nama" => $nama,
            "nim" => $nim,
            "prodi" => $prodi,
            "semester" => (int) $semester,
            "email" => $email
        ];
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulir Data Mahasiswa</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f2f4f7;
            margin: 0;
            padding: 30px;
        }

        .container {
            max-width: 550px;
            margin: auto;
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        h2 {
            text-align: center;
            color: #333;
        }

        label {
            display: block;
            margin-top: 15px;
            font-weight: bold;
        }

        input, select {
            width: 100%;
            padding: 10px;
            margin-top: 7px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button {
            margin-top: 20px;
            padding: 11px 18px;
            border: none;
            border-radius: 5px;
            background: #1677d2;
            color: white;
            cursor: pointer;
        }

        button:hover {
            opacity: 0.85;
        }

        .error {
            background: #ffe5e5;
            color: #b00020;
            padding: 12px;
            border-radius: 5px;
            margin-bottom: 15px;
        }

        .success {
            background: #e2f7e8;
            padding: 15px;
            border-radius: 5px;
            margin-top: 20px;
        }

        .success p {
            margin: 8px 0;
        }
    </style>
</head>

<body>

<div class="container">

    <h2>Formulir Data Mahasiswa</h2>

    <!-- Menampilkan pesan kesalahan -->
    <?php if (!empty($error)): ?>
        <div class="error" id="pesanError">
            <strong>Terjadi kesalahan:</strong>
            <ul>
                <?php foreach ($error as $pesan): ?>
                    <li><?= htmlspecialchars($pesan) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <!-- Formulir mahasiswa -->
    <form method="POST" action="" id="formMahasiswa">

        <label>Nama Lengkap</label>
        <input type="text" name="nama"
            value="<?= htmlspecialchars($nama) ?>"
            placeholder="Masukkan nama lengkap">

        <label>NIM</label>
        <input type="text" name="nim"
            value="<?= htmlspecialchars($nim) ?>"
            placeholder="Masukkan 10 digit NIM">

        <label>Program Studi</label>
        <select name="prodi">
            <option value="">-- Pilih Program Studi --</option>
            <option value="Teknik Informatika"
                <?= $prodi == "Teknik Informatika" ? "selected" : "" ?>>
                Teknik Informatika
            </option>
            <option value="Manajemen"
                <?= $prodi == "Manajemen" ? "selected" : "" ?>>
                Manajemen
            </option>
            <option value="Akuntansi"
                <?= $prodi == "Akuntansi" ? "selected" : "" ?>>
                Akuntansi
            </option>
            <option value="Teknik Industri"
                <?= $prodi == "Teknik Industri" ? "selected" : "" ?>>
                Teknik Industri
            </option>
        </select>

        <label>Semester</label>
        <input type="number" name="semester"
            value="<?= htmlspecialchars($semester) ?>"
            min="1" max="14"
            placeholder="Masukkan semester">

        <label>Email</label>
        <input type="text" name="email"
            value="<?= htmlspecialchars($email) ?>"
            placeholder="contoh@email.com">

        <!-- Tombol Reset dan Submit -->
        <button type="button" onclick="resetForm()"
            style="background: #777;">
            Reset
        </button>

        <button type="submit">
            Kirim Data
        </button>

    </form>

    <!-- Menampilkan data jika valid -->
    <?php if ($data !== null): ?>

        <div class="success" id="hasilData">
            <h3>Data Mahasiswa Berhasil Diproses!</h3>

            <p><strong>Nama:</strong>
                <?= htmlspecialchars($data["nama"]) ?>
            </p>

            <p><strong>NIM:</strong>
                <?= htmlspecialchars($data["nim"]) ?>
            </p>

            <p><strong>Program Studi:</strong>
                <?= htmlspecialchars($data["prodi"]) ?>
            </p>

            <p><strong>Semester:</strong>
                <?= htmlspecialchars((string) $data["semester"]) ?>
            </p>

            <p><strong>Email:</strong>
                <?= htmlspecialchars($data["email"]) ?>
            </p>
        </div>

    <?php endif; ?>

    <!-- Penjelasan eksperimen G5 -->
    <hr>

    <h3>Eksperimen G5 - Reset dan Submit</h3>

    <p>
        <strong>Reset:</strong>
        Mengosongkan kembali seluruh kolom formulir secara langsung
        melalui browser tanpa mengirim data ke server.
    </p>

    <p>
        <strong>Submit:</strong>
        Mengirim data formulir ke server menggunakan metode POST
        untuk diproses dan divalidasi oleh PHP.
    </p>

</div>

<script>
    function resetForm() {

        // Mengosongkan semua input
        document.getElementById("formMahasiswa").reset();

        // Mengosongkan kolom secara langsung
        const form = document.getElementById("formMahasiswa");

        form.querySelectorAll("input").forEach(function(input) {
            input.value = "";
        });

        // Mengembalikan pilihan program studi
        form.querySelector("select").selectedIndex = 0;

        // Menyembunyikan pesan error dan hasil sebelumnya
        const error = document.getElementById("pesanError");
        const hasil = document.getElementById("hasilData");

        if (error) {
            error.style.display = "none";
        }

        if (hasil) {
            hasil.style.display = "none";
        }
    }
</script>

</body>
</html>
