<?= $this->extend('admin/master') ?>

<?= $this->section('content') ?>
<div class="container">
    <h3>Data Armada</h3>
    <p class="text-secondary">Total armada yang terdaftar <?= count($cars) ?> unit</p>
    <a href="/armada-create" type="button" class="btn btn-primary mb-3">Tambah Armada</a>


    <?php if (session()->get('success')) : ?>
        <div class="alert alert-success" role="alert">
            <i class="bi bi-check-circle-fill"></i> <?= session()->get('success'); ?>
        </div>
    <?php endif; ?>


    <div class="card mt-5 <?= count($cars) == 0 ? 'd-none' : ''; ?>">
        <div class="card-body table-responsive">
            <table class="table table-borderless align-middle table-striped">
                <thead>
                    <tr>
                        <th>Gambar</th>
                        <th>Nama</th>
                        <th>Kategori</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($cars as $car) : ?>
                        <tr>
                            <td><img class="img-table" src="/images/<?= $car['image']; ?>"></td>
                            <td><?= $car['title_car']; ?></td>
                            <td><?= $car['title_category']; ?></td>
                            <td>
                                <div class="d-flex">
                                    <button type="button" class="btn btn-danger btn-sm me-1" data-bs-toggle="modal" data-bs-target="#modalDelete<?= $car['car_id']; ?>">Hapus</button>
                                    <a href="/armada-edit/<?= $car['slug_car']; ?>" type="button" class="btn btn-secondary btn-sm">Ubah</a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>



    <!-- Modal -->
    <?php foreach ($cars as $car) : ?>
        <div class="modal fade" id="modalDelete<?= $car['car_id']; ?>" tabindex="-1" aria-labelledby="modalDeleteLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalDeleteLabel">Apakah yakin ingin mengapus data ini</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <img class="img-fluid mb-3" src="/images/<?= $car['image']; ?>">
                        <h5><?= $car['title_car']; ?></h5>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak</button>
                        <a href="/armada-delete/<?= $car['car_id']; ?>" type="button" class="btn btn-danger">Ya</a>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>


</div>
<?= $this->endSection() ?>