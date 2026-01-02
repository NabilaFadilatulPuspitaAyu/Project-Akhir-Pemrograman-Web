<?php
session_start();

/* ===== INIT ===== */
if(!isset($_SESSION['keranjang'])){
    $_SESSION['keranjang'] = [];
}

/* ===== AJAX ===== */
if(isset($_POST['aksi'])){

/* === TAMBAH KE KERANJANG === */
if($_POST['aksi']=='simpan'){
    foreach($_POST['produk'] as $k=>$p){
        $ada=false;
        foreach($_SESSION['keranjang'] as $i=>$item){
            if($item['produk']==$p){
                $_SESSION['keranjang'][$i]['qty']++;
                $ada=true;
                break;
            }
        }
        if(!$ada){
            $_SESSION['keranjang'][]=[
                'id'=>uniqid(),
                'produk'=>$p,
                'harga'=>$_POST['harga'][$k],
                'foto'=>$_POST['foto'][$k],
                'qty'=>1
            ];
        }
    }
    echo json_encode(['status'=>'ok']);
    exit;
}

/* === PLUS / MINUS === */
if($_POST['aksi']=='qty'){
    foreach($_SESSION['keranjang'] as $k=>$v){
        if($v['id']==$_POST['id']){
            if($_POST['tipe']=='plus'){
                $_SESSION['keranjang'][$k]['qty']++;
            }else{
                $_SESSION['keranjang'][$k]['qty']--;
                if($_SESSION['keranjang'][$k]['qty']<=0){
                    unset($_SESSION['keranjang'][$k]);
                }
            }
        }
    }
    $_SESSION['keranjang']=array_values($_SESSION['keranjang']);
    echo json_encode(['status'=>'ok']);
    exit;
}

/* === CHECKOUT === */
if($_POST['aksi']=='checkout'){
    $nota="SV-".time();
    $nama=$_POST['nama'];
    $alamat=$_POST['alamat'];
    $pembayaran=$_POST['pembayaran'];
    $tanggal=date("Y-m-d H:i:s");

    $pesan="🧾 NOTA PEMBELIAN\n$nota\n\nNama: $nama\nAlamat: $alamat\n\n";
    foreach($_SESSION['keranjang'] as $k){
        $pesan.="{$k['produk']} x{$k['qty']} - {$k['harga']}\n";
    }
    $pesan.="\nPembayaran: $pembayaran\nTanggal: $tanggal";

    $_SESSION['keranjang']=[];

    echo json_encode([
        'wa'=>"https://wa.me/6289633684343?text=".urlencode($pesan)
    ]);
    exit;
}
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Pilih Produk</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<style>
body{margin:0;font-family:Arial;background:#f5f5f5}
.header{background:maroon;color:#fff;text-align:center;padding:20px}
.container{margin:20px;display:grid;grid-template-columns:repeat(auto-fit,minmax(160px,1fr));gap:15px}
.card{background:#fff;padding:15px;border-radius:10px;text-align:center;box-shadow:0 3px 8px rgba(0,0,0,.1)}
.card img{width:100%;height:140px;object-fit:contain;border-radius:8px;margin-bottom:8px;background:#fafafa}
.price{color:maroon;font-weight:bold}
.btn{background:maroon;color:#fff;border:none;width:100%;padding:8px;border-radius:6px;cursor:pointer}
.keranjang{margin:20px}
.item{background:#fff;padding:10px;border-radius:10px;margin-bottom:10px;display:flex;gap:10px}
.item img{width:60px;height:60px;object-fit:contain;border-radius:6px;background:#fafafa}
.item button{width:28px;height:28px;border:none;border-radius:5px;background:maroon;color:#fff}
.modal{display:none;position:fixed;inset:0;background:rgba(0,0,0,.6)}
.modal-content{background:#fff;padding:20px;margin:10% auto;max-width:400px;border-radius:10px}
input,textarea,select{width:100%;padding:8px;margin:5px 0}
</style>
</head>
<body>

<div class="header"><h2>Pilih Produk</h2></div>

<?php
$produk=[
    ["nama"=>"Facial Wash","harga"=>"Rp 85.000","foto"=>"img/facial-wash.jpeg"],
    ["nama"=>"Toner Brightening","harga"=>"Rp 95.000","foto"=>"img/toner-brightening.jpeg"],
    ["nama"=>"Serum Acne","harga"=>"Rp 120.000","foto"=>"img/serum-acne.jpeg"],
    ["nama"=>"Serum Brightening","harga"=>"Rp 135.000","foto"=>"img/serum-brightening.jpeg"],
    ["nama"=>"Day Cream","harga"=>"Rp 110.000","foto"=>"img/day-cream.jpeg"],
    ["nama"=>"Night Cream","harga"=>"Rp 115.000","foto"=>"img/night-cream.jpeg"]
];
?>

<div class="container">
<?php foreach($produk as $p): ?>
<div class="card">
    <img src="<?= $p['foto'] ?>">
    <h4><?= $p['nama'] ?></h4>
    <div class="price"><?= $p['harga'] ?></div>
    <input type="checkbox" 
        class="produk"
        data-nama="<?= $p['nama'] ?>"
        data-harga="<?= $p['harga'] ?>"
        data-foto="<?= $p['foto'] ?>"> Pilih
</div>
<?php endforeach; ?>
</div>

<div style="margin:20px">
<button class="btn" onclick="tambah()">Tambah ke Keranjang</button>
</div>

<div class="keranjang">
<h3>Keranjang</h3>
<?php foreach($_SESSION['keranjang'] as $k): ?>
<div class="item">
    <img src="<?= $k['foto'] ?>">
    <div>
        <b><?= $k['produk'] ?></b><br>
        <button onclick="qty('<?= $k['id'] ?>','minus')">−</button>
        <?= $k['qty'] ?>
        <button onclick="qty('<?= $k['id'] ?>','plus')">+</button><br>
        <?= $k['harga'] ?>
    </div>
</div>
<?php endforeach; ?>

<?php if(count($_SESSION['keranjang'])>0): ?>
<button class="btn" onclick="checkout()">Checkout</button>
<?php endif; ?>
</div>

<!-- MODAL -->
<div id="modal" class="modal">
<div class="modal-content">
<h3>Data Pembeli</h3>
<input id="nama" placeholder="Nama">
<textarea id="alamat" placeholder="Alamat"></textarea>
<select id="pembayaran">
<option value="">Pilih Pembayaran</option>
<option>Transfer Bank</option>
<option>COD</option>
<option>QRIS</option>
</select>
<button class="btn" onclick="konfirmasi()">Konfirmasi</button>
<button class="btn" style="background:#999;margin-top:5px" onclick="tutup()">Batal</button>
</div>
</div>

<script>
function tambah(){
    let fd=new FormData();
    let cek=false;
    document.querySelectorAll(".produk:checked").forEach(p=>{
        fd.append("produk[]",p.dataset.nama);
        fd.append("harga[]",p.dataset.harga);
        fd.append("foto[]",p.dataset.foto);
        cek=true;
    });
    if(!cek){alert("Pilih produk");return;}
    fd.append("aksi","simpan");
    fetch("",{method:"POST",body:fd}).then(()=>location.reload());
}
function qty(id,t){
    let fd=new FormData();
    fd.append("aksi","qty");
    fd.append("id",id);
    fd.append("tipe",t);
    fetch("",{method:"POST",body:fd}).then(()=>location.reload());
}
function checkout(){ modal.style.display="block"; }
function tutup(){ modal.style.display="none"; }
function konfirmasi(){
    if(!nama.value||!alamat.value||!pembayaran.value){
        alert("Lengkapi data");
        return;
    }
    let fd=new FormData();
    fd.append("aksi","checkout");
    fd.append("nama",nama.value);
    fd.append("alamat",alamat.value);
    fd.append("pembayaran",pembayaran.value);
    fetch("",{method:"POST",body:fd})
    .then(r=>r.json())
    .then(d=>{
        window.open(d.wa,"_blank");
        location.reload();
    });
}
</script>

</body>
</html>