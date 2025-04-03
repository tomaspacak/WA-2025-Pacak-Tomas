<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <title>Přidat návrh</title>
    
    <!-- Bootstrap CSS -->
    
    
    <link rel="stylesheet" href="/public/css/styles.css">
</head>
<body class="bg-light">

    <div class="container mt-5">
   
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-primary text-white text-center">
                        <h2>Máte návrh na nový článek?</h2>
                    </div>
                    <div class="card-body">
                        <form action="../../controllers/navrhController.php" method="post" enctype="multipart/form-data">
                            
                            <div class="mb-3">
                                <label for="kategory" class="form-label">Kategorie: <span class="text-danger">*</span></label>
                                <input type="text" id="kategory" name="kategory" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label for="theme" class="form-label">Téma: <span class="text-danger">*</span></label>
                                <input type="text" id="theme" name="theme" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Váš email:</label>
                                <input type="text" id="email" name="email" class="form-control">
                            </div>

                            <button type="submit" class="btn btn-success w-100">Odeslat</button>
                        </form>
                    </div>
        
                </div>
            </div>
        </div>
        <a class="btn" href=".">Zpět na domocskou stránku</a>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    
    

</body>
</html>