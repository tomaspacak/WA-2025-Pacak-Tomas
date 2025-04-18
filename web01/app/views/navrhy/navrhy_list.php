<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <title>Výpis návrhů</title>
    
    <!-- Bootstrap CSS -->
    
    
    <link rel="stylesheet" href="/public/css/styles.css">
</head>
<body class="bg-light">

    <div class="container mt-5">
    
        <h2>Výpis navrhů na články</h2>
        <?php if(!empty($navrhy)): ?>
            
            <h3>výpis Pro+</h3>
            <table class="table table-bordered table-hover">
                <thead class="table-primary">
                    <tr>
                        <th>Kategorie</th>
                        <th>Téma</th>
                        <th>Email</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach($navrhy as $navrh):?>
                    <tr>
                        <td><?= htmlspecialchars($navrh['kategory']) ?></td>
                        <td><?= htmlspecialchars($navrh['theme']) ?></td>
                        <td><?= htmlspecialchars($navrh['email']) ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <div class="alert alert-info">Žádná kniha nebyla nalezena</div>
        <?php endif; ?>
        
        
        <button type="button" class="btn btn-primary"><a style="color: white;" href="../../index.html">HomePage</a></button>
        <button type="button" class="btn btn-primary"><a style="color: white;" href="../views/navrhy/navrhy_edit_delete.php">Editace</a></button>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    
    

</body>
</html>