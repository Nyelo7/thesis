// circles.js

const circles = [
  { id: "A-01", x: 60,  y: 100 },
  { id: "A-02", x: 140, y: 100 },
  { id: "A-03", x: 220, y: 100 },
  { id: "A-04", x: 300, y: 100 },
  { id: "A-05", x: 380, y: 100 },

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
];

const dbData = JSON.parse(document.getElementById('dbData').textContent);

const map = document.getElementById('map');

circles.forEach(c => {
  const info = dbData[c.id] || { count: 0 };

  const div = document.createElement('div');

  let fillClass = 'fill-0';
  if (info.count >= 1 && info.count <= 4) {
    fillClass = 'fill-1to4';
  } else if (info.count >= 5) {
    fillClass = 'fill-5plus';
  }

  div.className = `circle ${fillClass}`;
  div.setAttribute('data-id', c.id);

  div.style.left = c.x + 'px';
  div.style.top  = c.y + 'px';

  // Tooltip label
  const label = document.createElement('div');
  label.className = 'circle-label';
  label.textContent = `${c.id}  ${info.count}/5`;
  div.appendChild(label);

  div.onclick = () => {
    window.location.href = 'plot_info.php?plot=' + encodeURIComponent(c.id);
  };

  map.appendChild(div);
});