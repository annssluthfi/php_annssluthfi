<?php
    $host = "localhost";
    $user = "root";
    $password = "";
    $database = "testdb";
    $conn = mysqli_connect($host, $user, $password, $database);

    if (!$conn) {
        die("Koneksi gagal: " . mysqli_connect_error());
    }

    $hobby = "";
    if (isset($_GET['search'])) {
        $hobby = mysqli_real_escape_string($conn, $_GET['search']);
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
    <title></title>
</head>

<body class="p-5">
    <div class="container">
    <h2 class="mb-4 text-center">Daftar Hobi</h2>

    <form method="GET" class="mb-4 d-flex justify-content-center" role="search">
        <input type="text" name="search" class="form-control w-100 me-2" placeholder="Cari Hobi" value="<?= htmlspecialchars($hobby); ?>">
            <button type="submit" class="btn btn-primary">Search</button>
        </form>
    
        <!-- Tabel Data -->
        <table class="table table-bordered shadow rounded-3">
            <thead class="table-warning" >
                <tr>
                    <th>Hobi</th>
                    <th>Jumlah Person</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT hobi.hobi, COUNT(person.id) AS jumlah_person
                    FROM hobi
                    INNER JOIN person ON hobi.person_id = person.id
                    GROUP BY hobi.hobi
                    ORDER BY jumlah_person DESC";

                if (!empty($hobby)) {
                    $sql = "SELECT hobi.hobi, COUNT(person.id) AS jumlah_person
                    FROM hobi
                    INNER JOIN person ON hobi.person_id = person.id
                    WHERE hobi.hobi LIKE '%$hobby%'
                    GROUP BY hobi.hobi
                    ORDER BY jumlah_person DESC";
                }

                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>{$row['hobi']}</td>";
                        echo "<td>{$row['jumlah_person']}</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='3' class='text-center'>Data tidak ditemukan.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>

</html>