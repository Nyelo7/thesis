// circles.js

const circles = [
  { id: "A-01", x: 320,  y: 910 },
  { id: "A-02", x: 348,  y: 910 },
  { id: "A-03", x: 376,  y: 910 },
  { id: "A-04", x: 404,  y: 910 },
  { id: "A-05", x: 432,  y: 910 },
  { id: "A-06", x: 460,  y: 910 },
  { id: "A-07", x: 488,  y: 910 },
  { id: "A-08", x: 516,  y: 910 },
  { id: "A-09", x: 544,  y: 910 },
  { id: "A-10", x: 572,  y: 910 },
  { id: "A-11", x: 600,  y: 910 },
  { id: "A-12", x: 628,  y: 910 },
  { id: "A-13", x: 656,  y: 910 },
  { id: "A-14", x: 683,  y: 910 },
  { id: "A-15", x: 710,  y: 910 },
  { id: "A-16", x: 738,  y: 910 },
  { id: "A-17", x: 766,  y: 910 },
  { id: "A-18", x: 794,  y: 910 },
  { id: "A-19", x: 821,  y: 910 },

  { id: "B-01", x: 322,  y: 839 },

  { id: "B-02", x: 354,  y: 840 },
  { id: "B-03", x: 380,  y: 840 },
  { id: "B-04", x: 408,  y: 840 },
  { id: "B-05", x: 435,  y: 840 },
  { id: "B-06", x: 463,  y: 840 },
  { id: "B-07", x: 491,  y: 840 },
  { id: "B-08", x: 518,  y: 840 },
  { id: "B-09", x: 545,  y: 840 },
  { id: "B-10", x: 572,  y: 840 },
  { id: "B-11", x: 598,  y: 840 },
  { id: "B-12", x: 624,  y: 840 },
  { id: "B-13", x: 651,  y: 840 },
  { id: "B-14", x: 679,  y: 840 },
  { id: "B-15", x: 706,  y: 840 },
  { id: "B-16", x: 733,  y: 840 },
  { id: "B-17", x: 760,  y: 840 },
  { id: "B-18", x: 788,  y: 840 },
  { id: "B-19", x: 815,  y: 840 },

  { id: "B-02", x: 354,  y: 814 },
  { id: "B-03", x: 380,  y: 814 },
  { id: "B-04", x: 408,  y: 814 },
  { id: "B-05", x: 435,  y: 814 },
  { id: "B-06", x: 463,  y: 814 },
  { id: "B-07", x: 491,  y: 814 },
  { id: "B-08", x: 518,  y: 814 },
  { id: "B-09", x: 545,  y: 814 },
  { id: "B-10", x: 572,  y: 814 },
  { id: "B-11", x: 598,  y: 814 },
  { id: "B-12", x: 624,  y: 814 },
  { id: "B-13", x: 651,  y: 814 },
  { id: "B-14", x: 679,  y: 814 },
  { id: "B-15", x: 706,  y: 814 },
  { id: "B-16", x: 733,  y: 814 },
  { id: "B-17", x: 760,  y: 814 },
  { id: "B-18", x: 788,  y: 814 },
  { id: "B-19", x: 815,  y: 814 },

  { id: "B-02", x: 354,  y: 782 },
  { id: "B-03", x: 380,  y: 782 },
  { id: "B-04", x: 408,  y: 782 },
  { id: "B-05", x: 435,  y: 782 },
  { id: "B-06", x: 463,  y: 782 },
  { id: "B-07", x: 491,  y: 782 },
  { id: "B-08", x: 518,  y: 782 },
  { id: "B-09", x: 545,  y: 782 },
  { id: "B-10", x: 572,  y: 782 },
  { id: "B-11", x: 598,  y: 782 },
  { id: "B-12", x: 624,  y: 782 },
  { id: "B-13", x: 651,  y: 782 },
  { id: "B-14", x: 679,  y: 782 },
  { id: "B-15", x: 706,  y: 782 },
  { id: "B-16", x: 733,  y: 782 },
  { id: "B-17", x: 760,  y: 782 },
  { id: "B-18", x: 788,  y: 782 },
  { id: "B-19", x: 815,  y: 782 },

  { id: "B-02", x: 338,  y: 749 },
  { id: "B-03", x: 366,  y: 749 },
  { id: "B-04", x: 392,  y: 749 },
  { id: "B-05", x: 420,  y: 749 },
  { id: "B-06", x: 447,  y: 749 },
  { id: "B-07", x: 473,  y: 749 },
  { id: "B-08", x: 500,  y: 749 },
  { id: "B-09", x: 527,  y: 749 },
  { id: "B-10", x: 554,  y: 749 },
  { id: "B-11", x: 580,  y: 749 },
  { id: "B-12", x: 607,  y: 749 },
  { id: "B-13", x: 635,  y: 749 },
  { id: "B-14", x: 661,  y: 749 },
  { id: "B-15", x: 690,  y: 749 },
  { id: "B-16", x: 716,  y: 749 },
  { id: "B-17", x: 744,  y: 749 },
  { id: "B-18", x: 772,  y: 749 },
  { id: "B-19", x: 799,  y: 749 },

  { id: "B-02", x: 338,  y: 723 },
  { id: "B-03", x: 366,  y: 723 },
  { id: "B-04", x: 392,  y: 723 },
  { id: "B-05", x: 420,  y: 723 },
  { id: "B-06", x: 447,  y: 723 },
  { id: "B-07", x: 473,  y: 723 },
  { id: "B-08", x: 500,  y: 723 },
  { id: "B-09", x: 527,  y: 723 },
  { id: "B-10", x: 554,  y: 723 },
  { id: "B-11", x: 580,  y: 723 },
  { id: "B-12", x: 607,  y: 723 },
  { id: "B-13", x: 635,  y: 723 },
  { id: "B-14", x: 661,  y: 723 },
  { id: "B-15", x: 690,  y: 723 },
  { id: "B-16", x: 716,  y: 723 },
  { id: "B-17", x: 744,  y: 723 },
  { id: "B-18", x: 772,  y: 723 },
  { id: "B-19", x: 799,  y: 723 },

  { id: "B-02", x: 338,  y: 697 },
  { id: "B-03", x: 366,  y: 697 },
  { id: "B-04", x: 392,  y: 697 },
  { id: "B-05", x: 420,  y: 697 },
  { id: "B-06", x: 447,  y: 697 },
  { id: "B-07", x: 473,  y: 697 },
  { id: "B-08", x: 500,  y: 697 },
  { id: "B-09", x: 527,  y: 697 },
  { id: "B-10", x: 554,  y: 697 },
  { id: "B-11", x: 580,  y: 697 },
  { id: "B-12", x: 607,  y: 697 },
  { id: "B-13", x: 635,  y: 697 },
  { id: "B-14", x: 661,  y: 697 },
  { id: "B-15", x: 690,  y: 697 },
  { id: "B-16", x: 716,  y: 697 },
  { id: "B-17", x: 744,  y: 697 },
  { id: "B-18", x: 772,  y: 697 },
  { id: "B-19", x: 799,  y: 697 },

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