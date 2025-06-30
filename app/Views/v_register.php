<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<div class="container mt-5">
    <h3>Register</h3>

    <?php if (session()->getFlashdata('failed')): ?>
        <div class="alert alert-danger"><?= session()->getFlashdata('failed') ?></div>
    <?php endif; ?>

    <form method="post" action="<?= base_url('register') ?>">

        <?= csrf_field() ?>
        <div class="mb-3">
            <label>Username</label>
            <input type="text" name="username" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Password (angka minimal 7 digit)</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Daftar</button>
        <a href="<?= base_url('login') ?>" class="btn btn-link">Sudah punya akun?</a>
    </form>
</div>

<?= $this->endSection() ?>