<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
</head>

<body>
    <div class="p-3 pb-md-4 mx-auto text-center">
        <h1 class="display-4 fw-normal text-body-emphasis">Cetak Data Transaksi</h1>
        <p class="fs-5 text-body-secondary"><?= date("l, d-m-Y") ?></p>
    </div>
    <hr>
    <div class="table-responsive card m-5 p-5">
        <table class="table text-center">
            <thead>
                <tr>
                    <th style="width: 5%;">No</th>
                    <th style="width: 10%;">Username</th>
                    <th style="width: 30%;">Alamat</th>
                    <th style="width: 10%;">Total Harga</th>
                    <th style="width: 10%;">Ongkir</th>
                    <th style="width: 10%;">Status</th>
                    <th style="width: 25%;">Tanggal Transaksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($transactions)) {
                    $i = 1;
                    foreach ($transactions as $item1) {
                ?>
                        <tr>
                            <td><?= $i++ ?></td>
                            <td><?= $item1['username']; ?></td>
                            <td><?= $item1['alamat']; ?></td>
                            <td><?= $item1['total_harga']; ?></td>
                            <td><?= $item1['ongkir']; ?></td>
                            <td><?= $item1['status']; ?></td>
                            <td><?= $item1['created_at']; ?></td>
                        </tr>
                <?php }
                } else { ?>
                    <tr>
                        <td colspan="7">Tidak ada data transaksi.</td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <script>
        window.print();
    </script>
</body>

</html>