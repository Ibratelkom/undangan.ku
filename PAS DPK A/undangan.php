<?php
$koneksi = new mysqli("localhost", "root", "", "nama_database"); // ganti nama_database sesuai milikmu

$pesan = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $nama = $koneksi->real_escape_string($_POST["nama"]);
  $jumlah = (int)$_POST["jumlah"];
  $kehadiran = $koneksi->real_escape_string($_POST["kehadiran"]);

  // cek apakah nama sudah ada
  $cek = $koneksi->query("SELECT * FROM rsvp WHERE nama='$nama'");
  if ($cek->num_rows > 0) {
    $koneksi->query("UPDATE rsvp SET jumlah=$jumlah, kehadiran='$kehadiran' WHERE nama='$nama'");
    $pesan = "Data RSVP diperbarui.";
  } else {
    $koneksi->query("INSERT INTO rsvp (nama, jumlah, kehadiran) VALUES ('$nama', $jumlah, '$kehadiran')");
    $pesan = "Data RSVP ditambahkan.";
  }
}

// Ambil semua data RSVP untuk ditampilkan
$dataRsvp = $koneksi->query("SELECT * FROM rsvp ORDER BY updated_at DESC");
?>
