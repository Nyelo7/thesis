<?php
// circle.php - shows people grouped by group_code

require_once 'db_connect.php';

// Get data grouped by group_code
$sql = "
  SELECT 
    group_code,
    COUNT(*) AS count,
    GROUP_CONCAT(
      TRIM(CONCAT(first_name, ' ', COALESCE(middle_name,' '), last_name, ' (age ', age_at_death, ')'))
      SEPARATOR ' • '
    ) AS display_names
  FROM graves
  GROUP BY group_code
";

$result = $conn->query($sql);

$group_data = [];
while ($row = $result->fetch_assoc()) {
  $group_data[ $row['group_code'] ] = [
    'count' => (int)$row['count'],
    'names' => $row['display_names'] ? explode(' • ', $row['display_names']) : []
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
        margin-bottom: 30px;
    }
    .container {
        position: relative;
        width: 600px;
        height: 1000px;                 /* Your new height */
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
        transform: scale(1.5);
        z-index: 10;
        box-shadow: 0 6px 15px rgba(0,0,0,0.4);
    }

    /* New color scheme */
    .fill-0 { background: #22c55e; }           /* Green - 0 people (no data) */
    .fill-2-4 { background: #eab308; }         /* Dark yellow - 2 to 4 people */
    .fill-5plus { background: #ef4444; }       /* Red - 5 or more */
</style>
</head>
<body>

<h1>Cemetery Circles</h1>
<p class="subtitle">Click a circle to view details in a new tab</p>

<div class="container" id="map"></div>

<script>
const circles = [
  { id: "A-01", x: 60,  y: 100 },
  { id: "A-02", x: 140, y: 100 },
  { id: "A-03", x: 220, y: 100 },
  { id: "A-04", x: 300, y: 100 },
  { id: "A-05", x: 380, y: 100 },
  { id: "A-06", x: 460, y: 100 },

  { id: "B-01", x: 100, y: 220 },
  { id: "B-02", x: 180, y: 220 },
  { id: "B-03", x: 260, y: 220 },
  { id: "B-04", x: 340, y: 220 },
  { id: "B-05", x: 420, y: 220 },

  { id: "C-01", x: 40,  y: 360 },
  { id: "C-02", x: 120, y: 360 },
  { id: "C-03", x: 200, y: 360 },
  { id: "C-04", x: 280, y: 360 },
  { id: "C-05", x: 360, y: 360 },

  { id: "D-01", x: 40,  y: 460 },
  { id: "D-02", x: 120, y: 460 },
  { id: "D-03", x: 200, y: 460 },
  { id: "D-04", x: 280, y: 460 },
  { id: "D-05", x: 360, y: 460 },
];

const dbData = <?= json_encode($group_data) ?>;

const map = document.getElementById('map');

circles.forEach(c => {
  const info = dbData[c.id] || { count: 0 };

  const div = document.createElement('div');
  div.className = 'circle';

  // Correct color classes based on your request
  if (info.count === 0) {
    div.classList.add('fill-0');       // Green - no data
  } else if (info.count >= 1 && info.count <= 4) {
    div.classList.add('fill-2-4');     // Dark yellow - 2 to 4
  } else if (info.count >= 5) {
    div.classList.add('fill-5plus');   // Red - 5 or more
  } else {
    div.classList.add('fill-1');       // Add this for count = 1 (make it green too)
  }

  div.style.left = c.x + 'px';
  div.style.top  = c.y + 'px';

  div.onclick = () => {
  window.location.href = 'add_form.php?plot=' + encodeURIComponent(c.id);
  };

  map.appendChild(div);
});
</script>

</body>
</html>