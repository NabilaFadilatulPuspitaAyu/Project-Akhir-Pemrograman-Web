<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Pricelist Treatment | Savienna Skincare</title>
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
        }

        .card{
            background:white;
            border-radius:10px;
            padding:20px;
            margin-bottom:15px;
            box-shadow:0 4px 10px rgba(0,0,0,0.1);
        }

        .card h3{
            margin:0;
            color:maroon;
            font-size:18px;
        }

        .card p{
            font-size:13px;
            margin:8px 0;
            color:#555;
        }

        .price{
            font-size:16px;
            font-weight:bold;
            color:#800000;
            margin-top:10px;
        }

        .btn{
            display:inline-block;
            margin-top:10px;
            background:maroon;
            color:white;
            padding:8px 15px;
            border-radius:6px;
            font-size:14px;
            text-decoration:none;
        }

        .btn:hover{
            background:#800000;
        }

        .back{
            text-align:center;
            margin:20px 0;
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
    <h1>Pricelist Treatment</h1>
    <p>Savienna Skincare</p>
</div>

<div class="container">

    <div class="card">
        <h3>Facial Basic</h3>
        <p>Perawatan dasar untuk membersihkan dan menjaga kelembapan kulit wajah.</p>
        <div class="price">Rp 180.000</div>
        <a href="booking.php" class="btn">Booking Sekarang</a>
    </div>

    <div class="card">
        <h3>Facial Acne</h3>
        <p>Perawatan intensif untuk kulit berjerawat dan berminyak.</p>
        <div class="price">Rp 230.000</div>
        <a href="booking.php" class="btn">Booking Sekarang</a>
    </div>

    <div class="card">
        <h3>Facial Brightening</h3>
        <p>Membantu mencerahkan dan meratakan warna kulit wajah.</p>
        <div class="price">Rp 270.000</div>
        <a href="booking.php" class="btn">Booking Sekarang</a>
    </div>

    <div class="card">
        <h3>Laser Treatment</h3>
        <p>Perawatan teknologi laser untuk flek, pori, dan regenerasi kulit.</p>
        <div class="price">Rp 520.000</div>
        <a href="booking.php" class="btn">Booking Sekarang</a>
    </div>

    <div class="card">
        <h3>Infusion Whitening</h3>
        <p>Perawatan infus untuk membantu mencerahkan kulit dari dalam.</p>
        <div class="price">Rp 780.000</div>
        <a href="booking.php" class="btn">Booking Sekarang</a>
    </div>

</div>

<div class="back">
    <a href="index.php">← Kembali ke Menu Utama</a>
</div>

<div class="footer">
    © 2025 Savienna Skincare. All Rights Reserved.
</div>

</body>
</html>