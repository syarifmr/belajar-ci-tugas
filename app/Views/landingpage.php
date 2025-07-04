<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Batik BALADINA - Selamat Datang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #f8fafc 0%, #e0e7ff 100%);
            min-height: 100vh;
        }
        .navbar {
            background: #6366f1;
        }
        .navbar-brand, .nav-link, .navbar-toggler {
            color: #fff !important;
            font-weight: 600;
        }
        .navbar-brand span {
            color: #fbbf24;
        }
        .hero {
            padding: 5rem 0 2rem 0;
            text-align: center;
        }
        .hero-title {
            font-size: 2.5rem;
            font-weight: 700;
            color: #6366f1;
        }
        .hero-desc {
            font-size: 1.2rem;
            color: #444;
            margin-bottom: 2rem;
        }
        .produk-gallery {
            padding: 2rem 0;
        }
        .produk-card {
            border-radius: 1rem;
            box-shadow: 0 4px 24px rgba(99,102,241,0.08);
            transition: transform 0.2s;
        }
        .produk-card:hover {
            transform: translateY(-8px) scale(1.03);
            box-shadow: 0 8px 32px rgba(99,102,241,0.15);
        }
        .produk-img {
            border-radius: 1rem 1rem 0 0;
            object-fit: cover;
            height: 200px;
            width: 100%;
        }
        @media (max-width: 576px) {
            .hero-title { font-size: 1.5rem; }
            .produk-img { height: 140px; }
        }
    </style>
</head>
<body>
<!-- Navbar -->
<nav class="navbar navbar-expand-lg shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="<?= base_url('/') ?>">
            <i class="fa-solid fa-store"></i> Batik <span>BALADINA</span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item"><a class="nav-link" href="<?= base_url('/') ?>">Beranda</a></li>
                <li class="nav-item"><a class="nav-link" href="<?= base_url('produk') ?>">Produk</a></li>
                <?php if (session()->get('isLoggedIn')): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('logout') ?>">Sign out</a>
                    </li>
                <?php else: ?>
                    <li class="nav-item"><a class="nav-link" href="<?= base_url('login') ?>">Log In</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= base_url('register') ?>">Register</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>    
<!-- Hero Section -->
    <section class="hero">
        <div class="container">
            <h1 class="hero-title">Selamat Datang di <span style="color:#fbbf24;">Batik BALADINA</span></h1>
            <p class="hero-desc">Temukan koleksi batik terbaik, motif eksklusif, dan kualitas premium untuk gaya Anda.<br>
            Belanja mudah, aman, dan nyaman di toko online kami.</p>
            <a href="<?= base_url('produk') ?>" class="btn btn-primary btn-lg shadow">Lihat Produk</a>
        </div>
    </section>
    <!-- Produk Gallery -->
    <section class="produk-gallery bg-white">
        <div class="container">
            <h3 class="text-center mb-4" style="color:#6366f1;font-weight:700;">Galeri Produk</h3>
            <div class="row g-4">
                <?php if (!empty($produk)): ?>
                    <?php foreach ($produk as $item): ?>
                        <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                            <div class="card produk-card h-100">
                                <img src="<?= base_url('img/' . $item['foto']) ?>" class="produk-img" alt="<?= $item['nama'] ?>">
                                <div class="card-body text-center">
                                    <h5 class="card-title"><?= esc($item['nama']) ?></h5>
                                    <p class="card-text mb-1" style="color:#6366f1;font-weight:600;">
                                        <?= number_to_currency($item['harga'], 'IDR') ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="col-12 text-center text-muted">Belum ada produk.</div>
                <?php endif; ?>
            </div>
        </div>
    </section>
</body>
</html>