<?php
$koneksi = new mysqli("localhost", "root", "", "db.php");

if ($koneksi->connect_error) {
  die("Koneksi gagal: " . $koneksi->connect_error);
}

$nama = $_POST['nama'];
$jumlah = $_POST['jumlah'];
$kehadiran = $_POST['kehadiran'];

// Cek apakah nama sudah ada
$sql = "SELECT * FROM rsvp WHERE nama = ?";
$stmt = $koneksi->prepare($sql);
$stmt->bind_param("s", $nama);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
  // Update data
  $sql_update = "UPDATE rsvp SET jumlah_hadir=?, kehadiran=? WHERE nama=?";
  $stmt = $koneksi->prepare($sql_update);
  $stmt->bind_param("iss", $jumlah, $kehadiran, $nama);
  $stmt->execute();
} else {
  // Insert data
  $sql_insert = "INSERT INTO rsvp (nama, jumlah_hadir, kehadiran) VALUES (?, ?, ?)";
  $stmt = $koneksi->prepare($sql_insert);
  $stmt->bind_param("sis", $nama, $jumlah, $kehadiran);
  $stmt->execute();
}

$stmt->close();
$koneksi->close();
echo "Terima kasih! RSVP Anda telah tersimpan.";
?>
