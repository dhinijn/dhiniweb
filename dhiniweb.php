<?php
// Simple CRUD using JSON file storage (no database)

// Path to data file
$dataFile = __DIR__ . '/data.json';

// Load existing data or initialize
if (!file_exists($dataFile)) {
    file_put_contents($dataFile, json_encode([]));
}
$data = json_decode(file_get_contents($dataFile), true);

// Handle Create
if (isset($_POST['add'])) {
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $data[] = [
        'id' => time(),
        'nama' => $nama,
        'email' => $email
    ];
    file_put_contents($dataFile, json_encode($data));
    header('Location: index.php');
    exit();
}

// Handle Delete
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $data = array_filter($data, function($item) use ($id) {
        return $item['id'] != $id;
    });
    file_put_contents($dataFile, json_encode($data));
    header('Location: index.php');
    exit();
}

// Handle Update
if (isset($_POST['update'])) {
    $id = $_POST['id'];

    foreach ($data as &$item) {
        if ($item['id'] == $id) {
            $item['nama'] = $_POST['nama'];
            $item['email'] = $_POST['email'];
        }
    }

    file_put_contents($dataFile, json_encode($data));
    header('Location: index.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>CRUD Simple</title>
    <style>
        body { font-family: Arial; padding: 30px; }
        .card { background: #fff; padding: 20px; border-radius: 10px; width: 400px; margin-bottom: 20px; box-shadow: 0 2px 8px rgba(0,0,0,0.1); }
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 8px; border-bottom: 1px solid #ddd; }
        button { padding: 5px 10px; }
    </style>
</head>
<body>
<h2>CRUD Web Simple (Tanpa Database)</h2>

<div class="card">
    <h3>Tambah Data</h3>
    <form method="POST">
        <input type="text" name="nama" placeholder="Nama" required><br><br>
        <input type="email" name="email" placeholder="Email" required><br><br>
        <button type="submit" name="add">Tambah</button>
    </form>
</div>

<div class="card">
    <h3>Data List</h3>
    <table>
        <tr>
            <th>Nama</th>
            <th>Email</th>
            <th>Aksi</th>
        </tr>
        <?php foreach ($data as $item): ?>
        <tr>
            <td><?= $item['nama'] ?></td>
            <td><?= $item['email'] ?></td>
            <td>
                <a href="?edit=<?= $item['id'] ?>">Edit</a> |
                <a href="?delete=<?= $item['id'] ?>" onclick="return confirm('Hapus?')">Hapus</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</div>

<?php if (isset($_GET['edit'])): 
    $id = $_GET['edit'];
    $editData = array_values(array_filter($data, fn($x) => $x['id'] == $id))[0];
?>
<div class="card">
    <h3>Edit Data</h3>
    <form method="POST">
        <input type="hidden" name="id" value="<?= $editData['id'] ?>">
        <input type="text" name="nama" value="<?= $editData['nama'] ?>" required><br><br>
        <input type="email" name="email" value="<?= $editData['email'] ?>" required><br><br>
        <button type="submit" name="update">Update</button>
    </form>
</div>
<?php endif; ?>

</body>
</html>