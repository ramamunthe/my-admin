<?= $this->extend('admin/master') ?>

<?= $this->section('content') ?>
<div class="container">
    <h4>Daftar Paket Wisata</h4>
    <a href="/admin-paket-create" type="button" class="btn btn-primary">Tambah Paket Wisasta</a>
    <?php if (session()->get('success')) : ?>
        <div class="alert alert-success my-3" role="alert">
            <i class="bi bi-check-circle-fill"></i> <?= session()->get('success'); ?>
        </div>
    <?php endif; ?>
    <div class="row my-3">
        <?php foreach ($paket as $row) : ?>
            <div class="col-md-4">
                <div class="card mb-3">
                    <img src="/images/<?= $row['image']; ?>" class="card-img-top p-1" alt="...">
                    <div class="card-body">
                        <div class="table-responsive"><?= $row['body']; ?></div>
                        <div class="d-flex my-3">
                            <a href="/admin-paket-delete/<?= $row['id']; ?>" onclick="return confirm('Yakin ingin menghapus data ini?')" type="button" class="btn btn-danger btn-sm me-1">Hapus</a>
                            <a href="/admin-paket-edit/<?= $row['id']; ?>" type="button" class="btn btn-secondary btn-sm">Ubah</a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
<?= $this->endSection() ?>