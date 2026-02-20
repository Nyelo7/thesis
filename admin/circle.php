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
      width: 1100px;
      height: 750px;
      margin: 0 auto 40px;
      background: linear-gradient(to bottom, #e8f4e9, #d0e8d5);
      border: 3px solid #5a8c4f;
      border-radius: 12px;
      overflow: hidden;
      box-shadow: 0 6px 25px rgba(0,0,0,0.12);
    }
    .circle {
      position: absolute;
      width: 100px;
      height: 100px;
      border-radius: 50%;
      border: 3px solid #444;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      font-size: 1.05rem;
      font-weight: bold;
      color: #222;
      cursor: pointer;
      transition: all 0.22s ease;
      box-shadow: 0 3px 10px rgba(0,0,0,0.15);
    }
    .circle:hover {
      transform: scale(1.15);
      z-index: 10;
      box-shadow: 0 8px 20px rgba(0,0,0,0.25);
    }
    .circle .id   { font-size: 1.15rem; }
    .circle .cnt  { font-size: 0.9rem; color: #555; }

    .fill-0 { background: #ffffff; }
    .fill-1 { background: #e3f2fd; }
    .fill-2 { background: #d4edda; }
    .fill-3 { background: #fff3cd; }
    .fill-4 { background: #f8d7da; }
    .fill-5 { background: #f5c6cb; color: #721c24; }
  </style>
</head>
<body>

<h1>Cemetery Circles</h1>
<p class="subtitle">Click a circle to view details in a new tab</p>

<div class="container" id="map"></div>

<script>
// Static circles – add more if needed
const circles = [
  { id: "A-01", x: 140, y: 100 },
  { id: "A-02", x: 300, y: 100 },
  { id: "A-03", x: 460, y: 100 },
  { id: "A-04", x: 620, y: 100 },
  { id: "A-05", x: 780, y: 100 },

  { id: "B-01", x: 200, y: 240 },
  { id: "B-02", x: 360, y: 240 },
  { id: "B-03", x: 520, y: 240 },
  { id: "B-04", x: 680, y: 240 },
  { id: "B-05", x: 840, y: 240 },

  { id: "C-01", x: 120, y: 380 },
  { id: "C-02", x: 280, y: 380 },
  { id: "C-03", x: 440, y: 380 },
  { id: "C-04", x: 600, y: 380 },
  { id: "C-05", x: 760, y: 380 },
];

const dbData = <?= json_encode($group_data) ?>;

const map = document.getElementById('map');

circles.forEach(c => {
  const info = dbData[c.id] || { count: 0, names: [] };

  const div = document.createElement('div');
  div.className = `circle fill-${Math.min(info.count, 5)}`;
  div.style.left = c.x + 'px';
  div.style.top  = c.y + 'px';

  div.innerHTML = `
    <div class="id">${c.id}</div>
    <div class="cnt">${info.count} / 5</div>
  `;

  // Open in the SAME tab (changed from _blank to _self)
  div.onclick = () => {
    window.location.href = 'plot_info.php?plot=' + encodeURIComponent(c.id);
  };

  map.appendChild(div);
});
</script>

</body>
</html>