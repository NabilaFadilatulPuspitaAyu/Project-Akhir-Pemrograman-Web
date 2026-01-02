<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Savienna Skincare</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f7f4f4;
            color: #333;
        }

        .header {
            background: maroon;
            color: white;
            text-align: center;
            padding: 30px 15px;
        }

        .header h1 {
            margin: 0;
            font-size: 28px;
        }

        .header p {
            margin-top: 5px;
            font-size: 14px;
        }

        .info {
            background: #f0e6e6;
            margin: 20px;
            padding: 15px;
            border-radius: 8px;
            text-align: center;
            font-size: 14px;
        }

        .menu {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
            padding: 20px;
        }

        .menu-card {
            background: white;
            border-radius: 50%;
            width: 150px;
            height: 150px;
            margin: auto;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            cursor: pointer;
            transition: 0.3s;
        }

        .menu-card:hover {
            transform: scale(1.05);
        }

        .menu-card .icon {
            font-size: 36px;
            color: maroon;
        }

        .menu-card h3 {
            margin: 10px 0 0;
            font-size: 14px;
            color: maroon;
        }

        .footer {
            background: maroon;
            color: white;
            text-align: center;
            padding: 15px;
            font-size: 12px;
            margin-top: 30px;
        }
    </style>
</head>
<body>

<div class="header">
    <h1>Savienna Skincare</h1>
    <p>Luxury Skin Care Experience</p>
</div>

<div class="info">
    Dapatkan kemudahan booking treatment, melihat pricelist treatment,
    menyampaikan keluhan & saran, serta pembelian produk Savienna Skincare.
</div>

<div class="menu">

    <div class="menu-card" onclick="location.href='booking.php'">
        <div class="icon">📅</div>
        <h3>Booking Treatment</h3>
    </div>

    <div class="menu-card" onclick="location.href='pricelist.php'">
        <div class="icon">💎</div>
        <h3>Pricelist Treatment</h3>
    </div>

    <div class="menu-card" onclick="location.href='keluhan.php'">
        <div class="icon">📝</div>
        <h3>Keluhan & Saran</h3>
    </div>

    <div class="menu-card" onclick="location.href='produk.php'">
        <div class="icon">🛒</div>
        <h3>Pembelian Produk</h3>
    </div>

</div>

<div class="footer">
    © 2025 Savienna Skincare. All Rights Reserved.
</div>

</body>
</html>