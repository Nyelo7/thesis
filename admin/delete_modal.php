<!-- delete_modal.php -->
<!-- This file contains only the modal HTML, CSS and JS. It is included where needed -->

<style>
    /* Custom Delete Modal Styles */
    .modal-overlay {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.6);
        z-index: 1000;
        justify-content: center;
        align-items: center;
    }
    .modal-content {
        background: white;
        padding: 30px;
        border-radius: 12px;
        width: 90%;
        max-width: 400px;
        text-align: center;
        box-shadow: 0 10px 30px rgba(0,0,0,0.3);
        animation: fadeIn 0.3s ease;
    }
    .modal-title {
        font-size: 1.3em;
        margin-bottom: 20px;
        color: #1f2937;
    }
    .modal-buttons {
        display: flex;
        gap: 15px;
        justify-content: center;
    }
    .modal-btn {
        padding: 10px 24px;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        font-weight: bold;
        font-size: 1em;
    }
    .modal-btn-cancel {
        background: #6b7280;
        color: white;
    }
    .modal-btn-cancel:hover { background: #4b5563; }
    .modal-btn-delete {
        background: #ef4444;
        color: white;
    }
    .modal-btn-delete:hover { background: #dc2626; }
    @keyframes fadeIn {
        from { opacity: 0; transform: scale(0.9); }
        to   { opacity: 1; transform: scale(1); }
    }
</style>

<!-- Modal HTML -->
<div id="deleteModal" class="modal-overlay">
    <div class="modal-content">
        <div class="modal-title" id="modalMessage">Delete this person from Floor ?</div>
        <div class="modal-buttons">
            <button class="modal-btn modal-btn-cancel" onclick="closeDeleteModal()">Cancel</button>
            <button class="modal-btn modal-btn-delete" id="confirmDeleteBtn">Delete</button>
        </div>
    </div>
</div>

<script>
// Global variables and functions for the modal
let currentDeleteId = null;

function showDeleteModal(personId, floorNumber) {
    currentDeleteId = personId;
    const modal = document.getElementById('deleteModal');
    const message = document.getElementById('modalMessage');
    message.textContent = `Delete this person from Floor ${floorNumber}?`;
    modal.style.display = 'flex';
}

function closeDeleteModal() {
    document.getElementById('deleteModal').style.display = 'none';
    currentDeleteId = null;
}

// Confirm delete via AJAX → reload page
document.getElementById('confirmDeleteBtn').addEventListener('click', function() {
    if (!currentDeleteId) return;

    fetch('delete.php?id=' + currentDeleteId)
        .then(response => {
            if (response.ok) {
                // Reload the same page after delete
                window.location.reload();
            } else {
                alert('Delete failed. Please try again.');
            }
        })
        .catch(error => {
            alert('Error during delete: ' + error);
        });

    closeDeleteModal();
});

// Close modal when clicking outside
document.getElementById('deleteModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeDeleteModal();
    }
});
</script>