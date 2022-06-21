<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="apple-touch-icon" sizes="76x76" href="<?= base_url() ?>/assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="<?= base_url() ?>/assets/img/favicon.png">
  <title>Login SIM-IHBS</title>
  <link href="https://fonts.googleapis.com/css?family=Karla:400,700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.8.95/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?= base_url('assets/css/login.css') ?>">
</head>
<body>
  <main class="d-flex align-items-center min-vh-100 py-3 py-md-0">
    <div class="container">
        <div class="card login-card">
            <div class="row no-gutters">
            <div class="col-md-7">
                <img src="<?= base_url('assets/images/bg-login.jpg') ?>" alt="login" class="login-card-img">
            </div>
            <div class="col-md-5">
                <div class="card-body">
                <div class="brand-wrapper">
                    <img src="<?= base_url('assets/images/logo-text.png') ?>" alt="logo" class="logo">
                </div>
                <p class="login-card-description" id="test" style="display: none;">Sign into your account</p>
                <div class="alert alert-danger text-center" role="alert" style="font-size: 15px; display:none;"></div>
                <form method="post" id="doLogin">
                    <?= csrf_field() ?>
                    <input type="hidden" name="action" id="action" value="/doLogin">
                    <div class="form-group">
                        <label for="accesskey" class="sr-only">Access Key</label>
                        <input type="text" class="form-control" name="accesskey" id="accesskey" value="<?= old('accesskey') ?>" placeholder="Access Key" style="margin-bottom: 0px;">
                        <div class="invalid-feedback" id="accesskey-feedback"></div>
                    </div>
                    <div class="form-group mb-4">
                        <label for="password" class="sr-only">Password</label>
                        <input type="password" name="password" id="password" class="form-control" value="<?= old('password') ?>" placeholder="Password" style="margin-bottom: 0px;">
                        <div class="invalid-feedback mx-0" id="password-feedback"></div>
                    </div>
                    <input name="login" id="login" class="btn btn-block login-btn mb-4" type="submit" value="Login">
                    </form>
                    <!--<a href="#!" class="forgot-password-link">Forgot password?</a>-->
                    <p class="login-card-footer-text"><a href="#!" class="text-reset">Contact admin, if you have trouble</a></p>
                </div>
            </div>
        </div>
    </div>
  </main>
  <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
  <!-- <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script> -->
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
  <script src="<?= base_url('assets/js/doLogin.js') ?>"></script>
</body>
</html>
