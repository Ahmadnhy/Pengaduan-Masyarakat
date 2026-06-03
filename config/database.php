<?php
$conn = mysqli_connect("localhost", "root", "", "laporan");
if (!$conn) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}
