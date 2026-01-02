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
  $sql = "SELECT * FROM admin";
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

    $username = $data['username'];
    $password = $data['password'];

    $sql = "INSERT INTO admin
            (username, password)
            VALUES
            ('$username', '$password')";

    if (mysqli_query($mysqli, $sql)) {
        echo json_encode([
            "status" => true,
            "message" => "Admin berhasil ditambahkan"
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

    $id       = $data['id'] ?? null;
    $username = $data['username'] ?? null;
    $password = $data['password'] ?? null;

    if (!$id || !$username) {
        echo json_encode([
            "status" => false,
            "message" => "Data tidak lengkap"
        ]);
        return;
    }

    $sql = "UPDATE admin SET 
                username = '$username',
                password = '$password'
            WHERE id = '$id'";

    if (mysqli_query($mysqli, $sql)) {
        echo json_encode([
            "status" => true,
            "message" => "Admin berhasil diupdate"
        ]);
    } else {
        echo json_encode([
            "status" => false,
            "message" => "Admin gagal diupdate"
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

  $sql = "DELETE FROM admin WHERE id = '$id'";
  if (mysqli_query($mysqli, $sql)) {
      echo json_encode([
          "status" => true,
          "message" => "Admin berhasil dihapus"
      ]);
  } else {
      echo json_encode([
          "status" => false,
          "message" => "Admin gagal dihapus"
      ]);
  }
}