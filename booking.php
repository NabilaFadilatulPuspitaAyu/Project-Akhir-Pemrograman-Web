<?php
include_once('koneksi.php');

/* PROSES SIMPAN DATA (AJAX) */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nama      = mysqli_real_escape_string($mysqli, $_POST['nama']);
    $wa        = mysqli_real_escape_string($mysqli, $_POST['wa']);
    $treatment = mysqli_real_escape_string($mysqli, $_POST['treatment']);
    $tanggal   = $_POST['tanggal'];
    $jam       = $_POST['jam'];

    $status = "Pending";

    $query = "INSERT INTO booking 
    (nama, no_wa, treatment, tanggal, jam, status)
    VALUES 
    ('$nama', '$wa', '$treatment', '$tanggal', '$jam', '$status')";

    if (mysqli_query($mysqli, $query)) {
        echo "success";
    } else {
        echo "error";
    }
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Booking Treatment | Savienna Skincare</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        body{
            margin:0;
            font-family: Arial, sans-serif;
            background:#f7f4f4;
            color:#333;
        }

        .header{
            background:maroon;
            color:white;
            text-align:center;
            padding:25px 15px;
        }

        .header h1{
            margin:0;
            font-size:26px;
        }

        .header p{
            margin-top:5px;
            font-size:14px;
        }

        .container{
            margin:20px;
            background:white;
            padding:20px;
            border-radius:10px;
            box-shadow:0 4px 10px rgba(0,0,0,0.1);
        }

        .container h2{
            text-align:center;
            color:maroon;
            margin-bottom:20px;
        }

        .form-group{
            margin-bottom:15px;
        }

        label{
            display:block;
            font-size:14px;
            margin-bottom:5px;
        }

        input, select, textarea{
            width:100%;
            padding:10px;
            border-radius:6px;
            border:1px solid #ccc;
            font-size:14px;
        }

        textarea{
            resize:none;
        }

        .btn{
            background:maroon;
            color:white;
            border:none;
            width:100%;
            padding:12px;
            font-size:16px;
            border-radius:8px;
            cursor:pointer;
            margin-top:10px;
        }

        .btn:hover{
            background:#800000;
        }

        .back{
            text-align:center;
            margin-top:15px;
        }

        .back a{
            color:maroon;
            text-decoration:none;
            font-size:14px;
        }

        .footer{
            background:maroon;
            color:white;
            text-align:center;
            padding:15px;
            font-size:12px;
            margin-top:30px;
        }
    </style>
</head>
<body>

<div class="header">
    <h1>Booking Treatment</h1>
    <p>Savienna Skincare</p>
</div>

<div class="container">
    <h2>Form Booking Treatment</h2>

    <!-- FORM -->
    <form onsubmit="kirimWhatsApp(); return false;">

        <div class="form-group">
            <label>Nama Lengkap</label>
            <input type="text" id="nama" name="nama" placeholder="Masukkan nama" required>
        </div>

        <div class="form-group">
            <label>No. WhatsApp</label>
            <input type="tel" id="wa" name="wa" placeholder="08xxxxxxxxxx" required>
        </div>

        <div class="form-group">
            <label>Pilih Treatment</label>
            <select id="treatment" name="treatment" required>
                <option value="">-- Pilih Treatment --</option>
                <option>Facial Basic</option>
                <option>Facial Acne</option>
                <option>Facial Brightening</option>
                <option>Laser Treatment</option>
                <option>Infusion Whitening</option>
            </select>
        </div>

        <div class="form-group">
            <label>Tanggal Booking</label>
            <input type="date" id="tanggal" name="tanggal" required>
        </div>

        <div class="form-group">
            <label>Jam Booking</label>
            <input type="time" id="jam" name="jam" required>
        </div>

        <button type="submit" class="btn">Booking Sekarang</button>
    </form>

    <div class="back">
        <a href="index.php">← Kembali ke Menu Utama</a>
    </div>
</div>

<div class="footer">
    © 2025 Savienna Skincare. All Rights Reserved.
</div>

<!-- SCRIPT SIMPAN DB + WHATSAPP -->
<script>
function kirimWhatsApp(){

    let formData = new FormData();
    formData.append("nama", document.getElementById("nama").value);
    formData.append("wa", document.getElementById("wa").value);
    formData.append("treatment", document.getElementById("treatment").value);
    formData.append("tanggal", document.getElementById("tanggal").value);
    formData.append("jam", document.getElementById("jam").value);

    fetch("booking.php", {
        method: "POST",
        body: formData
    })
    .then(res => res.text())
    .then(res => {
        if(res === "success"){
            let pesan =
`Halo Savienna Skincare 👋
Saya ingin melakukan booking treatment dengan detail berikut:

Nama: ${document.getElementById("nama").value}
WhatsApp: ${document.getElementById("wa").value}
Treatment: ${document.getElementById("treatment").value}
Tanggal: ${document.getElementById("tanggal").value}
Jam: ${document.getElementById("jam").value}

Terima kasih 🙏`;

            let nomorAdmin = "6289633684343";
            window.open(
                "https://wa.me/" + nomorAdmin + "?text=" + encodeURIComponent(pesan),
                "_blank"
            );
        } else {
            alert("Booking gagal disimpan!");
        }
    });
}
</script>

</body>
</html>
