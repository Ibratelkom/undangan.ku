$(document).ready(function() {
    function updateTotalHadir() {
        $.ajax({
            url: "get_total_hadir.php",
            method: "GET",
            success: function(data) {
                $("#total_hadir").text(data); // update elemen dengan id total_hadir
            }
        });
    }

    // Panggil updateTotalHadir setiap beberapa detik
    setInterval(updateTotalHadir, 10000); // 10000ms = 10 detik
});
