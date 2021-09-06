<?= $this->extend('admin/master') ?>

<?= $this->section('content') ?>
<div class="container">
    <div class="col-md-8">
        <img src="../images/<?= $paket['image']; ?>" class="img-fluid" id="output" alt="">
        <form action="/admin-paket-update" method="post" enctype="multipart/form-data">
            <input type="hidden" name="gambarLama" value="<?= $paket['image']; ?>">
            <input type="hidden" name="id" value="<?= $paket['id']; ?>">
            <div class="mb-3">
                <label for="gambar" class="form-label">Gambar</label>
                <input type="file" class="form-control" id="gambar" onchange="loadFile(event)" name="image">
            </div>
            <div class="mb-3">
                <label for="area_car" class="form-label">Deskripsi Paket</label>
                <textarea class="form-control" id="area_car" rows="3" name="body" required><?= $paket['body']; ?></textarea>
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-primary">Ubah Data</button>
            </div>
        </form>
    </div>
</div>
<?= $this->endSection() ?>