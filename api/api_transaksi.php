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
  $sql = "SELECT * FROM transaksi";    
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

    $nama_pembeli = $data['nama_pembeli'];
    $no_wa        = $data['no_wa'];
    $id_produk    = $data['id_produk'];
    $jumlah       = $data['jumlah'];
    $total        = $data['total'];

    // kalau kolom tanggal punya DEFAULT CURRENT_TIMESTAMP
    $sql = "INSERT INTO transaksi
            (nama_pembeli, no_wa, id_produk, jumlah, total, tanggal)
            VALUES
            ('$nama_pembeli', '$no_wa', $id_produk, $jumlah, $total, NOW())";

    if (mysqli_query($mysqli, $sql)) {
        echo json_encode([
            "status" => true,
            "message" => "Transaksi berhasil ditambahkan"
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
    
    $id            = $data['id'] ?? null;    
    $nama_pembeli  = $data['nama_pembeli'] ?? null;    
    $no_wa         = $data['no_wa'] ?? null;    
    $id_produk     = $data['id_produk'] ?? null;    
    $jumlah        = $data['jumlah'] ?? null;    
    $total         = $data['total'] ?? null;    
    $tanggal       = $data['tanggal'] ?? null;    
    
    if (!$id || !$nama_pembeli) {    
        echo json_encode([    
            "status" => false,    
            "message" => "Data tidak lengkap"    
        ]);    
        return;    
    }    
    
    $sql = "UPDATE transaksi SET     
                nama_pembeli = '$nama_pembeli',    
                no_wa        = '$no_wa',    
                id_produk    = '$id_produk',    
                jumlah       = '$jumlah',    
                total        = '$total',    
                tanggal      = '$tanggal'    
            WHERE id = '$id'";    
    
    if (mysqli_query($mysqli, $sql)) {    
        echo json_encode([    
            "status" => true,    
            "message" => "Transaksi berhasil diupdate"    
        ]);    
    } else {    
        echo json_encode([    
            "status" => false,    
            "message" => "Transaksi gagal diupdate"    
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
    
  $sql = "DELETE FROM transaksi WHERE id = '$id'";    
  if (mysqli_query($mysqli, $sql)) {    
      echo json_encode([    
          "status" => true,    
          "message" => "Transaksi berhasil dihapus"    
      ]);    
  } else {    
      echo json_encode([    
          "status" => false,    
          "message" => "Transaksi gagal dihapus"    
      ]);    
  }    
}