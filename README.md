# Documentación del Proyecto PHP Gestor de Rutas

## Descripción

Este proyecto es una aplicación web desarrollada en PHP que permite procesar archivos Excel con rutas de entrega, geocodificar las direcciones y visualizarlas en un mapa interactivo. La aplicación utiliza el patrón de diseño MVC, PhpSpreadsheet para leer archivos Excel, Leaflet para la visualización de mapas y OpenStreetMap Nominatim para la geocodificación de direcciones.

## Estructura de Carpetas

- Se usa el patrón de diseño MVC

```plaintext
rutas/
│
├── index.php               
├── config.php
│
├── Controllers/
│   └── RouteController.php
│
├── Views/
│   ├── index.php
│   └── map.php
│
├── uploads/
│   └── (archivos Excel subidos)
│
├── vendor/
│   └── (dependencias de Composer)
│
├── composer.json
├── composer.lock
└── README.md
```

## Tecnologías

- PHP 8.2+
- PhpSpreadsheet (para leer archivos Excel)
- Bootstrap 5.3
- Leaflet (para mapas interactivos)
- OpenStreetMap Nominatim (para geocodificación)
- Sesiones PHP (para almacenamiento temporal)


## Instalación

1. Clonar el repositorio
2. Instalar las dependencias de Composer:
   ```bash
   composer install
   ```

## Uso

1. Abrir el proyecto en el navegador
2. Seleccionar un archivo Excel (.xlsx o .xls) con la estructura de rutas
3. Hacer clic en "Procesar Rutas"
4. El sistema procesará las direcciones, las geocodificará automáticamente y mostrará el mapa con todas las ubicaciones
5. En el mapa se pueden ver todos los puntos de entrega marcados
6. Las entregas sin coordenadas válidas aparecerán marcadas en rojo en el sidebar

## Funcionalidades

- Carga de archivos Excel con rutas de entrega
- Geocodificación automática de direcciones usando OpenStreetMap
- Visualización de rutas en mapa interactivo con Leaflet
- Listado de entregas en sidebar con información detallada
- Identificación de direcciones sin coordenadas válidas
- Interfaz responsiva con Bootstrap

