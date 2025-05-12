
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Halaman Admin</title>
    <link rel="stylesheet" href="admin-style.css">
</head>
<body>
    <h2>halo admin</h2>
</body>
</html>

<?php
// Koneksi ke database
$conn = new mysqli("localhost", "root", "", "undangan");

// Ambil data dari database untuk daftar hadir
$sql_kehadiran = "SELECT * FROM kehadiran";
$result_kehadiran = $conn->query($sql_kehadiran);

$total_hadir = 0;
?>

<h2>Admin: Edit Daftar Kehadiran</h2>

<!-- Tabel Daftar Hadir -->
<table border="1">
    <thead>
        <tr>
            <th>Nama Tamu</th>
            <th>Jumlah Orang</th>
            <th>Ucapan</th>
            <th>Status Hadir</th>
            <th>Opsi</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($row = $result_kehadiran->fetch_assoc()): ?>
            <tr>
                <td><?= $row['nama']; ?></td>
                <td>
                    <form action="update_kehadiran.php" method="POST">
                        <input type="hidden" name="id" value="<?= $row['id']; ?>">
                        <input type="number" name="jumlah" value="<?= $row['jumlah']; ?>" required>
                </td>
                <td>
                    <textarea name="ucapan"><?= $row['ucapan']; ?></textarea>
                </td>
                <td>
                    <select name="hadir">
                        <option value="1" <?= ($row['hadir'] == 1) ? 'selected' : ''; ?>>Hadir</option>
                        <option value="0" <?= ($row['hadir'] == 0) ? 'selected' : ''; ?>>Tidak Hadir</option>
                    </select>
                </td>
                <td>
                    <button type="submit">Update</button>
                    </form>
                </td>
            </tr>
            <?php $total_hadir += $row['hadir'] == 1 ? $row['jumlah'] : 0; ?>
        <?php endwhile; ?>
    </tbody>
</table>

<p><strong>Total Tamu Hadir: <?= $total_hadir; ?> orang</strong></p>

<?php
$conn->close();
?>
