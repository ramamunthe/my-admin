<?= $this->extend('admin/master') ?>

<?= $this->section('content') ?>
<div class="container">
    <div class="col-md-8">
        <img src="../images/gambar.png" class="img-fluid" id="output" alt="">
        <form action="/admin-paket-store" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="gambar" class="form-label">Gambar</label>
                <input type="file" class="form-control" id="gambar" onchange="loadFile(event)" name="image" required>
            </div>
            <div class="mb-3">
                <label for="area_car" class="form-label">Deskripsi Paket</label>
                <textarea class="form-control" id="area_car" rows="3" name="body"></textarea>
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-primary">Tambahkan</button>
            </div>
        </form>
    </div>
</div>
<?= $this->endSection() ?>