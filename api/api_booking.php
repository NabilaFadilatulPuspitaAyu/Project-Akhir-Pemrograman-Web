<?php  
header("Content-Type: application/json");  
$request = $_SERVER['REQUEST_METHOD'];  
switch ($request) {  
  case 'GET':  
    getmethod();  
    break;  
  case 'PUT':  
    $data = json_decode(file_get_contents('php://input'), true);  
    putmethod($data);  
    break;  
  case 'POST':  
    $data = json_decode(file_get_contents('php://input'), true);  
    postmethod($data);  
    break;  
  case 'DELETE':  
    $data = json_decode(file_get_contents('php://input'), true);  
    deletemethod($data);  
    break;  
  
  default:  
    echo '{"name": "data not found"}';  
    break;  
}  
  
function getmethod()  
{  
  include_once('../koneksi.php');  
  $sql = "SELECT * FROM booking";  
  $result = mysqli_query($mysqli, $sql);  
  if (mysqli_num_rows($result) > 0) {  
      $rows = array();  
      while ($r = mysqli_fetch_assoc($result)) {  
           $rows["result"][] = $r;  
      }  
      echo json_encode($rows);  
  } else {  
      echo json_encode(["result" => "no data found"]);  
  }  
}  
    
function postmethod($data)
{
    include_once('../koneksi.php');

    if ($data == null) {
        echo json_encode([
            "status" => false,
            "message" => "Data JSON tidak ditemukan"
        ]);
        return;
    }

    $nama      = $data['nama'] ?? null;
    $no_wa     = $data['no_wa'] ?? null;
    $treatment = $data['treatment'] ?? null;
    $tanggal   = $data['tanggal'] ?? null;
    $jam       = $data['jam'] ?? null;
    $status    = $data['status'] ?? 'pending';

    if (!$nama || !$no_wa || !$treatment || !$tanggal || !$jam) {
        echo json_encode([
            "status" => false,
            "message" => "Data tidak lengkap"
        ]);
        return;
    }

    $sql = "INSERT INTO booking
            (nama, no_wa, treatment, tanggal, jam, status, created_at)
            VALUES
            ('$nama', '$no_wa', '$treatment', '$tanggal', '$jam', '$status', NOW())";

    if (mysqli_query($mysqli, $sql)) {
        echo json_encode([
            "status" => true,
            "message" => "Booking berhasil ditambahkan"
        ]);
    } else {
        echo json_encode([
            "status" => false,
            "message" => mysqli_error($mysqli)
        ]);
    }
}
  
function putmethod($data)  
{  
    include_once('../koneksi.php');  
  
    if ($data == null) {  
        echo json_encode([  
            "status" => false,  
            "message" => "Data JSON tidak ditemukan"  
        ]);  
        return;  
    }  
  
    $id        = $data['id'] ?? null;  
    $nama      = $data['nama'] ?? null;  
    $no_wa     = $data['no_wa'] ?? null;  
    $treatment = $data['treatment'] ?? null;  
    $tanggal   = $data['tanggal'] ?? null;  
    $jam       = $data['jam'] ?? null;  
    $status    = $data['status'] ?? null;  
  
    if (!$id || !$nama) {  
        echo json_encode([  
            "status" => false,  
            "message" => "Data tidak lengkap"  
        ]);  
        return;  
    }  
  
    $sql = "UPDATE booking SET   
                nama      = '$nama',  
                no_wa     = '$no_wa',  
                treatment = '$treatment',  
                tanggal   = '$tanggal',  
                jam       = '$jam',  
                status    = '$status'  
            WHERE id = '$id'";  
  
    if (mysqli_query($mysqli, $sql)) {  
        echo json_encode([  
            "status" => true,  
            "message" => "Booking berhasil diupdate"  
        ]);  
    } else {  
        echo json_encode([  
            "status" => false,  
            "message" => "Booking gagal diupdate"  
        ]);  
    }  
}  
  
function deletemethod()  
{  
  include_once('../koneksi.php');  
  
  $id = $_GET['id'];  
  
  if (!$id) {  
      echo json_encode([  
          "status" => false,  
          "message" => "ID tidak dikirim"  
      ]);  
      return;  
  }  
  
  $sql = "DELETE FROM booking WHERE id = '$id'";  
  if (mysqli_query($mysqli, $sql)) {  
      echo json_encode([  
          "status" => true,  
          "message" => "Booking berhasil dihapus"  
      ]);  
  } else {  
      echo json_encode([  
          "status" => false,  
          "message" => "Booking gagal dihapus"  
      ]);  
  }  
}