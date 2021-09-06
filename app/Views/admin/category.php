<?= $this->extend('admin/master') ?>

<?= $this->section('content') ?>
<div class="container">
    <h3>Daftar Kategori</h3>
    <button type="button" class="btn btn-primary my-3" data-bs-toggle="modal" data-bs-target="#modalTambah">Tambah Kategori</button>

    <?php if (session()->get('success')) : ?>
        <div class="alert alert-success my-3" role="alert">
            <i class="bi bi-check-circle-fill"></i> <?= session()->get('success'); ?>
        </div>
    <?php endif; ?>

    <div class="text-danger">
        <?= $validation->listErrors() ?>
    </div>

    <div class="card">
        <div class="card-body table-responsive">
            <table class="table table-striped table-borderless align-middle">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama Category</th>
                        <th>Slug</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1 ?>
                    <?php foreach ($categories as $category) : ?>
                        <tr>
                            <th><?= $i++; ?></th>
                            <td><?= $category['title_category']; ?></td>
                            <td><?= $category['slug_category']; ?></td>
                            <td>
                                <div class="d-flex">
                                    <a href="/admin-category-delete/<?= $category['category_id']; ?>" onclick="return confirm('Yakin ingin menghapus data ini?')" type="button" class="btn btn-danger btn-sm me-1">Delete</a>
                                    <button type="button" class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#modalUbah<?= $category['slug_category']; ?>">Ubah</button>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal Tambah -->
    <div class="modal fade" id="modalTambah" tabindex="-1" aria-labelledby="modalTambahLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTambahLabel">Form Tambah Kategori</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="/admin-category-store" method="post">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="category_title" class="form-label">Nama Kategory</label>
                            <input type="text" class="form-control" id="category_title" name="title_category" value="<?= old('title_category') ?>" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Tambahkan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Tambah -->
    <?php foreach ($categories as $category) : ?>
        <div class="modal fade" id="modalUbah<?= $category['slug_category']; ?>" tabindex="-1" aria-labelledby="modalUbahLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalUbahLabel">Form Ubah Kategori</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="/admin-category-update/<?= $category['category_id']; ?>" method="post">
                        <input type="hidden" name="category_id" value="<?= $category['category_id']; ?>">
                        <input type="hidden" name="slug_category" value="<?= $category['slug_category']; ?>">
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="category_title" class="form-label">Nama Kategory</label>
                                <input type="text" class="form-control" id="category_title" name="title_category" value="<?= (old('title_category') ? old('title_category') : $category['title_category']) ?>" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Ubah Data</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <?php endforeach; ?>


</div>


<?= $this->endSection() ?>