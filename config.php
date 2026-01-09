<?php
require_once __DIR__ . '/vendor/autoload.php';

define('BASE_PATH', __DIR__);
define('UPLOAD_PATH', BASE_PATH . '/uploads/');
define('ALLOWED_EXTENSIONS', ['xlsx', 'xls']);

define('GEOCODING_API', 'https://nominatim.openstreetmap.org/search');
define('GEOCODING_USER_AGENT', 'RutasApp/1.0');

date_default_timezone_set('America/Bogota');
