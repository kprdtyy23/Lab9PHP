<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Praktikum PHP - Latihan 1 sampai 7</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 30px;
            background-color: #f4f6f9;
            color: #333;
        }

        h1 {
            color: #187a45;
        }

        h2 {
            color: #187a45;
            margin-top: 10px;
        }

        .latihan {
            background: white;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 8px;
            border: 1px solid #ddd;
        }

        input {
            padding: 8px;
            margin: 5px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            padding: 9px 15px;
            background: #187a45;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background: #105b32;
        }

        .hasil {
            margin-top: 15px;
            padding: 12px;
            background: #eef8f1;
            border-radius: 5px;
        }

        .error {
            color: red;
            margin-top: 10px;
        }

        hr {
            border: 0;
            border-top: 1px solid #ddd;
            margin: 20px 0;
        }
    </style>
</head>

<body>

<h1>Praktikum Pemrograman Web PHP</h1>
<p>Latihan 1 sampai 7 - Program Studi Teknik Informatika</p>

<!-- LATIHAN 1 -->
<div class="latihan">

    <h2>Latihan 1 - Menjalankan PHP</h2>

    <?php
    echo "<p>PHP berhasil dijalankan.</p>";
    echo "<p>Waktu server: " . date("d-m-Y H:i:s") . "</p>";
    ?>

</div>


<!-- LATIHAN 2 -->
<div class="latihan">

    <h2>Latihan 2 - Variabel, Operator, dan Percabangan</h2>

    <?php
    $nama = "Siti";
    $tugas = 87;
    $uts = 88;
    $uas = 90;

    $nilaiAkhir = ($tugas * 0.30) + ($uts * 0.30) + ($uas * 0.40);

    if ($nilaiAkhir >= 85) {
        $predikat = "A";
    } elseif ($nilaiAkhir >= 75) {
        $predikat = "B";
    } elseif ($nilaiAkhir >= 60) {
        $predikat = "C";
    } else {
        $predikat = "D";
    }

    echo "Nama: " . htmlspecialchars($nama) . "<br>";
    echo "Nilai Tugas: " . $tugas . "<br>";
    echo "Nilai UTS: " . $uts . "<br>";
    echo "Nilai UAS: " . $uas . "<br>";
    echo "Nilai Akhir: " . number_format($nilaiAkhir, 2) . "<br>";
    echo "Predikat: " . $predikat;
    ?>

</div>


<!-- LATIHAN 3 -->
<div class="latihan">

    <h2>Latihan 3 - Perulangan dan Array</h2>

    <?php
    $mahasiswa = [
        "Alya",
        "Bima",
        "Citra",
        "Doni",
        "Eka",
        "Fajar",
        "Gita"
    ];

    echo "<h3>Daftar Mahasiswa</h3>";
    echo "<ol>";

    foreach ($mahasiswa as $namaMahasiswa) {
        echo "<li>" . htmlspecialchars($namaMahasiswa) . "</li>";
    }

    echo "</ol>";
    ?>

</div>


<!-- LATIHAN 4 -->
<div class="latihan">

    <h2>Latihan 4 - Membuat Function</h2>

    <?php

    // Function menghitung diskon
    function hitungDiskon($harga, $persen) {
        $potongan = $harga * ($persen / 100);
        return $harga - $potongan;
    }

    $hargaAkhir = hitungDiskon(150000, 10);

    echo "<h3>1. Menghitung Diskon</h3>";
    echo "Harga awal: Rp150.000<br>";
    echo "Diskon: 10%<br>";
    echo "Harga setelah diskon: Rp" .
        number_format($hargaAkhir, 0, ",", ".") . "<br>";


    // Function menghitung luas persegi panjang
    function hitungLuas($panjang, $lebar) {
        return $panjang * $lebar;
    }

    $luas = hitungLuas(10, 5);

    echo "<h3>2. Menghitung Luas Persegi Panjang</h3>";
    echo "Panjang: 10 cm<br>";
    echo "Lebar: 5 cm<br>";
    echo "Luas: " . $luas . " cm²<br>";


    // Function menentukan kelulusan
    function cekKelulusan($nilai) {
        if ($nilai >= 75) {
            return "Lulus";
        } else {
            return "Tidak Lulus";
        }
    }

    $nilai = 85;

    echo "<h3>3. Menentukan Kelulusan</h3>";
    echo "Nilai: " . $nilai . "<br>";
    echo "Status: " . cekKelulusan($nilai);

    ?>

</div>


