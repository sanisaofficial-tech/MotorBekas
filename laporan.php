<?php include('koneksi.php'); ?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Penjualan</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        /* Reset dan font */
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            color: #333;
            padding: 20px;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            flex-direction: column;
            gap: 30px;
        }

        h2 {
            color: #fff;
            text-align: center;
            font-size: 2.5em;
            margin-bottom: 20px;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
            animation: fadeIn 1s ease-in;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Table styling */
        .table-card {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
            overflow: hidden;
            backdrop-filter: blur(10px);
            animation: slideUp 0.8s ease;
        }

        @keyframes slideUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.95em;
        }

        th, td {
            padding: 15px;
            text-align: center;
            border-bottom: 1px solid #eee;
        }

        th {
            background: linear-gradient(45deg, #4CAF50, #45a049);
            color: white;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            position: sticky;
            top: 0;
            z-index: 1;
        }

        tr:nth-child(even) {
            background: #f8f9fa;
        }

        tr:hover {
            background: #e8f5e8;
            transform: scale(1.01);
            transition: all 0.2s ease;
        }

        td.total {
            font-weight: 600;
            color: #27ae60;
            font-size: 1.1em;
        }

        .grand-total {
            background: linear-gradient(45deg, #ff6b6b, #ee5a24);
            color: white;
            font-weight: 700;
            font-size: 1.2em;
            text-transform: uppercase;
        }

        .grand-total th, .grand-total td {
            padding: 20px;
            border: none;
        }

        .no-data {
            text-align: center;
            padding: 40px;
            color: #777;
            font-style: italic;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .container {
                padding: 10px;
            }
            h2 {
                font-size: 2em;
            }
            .table-card {
                margin: 0 10px;
            }
            th, td {
                padding: 10px 5px;
                font-size: 0.85em;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h2><i class="fas fa-chart-line"></i> Laporan Penjualan Sepeda Motor Bekas</h2>

        <div class="table-card">
            <table>
                <thead>
                    <tr>
                        <th><i class="fas fa-hashtag"></i> No</th>
                        <th><i class="fas fa-tag"></i> Merk</th>
                        <th><i class="fas fa-cogs"></i> Tipe</th>
                        <th><i class="fas fa-calendar-alt"></i> Tanggal</th>
                        <th><i class="fas fa-boxes"></i> Jumlah</th>
                        <th><i class="fas fa-dollar-sign"></i> Total</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                $result = mysqli_query($conn, "SELECT t.*, m.merk, m.tipe  
                FROM transaksi t JOIN motor m ON t.id_motor=m.id_motor  
                ORDER BY tanggal DESC");
                $no = 1;
                $grandtotal = 0;
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>
                                <td>$no</td>
                                <td>{$row['merk']}</td>
                                <td>{$row['tipe']}</td>
                                <td>{$row['tanggal']}</td>
                                <td>{$row['jumlah']}</td>
                                <td class='total'>Rp " . number_format($row['total'], 0, ',', '.') . "</td>
                            </tr>";
                        $grandtotal += $row['total'];
                        $no++;
                    }
                    echo "<tr class='grand-total'>
                            <th colspan='5'><i class='fas fa-calculator'></i> Total Penjualan</th>
                            <td>Rp " . number_format($grandtotal, 0, ',', '.') . "</td>
                        </tr>";
                } else {
                    echo "<tr><td colspan='6' class='no-data'>Tidak ada data penjualan tersedia.</td></tr>";
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>