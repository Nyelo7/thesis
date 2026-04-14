<!-- search_bar.php – Enhanced Modern & Responsive Design -->
<div style="text-align: center; margin: 40px 0; padding: 0 15px; max-width: 960px; margin-left: auto; margin-right: auto;">
  <div style="
    background: linear-gradient(145deg, #ffffff, #f8fafc);
    padding: 35px 25px;
    border-radius: 24px;
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1),
                0 2px 8px rgba(0, 0, 0, 0.05);
    border: 1px solid rgba(255,255,255,0.8);
  ">
    
    <!-- Header -->
    <div style="margin-bottom: 28px;">
      <h2 style="
        margin: 0 0 8px 0;
        color: #1e2937;
        font-size: clamp(1.5rem, 5vw, 1.85rem);
        font-weight: 700;
        letter-spacing: -0.025em;
      ">
        Search Records
      </h2>
      <p style="margin: 0; color: #64748b; font-size: 1.05rem; line-height: 1.4;">
        Find by name, Circle ID, or exact birth/death dates
      </p>
    </div>

    <!-- Search Input -->
    <input 
      type="text" 
      id="searchInput" 
      placeholder="Search "
      style="
        width: 100%; 
        max-width: 620px;
        padding: 16px 22px;
        font-size: clamp(1rem, 4vw, 1.15em);
        border: 3px solid #3b82f6;
        border-radius: 16px;
        outline: none;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(59, 130, 246, 0.15);
        margin-bottom: 32px;
        box-sizing: border-box;
      "
      onfocus="this.style.borderColor='#2563eb'; this.style.boxShadow='0 0 0 4px rgba(37, 99, 235, 0.25)';"
      onblur="this.style.borderColor='#3b82f6'; this.style.boxShadow='0 4px 15px rgba(59, 130, 246, 0.15)';"
    >

    <!-- Date Filters -->
    <div style="
      display: flex; 
      flex-wrap: wrap; 
      justify-content: center; 
      gap: 20px; 
      margin-bottom: 32px;
    ">
      
      <div style="flex: 1; min-width: 280px; max-width: 340px;">
        <label style="
          font-weight: 600; 
          display: block; 
          margin-bottom: 10px; 
          color: #334155;
          font-size: 1.05rem;
        ">
          Birth Date <span style="font-weight:400; color:#94a3b8;"></span>
        </label>
        <input 
          type="date" 
          id="birthDate" 
          style="
            padding: 14px 18px; 
            border: 2px solid #e2e8f0; 
            border-radius: 12px; 
            width: 100%; 
            font-size: 1.05rem;
            background: white;
            transition: border-color 0.2s;
            box-sizing: border-box;
          "
          onfocus="this.style.borderColor='#3b82f6'"
          onblur="this.style.borderColor='#e2e8f0'"
        >
      </div>

      <div style="flex: 1; min-width: 280px; max-width: 340px;">
        <label style="
          font-weight: 600; 
          display: block; 
          margin-bottom: 10px; 
          color: #334155;
          font-size: 1.05rem;
        ">
          Death Date <span style="font-weight:400; color:#94a3b8;"></span>
        </label>
        <input 
          type="date" 
          id="deathDate" 
          style="
            padding: 14px 18px; 
            border: 2px solid #e2e8f0; 
            border-radius: 12px; 
            width: 100%; 
            font-size: 1.05rem;
            background: white;
            transition: border-color 0.2s;
            box-sizing: border-box;
          "
          onfocus="this.style.borderColor='#3b82f6'"
          onblur="this.style.borderColor='#e2e8f0'"
        >
      </div>
    </div>

    <!-- Buttons -->
    <div style="
      display: flex; 
      flex-wrap: wrap; 
      gap: 16px; 
      justify-content: center;
    ">
      <button onclick="searchNow()" 
              style="
                padding: 16px 50px;
                background: linear-gradient(90deg, #10b981, #34d399);
                color: white;
                border: none;
                border-radius: 14px;
                font-size: clamp(1.05em, 3.5vw, 1.15em);
                font-weight: 700;
                cursor: pointer;
                transition: all 0.3s ease;
                box-shadow: 0 6px 20px rgba(16, 185, 129, 0.3);
                min-width: 180px;
                flex: 1;
                max-width: 220px;
              "
              onmouseover="this.style.transform='translateY(-3px)'; this.style.boxShadow='0 12px 28px rgba(16, 185, 129, 0.4)';"
              onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 6px 20px rgba(16, 185, 129, 0.3)';">
        🔍Search Now
      </button>

      <button onclick="clearSearch()" 
              style="
                padding: 16px 46px;
                background: #64748b;
                color: white;
                border: none;
                border-radius: 14px;
                font-size: clamp(1.05em, 3.5vw, 1.15em);
                font-weight: 600;
                cursor: pointer;
                transition: all 0.3s ease;
                min-width: 160px;
                flex: 1;
                max-width: 200px;
              "
              onmouseover="this.style.background='#475569'"
              onmouseout="this.style.background='#64748b'">
        Clear All
      </button>
    </div>

  </div>
</div>

<script>
// ==================== ORIGINAL FUNCTIONALITY (UNCHANGED) ====================
function searchNow() {
  const name = document.getElementById('searchInput').value.trim();
  const birthDate = document.getElementById('birthDate').value;
  const deathDate = document.getElementById('deathDate').value;

  if (!name) {
    alert("Please enter a name or circle ID");
    return;
  }

  const term = name.toLowerCase();
  let found = false;

  // Reset highlights
  document.querySelectorAll('.circle').forEach(el => {
    el.style.backgroundColor = ''; 
    el.style.boxShadow = '0 2px 6px rgba(0,0,0,0.2)';
    el.style.zIndex = '1';
  });

  Object.keys(dbData).forEach(id => {
    const data = dbData[id];
    let nameMatch = false;
    let birthMatch = true;
    let deathMatch = true;

    if (id.toLowerCase().includes(term)) {
      nameMatch = true;
    } else if (data.persons && data.persons.length > 0) {
      nameMatch = data.persons.some(p => {
        const namePart = p.split('||')[0] || '';
        const cleaned = namePart.trim().toLowerCase();
        return cleaned.includes(term);
      });
    }

    if (!nameMatch) return;

    if (birthDate) {
      birthMatch = false;
      if (data.persons && data.persons.length > 0) {
        birthMatch = data.persons.some(p => {
          const birth = (p.split('||')[1] || '').trim().split(' ')[0];
          return birth === birthDate;
        });
      }
    }

    if (deathDate) {
      deathMatch = false;
      if (data.persons && data.persons.length > 0) {
        deathMatch = data.persons.some(p => {
          const death = (p.split('||')[2] || '').trim().split(' ')[0];
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

function highlight(id) {
  const el = document.querySelector(`.circle[data-id="${id}"]`);
  if (!el) return;

  el.scrollIntoView({ behavior: 'smooth', block: 'center' });

  const originalBg = el.style.backgroundColor || getComputedStyle(el).backgroundColor;

  el.style.backgroundColor = '#3b82f6';
  el.style.boxShadow = '0 0 40px 20px #3b82f6';
  el.style.zIndex = '100';
  el.style.transition = 'background-color 0.4s, box-shadow 0.4s';

  setTimeout(() => {
    el.style.backgroundColor = originalBg;
    el.style.boxShadow = '0 2px 6px rgba(0,0,0,0.2)';
    el.style.zIndex = '1';
  }, 5000);
}

function clearSearch() {
  document.getElementById('searchInput').value = '';
  document.getElementById('birthDate').value = '';
  document.getElementById('deathDate').value = '';

  document.querySelectorAll('.circle').forEach(el => {
    el.style.backgroundColor = '';
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