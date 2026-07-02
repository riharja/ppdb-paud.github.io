<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title ?? 'PPDB PAUD') ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body { background:#f4f6f9; }
        .sidebar {
            min-height: 100vh;
            background: #2c3e6b;
        }
        .sidebar a {
            color: #dfe4ff;
            text-decoration: none;
            display:block;
            padding: .65rem 1.2rem;
            border-radius: .4rem;
        }
        .sidebar a:hover, .sidebar a.active {
            background: #46579c;
            color:#fff;
        }
        .brand {
            color:#fff;
            font-weight:700;
            padding: 1rem 1.2rem;
            font-size: 1.1rem;
        }
        .card { border:none; box-shadow: 0 2px 10px rgba(0,0,0,.06); border-radius:.7rem; }
        .foto-preview { width:110px; height:110px; object-fit:cover; border-radius:.5rem; border:1px solid #dee2e6; }
    </style>
</head>
<body>
<div class="d-flex">
    <div class="sidebar p-2" style="width:230px;">
        <div class="brand"><i class="bi bi-mortarboard-fill"></i> PPDB PAUD</div>
        <nav class="mt-3">
            <a href="<?= site_url('dashboard') ?>" class="<?= uri_string() == 'dashboard' ? 'active' : '' ?>">
                <i class="bi bi-speedometer2"></i> Dashboard
            </a>
            <a href="<?= site_url('pendaftaran') ?>" class="<?= str_contains(uri_string(), 'pendaftaran') ? 'active' : '' ?>">
                <i class="bi bi-people-fill"></i> Data Pendaftaran
            </a>
            <a href="<?= site_url('logout') ?>">
                <i class="bi bi-box-arrow-right"></i> Logout
            </a>
        </nav>
    </div>

    <div class="flex-fill">
        <nav class="navbar navbar-light bg-white shadow-sm px-4">
            <span class="fw-semibold"><?= esc($title ?? '') ?></span>
            <span class="text-muted"><i class="bi bi-person-circle"></i> <?= esc(session()->get('nama')) ?></span>
        </nav>

        <div class="container-fluid p-4">
            <?php if (session()->getFlashdata('success')): ?>
                <div class="alert alert-success alert-dismissible fade show">
                    <?= esc(session()->getFlashdata('success')) ?>
                    <button class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php endif; ?>
            <?php if (session()->getFlashdata('error')): ?>
                <div class="alert alert-danger alert-dismissible fade show">
                    <?= esc(session()->getFlashdata('error')) ?>
                    <button class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php endif; ?>

            <?= $this->renderSection('content') ?>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
