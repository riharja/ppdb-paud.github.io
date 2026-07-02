<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - PPDB PAUD</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            min-height:100vh;
            display:flex;
            align-items:center;
            justify-content:center;
            background: linear-gradient(135deg,#2c3e6b,#5c6fc7);
        }
        .login-card { width:380px; border:none; border-radius:1rem; box-shadow:0 10px 30px rgba(0,0,0,.25); }
    </style>
</head>
<body>
    <div class="card login-card p-4">
        <div class="text-center mb-3">
            <h4 class="fw-bold">PPDB PAUD</h4>
            <p class="text-muted mb-0">Silakan login untuk mengelola pendaftaran</p>
        </div>

        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger py-2"><?= esc(session()->getFlashdata('error')) ?></div>
        <?php endif; ?>

        <form action="<?= site_url('login') ?>" method="post">
            <?= csrf_field() ?>
            <div class="mb-3">
                <label class="form-label">Username</label>
                <input type="text" name="username" class="form-control" value="<?= old('username') ?>" required autofocus>
            </div>
            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Login</button>
        </form>
        <p class="text-center text-muted mt-3 mb-0" style="font-size:.8rem;">
            Default: admin / admin123
        </p>
    </div>
</body>
</html>
