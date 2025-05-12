<?php

$to = "rafi.ibra09@gmail.com";
$subject = "Bukti Pembayaran Paket Mawaddah";


if (isset($_FILES['bukti']) && $_FILES['bukti']['error'] === UPLOAD_ERR_OK) {
    $fileTmpPath = $_FILES['bukti']['tmp_name'];
    $fileName = $_FILES['bukti']['name'];
    $fileSize = $_FILES['bukti']['size'];
    $fileType = $_FILES['bukti']['type'];

    $allowedTypes = ['image/png', 'image/jpeg'];

    if (in_array($fileType, $allowedTypes)) {
        $fileData = chunk_split(base64_encode(file_get_contents($fileTmpPath)));

        $boundary = md5(time());
        $headers = "From: BesokNikah <noreply@besoknikah.com>\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: multipart/mixed; boundary=\"".$boundary."\"\r\n";

        $message = "--".$boundary."\r\n";
        $message .= "Content-Type: text/plain; charset=UTF-8\r\n";
        $message .= "Content-Transfer-Encoding: 7bit\r\n\r\n";
        $message .= "Berikut adalah bukti pembayaran untuk Paket Mawaddah.\r\n\r\n";

        $message .= "--".$boundary."\r\n";
        $message .= "Content-Type: ".$fileType."; name=\"".$fileName."\"\r\n";
        $message .= "Content-Disposition: attachment; filename=\"".$fileName."\"\r\n";
        $message .= "Content-Transfer-Encoding: base64\r\n\r\n";
        $message .= $fileData."\r\n";
        $message .= "--".$boundary."--";
 
       
        $mailSent = mail($to, $subject, $message, $headers);

        if ($mailSent) {
            header("Location: halamantemamawaddah.html");
            echo "<script>alert('Pembayaran Berhasil'); window.location.href ='halamantemamawaddah.html;</script>";
            exit();
        } else {
            echo "Gagal mengirim email. Silakan coba lagi.";
        }
    } else {
        echo "Format file tidak didukung. Hanya PNG atau JPEG yang diperbolehkan.";
    }
} else {
    echo "Terjadi kesalahan saat mengunggah file.";
}
?>
