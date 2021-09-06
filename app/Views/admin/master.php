<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <script src="https://cdn.tiny.cloud/1/5xockfv01u8n7b63mapza8mjxhr9x0606z4fvkb8hhvhl337/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <link rel="stylesheet" href="/css/app.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-white">
        <div class="container">
            <a class="navbar-brand" href="/">Admin Website</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-between" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-link active" href="#">Armada</a>
                    <a class="nav-link" href="#">Kategori</a>
                    <a class="nav-link" href="#">Slider</a>
                </div>
                <div class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="profilNav" data-bs-toggle="dropdown">
                            Selamat datang, Admin
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="profilNav">
                            <li><a class="dropdown-item" href="#">Edit Profil</a></li>
                            <li><a class="dropdown-item" href="#">Keluar</a></li>
                        </ul>
                    </li>
                </div>
            </div>
        </div>
    </nav>

    <section class="mt-5">
        <?= $this->renderSection('content') ?>
    </section>

    <script src="/js/app.js"></script>
    <script src="/js/script.js"></script>

</body>

</html>