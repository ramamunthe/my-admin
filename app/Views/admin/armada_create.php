<?= $this->extend('admin/master') ?>

<?= $this->section('content') ?>
<div class="container">




    <div class="text-danger">
        <?= $validation->listErrors() ?>
    </div>

    <div class="row">
        <div class="col-md-6">
            <img class="img-fluid" src="../images/gambar.png" alt="" id="output">
        </div>
        <div class="col-md-6">
            <form action="/armada-store" method="post" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="gambar" class="form-label">Gambar</label>
                    <input type="file" class="form-control" id="gambar" onchange="loadFile(event)" name="image" value="<?= old('image') ?>>
                </div>
                <div class=" mb-3">
                    <label for="title" class="form-label">Nama Armada</label>
                    <input type="text" class="form-control" id="title" name="title_car" value="<?= old('title_car') ?>">
                </div>
                <div class="mb-3">
                    <label class="form-label">Kategori Armada</label>
                    <select class="form-select" name="category_id">
                        <option selected disabled>Pilih Kategori</option>
                        <?php foreach ($categories as $category) : ?>
                            <option value=" <?= $category['category_id']; ?>"><?= $category['title_category']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="area_car" class="form-label">Deskripsi Armada</label>
                    <textarea class="form-control" id="area_car" rows="3" name="body_car"><?= old('body_car') ?></textarea>
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">Tambahkan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection() ?>