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
  $sql = "SELECT * FROM treatment";      
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

    $nama_treatment = $data['nama_treatment'];
    $deskripsi      = $data['deskripsi'];
    $harga          = $data['harga'];

    $sql = "INSERT INTO treatment
            (nama_treatment, deskripsi, harga, created_at)
            VALUES
            ('$nama_treatment', '$deskripsi', $harga, NOW())";

    if (mysqli_query($mysqli, $sql)) {
        echo json_encode([
            "status" => true,
            "message" => "Treatment berhasil ditambahkan"
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
      
    $id             = $data['id'] ?? null;      
    $nama_treatment = $data['nama_treatment'] ?? null;      
    $deskripsi      = $data['deskripsi'] ?? null;      
    $harga          = $data['harga'] ?? null;      
      
    if (!$id || !$nama_treatment) {      
        echo json_encode([      
            "status" => false,      
            "message" => "Data tidak lengkap"      
        ]);      
        return;      
    }      
      
    $sql = "UPDATE treatment SET       
                nama_treatment = '$nama_treatment',      
                deskripsi      = '$deskripsi',      
                harga          = '$harga'      
            WHERE id = '$id'";      
      
    if (mysqli_query($mysqli, $sql)) {      
        echo json_encode([      
            "status" => true,      
            "message" => "Treatment berhasil diupdate"      
        ]);      
    } else {      
        echo json_encode([      
            "status" => false,      
            "message" => "Treatment gagal diupdate"      
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
      
  $sql = "DELETE FROM treatment WHERE id = '$id'";      
  if (mysqli_query($mysqli, $sql)) {      
      echo json_encode([      
          "status" => true,      
          "message" => "Treatment berhasil dihapus"      
      ]);      
  } else {      
      echo json_encode([      
          "status" => false,      
          "message" => "Treatment gagal dihapus"      
      ]);      
  }      
}