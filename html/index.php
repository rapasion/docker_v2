<?php
// Basic server info
$server = [
    'HTTPS' => isset($_SERVER['HTTPS']) ? 'ON' : 'OFF',
    'SERVER_PROTOCOL' => $_SERVER['SERVER_PROTOCOL'],
    'SERVER_SOFTWARE' => $_SERVER['SERVER_SOFTWARE'],
    'DOCUMENT_ROOT' => $_SERVER['DOCUMENT_ROOT'],
    'PHP_FPM' => php_sapi_name(),
];

// Postgres test
$pg_status = 'Not connected';
try {
    $conn = new PDO(
        "pgsql:host=postgres;port=5432;dbname=postgresdb",
        "richardp",
        "Password1!"
    );
    $pg_status = "Connected to Postgres successfully";
} catch (Exception $e) {
    $pg_status = "Postgres connection failed: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>HTTPS Test Page</title>
    <style>
        body { font-family: Arial; background: #111; color: #eee; padding: 40px; }
        h1 { color: #4CAF50; }
        pre { background: #222; padding: 15px; border-radius: 8px; }
        .ok { color: #4CAF50; }
        .fail { color: #ff4444; }
    </style>
</head>
<body>

<h1>Apache HTTPS + PHP-FPM Test</h1>

<h2>🔐 HTTPS Status</h2>
<p class="<?= $server['HTTPS'] === 'ON' ? 'ok' : 'fail' ?>">
    HTTPS: <?= $server['HTTPS'] ?>
</p>

<h2>⚙ Server Info</h2>
<pre><?php print_r($server); ?></pre>

<h2>🐘 PHP Info</h2>
<p>PHP Version: <?= phpversion() ?></p>

<h2>🗄 PostgreSQL Connection</h2>
<p class="<?= str_contains($pg_status, 'Connected') ? 'ok' : 'fail' ?>">
    <?= $pg_status ?>
</p>

<h2>📦 Loaded Extensions</h2>
<pre><?php print_r(get_loaded_extensions()); ?></pre>

</body>
</html>
