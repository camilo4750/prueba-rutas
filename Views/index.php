<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestor de Rutas</title>
    <!-- Bootstrap CSS (solo lo necesario) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
</head>

<body class="bg-light">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="card shadow">
                    <div class="card-body p-4">
                        <h1 class="card-title text-center mb-4">Gestor de Rutas de Entrega</h1>

                        <form action="index.php?action=procesar" method="POST" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="excel" class="form-label fw-bold">Selecciona el archivo Excel:</label>
                                <input type="file"
                                    class="form-control"
                                    name="excel"
                                    id="excel"
                                    accept=".xlsx,.xls"
                                    required>
                            </div>

                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary btn-lg">
                                    Procesar Rutas
                                </button>
                            </div>
                        </form>

                        <div class="alert alert-info mt-4 mb-0" role="alert">
                            <small>El sistema procesará las direcciones, las geocodificará y optimizará el orden de entrega.</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS (solo si necesitas funcionalidades JS de Bootstrap) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>