<?php include('koneksi.php'); ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Input Data Motor Bekas</title>
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

        /* Form styling */
        .form-card {
            background: rgba(255, 255, 255, 0.95);
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
            backdrop-filter: blur(10px);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .form-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(0,0,0,0.3);
        }
        .form-group {
            margin-bottom: 20px;
            position: relative;
        }
        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #555;
            font-size: 1.1em;
        }
        .input-icon {
            position: relative;
        }
        .input-icon i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #4CAF50;
        }
        input[type="text"],
        input[type="number"] {
            width: 100%;
            padding: 15px 15px 15px 45px;
            border: 2px solid #e0e0e0;
            border-radius: 10px;
            font-size: 1em;
            transition: all 0.3s ease;
            background: #f9f9f9;
        }
        input[type="text"]:focus,
        input[type="number"]:focus {
            border-color: #4CAF50;
            box-shadow: 0 0 10px rgba(76, 175, 80, 0.3);
            background: #fff;
            outline: none;
        }
        input[type="submit"] {
            background: linear-gradient(45deg, #4CAF50, #45a049);
            color: white;
            padding: 15px 30px;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            font-weight: 700;
            font-size: 1.1em;
            transition: all 0.3s ease;
            width: 100%;
            box-shadow: 0 4px 15px rgba(76, 175, 80, 0.3);
        }
        input[type="submit"]:hover {
            background: linear-gradient(45deg, #45a049, #4CAF50);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(76, 175, 80, 0.4);
        }

        /* Pesan hasil */
        .message {
            padding: 15px 20px;
            margin-bottom: 20px;
            border-radius: 10px;
            font-weight: 600;
            text-align: center;
            animation: slideIn 0.5s ease;
        }
        @keyframes slideIn {
            from { opacity: 0; transform: translateX(-100%); }
            to { opacity: 1; transform: translateX(0); }
        }
        .success {
            background: linear-gradient(45deg, #d4edda, #c3e6cb);
            border: 1px solid #c3e6cb;
            color: #155724;
        }
        .error {
            background: linear-gradient(45deg, #f8d7da, #f5c6cb);
            border: 1px solid #f5c6cb;
            color: #721c24;
        }

        /* Table styling */
        .table-card {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
            overflow: hidden;
            backdrop-filter: blur(10px);
        }
        h3 {
            color: #34495e;
            text-align: center;
            padding: 20px;
            background: linear-gradient(45deg, #4CAF50, #45a049);
            color: white;
            margin: 0;
            font-size: 1.8em;
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
        }
        tr:nth-child(even) {
            background: #f8f9fa;
        }
        tr:hover {
            background: #e8f5e8;
            transform: scale(1.02);
            transition: all 0.2s ease;
        }
        td.price {
            text-align: right;
            font-weight: 600;
            color: #27ae60;
            font-size: 1.1em;
        }
        td.stok {
            font-weight: 600;
            color: #2980b9;
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
            .form-card, .table-card {
                margin: 0 10px;
            }
            th, td {
                padding: 10px 5px;
                font-size: 0.85em;
            }
            input[type="submit"] {
                padding: 12px 20px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h2><i class="fas fa-motorcycle"></i> Input Data Sepeda Motor Bekas</h2>

        <?php
        // Inisialisasi pesan
        $message = "";
        $msgClass = "";

        if (isset($_POST['simpan'])) {
            $merk = mysqli_real_escape_string($conn, $_POST['merk']);
            $tipe = mysqli_real_escape_string($conn, $_POST['tipe']);
            $tahun = (int) $_POST['tahun'];
            $harga = (int) $_POST['harga'];
            $stok = (int) $_POST['stok'];

            $sql = "INSERT INTO motor (merk, tipe, tahun, harga, stok)
                    VALUES ('$merk', '$tipe', $tahun, $harga, $stok)";

            if (mysqli_query($conn, $sql)) {
                $message = "<i class='fas fa-check-circle'></i> Data berhasil disimpan!";
                $msgClass = "success";
            } else {
                $message = "<i class='fas fa-exclamation-triangle'></i> Error: " . mysqli_error($conn);
                $msgClass = "error";
            }
        }

        if (!empty($message)) {
            echo "<div class='message $msgClass'>{$message}</div>";
        }
        ?>

        <div class="form-card">
            <form method="POST" autocomplete="off" aria-label="Form input data motor bekas">
                <div class="form-group">
                    <label for="merk"><i class="fas fa-tag"></i> Merk:</label>
                    <div class="input-icon">
                        <i class="fas fa-motorcycle"></i>
                        <input type="text" name="merk" id="merk" placeholder="Masukkan merk motor" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="tipe"><i class="fas fa-cogs"></i> Tipe:</label>
                    <div class="input-icon">
                        <i class="fas fa-wrench"></i>
                        <input type="text" name="tipe" id="tipe" placeholder="Masukkan tipe motor" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="tahun"><i class="fas fa-calendar-alt"></i> Tahun:</label>
                    <div class="input-icon">
                        <i class="fas fa-calendar"></i>
                        <input type="number" name="tahun" id="tahun" placeholder="Tahun produksi" min="1900" max="2100" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="harga"><i class="fas fa-dollar-sign"></i> Harga:</label>
                    <div class="input-icon">
                        <i class="fas fa-money-bill-wave"></i>
                        <input type="number" name="harga" id="harga" placeholder="Harga motor (Rp)" min="0" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="stok"><i class="fas fa-boxes"></i> Stok:</label>
                    <div class="input-icon">
                        <i class="fas fa-warehouse"></i>
                        <input type="number" name="stok" id="stok" placeholder="Jumlah stok tersedia" min="0" required>
                    </div>
                </div>

                <input type="submit" name="simpan" value="Simpan Data">
            </form>
        </div>

        <div class="table-card">
            <h3><i class="fas fa-list"></i> Data Motor Bekas</h3>
            <table aria-describedby="Data motor bekas yang tersimpan di database">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Merk</th>
                        <th>Tipe</th>
                        <th>Tahun</th>
                        <th>Harga</th>
                        <th>Stok</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                $result = mysqli_query($conn, "SELECT * FROM motor ORDER BY id_motor DESC");
                if(mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>
                                <td>{$row['id_motor']}</td>
                                <td>{$row['merk']}</td>
                                <td>{$row['tipe']}</td>
                                <td>{$row['tahun']}</td>
                                <td class='price'>Rp ".number_format($row['harga'], 0, ',', '.')."</td>
                                <td class='stok'>{$row['stok']}</td>
                            </tr>";
                    }
                } else {
                    echo "<tr><td colspan='6' class='no-data'>Tidak ada data motor tersedia.</td></tr>";
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>

    <script>
        // Tambahkan animasi sederhana untuk form
        document.querySelectorAll('input').forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.style.transform = 'scale(1.02)';
            });
            input.addEventListener('blur', function() {
                this.parentElement.style.transform = 'scale(1)';
            });
        });
    </script>
</body>
</html>
