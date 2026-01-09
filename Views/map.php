<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mapa de Rutas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <style>
        #map {
            height: calc(100vh - 120px);
            width: 100%;
        }

        .sidebar {
            height: calc(100vh - 120px);
            overflow-y: auto;
            background: #f8f9fa;
        }

        .entrega-item {
            padding: 0.5rem;
            margin-bottom: 0.5rem;
            background: white;
            border-left: 3px solid #0d6efd;
            border-radius: 0.25rem;
        }

        .sin-coordenadas {
            opacity: 0.6;
            border-left-color: #dc3545;
        }
    </style>
</head>

<body class="bg-light">
    <nav class="navbar navbar-light bg-white shadow-sm mb-3">
        <div class="container-fluid">
            <span class="navbar-brand mb-0 h1">🗺️ Mapa de Rutas</span>
            <a href="index.php" class="btn btn-outline-secondary btn-sm">
                ← Volver
            </a>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row g-0">
            <!-- Sidebar con rutas -->
            <div class="col-md-3 sidebar p-3">
                <h5 class="mb-3">Entregas (<?php echo count($rutas); ?>)</h5>
                <?php foreach ($rutas as $index => $entrega): ?>
                    <div class="entrega-item <?php echo (empty($entrega['lat']) || empty($entrega['lng'])) ? 'sin-coordenadas' : ''; ?>">
                        <strong>#<?php echo $index + 1; ?></strong> - <?php echo htmlspecialchars($entrega['nombre']); ?><br>
                        <small><?php echo htmlspecialchars($entrega['direccion']); ?></small><br>
                        <?php if (!empty($entrega['zona'])): ?>
                            <span class="badge bg-secondary"><?php echo htmlspecialchars($entrega['zona']); ?></span>
                        <?php endif; ?>
                        <?php if (empty($entrega['lat']) || empty($entrega['lng'])): ?>
                            <span class="badge bg-danger">Sin coordenadas</span>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>

            <!-- Mapa -->
            <div class="col-md-9">
                <div id="map"></div>
            </div>
        </div>
    </div>

    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Datos de las rutas desde PHP
        const rutas = <?php echo json_encode($rutas); ?>;

        // Filtrar solo puntos con coordenadas válidas
        const points = rutas
            .filter(p => p.lat && p.lng && p.lat !== '' && p.lng !== '')
            .map(p => ({
                lat: parseFloat(p.lat),
                lng: parseFloat(p.lng),
                address: p.nombre + ' - ' + p.direccion,
                guia: p.guia
            }));

        // Inicializar mapa
        const map = L.map('map').setView([4.7, -74.1], 6);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap'
        }).addTo(map);

        // Añadir marcadores
        points.forEach(p => {
            L.marker([p.lat, p.lng])
                .addTo(map)
                .bindPopup(p.address);
        });

        // Ajustar vista si hay puntos
        if (points.length > 0) {
            const bounds = points.map(p => [p.lat, p.lng]);
            map.fitBounds(bounds);
        }
    </script>
</body>

</html>