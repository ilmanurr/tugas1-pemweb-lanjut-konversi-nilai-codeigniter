<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Konversi Nilai</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <h2 class="text-center">Konversi Nilai</h2>
        <div class="row justify-content-md-center">
            <div class="col-md-6">
                <?php if (session()->getFlashdata('errors')) : ?>
                <div class="alert alert-danger">
                    <?php foreach (session()->getFlashdata('errors') as $error) : ?>
                    <p><?= esc($error) ?></p>
                    <?php endforeach ?>
                </div>
                <?php endif ?>
                <form action="<?= base_url('konversi-nilai/hitung') ?>" method="post">
                    <div class="form-group">
                        <label for="partisipasi">Nilai Partisipasi:</label>
                        <input type="text" class="form-control" id="partisipasi" name="partisipasi"
                            value="<?= old('partisipasi') ?>">
                    </div>
                    <div class="form-group">
                        <label for="tugas">Nilai Tugas:</label>
                        <input type="text" class="form-control" id="tugas" name="tugas" value="<?= old('tugas') ?>">
                    </div>
                    <div class="form-group">
                        <label for="uts">Nilai UTS:</label>
                        <input type="text" class="form-control" id="uts" name="uts" value="<?= old('uts') ?>">
                    </div>
                    <div class="form-group">
                        <label for="uas">Nilai UAS:</label>
                        <input type="text" class="form-control" id="uas" name="uas" value="<?= old('uas') ?>">
                    </div>
                    <button type="submit" class="btn btn-primary">Hitung</button>
                </form>
            </div>
        </div>
        <?php if (isset($na) && isset($nh)) : ?>
        <div class="mt-3 text-center">
            <p>Nilai Akhir (NA): <?= $na ?></p>
            <p>Nilai Konversi Huruf (NH): <?= $nh ?></p>
        </div>
        <?php endif ?>
    </div>
</body>

</html>