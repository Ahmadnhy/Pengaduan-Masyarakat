<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Load database configuration
require_once __DIR__ . '/../config/database.php';

// Calculate BASE_PATH and ASSET_PATH dynamically relative to the project root directory
$current_dir = str_replace('\\', '/', dirname($_SERVER['SCRIPT_FILENAME']));
$project_root = str_replace('\\', '/', realpath(__DIR__ . '/..'));

$relative_prefix = '';
if (strpos($current_dir, $project_root) === 0) {
    $sub_path = substr($current_dir, strlen($project_root));
    $sub_path = trim($sub_path, '/');
    if ($sub_path !== '') {
        $depth = count(explode('/', $sub_path));
        $relative_prefix = str_repeat('../', $depth);
    }
}
define('BASE_PATH', $relative_prefix);
define('ASSET_PATH', $relative_prefix . 'assets/');


function upload()
{
    if (!isset($_FILES['foto']) || $_FILES['foto']['error'] === 4) {
        return '';
    }

    $namaFile = $_FILES['foto']['name'];
    $ukuranFile = $_FILES['foto']['size'];
    $error = $_FILES['foto']['error'];
    $tmpName = $_FILES['foto']['tmp_name'];

    $ekstensiValid = ['jpg', 'jpeg', 'png', 'gif', 'svg'];
    $ekstensi = explode('.', $namaFile);
    $ekstensi = strtolower(end($ekstensi));
    if (!in_array($ekstensi, $ekstensiValid)) {
        return false;
    }

    if ($ukuranFile > 10000000) {
        return false;
    }

    $namaBaru = uniqid() . '.' . $ekstensi;
    // Save to the assets/img/ folder
    $targetPath = dirname(__DIR__) . '/assets/img/' . $namaBaru;

    if (move_uploaded_file($tmpName, $targetPath)) {
        return $namaBaru;
    }

    return false;
}


function tambahAduan($data)
{
    global $conn;

    $tgl = htmlspecialchars($data["tgl_pengaduan"]);
    $nik = htmlspecialchars($data["nik"]);
    $isi = htmlspecialchars($data["isi_laporan"]);
    
    $foto = upload();
    if ($foto === false) {
        return -1;
    }

    $status = htmlspecialchars($data["status"]);

    $query = "INSERT INTO pengaduan VALUES ('', '$tgl', '$nik', '$isi', '$foto', '$status')";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}


function verify($data)
{
    global $conn;

    $id = htmlspecialchars($data["id_pengaduan"]);
    $tgl = htmlspecialchars($data["tgl_pengaduan"]);
    $nik = htmlspecialchars($data["nik"]);
    $isi = htmlspecialchars($data["isi_laporan"]);
    $foto = htmlspecialchars($data["foto"]);
    $status = htmlspecialchars($data["status"]);

    $query = "UPDATE pengaduan SET
                id_pengaduan = '$id',
                tgl_pengaduan = '$tgl',
                nik = '$nik',
                isi_laporan = '$isi',
                foto = '$foto',
                status = '$status'
                WHERE id_pengaduan = '$id' ";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function tanggapan($data)
{
    global $conn;

    $id = htmlspecialchars($data["id_pengaduan"]);
    $tgl = htmlspecialchars($data["tgl_tanggapan"]);
    $tanggapan = htmlspecialchars($data["tanggapan"]);
    $id_petugas = htmlspecialchars($data["id_petugas"]);

    mysqli_query($conn, "INSERT INTO tanggapan VALUES ('', '$id', '$tgl', '$tanggapan', '$id_petugas')");

    return mysqli_affected_rows($conn);
}

function regisUser($data)
{
    global $conn;

    $nik = htmlspecialchars($data["nik"]);
    $nama = htmlspecialchars($data["nama"]);
    $username = htmlspecialchars($data["username"]);
    $password = htmlspecialchars($data["password"]);
    $telp = htmlspecialchars($data["telp"]);

    mysqli_query($conn, "INSERT INTO masyarakat VALUES ('$nik', '$nama', '$username', '$password', '$telp')");

    return mysqli_affected_rows($conn);
}


function addPetugas($data)
{
    global $conn;

    $nama = htmlspecialchars($data["nama_petugas"]);
    $username = htmlspecialchars($data["username"]);
    $password = htmlspecialchars($data["password"]);
    $telp = htmlspecialchars($data["telp"]);
    $level = htmlspecialchars($data["level"]);

    mysqli_query($conn, "INSERT INTO petugas VALUES ('', '$nama', '$username', '$password', '$telp', '$level')");

    return mysqli_affected_rows($conn);
}

function editPetugas($data)
{
    global $conn;

    $id = htmlspecialchars($data["id_petugas"]);
    $nama = htmlspecialchars($data["nama_petugas"]);
    $username = htmlspecialchars($data["username"]);
    $password = htmlspecialchars($data["password"]);
    $telp = htmlspecialchars($data["telp"]);
    $level = htmlspecialchars($data["level"]);

    $query = "UPDATE petugas SET
                nama_petugas = '$nama',
                username = '$username',
                password = '$password',
                telp = '$telp',
                level = '$level'
                WHERE id_petugas = '$id'
                ";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}


function deletePetugas($id)
{
    global $conn;

    mysqli_query($conn, "DELETE FROM petugas WHERE id_petugas = $id");

    return mysqli_affected_rows($conn);
}


function deleteLaporan($id)
{
    global $conn;
    mysqli_query($conn, "DELETE FROM tanggapan WHERE id_pengaduan = $id");
    mysqli_query($conn, "DELETE FROM pengaduan WHERE id_pengaduan = $id");
    return mysqli_affected_rows($conn);
}

function editLaporan($data)
{
    global $conn;
    $id = htmlspecialchars($data["id_pengaduan"]);
    $tgl = htmlspecialchars($data["tgl_pengaduan"]);
    $nik = htmlspecialchars($data["nik"]);
    $isi = htmlspecialchars($data["isi_laporan"]);
    $status = htmlspecialchars($data["status"]);

    $query = "UPDATE pengaduan SET
                tgl_pengaduan = '$tgl',
                nik = '$nik',
                isi_laporan = '$isi',
                status = '$status'
                WHERE id_pengaduan = '$id'";

    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

function deleteTanggapan($id)
{
    global $conn;
    mysqli_query($conn, "DELETE FROM tanggapan WHERE id_tanggapan = $id");
    return mysqli_affected_rows($conn);
}

function editTanggapan($data)
{
    global $conn;
    $id = htmlspecialchars($data["id_tanggapan"]);
    $tgl = htmlspecialchars($data["tgl_tanggapan"]);
    $tanggapan = htmlspecialchars($data["tanggapan"]);
    $id_petugas = htmlspecialchars($data["id_petugas"]);

    $query = "UPDATE tanggapan SET
                tgl_tanggapan = '$tgl',
                tanggapan = '$tanggapan',
                id_petugas = '$id_petugas'
                WHERE id_tanggapan = '$id'";

    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}
