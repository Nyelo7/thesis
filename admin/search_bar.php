<!-- search_bar.php -->
<div style="text-align: center; margin-bottom: 25px;">
  <input type="text" id="searchInput" placeholder="Search name (e.g. Joshua)" 
         style="padding: 10px 16px; width: 320px; font-size: 1.1em; border-radius: 8px; border: 2px solid #5a8c4f; outline: none;">
  <button onclick="searchCircle()" 
          style="padding: 10px 22px; margin-left: 12px; background: #27ae60; color: white; border: none; border-radius: 8px; cursor: pointer; font-size: 1.1em; font-weight: bold;">
    Search
  </button>
</div>

<script>
// Global search function
function searchCircle() {
  const input = document.getElementById('searchInput').value.trim().toLowerCase();
  if (!input) return;

  let found = false;

  Object.keys(dbData).forEach(plotId => {
    const info = dbData[plotId];

    // 1. Match circle ID
    if (plotId.toLowerCase().includes(input)) {
      highlightCircle(plotId);
      found = true;
      return;
    }

    // 2. Match any person's full name
    if (info.full_names) {
      info.full_names.forEach(name => {
        if (name.toLowerCase().includes(input)) {
          highlightCircle(plotId);
          found = true;
        }
      });
    }
  });

  if (!found) {
    alert("No match found for: " + input);
  }
}

// Highlight + scroll
function highlightCircle(plotId) {
  const circles = document.querySelectorAll('.circle');
  circles.forEach(circle => {
    if (circle.getAttribute('data-id') === plotId) {
      circle.scrollIntoView({ behavior: 'smooth', block: 'center' });

      circle.style.boxShadow = '0 0 35px 15px #22c55e';
      circle.style.zIndex = '100';

      setTimeout(() => {
        circle.style.boxShadow = '0 2px 6px rgba(0,0,0,0.2)';
        circle.style.zIndex = '1';
      }, 4000);
    }
  });
}

// Enter key support
document.getElementById('searchInput')?.addEventListener('keypress', function(e) {
  if (e.key === 'Enter') {
    e.preventDefault();
    searchCircle();
  }
});
</script>