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
  $sql = "SELECT * FROM produk";
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

    $nama_produk = $data['nama_produk'];
    $deskripsi   = $data['deskripsi'];
    $harga       = $data['harga'];
    $stok        = $data['stok'];

    $sql = "INSERT INTO produk
            (nama_produk, deskripsi, harga, stok, created_at)
            VALUES
            ('$nama_produk', '$deskripsi', $harga, $stok, NOW())";

    if (mysqli_query($mysqli, $sql)) {
        echo json_encode([
            "status" => true,
            "message" => "Produk berhasil ditambahkan"
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

    $id          = $data['id'] ?? null;
    $nama_produk = $data['nama_produk'] ?? null;
    $deskripsi   = $data['deskripsi'] ?? null;
    $harga       = $data['harga'] ?? null;
    $stok        = $data['stok'] ?? null;

    if (!$id || !$nama_produk) {
        echo json_encode([
            "status" => false,
            "message" => "Data tidak lengkap"
        ]);
        return;
    }

    $sql = "UPDATE produk SET 
                nama_produk = '$nama_produk',
                deskripsi   = '$deskripsi',
                harga       = '$harga',
                stok        = '$stok'
            WHERE id = '$id'";

    if (mysqli_query($mysqli, $sql)) {
        echo json_encode([
            "status" => true,
            "message" => "Produk berhasil diupdate"
        ]);
    } else {
        echo json_encode([
            "status" => false,
            "message" => "Produk gagal diupdate"
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

  $sql = "DELETE FROM produk WHERE id = '$id'";
  if (mysqli_query($mysqli, $sql)) {
      echo json_encode([
          "status" => true,
          "message" => "Produk berhasil dihapus"
      ]);
  } else {
      echo json_encode([
          "status" => false,
          "message" => "Produk gagal dihapus"
      ]);
  }
}