<?php

$host   = getenv("DB_HOST");
$port   = getenv("DB_PORT");
$user   = getenv("DB_USER");
$pass   = getenv("DB_PASS");
$dbname = getenv("DB_NAME");

$conn = mysqli_init();

// SSL required for TiDB Cloud
mysqli_ssl_set(
    $conn,
    NULL,
    NULL,
    __DIR__ . "/../../certs/isrgrootx1.pem",
    NULL,
    NULL
);

mysqli_real_connect(
    $conn,
    $host,
    $user,
    $pass,
    $dbname,
    $port,
    NULL,
    MYSQLI_CLIENT_SSL
);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$conn->set_charset("utf8mb4");
?>