<!-- LATIHAN 5 -->
<div class="latihan">

    <h2>Latihan 5 - Memproses Form dengan GET</h2>

    <form method="GET" action="">
        <label for="kata">Kata kunci:</label><br>
        <input
            id="kata"
            name="kata"
            type="text"
            value="<?php
                echo isset($_GET["kata"])
                    ? htmlspecialchars($_GET["kata"], ENT_QUOTES, "UTF-8")
                    : "";
            ?>"
        >

        <button type="submit">Cari</button>
    </form>

    <?php
    if (isset($_GET["kata"])) {
        $kata = trim($_GET["kata"]);

        echo "<div class='hasil'>";
        echo "Kata kunci: " .
            htmlspecialchars($kata, ENT_QUOTES, "UTF-8");
        echo "</div>";
    }
    ?>

    <p><small>Perhatikan perubahan URL setelah form dikirim.</small></p>

</div>


<!-- LATIHAN 6 -->
<div class="latihan">

    <h2>Latihan 6 - Memproses Form dengan POST</h2>

    <form method="POST" action="">

        <input type="hidden" name="form_latihan6" value="1">

        <label for="nama">Nama:</label><br>
        <input
            id="nama"
            name="nama"
            type="text"
            required
        >

        <br>

        <label for="prodi">Program Studi:</label><br>
        <input
            id="prodi"
            name="prodi"
            type="text"
            required
        >

        <br><br>

        <button type="submit" name="kirim">Kirim Data</button>

    </form>

    <?php
    if (
        $_SERVER["REQUEST_METHOD"] === "POST" &&
        isset($_POST["form_latihan6"])
    ) {

        $nama = trim($_POST["nama"] ?? "");
        $prodi = trim($_POST["prodi"] ?? "");

        if ($nama === "" || $prodi === "") {

            echo "<p class='error'>Semua kolom wajib diisi.</p>";

        } else {

            echo "<div class='hasil'>";
            echo "<h3>Data diterima</h3>";

            echo "Nama: " .
                htmlspecialchars($nama, ENT_QUOTES, "UTF-8") . "<br>";

            echo "Program Studi: " .
                htmlspecialchars($prodi, ENT_QUOTES, "UTF-8");

            echo "</div>";
        }
    }
    ?>

</div>


<!-- LATIHAN 7 -->
<div class="latihan">

    <h2>Latihan 7 - Pengolahan Data Sederhana</h2>

    <form method="POST" action="">

        <input type="hidden" name="form_latihan7" value="1">

        <label for="barang">Nama Barang:</label><br>
        <input
            id="barang"
            name="barang"
            type="text"
            required
        >

        <br>

        <label for="harga">Harga:</label><br>
        <input
            id="harga"
            name="harga"
            type="number"
            min="0"
            step="0.01"
            required
        >

        <br>

        <label for="jumlah">Jumlah:</label><br>
        <input
            id="jumlah"
            name="jumlah"
            type="number"
            min="1"
            step="1"
            required
        >

        <br><br>

        <button type="submit">Hitung</button>

    </form>

    <?php

    if (
        $_SERVER["REQUEST_METHOD"] === "POST" &&
        isset($_POST["form_latihan7"])
    ) {

        $barang = trim($_POST["barang"] ?? "");
        $hargaInput = $_POST["harga"] ?? "";
        $jumlahInput = $_POST["jumlah"] ?? "";

        if (
            $barang === "" ||
            !is_numeric($hargaInput) ||
            !ctype_digit((string)$jumlahInput) ||
            (float)$hargaInput < 0 ||
            (int)$jumlahInput < 1
        ) {

            $error = "Periksa kembali nama barang, harga, dan jumlah.";

        } else {

            $harga = (float)$hargaInput;
            $jumlah = (int)$jumlahInput;
            $subtotal = $harga * $jumlah;

        }

        if (isset($error)) {

            echo "<p class='error'>" .
                htmlspecialchars($error, ENT_QUOTES, "UTF-8") .
                "</p>";

        } elseif (isset($subtotal)) {

            echo "<div class='hasil'>";
            echo "<h3>Ringkasan Transaksi</h3>";

            echo "Barang: " .
                htmlspecialchars($barang, ENT_QUOTES, "UTF-8") . "<br>";

            echo "Harga: Rp" .
                number_format($harga, 0, ",", ".") . "<br>";

            echo "Jumlah: " . $jumlah . "<br>";

            echo "<hr>";

            echo "<strong>Subtotal: Rp" .
                number_format($subtotal, 0, ",", ".") .
                "</strong>";

            echo "</div>";
        }
    }

    ?>

</div>


<footer>
    <p style="text-align:center;">
        Praktikum Pemrograman Web - PHP
    </p>
</footer>

</body>
</html>
