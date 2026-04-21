// circles.js

const circles = [
  

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