// circles.js

const circles = [
  
{ id: "A-01", x: 850, y: 970 },
{ id: "A-02", x: 799, y: 955 },
{ id: "A-03", x: 740, y: 955 },
{ id: "A-04", x: 690, y: 955 },
{ id: "A-05", x: 537, y: 955 },
{ id: "A-06", x: 497, y: 955 },
{ id: "A-07", x: 450, y: 955 },
{ id: "A-08", x: 390, y: 955 },
{ id: "A-09", x: 310, y: 930 },
{ id: "A-10", x: 250, y: 945 },
{ id: "A-11", x: 210, y: 945 },
{ id: "A-12", x: 170, y: 945 },
{ id: "A-13", x: 130, y: 945 },
{ id: "A-14", x: 90, y: 945 },
{ id: "A-15", x: 50, y: 945 },
{ id: "A-16", x: 10, y: 940 },
{ id: "A-17", x: 250, y: 910 },
{ id: "A-18", x: 210, y: 910 },
{ id: "A-19", x: 170, y: 910 },
{ id: "A-20", x: 130, y: 910 },
{ id: "A-21", x: 90, y: 910 },
{ id: "A-22", x: 50, y: 910 },
{ id: "A-23", x: 10, y: 910 },
{ id: "A-24", x: 850, y: 920 },
{ id: "A-25", x: 850, y: 870 },
{ id: "A-26", x: 850, y: 830 },
{ id: "A-27", x: 850, y: 790 },
{ id: "A-28", x: 850, y: 740 },
{ id: "A-29", x: 850, y: 699 },
{ id: "A-30", x: 796, y: 695 },
{ id: "A-31", x: 796, y: 735 },
{ id: "A-32", x: 796, y: 795 },
{ id: "A-33", x: 796, y: 835 },
{ id: "A-34", x: 796, y: 900 },
{ id: "A-35", x: 740, y: 695 },
{ id: "A-36", x: 740, y: 735 },
{ id: "A-37", x: 740, y: 795 },
{ id: "A-38", x: 740, y: 835 },
{ id: "A-39", x: 740, y: 900 },
{ id: "A-40", x: 537, y: 925 },
{ id: "A-41", x: 497, y: 925 },
{ id: "A-42", x: 450, y: 925 },
{ id: "A-43", x: 390, y: 925 },
{ id: "A-44", x: 675, y: 885 },
{ id: "A-45", x: 600, y: 885 },
{ id: "A-46", x: 537, y: 875 },
{ id: "A-47", x: 537, y: 840 },
{ id: "A-48", x: 310, y: 859 },
{ id: "A-49", x: 310, y: 824 },
{ id: "A-50", x: 310, y: 764 },
{ id: "A-51", x: 310, y: 729 },
{ id: "A-52", x: 310, y: 675 },
{ id: "A-53", x: 73, y: 865 },
{ id: "A-54", x: 34, y: 865 },
{ id: "A-55", x: 73, y: 830 },
{ id: "A-56", x: 73, y: 780 },
{ id: "A-57", x: 79, y: 730 },
{ id: "A-58", x: 79, y: 690 },
{ id: "A-59", x: 34, y: 865 },
{ id: "A-60", x: 34, y: 865 },
{ id: "A-61", x: 34, y: 830 },
{ id: "A-62", x: 34, y: 780 },
{ id: "A-63", x: 29, y: 730 },
{ id: "A-64", x: 29, y: 690 },
{ id: "A-65", x: 135, y: 685 },
{ id: "A-66", x: 180, y: 685 },
{ id: "A-67", x: 230, y: 685 },
{ id: "A-68", x: 400, y: 689 },
{ id: "A-69", x: 475, y: 689 },
{ id: "A-70", x: 580, y: 695 },
{ id: "A-71", x: 655, y: 695 },
{ id: "A-72", x: 655, y: 780 },
{ id: "A-73", x: 580, y: 780 },
{ id: "A-74", x: 400, y: 770 },
{ id: "A-75", x: 475, y: 770 },
{ id: "A-76", x: 400, y: 850 },
{ id: "A-77", x: 475, y: 850 },
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