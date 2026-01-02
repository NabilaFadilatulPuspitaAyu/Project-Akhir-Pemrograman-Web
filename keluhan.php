<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Keluhan & Saran | Savienna Skincare</title>
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

        input, textarea{
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
    <h1>Keluhan & Saran</h1>
    <p>Savienna Skincare</p>
</div>

<div class="container">
    <h2>Form Keluhan & Saran</h2>

    <form onsubmit="kirimKeluhan(); return false;">

        <div class="form-group">
            <label>Nama</label>
            <input type="text" id="nama" placeholder="Nama Anda" required>
        </div>

        <div class="form-group">
            <label>No. WhatsApp</label>
            <input type="tel" id="wa" placeholder="08xxxxxxxxxx" required>
        </div>

        <div class="form-group">
            <label>Pesan / Keluhan / Saran</label>
            <textarea id="pesan" rows="4" placeholder="Tuliskan keluhan atau saran Anda" required></textarea>
        </div>

        <button type="submit" class="btn">Kirim Pesan</button>
    </form>

    <div class="back">
        <a href="index.php">← Kembali ke Menu Utama</a>
    </div>
</div>

<div class="footer">
    © 2025 Savienna Skincare. All Rights Reserved.
</div>

<!-- SCRIPT AUTO WHATSAPP -->
<script>
function kirimKeluhan(){

    let nama  = document.getElementById("nama").value;
    let wa    = document.getElementById("wa").value;
    let pesan = document.getElementById("pesan").value;

    let nomorAdmin = "6289633684343"; // GANTI NOMOR ADMIN

    let text =
`Halo Savienna Skincare 👋
Saya ingin menyampaikan keluhan/saran:

Nama: ${nama}
WhatsApp: ${wa}

Pesan:
${pesan}

Terima kasih 🙏`;

    let url = "https://wa.me/" + nomorAdmin + "?text=" + encodeURIComponent(text);

    window.open(url, "_blank");
}
</script>

</body>
</html>