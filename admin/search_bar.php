<!-- search_bar.php – Search by any part of name (first, middle, or last) -->
<div style="text-align: center; margin: 30px 0; max-width: 900px; margin-left: auto; margin-right: auto;">
  <div style="background: #ffffff; padding: 28px; border-radius: 16px; box-shadow: 0 6px 24px rgba(0,0,0,0.08);">
    <input 
      type="text" 
      id="searchInput" 
      placeholder="Search any part of name (Joshua, forbil, forbileforbile) or circle ID" 
      style="
        width: 100%; max-width: 520px;
        padding: 14px 20px;
        font-size: 1.1em;
        border: 2px solid #3498db;
        border-radius: 12px;
        outline: none;
        transition: border-color 0.2s;
        margin-bottom: 24px;
      "
      onfocus="this.style.borderColor='#2980b9'"
      onblur="this.style.borderColor='#3498db'"
    >

    <div style="display: flex; flex-wrap: wrap; justify-content: center; gap: 32px; margin-bottom: 24px;">
      <div>
        <label style="font-weight: 600; display: block; margin-bottom: 8px; color: #2c3e50;">Birth date (optional - exact)</label>
        <input 
          type="date" 
          id="birthDate" 
          style="padding: 11px 16px; border: 1px solid #d1d5db; border-radius: 10px; width: 220px; font-size: 1rem;"
        >
      </div>

      <div>
        <label style="font-weight: 600; display: block; margin-bottom: 8px; color: #2c3e50;">Death date (optional - exact)</label>
        <input 
          type="date" 
          id="deathDate" 
          style="padding: 11px 16px; border: 1px solid #d1d5db; border-radius: 10px; width: 220px; font-size: 1rem;"
        >
      </div>
    </div>

    <div style="margin-top: 12px;">
      <button onclick="searchNow()" 
              style="
                padding: 14px 48px;
                background: #27ae60;
                color: white;
                border: none;
                border-radius: 12px;
                font-size: 1.1em;
                font-weight: 600;
                cursor: pointer;
                transition: background 0.2s;
                margin-right: 16px;
              ">
        Search
      </button>

      <button onclick="clearSearch()" 
              style="
                padding: 14px 48px;
                background: #6b7280;
                color: white;
                border: none;
                border-radius: 12px;
                font-size: 1.1em;
                cursor: pointer;
                transition: background 0.2s;
              ">
        Clear
      </button>
    </div>
  </div>
</div>

<script>
// Search logic – match any part of first/middle/last name
function searchNow() {
  const name = document.getElementById('searchInput').value.trim();
  const birthDate = document.getElementById('birthDate').value; // "YYYY-MM-DD"
  const deathDate = document.getElementById('deathDate').value;

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

    // Name match: any part of first/middle/last name
    if (id.toLowerCase().includes(term)) {
      nameMatch = true;
    } else if (data.persons && data.persons.length > 0) {
      nameMatch = data.persons.some(p => {
        const parts = p.split('||');
        const fullName = parts[0] || ''; // name part
        const cleaned = fullName.trim().toLowerCase();
        return cleaned.includes(term);
      });
    }

    if (!nameMatch) return;

    // Birth date filter – exact match
    if (birthDate) {
      birthMatch = false;
      if (data.persons && data.persons.length > 0) {
        birthMatch = data.persons.some(p => {
          const parts = p.split('||');
          const birth = parts[1] ? parts[1].trim().split(' ')[0] : '';
          return birth === birthDate;
        });
      }
    }

    // Death date filter – exact match
    if (deathDate) {
      deathMatch = false;
      if (data.persons && data.persons.length > 0) {
        deathMatch = data.persons.some(p => {
          const parts = p.split('||');
          const death = parts[2] ? parts[2].trim().split(' ')[0] : '';
          return death === deathDate;
        });
      }
    }

    if (nameMatch && birthMatch && deathMatch) {
      highlight(id);
      found = true;
    }
  });

  if (!found) {
    alert(`No matching record found for "${name}"\n(with the selected exact date)`);
  }
}

// Highlight function
function highlight(id) {
  const el = document.querySelector(`.circle[data-id="${id}"]`);
  if (!el) return;

  el.scrollIntoView({ behavior: 'smooth', block: 'center' });

  el.style.boxShadow = '0 0 40px 20px #27ae60';
  el.style.zIndex = '100';

  setTimeout(() => {
    el.style.boxShadow = '0 2px 6px rgba(0,0,0,0.2)';
    el.style.zIndex = '1';
  }, 5000);
}

// Clear
function clearSearch() {
  document.getElementById('searchInput').value = '';
  document.getElementById('birthDate').value = '';
  document.getElementById('deathDate').value = '';

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