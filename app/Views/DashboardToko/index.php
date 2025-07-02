<?= $this->extend('layout') ?>
<?= $this->section('content') ?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard Toko</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="p-3 pb-md-4 mx-auto text-center">
        <h1 class="display-4 fw-normal text-body-emphasis">Dashboard - TOKO</h1>
        <p class="fs-5 text-body-secondary"><?= date("l, d-m-Y") ?> <span id="jam"></span>:<span id="menit"></span>:<span id="detik"></span></p>
    </div>
    <hr>

    <div class="table-responsive card m-5 p-5">
        <table class="table text-center">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Username</th>
                    <th>Alamat</th>
                    <th>Total Harga</th>
                    <th>Ongkir</th>
                    <th>Status</th>
                    <th>Tanggal Transaksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($transactions)) :
                    $i = 1;
                    $statusOptions = [
                        'belum_selesai' => 'Belum Selesai',
                        'dikemas' => 'Dikemas',
                        'dikirim' => 'Dikirim',
                        'selesai' => 'Selesai'
                    ];
                    foreach ($transactions as $item1) :
                ?>
                        <tr>
                            <td><?= $i++ ?></td>
                            <td><?= $item1['username']; ?></td>
                            <td><?= $item1['alamat']; ?></td>
                            <td><?= number_format($item1['total_harga'], 0, ',', '.') ?></td>
                            <td><?= number_format($item1['ongkir'], 0, ',', '.') ?></td>
                            <td>

                                <form action="<?= base_url('transaksi/updateStatus') ?>" method="post">
                                    <input type="hidden" name="id" value="<?= $item1['id'] ?>">
                                    <select name="status" class="form-select" onchange="this.form.submit()">
                                        <?php foreach ($statusOptions as $value => $label) : ?>
                                            <option value="<?= $value ?>" <?= $item1['status'] == $value ? 'selected' : '' ?>>
                                                <?= $label ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </form>
                            </td>
                            <td><?= $item1['created_at']; ?></td>
                        </tr>
                <?php endforeach;
                endif; ?>
            </tbody>
        </table>
        <center>
            <a href="<?= base_url('DashboardToko/export-pdf') ?>" class="btn btn-danger mb-3" target="_blank">
                Export PDF
            </a>
        </center>
    </div>

    <script>
        window.setTimeout("waktu()", 1000);

        function waktu() {
            var waktu = new Date();
            setTimeout("waktu()", 1000);
            document.getElementById("jam").innerHTML = waktu.getHours();
            document.getElementById("menit").innerHTML = waktu.getMinutes();
            document.getElementById("detik").innerHTML = waktu.getSeconds();
        }
    </script>
</body>

</html>
<?= $this->endSection() ?>