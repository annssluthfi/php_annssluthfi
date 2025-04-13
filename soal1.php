<?php
$step = 1;
$rows = $cols = 0;
$data = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['rows']) && isset($_POST['cols'])) {
        $rows = intval($_POST['rows']);
        $cols = intval($_POST['cols']);
        $step = 2;
    } elseif (isset($_POST['data'])) {
        $step = 3;
        $data = $_POST['data'];
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
    <title>Dinamic Table</title>
</head>

<body class="p-5">
        <?php if ($step == 1): ?>
            <div class="mb-4">
                <p class="text-center fs-2 fw-bold">Format Tabel Input</p>
                <p class="text-center fs-6">Inputkan jumlah kolom dan baris yang diinginkan pada tabel.</p>
            </div>
            <div class="d-flex justify-content-center">
                <div style="min-width: 800px;">
                    <form method="post">
                        <div class="mb-3">
                            <label class="fw-semibold form-label">Inputkan Jumlah Baris:</label>
                            <input type="number" name="rows" class="shadow-sm w-100 form-control" required>
                            <small class="form-text text-muted">Contoh: 1</small>
                        </div>
                        <div class="mb-3">
                            <label class="fw-semibold form-label">Inputkan Jumlah Kolom:</label>
                            <input type="number" name="cols" class=" shadow-sm w-100 form-control" required>
                            <small class="form-text text-muted">Contoh: 3</small>
                        </div>
                        <button type="submit" class="btn btn-primary">SUBMIT</button>
                    </form>
                </div>
            </div>
        
        <?php elseif ($step == 2): ?>
            <div class="mb-4">
                <p class="text-center fs-2 fw-bold">Input Isi Data</p>
                <p class="text-center fs-6">Masukkan data pada text box.</p>
            </div>
            <form method="post">
                <div class="border border-primary p-4 mb-4 rounded-3">
                    <?php for ($r = 1; $r <= $rows; $r++): ?>
                        <div class="row mb-3">
                            <?php for ($c = 1; $c <= $cols; $c++): ?>
                                <div class="col">
                                    <label class="fw-semibold form-label"><?php echo $r ?> : <?php echo $c; ?></label>
                                    <input type="text" name="data[<?php echo $r; ?>_<?php echo $c; ?>]" class="form-control">
                                </div>
                            <?php endfor; ?>
                        </div>
                    <?php endfor; ?>
                </div>
                <button type="submit" class="btn btn-primary">SUBMIT</button>
            </form>
        
        <?php elseif ($step == 3): ?>
            <div class="mb-4">
                <p class="text-center fs-2 fw-bold">Output Data</p>
                <p class="text-center fs-6">Hasil data yang dimasukkan pada textbox.</p>
            </div>
            <div>
                <ul class="list-group">
                    <?php foreach ($data as $key => $value): ?>
                        <li class="list-group-item"><strong><?php echo str_replace('_', '.', $key); ?></strong> :
                            <?php echo htmlspecialchars($value); ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>
</body>

</html>