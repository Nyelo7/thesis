<?php
$host = getenv("DB_HOST");
$port = getenv("DB_PORT");
$user = getenv("DB_USER");
$pass = getenv("DB_PASS");
$db   = getenv("DB_NAME");

$conn = mysqli_init();

// Set SSL (required for TiDB)
mysqli_ssl_set($conn, NULL, NULL, "../certs/isrgrootx1.pem", NULL, NULL);

mysqli_real_connect(
    $conn,
    $host,
    $user,
    $pass,
    $db,
    $port,
    NULL,
    MYSQLI_CLIENT_SSL
);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>