<?php
require_once 'db_connect.php';

// Fetch circle data with names for search
$sql = "
  SELECT 
    group_code,
    COUNT(*) AS count,
    GROUP_CONCAT(
      TRIM(CONCAT(first_name, ' ', COALESCE(middle_name, ' '), last_name))
      SEPARATOR '||'
    ) AS full_names
  FROM graves
  GROUP BY group_code
";

$result = $conn->query($sql);

$group_data = [];
while ($row = $result->fetch_assoc()) {
  $group_data[$row['group_code']] = [
    'count' => (int)$row['count'],
    'full_names' => $row['full_names'] ? explode('||', $row['full_names']) : []
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
  <style>
    body {
      margin: 0;
      padding: 20px;
      background: #f8f9fa;
      font-family: Arial, Helvetica, sans-serif;
    }
    h1 { 
      text-align: center; 
      color: #2c3e50; 
      margin-bottom: 10px; 
    }
    .subtitle { 
      text-align: center; 
      color: #555; 
      margin-bottom: 20px; 
    }
    .container {
      position: relative;
      width: 600px;
      height: 1000px;
      margin: 0 auto 40px;
      background-image: url('pic.png');
      background-size: cover;
      background-position: center;
      background-repeat: no-repeat;
      border: 3px solid #5a8c4f;
      border-radius: 12px;
      overflow: hidden;
      box-shadow: 0 6px 25px rgba(0,0,0,0.12);
    }
    .circle {
      position: absolute;
      width: 40px;
      height: 40px;
      border-radius: 50%;
      border: 1px solid #555;
      cursor: pointer;
      transition: all 0.22s ease;
      box-shadow: 0 2px 6px rgba(0,0,0,0.2);
    }
    .circle:hover {
      transform: scale(2.0);
      z-index: 10;
      box-shadow: 0 6px 15px rgba(0,0,0,0.4);
    }
    .circle-label {
      position: absolute;
      left: 50%;
      top: 100%;
      transform: translateX(-50%);
      background: rgba(0,0,0,0.85);
      color: white;
      padding: 6px 10px;
      border-radius: 6px;
      font-size: 0.75rem;
      white-space: nowrap;
      pointer-events: none;
      opacity: 0;
      transition: opacity 0.2s;
      z-index: 11;
      box-shadow: 0 2px 8px rgba(0,0,0,0.3);
    }
    .circle:hover .circle-label {
      opacity: 1;
    }
    .fill-0 { background: #22c55e; } /* Green - 0 */
    .fill-1to4 { background: #eab308; } /* Yellow - 1-4 */
    .fill-5plus { background: #ef4444; } /* Red - 5+ */
  </style>
</head>
<body>

<h1>Cemetery Circles</h1>
<p class="subtitle">Click a circle to view details</p>

<?php include 'search_bar.php'; ?>

<div class="container" id="map"></div>

<!-- Pass data to JS -->
<script id="dbData" type="application/json">
<?= json_encode($group_data) ?>
</script>

<script src="circles.js"></script>

</body>
</html>