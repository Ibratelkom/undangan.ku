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
    $email    = $conn->real_escape_string($_POST['email']);
    $password = $_POST['password'];

    $result = $conn->query("SELECT * FROM users WHERE email='$email'");

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

        if (password_verify($password, $user['password'])) {
            $_SESSION['user'] = $user['nama'];
            header("Location: indexafter.html");
            echo "<script>alert('Selamat Datang'); window.location.href ='indexafter.html;</script>"; // halaman setelah login berhasil
            exit();
        } else {
            $_SESSION['error'] = "Password salah.";
            echo "<script>alert('Password atau email anda salah!'); window.location.href = 'login.html';</script>";
            exit();
        }
    } else {
        $_SESSION['error'];
        header("Location: login.html");
        echo "<script>alert('Password atau email anda salah!'); window.location.href = 'login.html';</script>";
        exit();
    }
}

$conn->close();
?>
