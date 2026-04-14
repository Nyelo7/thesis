<?php
require_once 'db_connect.php';

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
  FROM mapiii
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
  <link rel="stylesheet" href="styles.css">
</head>
<body>
<nav class="navbar">
  <div class="nav-container">
    
    <div class="nav-left">
      <div class="nav-brand">Gate 1</div>
      <a href="../circle.php" class="nav-link">Back to Home</a>
    </div>

  </div>
</nav>



<?php include 'search_bar.php'; ?>

<div class="container" id="map"></div>

<!-- Pass data to JS -->
<script id="dbData" type="application/json">
<?= json_encode($group_data) ?>
</script>

<script src="circles.js"></script>

</body>
</html>