<!-- search_bar.php -->
<div style="text-align: center; margin: 30px 0; max-width: 850px; margin-left: auto; margin-right: auto;">
  <div style="background: #ffffff; padding: 25px; border-radius: 12px; box-shadow: 0 4px 20px rgba(0,0,0,0.08);">
    <input 
      type="text" 
      id="searchInput" 
      placeholder="Name or circle ID (required) e.g. Joshua, Quilates, A-03" 
      style="
        width: 100%; max-width: 500px;
        padding: 14px 20px;
        font-size: 1.1em;
        border: 2px solid #3498db;
        border-radius: 10px;
        outline: none;
        margin-bottom: 20px;
      "
    >

    <div style="display: flex; flex-wrap: wrap; justify-content: center; gap: 30px; margin-bottom: 20px;">
      <div>
        <label style="font-weight: 600; display: block; margin-bottom: 8px; color: #2c3e50;">Birth year-month (optional)</label>
        <input type="month" id="birthMonth" style="padding: 10px 14px; border: 1px solid #ccc; border-radius: 8px; width: 220px;">
      </div>

      <div>
        <label style="font-weight: 600; display: block; margin-bottom: 8px; color: #2c3e50;">Death year-month (optional)</label>
        <input type="month" id="deathMonth" style="padding: 10px 14px; border: 1px solid #ccc; border-radius: 8px; width: 220px;">
      </div>
    </div>

    <div style="margin-top: 20px;">
      <button onclick="searchNow()" 
              style="
                padding: 14px 40px;
                background: #27ae60;
                color: white;
                border: none;
                border-radius: 10px;
                font-size: 1.1em;
                font-weight: bold;
                cursor: pointer;
                margin-right: 15px;
              ">
        Search
      </button>

      <button onclick="clearSearch()" 
              style="
                padding: 14px 40px;
                background: #95a5a6;
                color: white;
                border: none;
                border-radius: 10px;
                font-size: 1.1em;
                cursor: pointer;
              ">
        Clear
      </button>
    </div>
  </div>
</div>

<script>
// Search logic
function searchNow() {
  const name = document.getElementById('searchInput').value.trim();
  const birthMonth = document.getElementById('birthMonth').value; // YYYY-MM
  const deathMonth = document.getElementById('deathMonth').value;

  if (!name) {
    alert("Please enter a name or circle ID");
    return;
  }

  const term = name.toLowerCase();
  let found = false;

  // Reset highlights
  document.querySelectorAll('.circle').forEach(el => {
    el.style.boxShadow = '0 2px 6px rgba(0,0,0,0.2)';
    el.style.zIndex = '1';
  });

  Object.keys(dbData).forEach(id => {
    const data = dbData[id];
    let nameMatch = false;
    let birthMatch = true;
    let deathMatch = true;

    // ======================
    // NAME MATCH
    // ======================
    if (id.toLowerCase().includes(term)) {
      nameMatch = true;
    } 
    else if (data.full_names) {
      nameMatch = data.full_names.some(n =>
        n.toLowerCase().includes(term)
      );
    }

    if (!nameMatch) return;

    // ======================
    // BIRTH YEAR-MONTH FILTER
    // ======================
    if (birthMonth) {
      birthMatch = false;

      if (data.persons && data.persons.length > 0) {
        birthMatch = data.persons.some(p => {
          const parts = p.split('||');
          if (!parts[1]) return false;

          // Remove "Born:" and trim
          const birthDate = parts[1].replace('Born:', '').trim();

          if (!birthDate) return false;

          const birthYM = birthDate.substring(0, 7); // YYYY-MM
          return birthYM === birthMonth;
        });
      }
    }

    // ======================
    // DEATH YEAR-MONTH FILTER
    // ======================
    if (deathMonth) {
      deathMatch = false;

      if (data.persons && data.persons.length > 0) {
        deathMatch = data.persons.some(p => {
          const parts = p.split('||');
          if (!parts[2]) return false;

          // Remove "Died:" and trim
          const deathDate = parts[2].replace('Died:', '').trim();

          if (!deathDate) return false;

          const deathYM = deathDate.substring(0, 7); // YYYY-MM
          return deathYM === deathMonth;
        });
      }
    }

    // ======================
    // FINAL CHECK
    // ======================
    if (nameMatch && birthMatch && deathMatch) {
      highlight(id);
      found = true;
    }
  });

  if (!found) {
    alert(`No matching record found for "${name}"\n(with the selected year-month)`);
  }
}

// Highlight circle
function highlight(id) {
  const el = document.querySelector(`.circle[data-id="${id}"]`);
  if (el) {
    el.scrollIntoView({ behavior: 'smooth', block: 'center' });
    el.style.boxShadow = '0 0 40px 20px #27ae60';
    el.style.zIndex = '100';

    setTimeout(() => {
      el.style.boxShadow = '0 2px 6px rgba(0,0,0,0.2)';
      el.style.zIndex = '1';
    }, 5000);
  }
}

// Clear search
function clearSearch() {
  document.getElementById('searchInput').value = '';
  document.getElementById('birthMonth').value = '';
  document.getElementById('deathMonth').value = '';

  document.querySelectorAll('.circle').forEach(el => {
    el.style.boxShadow = '0 2px 6px rgba(0,0,0,0.2)';
    el.style.zIndex = '1';
  });
}

// Enter key support
document.getElementById('searchInput')?.addEventListener('keypress', e => {
  if (e.key === 'Enter') {
    e.preventDefault();
    searchNow();
  }
});
</script>