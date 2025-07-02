<?= $this->extend('layout') ?>
<?= $this->section('content') ?>
<h5>History Transaksi Pembelian <strong><?= $username ?></strong></h5>
<hr>
<div class="table-responsive">
    <table class="table datatable">
        <thead>
            <tr>
                <th>#</th>
                <th>ID Pembelian</th>
                <th>Waktu Pembelian</th>
                <th>Total Bayar</th>
                <th>Alamat</th>
                <th>Status</th>
                <th>Detail</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($buy)) : ?>
                <?php foreach ($buy as $index => $item) : ?>
                    <tr>
                        <th scope="row"><?= $index + 1 ?></th>
                        <td><?= $item['id'] ?></td>
                        <td><?= $item['created_at'] ?></td>
                        <td><?= number_to_currency($item['total_harga'], 'IDR') ?></td>
                        <td><?= $item['alamat'] ?></td>
                        <td>
                            <?php
                            $statusList = [
                                '0' => 'Belum Selesai',
                                '1' => 'Dikemas',
                                '2' => 'Dikirim',
                                '3' => 'Selesai',
                                'belum_selesai' => 'Belum Selesai',
                                'dikemas' => 'Dikemas',
                                'dikirim' => 'Dikirim',
                                'selesai' => 'Selesai'
                            ];
                            $statusKey = $item['status'];
                            echo isset($statusList[$statusKey]) ? $statusList[$statusKey] : $statusKey;
                            ?>
                        </td>

                        <td>
                            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#detailModal-<?= $item['id'] ?>">
                                Detail
                            </button>
                        </td>
                    </tr>

                    <!-- Detail Modal -->
                    <div class="modal fade" id="detailModal-<?= $item['id'] ?>" tabindex="-1">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Detail Data</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <?php foreach ($product[$item['id']] as $index2 => $item2) : ?>
                                        <?= $index2 + 1 ?>)
                                        <?php if ($item2['foto'] && file_exists("img/" . $item2['foto'])) : ?>
                                            <img src="<?= base_url("img/" . $item2['foto']) ?>" width="100px"><br>
                                        <?php endif; ?>
                                        <strong><?= $item2['nama'] ?></strong><br>
                                        <?= number_to_currency($item2['harga'], 'IDR') ?> x <?= $item2['jumlah'] ?> pcs<br>
                                        <strong><?= number_to_currency($item2['subtotal_harga'], 'IDR') ?></strong>
                                        <hr>
                                    <?php endforeach; ?>
                                    Ongkir: <?= number_to_currency($item['ongkir'], 'IDR') ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Modal -->

                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</div>
<?= $this->endSection() ?>