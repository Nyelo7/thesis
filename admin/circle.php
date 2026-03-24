<?php
require_once 'db_connect.php';

session_start();

// If not logged in → redirect to login
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: ../login/login.php");
    exit;
}

// Handle logout
if (isset($_GET['logout'])) {
    session_unset();
    session_destroy();
    header("Location: ../login/login.php");
    exit;
}

// Fixed SQL: fetches full person data for exact date matching
$sql = "
  SELECT 
    group_code,
    COUNT(*) AS count,
    GROUP_CONCAT(
      CONCAT(
        TRIM(CONCAT(first_name, ' ', COALESCE(middle_name, ' '), last_name)),
        '||',
        COALESCE(DATE_FORMAT(birth_date, '%Y-%m-%d'), '0000-00-00'),
        '||',
        COALESCE(DATE_FORMAT(death_date, '%Y-%m-%d'), '0000-00-00')
      )
      SEPARATOR '|||'
    ) AS persons
  FROM graves
  GROUP BY group_code
";

$result = $conn->query($sql);

$group_data = [];
while ($row = $result->fetch_assoc()) {
  $group_data[$row['group_code']] = [
    'count' => (int)$row['count'],
    'persons' => $row['persons'] ? explode('|||', $row['persons']) : []
  ];
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Cemetery Circles</title>
  <link rel="stylesheet" href="cstyles.css">
</head>
<body>

<div class="header">
  <h1>Cemetery Circles</h1>
  <a href="?logout=1" class="logout-btn">Logout</a>
</div>

<p class="subtitle">Click a circle to view details</p>

<?php include 'search_bar.php'; ?>

<div class="container" id="map"></div>

<!-- Pass data to JS -->
<script id="dbData" type="application/json">
<?= json_encode($group_data) ?>
</script>

<script src="acircles.js"></script>

</body>
</html>