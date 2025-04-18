<?php
require_once '../../models/Database.php';
require_once '../../models/navrh.php';

$db = (new Database())->getConnection();
$navrhModel = new navrh($db);
$navrhy = $navrhModel->getAll();

$editMode = false;
$bookToEdit = null;

if (isset($_GET['edit'])) {
    $editId = (int)$_GET['edit'];
    $bookToEdit = $navrhModel->getById($editId);
    if ($bookToEdit) {
        $editMode = true;
    }
}
?>

<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <title>Editace návrhů</title>
    
    <!-- Bootstrap CSS -->
    
    
    <link rel="stylesheet" href="/public/css/styles.css">
</head>
<body class="bg-light">

    <div class="container mt-5">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Blog</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Přepnout navigaci">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="../../views/navrhy/navrh_create.php">Přidat</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../../controllers/navrhy_list.php">Výpis</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../../auth/register.php">Registrace</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <h1>Editace návrhů</h1>
        <h2>Výpis</h2>
        <?php if (!empty($navrhy)): ?>
        <table class="table table-bordered table-hover">
            <thead class="table-primary">
                    <tr>
                        <th>ID</th>
                        <th>Kategorie</th>
                        <th>Téma</th>
                        <th>Email</th>
                    </tr>
            </thead>
            <tbody>
            <?php foreach ($navrhy as $navrh): ?>
                <tr>
                    <td><?= htmlspecialchars($navrh['id']) ?></td>
                    <td><?= htmlspecialchars($navrh['kategory']) ?></td>
                    <td><?= htmlspecialchars($navrh['theme']) ?></td>
                    <td><?= htmlspecialchars($navrh['email']) ?></td>
                    <td>
                        <a href="?edit=<?= $navrh['id'] ?>" class="btn btn-sm btn-warning">Upravit</a>
                        <a href="../../controllers/navrh_delete.php?id=<?= $navrh['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Opravdu chcete smazat tuto knihu?');">Smazat</a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    
        <?php else: ?>
        <div class="alert alert-info">Žádná kniha nebyla nalezena.</div>
    <?php endif; ?>
    
    <?php if ($editMode): ?>
        <div class="row justify-content-center mt-5">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-primary text-white text-center">
                    <h2>Upravit návrh: <?= htmlspecialchars($bookToEdit['theme']) ?></h2>
                    </div>
                    <div class="card-body">
                        <form action="../../controllers/navrh_update.php" method="post">
                            <input type="hidden" name="id" value="<?= $bookToEdit['id'] ?>">
                            <div class="mb-3">
                                <label class="form-label">ID knihy:</label>
                                <input type="text" class="form-control" value="<?= $bookToEdit['id'] ?>" disabled>
                            </div>
                            <div class="mb-3">
                                <label for="theme" class="form-label">Téma:</label>
                                <input type="text" id="theme" name="theme" class="form-control" required value="<?= htmlspecialchars($bookToEdit['theme']) ?>">
                            </div>

                            <div class="mb-3">
                                <label for="kategory" class="form-label">Kategorie:</label>
                                <input type="text" id="kategory" name="kategory" class="form-control" required value="<?= htmlspecialchars($bookToEdit['kategory']) ?>">
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email:</label>
                                <input type="text" id="email" name="email" class="form-control" value="<?= htmlspecialchars($bookToEdit['email']) ?>">
                            </div>

                            <button type="submit" class="btn btn-success w-100">Uložit změny</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>

    
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    
    

</body>
</html>