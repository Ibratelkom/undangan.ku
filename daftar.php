<?php
session_start();

$host = 'localhost';
$user = 'root';
$pass = '';
$db   = 'db.php';

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama     = $conn->real_escape_string($_POST['nama']);
    $email    = $conn->real_escape_string($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $cek = $conn->query("SELECT * FROM users WHERE email='$email'");
    if ($cek->num_rows > 0) {
        $_SESSION['error'] = "Email sudah digunakan.";
        header("Location: index.html");
        exit();
    } else {
        $sql = "INSERT INTO users (nama, email, password) VALUES ('$nama', '$email', '$password')";
        if ($conn->query($sql) === TRUE) {
            header("Location: indexafter.html");
            echo "<script>alert('Akun Terdaftar'); window.location.href = 'indexafter.html';</script>";
            exit();
        } else {
            $_SESSION['error'] = "Gagal menyimpan data.";
            header("Location: daftar.html");
            exit();
        }
    }
}

$conn->close();
?>

